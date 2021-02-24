<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_number')->comment('身份证号');
            $table->string('id_front')->comment('身份证正面');
            $table->string('id_reverse_side')->comment('身份证反面');
            $table->tinyInteger('user_id')->comment('用户id');
            $table->tinyInteger('status')->default(1)->comment('1未审核，2已认证');
            $table->timestamps();

            $table->comment="身份证认证表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_names');
    }
}
