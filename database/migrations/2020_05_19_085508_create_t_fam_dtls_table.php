<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTFamDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_fam_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('agent_cid_no')->index()->nullable();
            $table->string('name', 250)->nullable();
            $table->string('designation', 250)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website', 250)->nullable();
            $table->string('agency_name', 250)->nullable();
            $table->string('agency_address', 250)->nullable();
            $table->string('city', 250)->nullable();
            $table->bigInteger('country_id')->index()->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->text('visit_purpose')->nullable();
            $table->boolean('sell_destination')->default(0);
            $table->boolean('sell_bhutan')->default(0);
            $table->year('destination_year')->nullable();
            $table->year('bhutan_year')->nullable();
            $table->year('established_year')->nullable();
            $table->text('remarks')->nullable();
            $table->char('fam_type', 1)->nullable();
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
        Schema::dropIfExists('t_fam_dtls');
    }
}
