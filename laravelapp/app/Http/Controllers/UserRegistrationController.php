<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kakeibo_user;
use Carbon\Carbon;

class UserRegistrationController extends Controller
{
    /**
    * ユーザー登録画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return ユーザー登録画面にリダイレクト
    */
    public function index(Request $request)
    {
        return view('kakeibo.userRegistration');
    }

    /**
    * ユーザー登録画面ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return トップ画面にリダイレクト
    */
    public function post(Request $request)
    {
        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        $kakeibo_user = new Kakeibo_user();
        $form = $request->all();
        unset($form['_token']);
        $kakeibo_user->user_id = $request->user_id;
        $kakeibo_user->password = $request->password;
        $kakeibo_user->user_name = $request->user_name;
        $kakeibo_user->del_flg = 0;
        $kakeibo_user->created_at = $nowDate;
        $kakeibo_user->updated_at = $nowDate;
        $kakeibo_user->save();
        //$kakeibo_user->fill($form)->save();

        $user_id = $request->user_id;
        $password = $request->password;

        $userData = DB::table('kakeibo_users')
        ->whereRaw('user_id = ? and password = ?', [$user_id, $password])->first();

        $request->session()->put('userData', $userData);

        return view('kakeibo.index');
    }
}
