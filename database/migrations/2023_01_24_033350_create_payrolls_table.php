<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('payment_to_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->double('total_salary', 15, 2);
            $table->date('payment_date')->nullable();
            $table->string('payment_month')->nullable();
            $table->year('payment_year')->nullable();
            $table->text('payment_comment')->nullable();
            $table->text('payment_method')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_to_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('payrolls');
    }
}
