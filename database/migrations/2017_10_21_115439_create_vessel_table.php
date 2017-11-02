<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vessels', function (Blueprint $table) {
            $table->increments('vessel_id');
            $table->string('vessel_name')->unique();
            $table->string('vessel_callsign')->nullable();
            $table->integer('vessel_class')->nullable();
            $table->integer('vessel_operator_id')->unsigned();
            $table->string('vessel_type')->nullable();
            $table->string('vessel_flag')->nullable();
            $table->integer('vessel_owner')->unsigned();
            $table->string('vessel_LOA')->nullable();
            $table->string('vessel_GRT')->nullable();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->timestamps();
            $table->foreign('vessel_owner')->references('client_id')->on('clients');
            $table->foreign('vessel_operator_id')->references('vessel_operator_id')->on('vessel_operators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vessel');
    }

}
