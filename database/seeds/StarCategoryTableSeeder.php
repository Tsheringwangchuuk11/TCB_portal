<?php

use Illuminate\Database\Seeder;

class StarCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('star_categories')->insert([
            ['id' => 1, 'module_id' => 1, 'star_category_name' => '3 star', 'score_pts' => '160 – 199', 'basic_standard' => '117 out of 120', 'created_by' => 1],
            ['id' => 2, 'module_id' => 1, 'star_category_name' => '4 star', 'score_pts' => '200 – 279', 'basic_standard' => '145 out of 149', 'created_by' => 1],
            ['id' => 3, 'module_id' => 1, 'star_category_name' => '5 star', 'score_pts' => '280 +', 'basic_standard' => '162 out of 166', 'created_by' => 1],
        ]);
    }
}
