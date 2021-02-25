<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('收货人姓名');
            $table->string('phone')->comment('手机号');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->string('area')->comment('区');
            $table->string('address')->comment('收货人地址');
            $table->string('detailed_address')->comment('详细地址');
            $table->string('site')->default('')->comment('站点');
            $table->tinyInteger('address_type')->default(1)->comment('地址类型 1,发货地址，2收货地址');
            $table->tinyInteger('is_default')->default(2)->comment('是否是默认地址 1,默认，2不默认');
            $table->integer('user_id')->comment('用户id');
            $table->timestamps();

            $table->comment="收发货地址表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
