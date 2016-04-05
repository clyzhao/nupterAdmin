<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

$every_page_article_num=10;
$request=$_REQUEST['current_page'];
if($request){
  $current_page=$request;
}else{
  $current_page=1;
}

$rows=getRecordByPage("reading", $current_page, $every_page_article_num);
session_start();
$_SESSION['rows']=$rows;
$_SESSION['current_page']=$current_page;
$_SESSION["every_page_article_num"]=$every_page_article_num;
echo "<script>window.location='articles.php';</script>";