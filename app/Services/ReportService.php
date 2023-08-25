<?php

namespace App\Services;

use App\Models\ChangeReportModel;
use App\Models\Helper;
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

        $to = Carbon::now()->format('Y-m-d');
        $from = Carbon::now()->subDays(1)->format('Y-m-d');
        foreach ($webIds['data'] as $web)
        {
            if (empty($web->zones))
                continue;

            foreach ($web->zones as $zone) {
                $datas = $this->getDataReportDailyByZone($zone->id, $from, $to);
                if (empty($datas['data']))
                    continue;

                foreach ($datas['data'] as $data) {

                    $reportInfo = ReportModel::where('web_id', $web->id)
                        ->where('zone_id', $zone->id)
                        ->where('publisher_id', $web->publisher->id)
                        ->where('date', $data->dimension)
                        ->where('status', 1)->first();

                    if (!empty($reportInfo))
                        continue;

                    ReportModel::updateOrCreate([
                        'web_id' => $web->id,
                        'zone_id' => $zone->id,
                        'publisher_id' => $web->publisher->id,
                        'date' => $data->dimension
                    ], [
                        'web_id' => $web->id,
                        'zone_id' => $zone->id,
                        'date' => $data->dimension,
                        'publisher_id' => $web->publisher->id,
                        'request' => $data->requests,
                        'impressions' => $data->impressions,
                        'ad_impressions' => $data->impressions,
                        'cpm' => $data->cpm,
                        'ad_cpm' => $data->cpm,
                        'revenue' => round($data->impressions / 1000 * $data->cpm, 3),
                    ]);
                }
            }
        }
        return true;
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
}
