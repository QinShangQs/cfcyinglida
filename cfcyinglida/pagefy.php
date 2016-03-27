<?php
@header('Content-type: text/html;charset=utf-8');
//include('pagefy.php');
          if($num ){
           if($pageval==""&&$pageval<=1)$pageval=1;///第0页 时出现错误
          echo "共 $num 条记录  ";
          echo "<div class=\"pageright\">
                        <ul>
                        <li class=\"uppage\">";
          if($pageval-1<=0){ echo "<a href=".$url."page=1>首页</a></li> ";}
          else{ echo "<a href=".$url."page=1>首页</a></li> <li style=\"width:60px;\"><a href=".$url."page=".($pageval-1).">上一页</a>";}
          /*for($i=1;$i<=$pagenum;$i++){
          if($pageval==$i){echo "<li class=\"this\">".$i."</li> ";}
          else{echo " <li><a href=".$url."page=$i>$i</a></li> ";}
          }*/
          
if($pageval<9){
  if($pagenum<10){
  $fyzsh=$pagenum;
  }else{
  $fyzsh=10;
  }
  for($i=1;$i<=$fyzsh;$i++){
    if($pageval==$i){echo " <li class=\"this\">".$pageval."</li> ";}
    else{echo " <li><a href=".$url."page=$i>$i</a></li> ";}
  }/*
  if($pagenum>10){
    echo " ... ";
  }*/
}else{

    //echo " ... ";
  for($fyqi=$pageval-5;$fyqi<$pageval;$fyqi++){
    if($fyqi<=$pagenum){
      echo " <li><a href=".$url."page=$fyqi>$fyqi</a></li> ";
    }
  }
  echo " <li class=\"this\">".$pageval."</li> ";
  for($fyhi=$pageval+1;$fyhi<$pageval+6;$fyhi++){
    if($fyhi<=$pagenum){
      echo " <li><a href=".$url."page=$fyhi>$fyhi</a></li> ";
    }
  }/*
  if($fyhi<=$pagenum){
    echo " ... ";
  }*/
}          
          if($pageval+1>$pagenum) echo "<li class=\"downpage\">末页</li>";
          if($pageval!=$pagenum){ echo "<li style=\"width:60px;\"><a href=".$url."page=".($pageval+1).">下页</a></li>  <li class=\"downpage\"><a href=".$url."page=".($pagenum).">末页</a></li>";}
          echo "</ul>
                      </div>";
          }
?>
