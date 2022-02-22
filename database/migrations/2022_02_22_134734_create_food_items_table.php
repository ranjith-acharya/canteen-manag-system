<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['veg', 'non-veg'])->default('veg');
            $table->string('image');
            $table->unsignedFloat('half_price');
            $table->unsignedFloat('full_price');
            
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
        Schema::dropIfExists('food_items');
    }
}
