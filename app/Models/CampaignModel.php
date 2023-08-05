<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{

//    idrunstatus
    const STATUS = [
        4010 => 'Running',
        4020 => 'Paused',
        4030 => 'Finished',
    ];
}
