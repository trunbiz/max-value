<?php

namespace Database\Seeders;

use App\Models\TypeAdv;
use Illuminate\Database\Seeder;

class CreateTypeAdvSeeder extends Seeder
{

    public function run()
    {

        TypeAdv::firstOrCreate([
            "id" => "6",
            "name" => "Banner",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "21",
            "name" => "Direct link",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "30",
            "name" => "Popup",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "18",
            "name" => "VAST",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "33",
            "name" => "Push notification",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "40",
            "name" => "Footer marquee",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "36",
            "name" => "Interstitial",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "35",
            "name" => "Interscroller",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "37",
            "name" => "Slider",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "38",
            "name" => "Sidebar",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "39",
            "name" => "Push down",
        ]);

        TypeAdv::firstOrCreate([
            "id" => "41",
            "name" => "Background",
        ]);
    }
}
