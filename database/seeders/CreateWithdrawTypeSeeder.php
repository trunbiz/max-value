<?php

namespace Database\Seeders;

use App\Models\WithdrawType;
use Illuminate\Database\Seeder;

class CreateWithdrawTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawType::firstOrCreate([
            "name" => "Paypal",
            "min" => 10,
            "fee" => 0,
            "image_path" => "/assets/images/paypal.jpg",
        ]);

        WithdrawType::firstOrCreate([
            "name" => "Payoneer",
            "min" => 10,
            "fee" => 0,
            "image_path" => "/assets/user/images/Payoneer-1.png",
        ]);

        WithdrawType::firstOrCreate([
            "name" => "USDT",
            "min" => 25,
            "fee" => 0,
            "image_path" => "/assets/user/images/USDT.svg",
        ]);

        WithdrawType::firstOrCreate([
            "name" => "Ethereum",
            "min" => 25,
            "fee" => 0,
            "image_path" => "/assets/user/images/Eth.svg",
        ]);

        WithdrawType::firstOrCreate([
            "name" => "Bitcoin",
            "min" => 25,
            "fee" => 0,
            "image_path" => "/assets/user/images/bitcoin.svg",
        ]);

        WithdrawType::firstOrCreate([
            "name" => "Wire Transfer",
            "min" => 25,
            "fee" => 0,
            "image_path" => "/assets/user/images/wiretransfer.svg",
        ]);
    }
}
