<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProponentDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_proponent_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('registration_no')->nullable()->index();
            $table->string('name', 250)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('receipt_date')->nullable();
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
        Schema::dropIfExists('t_proponent_dtls');
    }
}
