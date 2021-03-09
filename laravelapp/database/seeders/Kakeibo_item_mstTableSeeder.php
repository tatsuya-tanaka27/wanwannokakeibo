<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kakeibo_item_mstTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'item_id' => 'rent',
            'item_name' => '家賃',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);

        $param = [
            'item_id' => 'mortgage',
            'item_name' => '住宅ローン',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);

        $param = [
            'item_id' => 'waterBill',
            'item_name' => '水道代',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);

        $param = [
            'item_id' => 'electricityBill',
            'item_name' => '電気代',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);

        $param = [
            'item_id' => 'gasBill',
            'item_name' => 'ガス代',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);

        $param = [
            'item_id' => 'foodCosts',
            'item_name' => '食費代',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);

        $param = [
            'item_id' => 'miscellaneousExpenses',
            'item_name' => '雑費',
            'remarks' => '',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_item_mst')->insert($param);
    }
}

