<?php

namespace App\Services;

use App\Models\AssignUserModel;
use App\Models\Setting;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct()
    {
    }

    public function getListUserByPublisher($listApiPublisherId)
    {
        return User::whereIn('api_publisher_id', $listApiPublisherId)->pluck('name', 'api_publisher_id')->toArray();
    }

    public function updateAdsTxt()
    {
        $textStart =  "#maxvalue.media update - " . Carbon::now()->format('m-d-y') . "\n";
        $textEnd =  "#maxvalue.media update end - " . Carbon::now()->format('m-d-y'). "\n";

        $users = User::whereNotNull('partner_code')->pluck('partner_code')->toArray();
        $adsTxtContent = implode("\n", $users) . "\n";
        $adsTxtContent = $textStart . $adsTxtContent . $textEnd;

        $settingInfo = Setting::find(1);
        $settingInfo->ads_txt = $adsTxtContent ?? '';
        $settingInfo->save();

        $filePath = public_path('ads.txt');

        file_put_contents($filePath, $adsTxtContent);
        Log::info('log ads', ['message' => $adsTxtContent]);
        return true;
    }

    public function totalPublisher()
    {
        return User::where('is_admin', '!=', User::IS_ADMIN)->count();
    }

    public function listUserPublisher($params)
    {
        $query = User::where('is_admin', User::IS_PUBLISHER)
            ->select('users.*')
            ->orderBy('users.id', 'DESC');

        if (!empty($params['email']))
        {
            $query->where('email', $params['email']);
        }
        if (!empty($params['balance']))
        {
            $query->whereRaw('CAST(users.money AS UNSIGNED) > 0'); // Sửa thành `>` để loại bỏ các giá trị bằng 0
        }
        if (!empty($params['publisher_id']))
        {
            $query->where('users.id', $params['publisher_id']);
        }
        if (!empty($params['website_id']) || !empty($params['site_status']))
        {
            $listUserSite = Website::query();
            if (!empty($params['website_id']))
            {
                $listUserSite->where('id', $params['website_id']);
            }
            if (!empty($params['site_status']))
            {
                $listUserSite->where('status', $params['site_status']);
            }
            $listUserSite = $listUserSite->pluck('user_id')->toArray();

            if (empty($listUserSite))
            {
                $listUserSite = [-1];
            }
            $query->whereIn('id', $listUserSite);
        }
        if (!empty($params['user_assign']) && $params['user_assign'] != 'null')
        {
            $userListPublisher = AssignUserModel::where('user_id', $params['user_assign'])->where('type', 'PUBLISHER')->where('is_delete', Common::NOT_DELETE)->pluck('service_id')->toArray();
            if (empty($userListPublisher))
            {
                $userListPublisher = [-1];
            }
            $query->whereIn('id', $userListPublisher);
        }
        if (!empty($params['website']))
        {
            $query->where('websites.url', 'like', '%'. $params['website'] .'%');
        }
        if (isset($params['verify']) && $params['verify'] != 'null')
        {
            if ($params['verify'])
            {
                $query->whereNotNull('email_verified_at');
            }
            else{
                $query->whereNull('email_verified_at');
            }
        }
        if (isset($params['active']) && $params['active'] != 'null')
        {
            if ($params['active'])
            {
                $query->where('users.active', 1);
            }
            else{
                $query->where('users.active', 0);
            }
        }
        return $query->paginate(25);
    }
}

