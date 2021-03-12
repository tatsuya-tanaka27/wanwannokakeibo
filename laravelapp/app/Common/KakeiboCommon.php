<?php

namespace app\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kakeibo_data;

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
}
?>
