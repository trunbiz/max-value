<?php

namespace App\Http\Controllers\Admin;

use App\Models\Formatter;
use App\Models\Helper;
use App\Models\NotificationCustom;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class NotificationCustomController extends Controller
{
    use BaseControllerTrait;

    public function __construct(NotificationCustom $model)
    {
        $this->initBaseModel($model);
        $this->isMultipleImages = false;
        $this->title = 'Notification';
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {

        $query = NotificationCustom::where('type', 'notify')->orderby('id', 'DESC');

        if(isset($_GET['search_query']) && !empty($_GET['search_query'])){
            $query = $query->where('title', 'LIKE', '%'.$_GET['search_query'].'%');
        }

        if(isset($_GET['from']) && !empty($_GET['from'])){
            $query = $query->where('created_at', '>=', $_GET['from']);
        }

        if(isset($_GET['to']) && !empty($_GET['to'])){
            $query = $query->where('created_at', '<=', $_GET['to']);
        }

        $users = User::where('is_admin', '!=', 2)->get();

        $items = $query->paginate(isset($_GET['limit']) && !empty($_GET['limit']) ? $_GET['limit'] : 10);

//        $items = $this->model->searchByQuery($request);
        return view('administrator.' . $this->prefixView . '.index', compact('items', 'users'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $users = User::where('is_admin', '!=', 2)->get();

        return view('administrator.' . $this->prefixView . '.add')->with(compact('users'));
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('administrator.' . $this->prefixView . '.index');
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
}
