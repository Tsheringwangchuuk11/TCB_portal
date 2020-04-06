<?php

use Illuminate\Database\Seeder;

class TRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_roles')->insert([
            ['id' => 1, 'name' => 'Administrator', 'description' => 'Super administrator', 'created_by' => 1],
        ]);
    }
}
