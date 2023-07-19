<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportWallet;
use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\JobEmail;
use App\Models\WalletUser;
use App\Models\WithdrawUser;
use App\Services\WalletService;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class WalletController extends Controller
{
    use BaseControllerTrait;

    public function __construct(WithdrawUser $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = 'Wallet';
        $queries = [];
        $items = $this->model->searchByQuery($request, $queries);

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'title'));
    }
    public function depositWalletPublisher(Request $request)
    {
        $walletService = new WalletService();
        $walletService->calculateRevenue();
        return true;
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
        foreach ($request->user_ids as $id) {
            $request->id = $id;
            $this->model->storeByQuery($request);
        }

        return back();
    }

    public function edit(Request $request)
    {
        $item = $this->model->find($request->id);
        return response()->json([
            'html' => view('administrator.' . $this->prefixView . '.edit', compact('item'))->render()
        ]);
    }

    public function update(Request $request)
    {
        $withdrawUser = WithdrawUser::find($request->id);
        if ($withdrawUser->status != 1)
        {
            return response()->json([
                'status' => false,
                'messsage' => 'Status unkinow',
                'html' => view('administrator.' . $this->prefixView . '.table', compact('item', 'position'))->render()
            ]);
        }

        $item = $this->model->updateByQuery($request, $request->id);
        $position = $request->position;
        return response()->json([
            'status' => true,
            'messsage' => 'Update Successful',
            'html' => view('administrator.' . $this->prefixView . '.table', compact('item', 'position'))->render()
        ]);
    }

    public function delete(Request $request, $id)
    {
        $this->forceDelete = true;
        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ExportWallet(), 'wallet.xlsx');
    }

}
