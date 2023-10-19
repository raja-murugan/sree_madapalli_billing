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
        Schema::create('outdoors', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);

            $table->string('bill_no')->nullable();
            $table->string('booking_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
            
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('note')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('outdoortax')->nullable();
            $table->string('outdoortax_amount')->nullable();
            $table->string('total')->nullable();

            
            $table->string('payment_term')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('balanceamount')->nullable();

            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            
            $table->string('payment_date')->nullable();
            $table->string('delivery_status')->nullable();
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
        Schema::dropIfExists('outdoors');
    }
};
