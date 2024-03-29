<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserIdRule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'wanwannokakeibo/login'){
            return true;
        } else {
            return false;
        }
    }

    /**
     * バリデーションルールの定義
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:kakeibo_users'],
            'password' => ['required'],
        ];
    }

    /**
    * 定義済みバリデーションルールのエラーメッセージ取得
    *
    * @return array
    */
    public function messages()
    {
        return [
            'user_id.required' => 'ユーザーIDを入力するんだわん',
            'user_id.exists' => '登録されていないユーザーではログインできないわん',
            'password.required'  => 'パスワードを入力するんだわん',
        ];
    }

    /**
    * バリデーションエラーのカスタム属性の取得
    *
    * @return array
    */
    public function attributes()
    {
        return [
            'user_id' => 'ユーザーID',
            'password' => 'パスワード',
        ];
    }
}
