<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\WithdrawStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateWithdrawStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawStatus::create([
            'name' => 'Pending',
            'color' => '#ffff11',
        ]);

        WithdrawStatus::create([
            'name' => 'Approved',
            'color' => '#b0ffb9',
        ]);

        WithdrawStatus::create([
            'name' => 'Reject',
            'color' => '#ffbfbf',
        ]);

    }
}
