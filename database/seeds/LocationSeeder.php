<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_locations')->insert([
            ['id' => 1, 'location_name' => 'Bumthang'],
            ['id' => 2, 'location_name' => 'Chukha'],
            ['id' => 3, 'location_name' => 'Dagana'],
            ['id' => 4, 'location_name' => 'Gasa'],
            ['id' => 5, 'location_name' => 'Haa'],
            ['id' => 6, 'location_name' => 'Lhuentse'],
            ['id' => 7, 'location_name' => 'Mongar'],
            ['id' => 8, 'location_name' => 'Paro'],
            ['id' => 9, 'location_name' => 'Pemagatshel'],
            ['id' => 10, 'location_name' => 'Punakha'],
            ['id' => 11, 'location_name' => 'Samdrupjongkhar'],
            ['id' => 12, 'location_name' => 'Samtse'],
            ['id' => 13, 'location_name' => 'Sarpang'],
            ['id' => 14, 'location_name' => 'Thimphu'],
            ['id' => 15, 'location_name' => 'Trashigang'],
            ['id' => 16, 'location_name' => 'Trashiyangtse'],
            ['id' => 17, 'location_name' => 'Trongsa'],
            ['id' => 18, 'location_name' => 'Tsirang'],
            ['id' => 19, 'location_name' => 'Wangdue Phodrang'],
            ['id' => 20, 'location_name' => 'Zhemgang'],
        ]);
    }
}
