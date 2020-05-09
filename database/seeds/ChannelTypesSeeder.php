<?php

use Illuminate\Database\Seeder;

class ChannelTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_channel_types')->insert([
             ['id' => 1,'channel_type' => 'Online'],
             ['id' => 2,'channel_type' => 'TV'],   
             ['id' => 3,'channel_type' => 'Print'],    
             ['id' => 4,'channel_type' => 'Others'],    
        ]);
    }
}
