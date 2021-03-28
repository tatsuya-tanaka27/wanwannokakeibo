<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Logic\KakeiboLogic;
use App\Models\Kakeibo_user;
use Validator;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class SettingController extends Controller
{
    // ユーザーパスワード
    private $user_password = null;

    /**
    * ユーザー設定画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return ユーザー設定画面にリダイレクト
    */
    public function index(Request $request)
    {
        Log::info('[ユーザー設定画面初期表示]' );

        return view('kakeibo.setting');
    }

    /**
    * ユーザー設定画面ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return 設定画面にリダイレクト
    */
    public function post(Request $request)
    {
        Log::info('[ユーザー設定変更処理開始]' );

        // ユーザー情報を取得
        $userData = $request->session()->get('userData');

        // 暗号化されたパスワードをグローバル変数にセット
        $this->user_password = $userData->password;

        // パスワードチェック用の独自バリデータ
        $validator = Validator::make($request->all(),[
            'current_password' =>function($attribute, $value, $fail){
                // 暗号化されたパスワードを複合して、入力したパスワードと一致するかをチェック
                if(!boolval($value === Crypt::decryptString($this->user_password))){
                    $fail('現在のパスワードが違います');
                }
            },
            'password' => function($attribute, $value, $fail){
                // 暗号化されたパスワードを複合して、入力したパスワードと一致するかをチェック
                if(empty($value)){
                    $fail('新しいパスワードを入力してください');
                }else if(boolval($value === Crypt::decryptString($this->user_password))){
                    $fail('新しいパスワードと現在のパスワードが同じです');
                }
            },]
        );

        // エラーが存在すれば処理中断して、設定画面に遷移
        if($validator->fails()){
            return redirect('wanwannokakeibo/setting')->withErrors($validator)->withInput();
        }

        // 「今日の日付」＋「00時00分00秒」をタイムゾーン付きで取得
        $nowDate = Carbon::today('Asia/Tokyo');

        // 新しいパスワードをDBに更新する値として設定
        $param = array(
            'password' => Crypt::encryptString($request->password),
            'updated_at' => $nowDate,
        );

        // DB更新
        DB::table('kakeibo_users')->where('id', $userData->id)->update($param);

         // パスワード更新されたのでセッションのユーザー情報を更新
        $request->session()->put('userData', Kakeibo_user::where('user_id',$userData->user_id)->first());

        Log::info('[ユーザー設定変更処理終了]' );

        return view('kakeibo.setting');
    }
}
