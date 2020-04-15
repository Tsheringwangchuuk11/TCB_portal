<?php

use Illuminate\Database\Seeder;

class DzongkhagMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_dzongkhag_masters')->insert([
            ['id' => 1, 'dzongkhag_name' => 'Bumthang'],
            ['id' => 2, 'dzongkhag_name' => 'Chukha'],
            ['id' => 3, 'dzongkhag_name' => 'Dagana'],
            ['id' => 4, 'dzongkhag_name' => 'Gasa'],
            ['id' => 5, 'dzongkhag_name' => 'Haa'],
            ['id' => 6, 'dzongkhag_name' => 'Lhuentse'],
            ['id' => 7, 'dzongkhag_name' => 'Mongar'],
            ['id' => 8, 'dzongkhag_name' => 'Paro'],
            ['id' => 9, 'dzongkhag_name' => 'Pemagatshel'],
            ['id' => 10, 'dzongkhag_name' => 'Punakha'],
            ['id' => 11, 'dzongkhag_name' => 'Samdrupjongkhar'],
            ['id' => 12, 'dzongkhag_name' => 'Samtse'],
            ['id' => 13, 'dzongkhag_name' => 'Sarpang'],
            ['id' => 14, 'dzongkhag_name' => 'Thimphu'],
            ['id' => 15, 'dzongkhag_name' => 'Trashigang'],
            ['id' => 16, 'dzongkhag_name' => 'Trashiyangtse'],
            ['id' => 17, 'dzongkhag_name' => 'Trongsa'],
            ['id' => 18, 'dzongkhag_name' => 'Tsirang'],
            ['id' => 19, 'dzongkhag_name' => 'Wangdue Phodrang'],
            ['id' => 20, 'dzongkhag_name' => 'Zhemgang'],
        ]);
    }
}
