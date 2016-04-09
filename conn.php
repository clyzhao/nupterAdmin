<?php
// header("content-type:text/html;charset=utf-8");
// $conn = @mysql_connect("localhost","root","960926");
// if (!$conn) {
//     die(" 连接数据库失败" . mysql_error(). mysql_errno());
// } else {
//     mysql_query("SET NAMES UTF8");
//     mysql_query("set character_set_client=utf8");
//     mysql_query("set character_set_results=utf8");
//     mysql_select_db("nupter", $conn);
// }

header("Content_type:text/html;character=utf-8");
date_default_timezone_set("PRC");
$conn = @mysql_connect("localhost", "root", "960926");
if (!$conn) {
    die(" 连接数据失败" . mysql_error());
} else {
    mysql_query("SET NAMES UTF8");
    mysql_query("set character_set_client=utf8");
    mysql_query("set character_set_results=utf8");
    mysql_select_db("nupter", $conn);
    include './lib/common.func.php';
    include './lib/mysql.func.php';
}
?>