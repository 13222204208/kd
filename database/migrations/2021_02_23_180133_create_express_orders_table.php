<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpressOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_orders', function (Blueprint $table) {
            $table->id();
            $table->string('send_name')->comment('发货人姓名');
            $table->string('send_phone')->comment('发货人手机号');
            $table->string('send_address')->comment('发货人地址');
            $table->string('send_detailed_address')->comment('发货人详细地址');

            $table->string('get_name')->comment('收货人姓名');
            $table->string('get_phone')->comment('收货人手机号');
            $table->string('get_address')->comment('收货人地址');
            $table->string('get_detailed_address')->comment('收货人详细地址');

            $table->string('goods_type_id')->comment('物品类型');
            $table->decimal('cost',9,2)->comment('快递费用');
            $table->string('comment')->default('')->comment('备注');
            $table->string('reply')->default('')->comment('后台回复内容');
            $table->tinyInteger('status')->default(1)->comment('1未付款，2已付款');
            $table->timestamps();

            $table->comment="快递订单表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_orders');
    }
}
