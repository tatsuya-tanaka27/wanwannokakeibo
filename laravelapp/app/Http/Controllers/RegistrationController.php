<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Logic\KakeiboLogic;
use App\Models\Kakeibo_user_items;
use App\Http\Requests\RegistrationRequest;
use Validator;

/**
 * 家計簿項目登録画面コントローラー
 * @author t_tanaka
 */
class RegistrationController extends Controller
{
    /**
    * 家計簿項目登録画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return 家計簿項目登録画面にリダイレクト
    */
    public function index(Request $request)
    {
        Log::info('[家計簿項目登録画面初期表示]' );

        return view('kakeibo.registration');
    }

    /**
    * 家計簿項目登録画面登録処理
    *
    * @param RegistrationRequest $request リクエストパラメーター
    * @return 家計簿項目登録画面にリダイレクト
    */
    public function insert(RegistrationRequest $request)
    {
        Log::info('[家計簿項目登録画面登録処理開始]' );

        // バリデーションチェック
        //$this->validate($request, Kakeibo_item_mst::$rules);

        $count = Kakeibo_user_items::
        where('user_id', $request->session()->get('userData')->user_id)
        ->where('item_id', $request->item_id)->count();

        // 重複するユーザー設定の項目が存在すれば、自画面に遷移
        if($count > 0){
            // ダミーの配列を使って、バリデータ作成
            $validator = Validator::make(['dummy'=>'dummy'],[
                'dummy' =>function($attribute, $value, $fail){
                    $fail('同じ項目が既にありますわん');
                }
            ]);

            return redirect('wanwannokakeibo/registration')->withErrors($validator)->withInput();
        }

        // DB登録用のパラメータを取得
        $param = KakeiboLogic::getUserItemsParam($request, true);

        // DB登録
        DB::table('kakeibo_user_items')->insert($param);

        // ユーザー設定の家計簿項目データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setUserItems($request);

        // 家計簿入力画面用の家計簿項目をセッションに再セットする
        KakeiboLogic::setInputItems($request);

        /*
        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');
        $kakeibo_user_items = new Kakeibo_user_items();
        $form = $request->all();
        unset($form['_token']);
        $kakeibo_user_items->item_id = $request->item_id;
        $kakeibo_user_items->user_id = $request->session()->get('userData')->user_id;
        $kakeibo_user_items->item_name = $request->item_name;
        $kakeibo_user_items->remarks = $request->remarks;
        $kakeibo_user_items->del_flg = 0;
        $kakeibo_user_items->created_at = $nowDate;
        $kakeibo_user_items->updated_at = $nowDate;
        $kakeibo_user_items->save();
        // ユーザー設定の家計簿項目をセッションにセット
        $userItems = Kakeibo_user_items::where('user_id', $user_id)->get();
        $request->session()->put('userItems', $userItems);
        */

        Log::info('[家計簿項目登録画面登録処理終了]' );

        return view('kakeibo.registration');
    }

    /**
    * 家計簿登録画面更新処理
    *
    * @param Request $request リクエストパラメーター
    * @return 家計簿登録画面にリダイレクト
    */
    public function update(Request $request)
    {
        Log::info('[家計簿項目登録画面更新処理開始]' );

        // TODO 更新時の項目IDチェック実装する必要あり

        // バリデーションチェック
        $this->validate($request, Kakeibo_user_items::$rules);

        // DB更新用のパラメータを取得
        $param = KakeiboLogic::getUserItemsParam($request, false);

        // DB更新
        DB::table('kakeibo_user_items')->where('id', $request->update_id)->update($param);

        // ユーザー設定の家計簿項目データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setUserItems($request);

        // 家計簿入力画面用の家計簿項目をセッションに再セットする
        KakeiboLogic::setInputItems($request);

        Log::info('[家計簿項目登録画面更新処理終了]' );

        // 画面表示
        return view('kakeibo.registration');
    }

    /**
    * 家計簿登録画面削除処理
    *
    * @param Request $request リクエストパラメーター
    * @return 家計簿登録画面にリダイレクト
    */
    public function delete(Request $request)
    {
        Log::info('[家計簿項目登録画面削除処理開始]' );

        // DB削除
        DB::table('kakeibo_user_items')->where('id', $request->id)->delete();

        // ユーザー設定の家計簿項目データをDBから再取得して、画面表示用のデータを洗い替え
        KakeiboLogic::setUserItems($request);

        // 家計簿入力画面用の家計簿項目をセッションに再セットする
        KakeiboLogic::setInputItems($request);

        Log::info('[家計簿項目登録画面削除処理終了]' );

        // 画面表示(ajax通信で走る処理なので、この画面結果を返しても特に何もしない)
        return view('kakeibo.registration');
    }
}
