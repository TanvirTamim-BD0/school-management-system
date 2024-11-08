<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountents', function (Blueprint $table) {
            $table->bigIncrements('id')->from(10001);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('accountent_name');
            $table->string('accountent_email')->nullable();
            $table->string('accountent_phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->date('joining_date');
            $table->date('date_of_birth');
            $table->string('designation');
            $table->double('salary',8,2)->nullable();
            $table->string('accountent_photo')->nullable();
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
        Schema::dropIfExists('accountents');
    }
}
