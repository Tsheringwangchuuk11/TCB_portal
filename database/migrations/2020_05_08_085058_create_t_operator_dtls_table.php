<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOperatorDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_operator_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cid_no')->index();
            $table->string('name', 250)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('license_no', 20)->nullable();
            $table->date('license_date')->nullable();
            $table->string('company_name', 250)->nullable();
            $table->string('location', 250)->nullable();
            $table->string('address', 250)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_operator_dtls');
    }
}
