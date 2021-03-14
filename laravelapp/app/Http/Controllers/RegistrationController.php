<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kakeibo_user_items;
use Carbon\Carbon;

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
        return view('kakeibo.registration');
    }

    /**
    * 家計簿項目登録画面登録処理
    *
    * @param Request $request リクエストパラメーター
    * @return 家計簿項目登録画面にリダイレクト
    */
    public function insert(Request $request)
    {
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

        return view('kakeibo.registration');
    }
}
