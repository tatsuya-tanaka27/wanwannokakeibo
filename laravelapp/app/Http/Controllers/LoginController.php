<?php

namespace App\Http\Controllers;

//require vendor/autoload.php;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Common\KakeiboCommon;
use App\Models\Kakeibo_data;

/**
 * ログインコントローラー
 * @author t_tanaka
 */
class LoginController extends Controller
{
    /**
    * ログイン初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return ログイン画面にリダイレクト
    */
    public function index(Request $request)
    {
        return view('kakeibo.login');
    }

    /**
    * ログインポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return トップ画面にリダイレクト
    */
    public function post(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;

        $userData = DB::table('kakeibo_users')
        ->whereRaw('user_id = ? and password = ?', [$user_id, $password])->first();

        $request->session()->put('userData', $userData);
        //$request->session()->put(['key1' => 'value1', 'key2' => 'value2']);

        Log::debug('[USER_NAME：' . $userData->user_name . '　USER_ID：'. $userData->user_id . ']'. 'がログインしました。' );

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

        // 家計簿入力データをDBから取得
        $kakeiboData = KakeiboCommon::getKakeiboData($request->session()->get('userData')->user_id);
        //$kakeiboData = Kakeibo_data::all();

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);

        return view('kakeibo.index');
    }

    /**
    * ログアウト処理
    *
    * @param Request $request リクエストパラメーター
    * @return ログイン画面にリダイレクト
    */
    public function logout(Request $request)
    {
        $request->session()->forget('inputItems');
        $request->session()->forget('kakeiboData');

        // セッションから全データを削除する
        //$request->session()->flush();

        return view('kakeibo.login');
    }
}
