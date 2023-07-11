<?php

namespace App\Exports;

use App\Models\Helper;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrderExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Order::all();
    }

    function map($row): array
    {
        return [
            $row->order_code,
            $row->created_at,
            optional($row->pharma)->name,
            optional($row->user)->name,
            optional($row->orderStatus)->name,
            $row->note,
        ];
    }

    public function headings(): array
    {
        return [
            'Mã đơn hàng',
            'Ngày mua',
            'Nhà thuốc',
            'Người tạo',
            'Trạng thái',
            'Ghi chú'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ]
                ]);

                $event->sheet->setAutoFilter('A1:F1');
            }
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
