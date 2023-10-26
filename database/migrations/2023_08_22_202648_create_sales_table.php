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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);

            $table->string('bill_no');
            $table->string('date');
            $table->string('time');
            $table->string('sales_type')->nullable();
            $table->string('customer_type')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            
            $table->unsignedBigInteger('employee_id')->nullable();

            $table->string('sub_total')->nullable();
            $table->string('tax')->nullable();
            $table->string('total')->nullable();
            $table->string('sale_discount')->nullable();
            $table->string('grandtotal')->nullable();

            $table->string('payment_method')->nullable();

            $table->unsignedBigInteger('deliveryboy_id')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
