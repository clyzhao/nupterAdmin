<?php
header("Content-type:text/html;charset=utf-8");
include 'conn.php';

session_start();
if(!$_SESSION){
  header("Location:login.html");
}else{
  $userName=$_SESSION['name'];
  $rows=$_SESSION['rows'];
  $current_page=$_SESSION['current_page'];
  $every_page_carousel_num=$_SESSION["every_page_carousel_num"];
}
$sql="SELECT * FROM carousels ORDER BY id DESC";
$carousel_num=getResultNum($sql);
$total_page_num=((int)($carousel_num/$every_page_carousel_num))+1;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>掌上南邮4.0CMS</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/plupload.full.min.js"></script>
  <script type="text/javascript" src="js/qiniu.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
  <style type="text/css">
  html,body{
    height: 2000px;
    overflow-x: hidden;
  }
  .container{
    width: 100%;
  }
  .container, .row, #side-bar{
    height: 100%;
  }
  .container, #side-bar, #content-container{
    padding: 0;
    margin: 0;
  }
  #side-bar{
    background: #262d40;
    text-align: center;
  }
  #side-bar h2{
    color: rgb(37,155,254);
    margin-top: 50px;
    margin-bottom: 30px;
  }
  #side-bar a{
    color: #ffffff;
    text-decoration: none;
  }
  #side-bar-tab li.active{
    background: rgb(72,143,210);
  }
  #side-bar-tab li>a:hover{
    background: rgb(72,143,210);
  }
  .header{
    height: 50px;
    background: rgb(61,74,93);
    color: #ffffff;
  }
  .header-content{
    float: right;
    margin-right: 30px !important;
    line-height: 50px;
  }
  #content{
    margin-top: 50px;
  }
  .turnpage{
    position: absolute; 
    left: -1px; 
    top:-1px;
    width: 32px; 
    height: 34px; 
    opacity: 0;
  }
  </style>
</head>
<body>
<div class="container">
<div class="row">
  <div class="col-md-2 col-lg-2" id="side-bar">
    <a href="editArticle.php"><h2>掌上南邮4.0</h2></a>
    <nav>
      <ul class="nav nav-pills nav-stacked" id="side-bar-tab">
        <li role="presentation">
          <a href="editArticle.php">编辑文章</a>
        </li>
        <li role="presentation">
          <a href="getArticleList.php">文章列表</a>
        </li>
        <li role="presentation">
          <a href="editCarousel.php">编辑轮播</a>
        </li>
        <li role="presentation" class="active">
          <a href="getCarouselList.php">轮播列表</a>
        </li>
        <li role="presentation">
          <a href="#">消息管理</a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="col-md-10 col-lg-10" id="content-container">
    
    <header class="header">
      <div class="header-content">
        <span>欢迎您，</span>
        <span><?php echo $_SESSION["name"];?></span>
      </div>
      <div style="clear: both;"></div>
    </header>

    <div class="container">
      <div class="row" id="content">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">    
          <table class='table table-bordered table-hover table-responsive' width='100%' style="margin-bottom: 0 !important;">
            <tr>
                <th width='5%'>序号</th>
                <th width='25%'>标题</th>
                <th width='10%'>作者</th>
                <th width='10%'>标签</th>
                <th width='25%'>轮播图</th>
                <th width='12.5%'>编辑</th>
                <th width='12.5%'>删除</th>
            </tr>
            <?php
            if($current_page==$total_page_num){
              $rest_carousel_num=$carousel_num-($total_page_num-1)*$every_page_carousel_num;
              showCarouselTable($rest_carousel_num, $current_page, $every_page_carousel_num, $rows);
            }else{
              showCarouselTable($every_page_carousel_num, $current_page, $every_page_carousel_num, $rows);
            }
            ?>
          </table>
            <nav style="text-align: center;">
              <ul class="pagination">
                <li>
                  <a aria-label="Previous">
                    <form action="getCarouselList.php" method="POST">
                      <span aria-hidden="true">&laquo;</span>
                      <input type="submit" class="turnpage" name="current_page" value="<?php if($current_page==1){echo 1;} else{echo $current_page-1;} ?>"></input>
                    </form>
                  </a>
                </li>
                <?php 
                if($total_page_num<5){
                  for($i=0; $i<$total_page_num; $i++){
                    showCarPagination($i+1, $current_page);
                  }
                }else if($total_page_num>=5 && $current_page<=3){
                  for($i=0; $i<5; $i++){
                    showCarPagination($i+1, $current_page);
                  }
                }else if($current_page>=4 && $total_page_num-$current_page>=2){
                  for($i=0; $i<5; $i++){
                    showCarPagination($current_page-2+$i, $current_page);
                  }
                }else if($current_page>=4 && $total_page_num-$current_page==1){
                  for($i=0; $i<5; $i++){
                    showCarPagination($current_page-3+$i, $current_page);
                  }
                }else if($current_page>=4 && $total_page_num-$current_page==0){
                  for($i=0; $i<5; $i++){
                    showCarPagination($current_page-4+$i, $current_page);
                  }
                }
                ?>
                <li>
                  <a aria-label="Next">
                    <form action="getCarouselList.php" method="POST">
                      <span aria-hidden="true">&raquo;</span>
                      <input type="submit" class="turnpage" name="current_page" value="<?php if($current_page==$total_page_num){echo $current_page;} else{echo $current_page+1;} ?>"></input>
                    </form>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
      </div>
    </div>  
  </div>
</div>
</div>
<script type="text/javascript">
  function confirm_del(id){
    console.log(id);
    var res=confirm("您确定删除该条信息？");
    if(res==true){
      var path="deleteCarousel.php?id="+id;
      window.location.href=path;
    }
  }
</script>
</body>
</html>