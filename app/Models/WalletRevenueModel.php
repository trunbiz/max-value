<?php

namespace App\Models;

use Awobaz\Compoships\Database\Eloquent\Model;

class WalletRevenueModel extends Model
{
    protected $table = 'wallet_revenue';
    protected $fillable = [
        'user_id',
        'date',
        'revenue',
    ];
}
