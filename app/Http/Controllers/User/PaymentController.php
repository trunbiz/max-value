<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Models\Formatter;
use App\Models\User;
use App\Models\WalletUser;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\WithdrawUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class PaymentController extends Controller
{
    use BaseControllerTrait;

    public function __construct(WithdrawUser $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Payment Orders";
        $current_user = User::where('id', Auth::id())->first();
        $items = $this->model->searchByQuery($request, ['user_id' => \auth()->id()]);
        return view('user.' . $this->prefixView . '.index', compact('items','title', 'current_user'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $items = WalletUser::where('user_id', Auth::id())->orderBy('default', 'DESC')->get();
        return response()->json([
            'html' => view('user.withdraw_users.create', compact('items'))->render()
        ]);
    }

    public function store(Request $request)
    {
        $walletUser = WalletUser::find($request->wallet_id);
        $min = $walletUser->withdrawType->min;

        $validator = Validator::make($request->all(), [
            'amount'=>'required|numeric|min:' . $min . '|lte:'. (float) auth()->user()->money,
        ], [
            'amount.lte' => 'The amount is not enough',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $item = $this->model->storeByQuery($request);
            $amountAvailable = Formatter::formatMoney(auth()->user()->money);
            $amountPending = Formatter::formatMoney(WithdrawUser::where('user_id', auth()->id())->where('withdraw_status_id', 1)->sum('amount'));
            $amountTotalWithdraw = Formatter::formatMoney(WithdrawUser::where('user_id', auth()->id())->sum('amount'));
            return response()->json([
                'html' => view('user.withdraw_users.add_order', compact('item'))->render(),
                'available' => $amountAvailable,
                'pending' => $amountPending,
                'total' => $amountTotalWithdraw,
            ]);
        }

        //return redirect()->route('user.' . $this->prefixView . '.index');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('user.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('user.' . $this->prefixView . '.edit', ['id' => $id]);
    }

    public function delete(Request $request, $id)
    {
        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
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
