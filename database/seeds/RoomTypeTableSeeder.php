<?php

use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_room_types')->insert([
            ['id' => 1, 'room_name' => 'Single'],
            ['id' => 2, 'room_name' => 'Double'],
            ['id' => 3, 'room_name' => 'Suite'],
        ]);
    }
}
