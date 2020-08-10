<?php

use Illuminate\Database\Seeder;

class RecommandationLetterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_recommandation_letter_masters')->insert([
            ['id' => 1, 'recommandation_letter_type' =>'Company Validation/Confirmation Letter'],
            ['id' => 2, 'recommandation_letter_type' =>'International Visa Processing '],
        ]);
    }
}
