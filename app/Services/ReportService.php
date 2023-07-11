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
        $from = Carbon::now()->subDays(2)->format('Y-m-d');;
        foreach ($webIds['data'] as $web)
        {
            $datas = $this->getDataReportDailyByWebId($web->id, $from, $to);
            if (empty($datas['data']))
                continue;
            foreach ($datas['data'] as $data)
            {
                ReportModel::updateOrCreate([
                    'web_id' => $web->id,
                    'publisher_id' => $web->publisher->id,
                    'date' => $data->dimension
                ],[
                    'web_id' => $web->id,
                    'date' => $data->dimension,
                    'publisher_id' => $web->publisher->id,
                    'request' => $data->requests,
                    'impressions' => $data->impressions,
                    'cpm' => $data->cpm,
                    'revenue' => number_format($data->impressions / 1000 * $data->cpm, 3),
                ]);
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

    public function getAllWebSite()
    {
        $url = $this->url . '/v2/site';
        $header = $this->getHeader();
        $data = $this->callClientRequest('GET', $url, $header);
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
