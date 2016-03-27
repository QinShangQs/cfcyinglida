<?php session_start(); 
$b = "0.23";   echo round($b * 100 );
die;
@header('Content-type: text/html;charset=utf-8');
//include('newdb.php');
if(!Mysql_connect("localhost","root","xx.13579"))
  echo "连接数据库失败";
  Elseif(!Mysql_select_db("suotantmp"))
  echo "打开数据库失败";
date_default_timezone_set('prc');
mysql_query("set names utf8");
$selectsql="select * from `hzhjchxx` where `id`<100";
$selectquery=mysql_query($selectsql);
$i=1;
while($RecordSelect=mysql_fetch_array($selectquery)){
  if($RecordSelect[1]!=''&&$RecordSelect[1]!=null){
    $name=$RecordSelect[1];  //患者姓名
    $doctor=$RecordSelect[2];  //医生姓名
    $zhjhm=$RecordSelect[3];  //证件号码
    if($RecordSelect[4]==1){
      $hzhxb='男';     //性别
    }
    if($RecordSelect[4]==2){
      $hzhxb='女';     //性别
    }
    $dianhua=$RecordSelect[6];//电话
    $shouji=$RecordSelect[7];//手机
    $diyilxr=$RecordSelect[8];//第一联系人手机
    $dierlxr=$RecordSelect[9];//第二联系人手机
    $dizhi=$RecordSelect[10];//地址
    $youbian=$RecordSelect[11];//邮编
    if($RecordSelect[12]==1){
      $bzh='GIST';
    }
    if($RecordSelect[12]==2){
      $bzh='RCC';
    }
    if($RecordSelect[12]==3){
      $bzh='pNET';
    }
    if($RecordSelect[13]==1){
      $jzhlx='全部捐赠';
    }
    if($RecordSelect[13]==2){
      $jzhlx='部分捐赠';
    }
    $tbrq=date('Y-m-d',strtotime($RecordSelect[14]));   //填表日期
    
    $bianma=$RecordSelect[16];  //患者编码
    $lydzh=$RecordSelect[17];   //领药地址
    $rzrq=date('Y-m-d',strtotime($RecordSelect[20]));   //入组地址
    if(!Mysql_connect("localhost","root","xx.13579"))
      echo "连接数据库失败";
      Elseif(!Mysql_select_db("cfcyinglida"))
      echo "打开数据库失败";
      date_default_timezone_set('prc');
      mysql_query("set names utf8");
    echo $insertsql="insert into `hzh` (`hzhid`,`hzhxm`,`zhjhm`,`shqbzh`,`hzhtxdzh`) values ('$bianma','$name','$zhjhm','$bzh','$dizhi');";
    $query=mysql_query($insertsql);
    if($query){
      echo "插入成功，即将执行第".$i."次";
    }else{
      echo "失败";
    }
    echo "<br>";
    $i++;
  }
}
?>
