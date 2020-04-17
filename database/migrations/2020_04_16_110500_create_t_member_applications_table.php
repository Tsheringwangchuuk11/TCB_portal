<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMemberApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_member_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no',20)->nullable()->index();
            $table->string('member_name',250)->nullable();
            $table->unsignedBigInteger('relation_type_id')->nullable()->index();
            $table->string('member_age')->nullable();
            $table->char('member_gender',1)->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('relation_type_id')->references('id')->on('t_relation_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_member_applications');
    }
}
