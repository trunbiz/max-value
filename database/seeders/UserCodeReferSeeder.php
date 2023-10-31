<?php

namespace Database\Seeders;

use App\Models\Helper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserCodeReferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        generateRandomString
        $users = User::all();
        foreach ($users as $user)
        {
            try {
                $user->code = Helper::generateRandomString();
                $user->save();
            }catch (\Exception $e)
            {
                Log::error('gen code user', );
                $user->code = Helper::generateRandomString();
                $user->save();
            }
        }
    }
}
