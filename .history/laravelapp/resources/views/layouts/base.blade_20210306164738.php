<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet"	/>
		<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/kakeibo.css') }}" rel="stylesheet" />
        <title>@yield('title')</title>
    </head>
    <body>
        <section id="header-area">
		    <header class="d-flex p-2 bd-highlight">
			    <img class="img-fluid" src="/images/inu80.png" alt="わんわん" />
			    <h1 id="top-link-title" class="h1 wf-nicomoji">わんわんのカケイボ</h1>
			    <img class="img-fluid" src="/images/neko80.png" alt="にゃんにゃん"	/>
			    <div id="user-area" class="d-flex p-2 bd-highlight flex-column">
				    <span>ユーザー名：{{$item->name}}</span>
				    <span>ユーザーID：wanwan</span>
			    </div>

			    <!--ここからハンバーガーメニュー-->
    			<div class="hamburger-menu">
	    			<input type="checkbox" id="menu-btn-check" />
		    		<label for="menu-btn-check" class="menu-btn">
			    		<span></span>
    				</label>
	    			<div class="menu-content">
		    			<nav>
			    			<ul>
				    			<li><a href="index.html">トップ</a></li>
					    		<li><a href="input.html">家計簿入力</a></li>
						    	<li><a href="registration.html">家計簿項目登録</a></li>
							    <li><a href="list.html">家計簿一覧</a></li>
    							<li><a href="#">設定</a></li>
	    					</ul>
		    			</nav>
			    	</div>
    			</div>
	    		<!--ここまでハンバーガーメニュー-->
    		</header>
    	</section>
        <section>
            <main>
                @yield('content')
            </main>
        </section>
        <section id="footer-area">
			<footer>
				<img class="img-fluid" src="/images/softcream32.png" alt="そふとくん" />
				<small>
					わんわんのカケイボ © 2021 タナカソルジャー All Rights Reserved.
				</small>
				<img class="img-fluid" src="/images/unchi32.png" alt="うんちくん" />
			</footer>
		</section>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/kakeibo.js') }}"></script>
    </body>
</html>
