<?php 
header("content-type:text/html;charset=utf-8");
require_once 'conn.php';
$account=$_POST["account"];
$passwd=$_POST["passwd"];

if($account&&$passwd){
  $sql="select * from adminUser where account='$account'";
  $re=mysql_query($sql);
  if ($result=mysql_fetch_assoc($re)) {
    if ($passwd==$result["passwd"]) {
      session_start();
      $_SESSION["name"]=$result["nickName"];
      $_SESSION["author_img"]=$result["img_url"];
      echo "<script>window.location='editArticle.php';</script>";
    }else{
      echo "<script>alert('密码错误');</script>";
    }
  }else{
    echo "<script>alert('用户不存在');</script>";
  }
}else{
  echo "<script>alert('服务器没有得到数据，请重试');</script>"; 
}
echo "<script>window.location='login.html';</script>";