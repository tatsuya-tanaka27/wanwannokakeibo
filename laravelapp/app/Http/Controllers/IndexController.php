<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * トップ画面コントローラー
 * @author t_tanaka
 */
class IndexController extends Controller
{
    /**
    * トップ画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return トップ画面にリダイレクト
    */
    public function index(Request $request)
    {
        return view('kakeibo.index');
    }

    public function post(Request $request)
    {
    }
}
