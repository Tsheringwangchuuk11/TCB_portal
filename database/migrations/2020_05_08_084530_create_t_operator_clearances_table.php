<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOperatorClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_operator_clearances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cid_no')->index();
            $table->string('name', 250)->nullable();
            $table->char('gender', 1)->nullable();
            $table->date('dob')->nullable();
            $table->string('applicant_flat_no', 20)->nullable();
            $table->string('applicant_building_no', 20)->nullable();
            $table->string('applicant_location', 250)->nullable();
            $table->string('company_name', 250)->nullable();
            $table->bigInteger('village_id')->index()->nullable();
            $table->string('location', 250)->nullable();
            $table->string('flat_no', 20)->nullable();
            $table->string('building_no', 20)->nullable();
            $table->string('postal_address', 250)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('reference_no', 20)->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('t_operator_clearances');
    }
}
