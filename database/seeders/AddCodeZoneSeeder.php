<?php

namespace Database\Seeders;

use App\Models\ZoneModel;
use App\Services\Common;
use Illuminate\Database\Seeder;

class AddCodeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zones = ZoneModel::where('active', Common::ACTIVE)->where('is_delete', Common::NOT_DELETE)->whereNotNull('extra_response')->get();
        foreach ($zones as $zone)
        {
            if (empty($zone->extra_response))
                continue;

            $responseData = json_decode($zone->extra_response, true);


            if (empty($responseData['code']))
                continue;

            $zone->ad_code = json_encode($responseData['code']);
            $zone->save();
        }
        return 0;
    }
}
