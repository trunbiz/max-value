<?php

namespace App\Repositories\National;

use App\Models\National;
use App\Models\ReportModel;
use App\Repositories\BaseRepository;

class NationalRepository extends BaseRepository implements NationalRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return National::class;
    }
}
