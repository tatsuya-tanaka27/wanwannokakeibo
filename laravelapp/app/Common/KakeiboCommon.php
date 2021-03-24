<?php

namespace app\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kakeibo_data;
use App\Models\Kakeibo_item_mst;
use App\Models\Kakeibo_user_items;
use Carbon\Carbon;

/**
 * 共通処理用クラス
 * @author t_tanaka
 */
class KakeiboCommon
{
    /**
    * 日付指定なしの家計簿データ全件取得処理
    *
    * @param Request $user_id ユーザーID
    * @return 家計簿データ
    */
    public static function getKakeiboData_all($user_id){
        return Kakeibo_data::where('user_id', $user_id)->orderBy('input_date', 'asc')->get();
    }

    /**
    * 指定された日付に紐づく家計簿データ取得処理
    *
    * @param Request $user_id ユーザーID
    * @param Request $startDate 開始日付
    * @param Request $endDate 終了日付
    *
    * @return 家計簿データ
    */
    public static function getKakeiboData($user_id, $startDate, $endDate){
        return Kakeibo_data::where('user_id', $user_id)
        ->where('input_date', '>=' , $startDate)
        ->where('input_date', '<' , $endDate)
        ->orderBy('input_date', 'asc')->get();
    }

    /**
    * 指定された年月に紐づく家計簿データの各項目の集計金額を取得
    *
    * @param Request $user_id ユーザーID
    * @param Request $startDate 開始日付
    * @param Request $endDate 終了日付
    *
    * @return 家計簿データ
    */
    public static function getAggregateData($user_id, $startDate, $endDate){

        return Kakeibo_data::selectRaw('item_id, item_name, SUM(amount) as total_amount')
        ->where('user_id', $user_id)
        ->where('input_date', '>=' , $startDate)
        ->where('input_date', '<' , $endDate)
        ->groupBy('item_id', 'item_name')
        ->get();
    }

    /**
    * デフォルトの家計簿項目取得処理
    *
    * @return デフォルトの家計簿項目
    */
    public static function getKakeiboItemMst(){
        return Kakeibo_item_mst::all();
        //DB::table('kakeibo_item_mst')->get();
    }

    /**
    * ユーザー設定の家計簿項目取得処理
    *
    * @param Request $user_id ユーザーID
    * @return ユーザー設定の家計簿項目
    */
    public static function getKakeiboUserItems($user_id){
        return Kakeibo_user_items::where('user_id', $user_id)->get();
        //$userItemsList = Kakeibo_user_items::where('user_id', $user_id)->get();
    }
}
?>
