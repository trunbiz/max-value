<?php

namespace App\Services;

use App\Models\Helper;

class CampaignService
{
    public function __construct()
    {
        $this->zoneService = new ZoneService();

    }

    public function storeCampaignByAjax($params)
    {
        $zoneInfo = $this->zoneService->getInfoZoneAdServer($params['zone']['id']);
        dd($params['zone']['id'], $zoneInfo);
        $campaignInfo = $this->storeCampaignAdServer($params['campaign']);
        dd($campaignInfo);
    }

    public function storeCampaignAdServer($params)
    {
        $campaignInfo = [
            "name" => $params['name'],
            "idadvertiser" => $params['advertiser_api_id'],
            'idrunstatus' => $params['status'],
            'geo' => $params['geo']
        ];
        if (!empty($params['device_mode']) && !empty($params['device']))
        {
            $campaignInfo['device_mode'] = $params['device_mode'];
            $campaignInfo['device'] = $params['device'];
        }

        if (!empty($params['browser_mode']) && !empty($params['browser']))
        {
            $campaignInfo['browser_mode'] = $params['browser_mode'];
            $campaignInfo['browser'] = $params['browser'];
        }
        return Helper::callPostHTTP("https://api.adsrv.net/v2/campaign", $campaignInfo);
    }
}
