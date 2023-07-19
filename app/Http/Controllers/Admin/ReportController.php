<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertise;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\ReportModel;
use App\Models\User;
use App\Models\Website;
use App\Services\ReportService;
use App\Services\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class ReportController extends Controller
{
    use BaseControllerTrait;
    protected $reportService;
    protected $walletService;

    public function __construct(Advertise $model)
    {
        $this->initBaseModel($model);

        $this->prefixView = "reports";

        $this->shareBaseModel($model);
        $this->reportService = new ReportService();
        $this->walletService = new WalletService();
    }

    public function index(Request $request)
    {

        $request->limit = 100000;
        $title = "Report";
        $websites = auth()->user()->userWeb;

        $zonesActive = [];

        if (isset($request->website_id) && !empty($request->website_id)) {
            $website = Website::where('api_site_id', $request->website_id)->first();

            if (!empty($website)){
                $zonesActive = Advertise::where(['adverser_status_id'=> 2,'website_id' => $website->id])->get();
            }
        }else{
            $zonesActive = auth()->user()->zonesAvtive;
        }

        $dateBegin = date("Y-m-d", Carbon::now()->startOfMonth()->timestamp);
        $dateEnd = date("Y-m-d", Carbon::now()->endOfMonth()->timestamp);

        if (isset($request->from) && !empty($request->from)) {
            $dateBegin = $request->from . " 00:00";
        }

        if (isset($request->to) && !empty($request->to)) {
            $dateEnd = $request->to . " 23:59";
        }

        $query = [
            'dateBegin' => $dateBegin,
            'dateEnd' => $dateEnd,
        ];

        if (isset($request->user_id) && !empty($request->user_id)) {
            $query['idpublisher'] = $request->user_id;
            $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?" . "filter[idpublisher]=".$request->user_id."&page=1&per-page=1000");
        }else{
            $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=1000");
        }


        $zones = [];
        if (isset($request->website_id) && !empty($request->website_id)) {
            $query['idsite'] = !empty($request->website_id) ? $request->website_id : 1;

            $zones = Helper::callGetHTTP("https://api.adsrv.net/v2/zone?idsite=" . $query['idsite']) ?? [];

        }

        if (isset($request->zone_id) && !empty($request->zone_id)) {
            $query['idzone'] = !empty($request->zone_id) ? $request->zone_id : 1;
        }

        $query = [
            'query' => $query
        ];

        $totalCPM = $CPMavr = 0;
        $items = Helper::callGetHTTP("https://api.adsrv.net/v2/stats", $query);
        foreach($items as $key => $item){
            $totalCPM += $item['cpm'];
        }
        $countCPM = count($items);
        if($countCPM > 0){
            $CPMavr = $totalCPM / $countCPM;
        }
        $items = Formatter::paginator($request, $items);



        $users = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=4") ?? [];
        $adversier = Helper::callGetHTTP('https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=3');

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'websites', 'zones','title','users', 'CPMavr', 'adversier'));
    }

    public function updateReport(Request $request)
    {
        $request = $request->all();

        $query = ReportModel::query();
        if (!empty($request['user_id']))
        {
            $query->where('publisher_id', $request['user_id']);
        }
        if (!empty($request['website_id']))
        {
            $query->where('web_id', $request['website_id']);
        }
        if (!empty($request['from']))
        {
            $query->where('date', '>=',$request['from']);
        }
        if (!empty($request['to']))
        {
            $query->where('date', '<=',$request['to']);
        }
        $data['items'] = $query->orderBy('date', 'DESC')->paginate(25);

        if (isset($request->user_id) && !empty($request->user_id)) {
            $query['idpublisher'] = $request->user_id;
            $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?" . "filter[idpublisher]=".$request->user_id."&page=1&per-page=1000");
        }else{
            $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=1000");
        }

        $zones = [];
        if (isset($request->website_id) && !empty($request->website_id)) {
            $query['idsite'] = !empty($request->website_id) ? $request->website_id : 1;

            $zones = Helper::callGetHTTP("https://api.adsrv.net/v2/zone?idsite=" . $query['idsite']) ?? [];

        }
        foreach ($data['items'] as $item) {
            if ($item->status) {
                $item->change_count = $item->impressions == 0 ? 80: round((($item->change_impressions) * 100) / $item->impressions);
                $item->change_share = ($item->change_impressions * $item->cpm) == 0 ? 70 : round(($item->change_revenue * 1000 * 100) / ($item->change_impressions * $item->cpm));
            } else {
                $item->change_count = 80;
                $item->change_share = 70;
            }
            $item->revenue = round($item->revenue, 2);
        }
        $data['title'] = "Report";
        $data['websites'] = $websites;
        $data['zones'] = $zones;
        $data['users'] = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=4") ?? [];
        $data['adversier'] = Helper::callGetHTTP('https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=3');

        return view('administrator.reports.updateReport', $data);
    }

    public function updateItemReport(Request $request)
    {
        $request = $request->all();
        $type = $request['type'] ?? null;
        $reportInfo = ReportModel::find($request['id']);
        if (!empty($type) && $type == 'UPDATE')
        {
            $reportInfo->impressions = $request['c_impressions'];
            $reportInfo->cpm = $request['c_cpm'];
            $reportInfo->revenue = round($request['c_impressions'] / 1000 * $request['c_cpm'], 3);
            $reportInfo->save();
        }
        else{
            // Chỉ cho cập nhật 1 lần
            if ($reportInfo->status == ReportModel::STATUS_SUCCESS)
                return false;

            $reportInfo->change_impressions = $request['change_impressions'];
            $reportInfo->change_revenue = $request['change_revenue'];
            $reportInfo->change_cpm = $request['change_cpm'];
            $reportInfo->status = 1;
            $reportInfo->save();

            // Sau khi cập nhật xong thì số tiền sẽ được cộng vào ví user
            $this->walletService->depositWalletPublisher($reportInfo->publisher_id, $reportInfo->change_revenue);
        }
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
        $item = $this->model->storeByQuery($request);
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
        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
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
