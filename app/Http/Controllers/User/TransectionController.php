<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Models\Formatter;
use App\Models\TransectionUser;
use App\Models\User;
use App\Models\WalletUser;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\WithdrawUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class TransectionController extends Controller
{
    use BaseControllerTrait;

    public function __construct(TransectionUser $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Transections";
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
        $user = \auth()->user();
        return view('user.' . $this->prefixView . '.add', compact('user'));
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('user.' . $this->prefixView . '.index');
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
