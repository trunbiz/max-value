<?php

namespace App\Exports;

use App\Models\ReportModel;
use App\Services\ReportService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $condition;

    public function __construct($condition)
    {
        $this->condition = $condition;
    }

    public function collection()
    {
        $params = $this->condition;
        $reportService = new ReportService();
        $query = $reportService->queryDataReport($params['listSiteId'] ?? null, $params['from'] ?? null, $params['to'] ?? null, $params['orderBy'] ?? 'DESC', $params, true);

        return $query->get()->map(function ($item) {
            $item->total_change_revenue = round($item->total_change_revenue, 2); // Làm tròn cột "Revenue" thành 2 chữ số thập phân
            return $item;
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Website',
            'Zone',
            'Date',
            'Impressions',
            'Cpm',
            'Revenue'
        ];
    }
}
