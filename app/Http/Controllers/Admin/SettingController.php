<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class SettingController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Setting $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request);
        return view('administrator.'.$this->prefixView.'.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create(Request $request)
    {
        return view('administrator.'.$this->prefixView.'.add');
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('administrator.'.$this->prefixView.'.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {
        $item = $this->model->findById($id);
        return view('administrator.'.$this->prefixView.'.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->model->updateByQuery($id,$request);
        return back();
    }

    public function delete(Request $request, $id)
    {
        return $this->model->deleteByQuery($request, $id);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function editPercent()
    {
        $item = $this->model->first();
        return view('administrator.'.$this->prefixView.'.edit_percent', compact('item'));
    }

    public function updatePercent(Request $request, $id)
    {

        $request->validate([
            'percent' => 'required|numeric|min:1|max:100',
        ]);

        $this->model->first()->update([
            'percent' => $request->percent,
        ]);

        return back();
    }

    public function editAPI()
    {
        $item = $this->model->first();
        return view('administrator.'.$this->prefixView.'.edit_api', compact('item'));
    }

    public function updateAPI(Request $request, $id)
    {
        $this->model->first()->update([
            'token_api' => $request->token_api,
        ]);

        return back();
    }

    public function editAdsTxt()
    {
        $item = $this->model->first();
        return view('administrator.'.$this->prefixView.'.edit_ads_txt', compact('item'));
    }

    public function updateAdsTxt(Request $request, $id)
    {
        $this->model->first()->update([
            'ads_txt' => $request->ads_txt,
        ]);

        return back();
    }
}
