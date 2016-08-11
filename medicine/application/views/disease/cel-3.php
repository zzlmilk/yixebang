<div class="header2">
    <div>
        <img class="back" src="<?=base_url('html/images/icon/back.png')?>" alt=""/>
        <span class="back">返回</span>
    </div>
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
    <div style="padding: 10px">
        <table>
            <?php
            $i = 1;
            foreach ($cllList as $key)
            {
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo "<td onclick='gotoArticle(".$key['id'].")'>".$key['name']."</td>";
                echo '</tr>';
                $i++;
            }
            ?>
        </table>
    </div>
</div>
<script>
    function gotoArticle(id1){
        var baseUrl='<?=base_url('index.php/article/commonDetail')?>';
        window.location.href=baseUrl+"/6/"+id1;
    }
</script>