<?php

use Illuminate\Database\Seeder;

class HotelDivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_hotel_divisions')->insert([
            ['id' => 1, 'hotel_div_name' => 'Reception'],
            ['id' => 2, 'hotel_div_name' => 'Reservation'],
            ['id' => 3, 'hotel_div_name' => 'Front-Office'],
            ['id' => 4, 'hotel_div_name' => 'Housekeeping'],
        ]);
    }
}
