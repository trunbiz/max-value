<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AddAdsInSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adsTxt = File::get(public_path('ads.txt'));

        $settingInfo = Setting::find(1);
        $settingInfo->ads_txt = $adsTxt;
        $settingInfo->save();
    }
}
