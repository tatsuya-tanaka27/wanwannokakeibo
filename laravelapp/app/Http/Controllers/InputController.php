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
        // セッションのデフォルトの家計簿項目が存在していなければDBから情報取得
        if(empty($request->session()->get('itemMst'))){

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
            $request->session()->put('itemMst', $itemMstArray);
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
        return view('kakeibo.input');
    }
}
