<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarrifParamsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tarrif_params', function (Blueprint $table) {
            $table->increments('tarrif_param_id');
            $table->string('tarrif_param_code');
            $table->string('tarrif_param_name');
            $table->enum('tarrif_param_charge_type', array('QUANTITY', 'SPECIFICS', 'HYBRID'));
            $table->string('tarrif_param_remarks');
            $table->integer('tarrif_type_id')->unsigned();
            $table->foreign('tarrif_type_id')->references('tarrif_type_id')->on('tarrif_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tarrif_params');
    }

}
