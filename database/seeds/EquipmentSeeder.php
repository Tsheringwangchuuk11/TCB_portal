<?php

use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_equipments')->insert([
            ['id' => 1,'equipment_name' => 'Computers', 'equipment_type' => 'O'],
            ['id' => 2,'equipment_name' => 'Printers', 'equipment_type' => 'O'],
            ['id' => 3,'equipment_name' => 'Photocopy Machine', 'equipment_type' => 'O'],
            ['id' => 4,'equipment_name' => 'Appropriate Office Furniture', 'equipment_type' => 'O'],
            ['id' => 5,'equipment_name' => 'Proper Postal Address', 'equipment_type' => 'C'],
            ['id' => 6,'equipment_name' => 'Internet Connection', 'equipment_type' => 'C'],
            ['id' => 7,'equipment_name' => 'Proper Email Address', 'equipment_type' => 'C'],
            ['id' => 8,'equipment_name' => 'Functional Website', 'equipment_type' => 'C'],
            ['id' => 9,'equipment_name' => 'Sleeping tents', 'equipment_type' => 'T'],
            ['id' => 10,'equipment_name' => 'Dining tents', 'equipment_type' => 'T'],
            ['id' => 11,'equipment_name' => 'Toilet tents', 'equipment_type' => 'T'],
            ['id' => 12,'equipment_name' => 'Trekking Chairs & Tables', 'equipment_type' => 'T'],
            ['id' => 13,'equipment_name' => 'Kitchen Equipments', 'equipment_type' => 'T'],
        ]);
    }
}
