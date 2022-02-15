<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->default('default.png')->nullable();
            $table->string('branch')->nullable();
            $table->string('year')->nullable();
            $table->string('department')->nullable();
            $table->string('contact', 10)->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();

            $table->foreignId('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
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
        Schema::dropIfExists('profiles');
    }
}
