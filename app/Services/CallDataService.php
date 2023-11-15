<?php

namespace App\Services;

use App\Models\Helper;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneModel;
use App\Traits\ClientRequest;

class CallDataService
{
    use ClientRequest;

    public function __construct()
    {
        $this->url = config('api.adServer.url');
        $this->accessToken = config('api.adServer.accessToken');
        $this->commonService = new Common();
    }

    public function getHeader()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. Helper::getToken(),
        ];
    }

    public function callDataSite($page = 1)
    {
        $url = $this->url . '/v2/site';
        $header = $this->getHeader();
        $params = [
            'page' => $page,
            'per-page' => 10000
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        if (!$data['success'])
            return false;
        $currentPage = $data['responseHeaders']['X-Pagination-Page-Count'][0] ?? 0;

        if (empty($data['data']))
            return true;

        foreach ($data['data'] as $site)
        {
//            if (empty($siteInfo))
//            {

            $userInfo = User::where('api_publisher_id', $site->publisher->id)->first();

//            if ($site->id == 26225)
//            {
//                dd($userInfo, $site);
//            }

            Website::updateOrCreate([
                'url' => $site->url,
                'api_site_id' => $site->id,
            ],
                [
                    'user_id' => $userInfo->id ?? 0,
                    'name' => $site->name,
                    'url' => $site->url,
                    'category_website_id' => $site->category->id,
                    'status' => $site->status->id,
                    'api_site_id' => $site->id,
                    'is_delete' => Common::NOT_DELETE,
                ]);
//            }

            // Zone
            $this->callDataZone(1, $site->id);
        }

        if ($page >= $currentPage)
        {
            return true;
        }
        $page++;
        $this->callDataSite($page);
    }

    public function callDataPublisher($page=1, &$userP)
    {
        $url = $this->url . '/v2/user';
        $header = $this->getHeader();
        $params = [
            'page' => $page,
            'per-page' => 10000,
            'filter' => [
                'idrole' => 4
            ]
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        if (!$data['success'])
            return false;

        $currentPage = $data['responseHeaders']['X-Pagination-Page-Count'][0] ?? 0;

        if (empty($data['data']))
            return true;

        foreach ($data['data'] as $user)
        {
            array_push($userP, $user->id);
            $userInfo = User::where('api_publisher_id', $user->id)->first();
            if (empty($userInfo))
            {
                User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_status_id' => Common::ACTIVE,
                    'role_id' => $user->role->id,
                    'is_admin' => 0,
                    'active' => Common::ACTIVE,
                    'api_publisher_id' => $user->id,
                ]);
            }
        }

        if ($page >= $currentPage)
        {
            return true;
        }
        $page++;
        $this->callDataPublisher($page, $userP);
    }

    public function callDataZone($page = 1, $siteId)
    {
        $url = $this->url . '/v2/zone';
        $header = $this->getHeader();
        $params = [
            'page' => $page,
            'idsite' => $siteId,
            'per-page' => 10000
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        if (!$data['success'])
            return false;
        $currentPage = $data['responseHeaders']['X-Pagination-Page-Count'][0] ?? 0;


        if (empty($data['data']))
            return true;

        foreach ($data['data'] as $zone)
        {
//            $zoneInfo = ZoneModel::where('ad_zone_id', $zone->id)->first();
//            if (empty($zoneInfo))
//            {
                $dataDimensions = [
                    'width'=>$zone->width,
                    'height' =>$zone->height,
                    'iddimension' => $zone->dimension->id,
                    'paramsIdDimension' =>Common::getNameDimension($zone->height, $zone->width)
                ];
                ZoneModel::updateOrCreate([
                    'ad_site_id' => $siteId,
                    'ad_zone_id' => $zone->id,
                ],[
                    'ad_site_id' => $siteId,
                    'ad_zone_id' => $zone->id,
                    'name' => $zone->name,
                    'id_zone_format' => $zone->format->id,
                    'id_dimension_method' => 1,
                    'dimensions' => json_encode($dataDimensions),
                    'status' => $zone->status->id,
                    'active' => $zone->is_active ? 1 : 0,
                    'is_delete' => Common::NOT_DELETE,
                    'extra_response' => json_encode($zone),
                ]);
//            }
        }

        if ($page >= $currentPage)
        {
            return true;
        }
        $page++;
        $this->callDataPublisher($page);
    }

    public function runCheckCodeSite()
    {

        // Get all site
        $listWebsite = Website::where('is_delete', Common::NOT_DELETE)->orderBy('id', 'DESC')->get();
        foreach ($listWebsite as $siteItem)
        {
            $url = 'https://realitytvseries.uk/ads.txt';
            $checkAds = $this->checkAdsSite($url);
        }
        dd($listWebsite);

    }

    public function checkAdsSite($url, &$status = 'EMPTY')
    {
        $dataCrawl = $this->callContentClientRequest('GET', $url);
        if ($dataCrawl['success'] && !empty($dataCrawl['data']))
        {

        }
        dd(2234,$url, $dataCrawl);
    }
}
