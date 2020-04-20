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
               //Master
            ['id' => 5, 'system_menu_id' => 2, 'name' => 'Checklist Chapter', 'route' => 'master/checklist-chapters', 'display_order' => 1],
            ['id' => 6, 'system_menu_id' => 2, 'name' => 'Checklist Area', 'route' => 'master/checklist-areas', 'display_order' => 2],
            ['id' => 7, 'system_menu_id' => 2, 'name' => 'Checklist Standard', 'route' => 'master/checklist-standards', 'display_order' => 3],
            ['id' => 8, 'system_menu_id' => 2, 'name' => 'Basic Standard', 'route' => 'master/basic-standards', 'display_order' => 4],
            ['id' => 9, 'system_menu_id' => 2, 'name' => 'Checklist Standard Mapping', 'route' => 'master/checklist-standard-mappings', 'display_order' => 5],

            //application
            ['id' => 10, 'system_menu_id' => 3, 'name' => 'Application', 'route' => 'application/new-application', 'display_order' => 1],


        ]);
    }
}
