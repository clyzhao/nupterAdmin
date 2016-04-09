<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(array_key_exists("clock", $_POST)){
  $clock=$_POST["clock"];
}else{
  alertMes("服务器未得到请求", "userConfirm.html");
}

if($clock=="eight"){
  alertMes("回答正确！", "login.html");
}else{
  alertMes("回答的不对哟，再看看", "userConfirm.html");
}
