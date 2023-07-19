<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\NotificationCustom;
use App\Models\TransectionUser;
use App\Models\User;
use App\Models\WalletUser;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\WithdrawType;
use App\Models\WithdrawUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class WalletController extends Controller
{
    use BaseControllerTrait;

    public function __construct(WalletUser $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Wallet";
        $current_user = User::where('id', Auth::id())->first();
        $banks = WithdrawType::where('parent_id', null)->get();
//        $items = $this->model->searchByQuery($request, ['user_id' => \auth()->id()]);
        $items = WalletUser::where('user_id', Auth::id())->orderBy('default', 'DESC')->orderBy('id', 'DESC')->get();

        $amountAvailable = Formatter::formatMoney(auth()->user()->money);
        $amountPending = Formatter::formatMoney(WithdrawUser::where('user_id', auth()->id())->where('withdraw_status_id', 1)->sum('amount'));
        $amountTotalWithdraw = Formatter::formatMoney(WithdrawUser::where('user_id', auth()->id())->where('withdraw_status_id', 2)->sum('amount'));

        $transactions = WithdrawUser::where('user_id', \auth()->id())->latest()->get();

        return view('user.' . $this->prefixView . '.index', compact('items', 'banks','title', 'current_user','amountAvailable','amountPending','amountTotalWithdraw','transactions'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
//        $title = "Add wallet";
//        return view('user.' . $this->prefixView . '.add', compact('title'));
        $banks = WithdrawType::where('parent_id', null)->get();
        return response()->json([
            'html' => view('user.' . $this->prefixView . '.add')->with(compact('banks'))->render(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'withdraw_type_id' => 'required',
            'email' => 'required_if:withdraw_type_id,1,2|email|nullable',
            'usdt_network' => 'required_if:withdraw_type_id,4',
            'eth_network' => 'required_if:withdraw_type_id,5',
            'bitcoin_network' => 'required_if:withdraw_type_id,6',
            'address_network' => 'required_if:withdraw_type_id,4,5,6',
            'beneficiary_name' => 'required_if:withdraw_type_id,7',
            'acc_number' => 'required_if:withdraw_type_id,7',
            'bank_name' => 'required_if:withdraw_type_id,7',
            'swift_code' => 'required_if:withdraw_type_id,7',
            'bank_address' => 'required_if:withdraw_type_id,7',
        ], [
            'withdraw_type_id.required' => 'Please choose a payment',
            'email.required_if' => 'The email is required',
            'usdt_network.required_if' => 'Please choose a network',
            'eth_network.required_if' => 'Please choose a network',
            'bitcoin_network.required_if' => 'Please choose a network',
            'address_network.required_if' => 'The network address is required',
            'beneficiary_name.required_if' => 'The Beneficiary Name is required',
            'acc_number.required_if' => 'The Account Number is required',
            'bank_name.required_if' => 'The Bank Name is required',
            'swift_code.required_if' => 'The SWIFT/BIC Code is required',
            'bank_address.required_if' => 'The Bank Address is required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $check = WalletUser::where('withdraw_type_id', $request->withdraw_type_id)->where('user_id', Auth::id())->where('email', $request->email)->where('email', '!=', null)->first();
            if(isset($check) && !empty($check)){
                return response()->json([
                    'status' => false,
                    'message' => 'Email used in this method type, please fill another email',
                ]);
            }else{
                $item = $this->model->storeByQuery($request);
                $items = WalletUser::where('user_id', Auth::id())->orderBy('default', 'DESC')->orderBy('id', 'DESC')->get();
                return response()->json([
                    'html' => view('user.wallet_users.add_method', compact('items'))->render()
                ]);
            }
        }

        //return redirect()->route('user.' . $this->prefixView . '.index');
    }

    public function edit($id)
    {
        NotificationCustom::find($id)->update(['viewed' => 2]);
        return redirect()->route('user.wallet_users.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'withdraw_type_id' => 'required',
            'email' => 'required_if:withdraw_type_id,1,2|email|nullable',
            'usdt_network' => 'required_if:withdraw_type_id,4',
            'eth_network' => 'required_if:withdraw_type_id,5',
            'bitcoin_network' => 'required_if:withdraw_type_id,6',
            'address_network' => 'required_if:withdraw_type_id,4,5,6',
            'beneficiary_name' => 'required_if:withdraw_type_id,7',
            'acc_number' => 'required_if:withdraw_type_id,7',
            'bank_name' => 'required_if:withdraw_type_id,7',
            'swift_code' => 'required_if:withdraw_type_id,7',
            'bank_address' => 'required_if:withdraw_type_id,7',
        ], [
            'withdraw_type_id.required' => 'Please choose a payment',
            'email.required_if' => 'The email is required',
            'usdt_network.required_if' => 'Please choose a network',
            'eth_network.required_if' => 'Please choose a network',
            'bitcoin_network.required_if' => 'Please choose a network',
            'address_network.required_if' => 'The network address is required',
            'beneficiary_name.required_if' => 'The Beneficiary Name is required',
            'acc_number.required_if' => 'The Account Number is required',
            'bank_name.required_if' => 'The Bank Name is required',
            'swift_code.required_if' => 'The SWIFT/BIC Code is required',
            'bank_address.required_if' => 'The Bank Address is required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $item = $this->model->updateByQuery($request, $request->id);
            $items = WalletUser::where('user_id', Auth::id())->orderBy('default', 'DESC')->orderBy('id', 'DESC')->get();
            return response()->json([
                'html' => view('user.wallet_users.add_method', compact('items'))->render(),
            ]);
        }
//        return redirect()->route('user.' . $this->prefixView . '.edit', ['id' => $id]);
    }

    public function delete(Request $request)
    {
        WalletUser::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete success',
        ]);
        //return $this->model->deleteByQuery($request, $request->id, $this->forceDelete);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }
}
