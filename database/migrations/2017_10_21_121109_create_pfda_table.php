<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePfdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pfda', function (Blueprint $table) {
            $table->increments('pfda_id');
            $table->integer('vessel_id')->unsigned();
            $table->string('pfda_template')->nullable();
            $table->string('pfda_eta')->nullable();
            $table->string('pfda_number')->nullable();
            $table->decimal('pfda_amount',10,2)->nullable();
            $table->decimal('pfda_rebate',10,2)->nullable();
            $table->decimal('pfda_vat',10,2)->nullable();
            $table->boolean('pfda_status')->nullable();
            $table->timestamps();
            $table->foreign('vessel_id')->references('vessel_id')->on('vessels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pfda');
    }
}
