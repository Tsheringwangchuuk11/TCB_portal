<?php

use Illuminate\Database\Seeder;

class TUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_users')->insert([
            'id' => 1,
            'user_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'user_status' => 1,
            'is_verified' => 1
        ]);
    }
}
