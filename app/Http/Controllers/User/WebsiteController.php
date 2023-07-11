<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\User;
use App\Models\Website;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class WebsiteController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Website $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Websites";
        $current_user = User::where('id', Auth::id())->first();
//        $query = $this->model->where('user_id', Auth::id());
//
//        if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
//            $query = $query->where('name', 'LIKE', '%' . $_GET['search_query'] . '%');
//        }
//
//        if (isset($_GET['from']) && !empty($_GET['from'])) {
//            $query = $query->where('created_at', '>=', $_GET['from']);
//        }
//
//        if (isset($_GET['to']) && !empty($_GET['to'])) {
//            $query = $query->where('created_at', '<=', $_GET['to']);
//        }
//
//        if (isset($_GET['status']) && !empty($_GET['status'])) {
//            $query = $query->where('status', $_GET['status']);
//        }
//
//        $items = $query->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());
//
//        foreach ($items as $item) {
//            $item['stats'] = $item->getStatFromAPI(date("Y-m-d", Carbon::now()->startOfMonth()->timestamp), date("Y-m-d", Carbon::now()->endOfMonth()->timestamp));
//        }

        $items = Helper::callGetHTTP("https://api.adsrv.net/v2/site?" . "filter[idpublisher]=".auth()->user()->api_publisher_id."&page=1&per-page=1000");

        $items = Formatter::paginator($request,$items);

        return view('user.' . $this->prefixView . '.index', compact('items','title', 'current_user'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $title = "Create Website";
        return view('user.' . $this->prefixView . '.add',compact('title'));
    }

    public function store(Request $request)
    {
        $urls = Helper::callGetHTTP("https://api.adsrv.net/v2/site?filter[url]=".$request->url."&page=1&per-page=10000");
        if(!empty($urls)){
            return response()->json([
                'status' => false,
                'message' => 'URL is had already',
            ]);
        }else{
            $item = $this->model->storeByQuery($request);
            $status = $item['status']['name'];
            $category_name = $item['category']['iab'].': '.$item['category']['name'];
            return response()->json([
                'status' => true,
                'html' => view('user.websites.add_site', compact('status', 'category_name', 'item'))->render(),
            ]);
        }


        //return redirect()->route('user.' . $this->prefixView . '.index');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('user.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request)
    {
        //$item = $this->model->updateByQuery($request, $request->id);
        //return redirect()->route('user.' . $this->prefixView . '.edit', ['id' => $id]);
        $dataUpdates = [
            'name' => $request->name,
            'idcategory' => $request->idcategory,
            'url' => $request->url,
        ];
        $item = Helper::callPutHTTP("https://api.adsrv.net/v2/site/". $request->id, $dataUpdates);
        $item['category_name'] = $item['category']['iab'].': '.$item['category']['name'];
        return $item;
    }

    public function delete(Request $request, $id)
    {

        Helper::callDeleteHTTP("https://api.adsrv.net/v2/site/". $id);

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
}
