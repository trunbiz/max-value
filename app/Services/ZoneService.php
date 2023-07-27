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

}
