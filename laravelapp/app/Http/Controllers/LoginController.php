<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Common\KakeiboCommon;
use App\Models\Kakeibo_data;
use App\Models\Kakeibo_user_items;

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

        // ユーザー設定の家計簿項目をDBから取得
        $userItemsList = Kakeibo_user_items::where('user_id', $user_id)->get();

        // 家計簿項目の配列
        $inputItemsArray = array(); // 入力画面表示用の家計簿項目配列
        $itemMstArray = array(); // デフォルト家計簿項目配列
        $userItemsArray = array(); // ユーザー設定の家計簿項目配列

        // デフォルトの家計簿項目を配列にセット
        foreach($itemMstList as $itemMst){
            $itemMst_key = $itemMst->item_id;
            $itemMst_val = $itemMst->item_name;
            $itemMstArray += array($itemMst_key=>$itemMst_val);
        }

        // ユーザー設定の家計簿項目を配列にセット
        foreach($userItemsList as $userItem){
            $userItem_key = $userItem->item_id;
            $userItem_val = $userItem->item_name;
            $userItemsArray += array($userItem_key=>$userItem_val);
        }

        // デフォルト家計簿項目とユーザー設定の家計簿項目をマージしたものを入力画面表示用の家計簿項目配列にセットする
        $inputItemsArray += $itemMstArray;
        $inputItemsArray += $userItemsArray;

        // マージした家計簿項目をセッションにセット
        $request->session()->put('inputItems', $inputItemsArray);

        // デフォルト家計簿項目をセッションにセット
        $request->session()->put('itemMst', $itemMstList);

        // ユーザー設定の家計簿項目をセッションにセット
        $request->session()->put('userItems', $userItemsList);

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
