<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEquipmentDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_equipment_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('operator_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('equipment_id')->nullable()->index();
            $table->boolean('equipment_status')->default(0);

            $table->timestamps();
            $table->foreign('operator_dtls_id')->references('id')->on('t_operator_dtls');
            $table->foreign('equipment_id')->references('id')->on('t_equipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_equipment_dtls');
    }
}
