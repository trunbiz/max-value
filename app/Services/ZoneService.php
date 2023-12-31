<?php

namespace App\Services;

use App\Models\CampaignModel;
use App\Models\Helper;
use App\Models\Setting;
use App\Models\Website;
use App\Models\ZoneModel;

class ZoneService
{

    public function __construct()
    {

    }

    function callZoneStoreAdServer($adSiteId, $params)
    {
        return Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=" . $adSiteId, $params);
    }

    public function storeZone($adSiteId, $params)
    {
        $infoSite = Website::where('api_site_id', $adSiteId)->where('is_delete', Common::NOT_DELETE)->first();
        if (empty($infoSite))
            return [
                'success' => false,
                'message' => 'website does not exist'
            ];

        if (empty($params['name'])) {
            $params['name'] = $infoSite->name . ' ' . Common::DIMENSIONS[$params['idDimension']]['name'] ?? [];
        }

        $check_name = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite=' . $adSiteId . '&filter[name]=' . $params['name']);

        if (count($check_name) > 0) {
            $params['name'] = $params['name'] . ' #' . (count($check_name) + 1);
        }

        $keyIdDimension = $params['idDimension'] ?? null;

        $dimensionInfo = Common::DIMENSIONS[$params['idDimension']] ?? [];

        $paramsZone = [
            'name' => $params['name'],
            'idzoneformat' => ZoneModel::FORMAT_BANNER,
            'iddimension' => ZoneModel::ZONE_DIMENSION_CUSTOM,
            'match_algo' => ZoneModel::EXACT_MATCH,
            'revenue_rate' => 100,
            'idrevenuemodel' => ZoneModel::REVENUE_SHARE,
            'is_active' => 0,
            'height' => (string)$dimensionInfo['size'][0],
            'width' => (string)$dimensionInfo['size'][1],
        ];

        $item = $this->callZoneStoreAdServer($adSiteId, $paramsZone);

        if (empty($item['id']))
            return [
              'success' => false,
              'message' => 'server zone error'
            ];

        $infoZone = ZoneModel::create([
            'ad_site_id' =>$adSiteId,
            'ad_zone_id' => $item['id'],
            'name' => $item['name'],
            'id_zone_format' => ZoneModel::FORMAT_BANNER,
            'id_dimension_method' => ZoneModel::EXACT_MATCH,
            'dimensions' => json_encode([
                'paramsIdDimension' =>$keyIdDimension ?? null,
                'iddimension' => 666,
                'width' => (string)$dimensionInfo['size'][1],
                'height' => (string)$dimensionInfo['size'][0],
            ]),
            'active' => $item['is_active'] ? 1 : 0,
            'status' => $item['status']['id'],
            'ad_code' => json_encode($item['code']),
            'extra_params' => json_encode($paramsZone),
            'extra_response' => json_encode($item),
            'created_by' => auth()->user()->id ?? null,
            'updated_by' => auth()->user()->id ?? null,
        ]);

        return [
            'success' => true,
            'message' => 'zones success',
            'data' => $infoZone,
            'zoneCode' => $item['code']
        ];
    }

    public function listAllZone($id)
    {
        $params = [
            'query' => ['idsite' => $id]
        ];
        return Helper::callGetHTTP("https://api.adsrv.net/v2/zone", $params);
    }

    public function storeAdServer($params)
    {
        $data = [
            'name' => $params['name'],
            'is_active' => $params['active'] ?? 0,
            'idstatus' => 7000,
            'idzoneformat' => $params['format_id'],
            'iddimension' => $params['dimension_id'],
            'match_algo' => $params['dimension_method_id'],
        ];
        return Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=" . $params['website_id'], $data);
    }

    public function deleteZoneAdServer($id)
    {
        return Helper::callDeleteHTTP("https://api.adsrv.net/v2/zone/" . $id);
    }

    public function getInfoZoneAdServer($id)
    {
        return Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $id);
    }

    public function totalZone($options = null, $listSiteId = null)
    {
        $query = ZoneModel::query();
        if (!empty($options['status']))
        {
            $query->where('status', $options['status']);
        }
        if (!empty($listSiteId))
        {
            $query->whereIn('ad_site_id', $listSiteId);
        }
        return $query->where('is_delete', 0)->count();
    }

    public function listZoneByApiSiteId($listSiteId)
    {
        return ZoneModel::whereIn('ad_site_id', $listSiteId)->where('is_delete', 0)->get();
    }

}
