<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampaignAd;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\TypeCategory;
use App\Models\User;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\ZoneModel;
use App\Services\Common;
use App\Services\SiteService;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class WebsiteController extends Controller
{
    use BaseControllerTrait;


    public function __construct(Website $model)
    {
        $this->initBaseModel($model);
        $this->title = "Websites";
        $this->shareBaseModel($model);
        $this->siteService = new SiteService();
    }

    public function index(Request $request)
    {
        $categories = TypeCategory::all();

        if (isset($request->publisher_id) && !empty($request->publisher_id)){
            $items = Helper::callGetHTTP("https://api.adsrv.net/v2/site?filter[idpublisher]=".$request->publisher_id."&page=1&per-page=10000");
        }else{

            $items = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=10000");
        }

        $users = User::where('is_admin', 0)->get();

        $itemsFilter = [];

        foreach ($items as $item) {
            $isHave = false;
            foreach ($users as $itemUser){
                if ($item['publisher']['id'] == $itemUser->api_publisher_id) {
                    if (optional($itemUser->manager)->api_publisher_id == auth()->user()->api_publisher_id){
                        $isHave = true;
                    }
                }
            }
            if ($isHave){
                $itemsFilter[] = $item;
            }
        }

        // Comment tam phần này vì nó bị check quyền
//        if (auth()->user()->is_admin != 2){
//            $items = $itemsFilter;
//        }

        // List danh sách Dimensions
        $listDimensions = Common::DIMENSIONS;

        // list Dimensions Method
        $listDimensionsMethod = ZoneModel::DIMENSIONS_METHOD;

        // Lọc các website được ass mowis cho nhifn thaays
        if (auth()->user()->is_admin == 1 && auth()->user()->role->id == User::ROLE_PUBLISHER_MANAGER) {
            foreach ($items as $key=>$item)
            {
                $publisherInfo = User::where('api_publisher_id', $item['publisher']['id'])->first();
                if (empty($publisherInfo))
                    continue;

                if (empty($publisherInfo->getFirstUserAssign()) || (!empty($publisherInfo->getFirstUserAssign()->user_id) && $publisherInfo->getFirstUserAssign()->user_id != auth()->user()->id)) {
                    unset($items[$key]);
                }
            }
        }
        $items = Formatter::paginator($request,$items);

        $publishers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idcloudrole]=4");

        $listAssign = [];
        // Lấy danh sách được assign
        foreach ($items as $item)
        {
            $webSiteInfo = Website::where('api_site_id', $item['id'])->first();
            if (!empty($webSiteInfo))
            {
                $listAssign[$item['id']] = !empty($webSiteInfo->getInfoAssign()->name) ? $webSiteInfo->getInfoAssign()->name :  'chưa xác định';
            }
            else{
                $listAssign[$item['id']] = '';
            }

        }

        $dataResult = [
            'items' => $items,
            'categories' => $categories,
            'users' => $users,
            'listDimensions' => $listDimensions,
            'listDimensionsMethod' => $listDimensionsMethod,
            'publishers' => $publishers,
            'listAssign' => $listAssign
        ];
//        dd($dataResult);

        return view('administrator.' . $this->prefixView . '.index2', $dataResult);
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $publishers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idcloudrole]=4") ?? [];

        return view('administrator.' . $this->prefixView . '.add', compact('publishers'));
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);

        if (Helper::isErrorAPIAdserver($item)){
            Session::flash("error", $item);
            return back();
        }

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

    public function delete(Request $request)
    {
        $request = $request->all();
        $id = $request['id'];
        $sites = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite='.$id);
        foreach($sites as $key => $site){
            $items = Helper::callGetHTTP('https://api.adsrv.net/v2/campaign/?filter[name]'.$site['id']);
            foreach($items as $item){
//                Helper::callDeleteHTTP('https://api.adsrv.net/v2/campaign/'.$item['id']);
                $result = CampaignAd::where(['campaign_id' => $item['id']])->first();
                if (!empty($result)){
                    $result->forceDelete();
                }
            }
        }

        Helper::callDeleteHTTP("https://api.adsrv.net/v2/site/". $id);

        // Xoas site trong database
        Website::where('api_site_id', $id)->update(['is_delete' => 1]);

        return response()->json([
            'code'=>200,
            'message'=>'success',
        ],200);

       // return $this->model->deleteByQuery($request, $id, $this->forceDelete);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function listByPublisher(Request $request)
    {
        $request = $request->all();
        $id = $request['id'] ?? null;
        $dataSite = $this->siteService->listSiteByPublisher($id);
        $dataResult = [];
        foreach ($dataSite as $item)
        {
            $dataResult[$item['id']] = $item['name'];

        }
        return response()->json([
            'status' => true,
            'data' => $dataResult,
        ], 200);
    }
}
