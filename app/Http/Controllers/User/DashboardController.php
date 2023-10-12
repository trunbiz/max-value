<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\User;
use App\Models\Website;
use App\Models\WithdrawUser;
use App\Models\ZoneModel;
use App\Services\CampaignService;
use App\Services\Common;
use App\Services\ReportService;
use App\Services\SiteService;
use App\Services\WalletService;
use App\Services\ZoneService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $reportService;
    protected $siteService;
    protected $zoneService;
    protected $walletService;
    protected $commonService;
    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->siteService = new SiteService();
        $this->zoneService = new ZoneService();
        $this->walletService = new WalletService();
        $this->commonService = new Common();
    }

    public function index(Request $request){
        $request = $request->all();
        $dateOption = $request['date_option'] ?? 'SUB_7';
        $sort = $request['sort'] ?? 'DESC';
        $titleFilter = '';
        if(auth()->check()){
            $dateNow = Carbon::now()->format('Y-m-d');
            switch ($dateOption) {
                case 'YESTERDAY':
                    $startDate = Carbon::now()->yesterday()->format('Y-m-d');
                    $endDate = Carbon::now()->yesterday()->format('Y-m-d');
                    $titleFilter = 'yesterday';
                    break;
                case 'SUB_2':
                    $startDate = Carbon::now()->subDays(2)->format('Y-m-d');
                    $endDate = $dateNow;
                    $titleFilter = 'last 2 day';
                    break;
                case 'SUB_3':
                    $startDate = Carbon::now()->subDays(3)->format('Y-m-d');
                    $endDate = $dateNow;
                    $titleFilter = 'last 3 day';
                    break;
                case 'SUB_7':
                    $startDate = Carbon::now()->subDays(7)->format('Y-m-d');
                    $endDate = $dateNow;
                    $titleFilter = 'last 7 day';
                    break;
                case 'SUB_THIS_MONTH':
                    $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                    $endDate = $dateNow;
                    $titleFilter = 'this month';
                    break;
                case 'SUB_LAST_MONTH':
                    $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                    $endDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                    $titleFilter = 'last month';
                    break;
                case 'ALL':
                    $startDate = null;
                    $endDate = null;
                    break;
            }

            $data = [
                'title' => 'Dashboard',
                'titleFilter' => $titleFilter,
                'fileNameExport' => 'Maxvalue_' . date_format(new \DateTime($startDate), 'm-d-Y') . '_' . date_format(new \DateTime($endDate), 'm-d-Y')
            ];
            $data['totalReport'] = $this->reportService->totalReportAccept($startDate, $endDate, [Auth::user()->api_publisher_id]);

            // Lấy thông tin site và zone

            // Tổng Site
            $data['totalSite'] = $this->siteService->totalSite(null, $listSiteId, [Auth::user()->id]);

            if (empty($listSiteId))
            {
                $listSiteId = [-1];
            }

            // Lấy danh sách site và zone hiện thị ở filter
            $data['websites'] = $this->siteService->listSiteByApiSiteId($listSiteId);
            $data['zones'] = $this->zoneService->listZoneByApiSiteId($listSiteId);

            // Tổng zone
            $data['totalZone'] = $this->zoneService->totalZone(null, $listSiteId);
            $data['totalZonePending'] = $this->zoneService->totalZone(['status' => ZoneModel::PENDING], $listSiteId);

            // Lấy thông tin withdraw user
            $withdrawInfo = $this->walletService->getInfoWithdrawUser(Auth::user()->id);

            $data['wallet']['withdrawn'] = 0;
            $data['wallet']['available'] = Auth::user()->money;
            $data['wallet']['pending'] = 0;
            $data['wallet']['rejected'] = 0;
            foreach ($withdrawInfo as $itemWithdraw)
            {
                if ($itemWithdraw->withdrawStatus == WithdrawUser::STATUS_PENDING)
                {
                    $data['wallet']['pending'] += $itemWithdraw->totalAmount ?? 0;
                }
                elseif ($itemWithdraw->withdrawStatus == WithdrawUser::STATUS_APPROVED){
                    $data['wallet']['withdrawn'] += $itemWithdraw->totalAmount ?? 0;
                }
                elseif ($itemWithdraw->withdrawStatus == WithdrawUser::STATUS_REJECT){
                    $data['wallet']['rejected'] += $itemWithdraw->totalAmount ?? 0;
                }
            }

            $data['wallet']['totalEarning'] = $data['wallet']['withdrawn'] + $data['wallet']['available'] + $data['wallet']['pending'] + $data['wallet']['rejected'];

            // Chuyển đổi chuỗi thành đối tượng Carbon
            $startD = Carbon::parse($startDate);
            $endD = Carbon::parse($endDate);
            // Tạo một mảng để lưu trữ các ngày
            $dateRange = [];
            // Lặp qua từng ngày trong khoảng thời gian
            $currentDate = $startD->copy();
            while ($currentDate->lte($endD)) {
                $dateRange[] = $currentDate->format('Y-m-d');
                $currentDate->addDay();
            }

            if (!empty($request['date_range']) || !empty($request['website_id']) || !empty($request['zone_id']))
            {
                $dateSearch = explode(" - ", $request['date_range']);
                // Lấy thông tin show bảng
                $data['items'] = $this->reportService->getDataReportBySite($listSiteId, $dateSearch[0] ?? null, $dateSearch[1] ?? null, $sort, $request);
                $data['countItem'] = $this->reportService->countDataReportBySite($listSiteId, $dateSearch[0] ?? null, $dateSearch[1] ?? null, $sort, $request);
            }
            else{
                $data['items'] = new Collection();
                $data['countItem'] = new Collection();
            }


            // Lấy thông tin geo traffic
            $data['listCountryTraffic'] = $this->reportService->getDataTrafficCountry($listSiteId, $startDate, $endDate);
            $data['totalCountryTraffic'] = $this->reportService->countTrafficCountry($listSiteId, $startDate, $endDate)->total_impressions ?? 0;


            $data['listMapCountryTraffic'] = [];
            foreach ($data['listCountryTraffic'] as $key => $itemCountry)
            {
                $data['listMapCountryTraffic'][$itemCountry->code] = Common::CODE_COLOR[$key];
            }

            // Lấy thông tin reports
            $dataReport = [];
            $infoReportBySite = $this->reportService->getDataReportGroupSite($listSiteId, $startDate, $endDate);
            $revenueByDate = [];

            $chart = [];
            $dateShow = [];
            foreach ($infoReportBySite as $report)
            {
                // Lấy các giá trị ngày
                $dateShow[$report->date] = $report->date;

                if (isset($revenueByDate[$report->date]))
                {
                    $revenueByDate[$report->date] += round($report->total_change_revenue ?? 0, 2);
                }
                else{
                    $revenueByDate[$report->date] = round($report->total_change_revenue ?? 0, 2);
                }
                $dataReport[$report->name][$report->date] = round($report->total_change_revenue ?? 0, 2);
            }


            // Nếu chọn all time thi lay date theo query
            if (empty($startDate) && empty($endDate))
            {
                $dateRange = array_values($dateShow);
            }
            $dataReportDay = [];

            // bieu do theo ngay
            foreach ($dateRange as $keyDate => $date) {
                if (!isset($revenueByDate[$date])) {
                    unset($dateRange[$keyDate]);
                    continue;
                }
                $dataReportDay[$date] = round($revenueByDate[$date] ?? 0, 2);
            }

            $chartData = [];
            // Convert sang bieu do
            foreach ($dataReport as $url => $itemReport) {
                $chartData[$url] = [
                    'name' => $url,
                    'type' => 'column',
                    'data' => []
                ];
                foreach ($dateRange as $date) {
                    $chartData[$url]['data'][$date] = round($itemReport[$date] ?? 0, 2);
                }
                $chartData[$url]['data'] = array_values($chartData[$url]['data']);
            }
            $chartData = array_values($chartData);

            // Mer revenue line
            array_unshift($chartData, [
                'name' => 'Total revenue',
                'type' => 'line',
                'data' => array_values($dataReportDay)
            ]);
            $chart['data'] = $chartData;
            $chart['date'] = array_values($dateRange);
            $data['chart'] = $chart;

            return view('publisher.dashboard.index', $data);
        }
        return redirect()->to('/login');
    }
}
