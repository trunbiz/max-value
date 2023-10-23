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
use App\Services\Common;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        $title = "Websites & Zones";
        $current_user = User::where('id', Auth::id())->first();
        $items = Website::where('user_id', auth()->user()->id)->where('is_delete', 0)->get();
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
            // Lưu dữ lieu vao database
            Website::create([
                'user_id' => auth()->user()->id ?? 0,
                'name' => $item['name'],
                'url' => $item['url'],
                'category_website_id' => $item['category']['id'],
                'description' => '0',
                'status' => $item['status']['id'],
                'api_site_id' => $item['id'],
                'is_delete' => 0,
                'created_by' => auth()->user()->id,
            ]);

            // Sau khi user tạo 1 siet mới thì bắn mail về cho sale director và Admin
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
