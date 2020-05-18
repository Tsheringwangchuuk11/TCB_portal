<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTItemDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_item_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('festival_event_id')->index();
            $table->string('items_name')->nullable();
            $table->decimal('item_costs',12,2)->nullable();
            $table->timestamps();

            $table->foreign('festival_event_id')->references('id')->on('t_festival_event_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_item_dtls');
    }
}
