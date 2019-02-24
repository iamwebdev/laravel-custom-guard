<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            # Order id from order table
            $table->unsignedInteger('orderdet_order_id');
            $table->foreign('orderdet_order_id')->references('id')->on('orders');
            # Product id from product table
            $table->unsignedInteger('orderdet_product_id');
            $table->foreign('orderdet_product_id')->references('id')->on('products');
            # quantity purchased of particular item
            $table->integer('qty_purchased');
            # AMount per item
            $table->integer('amount'); # Selling price of product will store
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
        Schema::dropIfExists('order_details');
    }
}
