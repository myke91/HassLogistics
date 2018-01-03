<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarrifChargeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tarrif_charge', function (Blueprint $table) {
            $table->increments('tarrif_charge_id');
            $table->string('billable');
            $table->decimal('cost', 10, 2)->default(0.00);
            $table->integer('tarrif_param_id')->unsigned();
            $table->foreign('tarrif_param_id')->references('tarrif_param_id')->on('tarrif_params');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tarrif_charge');
    }

}
