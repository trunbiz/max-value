<?php

namespace App\Models;


use App\Services\Common;
use Illuminate\Database\Eloquent\Model;

class ZoneModel extends Model
{
    protected $table = 'zones';

    protected $fillable = [
        'ad_site_id',
        'ad_zone_id',
        'name',
        'id_zone_format',
        'id_dimension_method',
        'dimensions',
        'ad_code',
        'status',
        'display_status',
        'active',
        'is_delete',
        'extra_response',
        'extra_response',
        'created_by',
        'updated_by',
    ];
    const DIMENSIONS_METHOD = [
      1 => 'Exact match',
      3 => 'Not wider than',
      4 => 'Not higher than',
      2 => 'Not larger than',
    ];

    const STATUS_ADSERVER = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REJECTED => 'Rejected',
    ];

    const STATUS_PENDING = 7010;
    const STATUS_APPROVED = 7000;
    const STATUS_REJECTED = 7020;

    const ID_ZONE_FORMAT = [
      6 => 'Banner'
    ];

    const PENDING = 7010;

    public function getInfoCampaign()
    {
        return $this->belongsToMany(CampaignModel::class, 'ads_campaign', 'zone_id', 'campaign_id');
    }

    public function getUserCreated()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->first();
    }

    public function getArrayUserAssign()
    {
        return $this->hasOne(AssignUserModel::class, 'service_id', 'id')->where('type', AssignUserModel::TYPE['ZONE'])
            ->where('is_delete', Common::NOT_DELETE)->pluck('user_id')->toArray();
    }
}
