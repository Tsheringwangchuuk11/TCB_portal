<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEmploymentDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_employment_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employment_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('operator_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('employment_id')->nullable()->index();
            $table->boolean('employment_status')->default(0);
            $table->char('nationality',1)->nullable();

            $table->timestamps();
            $table->foreign('employment_dtls_id')->references('id')->on('t_employment_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_employment_dtls_audit');
    }
}
