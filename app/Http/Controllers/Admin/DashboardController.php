<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\User;
use App\Services\DashboardService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;
use function auth;
use function view;

class DashboardController extends Controller
{
    public function index(){

        if(auth()->check()){
            $totalRequest = $totalCPM = $totalCPMWeek = 0;
            $listSite = [];
            if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == 'week'){
                $startDate = Carbon::now()->subDays(7)->toDateString();
                $endDate = Carbon::now()->toDateString();
            }else{
                $startDate = Carbon::now()->subMonth()->toDateString();
                $endDate = Carbon::now()->toDateString();
            }

            // Lây và lưu vào cache site
            $cacheSite = Cache::get(DashboardService::CACHE_DASHBOARD . '_SITE_' . $startDate . '_' . $endDate);
            if (!empty($cacheStats))
            {
                $sites = json_decode($cacheSite, true);
            }else{
                $sites = Helper::callGetHTTP("https://api.adsrv.net/v2/site?page=1&per-page=10000") ?? [];
                Cache::put(DashboardService::CACHE_DASHBOARD . '_SITE_' . $startDate . '_' . $endDate, json_encode($sites), 86400);
            }

            // Lây và lưu vào cache stats
            $cacheStats = Cache::get(DashboardService::CACHE_DASHBOARD . '_STATS_' . $startDate . '_' . $endDate);
            if (!empty($cacheStats))
            {
                $api_stats = json_decode($cacheStats, true);
            }else{
                $api_stats = Helper::callGetHTTP("https://api.adsrv.net/v2/stats?dateBegin=".$startDate."&dateEnd=".$endDate."");
                Cache::put(DashboardService::CACHE_DASHBOARD . '_STATS_' . $startDate . '_' . $endDate, json_encode($api_stats), 86400);
            }


            $countCPM = count($api_stats);
            foreach($api_stats as $api_stat){
                $totalRequest += $api_stat['impressions'];
                $totalCPM += $api_stat['cpm'];
            }
            if($countCPM == 0 || $totalCPM == 0){
                $averageCPM = $revenue = 0;
            }else{
                $averageCPM = $totalCPM / $countCPM;
                $revenue = $totalRequest / (1000 * $totalCPM);
            }

            $numberSites = count($sites);
            $numberZones = 0;

            // Lây và lưu vào cache numberPublisher
            $cacheNumberPublisher = Cache::get(DashboardService::CACHE_DASHBOARD . '_NUMBERPUBLISHER_' . $startDate . '_' . $endDate);
            if (!empty($cacheNumberPublisher))
            {
                $numberPublisher = json_decode($cacheNumberPublisher, true);
            }else{
                $numberPublisher = count(Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idcloudrole]=4") ?? []);
                Cache::put(DashboardService::CACHE_DASHBOARD . '_NUMBERPUBLISHER_' . $startDate . '_' . $endDate, json_encode($numberPublisher), 86400);
            }

            foreach ($sites as $key => $itemSite){
                $numberZones += count($itemSite['zones']);
                $listSite[$key] = Helper::callGetHTTP("https://api.adsrv.net/v2/zone?idsite=" . $itemSite['id']);
            }
            $reults = [];
            foreach ($listSite as $item_list){
                foreach ($item_list as $i){
                    if($i['status']['id'] == 7010){
                        $reults[] = $i;
                    }

                }
            }
            $pendingZones = count($reults);

            $impressions = [];
            $cpms = [];
            $requests = [];

            $stats = $api_stats;
            $items = $api_stats;

            $countCPMWeek = count($items);
            foreach($items as $item){
                $totalCPMWeek += $item['cpm'];
            }
            if($countCPMWeek == 0){
                $averageCPMWeek = 0;
            }else{
                $averageCPMWeek = $totalCPMWeek / $countCPMWeek;
            }

            $period = CarbonPeriod::create($startDate, $endDate);

            $date_format = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array($period));

            $days = array_map(fn ($date) => $date->format('d M'), iterator_to_array($period));

            foreach($stats as $key => $itemStarts){
                $itemitem[$key] = $itemStarts;
                $itemDate[$key] = $itemStarts['dimension'];
                $impressions1[$key] = [
                    'value' => $itemStarts['impressions'],
                    'cpm' => Formatter::convertToFloat($itemStarts['cpm']),
                    'requests' => $itemStarts['requests'],
                    'date' => $itemStarts['dimension']
                ];
            }
            $diff = array_diff($date_format, $itemDate ?? []);
            foreach($diff as $key => $item_diff){
                $impressions2[$key] = [
                   'value' => 0,
                    'cpm' => 0,
                    'requests' => 0,
                    'date' => $item_diff
                ];
            }

            $impressions_all = array_merge($impressions2 ?? [], $impressions1 ?? []);

            usort($impressions_all, function ($a, $b){
                return strtotime($a['date']) - strtotime($b['date']);
            });

            foreach($impressions_all as $key => $impression){
                $impressions[$key] = $impression['value'];
                $cpms[$key] = $impression['cpm'];
                $requests[$key] = $impression['requests'];
            }


            return view('administrator.dashboard.index', compact('numberZones', 'numberSites','totalRequest','numberPublisher','averageCPM', 'revenue', 'pendingZones', 'days', 'impressions', 'cpms', 'requests', 'items', 'averageCPMWeek'));
        }
        return redirect()->to('/admin');
    }

}
