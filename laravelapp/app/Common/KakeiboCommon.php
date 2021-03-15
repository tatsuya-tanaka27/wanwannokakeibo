<?php

namespace app\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kakeibo_data;
use App\Models\Kakeibo_item_mst;
use App\Models\Kakeibo_user_items;

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
