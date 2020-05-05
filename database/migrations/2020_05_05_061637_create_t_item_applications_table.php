<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTItemApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_item_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->string('items_name')->nullable();
            $table->decimal('item_costs',12,2)->nullable();

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
        Schema::dropIfExists('t_item_applications');
    }
}
