<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    * @param Request $request リクエストパラメーター
    * @return トップ画面にリダイレクト
    */
    public function post(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;

        $userData = DB::table('kakeibo_users')
        ->whereRaw('user_id = ? and password = ?', [$user_id, $password])->first();

        $request->session()->put('userData', 'value');
        //$request->session()->put(['key1' => 'value1', 'key2' => 'value2']);

        return view('kakeibo.index', ['userData' => $userData]);
    }

}
