<?php

namespace app\Logic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Common\KakeiboCommon;
use App\Models\Kakeibo_user;

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

        $userData = Kakeibo_user::where('user_id',$user_id)->where('password', $password)->first();
        //DB::table('kakeibo_users')->whereRaw('user_id = ? and password = ?', [$user_id, $password])->first();

        Log::debug('ユーザー情報：' . $userData);

        $request->session()->put('userData', $userData);
        //$request->session()->put(['key1' => 'value1', 'key2' => 'value2']);

        Log::info('[USER_NAME：' . $userData->user_name . '　USER_ID：'. $userData->user_id . ']'. 'がログインしました。' );
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

        Log::debug('デフォルト家計簿項目：' . $itemMstList );
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

        // 「現在の日時」をタイムゾーン付きで取得
        $nowDate = Carbon::now('Asia/Tokyo');

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

        // ログ出力用のパラメータ作成
        $log_param = "";
        foreach($param as $key => $value){
            $log_param .= $key .'：' . $value . ',';
        }

        Log::debug('DB処理用家計簿データのパラメータ：' . $log_param );

        return $param;
    }

    /**
    * 家計簿入力データセット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setKakeiboData($request)
    {
        // 家計簿入力データをDBから取得
        $kakeiboData = KakeiboCommon::getKakeiboData($request->session()->get('userData')->user_id);
        //$kakeiboData = Kakeibo_data::all();

        Log::debug('家計簿入力データ：' . $kakeiboData );

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);

    }

    /**
    *  現在の月の家計簿入力データセット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setKakeiboData_now($request)
    {
        // 家計簿入力データをDBから取得
        $kakeiboData = KakeiboCommon::getKakeiboData_now($request->session()->get('userData')->user_id);

        Log::debug('家計簿入力データ：' . $kakeiboData );

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);

    }

    /**
    * 家計簿入力データに紐づいた年月リストのセット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setKakeiboDateList($request)
    {
        // 家計簿入力データをセッションから取得して、配列かする
        $kakeiboDataArray = $request->session()->get('kakeiboData')->toArray();

        // 家計簿入力データ年月リスト
        $KakeiboDateList = array();

        // 家計簿入力データが存在する場合に年月リスト作成処理を行う
        if(isset($kakeiboDataArray)){

            // 年月リスト作成処理
            foreach($kakeiboDataArray as $data){

                // 入力日付文字列を日付型に変換
                $input_date = Carbon::parse($data['input_date']);

                // 処理用の一時的な日付
                $temp_date = array('year'=>$input_date->year, 'month'=>$input_date->month);

                // 年月リストに存在しない年月を追加
                if(!in_array($temp_date, $KakeiboDateList, true)){
                    array_push($KakeiboDateList, array('year'=>$input_date->year, 'month'=>$input_date->month));
                }
            }
        }

        // 「現在の日時」をタイムゾーン付きで取得
        $now_date = Carbon::now('Asia/Tokyo');

        // 現在の年月が年月リストに存在しない場合は年月リストに追加
        $now_temp_date = array('year'=>$now_date->year, 'month'=>$now_date->month);
        if(!in_array($now_temp_date, $KakeiboDateList, true)){
            array_push($KakeiboDateList, array('year'=>$now_date->year, 'month'=>$now_date->month));
        }

        // ログ出力用のパラメータ作成
        $log_KakeiboDateList = "";
        foreach(array_reverse($KakeiboDateList) as $KakeiboDate){
            $log_KakeiboDateList .= strval($KakeiboDate['year']) .'：' . strval($KakeiboDate['month']) . ',';
        }

        Log::debug('家計簿入力データ年月リスト：' . $log_KakeiboDateList );

        // 家計簿入力データをセッションにセット
        $request->session()->put('KakeiboDateList', array_reverse($KakeiboDateList));
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
        // 「現在の日時」をタイムゾーン付きで取得
        $nowDate = Carbon::now('Asia/Tokyo');

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

        // ログ出力用のパラメータ作成
        $log_param = "";
        foreach($param as $key => $value){
            $log_param .= $key .'：' . $value . ',';
        }

        Log::debug('DB処理用家計簿項目のパラメータ：' . $log_param );

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

        Log::debug('ユーザー設定の家計簿項目：' . $userItems );

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

        // ログ出力用のパラメータ作成
        $log_inputItems = "";
        foreach($inputItemsArray as $key => $value){
            $log_inputItems .= $key .'：' . $value . ',';
        }

        Log::debug('家計簿入力画面用の家計簿項目：' . $log_inputItems);

        // マージした家計簿項目をセッションにセット
        $request->session()->put('inputItems', $inputItemsArray);
    }
}
?>
