<?php

namespace App\Services;

use App\Models\Helper;
use App\Models\User;
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

    public function totalSite($listPublisherAssign = null, &$listSiteId = null, $listUserId = null)
    {
        $query = Website::query();
        if (!empty($listPublisherAssign))
        {
            $listUser = User::whereIn('api_publisher_id', $listPublisherAssign)->pluck('id')->toArray();
            $query->whereIn('user_id', $listUser);
        }

        if (!empty($listUserId))
        {
            $query->whereIn('user_id', $listUserId);
        }
        $listSiteId = $query->where('is_delete', 0)->pluck('api_site_id')->toArray();
        return $query->count();
    }

    public function listSiteByApiSiteId($listSiteId)
    {
        return Website::whereIn('api_site_id', $listSiteId)->get();
    }

    public function listAll($params)
    {
        $query = Website::query();
        if (!empty($params['publisher_id']))
        {
            $query->where('websites.user_id', $params['publisher_id']);
        }
        if (!empty($params['list_publisher_id']))
        {
            $query->whereIn('websites.user_id', $params['list_publisher_id']);
        }
        if (!empty($params['website_id']))
        {
            $query->where('websites.id', $params['website_id']);
        }
        if (isset($params['status']))
        {
            $query->where('websites.status', $params['status']);
        }
        if (!empty($params['manager_id']))
        {
            $listPublisherAss = User::where('id', $params['manager_id'])->first()->getListUserAssign();
            $query->whereIn('websites.user_id', $listPublisherAss);
        }
        if (!empty($params['zone_id']))
        {
            $query->join('zones', function ($q) use ($params){
               $q->on('zones.ad_site_id', '=', 'websites.api_site_id');
                $q->where('zones.id', $params['zone_id']);
            });
        }
        return $query->where('websites.is_delete', 0)->orderBy('websites.id', 'DESC')
            ->select('websites.*')->distinct()->paginate(25);
    }

    public function listWebsiteByUser($user_id)
    {
        return Website::where('is_delete', 0)->where('user_id', $user_id)->orderBy('id', 'DESC')->paginate(25);
    }
}
