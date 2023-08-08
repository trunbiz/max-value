<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ZoneModel extends Model
{
    protected $table = 'zones';

    protected $fillable = [
        'ad_site_id',
        'ad_zone_id',
        'id_zone_format',
        'id_dimension_method',
        'dimensions',
        'status',
        'extra_params',
        'extra_response'
    ];
    const DIMENSIONS_METHOD = [
      1 => 'Exact match',
      3 => 'Not wider than',
      4 => 'Not higher than',
      2 => 'Not larger than',
    ];
}
