<template>
    <div id="login-main" class="container d-flex bd-highlight justify-content-center">
        <div class="row">
            <div id="login-guide-area" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h2 id="login-h2" class="h2 wf-nicomoji">
                    わんわんのカケイボについて
                </h2>
                <fieldset id="guide-border" class="border">
                    <div class="d-flex">
                        <span>
                            わんわんの家計簿を管理している「わんわん」と申しますわん。<br>
                            簡単な操作で家計簿を管理できるから、使ってみてくださいわん。
                        </span>
                        <img src="/images/inu_hon100.png" alt="わんわんのほん" />
                    </div>
                </fieldset>
                <br>
                <fieldset id="game-border" class="border">
                    <div class="d-flex">
                        <div class="bd-highlight">
                            <span>
                                わんわんが大活躍するゲームがありますわん。<br>
                                下記のリンクをクリックしたら、わんわんのげーむで遊べますわん。
                            </span>
                            <br>
                            <br>
                            <a href="https://wanwannogame.web.app/wanwannogame/index.html">
                                わんわんのゲームはここをクリックするんだわん
                            </a>
                        </div>
                        <img src="/images/game150.PNG" alt="わんわんのゲーム" />
                    </div>
                </fieldset>
            </div>

            <div id="login-area" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 justify-content-center">
                <div id="login-form-area" class="float-right">
                    <img class="img-fluid" src="/images/loginhome300.PNG" alt="ログインの家" />
                    <form id="login-form" name="login-form" class="text-center container"
                        action="/wanwannokakeibo/login" method="post">
                        @csrf
                        <div id="login-input">
                            <input id="login-un" type="text" align="center" placeholder="UserId" name="user_id" />
                            <br />
                            <input id="login-pass" type="password" align="center" placeholder="Password"
                                name="password" />
                            <br />
                            <input id="login-submit" type="image" class="img-fluid" src="/images/login100.PNG"
                                name="login" alt="ログイン">
                            <br />
                            <br />
                            <br />
                            <a href="/wanwannokakeibo/userRegistration">
                                <img class="img-fluid" src="/images/shinkitoroku150.PNG" alt="しんきとうろく" />
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { onMounted } from 'vue'
export default ({
    setup() {
        console.log("start vue")

        onMounted(() => {
            console.log('start mounted !')
        })
    },
})
</script>
