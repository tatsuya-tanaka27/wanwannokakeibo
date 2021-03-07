<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    /**
    * ログイン初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function index(Request $request)
    {
        return view('kakeibo.login');
    }

    /**
    * 入力ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return 入力画面にリダイレクト
    */
    public function post(Request $request)
    {
        return view('kakeibo.index', ['userData' => $userData]);
    }
}
