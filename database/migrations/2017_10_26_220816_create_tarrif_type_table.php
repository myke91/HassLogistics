<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarrifTypeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tarrif_type', function (Blueprint $table) {
            $table->increments('tarrif_type_id');
            $table->string('tarrif_type_name');
            $table->integer('tarrif_id')->unsigned();
            $table->foreign('tarrif_id')->references('tarrif_id')->on('tarrif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tarrif_type');
    }

}
