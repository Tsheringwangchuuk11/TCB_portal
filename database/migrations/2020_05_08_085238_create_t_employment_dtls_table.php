<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEmploymentDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_employment_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('operator_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('employment_id')->nullable()->index();
            $table->boolean('employment_status')->default(0);
            $table->char('nationality',1)->nullable();

            $table->timestamps();
            $table->foreign('operator_dtls_id')->references('id')->on('t_operator_dtls');
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
        Schema::dropIfExists('t_employment_dtls');
    }
}
