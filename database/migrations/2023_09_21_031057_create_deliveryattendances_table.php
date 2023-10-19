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
        Schema::create('deliveryattendances', function (Blueprint $table) {
            $table->id();
            $table->boolean('soft_delete')->default(0);
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('dateno')->nullable();

            $table->unsignedBigInteger('session_id')->nullable();
            
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
        Schema::dropIfExists('deliveryattendances');
    }
};
