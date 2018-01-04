<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_account_transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->integer('client_id')->unsigned();
            $table->string('client');
            $table->decimal('credit', 60, 2)->default(0.00);
            $table->decimal('debit', 60, 2)->default(0.00);
            $table->string('transaction_type');
            $table->date('transaction_date');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('payment_account_transactions');
    }
}
