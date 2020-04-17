<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_module_service_mapping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->index();
            $table->unsignedBigInteger('service_id')->index();
            $table->string('page_link', 500);
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('t_module_masters');
            $table->foreign('service_id')->references('id')->on('t_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_module_service_mapping');
    }
}
