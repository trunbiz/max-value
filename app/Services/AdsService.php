<?php

namespace App\Services;

use App\Models\Helper;

class AdsService
{

    public function __construct()
    {
    }
    public function storeAdsAdService($idCampaign, $idFormat, $params)
    {
        $data = [
            'idcampaign' => $idCampaign,
            'is_active' => $params['active'],
            'idinjectiontype' => $params['idinjectiontype'],
            'iddimension' => 666,
            'width' => 666,
            'iddimension' => 666,
            'details' => [
                'iddimension' => 0,
                'content_html' => 0,
            ],
        ];
        return  Helper::callPostHTTP("https://api.adsrv.net/v2/ad?idformat=".$idFormat, $data);
    }
}
