<?php

use Illuminate\Database\Seeder;

class TSystemSubMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_system_sub_menus')->insert([
            //system settings
            ['id' => 1, 'system_menu_id' => 1, 'name' => 'Modules', 'route' => 'system/modules', 'display_order' => 1],
		    ['id' => 2, 'system_menu_id' => 1, 'name' => 'Roles', 'route' => 'system/roles', 'display_order' => 2],
		    ['id' => 3, 'system_menu_id' => 1, 'name' => 'Users', 'route' => 'system/users', 'display_order' => 3],
            ['id' => 4, 'system_menu_id' => 1, 'name' => 'Resend Verification Code', 'route' => 'system/resend-verification-codes', 'display_order' => 4],
        ]);
    }
}
