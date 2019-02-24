<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            # Auto genrated order id
            $table->string('order_ord_id')->unique();
            # User id 
            $table->unsignedInteger('order_user_id');
            $table->foreign('order_user_id')->references('id')->on('users');
            # Name of reciever
            $table->string('order_name',150);
            # State of reciever
            $table->string('order_state',99);
            # City of reciever
            $table->string('order_city',99);
            # Street of reciever
            $table->string('order_street',99);
            # Distt of reciever
            $table->string('order_distt',99);
            # Pincode of reciver
            $table->string('order_pincode',20);
            # Mobile of reciever
            $table->string('order_mobile',20);
            # EMail of reciver
            $table->string('order_email',99)->nullable();
            # ALternate mobile of reciver
            $table->string('order_alter_mobile',20)->nullable();
            # Landmark of reciver
            $table->text('order_landmark');
            # Shipping address of reciver
            $table->text('order_shipping_addr');
            # Delivery Charges
            $table->integer('nord_delivery_charge');
            # Order Date
            $table->date('order_date');
            # Order Status
            $table->string('order_status',20);
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
        Schema::dropIfExists('orders');
    }
}
