<?php

namespace App\Http\Controllers\User;

use App\Models\Advertise;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Setting;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class AdvertiseController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Advertise $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $adsTxt = File::get(public_path('../../public_html/ads.txt'));
        return view('publisher.ads.index', compact('adsTxt'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $title = "Create Zone";
        $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?" . "filter[idpublisher]=".auth()->user()->api_publisher_id."&page=1&per-page=1000");

        return view('user.' . $this->prefixView . '.add', compact('title','websites'));
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);

        if (auth()->user()->is_admin != 0){
            return redirect()->route('administrator.websites.index');
        }

        return redirect()->route('user.websites.index');
    }

    public function edit($id)
    {
        $title = "Detail Zone";

        $params = [
            'query' => [
                'dateBegin' =>  date("Y-m-d", Carbon::now()->startOfMonth()->timestamp),
                'dateEnd' => date("Y-m-d", Carbon::now()->endOfMonth()->timestamp),
                'idzone' => $id,
            ]
        ];

        $stat = Helper::callGetHTTP('https://api.adsrv.net/v2/stats',  $params);

        $item = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/". $id);

        return view('user.' . $this->prefixView . '.edit', compact('item','stat','title'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('user.' . $this->prefixView . '.edit', ['id' => $id]);
    }

    public function delete(Request $request, $id)
    {
        Helper::callDeleteHTTP("https://api.adsrv.net/v2/zone/". $id);

        return response()->json([
            'code'=>200,
            'message'=>'success',
        ],200);

//        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }



    public function downloadTxt(Request $request)
    {
//
//        $items = User::where('partner_code', '!=', '')->get();
//        foreach($items as $key => $item){
//            $ads_txt[$key] = $item->partner_code;
//        }

        return response(File::get(public_path('../../public_html/ads.txt')))
            ->withHeaders([
                'Content-Type' => 'text/plain',
                'Cache-Control' => 'no-store, no-cache',
                'Content-Disposition' => 'attachment; filename="ads.txt',
            ]);

    }

}

