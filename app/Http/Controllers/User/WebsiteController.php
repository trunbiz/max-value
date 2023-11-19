<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Mail\MailNotiUserNew;
use App\Mail\UserSiteNew;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\User;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\ZoneModel;
use App\Repositories\National\NationalRepositoryInterface;
use App\Services\Common;
use App\Services\SiteService;
use App\Services\ZoneService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class WebsiteController extends Controller
{
    use BaseControllerTrait;

    protected $siteService;
    protected $zoneService;
    protected $nationalRepo;

    public function __construct(Website $model, NationalRepositoryInterface $nationalRepo)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
        $this->siteService = new SiteService();
        $this->zoneService = new ZoneService();
        $this->nationalRepo = $nationalRepo;
    }

    public function index(Request $request)
    {
        $data['items'] = $this->siteService->listWebsiteByUser(Auth::id());
        $data['current_user'] = Auth::user();
        $data['totalSite'] = $this->siteService->totalSite(null, $listSiteId, [Auth::user()->id]);
        $data['geos'] = $this->nationalRepo->getAll();

        if (empty($listSiteId))
        {
            $listSiteId = [-1];
        }
        // Tổng zone
        $data['totalZone'] = $this->zoneService->totalZone(null, $listSiteId);
        $data['totalZonePending'] = $this->zoneService->totalZone(['status' => ZoneModel::PENDING], $listSiteId);

        $data['groupDimensions'] = Common::DIMENSIONS_GROUP;
        return view('publisher.website.index', $data);
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
            if (empty($request->url) || empty($request->idcategory))
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Missing parameters',
                ]);
            }

            $params = [
                "url" => $request->url,
                "idcategory" => $request->idcategory,
                "idpublisher" => auth()->user()->api_publisher_id,
                "idstatus" => 3520,
            ];

            $item = Helper::callPostHTTP("https://api.adsrv.net/v2/site", $params);

            if (empty($item['id']))
            {
                Log::error('publisher create site', ['item' => $item, 'params' => $params]);
                return response()->json([
                    'status' => false,
                    'message' => 'The system created the site error',
                ]);
            }

            $dataInfo = [
                'user_id' => auth()->user()->id ?? 0,
                'name' => $item['name'],
                'url' => $item['url'],
                'category_website_id' => $item['category']['id'],
                'description' => '0',
                'status' => $item['status']['id'],
                'api_site_id' => $item['id'],
                'publisher_report_impression' => $request->get('impression', null),
                'publisher_report_geo' => $request->get('geo', null),
                'is_delete' => 0,
                'created_by' => auth()->user()->id,
            ];

            if($request->hasFile('file_report')){
                $dataInfo['publisher_report_file'] = Storage::putFile('files', $request->file('file_report'));
            }

            // Lưu dữ lieu vao database
            $infoWebsite = Website::create($dataInfo);

            // Sau khi user tạo 1 site mới thì bắn mail về cho sale director và Admin
            $userAdminAndSale = User::where('role_id', [1, 4])->where('active', Common::ACTIVE)->get();
            foreach ($userAdminAndSale as $adminSale)
            {
                if (!filter_var($adminSale->email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

                $formEmail = [
                    'userAdmin' => $adminSale->name,
                    'name' => $item['name'] ?? '0',
                    'url' => $item['url'] ?? '0',
                    'created_at' => Carbon::now()->format('Y-m-d hH:i:s'),
                ];
                try {
                    Mail::to($adminSale->email)->send(new UserSiteNew($formEmail));
                }catch (\Exception $e)
                {

                }
            }

            if (Helper::isErrorAPIAdserver($item)){
                return response()->json($item, 400);
            }

            $status = $item['status']['name'];
            $category_name = $item['category']['iab'].': '.$item['category']['name'];
            return response()->json([
                'status' => true,
                'message' => 'create website success',
                'data' => $infoWebsite,
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
