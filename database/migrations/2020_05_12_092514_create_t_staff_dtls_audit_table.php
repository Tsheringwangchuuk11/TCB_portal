<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTStaffDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_staff_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staff_dtls_id')->index();
            $table->unsignedBigInteger('tourist_standard_id')->nullable()->index();
            $table->unsignedBigInteger('staff_area_id')->nullable()->index();
            $table->unsignedBigInteger('hotel_div_id')->nullable()->index();
            $table->string('staff_name')->nullable();
            $table->char('staff_gender',1)->nullable();

            $table->timestamps();
            $table->foreign('staff_dtls_id')->references('id')->on('t_staff_dtls');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_staff_dtls_audit');
    }
}
