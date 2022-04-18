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
            $table->id();
            $table->string('name');
            $table->unsignedFloat('price');
            $table->enum('type', ['veg', 'non-veg']);
            $table->unsignedDecimal('count');
            $table->unsignedDecimal('total');
            $table->string('reference');
            $table->string('offer');
            $table->enum('customer_status', ['ordered', 'in-progress', 'on-the-way', 'delivered', 'cancelled']);
            $table->enum('status', ['received', 'in-progress', 'on-the-way', 'delivered', 'cancelled']);
            
            $table->foreignId('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreignId('canteen_id');
            $table->foreign('canteen_id')->references('id')->on('canteens');
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
