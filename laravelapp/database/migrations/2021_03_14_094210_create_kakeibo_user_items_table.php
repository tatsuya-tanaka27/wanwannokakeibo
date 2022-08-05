<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKakeiboUserItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kakeibo_user_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('item_id')->length(30);
            $table->string('item_name');
            $table->string('remarks')->nullable();
            $table->boolean('del_flg');
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
        Schema::dropIfExists('kakeibo_user_items');
    }
}
