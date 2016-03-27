<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id = $_POST['id'];
//是否批准
$shfpzh = $_POST['shfpzh'];
//拒绝原因
$jujue = $_POST['jujue'];
//是否办理入组
//$shfrzh = $_POST['shfrzh'];
//预估办理入组时间
$zhshrzshj = $_POST['rzrq'];
//医院id
//$qryy = $_POST['qryy'];//判断 0 1 
//$zhdyyid = $_POST['zhdyyid'];//判断 0 获取  
//$selzhdyyid = $_POST['selzhdyyid'];//判断 1 获取 

//更换药房
//$qryf = $_POST['qryf'];//判断 0 1 
//$selzhdyf = $_POST['selzhdyf'];//判断 1 获取 

//手册寄出日期
//$shcrq = $_POST['shcrq'];
//备注
$bzh = $_POST['bzh'];
//是否更换日期 1是0否
//$ygrq = $_POST['ygrq'];
//更换后日期
//$ygrqgh = $_POST['ygrqgh'];


//审核人
$shhr = $_SESSION['yhname'];
//运单号
$shcydh = $_POST['shcydh'];
$datenow = date('Y-m-d');

$yzhxx=0;
  
$query="UPDATE `hzh` SET ";
//echo $shfpzh;
if($shfpzh==1){
/*验证基础信息是否填写完整 开始*/
$sql = "select `hzhxm`,`zhjhm`,`shqyy`,`hzhtxdzh`,`hzhshj`,`hzhhj`,`hzhjtrk`,`jtnshr`,`rjshr`,`jzhlx`,`ypgg`,`ypyl`,`hzhchshrq`,`djrq` from `hzh` where id='$id' ";
  /*$sql = "select * from `hzh` where id='$id' ";*/
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){ 
  //print_r($Record);
  //echo $Record[7];
  $hzhjzhlx=$Record[10];
    for($i=0;$i<count($Record)/2;$i++){
      if($Record[$i]==""){  
        /*if($i==16){}
        else if($i==5){}
        else {}*/
          echo "失败 患者（基础信息）不完整 </br>";
          echo "空项：". $i ;echo "<br>";
          //echo count($Record) ;
          exit();
          $yzhxx++;
        
      }//echo $i;
      
    }$hzhjtrk=$Record[20];
      if($Record[7]==0){
        echo "失败 患者家庭年收入为0 </br><input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
        exit();
      }
  }
  //echo $sql;

/*验证基础信息是否填写完整 结束*/

/*验证直系亲属是否填写完整 开始*/
  $sql = "select * from `zhxqsh` where hzhid='$id' and `gxzf`='1'";
  $Query_ID = mysql_query($sql);
  $num = mysql_num_rows($Query_ID);
if($hzhjtrk!=$num){
   //echo $hzhjtrk."失败 直系亲属 未通过 </br>".$hzhjtrk;
        //$yzhxx++;
}
  //echo $sql;

/*验证直系亲属是否填写完整 结束*/

/*验证材料是否填写完整 开始*/
  $sql = "select `shhyj` from `clshh` where hzhid='$id' and id in (select max(id) from `clshh` where hzhid='$id')";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
      if($Record[0]=="0"){
        echo "失败 患者（提供的材料信息）未通过 </br>";
        //echo "aa". $i ;
        //echo count($Record) ;
        //exit();
        $yzhxx++;
    }
  }if(mysql_num_rows($Query_ID)<1){
        echo "失败 患者（提供的材料信息）未填写 </br>";
        //echo "aa". $i ;
        //echo count($Record) ;
        //exit();
        $yzhxx++;
}
  //echo $sql;

/*验证材料是否填写完整 结束*/

/*验证社会调查是否属实 开始*/
  $sql = "select `shfshsh`  from `shhdch` where hzhid='$id'";
  $Query_ID = mysql_query($sql);
  $shhdchshsh=0;
    //echo $sql;
  while($Record = mysql_fetch_array($Query_ID)){

    if($Record[0]=="1"){
    $shhdchshsh=1;
    }
  }
  if($shhdchshsh!=1){
    echo "失败 患者（社会调查）未通过  </br>";
    //exit();
    $yzhxx++;
  }
/*验证社会调查是否属实 结束*/
/*验证医学评估报告 开始
  $sql = "select `lchzhd` ,`zhdrq` ,`zhlbl` ,`fq` ,`alkjc` ,`alkzhdff`,`skrkshzhlshj`  ,`skrzhllch` ,`skrzhlxgpg` ,`chxwfnshdfzy` ,`shfygjxskrzhl`,`chxwfnshdfzy`  from `yxpgbg` where hzhid='$id' and `bglx`='1'";*/
  $sql = "select * from `yxpgbg` where hzhid='$id' and `bglx`='1'";
  $Query_ID = mysql_query($sql);
  $shhdchshsh=0;
    //echo $sql;
  while($Record = mysql_fetch_array($Query_ID)){
    if($Record[0]!=""&&$Record[1]!=""&&$Record[2]!=""&&$Record[3]!=""&&$Record[4]!=""&&$Record[5]!=""&&$Record[6]!=""&&$Record[7]!=""&&$Record[8]!=""&&$Record[9]!=""&&$Record[10]!=""){$shhdchshsh=1;
    /*if($hzhjzhlx!="全部"&&$Record[6]!=""&&$Record[7]!=""&&$Record[8]!="PD"&&$Record[8]!="未用药"&&$Record[11]!="未用药"){$shhdchshsh=1;}else if(($Record[6]==""||$Record[7]=="")&&$Record[8]!="PD"){*/
    }
  }
  if($shhdchshsh!=1){
  echo $shhdchshsh;
    echo "失败 医学评估报告 未通过  </br>";
    //exit();
    $yzhxx++;
  }
/*验证医学评估报告 结束*/
if($yzhxx>0){
echo "<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
exit();
}
    if($qryy=="1"){$rzyy=$selzhdyyid;}else {$rzyy=$zhdyyid;}

    $yysql = "select yyzhdyf,yymch,zhdysh from `yyyshdq` where `id`='".$rzyy."'";
    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
       $rzyyzhdyf=$yyRecord[0];
         $rzyymch=$yyRecord[1];
         $rzyyzhdysh=$yyRecord[2];
    }
    
    if($qryf=="1"){$rzyyzhdyf=$selzhdyf;}
    /*$yfsql = "select id from `yf` where `id`='".$rzyyzhdyf."'";

    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){
       $lyyfid=$yfRecord[0];
    }*/

    $shqzht = " `shqzht`='审核',`ygshcyyrq`='$zhshrzshj',`lyyf`='$rzyyzhdyf',`rzyy`='$rzyy',`hzhid`='$hzhid',`dbrzshxshj`='',`shhxcl`='0',`zhzhyy`=''";//`dbrzshxshj`='' 清空待办日期 `zhzhyy`='' 转诊医院清空
    if($ygrq=='1'){$shqzht .= ",`ygshcyyrq`='$ygrqgh' ";
      $ygrqghxclyrq=date('Y-m-d',strtotime('-7 day',strtotime($ygrqgh)));
      $xcfyrqquery="UPDATE `xclyrq` SET `xclyrq`='$zhshrzshj' where `hzhid`='$id'";
      //echo $xcfyrqquery;
      $xcfyrqresult=mysql_query($xcfyrqquery);
      if(!$xcfyrqresult)
      {
        echo mysql_error();
        echo "添加下次发药日期失败 ";
      }
      else{
        echo "添加预估下次发药日期成功 ";
      }
    }   
$shhyj = "批准-入组";
$query.= $shqzht." WHERE `id` ='$id'";
}
else{
$query.= " `shqzht`='拒绝',`shhyj`='$jujue',`jjrq`='$datenow',`dbrzshxshj`='',`zhshrzshj`='',`shhxcl`='0' WHERE `id` ='$id'";
    $shhyj = "拒绝";
}
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
    }else{
    if($shfpzh!='1'){$bzh1=$jujue;}else{$bzh1=$bzh;}
    //if($shhyj=="批准-入组"){$rzyyxx="入组医院/医生：".$rzyymch." ".$rzyyzhdysh;}else {$rzyyxx="";}
      $shhejlquery="insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values('$id','$shhr','$shhyj','$datenow','".$rzyyxx." ".$bzh1."')";
      $shhejlresult=mysql_query($shhejlquery);
      if(!$shhejlresult)
      {
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
      }
      else{}
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$id\">";
    }
?>
