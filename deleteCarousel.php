<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(!$_GET){
  alertMes("服务器错误，请重试","getCarouselList.php");
}

$id=$_GET['id'];

$where="id=$id";
if(delete("carousels", $where)){
  alertMes("删除成功", "getCarouselList.php");
}else{
  alertMes("服务器错误，请重试", "getCarouselList.php");
}
