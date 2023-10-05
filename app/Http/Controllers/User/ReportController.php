<?php

namespace App\Http\Controllers\User;

use App\Exports\ReportExport;
use App\Models\Advertise;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\ReportModel;
use App\Models\User;
use App\Models\Website;
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

    public function __construct(Advertise $model)
    {
        $this->initBaseModel($model);

        $this->prefixView = "reports";

        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $title = "Report";

        $now = Carbon::now()->addDays();
//
        $dateStartOfWeek = $now->startOfWeek()->format('Y-m-d');
        $dateEndOfWeek = $now->endOfWeek()->format('Y-m-d');

        $params = [
            'query' => [
                'dateBegin' => $request->begin ?? $dateStartOfWeek,
                'dateEnd' => $request->end ?? $dateEndOfWeek,
                'idpublisher' => \auth()->user()->api_publisher_id,
            ]
        ];
        $query = ReportModel::where('date', '>=', $params['query']['dateBegin'])->where('date', '<=', $params['query']['dateEnd'])
            ->where('publisher_id', $params['query']['idpublisher'])->where('status', ReportModel::STATUS_SUCCESS);

        $stats = $query->get();
//        $sum = $query->selectRaw('SUM(impressions), SUM(cpm)')->first();

//        $stats = Helper::callGetHTTP("https://api.adsrv.net/v2/stats", $params);

//        dd( $params, $stats, $sum);
        $days = [];
        $impressions = [];
        $earnings = [];
        $sumNumber = [
            'amountPub' => 0,
            'impressions' => 0,
            'cpm' => 0,
        ];

        // Lấy danh sách website
        $websites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=1000");

        // Lấy list danh sách zone
        $listZone = [];
        $listWebsite = [];
        foreach ($websites as $website)
        {
            $listWebsite[$website['id']] = $website['name'];

            if (empty($website['zones']))
                continue;
            foreach ($website['zones'] as $zone)
            {
                $listZone[$zone['id']] = $zone['name'] ?? '';
            }
        }

        foreach ($stats as $index => $itemStat){
            $stats[$index]['impressions'] = $itemStat['change_impressions'];
            $stats[$index]['amountPub'] = round($itemStat['change_revenue'], 2);
            $stats[$index]['impressions'] = $itemStat['change_impressions'];
            $stats[$index]['cpm'] = round($itemStat['change_cpm'], 3);
            $stats[$index]['website'] = $listWebsite[$itemStat->web_id] ?? '';
            $stats[$index]['zone'] = $listZone[$itemStat->zone_id] ?? '';

            // Tổng hợp số
            $sumNumber['amountPub'] += round($itemStat['change_revenue'], 2);
            $sumNumber['impressions'] += $itemStat['change_impressions'];
            $sumNumber['cpm'] += $itemStat['change_cpm'];

            $days[] = $itemStat['date'];
            $impressions[] = $stats[$index]['impressions'];
            $earnings[] = $stats[$index]['amountPub'];
        }

        $sumNumber['cpm'] = count($stats) == 0 ? 0 : round(($sumNumber['cpm'] / count($stats)), 3);

        return view('user.' . $this->prefixView . '.index', compact('title', 'stats','days','impressions','earnings', 'sumNumber'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        return view('user.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('user.' . $this->prefixView . '.index');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('user.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('user.' . $this->prefixView . '.edit', ['id' => $id]);
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
        $request = $request->all();
        return Excel::download(new ReportExport($request), $this->prefixView. '_' . time() . '.xlsx');
    }
}
