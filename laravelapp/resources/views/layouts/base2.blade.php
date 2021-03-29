<html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/kakeibo.css') }}" rel="stylesheet" />
        <title>@yield('title')</title>
    </head>

    <body>
        <section>
            <header>
                <div class="container-fluid">
                    <div class="row">
                        <div id="header-area"
                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex bd-highlight">
                            <img class="img-fluid" src="/images/inu80.png" alt="わんわん" />
                            <h1 class="h1 wf-nicomoji">わんわんのカケイボ</h1>
                            <img class="img-fluid" src="/images/neko80.png" alt="にゃんにゃん" />
                        </div>
                    </div>
                </div>
            </header>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div id="error-area" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if(count($errors) > 0)
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li class="error_message">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section>
            <main>
                @yield('content')
            </main>
        </section>
        <section>
            <footer>
                <div class="container-fluid">
                    <div class="row">
                        <div id="footer-area" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img class="img-fluid" src="/images/softcream32.png" alt="そふとくん" />
                            <small>
                                わんわんのカケイボ © 2021 タナカソルジャー All Rights Reserved.
                            </small>
                            <img class="img-fluid" src="/images/unchi32.png" alt="うんちくん" />
                        </div>
                    </div>
                </div>
            </footer>
        </section>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/kakeibo.js') }}"></script>
    </body>

</html>
