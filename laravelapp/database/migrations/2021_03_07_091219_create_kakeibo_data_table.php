<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKakeiboDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kakeibo_data', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('user_id');
            $table->string('item_id');
            $table->string('item_name');
            $table->date('input_date');
            $table->bigInteger('amount');
            $table->string('payer')->nullable();
            $table->string('remarks')->nullable();
            $table->char('del_flg');
            $table->timestamps();
            //$table->unique(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kakeibo_data');
    }
}
