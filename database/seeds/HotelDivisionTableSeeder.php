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
            ['id' => 1, 'staff_area_id'=> '1' ,'hotel_div_name' => 'Reception'],
            ['id' => 2, 'staff_area_id'=> '1' ,'hotel_div_name' => 'Reservation'],
            ['id' => 3, 'staff_area_id'=> '1' ,'hotel_div_name' => 'Front-Office'],
            ['id' => 4, 'staff_area_id'=> '1' ,'hotel_div_name' => 'Housekeeping'],
            ['id' => 5, 'staff_area_id'=> '2' ,'hotel_div_name' => 'Service'],
            ['id' => 6, 'staff_area_id'=> '2' ,'hotel_div_name' => 'Kitchen'],
            ['id' => 7, 'staff_area_id'=> '2' ,'hotel_div_name' => 'Purchase (Stewarding)'],
            ['id' => 8, 'staff_area_id'=> '2' ,'hotel_div_name' => 'Banquett,Events'],
            ['id' => 9, 'staff_area_id'=> '3' ,'hotel_div_name' => 'Wellness'],
            ['id' => 10, 'staff_area_id'=> '3' ,'hotel_div_name' => 'Sports'],
            ['id' => 11, 'staff_area_id'=> '3' ,'hotel_div_name' => 'Event-Management '],
            ['id' => 12, 'staff_area_id'=> '4' ,'hotel_div_name' => 'Back-Office'],
            ['id' => 13, 'staff_area_id'=> '4' ,'hotel_div_name' => 'Accounting,Controlling'],
            ['id' => 14, 'staff_area_id'=> '5' ,'hotel_div_name' => 'Sales Departement '],
            ['id' => 15, 'staff_area_id'=> '5' ,'hotel_div_name' => 'Guest relations'],
            ['id' => 16, 'staff_area_id'=> '6' ,'hotel_div_name' => 'Technical Services'],
            ['id' => 17, 'staff_area_id'=> '6' ,'hotel_div_name' => 'Gardener / Greenkeeper'],
            ['id' => 18, 'staff_area_id'=> '6' ,'hotel_div_name' => 'Other staff'],
        ]);
    }
}
