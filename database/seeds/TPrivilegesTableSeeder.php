<?php

use Illuminate\Database\Seeder;

class TPrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_role_privileges')->insert([
            //system settings
		    ['role_id' => 1, 'system_sub_menu_id' => 1, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
		    ['role_id' => 1, 'system_sub_menu_id' => 2, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
		    ['role_id' => 1, 'system_sub_menu_id' => 3, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
            ['role_id' => 1, 'system_sub_menu_id' => 4, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],

            ['role_id' => 1, 'system_sub_menu_id' => 5, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
            ['role_id' => 1, 'system_sub_menu_id' => 6, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
            ['role_id' => 1, 'system_sub_menu_id' => 7, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
            //user role
            ['role_id' => 2, 'system_sub_menu_id' => 8, 'view' => 1, 'create' => 1, 'edit' => 1, 'delete' => 1, 'created_by' => 1],
        ]);
    }
}
