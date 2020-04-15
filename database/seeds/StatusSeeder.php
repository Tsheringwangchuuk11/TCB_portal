<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('t_status_masters')->insert([
            ['status_name' => 'SUBMITTED', 'status_type' => 'W'],
            ['status_name' => 'VERIFIED', 'status_type' => 'W'],
            ['status_name' => 'APPROVED', 'status_type' => 'W'],
            ['status_name' => 'REJECTED', 'status_type' => 'W'],
            ['status_name' => 'INITIATED', 'status_type' => 'T'],
            ['status_name' => 'CLAIMED', 'status_type' => 'T'],
            ['status_name' => 'COMPLETED', 'status_type' => 'T'],
        ]);
    }
}
