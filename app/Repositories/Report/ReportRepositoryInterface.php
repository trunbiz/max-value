<?php

namespace App\Repositories\Report;

use App\Repositories\RepositoryInterface;

interface ReportRepositoryInterface extends RepositoryInterface
{

    public function getPRevenueByDate($from, $to, $publisher_id);
}
