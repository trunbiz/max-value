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
            'page' => $page
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        if (!$data['success'])
            return false;
        $currentPage = $data['responseHeaders']['X-Pagination-Current-Page'][0] ?? 0;

        foreach ($data['data'] as $site)
        {
            $siteInfo = Website::where('api_site_id', $site->id)->first();
//            if (empty($siteInfo))
//            {
            Website::updateOrCreate([
                'user_id' => $site->publisher->id,
                'url' => $site->url,
                'api_site_id' => $site->id,
            ],
                [
                    'user_id' => $site->publisher->id,
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
            'filter' => [
                'idrole' => 4
            ]
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        if (!$data['success'])
            return false;
        $currentPage = $data['responseHeaders']['X-Pagination-Current-Page'][0] ?? 0;

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
            'idsite' => $siteId
        ];
        $data = $this->callClientRequest('GET', $url, $header, $params);
        if (!$data['success'])
            return false;
        $currentPage = $data['responseHeaders']['X-Pagination-Current-Page'][0] ?? 0;

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
}
