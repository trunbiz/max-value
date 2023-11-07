<?php

namespace App\Repositories\Transaction;

use App\Repositories\RepositoryInterface;

interface TransactionInterface extends RepositoryInterface
{

    public function getTotalRevenueRefer($from, $to, $user_id);
}
