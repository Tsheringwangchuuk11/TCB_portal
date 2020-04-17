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
            ['id' => 1, 'name' => 'Administration', 'icon' => 'fa-cogs', 'display_order' => 1],
            ['id' => 2, 'name' => 'Master', 'icon' => 'fa-list-ul', 'display_order' => 2],
            ['id' => 3, 'name' => 'Application', 'icon' => 'fa-cogs', 'display_order' => 3],
        ]);
    }
}
