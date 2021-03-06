@extends('layouts.base')

@section('title', 'わんわんの家計簿 トップ')

@section('content')
    <h2 id="login-h2" class="h2" align="left">
		わんわんの家計簿について
	</h2>
	<fieldset class="border">
		<p>
			わんわんの家計簿では、家計簿をシンプルな操作で管理できますわん。
		</p>
	</fieldset>
	<div id="summary-area" class="d-flex p-2 bd-highlight">
		<table id="summary-table">
			<tr>
				<th>creator</th>

                <td>タナカソルジャー</td>
							</tr>
							<tr>
								<th>language</th>
								<td>PHP,Javascript,HTML5,CSS3</td>
							</tr>
							<tr>
								<th>library</th>
								<td>laravel,bootstrap,Jquery</td>
							</tr>
							<tr>
								<th>server</th>
								<td>azure</td>
							</tr>
							<tr>
								<th>illustrator</th>
								<td>妻</td>
							</tr>
							<tr>
								<th>version</th>
								<td>1.0(初版)</td>
							</tr>
						</table>
						<div>
							<span></span>
							<a href="https://wanwannogame.web.app/wanwannogame/index.html">
								<img
									src="../../laravelapp/public/images/game150.PNG"
									alt="わんわんのゲーム"
								/>
							</a>
						</div>
					</div>
				</section>
				<section id="login-area">
					<div id="login-fome-area" class="float-right">
						<img
							class="img-fluid"
							src="../../laravelapp/public/images/loginhome300.PNG"
							alt="ログインの家"
						/>
						<form id="login-form" class="text-center container">
							<div id="login-input">
								<input
									id="login-un "
									type="text"
									align="center"
									placeholder="UserId"
								/>
								<br />
								<input
									id="login-pass"
									type="password"
									align="center"
									placeholder="Password"
								/>
								<br />
								<a id="login-submit" align="center" href="index.html">
									<img
										class="img-fluid"
										src="../../laravelapp/public/images/login100.PNG"
										alt="ログイン"
									/>
								</a>
								<br />
								<br />
								<a href="userRegistration.html">
									<img
										class="img-fluid"
										src="../../laravelapp/public/images/shinkitoroku150.PNG"
										alt="しんきとうろく"
									/>
								</a>
							</div>
						</form>
					</div>
@endsection
