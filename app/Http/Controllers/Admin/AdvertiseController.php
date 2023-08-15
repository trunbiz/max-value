<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdsAdvertiser;
use App\Models\AdsCampaignModel;
use App\Models\Advertise;
use App\Http\Controllers\Controller;
use App\Models\AssignUserModel;
use App\Models\CampaignAd;
use App\Models\CampaignModel;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\National;
use App\Models\TypeAdv;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneModel;
use App\Services\AssignUserService;
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
        $this->commonService = new Common();
        $this->assignUserService = new AssignUserService();
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
        $item = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $id);;
        $sites = Helper::callGetHTTP("https://api.adsrv.net/v2/site/" . $item['site']['id']);
        $advertisers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=3");

        // Lấy thông tin Campaign có trong DB
        $zoneInfo = ZoneModel::where('ad_zone_id', $id)->where('is_delete', Common::NOT_DELETE)->first();
        $listCampaigns = $zoneInfo->getInfoCampaign ?? [];

        $campaigns = [];
        foreach ($listCampaigns as $campaign) {
            $campaigns[] = [
                'campaign' => array_merge(json_decode($campaign->extra_request, true) ?? [], [
                    'ad_campaign_id' => $campaign->ad_campaign_id,
                    'id' => $campaign->id,
                ]),
                'ads' => array_merge(json_decode($campaign->getAds->extra_response, true) ?? [], [
                    'ad_ad_id' => $campaign->getAds->ad_ad_id,
                    'id' => $campaign->getAds->id,
                    'zone_id' => $campaign->getAds->zone_id,
                    'campaign_id' => $campaign->getAds->campaign_id,
                ])
            ];
        }
        $dataResult = [
            'item' => $item,
            'zoneInfo' => $zoneInfo,
            'listUserGroupAdmin' => $this->commonService->listUserGroupAdmin(),
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
            'listGeos' => Common::LIST_GEOS,
        ];

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
        $paramsRequest = $request->all();
        $params = [
            "name" => $request->name,
        ];

        $zoneInfo = ZoneModel::where('ad_zone_id', $id)->first();

        // Update assign user
        if (!empty($zoneInfo) && !empty($paramsRequest['assign_user']))
        {
            $this->assignUserService->saveAssignUser(AssignUserModel::TYPE['ZONE'], $zoneInfo->id, $paramsRequest['assign_user'], auth()->user()->id ?? '0');
        }

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
