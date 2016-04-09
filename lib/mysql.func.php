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
    if($result){
      return mysql_affected_rows();
    }else{
      return false;
    }
}

function delete($table,$where=null){
  $where=$where==null?null:" where ".$where;
  $sql="delete from {$table} {$where}";
  mysql_query($sql);
  return mysql_affected_rows();
}

//得到一条记录
function fetchOne($sql,$result_type=MYSQL_ASSOC){
  $result=mysql_query($sql);
  $row=mysql_fetch_array($result,$result_type);
  return $row;
}

//得到结果集中所有记录
function fetchAll($sql,$result_type=MYSQL_ASSOC){
  $result=mysql_query($sql);
  while(@$row=mysql_fetch_array($result,$result_type)){
    $rows[]=$row;
  }
  return $rows;
}

//得到结果中记录条数
function getResultNum($sql){
  $result=mysql_query($sql);
  return mysql_num_rows($result);
}

//得到 当前页的结果集
function getRecordByPage($table,$current_page,$every_page_record_num){
  $start=((int)$current_page-1)*(int)$every_page_record_num;
  $sql="SELECT * FROM {$table} ORDER BY id DESC LIMIT {$start}, {$every_page_record_num}";
  $rows=fetchAll($sql);
  return $rows;
}
