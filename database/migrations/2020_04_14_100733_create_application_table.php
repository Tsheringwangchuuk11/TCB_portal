<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_applications', function (Blueprint $table) {
            $table->string('application_no', 20)->primary();
            $table->unsignedBigInteger('module_id')->index();
            $table->unsignedBigInteger('service_id')->index();
            $table->unsignedBigInteger('event_id')->index()->nullable();
            $table->unsignedBigInteger('end_user_id')->index();
            $table->bigInteger('cid_no')->index();
            $table->string('applicant_name', 250)->nullable();
            $table->char('gender', 1)->nullable();
            $table->date('dob')->nullable();
            $table->string('designation', 250)->nullable();
            $table->string('applicant_flat_no', 20)->nullable();
            $table->string('applicant_building_no', 20)->nullable();
            $table->string('applicant_location', 250)->nullable();
            $table->string('company_title_name', 250)->nullable();
            $table->string('company_name_one', 250)->nullable();
            $table->string('company_name_two', 250)->nullable();
            $table->string('location', 250)->nullable();
            $table->integer('location_id')->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('tentative_cons', 100)->nullable();
            $table->string('tentative_com', 100)->nullable();
            $table->date('drawing_date')->nullable();
            $table->string('email', 100)->nullable();
            $table->unsignedBigInteger('star_category_id')->nullable();
            $table->string('license_no', 20)->nullable();
            $table->date('license_date')->nullable();
            $table->string('owner_name', 250)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('webpage_url', 250)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('thram_no',20)->nullable();
            $table->string('house_no',20)->nullable();
            $table->string('town_distance',250)->nullable();
            $table->string('road_distance', 250)->nullable();
            $table->string('condition',250)->nullable();
            $table->date('validity_date')->nullable();
            $table->string('flat_no', 20)->nullable();
            $table->string('building_no', 20)->nullable();
            $table->bigInteger('village_id')->index()->nullable();
            $table->bigInteger('chiwog_id')->index()->nullable();
            $table->bigInteger('gewog_id')->index()->nullable();
            $table->string('city', 250)->nullable();
            $table->bigInteger('country_id')->index()->nullable();
            $table->text('visit_purpose')->nullable();
            $table->boolean('sell_destination')->default(0);
            $table->boolean('sell_bhutan')->default(0);
            $table->year('destination_year')->nullable();
            $table->year('bhutan_year')->nullable();
            $table->date('date')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->year('financial_year')->nullable();
            $table->bigInteger('letter_type_id')->nullable();
            $table->text('remarks')->nullable();
            //$table->string('financial_year', 4)->nullable();
            $table->foreign('end_user_id')->references('id')->on('t_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_applications');
    }
}
