<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kakeibo_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 'wanwan',
            'password' => 'wanwan',
            'user_name' => 'わんわん',
            'del_flg' => 0,
        ];
        DB::table('kakeibo_users')->insert($param);
    }
}
