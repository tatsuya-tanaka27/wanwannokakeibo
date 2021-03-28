@extends('layouts.base')

@section('title', 'わんわんの家計簿 設定')

@section('content')
<div id="setting_area" class="row">
    <div class="d-flex flex-column justify-content-center col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="ts com_title">ユーザー設定</h1>
        <form id="setting_form" action="/wanwannokakeibo/setting" method="post">
            @csrf
            <div id="setting_input" class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6 mx-auto">
                <p>パスワード変更</p>
                <span>現在のパスワード：</span>
                <input id="current_password" name="current_password" type="password" align="center"
                    placeholder="current_password" />
                <br />
                <span>新しいパスワード：</span>
                <input id="password" name="password" type="password" align="center" placeholder="password" />
                <br />
                <input id="setting-submit" type="image" class="img-fluid" src="/images/henkou200.PNG" name="setting"
                    alt="変更">
            </div>
        </form>
    </div>
</div>
@endsection
