<?php 
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(!$_GET){
  alertMes("服务器错误，请重试","editArticle.php");
}

$id=$_GET['id'];
$arr=$_POST;

$img_num=0;
for($i=1; $i<=3; $i++){
  $img_url="img_url".$i;
  if($arr[$img_url]){
    $img_num++;
  }
}
$arr["img_num"]=$img_num;
if(!array_key_exists("isPush", $arr)){
  $arr['isPush']=0;
}else{
  $arr['isPush']=1;
}
if($arr['initial_url']==""){
  $arr['isReprint']=0;
}else{
  $arr['isReprint']=1;
}

$arr["createTime"]=date("Y-m-d H:i:s");

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
    }else{
      alertMes("服务器错误，请重试", "getArticleList.php");
    }
  }else{
    alertMes("服务器错误，请重试", "editArticle.php?id=$id");
  }
}

