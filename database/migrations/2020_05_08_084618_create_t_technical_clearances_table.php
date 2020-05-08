<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTechnicalClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_technical_clearances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cid_no')->index();
            $table->string('name', 250)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->bigInteger('gewog_id')->index()->nullable();
            $table->string('location', 250)->nullable();
            $table->string('proposed_rooms_no', 20)->nullable();
            $table->string('tentative_cons', 100)->nullable();
            $table->string('tentative_com', 100)->nullable();
            $table->date('drawing_date')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('submitted_by', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_technical_clearances');
    }
}
