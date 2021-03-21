<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Logic\KakeiboLogic;
use App\Models\Kakeibo_data;

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
        Log::info('[家計簿入力画面初期表示]' );

        // 現在の年月に紐づく家計簿データの各項目の集計金額を取得
        KakeiboLogic::setAggregateData_now($request);

        //$v = $request->session()->get('aggregateData_now')->toarray();
        //var_dump($v);

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
        Log::info('[家計簿入力画面登録処理開始]' );

        // バリデーションチェック
        $this->validate($request, Kakeibo_data::$rules);

        // DB登録用のパラメータを取得
        $param = KakeiboLogic::getDataParam($request, true);

        // DB登録
        DB::table('kakeibo_data')->insert($param);

        // 家計簿入力データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setKakeiboData_now($request);

        // 現在の年月に紐づく家計簿データの各項目の集計金額を取得
        KakeiboLogic::setAggregateData_now($request);

        Log::info('[家計簿入力画面登録処理終了]' );

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
        Log::info('[家計簿入力画面更新処理開始]' );

        // バリデーションチェック
        $this->validate($request, Kakeibo_data::$rules);

        // DB更新用のパラメータを取得
        $param = KakeiboLogic::getDataParam($request, false);

        // DB更新
        DB::table('kakeibo_data')->where('id', $request->update_id)->update($param);

        // 家計簿入力データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setKakeiboData_now($request);

        // 現在の年月に紐づく家計簿データの各項目の集計金額を取得
        KakeiboLogic::setAggregateData_now($request);

        Log::info('[家計簿入力画面更新処理終了]' );

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
        Log::info('[家計簿入力画面削除処理開始]' );

        // DB削除
        DB::table('kakeibo_data')->where('id', $request->id)->delete();

        // 家計簿入力データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setKakeiboData_now($request);

        // 現在の年月に紐づく家計簿データの各項目の集計金額を取得
        KakeiboLogic::setAggregateData_now($request);

        Log::info('[家計簿入力画面削除処理終了]' );

        // 画面表示(ajax通信で走る処理なので、この画面結果を返しても特に何もしない)
        return view('kakeibo.input');
    }

}
