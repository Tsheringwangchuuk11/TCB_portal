<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_workflow_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no', 20)->index();
            $table->unsignedBigInteger('status_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('role_id')->index();
            $table->string('remarks', 500);
            $table->timestamps();

            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('status_id')->references('id')->on('t_status_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_workflow_dtls');
    }
}
