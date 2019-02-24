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
            $table->increments('id');
            $table->string('trans_id');
            # Sum of all amount of all products purchased in single order 
            $table->integer('total_paid_amount');
            # Payment date
            $table->date('payment_date');
            # Debit,Credit,NetBanking etc
            $table->string('payment_type',20);
            # Bank name
            $table->string('payment_bank');
            # Auto genrated invoice no
            $table->string('invoice_no');
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
        Schema::dropIfExists('payments');
    }
}
