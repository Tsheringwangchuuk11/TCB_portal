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
    }
}
