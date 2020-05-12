<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTChecklistApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_checklist_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->index();
            $table->unsignedBigInteger('checklist_id');
            // $table->string('checklist_pts')->nullable();
            $table->text('remarks')->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
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
        Schema::dropIfExists('t_checklist_applications');
    }
}
