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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->string('purchase_amount')->nullable();
            $table->string('purchase_paid')->nullable();
            $table->string('purchase_balance')->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();

            $table->string('saleamount')->nullable();
            $table->string('salepaid')->nullable();
            $table->string('salebalance')->nullable();
            
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
};
