<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kakeibo_user;

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
        return view('kakeibo.login');
    }

    /**
    * ログインポスト処理
    *
    * @param Request $request POSTリクエスト
    * @return トップ画面にリダイレクト
    */
    public function post(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;

        $items = DB::table('people')
        ->where('name', 'like', '%' . $name . '%')
        ->orWhere('mail', 'like', '%' . $name . '%')
        ->get();
        return view('hello.show', ['items' => $items]);
        return view('kakeibo.index');
    }

}