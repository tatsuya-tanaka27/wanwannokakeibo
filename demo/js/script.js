//各画面の共通処理ロジックを記載するjs

//HTML読み込み終了時
document.addEventListener("DOMContentLoaded", function () {

    //わんわんの家計簿タイトル押下したら、トップ画面に遷移する
    document.getElementById("top-link-title").onclick = function() {
        window.location.href = 'index.html';
    };
});

//画面読み込み終了時
window.onload = function () {

};