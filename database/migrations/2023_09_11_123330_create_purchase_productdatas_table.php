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
        Schema::create('purchase_productdatas', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);
            
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');

            $table->unsignedBigInteger('purchaseproduct_id');
            $table->foreign('purchaseproduct_id')->references('id')->on('purchaseproducts')->onDelete('cascade');
            $table->string('quantity');
            $table->string('price');
            $table->string('total_price');
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
        Schema::dropIfExists('purchase_productdatas');
    }
};
