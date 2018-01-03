<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_header', function (Blueprint $table) {
            $table->increments('invoice_header_id');
            $table->string('vessel');
            $table->integer('vessel_id')->unsigned();
            $table->string('client');
            $table->integer('client_id')->unsigned();
            $table->string('voyage_number');
            $table->string('invoice_file_name')->nullable();
            $table->string('invoice_no');
            $table->date('invoice_date')->default(date('Y-m-d'));
            $table->date('due_date');
            $table->string('username')->nullable();
            $table->string('invoice_currency')->nullable();
            $table->string('user')->nullable();
            $table->string('total_amount')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('invoice_status')->default(false);
            $table->foreign('vessel_id')->references('vessel_id')->on('vessels');
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
        Schema::dropIfExists('invoice_header');
    }
}
