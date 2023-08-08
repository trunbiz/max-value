<?php

namespace App\Services;

use App\Models\Helper;

class CampaignService
{
    public function __construct()
    {
        $this->zoneService = new ZoneService();
        $this->adsService = new AdsService();

    }

    public function storeCampaignByAjax($params)
    {
        $zoneInfo = $this->zoneService->getInfoZoneAdServer($params['zone']['id']);
        if (empty($zoneInfo))
            return false;

        if (empty($params['campaign']['name']))
            $params['campaign']['name'] = $zoneInfo['site']['name'] . ' - ' . $zoneInfo['dimension']['height'] . 'x' . $zoneInfo['dimension']['width'] . ' - ' . time();

        $params['ads']['iddimension'] = $zoneInfo['dimension']['id'];
        $params['ads']['width'] = $zoneInfo['dimension']['width'];
        $params['ads']['height'] = $zoneInfo['dimension']['height'];

        // Tạo campaign
        $campaignInfo = $this->storeCampaignAdServer($params['campaign']);

        // Tạo ads
        $adsServiceInfo = $this->adsService->storeAdsAdService($campaignInfo['id'], Common::ID_AD_FORMAT['HTML_JS'], $params['ads']);

        // assign Zone
        $paramsZone = [
            'zones' => [
                (integer)$params['zone']['id']
            ]
        ];
        $this->adsService->assignZoneAdServer($adsServiceInfo['id'], $paramsZone);
        return true;
    }

    public function storeCampaignAdServer($params)
    {
        $campaignInfo = [
            "name" => $params['name'],
            "idadvertiser" => $params['advertiser_api_id'],
            'idrunstatus' => $params['status'],
            'geo' => $params['geo'] ?? [],
            'geo_bl' => $params['geo_bl'] ?? [],
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
