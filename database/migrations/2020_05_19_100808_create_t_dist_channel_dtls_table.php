<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDistChannelDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_dist_channel_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fam_dtls_id')->index()->nullable();
            $table->text('area_coverage')->nullable();
            $table->string('channel_name')->nullable();
            $table->string('channel_link', 250)->nullable();
            $table->unsignedBigInteger('channel_type_id')->index()->nullable();
            $table->date('intended_date')->nullable();

            $table->timestamps();
            $table->foreign('fam_dtls_id')->references('id')->on('t_fam_dtls');
            $table->foreign('channel_type_id')->references('id')->on('t_channel_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_dist_channel_dtls');
    }
}
