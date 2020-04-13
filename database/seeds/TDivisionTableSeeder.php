<?php

use Illuminate\Database\Seeder;

class TDivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_divisions')->insert([
            ['id' => 1, 'name' => 'Quality Assurance Division', 'code' => 'QAD', 'created_by' => 1],
            ['id' => 2, 'name' => 'Infrastructure and Product Development Division', 'code' => 'IPDD', 'created_by' => 1],
            ['id' => 3, 'name' => 'Services Division', 'code' => 'SD', 'created_by' => 1],
            ['id' => 4, 'name' => 'Secretariat Services', 'code' => 'SS', 'created_by' => 1],
            ['id' => 5, 'name' => 'Tourism Promotion Division ', 'code' => 'TPD', 'created_by' => 1],
        ]);
    }
}
