<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTChecklistDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_checklist_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tourist_standard_id')->index();
            $table->unsignedBigInteger('checklist_id');
            $table->string('checklist_pts')->nullable();
            $table->string('ratingpoint')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->foreign('tourist_standard_id')->references('id')->on('t_tourist_standard_dtls');
            $table->foreign('checklist_id')->references('id')->on('t_check_list_standards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_checklist_dtls');
    }
}
