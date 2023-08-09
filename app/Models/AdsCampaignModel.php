<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsCampaignModel extends Model
{
    protected $table = 'ads_campaign';
    protected $fillable = [
        'ad_ad_id',
        'campaign_id',
        'zone_id',
        'is_active',
        'extra_request',
        'extra_response',
    ];

    public function getCampaign()
    {
        return $this->hasOne(CampaignModel::class, 'campaign_id', 'id');
    }
}
