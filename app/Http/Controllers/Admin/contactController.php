<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\NotificationCustom;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class contactController extends Controller
{
    use BaseControllerTrait;

    public function __construct(contact $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request);

        return view('administrator.' . $this->prefixView . '.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        return view('administrator.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('administrator.' . $this->prefixView . '.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('administrator.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('administrator.' . $this->prefixView . '.edit', ['id' => $id]);
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

    public function response($id)
    {
        $item = $this->model->find($id);
        NotificationCustom::where('type', 'contacts')->where('value', $id)->update(['viewed' => 2]);
        $responses = Response::where('contact_id', $id)->get();
        return view('administrator.' . $this->prefixView . '.edit', compact('item', 'responses'));
    }

    public function sendResponse(Request $request){
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
                'title' => 'Support had responsed your message',
                'description' => 'Support had responsed your message at '.Carbon::now()->toDateTimeString(),
                'user_id' => $request->user_id,
                'link' => route('user.contacts.edit', ['id' => $request->id]),
                'type' => 'response',
                'value' => $value->id,
            ]);

            $total = Contact::where('status', 1)->count();

            return response()->json([
                'status' => true,
                'message' => 'Response success',
                'html' => view('administrator.' . $this->prefixView . '.response', compact('item', 'responses'))->render(),
                'total' => $total,
            ]);
        }
    }
}
