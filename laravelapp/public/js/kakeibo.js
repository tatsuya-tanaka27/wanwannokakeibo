window.onload = function() {

};

$(function(){
 $('#inputArea').width($('#inputTable').width());
 $('#listArea').width($('#listTable').width());
});

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
            //削除された行の要素を一通り削除
            $('#kakeiboData' + $id).remove();
            $('#kakeiboDataId' + $id).remove();
            $('#kakeiboDataDataTr' + $id).remove();
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

