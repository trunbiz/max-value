<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'report_id',
        'user_id',
        'type',
        'code',
        'title',
        'status',
        'description',
        'amount',
        'payment_at',
        'created_by',
    ];

    const TYPE_REFERRAL = 'REFERRAL';
    const TYPE_REFUND = 'REFUND';

    const STATUS_SUCCESS = 'SUCCESS';
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->code = Helper::generateRandomString();
        });
    }
}
