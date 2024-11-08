<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id')->from(10001);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('teacher_name');
            $table->string('teacher_email')->nullable();
            $table->string('teacher_phone')->nullable();
            $table->string('teacher_category')->nullable();
            $table->string('traning_and_qualification')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->date('joining_date');
            $table->date('date_of_birth')->nullable();
            $table->string('designation');
            $table->double('salary',8,2)->nullable();
            $table->string('teacher_photo')->nullable();
            $table->boolean('is_demo')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('teachers');
    }
}
