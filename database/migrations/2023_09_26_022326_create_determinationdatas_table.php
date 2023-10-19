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
        Schema::create('determinationdatas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('determination_id')->nullable();
            $table->foreign('determination_id')->references('id')->on('denominations')->onDelete('cascade');

            $table->string('rupee')->nullable();
            $table->string('count')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('determinationdatas');
    }
};
