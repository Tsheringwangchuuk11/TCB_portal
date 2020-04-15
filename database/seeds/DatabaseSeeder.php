<?php

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
        $this->call(TSystemMenusTableSeeder::class);
        $this->call(TSystemSubMenusTableSeeder::class);
        $this->call(TUsersTableSeeder::class);
        $this->call(TRolesTableSeeder::class);
        $this->call(TUserRolesTableSeeder::class);
        $this->call(TPrivilegesTableSeeder::class);
        $this->call(TDivisionTableSeeder::class);
        $this->call(TServiceTableSeeder::class);
        $this->call(ModuleMasterTableSeeder::class);
        $this->call(StarCategoryTableSeeder::class);
        $this->call(ModuleServiceSeeder::class);
        $this->call(DzongkhagMasterSeeder::class);
        $this->call(GewogMasterSeeder::class);
        $this->call(StaffAreasSeeder::class);
        $this->call(HotelDivisionTableSeeder::class);
        $this->call(RoomTypeTableSeeder::class);

    }
}
