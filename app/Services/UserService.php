<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

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
        $query = User::where('is_admin', User::IS_PUBLISHER)->where('active', User::ACTIVE)
            ->orderBy('id', 'DESC');
        if (!empty($params['email']))
        {
            $query->where('email', $params['email']);
        }
        if (!empty($params['user_assign']))
        {
            $query->where('email', $params['email']);
        }
        if (!empty($params['website']))
        {
            $query->where('email', $params['email']);
        }
        if (isset($params['verify']) && $params['verify'] != null)
        {
            $query->where('email', $params['email']);
        }
        if (isset($params['active']) && $params['active'] != null)
        {
            $query->where('email', $params['email']);
        }

        return $query->paginate(25);
    }
}
