<div class="header2">
    <div>
        <img class="back" src="<?=base_url('html/images/icon/back.png')?>" alt=""/>
        <span class="back">返回</span>
    </div>
</div>
<div class="contain" style="min-height: 400px;">
    <div class="writeComment">
        <p>【寒战】</p>
        <form action="">
            <textarea name="" id="comment" cols="30" rows="5" placeholder="请输入评论……"></textarea>
        </form>
        <div class="button">
            <p onclick="doComment()">提交</p>
        </div>
    </div>
</div>
<script>
    var article_id='<?=$article_id?>';
    var base_url='<?=base_url('index.php/article/doComment')?>';
    var article_url='<?=base_url('index.php/article/detail')?>';
    function doComment(){
        var commenInfo=$('#comment').val();
        var sendJSON={};
        sendJSON.url_ajax=base_url;
        sendJSON.type_ajax='post';
        sendJSON.commentInfo=commenInfo;
        sendJSON.article_id=article_id;
        JK.ajax(sendJSON,function(data){
            if(data.errCode=="0000"){
                alert("评论成功！");
                window.location.href=article_url+'/'+article_id;
            }
        })
    }
</script>