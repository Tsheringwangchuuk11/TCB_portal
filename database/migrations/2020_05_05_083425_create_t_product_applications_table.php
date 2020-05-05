<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProductApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_product_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->string('objective')->nullable();
            $table->text('product_des')->nullable();
            $table->decimal('project_cost',12,2)->nullable();
            $table->string('timeline')->nullable();
            $table->string('contribution')->nullable();

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
        Schema::dropIfExists('t_product_applications');
    }
}
