<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProductDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_product_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proponent_dlts_id')->index();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->string('objective')->nullable();
            $table->text('product_des')->nullable();
            $table->decimal('project_cost',12,2)->nullable();
            $table->string('timeline')->nullable();
            $table->string('contribution')->nullable();
            $table->timestamps();

            $table->foreign('proponent_dlts_id')->references('id')->on('t_proponent_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_product_dtls');
    }
}
