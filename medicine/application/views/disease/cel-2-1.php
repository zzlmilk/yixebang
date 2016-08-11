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
                <tr>
                    <td colspan="999"><?=$menu[0]['name']?></td>
                </tr>
                <?php
                    $i = 1;
                    echo '<tr>';
                    foreach ($colList as $key)
                    {
                        if($i==1){ echo "<td><img src='http://121.41.128.20/medhelper_admin/img/'".$menu[0]['img_file']."/></td>";};
                        echo "<td onclick='gotoCel(".$key['type_id_3'].",this)'>".$key['name'].'</td>';
                        if($i%2 == 0) echo "</tr><tr>";
                        ++$i;
                    }
                    echo '</tr>';
                ?>
            </table>
    </div>
</div>
<script>
    function gotoCel(id3,obj){
        var baseUrl='<?=base_url('index.php/Disease/cll')?>';
        var id1='<?=$type_id_1?>';
        var id2='<?=$type_id_2?>';
        window.location.href=baseUrl+"/"+id3+"?type_id_1="+id1+"&type_id_2="+id2;
    }
</script>