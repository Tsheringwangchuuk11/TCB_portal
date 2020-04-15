<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_task_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no', 20)->index();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->unsignedBigInteger('assigned_priv_id')->index();
            $table->unsignedBigInteger('status_id')->index();
            $table->timestamps();

            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('assigned_priv_id')->references('id')->on('t_role_privileges');
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
        Schema::dropIfExists('t_task_dtls');
    }
}
