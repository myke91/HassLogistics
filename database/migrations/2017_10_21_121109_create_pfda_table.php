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
            $table->Integer('vessel_id')->unsigned();
            $table->string('pfda_template')->nullable();
            $table->String('pfda_eta')->nullable();
            $table->String('pfda_number')->nullable();
            $table->Decimal('pfda_amount')->nullable();
            $table->Decimal('pfda_rebate')->nullable();
            $table->Decimal('pfda_vat')->nullable();
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
