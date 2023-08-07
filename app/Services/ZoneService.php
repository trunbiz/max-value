<?php

namespace App\Services;

use App\Models\Helper;

class ZoneService
{

    public function __construct()
    {

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

}
