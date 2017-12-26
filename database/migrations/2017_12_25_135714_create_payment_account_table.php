<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_account', function (Blueprint $table) {
            $table->increments('payment_account_id');
            $table->integer('client_id')->unsigned();
            $table->string('client');
            $table->decimal('account_balance', 60, 2);
            $table->foreign('client_id')->references('client_id')->on('clients');
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
        Schema::dropIfExists('payment_account');
    }
}
