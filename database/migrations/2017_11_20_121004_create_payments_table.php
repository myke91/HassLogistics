<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->integer('client_id')->unsigned();
            $table->integer('vessel_id')->unsigned();
            $table->string('receipt_no')->nullable();
            $table->string('voyage_number')->nullable();
            $table->string('invoice_no');
            $table->string('amount_in_words')->nullable();
            $table->string('username')->nullable();
            $table->string('user')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_currency')->nullable();
            $table->decimal('actual_cost')->default(0.00);
            $table->decimal('total_cost')->default(0.00);
            $table->decimal('amount_paid')->default(0.00);
            $table->decimal('balance')->default(0.00);
            $table->decimal('discount')->default(0.00);
            $table->string('description')->nullable();
            $table->string('remark')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->date('cheque_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();
            $table->foreign('vessel_id')->references('vessel_id')->on('vessels');
            $table->foreign('client_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
