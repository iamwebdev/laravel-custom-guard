<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            # Product Name
            $table->string('product_name');
            # Unique Auto Generated Product Id
            $table->string('product_id')->unique();
            # Product Description
            $table->text('product_description');
            # Product Actual Price
            $table->integer('actual_price');
            # Product Selling Price
            $table->integer('selling_price');
            # Product Thumbnail             
            $table->string('product_thumb');
            # Holds total quantity left in stock
            $table->integer('total_qty_left')->nullable();
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
        Schema::dropIfExists('products');
    }
}
