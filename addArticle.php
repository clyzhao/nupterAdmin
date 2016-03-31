<?php 
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(!$_GET){
  alertMes("服务器错误，请重试","editArticle.php");
}

$id=$_GET['id'];
$arr=$_POST;
if(!$arr['push']){
  $arr['ifPush']="no";
}else{
  $arr['ifPush']="yes";
}
if($arr['initial_url']==""){
  $arr['ifReprint']="no";
}else{
  $arr['ifReprint']="yse";
}
//print_r($arr);

if($_GET['isUpdate']==0){
  if(insert("reading", $arr)){
    alertMes("添加成功", "articles.php");
  }
}

