<?php

namespace App\Services;

use App\Models\Helper;
use App\Models\Website;

class SiteService
{

    public function __construct()
    {
    }
    public function listAllSite()
    {
        return Helper::callGetHTTP("https://api.adsrv.net/v2/site");
    }

    public function getSite($id)
    {
        return Helper::callGetHTTP("https://api.adsrv.net/v2/site/". $id);
    }

    public function listSiteByPublisher($id)
    {
        return Helper::callGetHTTP("https://api.adsrv.net/v2/site?" . "filter[idpublisher]=" . $id . "&page=1&per-page=1000");
    }

    public function totalSite()
    {
        return Website::count();
    }
}
