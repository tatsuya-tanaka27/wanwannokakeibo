<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // 画面表示用のデータ配列
        $dataArray = array();

        // デフォルトの家計簿項目を取得
        $itemMstList = DB::table('kakeibo_item_mst')->get();

        // デフォルトの家計簿項目を配列にセット
        $itemMstArray = array();

        // デフォルトの家計簿項目を配列にセット
        foreach($itemMstList as $itemMst){
            $item_key = $itemMst->item_id;
            $item_val = $itemMst->item_name;
            $itemMstArray += array($item_key=>$item_val);
        }

        // 画面表示
        return view('kakeibo.input' ,['items' => $itemMstArray]);
    }

    /**
    * 入力ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function post(Request $request)
    {
        return view('kakeibo.input');
    }
}
