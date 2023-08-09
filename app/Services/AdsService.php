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
            'is_active' => 1,
            'details' => [
                'width' => !empty($params['width']) ? $params['width'] : 'auto',
                'height' => !empty($params['height']) ? $params['height'] : 'auto',
                'iddimension' => $params['iddimension'],
                'idinjectiontype' => $params['idinjectiontype'],
                'is_responsive' => $params['is_responsive'] ?? 0,
                'content_html' => $params['content_html'] ?? 0,
                'ext_label_pos' => $params['ext_label_pos'] ?? '',
                'ext_menu_pos' => $params['ext_menu_pos'] ?? '',
                'ext_brand_pos' => $params['ext_brand_pos'] ?? '',
            ]
        ];
        return  Helper::callPostHTTP("https://api.adsrv.net/v2/ad?idformat=".$idFormat, $data);
    }

    public function updateAdsAdService($id, $idCampaign, $params)
    {
        $data = [
            'idcampaign' => $idCampaign,
            'is_active' => 1,
            'details' => [
                'width' => !empty($params['width']) ? $params['width'] : 'auto',
                'height' => !empty($params['height']) ? $params['height'] : 'auto',
                'iddimension' => $params['iddimension'],
                'idinjectiontype' => $params['idinjectiontype'],
                'is_responsive' => $params['is_responsive'] ?? 0,
                'content_html' => $params['content_html'] ?? 0,
                'ext_label_pos' => $params['ext_label_pos'] ?? '',
                'ext_menu_pos' => $params['ext_menu_pos'] ?? '',
                'ext_brand_pos' => $params['ext_brand_pos'] ?? '',
            ]
        ];
        return  Helper::callPutHTTP("https://api.adsrv.net/v2/ad?id=".$id, $data);
    }

    public function assignZoneAdServer($adsId, $params)
    {
        return  Helper::callPostHTTP("https://api.adsrv.net/v2/ad/assign?id=".$adsId, $params);
    }
}
