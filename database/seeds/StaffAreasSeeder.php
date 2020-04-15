<?php

use Illuminate\Database\Seeder;

class StaffAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_staff_areas')->insert([
            ['id' => 1, 'staff_area_name' => 'Lodging'],
            ['id' => 2, 'staff_area_name' => 'Food & Beverage'],
            ['id' => 3, 'staff_area_name' => 'Recreation,Other'],
            ['id' => 4, 'staff_area_name' => 'Administration'],
            ['id' => 5, 'staff_area_name' => 'Sales & Marketing'],
            ['id' => 6, 'staff_area_name' => 'Pomec (Property Operation & Maintance)'],
        ]);
    }
}
