<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEmploymentApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_employment_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->unsignedBigInteger('employment_id')->nullable()->index();
            $table->boolean('employment_status')->default(0);
            $table->char('nationality',1)->nullable();

            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('employment_id')->references('id')->on('t_employments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_employment_applications');
    }
}
