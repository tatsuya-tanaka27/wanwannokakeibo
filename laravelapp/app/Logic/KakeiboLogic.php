<?php

namespace app\Logic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Common\KakeiboCommon;

/**
 * ロジッククラス
 * @author t_tanaka
 */
class KakeiboLogic
{
    /**
    * ユーザー情報セット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setUser($request)
    {
        // 画面入力されたユーザー情報取得
        $user_id = $request->user_id;
        $password = $request->password;

        $userData = DB::table('kakeibo_users')
        ->whereRaw('user_id = ? and password = ?', [$user_id, $password])->first();

        $request->session()->put('userData', $userData);
        //$request->session()->put(['key1' => 'value1', 'key2' => 'value2']);

        Log::debug('[USER_NAME：' . $userData->user_name . '　USER_ID：'. $userData->user_id . ']'. 'がログインしました。' );
    }

    /**
    * デフォルトの家計簿項目セット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setKakeiboMst($request)
    {
        // デフォルトの家計簿項目をDBから取得
        $itemMstList = KakeiboCommon::getKakeiboItemMst();

        // デフォルト家計簿項目をセッションにセット
        $request->session()->put('itemMstList', $itemMstList);
    }

    /**
    * 家計簿入力データのパラメータ取得処理
    *
    * @param $request リクエストパラメータ
    * @param $newFlg データ新規登録フラグ
    */
    public static function getDataParam($request, $newFlg)
    {
        // 家計簿項目
        $inputItems = $request->session()->get('inputItems');

        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        // 画面から取得した値をDBに登録する値として設定
        $param = array();

        // データ新規登録フラグ
        if($newFlg){
            $param += array('created_at' => $nowDate,);
        }

        // 画面から取得した値をDBに登録する値として設定
        $param += array(
            'user_id' => $request->session()->get('userData')->user_id,
            'item_id' => $request->item,
            'item_name' => $inputItems[$request->item],
            'amount' => $request->amount,
            'input_date' => $request->date,
            'payer' => $request->payer,
            'remarks' => $request->remarks,
            'del_flg' => 0,
            'updated_at' => $nowDate,
        );

        return $param;
    }

    /**
    * 家計簿入力データセット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setKdakeiboData($request)
    {
        // 家計簿入力データをDBから取得
        $kakeiboData = KakeiboCommon::getKakeiboData($request->session()->get('userData')->user_id);
        //$kakeiboData = Kakeibo_data::all();

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);
    }

    /**
    * ユーザー設定の家計簿項目のパラメータ取得処理
    *
    * @param $request リクエストパラメータ
    * @param $newFlg 家計簿項目新規登録フラグ
    * @return 家計簿項目のパラメータ
    */
    public static function getUserItemsParam($request, $newFlg)
    {
        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        // 画面から取得した値をDBに登録する値として設定
        $param = array();

        // 家計簿項目新規登録フラグ
        if($newFlg){
            $param += array('created_at' => $nowDate,);
        }

        // 画面から取得した値をDBに登録する値として設定
        $param += array(
            'item_id' => $request->item_id,
            'user_id' => $request->session()->get('userData')->user_id,
            'item_name' => $request->item_name,
            'remarks' => $request->remarks,
            'del_flg' => 0,
            'updated_at' => $nowDate,
        );

        return $param;
    }

    /**
    * ユーザー設定の家計簿項目セット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setUserItems($request)
    {
        // ユーザー設定の家計簿項目をDBから取得
        $userItems = KakeiboCommon::getKakeiboUserItems($request->session()->get('userData')->user_id);

        // ユーザー設定の家計簿項目をセッションにセット
        $request->session()->put('userItems', $userItems);
    }

    /**
    * 家計簿入力画面用の家計簿項目をセット
    *
    * @param $request リクエストパラメータ
    */
    public static function setInputItems($request)
    {
        // 家計簿項目の配列
        $inputItemsArray = array(); // 入力画面表示用の家計簿項目配列
        $itemMstArray = array(); // デフォルト家計簿項目配列
        $userItemsArray = array(); // ユーザー設定の家計簿項目配列

        // セッションから項目情報を取得
        $itemMstList = $request->session()->get('itemMstList');
        $userItems =  $request->session()->get('userItems');

        // デフォルトの家計簿項目を配列にセット
        foreach($itemMstList as $itemMst){
            $itemMst_key = $itemMst->item_id;
            $itemMst_val = $itemMst->item_name;
            $itemMstArray += array($itemMst_key=>$itemMst_val);
        }

        // ユーザー設定の家計簿項目を配列にセット
        foreach($userItems as $userItem){
            $userItem_key = $userItem->item_id;
            $userItem_val = $userItem->item_name;
            $userItemsArray += array($userItem_key=>$userItem_val);
        }

        // デフォルト家計簿項目とユーザー設定の家計簿項目をマージしたものを入力画面表示用の家計簿項目配列にセットする
        $inputItemsArray += $itemMstArray;
        $inputItemsArray += $userItemsArray;

        // マージした家計簿項目をセッションにセット
        $request->session()->put('inputItems', $inputItemsArray);
    }
}
?>
