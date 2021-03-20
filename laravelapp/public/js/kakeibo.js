$(function(){
 $('#dispDate').change(function() {

      var json = {
        "dispDate": $(this).val()
    };

    //これを忘れがち
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({
        url:"/wanwannokakeibo/list",
        type:"post",
        contentType: "application/json",
        data:JSON.stringify(json),
        //dataType:"json",
    }).done(function(htmlData,textStatus,jqXHR) {
        //通信成功
        console.log("成功" + jqXHR.status);
        $('#listData').html(htmlData['kakeiboData_html']);
        $('#aggregateData').html(htmlData['aggregateData_html']);

        //$("#p1").text(jqXHR.status);  //例：200とかでステータスがとれます
        //$("#p2").text(JSON.stringify(data1));  //文字列に変換する例
    }).fail(function(jqXHR, textStatus, errorThrown){
        //通信失敗
        console.log("失敗"+jqXHR.status);
    }).always(function(){
        //通信完了
        console.log("完了");
    });

    });
});

window.onload = function () {

};

$(function(){
 $('#inputArea').width($('#inputTable').width());
 $('#listArea').width($('#listTable').width());
});

// 家計簿データ削除用ajax処理
function delete_data($id){

    var json = {
        "id": $id
    };

    //これを忘れがち
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({
        url:"/wanwannokakeibo/delete",
        type:"post",
        contentType: "application/json",
        data:JSON.stringify(json),
        //dataType:"json",
    }).done(function(data1,textStatus,jqXHR) {
        //通信成功
        console.log("成功" + jqXHR.status);
        //画面再リロード
        window.location.href = "input";
        //$("#p1").text(jqXHR.status);  //例：200とかでステータスがとれます
        //$("#p2").text(JSON.stringify(data1));  //文字列に変換する例
    }).fail(function(jqXHR, textStatus, errorThrown){
        //通信失敗
        console.log("失敗"+jqXHR.status);
    }).always(function(){
        //通信完了
        console.log("完了");
    });
}

//  ユーザー設定の家計簿項目削除用ajax処理
function delete_item($id){

    var json = {
        "id": $id
    };

    //これを忘れがち
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({
        url:"/wanwannokakeibo/item-delete",
        type:"post",
        contentType: "application/json",
        data:JSON.stringify(json),
        //dataType:"json",
    }).done(function(data1,textStatus,jqXHR) {
        //通信成功
        console.log("成功" + jqXHR.status);
        //画面再リロード
        window.location.href = "registration";
        //$("#p1").text(jqXHR.status);  //例：200とかでステータスがとれます
        //$("#p2").text(JSON.stringify(data1));  //文字列に変換する例
    }).fail(function(jqXHR, textStatus, errorThrown){
        //通信失敗
        console.log("失敗"+jqXHR.status);
    }).always(function(){
        //通信完了
        console.log("完了");
    });
}

