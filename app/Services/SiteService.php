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

    public function listAll($params)
    {
        $query = Website::query();
        if ($params['publisher_id'])
        {
            $query->where('user_id', $params['publisher_id']);
        }
        if ($params['website_id'])
        {
            $query->where('id', $params['website_id']);
        }
        if ($params['status'])
        {
            $query->where('status', $params['status']);
        }
        if ($params['manager_id'])
        {
            $query->where('status', $params['status']);
        }
        if ($params['zone_id'])
        {
            $query->where('status', $params['status']);
        }
        return $query->paginate(25);
    }
}
