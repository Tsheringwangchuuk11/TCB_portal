<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCheckListStandardMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_check_list_standard_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('star_category_id')->nullabel()->index();
            $table->unsignedBigInteger('checklist_id')->nullabel()->index();
            $table->unsignedBigInteger('standard_id')->nullabel()->index();
            $table->boolean('is_active')->default(0);
            $table->boolean('mandatory')->default(0);
            $table->unsignedBigInteger('created_by')->nullabel()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->foreign('star_category_id')->references('id')->on('t_star_categories');
            $table->foreign('checklist_id')->references('id')->on('t_check_list_standards');
            $table->foreign('standard_id')->references('id')->on('t_basic_standards');
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
        Schema::dropIfExists('t_check_list_standard_mappings');
    }
}
