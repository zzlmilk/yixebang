
<div class="header2">
    <div>
        <img class="back" src="<?=base_url('html/images/icon/back.png')?>" alt=""/>
        <span class="back">返回</span>
    </div>
    医学要闻
</div>
<div class="search">
    <div><img src="<?=base_url('html/images/icon/banner.png')?>" alt=""/></div>
    <div>
        <div>
            <input type="text"/>
            <img src="<?=base_url('html/images/icon/input-search.png')?>" alt=""/>
        </div>
    </div>
</div>
<div class="contain" style="min-height: 300px">
    <div style="min-height:200px;text-align: center">
        <?= $articleDetail[0]['article_content']?>
    </div>
    <div class="informationArea">
        <div><div></div><p>精选留言</p><div></div></div>
        <p class="leaveMessage" onclick="window.location.href='<?=base_url('index.php/article/comment')?>/<?=$article_id?>'">写留言</p>
        <?php foreach ($comment as $item): ?>
        <div class="comment">
            <div><img src="" alt=""/>
                <span><?=$item['nickname']?></span></div>
            <p class="content"><?=$item["comment_content"]?></p>
            <p class="time"><?=$item['comment_time']?></p>
        </div>
        <?php endforeach;?>
    </div>
</div>
<div class="footer">
    <div><span>关于我们</span><span>医学帮</span><span>中医帮</span><span>知识商城</span></div>
    <p>昆明才子科技有限公司</p>
</div>
