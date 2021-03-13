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
    * 家計簿入力データのパラメータ取得処理
    *
    * @param $request リクエストパラメータ
    * @param $item_id 家計簿項目のID
    * @param $newFlg データ新規登録フラグ
    * @return 家計簿データのパラメータ
    */
    public static function getParam($request, $newFlg)
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
    * DB変更処理後の家計簿入力データ再セット処理
    *
    * @param $request リクエストパラメータ
    */
    public static function setKdakeiboData($request)
    {
        // 家計簿入力データをDBから取得
        $kakeiboData = KakeiboCommon::getKakeiboData($request->session()->get('userData')->user_id);

        // 家計簿入力データをセッションにセット
        $request->session()->put('kakeiboData', $kakeiboData);
    }
}
?>
