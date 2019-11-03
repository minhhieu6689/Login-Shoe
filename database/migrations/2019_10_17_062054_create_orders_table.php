<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->text('address')->nullable();
            $table->text('name')->nullable();
            $table->string('phone')->nullable();
            $table->enum('payment_type',['cod','online'])->nullable();
            $table->enum('status',['waitting_payment','paid','shipping','cancelled','done'])->nullable();
            $table->float('sub_total')->nullable();
            $table->float('discount')->nullable();
            $table->float('shipping_fee')->nullable();
            $table->float('total')->nullable();
            $table->integer('voucher_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();


            $table->timestamps();

            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->foreign('customer_id')->references('id')->on('customers');
            
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
