<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPartnerDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_partner_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('operator_id')->nullable()->index();
            $table->string('partner_name', 250)->nullable();
            $table->bigInteger('partner_cid_no')->nullable();
            $table->char('partner_gender', 1)->nullable();
            $table->date('partner_dob')->nullable();
            $table->string('partner_flat_no', 20)->nullable();
            $table->string('partner_building_no', 20)->nullable();
            $table->string('partner_location', 250)->nullable();
            $table->unsignedBigInteger('village_id')->index()->nullable();

            $table->timestamps();

            $table->foreign('operator_id')->references('id')->on('t_operator_clearances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_partner_dtls');
    }
}
