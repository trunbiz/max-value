<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'ad_campaign_id',
        'name',
        'id_advertiser',
        'id_run_status',
        'extra_request',
        'extra_response',
        'is_delete',
        'created_by',
        'updated_by',
    ];
    const STATUS = [
        4010 => 'Running',
        4020 => 'Paused',
        4030 => 'Finished',
    ];

    public function getAds()
    {
        return $this->hasOne(AdsCampaignModel::class, 'campaign_id', 'id');
    }
}
