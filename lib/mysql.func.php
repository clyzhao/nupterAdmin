<?php
function insert($table,$array){
  $keys=join(",",array_keys($array));
  $vals="'".join("','",array_values($array))."'";
  $sql="insert {$table}($keys) values({$vals})";
  mysql_query($sql);
  return mysql_insert_id();
}

function update($table,$array,$where=null){
  foreach($array as $key=>$val){
    if($str==null){
      $sep="";
    }else{
      $sep=",";
    }
    $str.=$sep.$key."='".$val."'";
  }
    $sql="update {$table} set {$str} ".($where==null?null:" where ".$where);
    $result=mysql_query($sql);
    //var_dump($result);
    //var_dump(mysql_affected_rows());exit;
    if($result){
      return mysql_affected_rows();
    }else{
      return false;
    }
}