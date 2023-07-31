<?php

namespace App\Services;

use App\Models\Helper;

class CampaignService
{
    public function __construct()
    {

    }

    public function storeCampaign($params)
    {
        $campaignInfo = $this->storeCampaignAdServer($params);
        dd($campaignInfo);
    }

    public function storeCampaignAdServer($params)
    {
        $campaignInfo = [
            "idadvertiser" => $params['advertiser_api_id'],
            'name' => $params['campaign']['name'],
            'idcategory' => $params['campaign']['idCategory'],
            'idstatus' => $params['campaign']['status'],
        ];
        return Helper::callPostHTTP("https://api.adsrv.net/v2/campaign", $campaignInfo);
    }
}
