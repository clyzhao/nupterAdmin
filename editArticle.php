<?php 
header("Content-type:text/html;charset=utf-8");
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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>文章管理系统</title>
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
  #img-container img{
    display: none;
    height: 200px;
    width: 150px;
    border: 1px solid #ccc;
    margin: 20px 10px;
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
        <li role="presentation" class="active">
          <a href="editArticle.php" role="pill" data-toggle="pill">编辑文章</a>
        </li>
        <li role="presentation">
          <a href="articles.php"     role="pill" data-toggle="pill">文章列表</a>
        </li>
        <li role="presentation">
          <a href="#"                role="pill" data-toggle="pill">消息管理</a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="col-md-10 col-lg-10" id="content-container">
    
    <header class="header">
      <div class="header-content">
        <span>欢迎您，</span>
        <span><?php echo "杨浩";?></span>
      </div>
      <div style="clear: both;"></div>
    </header>

    <div class="container">
      <div class="row" id="content">
        <div class="col-md-7 col-lg-6 col-md-offset-2">
          <p style="margin-top: 10px;">转载文章请直接到表单底部添加链接提交</p>
          <p style="margin-bottom: 20px;">特色图片说明：特色图片可选择添加，最多添加3张，用于在APP端显示文章列表时附加显示，不显示在文章中，原创及转载文章都可添加特色图片。文章中的图片请在编辑文章内容时添加。</p>
          <form action="addArticle.php?isUpdate=<?php echo $isUpdate;?>&id=<?php if($isUpdate) echo $info['id'];?>" onsubmit="return checkForm();" method="POST">
            <div class="form-group">
              <label for="title">文章标题</label>
              <input type="text" class="form-control" id="title" name="title" value="<?php if($isUpdate) echo $info['title'];?>">
            </div>
            <div class="form-group">
              <label for="author">文章作者</label>
              <input type="text" class="form-control" id="author" name="author" value="<?php echo $_SESSION["name"]; ?>" value="<?php if($isUpdate) echo $info['author'];?>">
            </div>
            <div class="form-group">
              <label for="tag">文章标签</label>
              <input type="text" class="form-control" id="tag" name="tag" value="<?php if($isUpdate) echo $info['tag'];?>">
            </div>
            <div class="form-group">
              <label for="content">文章内容</label>
              <div id="article_content">
                <script id="editor" type="text/plain" style="width:70%;height:600px;"></script>
              </div>
            </div>
            <div class="form-group">
              <label for="img" style="display: block;">特色图片</label>
              <p>特色图片用于在APP端显示文章列表时附加显示，可与文章中的图片不同。文章中的图片请在编辑文章内容时添加。</p>
              <div id="up_file">
                <a class="btn btn-success" id="pickfiles" href="#">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>添加特色图片</span>
                </a>
                <input type="text" name="img_url1" style="display:none" id="img_url1" value=''>
                <input type="text" name="img_url2" style="display:none" id="img_url2" value=''>
                <input type="text" name="img_url3" style="display:none" id="img_url3" value=''>
              </div>
              <div id="img-container">
                <img id="img1" src="">
                <img id="img2" src="">
                <img id="img3" src="">
              </div>
              <?php
                for($i=1; $i<=3; $i++){
                  $img_url="img_url".$i;
                  if($info[$img_url]){
                    echo "<script>$('#img".$i."').css('display','inline-block');</script>";
                    echo "<script>$('#img".$i."').attr('src','".$info[$img_url]."');</script>";
                  }
                }
              ?>
            </div>
            <div class="form-group">
              <label for="initial-url">转载文章请直接提交原文链接<span>（为了更好的用户体验，建议提交方便在移动设备上阅读的文章链接）</span></label>
              <input type="text" class="form-control" id="initial-url" name="initial_url">
            </div>
            <div class="form-group">
              <label for="additonal" style="display: block;">附加选项</label>
              <input type="checkbox" name="push" value="on"> 推送
            </div>
            <button type="submit" class="btn btn-success" style="float: right; margin-top: 30px;">提交文章</button>
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  var ueditor = UE.getEditor('editor');
  ueditor.ready(function () {
    <?php
    if ($isUpdate) {
        $str = str_replace("\n", "", $info["content"]);
       $str = str_replace("\r", "", $str);
       echo "ueditor.setContent('".$str."');";
    };
    ?>
  });

  var index=1;
  var uploader = Qiniu.uploader({
    runtimes: 'html5,flash,html4', //上传模式,依次退化
    browse_button: 'pickfiles', //上传选择的点选按钮，**必需**
    uptoken_url: 'getQiniuToken.php?la=la',
    //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
    // uptoken : '<Your upload token>',
    //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
    unique_names: true,
    // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
    // save_key: true,
    // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
    domain: 'http://qiniu-plupload.qiniudn.com/',
    //bucket 域名，下载资源时用到，**必需**
    container: 'up_file', //上传区域DOM ID，默认是browser_button的父元素，
    max_file_size: '100mb', //最大文件体积限制
    flash_swf_url: 'js/plupload/Moxie.swf', //引入flash,相对路径
    max_retries: 3, //上传失败最大重试次数
    dragdrop: false, //开启可拖曳上传
    //drop_element: 'container', //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
    chunk_size: '4mb', //分块上传时，每片的体积
    auto_start: true, //选择文件后自动上传，若关闭需要自己绑定事件触发上传
    init: {
        'FilesAdded': function (up, files) {
            plupload.each(files, function (file) {
                // 文件添加进队列后,处理相关的事情
            });
        },
        'BeforeUpload': function (up, file) {
            // 每个文件上传前,处理相关的事情
        },
        'UploadProgress': function (up, file) {

        },
        'FileUploaded': function (up, file, info) {
          if(index<=3){
            var res = JSON.parse(info);
            var sourceLink = "http://7xnxx0.com1.z0.glb.clouddn.com/" + res.key; // 获取上传成功后的文件的Url
            var imgId="#img"+index;
            var img_url="#img_url"+index;
            $(imgId).css("display", "inline-block");
            $(imgId).attr("src", sourceLink);
            $(img_url).val(sourceLink);
            // var value=$(img_url).
            index=index+1;
          }else{
            alert("不能再上传啦！");
          }
        },
        'Error': function (up, err, errTip) {
            //上传出错时,处理相关的事情
        },
        'UploadComplete': function () {
            //队列文件处理完毕后,处理相关的事情
        },
        'Key': function (up, file) {
            // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
            // 该配置必须要在 unique_names: false , save_key: false 时才生效
            var key = "";
            // do something with key here
            return key;
        }
    }
  });

  function checkForm(){
    var title=$("#title").val();
    var author=$("#author").val();
    var tag=$("#tag").val();
    var editorValue=ueditor.getContent();
    var initial_url=$("#initial-url").val();
    if(!title && !author && !tag && !editorValue && !initial_url){
      alert("请填写后提交。");
    }
    if(!initial_url){
      if(!title){
        changeBorder($("#title"));
        return false;
      }
      if(!author){
        changeBorder($("#author"));
        return false;
      }
      if(!tag){
        changeBorder($("#tag"));
        return false;
      }
      if(!editorValue){
        $("#ueditor_0").css("border", "1px solid #f00");
        // $("#ueditor_0").click(function(){
        //   console.log(a);
        //   $("#ueditor_0").css("border", "1px solid #ccc");
        // });
        return false;
      }
    }
  }

  function changeBorder(input){
    input.css("border", "1px solid #f00");
    input.click(function(){
      input.css("border", "1px solid #ccc");
    });
  }

  

  
 
</script>
</body>
</html>