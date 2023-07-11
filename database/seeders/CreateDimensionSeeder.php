<?php

namespace Database\Seeders;

use App\Models\Dimension;
use Illuminate\Database\Seeder;

class CreateDimensionSeeder extends Seeder
{

    public function run()
    {

        Dimension::firstOrCreate([
            "id" => "46",
            "name" => "120x600 / Skyscrape",
        ]);

        Dimension::firstOrCreate([
            "id" => "29",
            "name" => "120x240 / Vertical Banner",
        ]);

        Dimension::firstOrCreate([
            "id" => "32",
            "name" => "125x125 / Square Button",
        ]);

        Dimension::firstOrCreate([
            "id" => "11",
            "name" => "160x600 / Wide Skyscraper",
        ]);

        Dimension::firstOrCreate([
            "id" => "10",
            "name" => "180x150 / Rectangle",
        ]);

        Dimension::firstOrCreate([
            "id" => "36",
            "name" => "200x200 / Small Square",
        ]);

        Dimension::firstOrCreate([
            "id" => "19",
            "name" => "234x60 / Half Banner",
        ]);

        Dimension::firstOrCreate([
            "id" => "5",
            "name" => "240x400 / Vertical Rectangle",
        ]);

        Dimension::firstOrCreate([
            "id" => "37",
            "name" => "250x250 / Square Pop-Up",
        ]);

        Dimension::firstOrCreate([
            "id" => "40",
            "name" => "300x100 / 3:1 Rectangle",
        ]);

        Dimension::firstOrCreate([
            "id" => "9",
            "name" => "300x250 / Medium Rectangle",
        ]);

        Dimension::firstOrCreate([
            "id" => "47",
            "name" => "300x600 / Half-page Ad",
        ]);

        Dimension::firstOrCreate([
            "id" => "52",
            "name" => "315x300",
        ]);

        Dimension::firstOrCreate([
            "id" => "35",
            "name" => "320x100 / Large Mobile Banner",
        ]);

        Dimension::firstOrCreate([
            "id" => "34",
            "name" => "320x50 / Mobile Banner",
        ]);

        Dimension::firstOrCreate([
            "id" => "48",
            "name" => "320x480 / Mobile Interstitial",
        ]);

        Dimension::firstOrCreate([
            "id" => "38",
            "name" => "336x280 / Large Rectangle",
        ]);

        Dimension::firstOrCreate([
            "id" => "1",
            "name" => "468x60 / Full Banner",
        ]);

        Dimension::firstOrCreate([
            "id" => "49",
            "name" => "480x320",
        ]);

        Dimension::firstOrCreate([
            "id" => "42",
            "name" => "580x400 / Netboard",
        ]);

        Dimension::firstOrCreate([
            "id" => "50",
            "name" => "600x400",
        ]);

        Dimension::firstOrCreate([
            "id" => "41",
            "name" => "720x300 / Pop-Under",
        ]);

        Dimension::firstOrCreate([
            "id" => "6",
            "name" => "728x90 / Leaderboard",
        ]);

        Dimension::firstOrCreate([
            "id" => "33",
            "name" => "88x31 / Micro Bar",
        ]);

        Dimension::firstOrCreate([
            "id" => "51",
            "name" => "930x180 / Top Banner",
        ]);

        Dimension::firstOrCreate([
            "id" => "20",
            "name" => "970x90 / Large Leaderboard",
        ]);

        Dimension::firstOrCreate([
            "id" => "21",
            "name" => "970x250 / Billboard",
        ]);

        Dimension::firstOrCreate([
            "id" => "24",
            "name" => "980x120 / Panorama",
        ]);
    }
}
