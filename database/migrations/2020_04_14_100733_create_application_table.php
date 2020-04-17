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
            $table->bigInteger('cid_no')->index();
            $table->string('name', 250)->nullable();
            $table->string('name_one', 250)->nullable();
            $table->string('name_two', 250)->nullable();
            $table->string('proposed_location', 250)->nullable();
            $table->integer('location_id')->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('tentative_cons', 100)->nullable();
            $table->string('tentative_com', 100)->nullable();
            $table->date('drawing_date')->nullable();
            $table->string('email', 100)->nullable();
            $table->unsignedBigInteger('star_category_id')->nullable();
            $table->string('license_no', 20)->nullable();
            $table->string('owner', 250)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('tax', 20)->nullable();
            $table->string('internet_url', 250)->nullable();
            $table->string('bed_no', 20)->nullable();
            $table->string('thram_no',20)->nullable();
            $table->string('house_no',20)->nullable();
            $table->string('town_distance',250)->nullable();
            $table->string('road_distance', 250)->nullable();
            $table->string('condition',250)->nullable();
            $table->date('validity_date')->nullable();
            $table->string('flat_no', 20)->nullable();
            $table->string('building_no', 20)->nullable();


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
