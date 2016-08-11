<html>
<head>
    <title>DBtest</title>
</head>
<body>
<h1></h1>
<p>DBtest</p>

<?php foreach ($dbResult as $item):?>
    <li><?= $item->phone ?></li>
<?php endforeach; ?>
<a><?php print_r($dbResult) ?></a>
</body>
<script>
    //    var userArr ="<?//=$pre_list?>//";
    //    alert(userArr);
</script>
</html>