<?php

use Illuminate\Database\Seeder;

class TSystemMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_system_menus')->insert([
            ['id' => 1, 'name' => 'System Administration', 'icon' => 'fa-cogs', 'display_type' => 'side', 'display_order' => 1],
            ['id' => 2, 'name' => 'Application', 'icon' => 'fa-cogs', 'display_type' => 'side', 'display_order' => 2],
        ]);
    }
}
