<?php

use Illuminate\Database\Seeder;

class ModuleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('t_module_service_mapping')->insert([
            //Tourist Standard Hotel
            ['module_id' => 1, 'service_id' => 1, 'page_link' => 'services/technical_clearance'],
            ['module_id' => 1, 'service_id' => 3, 'page_link' => 'services/hotels_assessment'],
            ['module_id' => 1, 'service_id' => 4, 'page_link' => 'services/hotel_recommendation_letter_for_import_license'],
            ['module_id' => 1, 'service_id' => 5, 'page_link' => 'services/work_permit'],
            ['module_id' => 1, 'service_id' => 6, 'page_link' => 'services/hotel_ownership_name_cancellation'],

           // Village Home Stay
            ['module_id' => 2, 'service_id' => 7, 'page_link' => 'services/home_stays_assessment'],
            ['module_id' => 2, 'service_id' => 8, 'page_link' => 'services/home_stays_registration_cancel'],

            //Restaurant
            ['module_id' => 3, 'service_id' => 9, 'page_link' => 'services/restuarants_assessment'],
            ['module_id' => 3, 'service_id' => 10, 'page_link' => 'services/restuarant_ownership_name_change'],

            //Tour Opeartor
            ['module_id' => 4, 'service_id' => 2, 'page_link' => 'services/to_license_clearance_new _license'],
            ['module_id' => 4, 'service_id' => 9, 'page_link' => 'services/to_assessment'],
            ['module_id' => 4, 'service_id' => 11, 'page_link' => 'services/to_name_ownership_location_change'],
            ['module_id' => 4, 'service_id' => 12, 'page_link' => 'services/propreiter_card'],
            ['module_id' => 4, 'service_id' => 13, 'page_link' => 'services/recommandation_letter_for_tourism_industry_partners'],
            ['module_id' => 4, 'service_id' => 4, 'page_link' => 'services/to_recommendation_letter_for_import_license'],
            ['module_id' => 4, 'service_id' => 14, 'page_link' => 'services/to_license_renew'],

            //Tourism Product
            ['module_id' => 5, 'service_id' => 15, 'page_link' => 'services/eoi'],
            ['module_id' => 5, 'service_id' => 16, 'page_link' => 'services/tourism_product_development'],
            ['module_id' => 5, 'service_id' => 17, 'page_link' => 'services/tourism_product_proposal'],

            //Feed back
            ['module_id' => 6, 'service_id' => 18, 'page_link' => 'services/grievance'],

            //Media
            ['module_id' => 7, 'service_id' => 19, 'page_link' => 'services/media_familiarization_tour'],

            //Tourism Event
            ['module_id' => 8, 'service_id' => 20, 'page_link' => 'services/registration_for_tourism_events'],
        ]);
    }
}
