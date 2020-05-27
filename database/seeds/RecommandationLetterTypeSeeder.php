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
            ['id' => 1, 'recommandation_letter_type' =>'Proprietor'],
            ['id' => 2, 'recommandation_letter_type' =>'Tour Operator '],
            ['id' => 3, 'recommandation_letter_type' =>'Marketing Officer '],
            ['id' => 4, 'recommandation_letter_type' =>'Visa'],
        ]);
    }
}
