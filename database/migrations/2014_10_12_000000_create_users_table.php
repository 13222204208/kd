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
            $table->id();
            $table->string('wx_id')->unique()->comment('微信号');
            $table->string('wx_session_key')->unique()->comment('微信的session_key');
            $table->string('phone',11)->default('')->comment('手机号');
            $table->string('nickname')->default('')->comment('用户昵称');
            $table->string('avatar')->default('')->comment('头像');
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
