<?php

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_vehicles')->insert([
            ['id' => 1, 'vehicle_name' => 'Coaster Bus'],
            ['id' => 2, 'vehicle_name' => 'Hiace/Mini Bus'],
            ['id' => 3, 'vehicle_name' => 'SUVs'],
            ['id' => 4, 'vehicle_name' => 'Cars'],
            ['id' => 5, 'vehicle_name' => 'Office Pool Vehicle'],
        ]);
    }
}
