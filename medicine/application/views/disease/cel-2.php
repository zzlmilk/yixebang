<div class="header2">
    <div>
        <img class="back" src="<?=base_url('html/images/icon/back.png')?>" alt=""/>
        <span class="back">返回</span>
    </div>
    <?=$title?>
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
        <?php foreach ($celList as $item):?>
            <table>
                <tr>
                    <td colspan="3"><?=$item[0]['name']?></td>
                </tr>
                <?php
                    $i = 1;
                    echo '<tr>';
                    foreach ($item[1] as $key)
                    {
                        if($i==1){ echo "<td><img src='http://121.41.128.20/home/wwwroot/default/medhelper/Public/image/type/'".$item[0]['img_file']."/></td>";};
                        echo "<td onclick='gotoCel(".$item[0]['type_id_1'].",".$key['type_id_2'].",this)'>".$key['name'].'</td>';
                        if($i%2 == 0) echo "</tr><tr>";
                        ++$i;
                    }
                    echo '</tr>';
                ?>
            </table>
        <?php endforeach; ?>
    </div>
</div>
<script>
    function gotoCel(id1,id2,obj){
        var baseUrl='<?=base_url('index.php/Disease/col6')?>';
        window.location.href=baseUrl+"/"+id1+"/"+id2;
    }
</script>