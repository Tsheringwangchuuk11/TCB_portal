<?php

use Illuminate\Database\Seeder;

class ModuleMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module_masters')->insert([
            ['id' => 1, 'module_name' => 'Tourist Standard Hotel', 'module_code' => 'TS', 'created_by' => 1],
            ['id' => 2, 'module_name' => 'Village Home Stay', 'module_code' => 'VHS', 'created_by' => 1],
            ['id' => 3, 'module_name' => 'Restaurant', 'module_code' => 'R', 'created_by' => 1],
            ['id' => 4, 'module_name' => 'Tour Operator', 'module_code' => 'TO', 'created_by' => 1],
            ['id' => 5, 'module_name' => 'Tourism Product', 'module_code' => 'TP', 'created_by' => 1],
            ['id' => 6, 'module_name' => 'Grievance Redressal', 'module_code' => 'GR', 'created_by' => 1],
            ['id' => 7, 'module_name' => 'Media', 'module_code' => 'M', 'created_by' => 1],
            ['id' => 8, 'module_name' => 'Budget Hotel', 'module_code' => 'BH', 'created_by' => 1],
        ]);
    }
}
