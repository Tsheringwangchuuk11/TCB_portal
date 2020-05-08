<?php

use Illuminate\Database\Seeder;

class EmploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_employments')->insert([
            ['id' => 1, 'employment_name' => 'Managing Director/CEO'],
            ['id' => 2, 'employment_name' => 'General Manager '],
            ['id' => 3, 'employment_name' => 'Finance/Administration Officer'],
            ['id' => 4, 'employment_name' => 'Tour/trekking Guides'],
            ['id' => 5, 'employment_name' => 'Operation/Reservation Managers'],
            ['id' => 6, 'employment_name' => 'Accountant'],
            ['id' => 7, 'employment_name' => 'Assistant Managers'],
            ['id' => 8, 'employment_name' => 'Office Assistants'],
            ['id' => 9, 'employment_name' => 'Ticketing Staff'],
            ['id' => 10, 'employment_name' => 'Drivers'],
            ['id' => 11, 'employment_name' => 'Trekking Cooks'],
            ['id' => 12, 'employment_name' => 'Trek Assistants'],
        ]);
    }
}
