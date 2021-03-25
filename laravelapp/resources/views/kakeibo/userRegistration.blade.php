@extends('layouts.base2')

@section('title', 'わんわんの家計簿 ユーザー登録')

@section('content')
<div id="userRegistration_area" class="row">
    <div class="d-flex flex-column justify-content-center col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="ts com_title">ユーザー新規登録</h1>
        <form id="userRegistration_form" action="/wanwannokakeibo/userRegistration" method="post">
            @csrf
            <div id="userRegistration_input" class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 mx-auto">
                <span>ユーザーID：</span>
                <input id="userRegistration_un " name="user_id" type="text" align="center" placeholder="UserId" />
                <br />
                <span>パスワード：</span>
                <input id="userRegistration_pass" name="password" type="password" align="center"
                    placeholder="Password" />
                <br />
                <span>ユーザー名：</span>
                <input id="userRegistration_un " name="user_name" type="text" align="center" placeholder="UserName" />
                <br />
                <input id="userRegistration-submit" type="image" class="img-fluid ml-5" src="/images/toroku200.PNG"
                    name="userRegistration" alt="新規登録">
            </div>
            <p align="center">
                <a href="/wanwannokakeibo/logout">ログイン画面へ戻る</a>
            </p>
        </form>
    </div>
</div>
@endsection
