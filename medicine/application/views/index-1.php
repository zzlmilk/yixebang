<div class="search">
    <div><img src="<?=base_url('html/images/icon/banner.png')?>" alt=""/></div>
    <div>
        <div>
            <input type="text"/>
            <img src="<?=base_url('html/images/icon/input-search.png')?>" alt=""/>
        </div>
        <p>
            <span onclick="window.location.href='<?=base_url('index.php/article/cel/1/1')?>'">资讯</span>
            <span onclick="window.location.href='<?=base_url('index.php/article/cel/2/1')?>'">导医</span>
            <span onclick="window.location.href='<?=base_url('index.php/disease/cel/6/1')?>'">疾病</span>
            <span onclick="window.location.href='<?=base_url('index.php/article/cel/4/1')?>'">专科</span>
            <span onclick="window.location.href='<?=base_url('index.php/Fadoctor/cel'/1)?>'">名医</span>
            <span onclick="window.location.href='<?=base_url('index.php/article/cel/9/1')?>'">药物</span>
            <span onclick="window.location.href='<?=base_url('index.php/article/cel/7/1')?>'">知识</span>
            <span onclick="window.location.href='<?=base_url('index.php/article/cel/8/1')?>'">图片</span>
        </p>
    </div>
</div>
<div class="contain" style="min-height: 300px">
    <?php foreach ($articleList as $item):?>
        <div class="news" onclick="window.location.href='<?=base_url('index.php/article/detail/')?>/<?=$item['id']?>'">
            <div>
                <div><img src="<?=base_url('html/images/icon/information.png')?>" alt="资讯"/></div>
                <div>
                    <p><?=$item["title"]?></p>
                    <p><?=$item["article_content"]?></p>
                </div>
            </div>
            <div>
                <div><span>医学要闻</span><span>2016-06-30</span></div>
                <div><span>1123</span><span>1123</span></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="footer">
    <div><span>关于我们</span><span>医学帮</span><span>中医帮</span><span>知识商城</span></div>
    <p>昆明才子科技有限公司</p>
</div>
