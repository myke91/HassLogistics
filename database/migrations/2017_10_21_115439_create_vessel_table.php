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
            $table->string('vessel_name')->nullable(false);
            $table->string('voyage_number')->nullable(false);
            $table->integer('vessel_class')->nullable();
            $table->integer('vessel_operator_id')->unsigned();
            $table->string('vessel_type')->nullable();
            $table->string('vessel_flag')->nullable();
            $table->integer('vessel_owner')->unsigned();
            $table->string('vessel_loa')->nullable();
            $table->string('vessel_grt')->nullable();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->string('bl_no')->nullable();
            $table->string('reg_place')->nullable();
            $table->string('construction_year')->nullable();
            $table->string('crew')->nullable();
            $table->string('reg_year')->nullable();
            $table->string('port_of_loading')->nullable();
            $table->string('port_of_discharge')->nullable();
            $table->string('tonnage_certificate')->nullable();
            $table->string('mmsi')->nullable();
            $table->string('isps_no')->nullable();
            $table->string('ice_class')->nullable();
            $table->string('dwt')->nullable();
            $table->string('sbt')->nullable();
            $table->string('air_draft')->nullable();
            $table->string('ll')->nullable();
            $table->string('gt')->nullable();
            $table->string('loa')->nullable();
            $table->string('knots')->nullable();
            $table->string('ftc')->nullable();
            $table->string('nt')->nullable();
            $table->string('beam')->nullable();
            $table->string('cbm_tank')->nullable();
            $table->string('rgt')->nullable();
            $table->string('max_draft')->nullable();
            $table->string('g_factor')->nullable();
            $table->string('double_bottom', 5)->nullable()->default('off');
            $table->string('double_skin', 5)->nullable()->default('off');
            $table->string('double_sides', 5)->nullable()->default('off');
            $table->string('bow_thrusters', 5)->nullable()->default('off');
            $table->string('stern_thrusters', 5)->nullable()->default('off');
            $table->string('annual_fee', 5)->nullable()->default('off');
            $table->string('inactive', 5)->nullable()->default('off');
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
        Schema::dropIfExists('vessels');
    }

}
