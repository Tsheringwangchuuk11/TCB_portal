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
            ['id' => 1,  'division_id' => 2, 'name' => 'Apply For Technical Clearance', 'created_by' => 1],
            ['id' => 2,  'division_id' => 3, 'name' => 'Apply For Tour Operator License Clearance - New License', 'created_by' => 1],
            ['id' => 3,  'division_id' => 1, 'name' => 'Apply For Registration  and Assessment/Renew', 'created_by' => 1],
            ['id' => 4,  'division_id' => 3, 'name' => 'Apply For Recommendation Letter For Import License', 'created_by' => 1],
            ['id' => 5,  'division_id' => 1, 'name' => 'Apply For Recommendation Letter For Work Permit', 'created_by' => 1],
            ['id' => 6,  'division_id' => 3, 'name' => 'Apply For Ownership/Name Change/Cancellation', 'created_by' => 1],

            ['id' => 7,  'division_id' => 1, 'name' => 'Apply For Village Home Stay Registration And Assessment/Renew', 'created_by' => 1],
            ['id' => 8,  'division_id' => 1, 'name' => 'Apply For License Cancellation', 'created_by' => 1],

            ['id' => 9,  'division_id' => 1, 'name' => 'Apply For Registration and Assessment', 'created_by' => 1],
            ['id' => 10, 'division_id' => 3, 'name' => 'Apply For Ownership /Name change', 'created_by' => 1],

            ['id' => 11, 'division_id' => 3, 'name' => 'Apply For Ownership /Name /Location Change', 'created_by' => 1],
            ['id' => 12, 'division_id' => 3, 'name' => 'Apply For Proprietor Card', 'created_by' => 1],
            ['id' => 13, 'division_id' => 5, 'name' => 'Recommendation Letter for Tourism Industry Partners', 'created_by' => 1],
            ['id' => 14, 'division_id' => 3, 'name' => 'Apply For Renewal of expired trade license', 'created_by' => 1],

            ['id' => 15, 'division_id' => 2, 'name' => 'Apply For EOI of New Tourism Product Development', 'created_by' => 1],
            ['id' => 16, 'division_id' => 2, 'name' => 'Apply For Recommendationn Letter Of New Tourism Product Development', 'created_by' => 1],
            ['id' => 17, 'division_id' => 2, 'name' => 'Existing Tourism Product', 'created_by' => 1],

            ['id' => 18, 'division_id' => 3, 'name' => 'Grievance Redressal', 'created_by' => 1],

            ['id' => 19, 'division_id' => 5, 'name' => 'FAM', 'created_by' => 1],

            ['id' => 20, 'division_id' => 5, 'name' => 'Registration For Tourism Events', 'created_by' => 1],
        ]);
    }
}
