<html>
<head>
    <title>DBtest</title>
</head>
<body>
<h1></h1>
<p>DBtest</p>
<?=base_url("css")?>
<?php foreach ($dbResult as $item):?>
    <li><?= $item["phone"] ?></li>
<?php endforeach; ?>
</body>
<script>
    //    var userArr ="<?//=$pre_list?>//";
    //    alert(userArr);
</script>
</html>