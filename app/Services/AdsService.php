<?php

namespace App\Services;

use App\Models\Helper;

class AdsService
{

    public function __construct()
    {
    }
    public function storeAdsAdService($idCampaign, $params)
    {
        $data = [
            'name' => $params['name'],
            'url' => $params['url'],
            'idcampaign' => $idCampaign,
            'is_active' => $params['active'],
            'details' => [
                'iddimension' => 0,
                'content_html' => 0,
            ],
        ];
        return  Helper::callPostHTTP("https://api.adsrv.net/v2/ad?idformat=".$request->typezone, $data);
    }
}
