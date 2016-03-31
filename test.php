<?php
header("Content-type:text/html;charset=utf-8");
$isUpdate=1;
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form action="ddArticle.php?isUpdate=<?php echo $isUpdate;?>&id=<?php if($isUpdate) echo 1;?>" method="POST">
  <input type="submit"></input>
</form>
</body>
</html>