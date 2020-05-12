<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEquipmentDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_equipment_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipment_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('operator_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('equipment_id')->nullable()->index();
            $table->boolean('equipment_status')->default(0);

            $table->timestamps();
            $table->foreign('equipment_dtls_id')->references('id')->on('t_equipment_dtls');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_equipment_dtls_audit');
    }
}
