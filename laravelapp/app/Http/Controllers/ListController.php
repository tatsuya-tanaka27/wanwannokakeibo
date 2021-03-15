<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 家計簿一覧画面コントローラー
 * @author t_tanaka
 */
class ListController extends Controller
{
    /**
    * 一覧画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return 一覧画面にリダイレクト
    */
    public function index(Request $request)
    {
        Log::info('[家計簿一覧画面初期表示]' );

        return view('kakeibo.list');
    }

    /**
    * 一覧ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return 一覧画面にリダイレクト
    */
    public function post(Request $request)
    {
    }
}
