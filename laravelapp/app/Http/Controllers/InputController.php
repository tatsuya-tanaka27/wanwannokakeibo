<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Logic\KakeiboLogic;

/**
 * 家計簿入力画面コントローラー
 * @author t_tanaka
 */
class InputController extends Controller
{
    /**
    * 入力画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function index(Request $request)
    {
        // 画面表示
        return view('kakeibo.input');
    }

    /**
    * 入力画面登録処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function insert(Request $request)
    {
        // DB登録用のパラメータを取得
        $param = KakeiboLogic::getParam($request, true);

        // DB登録
        DB::table('kakeibo_data')->insert($param);

        // 家計簿入力データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setKdakeiboData($request);

        // 画面表示
        return view('kakeibo.input');
    }

    /**
    * 入力画面更新処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function update(Request $request)
    {
        // DB更新用のパラメータを取得
        $param = KakeiboLogic::getParam($request, false);

        // DB更新
        DB::table('kakeibo_data')->where('id', $request->update_id)->update($param);

        // 家計簿入力データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setKdakeiboData($request);

        // 画面表示
        return view('kakeibo.input');
    }

    /**
    * 入力画面削除処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function delete(Request $request)
    {
        // DB削除
        DB::table('kakeibo_data')->where('id', $request->id)->delete();

        // 家計簿入力データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setKdakeiboData($request);

        // 画面表示(ajax通信で走る処理なので、この画面結果を返しても特に何もしない)
        return view('kakeibo.input');
    }

}
