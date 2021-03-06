@extends('layouts.base')

@section('title', 'わんわんの家計簿 トップ')

@section('content')
    <div id="top-content" class="d-flex p-2 bd-highlight">
		<div id="top-title-area">
			<figure>
				<img
					class="img-fluid"
					src="/images/inuneko_400.png"
					alt="わんわんとにゃんにゃん"
				/>
				<figcaption>♪わんわんとにゃんにゃんだよ♪</figcaption>
			</figure>
			</div>
				<div id="top-guide-area">
					<div id="top-message" class="d-flex p-2 bd-highlight">
						<img
							class="img-fluid"
							src="/images/hiyoko_kirakira32.png"
							alt="ぴよぴよ"
						/>
						<h2 class="h2">わんわんの家計簿メニュー</h2>
					</div>
					<div id="top-description-area">
						<fieldset
							id="top-description-border"
							class="d-flex p-2 bd-highlight flex-column"
						>
						<div id="top-navi-area">
							<a href="input.html">
								<img
									class="img-fluid"
									src="/images/nyuryoku200.png"
									alt="家計簿入力"
								/>
							</a>
						<a href="registration.html">
							<img
								class="img-fluid"
								src="/images/komokutoroku200.PNG"
								alt="家計簿項目登録"
							/>
						</a>
						<a href="list.html">
							<img
												class="img-fluid"
												src="/images/ichiran200.PNG"
												alt="家計簿一覧"
											/>
										</a>
										<a href="#">
											<img
												class="img-fluid"
												src="/images/settei200.PNG"
												alt="家計簿設定"
											/>
										</a>
									</div>
								</fieldset>
							</div>
						</div>
					</div>
@endsection
