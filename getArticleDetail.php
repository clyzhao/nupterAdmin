<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

if(array_key_exists("id", $_REQUEST)){
  $id=$_REQUEST["id"];
  $sql="SELECT * FROM reading WHERE id={$id}";
}else{
  $sql="SELECT * FROM reading ORDER BY id DESC LIMIT 0, 1";
}

if($row=fetchOne($sql)){
  $row["createTime"]=date("Y-m-d", strtotime($row["createTime"]));
}else{
  
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $row["title"]; ?></title>
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <style type="text/css">
    @media screen and (min-width:920px) and (max-width:1800px) {
        body {
            background: #fff;
            width: 50%;
            margin-left: 25%;
            font-family: "Microsoft Yahei";
        }
    }
    .container{
      /*text-align: center;*/
      margin-top: 20px;
    }
    .tag{
      line-height: 2em;
    }
    .author{
      float: left;
    }
    .author img{
      height: 26px;
      margin-bottom: -5px;
      margin-right: 5px;
    }
    .date{
      float: right;
    }
    .content{
      line-height: 2em;
      margin-top: 15px;
    }
  </style>
</head> 
<body>
<div class="container">
  <h2><?php echo $row["title"]; ?></h2>

  <div class="tag">
    <div class="author">
      <img src="img/face.png">
      <span class="author-name"><?php echo $row["author"]; ?></span>
    </div>
    <div class="date"><?php echo $row["createTime"]; ?></div>
    <div style="clear: both;"></div>
  </div>

  <div class="content">
  <?php echo $row["editorValue"]; ?>
  </div>
</div>
</body>
</html>


