<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Kakeibo_data;

class InputController extends Controller
{
    /**
    * 入力画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function index(Request $request)
    {
        // セッションのデフォルトの家計簿項目が存在していなければDBから情報取得
        if(empty($request->session()->get('inputItems'))){

            // デフォルトの家計簿項目をDBから取得
            $itemMstList = DB::table('kakeibo_item_mst')->get();

            // デフォルトの家計簿項目を配列にセット
            $itemMstArray = array();
            foreach($itemMstList as $itemMst){
                $item_key = $itemMst->item_id;
                $item_val = $itemMst->item_name;
                $itemMstArray += array($item_key=>$item_val);
            }

             // デフォルトの家計簿項目をセッションにセット
            $request->session()->put('inputItems', $itemMstArray);

        }

        // セッションの家計簿入力データが存在していなければDBから情報取得
        if(empty($request->session()->get('kakeiboData'))){

            // 家計簿入力データをDBから取得
            $kakeiboData = Kakeibo_data::where('user_id', $request->session()->get('userData')->user_id)->orderBy('input_date', 'asc')->get();
            //$kakeiboData = Kakeibo_data::all();

            // 家計簿入力データをセッションにセット
            $request->session()->put('kakeiboData', $kakeiboData);
        }

        // 画面表示
        return view('kakeibo.input');
    }

    /**
    * 入力ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function post(Request $request)
    {
        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        // 画面から取得した値をDBに登録する値として設定
        $param = [
            'user_id' => $request->session()->get('userData')->user_id,
            'item_id' => $request->input_item,
            'amount' => $request->input_amount,
            'input_date' => $request->input_date,
            'payer' => $request->input_payer,
            'remarks' => $request->input_remarks,
            'del_flg' => 0,
            'created_at' => $nowDate,
            'updated_at' => $nowDate,
        ];

        // DB登録
        DB::table('kakeibo_data')->insert($param);

        // 家計簿入力データをDBから取得
        $kakeiboData = Kakeibo_data::where('user_id', $request->session()->get('userData')->user_id)->orderBy('input_date', 'asc')->get();

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);

        // 画面表示
        return view('kakeibo.input');
    }

    /**
    * 入力画面更新処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function update(Request $request)
    {
        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        // 画面から取得した値をDBに登録する値として設定
        $param = [
            'user_id' => $request->session()->get('userData')->user_id,
            'item_id' => $request->update_item,
            'amount' => $request->update_amount,
            'input_date' => $request->update_date,
            'payer' => $request->update_payer,
            'remarks' => $request->update_remarks,
            'updated_at' => $nowDate,
        ];

        // DB更新
        DB::table('kakeibo_data')->where('id', $request->update_id)->update($param);

        // 家計簿入力データをDBから取得
        $kakeiboData = Kakeibo_data::where('user_id', $request->session()->get('userData')->user_id)->orderBy('input_date', 'asc')->get();

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);

        // 画面表示
        return view('kakeibo.input');
    }
}
