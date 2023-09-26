<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
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

        $users = User::whereNotNull('partner_code')->pluck('partner_code')->all();

        $adsTxtContent = implode("\n", $users) . "\n";
        $adsTxtContent = $textStart . $adsTxtContent . $textEnd;
        $filePath = public_path('../../public_html/ads.txt');

        file_put_contents($filePath, $adsTxtContent);
        return true;
    }

    public function totalPublisher()
    {
        return User::where('is_admin', '!=', User::IS_ADMIN)->count();
    }

    public function listUserPublisher($params)
    {
        $query = User::where('is_admin', User::IS_PUBLISHER)
            ->leftJoin('websites', 'users.id', '=', 'websites.user_id')
            ->leftJoin('assign_user', 'users.id', '=', 'assign_user.service_id')
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
        if (!empty($params['website_id']))
        {
            $query->where('websites.id', $params['website_id']);
        }
        if (!empty($params['site_status']))
        {
            $query->whereIn('websites.status', $params['site_status']);
        }
        if (!empty($params['user_assign']) && $params['user_assign'] != 'null')
        {
            $query->where('assign_user.user_id', $params['user_assign']);
            $query->where('assign_user.type', 'PUBLISHER');
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
        $query->distinct();
        return $query->paginate(25);
    }
}

