<?php

use Illuminate\Database\Seeder;

class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_service_providers')->insert([
            ['id' => 1, 'service_provider_name' => 'Tourism Council of Bhutan'],
            ['id' => 2, 'service_provider_name' => 'Tour guide '],
            ['id' => 3, 'service_provider_name' => 'Tour operator'],
            ['id' => 4, 'service_provider_name' => 'Accommodation providers'],
            ['id' => 5, 'service_provider_name' => 'Horse contractor'],
            ['id' => 6, 'service_provider_name' => 'Transport provider'],
            ['id' => 7, 'service_provider_name' => 'Other service provider'],
        ]);
    }
}
