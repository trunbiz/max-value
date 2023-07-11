<?php

namespace Database\Seeders;

use CreateAdvertiseStatusesTable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CreatePermissionSeeder::class);
        $this->call(CreateRoleSeeder::class);
        $this->call(CreatePermissionRoleSeeder::class);
        $this->call(CreateUserStatusSeeder::class);
        $this->call(CreateUserSeeder::class);
        $this->call(CreateLogoSeeder::class);
        $this->call(CreateGenderUserSeeder::class);
        $this->call(CreateProductSeeder::class);
        $this->call(CreateSliderSeeder::class);
        $this->call(CreateChatGroupSeeder::class);
        $this->call(CreateChatSeeder::class);
        $this->call(CreateParticipantChatSeeder::class);
        $this->call(CreateSettingSeeder::class);
        $this->call(CreateOrderStatusSeeder::class);
        $this->call(CreateAdvertiseStatusSeeder::class);
        $this->call(CreateWithdrawStatusSeeder::class);
        $this->call(CreateWithdrawTypeSeeder::class);
        $this->call(CreateTypeCategorySeeder::class);
        $this->call(CreateTypeAdvSeeder::class);
        $this->call(CreateDimensionSeeder::class);
        $this->call(CreateNationalSeeder::class);

    }
}
