<?php

use Illuminate\Database\Seeder;

class OfficeInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_offices')->insert([
            ['id' => 1, 'office_name' =>'Office Space'],
            ['id' => 2, 'office_name' =>'If Attached with Residence'],
            ['id' => 3, 'office_name' =>'Proper Sign Board'],
        ]);
    }
}
