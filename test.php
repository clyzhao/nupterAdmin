<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

$sql="INSERT reading(isPush, isReprint) VALUES('1','0')";
if(mysql_query($sql)){
  echo "success";
}else{
  print_r(mysql_error());
}
