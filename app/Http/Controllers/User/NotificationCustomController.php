<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Models\contact;
use App\Models\Formatter;
use App\Models\Notification;
use App\Models\NotificationCustom;
use App\Models\WalletUser;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\WithdrawUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class NotificationCustomController extends Controller
{
    use BaseControllerTrait;

    public function __construct(NotificationCustom $model)
    {
        $this->initBaseModel($model);
        $this->title = 'Notifications';
        $this->shareBaseModel($model);

    }

    public function index(Request $request)
    {

        $items = $this->model->searchByQuery($request, null, null, null, true);
        $items = $items->where('user_id', 'LIKE', '%'.auth()->id().'%');
        $items = $items->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        return view('user.' . $this->prefixView . '.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $user = \auth()->user();
        return view('user.' . $this->prefixView . '.add', compact('user'));
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);

        Session::flash("success", "Submited");

        return redirect()->route('user.' . $this->prefixView . '.index');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        NotificationCustom::find($id)->update(['viewed' => 2]);
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
