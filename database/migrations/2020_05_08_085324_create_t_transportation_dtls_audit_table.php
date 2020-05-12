<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTransportationDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transportation_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transport_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('operator_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('vehicle_id')->nullable()->index();
            $table->boolean('transport_status')->default(0);
            $table->boolean('fitness')->default(0);

            $table->timestamps();
            $table->foreign('transport_dtls_id')->references('id')->on('t_transportation_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_transportation_dtls_audit');
    }
}
