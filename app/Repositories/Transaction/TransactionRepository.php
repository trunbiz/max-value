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
        $query = $this->model->whereIn('type', [TransactionModel::TYPE_REFERRAL, TransactionModel::TYPE_REFUND_REFERRAL])
            ->where('status', TransactionModel::STATUS_SUCCESS)
            ->where('user_id', $user_id);
        if (!empty($from))
            $query->where('payment_at', '>=', $from);

        if (!empty($to))
            $query->where('payment_at', '<=', $to);

        return $query->sum('amount');
    }

    public function listReferPublisherByDate($params)
    {
        $query = $this->model->where('type', TransactionModel::TYPE_REFERRAL)
            ->where('status', TransactionModel::STATUS_SUCCESS)
            ->where('user_id', $params['user_id']);
        if (!empty($from))
            $query->where('payment_at', '>=', $params['from']);

        if (!empty($to))
            $query->where('payment_at', '<=', $params['to']);

        $query->groupBy('report_id', 'payment_at')->selectRaw('SUM(amount) AS totalRefer, report_id, payment_at');

        return $query->orderBy('id', 'DESC')->paginate(25);
    }
}
