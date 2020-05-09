<?php

use Illuminate\Database\Seeder;

class LastApplicationNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_application_last_serial_number')->insert([
            ['id' => 1, 'last_application_no' => 0, 'service_id' => 1],
            ['id' => 2, 'last_application_no' => 0, 'service_id' => 2],
            ['id' => 3, 'last_application_no' => 0, 'service_id' => 3],
            ['id' => 4, 'last_application_no' => 0, 'service_id' => 4],
            ['id' => 5, 'last_application_no' => 0, 'service_id' => 5],
            ['id' => 6, 'last_application_no' => 0, 'service_id' => 6],
            ['id' => 7, 'last_application_no' => 0, 'service_id' => 7],
            ['id' => 8, 'last_application_no' => 0, 'service_id' => 8],
            ['id' => 9, 'last_application_no' => 0, 'service_id' => 9],
            ['id' => 10, 'last_application_no' => 0, 'service_id' => 10],
            ['id' => 11, 'last_application_no' => 0, 'service_id' => 11],
            ['id' => 12, 'last_application_no' => 0, 'service_id' => 12],
            ['id' => 13, 'last_application_no' => 0, 'service_id' => 13],
            ['id' => 14, 'last_application_no' => 0, 'service_id' => 14],
            ['id' => 15, 'last_application_no' => 0, 'service_id' => 15],
            ['id' => 16, 'last_application_no' => 0, 'service_id' => 16],
            ['id' => 17, 'last_application_no' => 0, 'service_id' => 17],
            ['id' => 18, 'last_application_no' => 0, 'service_id' => 18],
            ['id' => 19, 'last_application_no' => 0, 'service_id' => 19],
            ['id' => 20, 'last_application_no' => 0, 'service_id' => 20],
            ['id' => 21, 'last_application_no' => 0, 'service_id' => 21],
            ['id' => 22, 'last_application_no' => 0, 'service_id' => 22],
        ]);
    }
}
