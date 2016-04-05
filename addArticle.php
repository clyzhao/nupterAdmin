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

if($_GET['isUpdate']==0){
  if(insert("reading", $arr)){
    alertMes("添加成功", "getArticleList.php");
  }else{
    alertMes("服务器错误，请重试", "editArticle.php");
  }
}else{
  $where="id=$id";
  if(delete("reading", $where)){
    if(insert("reading", $arr)){
      alertMes("更新成功", "getArticleList.php");
    }
  }else{
    alertMes("服务器错误，请重试", "editArticle.php?id=$id");
  }
}

