<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOfficeDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_office_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('operator_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('office_id')->index();
            $table->boolean('office_status')->default(0);

            $table->timestamps();

            $table->foreign('operator_dtls_id')->references('id')->on('t_operator_dtls');
            $table->foreign('office_id')->references('id')->on('t_offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_office_dtls');
    }
}
