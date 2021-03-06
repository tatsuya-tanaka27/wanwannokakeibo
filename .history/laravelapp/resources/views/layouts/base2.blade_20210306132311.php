<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet"	/>
		<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />
        <link href="/css/app.css" rel="stylesheet">
		<link href="/css/style.css" rel="stylesheet" />
		<link href="/css/kakeibo.css" rel="stylesheet" />
        <title>@yield('title')</title>
    </head>
    <body>
        <section id="header-area">
		    <header class="d-flex p-2 bd-highlight">
			    <img class="img-fluid" src="/images/inu80.png" alt="わんわん" />
			    <h1 class="h1 wf-nicomoji">わんわんのカケイボ</h1>
			    <img class="img-fluid" src="/images/neko80.png" alt="にゃんにゃん"	/>
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
        <script src="../../js/app.js"></script>
        <script src="../../js/kakeibo.js"></script>
    </body>
</html>
