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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);
            $table->string('bill_no')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->string('sub_total')->nullable();
            $table->string('tax')->nullable();
            $table->string('total')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount')->nullable();
            $table->string('grandtotal')->nullable();
            $table->string('paidamount')->nullable();
            $table->string('balanceamount')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();

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
        Schema::dropIfExists('purchases');
    }
};
