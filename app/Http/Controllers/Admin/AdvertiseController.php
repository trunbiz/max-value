<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdsAdvertiser;
use App\Models\Advertise;
use App\Http\Controllers\Controller;
use App\Models\CampaignAd;
use App\Models\CampaignModel;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\National;
use App\Models\TypeAdv;
use App\Models\User;
use App\Models\Website;
use App\Services\Common;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class AdvertiseController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Advertise $model)
    {
        $this->initBaseModel($model);
        $this->title = "Zone";
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {

        $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=10000");
        $publishers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=4");

        $items = [];
        if (isset($request->website_id) && !empty($request->website_id)) {
            $items = Helper::callGetHTTP("https://api.adsrv.net/v2/zone?idsite=" . $request->website_id);
        }else{
            $lastes_site = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=5");
            foreach($lastes_site as $key => $value){
                $items[$key] = Helper::callGetHTTP("https://api.adsrv.net/v2/zone?idsite=" . $value['id']);
            }
            $reults = [];
            foreach ($items as $item){

                foreach ($item as $i){
                    $reults[] = $i;
                }
            }
            $items = $reults;
        }

        $items = Formatter::paginator($request, $items);

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'websites', 'publishers'));
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
        return back();
//        return redirect()->route('administrator.' . $this->prefixView . '.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {
        $title = "Detail Zone";

        $params = [
            'query' => [
                'dateBegin' => date("Y-m-d", Carbon::now()->startOfMonth()->timestamp),
                'dateEnd' => date("Y-m-d", Carbon::now()->endOfMonth()->timestamp),
                'idzone' => $id,
            ]
        ];

        $stat = Helper::callGetHTTP('https://api.adsrv.net/v2/stats', $params);

        $item = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $id);

        return view('administrator.' . $this->prefixView . '.edit', compact('item', 'stat', 'title'));
    }

    public function indexDetail($id)
    {
        $title = "Detail Zone";

        // $id là zone id

        $countries = National::orderby('name', 'ASC')->get();
        $item = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $id);

//        dd($id, $item);
        $sites = Helper::callGetHTTP("https://api.adsrv.net/v2/site/" . $item['site']['id']);
        $campaigns = [];

        foreach ($item['assigned_ads'] as $itemAd){
            $campaign = Helper::callGetHTTP("https://api.adsrv.net/v2/campaign/" . $itemAd['idcampaign']);
            if (!Helper::isErrorAPIAdserver($campaign)){

                $campaignAd = CampaignAd::firstOrCreate([
                    'campaign_id' => $campaign['id'],
                    'ad_id' => $itemAd['id'],
                ],[
                    'campaign_id' => $campaign['id'],
                    'ad_id' => $itemAd['id'],
                    'counter_percent' => 80
                ]);

                $campaign['counter_percent'] = $campaignAd['counter_percent'];
                $campaign['order'] = $campaignAd['order'];
                $campaign['ad_id'] = $itemAd['id'];
                $campaign['continent'] = $campaignAd['continent'];

                $fc_counter = 0;
                $fc_limit = 0;
                $fc_interval = 0;
                $fc_mode = 0;

                if (!empty($campaign['frequency_capping'])){
                    if (str_contains($campaign['frequency_capping'], "imp")){
                        $fc_counter = 1;
                    }else{
                        $fc_counter = 2;
                    }

                    if (str_contains($campaign['frequency_capping'], "Visitor")){
                        $fc_mode = 1;
                    }else{
                        $fc_mode = 2;
                    }

                    $values = explode( " ", $campaign['frequency_capping']);
                    $fc_limit = $values[0];

                    $fc_interval = $campaign['frequency_capping'];
                }

                $campaign['infor_frequency_capping'] = [
                    'fc_counter' => $fc_counter,
                    'fc_limit' => $fc_limit,
                    'fc_interval' => $fc_interval,
                    'fc_mode' => $fc_mode,
                ];

                $campaigns[] = $campaign;

            }
        }

        $campaigns = collect($campaigns)->sortBy('order')->toArray();

        foreach ($campaigns as $index => $itemCampaign){

            foreach ($itemCampaign['ads'] as $itemAds){
                $campaigns[$index]['ad_infor'] = Helper::callGetHTTP("https://api.adsrv.net/v2/ad/" . $itemAds['id']);
                break;
            }
        }

        $advertisers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=3");

        $dataResult = [
            'item' => $item,
            'campaigns' => $campaigns,
            'countries' => $countries,
            'advertisers' => $advertisers,
            'site' => $sites,
            'status' => CampaignModel::STATUS,
            'target_mode' => Common::TARGET_MODE,
            'device' => Common::DEVICE,
            'brows' => Common::BROWSER,
            'dimensions' => Common::DIMENSIONS,
            'injectionType' => Common::INJECTION_TYPE,
            'listExtLabelPos' => Common::EXT_LABEL_POST,
            'listExtMenuPos' => Common::EXT_MENU_POST,
            'listExtBrandPos' => Common::EXT_BRAND_POST,
        ];

//        dd($dataResult);

        return view('administrator.' . $this->prefixView . '.detail', $dataResult);
    }

    public function storeDetailConfig(Request $request, $id)
    {
        $zone = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/". $id);
        $params = [
            "idadvertiser" => $request->idadvertiser,
            'name' => $id,
            "geo" => $request->country,
            "device" => $request->devices,
            "os" => $request->os,
            "fc_counter" => $request->fc_counter,
            "fc_limit" => $request->fc_limit,
            "fc_interval" => $request->fc_interval,
            "fc_mode" => $request->fc_mode,
            "rate" => $request->order ?? 0,
        ];

        $campaign = Helper::callPostHTTP("https://api.adsrv.net/v2/campaign", $params);


        if (is_array($campaign) && isset($campaign['errors'])) {
            Session::flash("error", json_encode($item));
            return back();
        }

        if($request->typezone == 37){
            $params = [
                "idcampaign" => $campaign['id'],
                "details" => [
                    "iddimension" => $zone['dimension']['id'],
                    "lib_ver" => "v7",
                    "bids" => $request->bids,
                ],
            ];
        }elseif($request->typezone == 3){
            $params = [
                "idcampaign" => $campaign['id'],
                "details" => [
                    "iddimension" => $zone['dimension']['id'],
                    "lib_ver" => "v7",
                    "content_html" => $request->content_html,
                ],
            ];
        }

        $ad = Helper::callPostHTTP("https://api.adsrv.net/v2/ad?idformat=".$request->typezone, $params);

        if (is_array($ad) && isset($ad['errors'])) {
            Helper::callDeleteHTTP("https://api.adsrv.net/v2/campaign/" . $campaign['id']);
            Session::flash("error", json_encode($ad));
            return back();
        }

        $params = [
            "zones" => [$id],
        ];

        //assign
        Helper::callPostHTTP("https://api.adsrv.net/v2/ad/assign?id=" . $ad['id'], $params);

        CampaignAd::firstOrCreate([
            'campaign_id' => $campaign['id'],
            'ad_id' => $ad['id'],
        ],[
            'campaign_id' => $campaign['id'],
            'ad_id' => $ad['id'],
            'counter_percent' => $request->count_percent,
            'order' => $request->order ?? 0,
            'continent' => $request->continent_id,
        ]);

        return back();
    }

    public function updateDetailZone(Request $request, $id)
    {
        $params = [
            "name" => $request->name,
            "revenue_rate" => $request->share,
        ];

        Helper::callPutHTTP("https://api.adsrv.net/v2/zone/" . $id, $params);
        return back();
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('administrator.' . $this->prefixView . '.edit', ['id' => $id]);
    }

    public function delete(Request $request, $id)
    {

        Helper::callDeleteHTTP("https://api.adsrv.net/v2/zone/" . $id);

        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);

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

    public function getNational(Request $request){
        $continent_id = $request->id;
       if($request->id == 0 || $request->id == 7){
           $countries = National::orderby('name', 'ASC')->get();
       }else{
           $countries = National::orderby('name', 'ASC')->where('continent', $continent_id)->get();
       }

       return response()->json([
           'html' => view('administrator.'.$this->prefixView.'.get_national', compact('countries'))->render(),
           'continent_id' => $continent_id,
       ]);
    }

    public function getTypeZone(Request $request){
        if($request->id == 3){
            $label = 'HTML/JS';
            $name = 'content_html';
        }elseif($request->id == 37){
            $label = 'Prebid';
            $name = 'bids';
        }
        return response()->json([
            'html' => view('administrator.'.$this->prefixView.'.textarea', compact('label', 'name'))->render(),
        ]);
    }
}
