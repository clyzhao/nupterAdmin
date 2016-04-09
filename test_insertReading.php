<?php
header("content-type:text/html;charset=utf-8");
require_once 'conn.php';

$sql="INSERT carousels(title, author) value('test', 'test')";
for($i=0; $i<30; $i++){
  mysql_query($sql);
}

