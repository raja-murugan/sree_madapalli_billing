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
        Schema::create('payoffs', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);

            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('total_days')->nullable();
            $table->string('present_days')->nullable();
            $table->string('perdaysalary')->nullable();
            $table->string('total_salaryamount')->nullable();
            $table->string('paid_salary')->nullable();
            $table->string('amountgiven')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('payoffs');
    }
};
