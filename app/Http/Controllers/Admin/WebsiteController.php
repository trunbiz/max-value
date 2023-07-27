<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampaignAd;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\TypeCategory;
use App\Models\User;
use App\Models\Website;
use App\Http\Controllers\Controller;
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
    }

    public function index(Request $request)
    {
        $categories = TypeCategory::all();
        $query = $this->model;

        if(isset($_GET['user']) && !empty($_GET['user'])){
            $query = $query->where('user_id', $_GET['user']);
        }

        $items = $query->orderBy('id', 'DESC')->paginate(10);

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

        if (auth()->user()->is_admin != 2){
            $items = $itemsFilter;
        }


        $items = Formatter::paginator($request,$items);

        $publishers = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idcloudrole]=4");

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'categories', 'users','publishers'));
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

    public function delete(Request $request, $id)
    {

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
}
