@extends('layouts.base2')

@section('title', 'わんわんの家計簿 ユーザー登録')

@section('content')
<div id="userRegistration_area">
    <p id="userRegistration_sign" align="center">ユーザー新規登録</p>
    <form id="userRegistration_form" action="/wanwannokakeibo/userRegistration" method="post">
        @csrf
        <div id=" userRegistration_input">
            <span>ユーザーID：</span>
            <input id="userRegistration_un " name="user_id" type="text" align="center" placeholder="UserId" />
            <br />
            <span>パスワード：</span>
            <input id="userRegistration_pass" name="password" type="password" align="center" placeholder="Password" />
            <br />
            <span>ユーザー名：</span>
            <input id="userRegistration_un " name="user_name" type="text" align="center" placeholder="UserName" />
            <br />
            <input id="userRegistration-submit" type="image" class="img-fluid" src="/images/toroku200.PNG"
                name="userRegistration" alt="新規登録">
        </div>
        <p align="center">
            <a href="/wanwannokakeibo/logout">ログイン画面へ戻る</a>
        </p>
    </form>
</div>
@endsection
