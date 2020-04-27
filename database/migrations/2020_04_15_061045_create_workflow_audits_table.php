<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_workflow_dtls_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workflow_dtls_id')->index();
            $table->string('application_no', 20)->index();
            $table->unsignedBigInteger('status_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('role_id')->index()->nullable();
            $table->string('remarks', 500)->nullable();
            $table->timestamps();

            $table->foreign('workflow_dtls_id')->references('id')->on('t_workflow_dtls');
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
        Schema::dropIfExists('t_workflow_dtls_audits');
    }
}
