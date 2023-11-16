<?php

namespace Database\Seeders;

use App\Models\WithdrawUser;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class runPaymentAtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listWithdrawUser =  WithdrawUser::whereNull('estimate_payment')->get();
        foreach ($listWithdrawUser as $item)
        {
            $item->estimate_payment = $item->created_at->addMonth()->format('Y-m') . '-15';
            $item->save();
        }
    }
}
