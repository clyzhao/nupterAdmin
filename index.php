<?php 
header("Content_type:text/html;character=utf-8");
include 'conn.php';

session_start();
if(!$_SESSION["name"]){
  header("Location:login.html");
}else{
  $userName=$_SESSION['name'];
}

$isUpdate=0;
if(!$_GET){
  // echo "<script>alert('服务器出错，请重试');</script>";
  // header("Location:articles.php");
}else{
  $id=$_GET["id"];
  $sql="select * from reading where id=$id limit 1";
  if($res=mysql_query($sql)){
    $info=mysql_fetch_assoc($res);       
  }
  $isUpdate=1;
}
include 'editArticle.php';
?>
