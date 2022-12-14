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
            ['id' => 5, 'system_menu_id' => 1, 'name' => 'Sytem Backup', 'route' => 'system/backups', 'display_order' => 5],
               //Master
            ['id' => 6, 'system_menu_id' => 2, 'name' => 'Checklist Chapter', 'route' => 'master/checklist-chapters', 'display_order' => 1],
            ['id' => 7, 'system_menu_id' => 2, 'name' => 'Checklist Area', 'route' => 'master/checklist-areas', 'display_order' => 2],
            ['id' => 8, 'system_menu_id' => 2, 'name' => 'Checklist Standard', 'route' => 'master/checklist-standards', 'display_order' => 3],

            //application
            ['id' => 9, 'system_menu_id' => 3, 'name' => 'Application', 'route' => 'application/new-application', 'display_order' => 1],

            //Tasklist
            ['id' => 10, 'system_menu_id' => 4, 'name' => 'Tasklist', 'route' => 'tasklist/tasklist', 'display_order' => 1],
            
            //report
            ['id' => 11, 'system_menu_id' => 5, 'name' => 'Assement Report', 'route' => 'report/assessment-reports', 'display_order' => 1],
            ['id' => 12, 'system_menu_id' => 5, 'name' => 'Application List', 'route' => 'report/application-lists', 'display_order' => 2],

            //event registration
            ['id' => 13, 'system_menu_id' => 6, 'name' => 'Event Registration', 'route' => 'events/travel-fairs-event', 'display_order' => 1],
        ]);
    }
}
