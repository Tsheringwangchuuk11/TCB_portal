<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTActivityApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_activity_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->index();
            $table->text('activities')->nullable();

            $table->foreign('application_no')->references('application_no')->on('t_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_activity_applications');
    }
}
