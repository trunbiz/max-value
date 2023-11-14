<?php

namespace App\Repositories;

use App\Models\Website;

class WebsiteRepository extends BaseRepository implements WebsiteInterface
{

    public function getModel()
    {
        return Website::class;
    }
}
