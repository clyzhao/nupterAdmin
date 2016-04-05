<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(!$_GET){
  alertMes("服务器错误，请重试","getArticleList.php");
}

$id=$_GET['id'];

$where="id=$id";
if(delete("reading", $where)){
  alertMes("删除成功", "getArticleList.php");
}else{
  alertMes("服务器错误，请重试", "getArticleList.php");
}
