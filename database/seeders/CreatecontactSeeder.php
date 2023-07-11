<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreatecontactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::firstOrCreate([
            "field" => "",
        ]);
    }
}
