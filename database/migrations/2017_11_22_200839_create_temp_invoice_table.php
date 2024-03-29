<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempInvoiceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('temp_invoice', function (Blueprint $table) {
            $table->increments('invoice_id');
            $table->integer('vessel_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('bill_item');
            $table->string('invoice_no');
            $table->string('billable');
            $table->decimal('unit_price', 20, 2)->default(0.00);
            $table->integer('quantity')->default('1');
            $table->decimal('actual_cost', 20, 2)->default(0.00);
            $table->date('invoice_date');
            $table->boolean('invoice_status')->default(false);
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
        Schema::dropIfExists('temp_invoice');
    }

}
