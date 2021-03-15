<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Logic\KakeiboLogic;

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
        Log::info('[ログイン画面初期表示]' );
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
        Log::info('[ログイン処理開始]' );

        // ユーザー情報をセッションにセットする
        KakeiboLogic::setUser($request);

        // デフォルトの家計簿項目情報をセッションにセットする
        KakeiboLogic::setKakeiboMst($request);

        // ユーザー設定の家計簿項目情報をセッションにセットする
        KakeiboLogic::setUserItems($request);

        // 家計簿入力画面用の家計簿項目をセッションにセットする
        KakeiboLogic::setInputItems($request);

        // 家計簿入力データをDBから取得して、セッションにセットする
        KakeiboLogic::setKdakeiboData($request);

        Log::info('[ログイン処理終了]' );

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
