<?php 
function alertMes($mes,$url){
	echo "<script>alert('{$mes}');</script>";
	echo "<script>window.location='{$url}';</script>";
}

//显示分页
function showArtPagination($page, $current_page){
  if($page==$current_page){
    echo "<li><a style='padding:0;'><form action='getArticleList.php' method='POST'><input style='padding:6px 11px; border-radius:0; background-color: #337ab7; border-color: #337ab7; color:#fff;' class='btn btn-default btn-sm' type='submit' name='current_page' value='".$page."'></input></form></a></li>";
  }else{
    echo "<li><a style='padding:0;'><form action='getArticleList.php' method='POST'><input style='padding:6px 11px; border-radius:0; border-color:#fff; color:#337ab7;' class='btn btn-default btn-sm' type='submit' name='current_page' value='".$page."'></input></form></a></li>";
  }
}

function showCarPagination($page, $current_page){
  if($page==$current_page){
    echo "<li><a style='padding:0;'><form action='getCarouselList.php' method='POST'><input style='padding:6px 11px; border-radius:0; background-color: #337ab7; border-color: #337ab7; color:#fff;' class='btn btn-default btn-sm' type='submit' name='current_page' value='".$page."'></input></form></a></li>";
  }else{
    echo "<li><a style='padding:0;'><form action='getCarouselList.php' method='POST'><input style='padding:6px 11px; border-radius:0; border-color:#fff; color:#337ab7;' class='btn btn-default btn-sm' type='submit' name='current_page' value='".$page."'></input></form></a></li>";
  }
}

//未完  生成分页
function createPagination($pagination_num, $total_page_num, $current_page){
  $mid_pagination=(int)$pagination_num/2+1;
  $change_pagination=$mid_pagination+1;
  if($total_page_num<$pagination_num){
    for($i=0; $i<$total_page_num; $i++){
      showPagination($i+1, $current_page);
    }
  }else if($total_page_num>=$pagination_num && $current_page<=$mid_pagination){
    for($i=0; $i<$pagination_num; $i++){
      showPagination($i+1, $current_page);
    }
  }else if($current_page>=$change_pagination && $total_page_num-$current_page>=$mid_pagination-1){
    for($i=0; $i<$pagination_num; $i++){
      showPagination($current_page-2+$i, $current_page);
    }
  }else if($current_page>=4 && $total_page_num-$current_page==1){
    for($i=0; $i<5; $i++){
      showPagination($current_page-3+$i, $current_page);
    }
  }else if($current_page>=4 && $total_page_num-$current_page==0){
    for($i=0; $i<5; $i++){
      showPagination($current_page-4+$i, $current_page);
    }
  }
}
//


//显示记录表
function showArticleTable($record_num, $current_page, $every_page_record_num, $rows){
  for($i=0; $i<$record_num; $i++){
    echo "<tr>";
    echo "<td width='5%'>".(($current_page-1)*$every_page_record_num+1+$i)."</td>";
    echo "<td width='25%'>".$rows[$i]["title"]."</td>";
    echo "<td width='10%'>".$rows[$i]["author"]."</td>";
    echo "<td width='10%'>".$rows[$i]["tag"]."</td>";
    echo "<td width='25%'>";
      for($j=1; $j<=3; $j++){
        if($rows[$i]["img_url{$j}"]){
          echo "<img height='70px' width='33.33%' border='1px solid #ccc' src='".$rows[$i]["img_url{$j}"]."'>";
        }
      }
    echo "</td>";
    echo "<td width='12.5%'><a href='editArticle.php?id=".$rows[$i]["id"]."'>编辑</a></td>";
    echo "<td width='12.5%'><a style='cursor:pointer;' onclick='javascript:confirm_del(".$rows[$i]["id"].")'>删除</a></td>";
    echo "</tr>";
  }
}

function showCarouselTable($record_num, $current_page, $every_page_record_num, $rows){
  for($i=0; $i<$record_num; $i++){
    echo "<tr>";
    echo "<td width='5%'>".(($current_page-1)*$every_page_record_num+1+$i)."</td>";
    echo "<td width='25%'>".$rows[$i]["title"]."</td>";
    echo "<td width='10%'>".$rows[$i]["author"]."</td>";
    echo "<td width='10%'>".$rows[$i]["tag"]."</td>";
    echo "<td width='25%'><img height='70px' width='50%' style='margin-left:25%;' border='1px solid #ccc' src='".$rows[$i]["img_url1"]."'></td>";
    echo "<td width='12.5%'><a href='editCarousel.php?id=".$rows[$i]["id"]."'>编辑</a></td>";
    echo "<td width='12.5%'><a style='cursor:pointer;' onclick='javascript:confirm_del(".$rows[$i]["id"].")'>删除</a></td>";
    echo "</tr>";
  }
}

