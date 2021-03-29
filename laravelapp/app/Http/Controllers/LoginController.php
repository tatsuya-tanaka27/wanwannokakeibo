<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Logic\KakeiboLogic;
use App\Models\Kakeibo_user;
use Validator;
use App\Http\Validators\PasswordValidator;
use Illuminate\Support\Facades\Crypt;
use Hash;
use App\Http\Requests\LoginRequest;


/**
 * ログインコントローラー
 * @author t_tanaka
 */
class LoginController extends Controller
{
    // ユーザーパスワード
    private $user_password = null;

    /**
    * ログイン初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return ログイン画面にリダイレクト
    */
    public function index(Request $request)
    {
        // セッション初期化
        $request->session()->forget('inputItems');
        $request->session()->forget('kakeiboData_now');
        $request->session()->forget('aggregateData_now');
        $request->session()->forget('KakeiboDateList');
        $request->session()->forget('kakeiboData_dispDate');
        $request->session()->forget('aggregateData_dispDate');

        Log::info('[ログイン画面初期表示]' );
        return view('kakeibo.login');
    }

    /**
    * ログインポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return トップ画面にリダイレクト
    */
    public function post(LoginRequest $request)
    {
        Log::info('[ログイン処理開始]' );

        // バリデーションチェック
        //$this->validate($request, Kakeibo_user::$rules);

        // ユーザー情報をセッションにセットする
        KakeiboLogic::setUser($request);

        // ユーザー情報を取得
        $userData = $request->session()->get('userData');

        // 暗号化されたパスワードをグローバル変数にセット
        $this->user_password = $userData->password;;

        // パスワードチェック用の独自バリデータ
        $validator = Validator::make($request->all(),[
            'password' =>function($attribute, $value, $fail){
                // 暗号化されたパスワードを複合して、入力したパスワードと一致するかをチェック
                if(!boolval($value === Crypt::decryptString($this->user_password))){
                    $fail($attribute.'が違います');
                }
                // if(!Hash::check($value, $this->user_password)){
                //     $fail($attribute.'が違います');
                // }
            }
        ]);

        // エラーが存在すれば処理中断して、ログイン画面に遷移
        if($validator->fails()){
            return redirect('wanwannokakeibo/login')->withErrors($validator)->withInput();
        }

        // if($request->password === Crypt::decryptString($userData->password)){

        // } else {
        //     return view('kakeibo.login');
        // }

        // $validator = $this->app['validator'];
        // $validator->resolve(function($translator,$data,$rules,$messages){
        //     return new KakeiboValidator($translator,$data,$rules,$messages);
        // });

        // デフォルトの家計簿項目情報をセッションにセットする
        KakeiboLogic::setKakeiboMst($request);

        // ユーザー設定の家計簿項目情報をセッションにセットする
        KakeiboLogic::setUserItems($request);

        // 家計簿入力画面用の家計簿項目をセッションにセットする
        KakeiboLogic::setInputItems($request);

        // 現在の年月に紐づく家計簿入力データをDBから取得して、セッションにセットする
        KakeiboLogic::setKakeiboData_now($request);

        // 家計簿入力データに紐づく年月リストをセッションにセットする
        KakeiboLogic::setKakeiboDateList($request);

        Log::info('[ログイン処理終了]' );

        Log::info('[USER_NAME：' . $userData->user_name . '　USER_ID：'. $userData->user_id . ']'. 'がログイン。' );

        return view('kakeibo.index');
    }

    /**
    * ログアウト処理
    *
    * @param Request $request リクエストパラメーター
    * @return ログイン画面にリダイレクト
    */
    public function logout(Request $request)
    {
        // 画面入力されたユーザー情報取得
        $userData = $request->session()->get('userData');

        Log::info('[USER_NAME：' . $userData->user_name . '　USER_ID：'. $userData->user_id . ']'. 'がログインしました。' );

        // セッション初期化
        $request->session()->forget('inputItems');
        $request->session()->forget('kakeiboData_now');
        $request->session()->forget('aggregateData_now');
        $request->session()->forget('KakeiboDateList');
        $request->session()->forget('kakeiboData_dispDate');
        $request->session()->forget('aggregateData_dispDate');

        // セッションから全データを削除する
        //$request->session()->flush();

        return view('kakeibo.login');
    }
}
