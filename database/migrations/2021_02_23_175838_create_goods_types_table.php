<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->timestamps();
            $table->comment="物品类型";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_types');
    }
}
