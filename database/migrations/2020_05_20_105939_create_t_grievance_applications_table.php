<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTGrievanceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_grievance_applications', function (Blueprint $table) {
            $table->string('application_no', 20)->primary();
            $table->string('complainant_name', 250)->nullable();
            $table->string('complainant_address', 250)->nullable();
            $table->string('complainant_mobile_no', 20)->nullable();
            $table->string('complainant_telephone_no', 20)->nullable();
            $table->string('complainant_email', 100)->nullable();
            $table->char('applicant_type', 1)->nullable();
            $table->string('respondent_name', 250)->nullable();
            $table->string('respondent_address', 250)->nullable();
            $table->string('respondent_mobile_no', 20)->nullable();
            $table->string('respondent_telephone_no', 20)->nullable();
            $table->string('respondent_email', 100)->nullable();
            $table->unsignedBigInteger('service_provider_id')->index()->nullable();
            $table->text('claim_summary')->nullable();
            $table->text('remedy_sought')->nullable();
            $table->integer('location_id')->index()->nullable();
            $table->date('date')->nullable();

            $table->foreign('service_provider_id')->references('id')->on('t_service_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_grievance_applications');
    }
}
