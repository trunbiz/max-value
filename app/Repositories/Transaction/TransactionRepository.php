<?php

namespace App\Repositories\Transaction;

use App\Models\TransactionModel;
use App\Repositories\BaseRepository;

class TransactionRepository extends BaseRepository implements TransactionInterface
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return TransactionModel::class;
    }

    public function getTotalRevenueRefer($from, $to, $user_id)
    {
        return $this->model->where('type', TransactionModel::TYPE_REFERRAL)
            ->where('status', TransactionModel::STATUS_SUCCESS)
            ->where('user_id', $user_id)
            ->where('payment_at', '>=', $from)
            ->where('payment_at', '<=', $to)
            ->sum('amount');
    }
}
