<?php

use Illuminate\Database\Seeder;

class TServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_services')->insert([
            ['id' => 1, 'division_id' => 2, 'name' => 'Apply for Tech Clearance', 'created_by' => 1],
            ['id' => 2, 'division_id' => 3, 'name' => 'Apply for Recommendation Letter for Import License', 'created_by' => 1],
            ['id' => 3, 'division_id' => 3, 'name' => 'Apply for Tax Exemption', 'created_by' => 1],
            ['id' => 4, 'division_id' => 1, 'name' => 'Apply for Registration & Assessment', 'created_by' => 1],
            ['id' => 5, 'division_id' => 3, 'name' => 'Apply for Bar License', 'created_by' => 1],
            ['id' => 6, 'division_id' => 3, 'name' => 'Apply for Recommendation Letter for Work Permit', 'created_by' => 1],
            ['id' => 7, 'division_id' => 1, 'name' => 'Apply for Renewal', 'created_by' => 1],
            ['id' => 8, 'division_id' => 1, 'name' => 'Apply for Cancellation', 'created_by' => 1],
            ['id' => 9, 'division_id' => 3, 'name' => 'Apply for Ownership Change', 'created_by' => 1],
            ['id' => 10, 'division_id' => 3, 'name' => 'Apply for Name Change', 'created_by' => 1],
            ['id' => 11, 'division_id' => 3, 'name' => 'Apply for Proprietors Card', 'created_by' => 1],
            ['id' => 12, 'division_id' => 3, 'name' => 'Apply for Recommendation Letter for TO License', 'created_by' => 1],
            ['id' => 13, 'division_id' => 3, 'name' => 'Renewal of expired trade license', 'created_by' => 1],
            ['id' => 14, 'division_id' => 5, 'name' => 'FAM', 'created_by' => 1],
            ['id' => 15, 'division_id' => 5, 'name' => 'Event Registration for Travel Fairs', 'created_by' => 1],
            ['id' => 16, 'division_id' => 5, 'name' => 'Recommendation Letter', 'created_by' => 1],
            ['id' => 17, 'division_id' => 5, 'name' => 'MICE', 'created_by' => 1],
            ['id' => 18, 'division_id' => 2, 'name' => 'Apply for Recommendation Letter of New Tourism Product Development', 'created_by' => 1],
            ['id' => 19, 'division_id' => 2, 'name' => 'Proposal form', 'created_by' => 1],
            ['id' => 20, 'division_id' => 4, 'name' => 'Grevience Redressal', 'created_by' => 1],
            ['id' => 21, 'division_id' => 3, 'name' => 'New License', 'created_by' => 1],
        ]);
    }
}
