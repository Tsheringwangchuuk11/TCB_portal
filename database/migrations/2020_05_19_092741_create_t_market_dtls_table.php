<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMarketDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_market_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fam_dtls_id')->index()->nullable();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->string('city')->nullable();

            $table->foreign('fam_dtls_id')->references('id')->on('t_fam_dtls');
            $table->foreign('country_id')->references('id')->on('t_country_masters');
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
        Schema::dropIfExists('t_market_dtls');
    }
}
