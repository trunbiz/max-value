<?php

namespace Database\Seeders;

use App\Models\AdvertiseStatus;
use App\Models\TypeAdv;
use Illuminate\Database\Seeder;

class CreateAdvertiseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdvertiseStatus::firstOrCreate([
            "name" => "Pending",
        ]);

        AdvertiseStatus::firstOrCreate([
            "name" => "Published",
        ]);

        AdvertiseStatus::firstOrCreate([
            "name" => "Denied",
        ]);


    }
}
