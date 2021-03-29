<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AlphaNumrule;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'wanwannokakeibo/userRegistration'){
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
            'user_id' => ['required', new AlphaNumrule],
            'password' => ['required'],
            'user_name' => ['required'],
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
            'user_name' => 'ユーザー名',
        ];
    }
}
