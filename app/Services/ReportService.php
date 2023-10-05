<?php

namespace App\Services;

use App\Models\ChangeReportModel;
use App\Models\Helper;
use App\Models\ReportDetailModel;
use App\Models\ReportModel;
use App\Traits\ClientRequest;
use Carbon\Carbon;

class ReportService
{
    use ClientRequest;
    protected $url;
    protected $accessToken;
    public function __construct()
    {
        $this->url = config('api.adServer.url');
        $this->accessToken = config('api.adServer.accessToken');
    }

    public function getDataReportDaily()
    {
        $webIds = $this->getAllWebSite();
        if (empty($webIds['data']))
            return false;

        $to = Carbon::now()->subHours(2)->format('Y-m-d');
        $from = Carbon::now()->subHours(2)->format('Y-m-d');
        foreach ($webIds['data'] as $web)
        {
            $datas = $this->getDataReportDailyBySiteZone($web->id, $from, $to);
            if (empty($datas['data']))
                continue;

            // Lấy thông tin chi tiết zone
            $dataDetail = $this->getReportDetailCountry($from, $web->id);

            foreach ($datas['data'] as $data) {

                $reportInfo = ReportModel::where('web_id', $web->id)
                    ->where('zone_id', $data->iddimension_2)
                    ->where('publisher_id', $web->publisher->id)
                    ->where('date', $data->dimension)
                    ->where('status', 1)->first();

                if (!empty($reportInfo))
                    continue;

                $reportInfo = ReportModel::updateOrCreate([
                    'web_id' => $web->id,
                    'zone_id' => $data->iddimension_2,
                    'publisher_id' => $web->publisher->id,
                    'date' => $data->dimension
                ], [
                    'web_id' => $web->id,
                    'zone_id' => $data->iddimension_2,
                    'date' => $data->dimension,
                    'publisher_id' => $web->publisher->id,
                    'request' => $data->requests,
                    'impressions' => $data->impressions,
                    'ad_impressions' => $data->impressions,
                    'cpm' => $data->cpm,
                    'ad_cpm' => $data->cpm,
                    'revenue' => round($data->impressions / 1000 * $data->cpm, 3),
                ]);

                // Lấy thông tin chi tiết và lưu thông tin chi tiết zone :))
                if (empty($dataDetail[$data->iddimension_2]))
                    continue;

                ReportDetailModel::updateOrCreate([
                    'report_id' => $reportInfo->id
                ], [
                    'report_id' => $reportInfo->id,
                    'geo_id' => $dataDetail[$data->iddimension_2]['iddimension'] ?? null,
                    'request' => $dataDetail[$data->iddimension_2]['requests'] ?? null,
                    'impressions' => $dataDetail[$data->iddimension_2]['impressions'] ?? null,
                    'extra' => json_encode($dataDetail[$data->iddimension_2] ?? [])
                ]);
            }
        }
        return true;
    }

    public function getReportDetailCountry($date, $siteId)
    {
        $url = $this->url . '/v2/stats';
        $header = $this->getHeader();
        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'idsite' => $siteId,
            'group' => 'country',
            'group2' => 'zone'
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);

        if (empty($data['data']))
            return false;

        $arrayResult = [];
        foreach ($data['data'] as $item)
        {
            $arrayResult[$item->iddimension_2] = (array)$item;
        }
        return $arrayResult;
    }
    public function getDataReportDailyByWebId($webId, $from, $to)
    {
        $url = $this->url . '/v2/stats';
        $header = $this->getHeader();
        $params = [
            'dateBegin' => $from,
            'dateEnd' => $to,
            'idsite' => $webId,
        ];
        return $this->callClientRequest('GET', $url, $header, $params);
    }

    public function getDataReportDailyByZone($zoneId, $from, $to)
    {
        $url = $this->url . '/v2/stats';
        $header = $this->getHeader();
        $params = [
            'dateBegin' => $from,
            'dateEnd' => $to,
            'idzone' => $zoneId,
        ];
        return $this->callClientRequest('GET', $url, $header, $params);
    }

    public function getDataReportDailyBySiteZone($siteId, $from, $to)
    {
        $url = $this->url . '/v2/stats';
        $header = $this->getHeader();
        $params = [
            'dateBegin' => $from,
            'dateEnd' => $to,
            'idsite' => $siteId,
            'group' => 'day',
            'group2' => 'zone'
        ];
        return $this->callClientRequest('GET', $url, $header, $params);
    }

    public function getAllWebSite()
    {
        $url = $this->url . '/v2/site';
        $header = $this->getHeader();
        $params = [
            'per-page' => 100000
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        return $data;
    }

    public function getHeader()
    {
        return [
            'Content-Type' => 'application/json',
            'AccessToken' => $this->accessToken,
            'Authorization' => 'Bearer '. Helper::getToken(),
        ];
    }

    public function totalReportAccept($from = null, $to = null, $listPublisher = null)
    {
        $query = ReportModel::where('status', ReportModel::STATUS_SUCCESS);
        if (!empty($from))
        {
            $query->where('date', '>=', $from);
        }

        if (!empty($to))
        {
            $query->where('date', '<=', $to);
        }
        $query->selectRaw('SUM(request) AS totalRequests, SUM(change_revenue) AS totalRevenue, AVG(change_cpm) AS averageCpm');

        if (!empty($listPublisher))
        {
            $query = $query->whereIn('publisher_id', $listPublisher);
        }
        return $query->where('status', 1)->first();
    }

    public function getDataDashboardByDate($from, $to, $listPublisher = null)
    {
        $query = ReportModel::where('status', ReportModel::STATUS_SUCCESS)
            ->where('date', '>=', $from)->where('date', '<=', $to)
            ->selectRaw('SUM(request) AS totalRequests, SUM(change_impressions) AS paidImpressions, SUM(revenue) AS totalRevenue, SUM(change_revenue) AS paidRevenue, AVG(change_cpm) AS paidCpm');
        if (!empty($listPublisher))
        {
            $query = $query->whereIn('publisher_id', $listPublisher);
        }
        return $query->first();
    }

    public function getDataReportDashboard($from, $to, $listPublisher = null)
    {
        $query = ReportModel::where('status', ReportModel::STATUS_SUCCESS)
            ->where('date', '>=', $from)->where('date', '<=', $to)
            ->where('status', ReportModel::STATUS_SUCCESS)
            ->selectRaw('date, SUM(impressions) AS totalImpressions, SUM(change_impressions) AS paidImpressions, SUM(revenue) AS totalRevenue, SUM(change_revenue) AS paidRevenue')
            ->groupby('date');
        if (!empty($listPublisher))
        {
            $query = $query->whereIn('publisher_id', $listPublisher);
        }
        $data = $query->get();
        return $this->convertDataReportDashboard($data);
    }

    public function getDataReportByWeek($from, $to, $listPublisher = null)
    {
        $query = ReportModel::where('status', ReportModel::STATUS_SUCCESS)
            ->where('date', '>=', $from)
            ->where('date', '<=', $to)
            ->where('status', ReportModel::STATUS_SUCCESS)
            ->selectRaw('WEEK(date) AS date, SUM(impressions) AS totalImpressions, SUM(change_impressions) AS paidImpressions, SUM(revenue) AS totalRevenue, SUM(change_revenue) AS paidRevenue')
            ->groupBy('date');

        if (!empty($listPublisher)) {
            $query = $query->whereIn('publisher_id', $listPublisher);
        }
        $data = $query->get();
        return $this->convertDataReportDashboard($data);
    }

    public function convertDataReportDashboard($data)
    {
        $arrayResult = [];
        foreach ($data as $item)
        {
            $arrayResult[$item->date] = [
                'totalImpressions' => $item->totalImpressions,
                'paidImpressions' => $item->paidImpressions,
                'totalRevenue' => $item->totalRevenue,
                'paidRevenue' => $item->paidRevenue,
            ];
        }
        return $arrayResult;
    }

    public function getDataReportGroupSite($listSiteId = null, $from = null, $to = null)
    {
        $query = ReportModel::query()
            ->join('websites', 'websites.api_site_id', '=', 'report.web_id');
        if (!empty($listSiteId)) {
            $query->whereIn('report.web_id', $listSiteId);
        }

        if (!empty($from)) {
            $query->where('report.date', '>=', $from);
        }

        if (!empty($to)) {
            $query->where('report.date', '<=', $to);
        }
        $query->selectRaw('websites.name, date, SUM(report.change_revenue) as total_change_revenue');
        return $query->where('report.status', 1)->groupBy('report.web_id', 'date')->orderBy('date', 'ASC')->get();
    }

    public function getDataReportBySite($listSiteId = null, $from = null, $to = null, $orderBy = 'DESC', $params = null)
    {
        $query = ReportModel::query()
            ->join('websites', 'websites.api_site_id', '=', 'report.web_id')
            ->join('zones', 'report.zone_id', '=', 'zones.ad_zone_id');
        if (!empty($listSiteId)) {
            $query->whereIn('report.web_id', $listSiteId);
        }

        if (!empty($from)) {
            $query->where('report.date', '>=', $from);
        }

        if (!empty($to)) {
            $query->where('report.date', '<=', $to);
        }

        $query->selectRaw('report.id, websites.name, zones.name as zone_name, date, report.change_revenue as total_change_revenue, report.change_impressions as total_change_impressions, report.change_cpm as ave_cpm');
        $query->where('report.status', 1)
            ->orderBy('date', $orderBy);

        if (!empty($params['impressions_sort']))
        {
            $query->orderBy('report.change_impressions', $params['impressions_sort']);
        }
        if (!empty($params['cpm_sort']))
        {
            $query->orderBy('report.change_cpm', $params['cpm_sort']);
        }
        if (!empty($params['revenue_sort']))
        {
            $query->orderBy('report.change_revenue', $params['revenue_sort']);
        }

        return $query->paginate(25);
    }
}
