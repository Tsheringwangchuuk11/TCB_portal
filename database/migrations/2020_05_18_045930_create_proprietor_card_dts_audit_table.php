<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProprietorCardDtsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_proprietor_card_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proprietor_dtls_id')->index();
            $table->string('name', 250)->nullable();
            $table->string('company_name', 250)->nullable();
            $table->string('license_no', 20)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('location', 250)->nullable();
            $table->date('validity_date')->nullable();
            $table->unsignedBigInteger('verified_by')->index();
            $table->timestamps();

            $table->foreign('proprietor_dtls_id')->references('id')->on('t_proprietor_card_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_proprietor_card_dtls_audit');
    }
}
