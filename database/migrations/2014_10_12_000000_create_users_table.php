<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->from(10001);
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('login_id')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('coaching_no')->nullable();
            $table->string('verify_code')->nullable();
            $table->dateTime('verify_expires_at')->nullable();
            $table->boolean('status')->default(0);
            $table->string('role')->default('student');
            $table->string('image')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('manager_id')->nullable();
            $table->text('address')->nullable();
            $table->text('device_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
