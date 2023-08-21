<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function __construct()
    {
    }

    public function getListUserByPublisher($listApiPublisherId)
    {
        return User::whereIn('api_publisher_id', $listApiPublisherId)->pluck('name', 'api_publisher_id')->toArray();
    }
}