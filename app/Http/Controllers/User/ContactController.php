<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Models\Contact;
use App\Models\Formatter;
use App\Models\NotificationCustom;
use App\Models\Response;
use App\Models\WalletUser;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\WithdrawUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class ContactController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Contact $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Contact";

        $query = Contact::where('user_id', Auth::id());

        if(isset($_GET['status']) && !empty($_GET['status'])){
            $query = $query->where('status', $_GET['status']);
        }

        $items = $query->paginate(10);
        return view('user.' . $this->prefixView . '.index',compact('title', 'items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $title = "Contact";
        $user = \auth()->user();
        return view('user.' . $this->prefixView . '.add', compact('user', 'title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $item = $this->model->storeByQuery($request);
            return response()->json([
                'status' => true,
                'message' => 'Send Succesfull',
            ]);
        }
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        NotificationCustom::join('response', 'response.id', '=', 'notification_customs.value')->where('type', 'response')->where('contact_id', $id)->update(['viewed' => 2]);
        $responses = Response::where('contact_id', $id)->get();
        return view('user.' . $this->prefixView . '.edit', compact('item', 'responses'));
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

    public function response(Request $request)
    {
        $request->status = 1;
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ], [
            'message.required' => 'Message is required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $dataInsert = [
                'contact_id' => $request->id,
                'message' => $request->message,
                'user_id' => Auth::id(),
            ];

            $value = Response::create($dataInsert);

            $responses = Response::where('contact_id', $request->id)->get();

            $item = $this->model->updateByQuery($request, $request->id);

            NotificationCustom::create([
                'title' => 'You have a new response',
                'description' => 'You have a new response sended at '.Carbon::now()->toDateTimeString(),
                'user_id' => 1,
                'link' => route('administrator.contacts.index' ),
                'type' => 'response',
                'value' => $value->id
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Response success',
                'html' => view('user.' . $this->prefixView . '.response', compact('item', 'responses'))->render()
            ]);
        }
    }
}
