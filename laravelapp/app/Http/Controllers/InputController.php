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
        $itemMstList = DB::table('kakeibo_item_mst')->get();

        $itemMstArray = array();
        foreach($itemMstList as $itemMst){
            $item_key = $itemMst->item_id;
            $item_val = $itemMst->item_name;
            $itemMstArray += array($item_key=>$item_val);
        }
        $request->session()->put('itemMst', $itemMstArray);
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
