<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTChecklistDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_checklist_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('checklist_dtls_id')->index();
            $table->unsignedBigInteger('tourist_standard_id')->index();
            $table->unsignedBigInteger('checklist_id');
            $table->string('checklist_pts')->nullable();
            $table->string('ratingpoint')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('checklist_dtls_id')->references('id')->on('t_checklist_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_checklist_dtls_audit');
    }
}
