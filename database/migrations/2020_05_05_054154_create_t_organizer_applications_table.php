<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOrganizerApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_organizer_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->string('organizer_name')->nullable();
            $table->string('organizer_address', 250)->nullable();
            $table->string('organizer_phone', 20)->nullable();
            $table->string('organizer_email', 250)->nullable();
            $table->char('organizer_type', 1)->nullable();
            $table->decimal('amount_requested',12,2)->nullable();
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
        Schema::dropIfExists('t_organizer_applications');
    }
}
