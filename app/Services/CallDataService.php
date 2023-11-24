<?php

namespace App\Services;

use App\Models\Helper;
use App\Models\Setting;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneModel;
use App\Traits\ClientRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use Weidner\Goutte\GoutteFacade;

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
        $idLog = rand(10,100);
        Log::info('job run start ' . $idLog);
        $adsTxt = File::get(public_path('ads.txt'));

        // Get all site
        $listWebsite = Website::where('is_delete', Common::NOT_DELETE)->orderBy('id', 'DESC')->get();
        foreach ($listWebsite as $siteItem)
        {
            $url = trim($siteItem->url, '/ ');

            // check ads
            $this->checkAdsSite($url . '/ads.txt', $adsTxt, $status);

            $siteItem->ads_status = $status ?? null;
            $siteItem->save();

            // Check all zone
            $listZone = ZoneModel::where('ad_site_id', $siteItem->api_site_id)->where('is_delete', Common::NOT_DELETE)->get();

            if ($listZone->isEmpty())
                continue;

            foreach ($listZone as $itemZone)
            {
                // Normal tag
                $normalTag = $this->checkCodeZones($url, 'ins', 'data-zone');
                if (in_array($itemZone->ad_zone_id, $normalTag))
                {
                    $itemZone->display_status = ZoneModel::STATUS_SHOW;
                }
                else{
                    $itemZone->display_status = ZoneModel::STATUS_HIDE;
                }
                $itemZone->save();
            }
        }
        Log::info('job run end' . $idLog);
    }

    public function checkAdsSite($url, $fileAdsTxt, &$status = Common::CODE_EMPTY)
    {
        $maxvalueStart = '#maxvalue.media';
        $maxvalueStart2 = '#maxvalue.media update';

        $maxvalueEnd = '#maxvalue.media';
        $maxvalueEnd2 = '#maxvalue.media update end';

        $dataCrawl = $this->callContentClientRequest('GET', $url);
        if ($dataCrawl['success'] && !empty($dataCrawl['data']))
        {
            $adsTxt = $dataCrawl['data'];
            $arrayAdsTxt = preg_split('/\R/', $adsTxt);
            $arrayAdsTxt = array_filter($arrayAdsTxt, function ($value) {
                return !empty($value);
            });


            $arrayFileAdsTxt = preg_split('/\R/', $fileAdsTxt);
            $arrayFileAdsTxt = array_filter($arrayFileAdsTxt, function ($value) {
                return !empty($value);
            });

//            $issMaxvalueStartTxt = false;
//            $issMaxvalueEndTxt = false;
//            foreach ($arrayAdsTxt as $itemAds)
//            {
////                echo $itemAds .'------------------'. $maxvalueStart . "\n";
//
//                // check isset #maxvalue.media
//                if (strpos($itemAds, $maxvalueStart) !== false || strpos($itemAds, $maxvalueStart2) !== false)
//                {
//                    $issMaxvalueStartTxt = true;
//                }
//                if (strpos($itemAds, $maxvalueEnd) !== false || strpos($itemAds, $maxvalueEnd2) !== false)
//                {
//                    $issMaxvalueEndTxt = true;
//                }
//            }
//            if (!$issMaxvalueStartTxt || !$issMaxvalueEndTxt)
//            {
//                $status = Common::CODE_EMPTY;
//                return false;
//            }

            // check update file ads.txt
            foreach ($arrayFileAdsTxt as $itemFileAds)
            {
                $itemFileAds = html_entity_decode($itemFileAds, ENT_QUOTES, 'UTF-8');
                $checkIsset = false;
                foreach ($arrayAdsTxt as $itemAds)
                {
                    $itemAds = html_entity_decode($itemAds, ENT_QUOTES, 'UTF-8');
                    if (trim($itemAds) == trim($itemFileAds))
                    {
                        $checkIsset = true;
                    }
                }
                if (!$checkIsset)
                {
                    $status = Common::CODE_NOT_UPDATE;
                    return false;
                }
            }
            $status = Common::CODE_ACCEPT;
            return true;
        }
        $status = Common::CODE_EMPTY;
        return false;
    }

    public function checkCodeZones($url, $codeZone, $tag)
    {
        try {
            $crawler = GoutteFacade::request('GET', $url, [], [], [
                'HTTP_PRAGMA' => 'no-cache',
                'HTTP_CACHE_CONTROL' => 'no-cache',
            ]);

            return $crawler->filter($codeZone)->each(function ($node) use ($tag) {
                return $node->attr($tag);
            });
        }catch (\Exception $e)
        {
            return [];
        }

    }
}
