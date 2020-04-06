<?php

use Illuminate\Database\Seeder;

class TUserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_user_roles')->insert([
            'id' => 1,
            'user_id' => 1,
            'role_id' => 1,
            'created_by' => 1
        ]);
    }
}
