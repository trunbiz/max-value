<?php

namespace App\Exports;

use App\Models\WalletUser;
use App\Models\WithdrawUser;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportWallet implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithTitle, WithColumnFormatting, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return WithdrawUser::where('withdraw_status_id', request('withdraw_status_id'))->orderBy('id', 'DESC')->get();
    }

    function map($row): array
    {
        $email_paypal = $email_payoneer = $network_address1 = $network_address2 = $network_address3 = '';
        if(optional($row->walletUser)->withdraw_type_id == 1){
            $email_paypal = optional($row->walletUser)->email;
        }

        if(optional($row->walletUser)->withdraw_type_id == 2){
            $email_payoneer = optional($row->walletUser)->email;
        }

        if(optional($row->walletUser)->withdraw_type_id == 6){
            $network_address3 = optional($row->walletUser)->network_address;
        }
        if(optional($row->walletUser)->withdraw_type_id == 5){
            $network_address2 = optional($row->walletUser)->network_address;
        }
        if(optional($row->walletUser)->withdraw_type_id == 4){
            $network_address1 = optional($row->walletUser)->network_address;
        }


        return [
            $row->id,
            $row->created_at,
            $row->updated_at,
            optional($row->user)->email,
            optional($row->user)->name,
            number_format($row->amount),
            optional($row->statusWithdraw)->name,
            optional(optional($row->walletUser)->withdrawType)->name,
            $email_paypal,
            $email_payoneer,
            optional($row->walletUser)->network,
           $network_address3,
           $network_address2,
            $network_address1,
            optional($row->walletUser)->beneficiary_name,
            optional($row->walletUser)->account_number,
            optional($row->walletUser)->bank_name,
            optional($row->walletUser)->swift,
            optional($row->walletUser)->bank_address,
            optional($row->walletUser)->routing_number
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Time',
            'Est.Payment',
            'Account Manager',
            'Publisher',
            'Amount',
            'Status',
            'Method',
            'Paypal Email',
            'Payoneer Email',
            'Network',
            'Bitcoin Address',
            'Ethererum Address',
            'USDT Address',
            'Beneficiary Name',
            'Account Number',
            'Bank Name',
            'SWFTBIC',
            'Bank Address',
            'Routing Number',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:T1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ]
                ]);

                $event->sheet->setAutoFilter('A1:T1');
            }
        ];
    }

    public function title(): string
    {
        return 'List Wallet';
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
