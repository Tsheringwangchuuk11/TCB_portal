<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMemberDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_member_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_dtls_id')->nullable()->index();
            $table->unsignedBigInteger('tourist_standard_id')->nullable()->index();
            $table->string('member_name',250)->nullable();
            $table->unsignedBigInteger('relation_type_id')->nullable()->index();
            $table->string('member_age')->nullable();
            $table->char('member_gender',1)->nullable();
            $table->timestamps();
            $table->foreign('member_dtls_id')->references('id')->on('t_member_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_member_dtls_audit');
    }
}
