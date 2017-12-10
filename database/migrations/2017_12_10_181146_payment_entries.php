<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentEntries extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payment_entries', function (Blueprint $table) {
            $table->increments('payment_entries_id');
            $table->integer('client_id')->unsigned();
            $table->integer('vessel_id')->unsigned();
            $table->string('username')->nullable();
            $table->string('user')->nullable();
            $table->string('payment_mode')->nullable();
            $table->decimal('actual_cost')->nullable();
            $table->decimal('total_cost')->nullable();
            $table->decimal('amount_paid')->nullable();
            $table->decimal('balance')->nullable();
            $table->decimal('discount')->nullable();
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
    public function down() {
        Schema::dropIfExists('payment_entries');
    }

}
