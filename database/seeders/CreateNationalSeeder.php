<?php

namespace Database\Seeders;

use App\Models\National;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateNationalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path('national.json'));
        $data = json_decode($json, true);

        foreach($data as $key => $value){
            National::create([
                'geoname' => $value['geoname'],
                'name' => $value['name'],
                'continent' => $value['continent'],
            ]);
        }
    }
}
