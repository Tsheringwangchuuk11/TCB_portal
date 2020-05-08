<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCompanyInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_company_infomations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->index();
            $table->string('company_name',250)->nullable();
            $table->string('company_location',250)->nullable();
            $table->string('company_building_no',100)->nullable();
            $table->string('company_flat_no',100)->nullable();
            $table->string('company_postal_address')->nullable();
            $table->bigInteger('company_contact_no')->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_company_infomations');
    }
}
