<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kakeibo_user;
use Carbon\Carbon;
use App\Logic\KakeiboLogic;

/**
 * ユーザー登録画面コントローラー
 * @author t_tanaka
 */
class UserRegistrationController extends Controller
{
    /**
    * ユーザー登録画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return ユーザー登録画面にリダイレクト
    */
    public function index(Request $request)
    {
        Log::info('[ユーザー登録画面初期表示]' );

        return view('kakeibo.userRegistration');
    }

    /**
    * ユーザー登録画面ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return トップ画面にリダイレクト
    */
    public function post(Request $request)
    {
        Log::info('[ユーザー登録処理開始]' );

        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        $kakeibo_user = new Kakeibo_user();
        $form = $request->all();
        unset($form['_token']);
        $kakeibo_user->user_id = $request->user_id;
        $kakeibo_user->password = $request->password;
        $kakeibo_user->user_name = $request->user_name;
        $kakeibo_user->del_flg = 0;
        $kakeibo_user->created_at = $nowDate;
        $kakeibo_user->updated_at = $nowDate;
        $kakeibo_user->save();
        //$kakeibo_user->fill($form)->save();

        // ユーザー情報をセッションにセットする
        KakeiboLogic::setUser($request);

        // デフォルトの家計簿項目情報をセッションにセットする
        KakeiboLogic::setKakeiboMst($request);

        // ユーザー設定の家計簿項目情報をセッションにセットする
        KakeiboLogic::setUserItems($request);

        // 家計簿入力画面用の家計簿項目をセッションにセットする
        KakeiboLogic::setInputItems($request);

        // 現在の年月に紐づく家計簿入力データをDBから取得して、セッションにセットする
        KakeiboLogic::setKakeiboData_now($request);

        // 家計簿入力データに紐づく年月リストをセッションにセットする
        KakeiboLogic::setKakeiboDateList($request);

        // $user_id = $request->user_id;
        // $password = $request->password;

        // $userData = DB::table('kakeibo_users')
        // ->whereRaw('user_id = ? and password = ?', [$user_id, $password])->first();

        // $request->session()->put('userData', $userData);

        Log::info('[ユーザー登録処理終了]' );

        return view('kakeibo.index');
    }
}
