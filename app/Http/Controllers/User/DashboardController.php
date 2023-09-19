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
use App\Services\ReportService;
use App\Services\SiteService;
use App\Services\WalletService;
use App\Services\ZoneService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $reportService;
    protected $siteService;
    protected $zoneService;
    protected $walletService;
    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->siteService = new SiteService();
        $this->zoneService = new ZoneService();
        $this->walletService = new WalletService();
    }

    public function index(Request $request){
        $request = $request->all();

        $dateOption = $request['date_option'] ?? null;

        if(auth()->check()){
            $dateNow = Carbon::now()->format('Y-m-d');
            $startOfMonth = null;
            $endOfMonth = null;
            if (!empty($dateOption))
            {
                switch ($dateOption)
                {
                    case 'YESTERDAY':
                        $startOfMonth = Carbon::now()->yesterday()->format('Y-m-d');
                        $endOfMonth = Carbon::now()->yesterday()->format('Y-m-d');
                        break;
                    case 'SUB_2':
                        $startOfMonth = Carbon::now()->subDays(2)->format('Y-m-d');
                        $endOfMonth = $dateNow;
                        break;
                    case 'SUB_3':
                        $startOfMonth = Carbon::now()->subDays(3)->format('Y-m-d');
                        $endOfMonth = $dateNow;
                        break;
                    case 'SUB_7':
                        $startOfMonth = Carbon::now()->subDays(7)->format('Y-m-d');
                        $endOfMonth = $dateNow;
                        break;
                    case 'SUB_THIS_MONTH':
                        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
                        $endOfMonth = $dateNow;
                        break;
                    case 'SUB_LAST_MONTH':
                        $startOfMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                        $endOfMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                        break;
                }
            }

            $data = [
                'title' => 'Dashboard',
            ];
            $data['totalReport'] = $this->reportService->totalReportAccept($startOfMonth, $endOfMonth, [Auth::user()->id]);

            // Lấy thông tin site và zone

            // Tổng Site
            $data['totalSite'] = $this->siteService->totalSite(null, $listSiteId, [Auth::user()->id]);

            // Tổng zone
            $data['totalZone'] = $this->zoneService->totalZone(null, $listSiteId);
            $data['totalZonePending'] = $this->zoneService->totalZone(['status' => ZoneModel::PENDING], $listSiteId);

            // Lấy thông tin withdraw user
            $withdrawInfo = $this->walletService->getInfoWithdrawUser(Auth::user()->id);

            $data['wallet']['Withdrawn'] = 0;
            $data['wallet']['available'] = Auth::user()->money;
            $data['wallet']['pending'] = 0;
            $data['wallet']['rejected'] = 0;
            foreach ($withdrawInfo as $itemWithdraw)
            {
                if ($itemWithdraw->withdrawStatus == WithdrawUser::STATUS_PENDING)
                {
                    $data['wallet']['pending'] = $itemWithdraw->totalAmount ?? 0;
                }
                elseif ($itemWithdraw->withdrawStatus == WithdrawUser::STATUS_APPROVED){
                    $data['wallet']['withdrawn'] = $itemWithdraw->totalAmount ?? 0;
                }
                elseif ($itemWithdraw->withdrawStatus == WithdrawUser::STATUS_REJECT){
                    $data['wallet']['rejected'] = $itemWithdraw->totalAmount ?? 0;
                }
            }
            // Lấy thông tin reports
            $infoReportBySite = $this->reportService->getDataReportGroupSite($listSiteId, $startOfMonth, $endOfMonth);

            dd($infoReportBySite, $listSiteId, $startOfMonth, $endOfMonth);

            return view('user.dashboard.index', $data);
        }
        return redirect()->to('/login');
    }
}
