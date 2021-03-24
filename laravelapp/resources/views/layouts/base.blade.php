<html>

    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/kakeibo.css') }}" rel="stylesheet" />
        <title>@yield('title')</title>
    </head>

    <body>
        <div class="container-fluid">
            <section>
                <header class="">
                    <div class="row">
                        <div id="header-area"
                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex p-2 bd-highlight">
                            <img class="img-fluid" src="/images/inu80.png" alt="わんわん" />
                            <h1 id="top-link-title" class="h1 wf-nicomoji">わんわんのカケイボ</h1>
                            <img class="img-fluid" src="/images/neko80.png" alt="にゃんにゃん" />
                            <div id="user-area" class="d-flex p-2 bd-highlight flex-column">
                                <span>ユーザー名：{{ Session::get('userData')->user_name }}</span>
                                <span>ユーザーID：{{ Session::get('userData')->user_id }}</span>
                            </div>
                            <a href="/wanwannokakeibo/logout">
                                <img class="img-fluid" src="/images/logout80.png" alt="ログアウト" />
                            </a>

                            <!--ここからハンバーガーメニュー-->
                            <div class="hamburger-menu">
                                <input type="checkbox" id="menu-btn-check" />
                                <label for="menu-btn-check" class="menu-btn">
                                    <span></span>
                                </label>
                                <div class="menu-content">
                                    <nav>
                                        <ul>
                                            <li><a href="/wanwannokakeibo/index">トップ</a></li>
                                            <li><a href="/wanwannokakeibo/input">家計簿入力</a></li>
                                            <li><a href="/wanwannokakeibo/registration">家計簿項目登録</a></li>
                                            <li><a href="/wanwannokakeibo/list">家計簿一覧</a></li>
                                            <li><a href="#">設定</a></li>
                                            <li><a href="/wanwannokakeibo/logout">ログアウト</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!--ここまでハンバーガーメニュー-->
                        </div>
                    </div>
                </header>
            </section>
            <section>
                <div class="row">
                    <div id="error-area" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if(count($errors) > 0)
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
            <section>
                <main>
                    @yield('content')
                </main>
            </section>
            <section id="footer-area">
                <footer>
                    <div class="row">
                        <div id="footer-area" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img class="img-fluid" src="/images/softcream32.png" alt="そふとくん" />
                            <small>
                                わんわんのカケイボ © 2021 タナカソルジャー All Rights Reserved.
                            </small>
                            <img class="img-fluid" src="/images/unchi32.png" alt="うんちくん" />
                        </div>
                    </div>
                </footer>
            </section>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/kakeibo.js') }}"></script>
    </body>

</html>
