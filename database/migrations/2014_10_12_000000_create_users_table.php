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
            $table->string('code')->default('')->comment('code');
            $table->string('username')->unique()->comment('用户名');
            $table->string('password')->default('')->comment('密码');
            $table->string('phone',11)->default('')->comment('手机号');
            $table->string('nickname')->default('')->comment('用户昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->tinyInteger('status')->default(1)->comment('1正常，2禁用');
            $table->tinyInteger('audit_status')->default(0)->comment('0未审核，1，已审核');
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
