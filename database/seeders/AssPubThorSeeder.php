<?php

namespace Database\Seeders;

use App\Models\AssignUserModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssPubThorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIdRancher = 32;
        $userIdThor = 239;
        $listAssUser = AssignUserModel::where('type', 'PUBLISHER')->where('user_id', $userIdRancher)->where('is_delete', 0)->get();

        foreach ($listAssUser as $item)
        {
            AssignUserModel::create([
               'type' => 'PUBLISHER',
               'service_id' => $item->service_id,
               'user_id' => $userIdThor,
               'is_delete' => 0,
            ]);
            $item->is_delete = 1;
            $item->save();
        }
    }
}
