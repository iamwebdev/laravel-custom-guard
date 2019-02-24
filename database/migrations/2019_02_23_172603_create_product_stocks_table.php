<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            # Product id from product table
            $table->unsignedInteger('stock_product_id');
            $table->foreign('stock_product_id')->references('id')->on('products');
            # Date of adding stock
            $table->date('added_date');
            # Quanity of product added in stock
            $table->integer('quantity');
            # Purchase Price of product from Vendor like Nike,Jordans etc
            $table->integer('price');
            # This quantity and final quantity which is in product table will get decrease one by one on new orders to keep track which stock is going to turn empty
            $table->integer('remaining_quantity')->nullable();
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
        Schema::dropIfExists('product_stocks');
    }
}
