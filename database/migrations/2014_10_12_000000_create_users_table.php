<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_verified')->default(0);
            $table->boolean('user_status')->default(0);
            $table->rememberToken();
            $table->string('email_verification_token')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->dateTime('password_reset_expiry')->nullable();
            $table->string('avatar')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->date('expires_on')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('t_users');
            $table->foreign('updated_by')->references('id')->on('t_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_users');
    }
}
