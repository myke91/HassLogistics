<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel', function (Blueprint $table) {
            $table->increments('vessel_id');
            $table->string('vessel_name')->unique();
            $table->string('vessel_callsign')->nullable();
            $table->Integer('vessel_class')->nullable();
            $table->Integer('vessel_operator_id')->unsigned();
            $table->string('vessel_type')->nullable();
            $table->string('veessel_flag')->nullable();
            $table->string('vessel_owner')->nullable();
            $table->string('vessel_LOA')->nullable();
            $table->string('vessel_GRT')->nullable();
            $table->timestamps();
            $table->foreign('vessel_operator_id')->references('vessel_operator_id')->on('vessel_operator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessel');
    }
}
