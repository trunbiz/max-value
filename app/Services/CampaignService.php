<?php

namespace App\Services;

use App\Models\AdsCampaignModel;
use App\Models\CampaignModel;
use App\Models\Helper;
use App\Models\ZoneModel;

class CampaignService
{
    public function __construct()
    {
        $this->zoneService = new ZoneService();
        $this->adsService = new AdsService();

    }

    public function storeCampaignByAjax($params, &$message = '')
    {
        $zoneInfo = $this->zoneService->getInfoZoneAdServer($params['zone']['id']);
        if (empty($zoneInfo))
        {
            $message = 'Zone 404';
            return false;
        }

        if (empty($params['campaign']['name']))
            $params['campaign']['name'] = $zoneInfo['site']['name'] . ' - ' . $zoneInfo['dimension']['height'] . 'x' . $zoneInfo['dimension']['width'] . ' - ' . time();

        $zoneDBInfo = ZoneModel::where('ad_zone_id', $params['zone']['id'])->first();
        if (empty($zoneDBInfo))
        {
            $message = 'Empty data zone DB';
            return false;
        }
        $dimensionZoneDB = json_decode($zoneDBInfo->dimensions, true);
        $params['ads']['iddimension'] = $dimensionZoneDB['iddimension'] ?? 666;
        $params['ads']['width'] = (string)$dimensionZoneDB['width'] ?? 'auto';
        $params['ads']['height'] = (string)$dimensionZoneDB['height'] ?? 'auto';

        // Tạo campaign
        $campaignInfo = $this->storeCampaignAdServer($params['campaign']);
        $campaignDBInfo = CampaignModel::create([
            'ad_campaign_id' => $campaignInfo['id'],
            'name' => $params['campaign']['name'],
            'id_advertiser' => $campaignInfo['advertiser']['id'],
            'id_run_status' => $campaignInfo['status']['id'],
            'extra_request' => json_encode($params['campaign']),
            'extra_response' => json_encode($campaignInfo),
        ]);

        // Tạo ads
        $adsAdInfo = $this->adsService->storeAdsAdService($campaignInfo['id'], Common::ID_AD_FORMAT['HTML_JS'], $params['ads']);

        // assign Zone
        $paramsZone = [
            'zones' => [
                (integer)$params['zone']['id']
            ]
        ];
        $assignZoneAdInfo = $this->adsService->assignZoneAdServer($adsAdInfo['id'], $paramsZone);
        AdsCampaignModel::create([
            'ad_ad_id' => $adsAdInfo['id'],
            'campaign_id' => $campaignDBInfo->id,
            'zone_id' => $zoneDBInfo->id,
            'is_active' => $adsAdInfo['is_active'],
            'extra_request' => json_encode($params['ads']),
            'extra_response' => json_encode($adsAdInfo)
        ]);

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
