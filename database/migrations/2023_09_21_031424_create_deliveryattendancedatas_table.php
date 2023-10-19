<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveryattendancedatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deliveryattendance_id')->nullable();
            $table->foreign('deliveryattendance_id')->references('id')->on('deliveryattendances')->onDelete('cascade');

            $table->unsignedBigInteger('deliveryboy_id')->nullable();
            $table->foreign('deliveryboy_id')->references('id')->on('deliveryboys')->onDelete('cascade');

            $table->string('deliveryboy')->nullable();

            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->string('sessionname')->nullable();
            $table->string('attendance')->nullable();
            $table->string('checkleave')->default(0);
            $table->string('date')->nullable();
            
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('deliveryattendancedatas');
    }
};
