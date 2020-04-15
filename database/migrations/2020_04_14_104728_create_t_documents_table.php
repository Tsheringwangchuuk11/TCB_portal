<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('application_no');
            $table->string('document_for');
            $table->string('document_type');
            $table->string('document_name');
            $table->string('upload_url');
            $table->timestamps();

            $table->foreign('application_no')->references('id')->on('t_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_documents');
    }
}
