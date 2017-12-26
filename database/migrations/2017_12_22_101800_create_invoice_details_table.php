<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('invoice_details_id');
            $table->string('bill_item');
            $table->string('billable');
            $table->decimal('unit_price', 20, 2);
            $table->integer('quantity')->default('1');
            $table->decimal('actual_cost', 20, 2)->nullable();
            $table->integer('header_id')->unsigned();
            $table->foreign('header_id')->references('invoice_header_id')->on('invoice_header');
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
        Schema::dropIfExists('invoice_details');
    }
}
