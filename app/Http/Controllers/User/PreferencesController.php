<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletUser;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class PreferencesController extends Controller
{
    use BaseControllerTrait;

    public function __construct(WalletUser $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Payment Preferences";
        $current_user = User::where('id', Auth::id())->first();
        $items = $this->model->searchByQuery($request);
        return view('user.preferences_users.index', compact('items', 'title', 'current_user'));
    }

    public function create()
    {
        return view('user.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('user.' . $this->prefixView . '.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('user.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('user.news.edit', ['id' => $id]);
    }

    public function delete(Request $request, $id)
    {
        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
    }
}
