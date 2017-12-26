<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('client_name')->nullable();
            $table->string('client_office_desc')->nullable();
            $table->string('client_head_office')->nullable();
            $table->string('client_digital_address')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_currency')->nullable();
            $table->string('client_number')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
