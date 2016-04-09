<?php 
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(!$_GET){
  alertMes("服务器错误，请重试","editCarousel.php");
}

$id=$_GET['id'];
$arr=$_POST;

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
  if(insert("carousels", $arr)){
    alertMes("添加成功", "getCarouselList.php");
  }else{
    alertMes("服务器错误，请重试", "editCarousel.php");
  }
}else{
  $where="id=$id";
  if(delete("carousels", $where)){
    if(insert("carousels", $arr)){
      alertMes("更新成功", "getCarouselList.php");
    }else{
      alertMes("服务器错误，请重试", "getCarouselList.php");
    }
  }else{
    alertMes("服务器错误，请重试", "editCarousel.php?id=$id");
  }
}

