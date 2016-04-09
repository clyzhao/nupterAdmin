<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

$every_page_article_num=10;
if(array_key_exists("current_page", $_REQUEST)){
  $current_page=$_REQUEST["current_page"];
}else{
  $current_page=1;
}

$rows=getRecordByPage("reading", $current_page, $every_page_article_num);
session_start();
$_SESSION['rows']=$rows;
$_SESSION['current_page']=$current_page;
$_SESSION["every_page_article_num"]=$every_page_article_num;
echo "<script>window.location='articles.php';</script>";