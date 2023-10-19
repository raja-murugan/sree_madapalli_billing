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
        Schema::create('outdoordatas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('outdoor_id')->nullable();
            $table->foreign('outdoor_id')->references('id')->on('outdoors')->onDelete('cascade');

            $table->unsignedBigInteger('product')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price_per_quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('outdoornote')->nullable();
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
        Schema::dropIfExists('outdoordatas');
    }
};
