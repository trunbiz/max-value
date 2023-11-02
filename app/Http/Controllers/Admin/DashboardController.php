<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampaignModel;
use App\Models\Contact;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Role;
use App\Models\User;
use App\Models\ZoneModel;
use App\Services\CampaignService;
use App\Services\DashboardService;
use App\Services\ReportService;
use App\Services\SiteService;
use App\Services\UserService;
use App\Services\ZoneService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use function auth;
use function view;

class DashboardController extends Controller
{
    protected $reportService;
    protected $userService;
    protected $siteService;
    protected $campaignService;
    protected $zoneService;

    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->userService = new UserService();
        $this->siteService = new SiteService();
        $this->campaignService = new CampaignService();
        $this->zoneService = new ZoneService();
    }

    public function index(Request $request)
    {
        $request = $request->all();
        $type = $request['type'] ?? null;

        $data = [];

        if (!auth()->check()) {
            return redirect()->to('/admin');
        }

        $listPublisherAssign = null;
        $data['userPublisherManager'] = [];
        // Nếu user là Publisher Managers chỉ được xem chỉ số của publisher đó
        if (auth()->user()->role_id == Role::ROLE_PUBLISHER_MANAGERS)
        {
            $publisherAssign = auth()->user()->getArrayUserAssign();
            $listPublisherAssign = User::whereIn('id', $publisherAssign)->pluck('api_publisher_id')->toArray();
            if (empty($listPublisherAssign))
            {
                $listPublisherAssign = [-1];
            }
        } else {
            if (!empty($request['publisher_manager_id'])) {
                $publisherAssign = User::find($request['publisher_manager_id'])->getArrayUserAssign();
                $listPublisherAssign = User::whereIn('id', $publisherAssign)->pluck('api_publisher_id')->toArray();
                if (empty($listPublisherAssign))
                {
                    $listPublisherAssign = [-1];
                }
            }
            $data['userPublisherManager'] = User::where('role_id', Role::ROLE_PUBLISHER_MANAGERS)->orderBy('id', 'DESC')->get();
        }

        // Ngày bắt đầu và ngày kết thúc tháng trước
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        // Ngày bắt đầu và kết thúc tháng hiện tại
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $dateNow = Carbon::now()->format('Y-m-d');

        $dateYesterday = Carbon::now()->yesterday()->format('Y-m-d');
        $dateSub2 = Carbon::now()->subDays(2)->format('Y-m-d');
        $dateSub7 = Carbon::now()->subDays(7)->format('Y-m-d');


        // Lấy tổng số request
        $data['totalReport'] = $this->reportService->totalReportAccept($startOfMonth, $dateNow, $listPublisherAssign);
        $data['totalReportLastMonth'] = $this->reportService->totalReportAccept($startOfLastMonth, $endOfLastMonth, $listPublisherAssign);

        // Tổng publisher
        if (!empty($listPublisherAssign))
        {
            $data['totalPublisher'] = count($listPublisherAssign);
        }
        else{
            $data['totalPublisher'] = $this->userService->totalPublisher();
        }

        // Tổng Site
        $data['totalSite'] = $this->siteService->totalSite($listPublisherAssign, $listSiteId);

        if (empty($listSiteId))
        {
            $listSiteId = [-1];
        }
        // Tổng campaign
        $data['totalZone'] = $this->zoneService->totalZone(null, $listSiteId);
        $data['totalZonePending'] = $this->zoneService->totalZone(['status' => ZoneModel::PENDING], $listSiteId);

        // Reports

        $reportToday = $this->reportService->getDataDashboardByDate($dateNow, $dateNow, $listPublisherAssign);
        $reportYesterday = $this->reportService->getDataDashboardByDate($dateYesterday, $dateYesterday, $listPublisherAssign);
        $report2Day = $this->reportService->getDataDashboardByDate($dateSub2, $dateSub2, $listPublisherAssign);
        $report7Day = $this->reportService->getDataDashboardByDate($dateSub7, $dateSub7, $listPublisherAssign);
        $reportThisMonth = $this->reportService->getDataDashboardByDate($startOfMonth, $dateNow, $listPublisherAssign);

        $data['items'][] = [
            'date' => 'Today',
            'totalRequests' => $reportToday->totalRequests,
            'paidImpressions' => $reportToday->paidImpressions,
            'totalRevenue' => $reportToday->totalRevenue,
            'paidRevenue' => $reportToday->paidRevenue,
            'paidCpm' => $reportToday->paidCpm,
        ];

        $data['items'][] = [
            'date' => 'Yesterday',
            'totalRequests' => $reportYesterday->totalRequests,
            'paidImpressions' => $reportYesterday->paidImpressions,
            'totalRevenue' => $reportYesterday->totalRevenue,
            'paidRevenue' => $reportYesterday->paidRevenue,
            'paidCpm' => $reportYesterday->paidCpm,
        ];
        $data['items'][] = [
            'date' => '2 days ago',
            'totalRequests' => $report2Day->totalRequests,
            'paidImpressions' => $report2Day->paidImpressions,
            'totalRevenue' => $report2Day->totalRevenue,
            'paidRevenue' => $report2Day->paidRevenue,
            'paidCpm' => $report2Day->paidCpm,
        ];
        $data['items'][] = [
            'date' => 'Last 7 days',
            'totalRequests' => $report7Day->totalRequests,
            'paidImpressions' => $report7Day->paidImpressions,
            'totalRevenue' => $report7Day->totalRevenue,
            'paidRevenue' => $report7Day->paidRevenue,
            'paidCpm' => $report7Day->paidCpm,
        ];
        $data['items'][] = [
            'date' => 'This month',
            'totalRequests' => $reportThisMonth->totalRequests,
            'paidImpressions' => $reportThisMonth->paidImpressions,
            'totalRevenue' => $reportThisMonth->totalRevenue,
            'paidRevenue' => $reportThisMonth->paidRevenue,
            'paidCpm' => $reportThisMonth->paidCpm,
        ];

        // Data vẽ biểu đồ
        // Chuyển đổi chuỗi thành đối tượng Carbon
        $startDate = Carbon::parse($startOfMonth);
        $endDate = Carbon::parse($dateNow);
        // Tạo một mảng để lưu trữ các ngày
        $dateRange = [];

        $data['charts']['series']['totalImpressions'] = [];
        $data['charts']['series']['paidImpressions'] = [];
        $data['charts']['series']['totalRevenue'] = [];
        $data['charts']['series']['paidRevenue'] = [];

        if ($type == 'week')
        {
            $reportChart = $this->reportService->getDataReportByWeek($startOfMonth, $dateNow, $listPublisherAssign);
            while ($startDate->lte($endDate)) {
                $dateRange[] = $startDate->weekOfYear;
                $startDate->addWeek();
            }
        }
        else{
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                $dateRange[] = $currentDate->format('Y-m-d');
                $currentDate->addDay();
            }
            $reportChart = $this->reportService->getDataReportDashboard($startOfMonth, $dateNow, $listPublisherAssign);
        }

        foreach ($dateRange as $keyDate =>$date)
        {
            if (empty($reportChart[$date]))
            {
                unset($dateRange[$keyDate]);
                continue;
            }

            $data['charts']['series']['totalImpressions'][] = $reportChart[$date]['totalImpressions'] ?? 0;
            $data['charts']['series']['paidImpressions'][] = $reportChart[$date]['paidImpressions'] ?? 0;
            $data['charts']['series']['totalRevenue'][] = floor($reportChart[$date]['totalRevenue'] ?? 0);
            $data['charts']['series']['paidRevenue'][] = floor($reportChart[$date]['paidRevenue'] ?? 0);
        }
        $data['charts']['options'] = array_values($dateRange);
        return view('administrator.dashboard.index', $data);
    }

}
