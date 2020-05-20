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
            ['module_id' => 1, 'service_id' => 1, 'page_link' => 'services/technical_clearance'],
            ['module_id' => 1, 'service_id' => 2, 'page_link' => 'recommendation_letter_for_import_license'],
            ['module_id' => 1, 'service_id' => 3, 'page_link' => 'services/tax_exemption'],
            ['module_id' => 1, 'service_id' => 4, 'page_link' => 'services/hotels_assessment'],
            ['module_id' => 1, 'service_id' => 5, 'page_link' => 'services/bar_license'],
            ['module_id' => 1, 'service_id' => 6, 'page_link' => 'services/work_permit'],
            ['module_id' => 1, 'service_id' => 7, 'page_link' => 'services/hotels_license_renew'],
            ['module_id' => 1, 'service_id' => 8, 'page_link' => 'services/hotels_license_cancel'],
            ['module_id' => 1, 'service_id' => 9, 'page_link' => 'services/hotels_owner_change'],
            ['module_id' => 1, 'service_id' => 10, 'page_link' => 'services/hotels_name_change'],
            ['module_id' => 2, 'service_id' => 4, 'page_link' => 'services/home_stays_assessment'],
            ['module_id' => 2, 'service_id' => 7, 'page_link' => 'technical-clearance10/create'],
            ['module_id' => 2, 'service_id' => 8, 'page_link' => 'technical-clearance11/create'],
            ['module_id' => 2, 'service_id' => 10, 'page_link' => 'services/home_stays_name_change'],
            ['module_id' => 3, 'service_id' => 4, 'page_link' => 'services/restuarants_assessment'],
            ['module_id' => 3, 'service_id' => 5, 'page_link' => 'services/restuarant_bar_license'],
            ['module_id' => 3, 'service_id' => 7, 'page_link' => 'services/restuarant_license_renew'],
            ['module_id' => 3, 'service_id' => 8, 'page_link' => 'services/restuarant_license_cancel'],
            ['module_id' => 3, 'service_id' => 9, 'page_link' => 'services/restuarant_owner_change'],
            ['module_id' => 3, 'service_id' => 10, 'page_link' => 'services/restuarant_name_change'],
            ['module_id' => 4, 'service_id' => 2, 'page_link' => 'technical-clearance21/create'],
            ['module_id' => 4, 'service_id' => 9, 'page_link' => 'services/to_owner_change'],
            ['module_id' => 4, 'service_id' => 10, 'page_link' => 'services/to_name_change'],
            ['module_id' => 4, 'service_id' => 11, 'page_link' => 'services/propreiter_card'],
            ['module_id' => 4, 'service_id' => 12, 'page_link' => 'services/letter_for_to_license'],
            ['module_id' => 4, 'service_id' => 13, 'page_link' => 'services/to_license_renew'],
            ['module_id' => 4, 'service_id' => 15, 'page_link' => 'services/travel_fair_registration'],
            ['module_id' => 4, 'service_id' => 16, 'page_link' => 'services/recommandation_letter'],
            ['module_id' => 4, 'service_id' => 17, 'page_link' => 'services/mice'],
            ['module_id' => 5, 'service_id' => 18, 'page_link' => 'services/tourism_product_development'],
            ['module_id' => 2, 'service_id' => 9, 'page_link' => 'services/home_stays_owner_change'],
            ['module_id' => 4, 'service_id' => 4, 'page_link' => 'services/to_assessment'],
            ['module_id' => 5, 'service_id' => 19, 'page_link' => 'services/tourism_product_proposal'],
            ['module_id' => 7, 'service_id' => 14, 'page_link' => 'services/media_familiarization_tour'],
            ['module_id' => 6, 'service_id' => 20, 'page_link' => 'services/grievance'],
            ['module_id' => 4, 'service_id' => 21, 'page_link' => 'services/to_new _license'],
            ['module_id' => 7, 'service_id' => 22, 'page_link' => 'services/tour_operator_fam'],

        ]);
    }
}
