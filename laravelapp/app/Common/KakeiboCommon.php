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
    * 家計簿データ取得処理
    *
    * @param Request $user_id ユーザーID
    * @return 家計簿データ
    */
    public static function getKakeiboData($user_id){
        return Kakeibo_data::where('user_id', $user_id)->orderBy('input_date', 'asc')->get();
    }

    /**
    * 現在の日付の家計簿データ取得処理
    *
    * @param Request $user_id ユーザーID
    * @return 家計簿データ
    */
    public static function getKakeiboData_now($user_id){

        // SQL検索用の日付パラメータ設定
        $temp_startDate = Carbon::now('Asia/Tokyo'); // 現在日付を日付型に変換
        $temp_endDate = clone $temp_startDate; // 開始月をディープコピーしたものを終了月とする
        $temp_endDate = $temp_endDate->firstOfMonth()->addMonth()->endOfMonth(); // 翌月を取得（addMonthのバグ対策）
        $temp_startDate = $temp_startDate->firstOfMonth(); // 開始月の初日
        $temp_endDate = $temp_endDate->firstOfMonth(); // 翌月の初日
        $startDate = $temp_startDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換
        $endDate = $temp_endDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換

        return Kakeibo_data::where('user_id', $user_id)
        ->where('input_date', '>=' , $startDate)
        ->where('input_date', '<' , $endDate)
        ->orderBy('input_date', 'asc')->get();
    }

    /**
    * 表示する年月に紐づく家計簿データ取得処理
    *
    * @param Request $user_id ユーザーID
    * @param Request $disp_date 表示対象の年月
    * @return 家計簿データ
    */
    public static function getKakeiboData_date($user_id, $disp_date){

        // SQL検索用の日付パラメータ設定
        $temp_startDate = new Carbon($disp_date); // 表示対象日付を日付型に変換
        $temp_endDate = clone $temp_startDate; // 開始月をディープコピーしたものを終了月とする
        $temp_endDate = $temp_endDate->firstOfMonth()->addMonth()->endOfMonth(); // 翌月を取得（addMonthのバグ対策）
        $temp_startDate = $temp_startDate->firstOfMonth(); // 開始月の初日
        $temp_endDate = $temp_endDate->firstOfMonth(); // 翌月の初日
        $startDate = $temp_startDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換
        $endDate = $temp_endDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換

        return Kakeibo_data::where('user_id', $user_id)
        ->where('input_date', '>=' , $startDate)
        ->where('input_date', '<' , $endDate)
        ->orderBy('input_date', 'asc')->get();
    }

    /**
    * 現在の年月に紐づく家計簿データの各項目の集計金額を取得
    *
    * @param Request $user_id ユーザーID
    * @return 家計簿データ
    */
    public static function getAggregateData_now($user_id){

        // SQL検索用の日付パラメータ設定
        $temp_startDate = Carbon::now('Asia/Tokyo'); // 現在日付を日付型に変換
        $temp_endDate = clone $temp_startDate; // 開始月をディープコピーしたものを終了月とする
        $temp_endDate = $temp_endDate->firstOfMonth()->addMonth()->endOfMonth(); // 翌月を取得（addMonthのバグ対策）
        $temp_startDate = $temp_startDate->firstOfMonth(); // 開始月の初日
        $temp_endDate = $temp_endDate->firstOfMonth(); // 翌月の初日
        $startDate = $temp_startDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換
        $endDate = $temp_endDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換

        return Kakeibo_data::selectRaw('item_id, item_name, SUM(amount)')
        ->where('user_id', $user_id)
        ->where('input_date', '>=' , $startDate)
        ->where('input_date', '<' , $endDate)
        ->groupBy('item_id', 'item_name')
        ->orderBy('item_id', 'asc')
        ->get();
    }

    /**
    * 表示する年月に紐づく家計簿データの各項目の集計金額を取得
    *
    * @param Request $user_id ユーザーID
    * @param Request $disp_date 表示対象の年月
    * @return 家計簿データ
    */
    public static function getAggregateData_date($user_id, $disp_date){

        // SQL検索用の日付パラメータ設定
        $temp_startDate = new Carbon($disp_date); // 表示対象日付を日付型に変換
        $temp_endDate = clone $temp_startDate; // 開始月をディープコピーしたものを終了月とする
        $temp_endDate = $temp_endDate->firstOfMonth()->addMonth()->endOfMonth(); // 翌月を取得（addMonthのバグ対策）
        $temp_startDate = $temp_startDate->firstOfMonth(); // 開始月の初日
        $temp_endDate = $temp_endDate->firstOfMonth(); // 翌月の初日
        $startDate = $temp_startDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換
        $endDate = $temp_endDate->format('Y-m-d'); // 開始月をY-m-dの形式に変換

        return Kakeibo_data::select('item_id', 'item_name')
        ->where('user_id', $user_id)
        ->where('input_date', '>=' , $startDate)
        ->where('input_date', '<' , $endDate)
        ->groupBy("entities.id")
        ->orderBy('item_id', 'asc')
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
