<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\AdsAdvertiser;
use App\Models\Advertise;
use App\Http\Controllers\Controller;
use App\Models\CampaignAd;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Setting;
use App\Models\TypeAdv;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class AdsController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Ads $model)
    {
        $this->initBaseModel($model);
        $this->title = "Campaign";
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $items = Helper::callGetHTTP("https://api.adsrv.net/v2/campaign") ?? [];

        $filtItems = [];

        $itemModels = [];

        foreach ($items as $item) {
            $myAd = $this->model->firstOrCreate([
                'ads_api_id' => $item['id'],
                'zone_api_id' => 0,
            ], [
                'ads_api_id' => $item['id'],
                'zone_api_id' => 0,
                'share' => optional(Setting::first())->percent,
            ]);

            $item['share'] = $myAd->share;
            $item['number_config'] = count($myAd->advertisers() ?? []);

            $filtItems[] = $item;
        }

        $items = Formatter::paginator($request, $filtItems);

        return view('administrator.' . $this->prefixView . '.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $advertisers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idcloudrole]=3") ?? [];
        $sites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=1000");

        return view('administrator.' . $this->prefixView . '.add', compact('advertisers', 'sites'));
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);

        if (is_array($item) && isset($item['errors'])) {
            Session::flash("error", json_encode($item));
            return back();
        }

        return redirect()->route('administrator.' . $this->prefixView . '.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {

        $item = $this->model->where('ads_api_id', $id)->orWhere('id', $id)->first();
        $zone = $item->zoneApi();
        $ads = $item->adApi();


        $advertisers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idcloudrole]=3") ?? [];

        return view('administrator.' . $this->prefixView . '.edit', compact('item', 'advertisers', 'zone', 'ads'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('administrator.' . $this->prefixView . '.edit', ['id' => $id]);
    }

    public function delete(Request $request, $id)
    {
        $item = $this->model->where('id', $id)->orWhere('ads_api_id', $id)->first();

        Helper::callDeleteHTTP("https://api.adsrv.net/v2/campaign/" . $item->ads_api_id);

        return $this->model->deleteByQuery($request, $item->id, $this->forceDelete);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function updateAdvertisers(Request $request, $id)
    {
        $params = [
            "geo" => $request->country,
            "device" => $request->devices,
            "os" => $request->os,
            "fc_counter" => $request->fc_counter,
            "fc_limit" => $request->fc_limit,
            "fc_interval" => $request->fc_interval,
            "fc_mode" => $request->fc_mode,
            'idadvertiser' => $request->advertiser_api_id,
            'rate' => $request->order ?? 0,
        ];

        Helper::callPutHTTP("https://api.adsrv.net/v2/campaign/" . $request->campaign_id, $params);

        if($request->typezone == 37){
            $params = [
                'details' => [
                    "bids" => $request->bids
                ],
            ];
        }elseif($request->typezone == 3){
            $params = [
                'details' => [
                    "content_html" => $request->content_html
                ],
            ];
        }

        Helper::callPutHTTP("https://api.adsrv.net/v2/ad/" . $request->ad_id, $params);

        optional(CampaignAd::where(['campaign_id' => $request->campaign_id, "ad_id" => $request->ad_id]))->update([
            'order' => $request->order ?? 0,
            'counter_percent' => $request->count_percent,
            'continent' => $request->continent_id,
        ]);

        return back();
    }

    public function updateZone(Request $request, $id)
    {
        $item = $this->model->find($id);

        $item->update([
            'share' => $request->share
        ]);

        Helper::callPutHTTP("https://api.adsrv.net/v2/zone/" . $item->zone_api_id, ['is_active' => $request->active]);

        return back();
    }

    public function storeZone(Request $request, $ads_id)
    {
        AdsAdvertiser::firstOrCreate([
            'ads_id' => $ads_id,
            'advertiser_api_id' => $request->advertiser_api_id,
            'count_percent' => $request->count_percent,
            'order' => $request->order,
            'ad_code' => $request->ad_code,
            'conditions' => $request->conditions,
        ]);

        return back();
    }
}
