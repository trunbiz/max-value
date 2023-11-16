<?php

namespace App\Services;

use App\Mail\UserSiteNew;
use App\Models\Helper;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        return Website::whereIn('api_site_id', $listSiteId)->where('is_delete', 0)->get();
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

    public function storeSite($params)
    {
        if (empty($params['url']))
        {
            return [
                'status' => false,
                'message' => 'Missing parameters',
            ];
        }

        $urls = Helper::callGetHTTP("https://api.adsrv.net/v2/site?filter[url]=".$params['url']."&page=1&per-page=10000");
        if(!empty($urls)){
            return [
                'status' => false,
                'message' => 'URL is had already',
            ];
        }else{
            $paramsRequest = [
                "url" => $params['url'],
                "idcategory" => $params['idCategory'] ?? 13,
                "idpublisher" => $params['api_publisher_id'],
                "idstatus" => 3520,
            ];
            $item = Helper::callPostHTTP("https://api.adsrv.net/v2/site", $paramsRequest);
            if (empty($item['id']))
            {
                return [
                    'status' => false,
                    'message' => 'The system created the site error',
                ];
            }
            $dataSiteInfo = [
                'user_id' => $params['userId'],
                'name' => $item['name'],
                'url' => $item['url'],
                'category_website_id' => $item['category']['id'],
                'description' => '0',
                'status' => $item['status']['id'],
                'api_site_id' => $item['id'],
                'publisher_report_impression' => $params['impression'],
                'publisher_report_geo' => $params['geo'],
                'is_delete' => 0,
                'created_by' => $params['userId'],
            ];
            // Lưu dữ lieu vao database
            Website::create($dataSiteInfo);

            // Sau khi user tạo 1 site mới thì bắn mail về cho sale director và Admin
//            $userAdminAndSale = User::where('role_id', [1, 4])->where('active', Common::ACTIVE)->get();
//            foreach ($userAdminAndSale as $adminSale)
//            {
//                if (!filter_var($adminSale->email, FILTER_VALIDATE_EMAIL)) {
//                    continue;
//                }
//
//                $formEmail = [
//                    'userAdmin' => $adminSale->name,
//                    'name' => $item['name'] ?? '0',
//                    'url' => $item['url'] ?? '0',
//                    'created_at' => Carbon::now()->format('Y-m-d hH:i:s'),
//                ];
//                try {
//                    Mail::to($adminSale->email)->send(new UserSiteNew($formEmail));
//                }catch (\Exception $e)
//                {
//                    Log::error('mail error', [
//                        'email' => $adminSale->email
//                    ]);
//                }
//            }
            return [
                'status' => true,
                'message' => 'Success',
                'data' => $dataSiteInfo
            ];
        }
    }
}

