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
        Schema::create('empattendancedatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employeeattendance_id')->nullable();
            $table->foreign('employeeattendance_id')->references('id')->on('empattendances')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->string('employee_name')->nullable();
            $table->string('attendance')->nullable();
            $table->string('date')->nullable();
            $table->string('shift')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('checkleave')->default(0);
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
        Schema::dropIfExists('empattendancedatas');
    }
};
