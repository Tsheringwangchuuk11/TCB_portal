<?php

use Illuminate\Database\Seeder;

class BasicStandardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_basic_standards')->insert([
            ['id' => 1, 'standard_code' => 'B', 'standard_desc' => ' B* is mandatory parameter which the hotel must fulfil and if not met, the hotel cannot be granted the star rating.', 'created_by' => 1],
            ['id' => 2, 'standard_code' => 'B*', 'standard_desc' => ' B is the basic standard which can be considered (3 or 4 points can be considered based on the star category)', 'created_by' => 1],
        ]);
    }
}
