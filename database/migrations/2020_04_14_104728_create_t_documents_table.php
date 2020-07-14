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
            $table->string('application_no',20)->nullable()->index();
            $table->string('document_for')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_name')->nullable();
            $table->string('upload_url')->nullable();
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
        Schema::dropIfExists('t_documents');
    }
}
