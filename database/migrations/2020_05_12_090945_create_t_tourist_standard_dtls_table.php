<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTouristStandardDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tourist_standard_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->index();
            $table->bigInteger('cid_no')->nullable()->index();
            $table->string('owner_name', 250)->nullable();
            $table->string('license_no', 20)->nullable();
            $table->date('license_date')->nullable();
            $table->string('tourist_standard_name', 250)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('webpage_url', 250)->nullable();
            $table->string('bed_no', 20)->nullable();
            $table->string('thram_no',20)->nullable();
            $table->string('house_no',20)->nullable();
            $table->string('town_distance',250)->nullable();
            $table->string('road_distance', 250)->nullable();
            $table->string('condition',250)->nullable();
            $table->bigInteger('village_id')->index()->nullable();
            $table->unsignedBigInteger('star_category_id')->nullable();
            $table->date('inspection_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_tourist_standard_dtls');
    }
}
