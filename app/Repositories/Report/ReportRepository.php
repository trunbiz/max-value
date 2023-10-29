<?php

namespace App\Repositories\Report;

use App\Models\ReportModel;
use App\Repositories\BaseRepository;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return ReportModel::class;
    }

    public function getPRevenueByDate($from, $to, $publisher_id)
    {
        return $this->model->where('status', ReportModel::STATUS_SUCCESS)
            ->where('date', '>=', $from)->where('date', '<=', $to)
            ->where('publisher_id', $publisher_id)
            ->selectRaw('SUM(change_revenue) AS totalRevenue')->first();
    }

}
