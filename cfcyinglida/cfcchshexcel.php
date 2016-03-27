<?php  session_start(); 
Mysql_connect("localhost","root","117791536");
Mysql_select_db("CFCSYSTEM");
mysql_query("set names utf8");
//include('newdb.php');
date_default_timezone_set('prc');

require_once 'PHPExcel_1.7.9_doc/Classes/PHPExcel.php';  
require_once 'PHPExcel_1.7.9_doc/Classes/phpExcel/Writer/Excel2007.php';  
require_once 'PHPExcel_1.7.9_doc/Classes/phpExcel/Writer/Excel5.php';  
include_once 'PHPExcel_1.7.9_doc/Classes/phpExcel/IOFactory.php';  
  
$objExcel = new PHPExcel();  
//设置属性 (这段代码无关紧要，其中的内容可以替换为你需要的)  
$objExcel->getProperties()->setCreator("andy");  
$objExcel->getProperties()->setLastModifiedBy("andy");  
$objExcel->getProperties()->setTitle("Office 2003 XLS Test Document");  
$objExcel->getProperties()->setSubject("Office 2003 XLS Test Document");  
$objExcel->getProperties()->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");  
$objExcel->getProperties()->setKeywords("office 2003 openxml php");  
$objExcel->getProperties()->setCategory("Test result file");  
$objExcel->setActiveSheetIndex(0);  
$objExcel->getDefaultStyle()->getFont()->setName('宋体');
$i=0;  
//表头  
$k1="城市名称"; 
$k2="申请患者数量"; 
$k3="入组患者数量";  
$k4="审核中患者数量"; 
$k5="待入组患者数量"; 
$k6="停止申请患者数量";  
$k7="拒绝患者数量";  
$k8="出组患者数量";  
$k9="入组全部捐赠患者数量"; 
$k10="入组部分捐赠患者数量"; 
/*$k11="北京"; 
$k12="长春"; 
$k13="长沙";  
$k14="成都";  
$k15="大连";  
$k16="福州"; 
$k17="广州";  
$k18="哈尔滨"; 
$k19="杭州"; 
$k20="济南"; 
$k21="兰州";  
$k22="南昌";  
$k23="南京";
$k24="南宁";   
$k25="青岛";  
$k26="上海";  
$k27="沈阳";  
$k28="太原";  
$k29="天津";  
$k30="乌鲁木齐";  
$k31="武汉"; 
$k32="西安";  
$k33="郑州"; 
$k34="重庆"; */
$tjshz[0][9]="北京"; 
$tjshz[1][9]="长春"; 
$tjshz[2][9]="长沙";  
$tjshz[3][9]="成都";  
$tjshz[4][9]="大连";  
$tjshz[5][9]="福州"; 
$tjshz[6][9]="广州";  
$tjshz[7][9]="哈尔滨"; 
$tjshz[8][9]="杭州"; 
$tjshz[9][9]="济南"; 
$tjshz[10][9]="兰州";  
$tjshz[11][9]="南昌";  
$tjshz[12][9]="南京";
$tjshz[13][9]="南宁";   
$tjshz[14][9]="青岛";  
$tjshz[15][9]="上海";  
$tjshz[16][9]="沈阳";  
$tjshz[17][9]="太原";  
$tjshz[18][9]="天津";  
$tjshz[19][9]="乌鲁木齐";  
$tjshz[20][9]="武汉"; 
$tjshz[21][9]="西安";  
$tjshz[22][9]="郑州"; 
$tjshz[23][9]="重庆"; 
$tjshz[24][9]="厦门"; 

//北京
$bjyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='北京市'";
$bjyfidq=mysql_query($bjyfidsql);
while($bjyfidRecord = mysql_fetch_array($bjyfidq)){
$bjyfid[]=$bjyfidRecord[0];
}//获取全部北京药房名称
if($bjyfid!=""){
    $bjsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($bjyfid);$i++){
      $bjsql .= " or `shqyy`='".$bjyfid[$i]."'";
    }
    $bjsql .= " )";
    $bjrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($bjyfid);$i++){
      $bjrzsql .= " or `rzyy`='".$bjyfid[$i]."'";
    }
    $bjrzsql .= " )";
$bjshqq=mysql_query($bjsql);
$bjshq = mysql_num_rows($bjshqq);//获取申请条数
$bjrzq=mysql_query($bjrzsql." and `shqzht`='入组'");
$bjrz = mysql_num_rows($bjrzq);//获取入组条数
$bjshhq=mysql_query($bjsql." and `shqzht`='审核'");
$bjshh = mysql_num_rows($bjshhq);//获取审核条数
$bjdbq=mysql_query($bjsql." and `shqzht`='待办入组'");
$bjdb = mysql_num_rows($bjdbq);//获取待办入组条数
$bjtzhq=mysql_query($bjsql." and `shqzht`='停止申请'");
$bjtzh = mysql_num_rows($bjtzhq);//获取停止申请条数
$bjjjq=mysql_query($bjsql." and `shqzht`='拒绝'");
$bjjj = mysql_num_rows($bjjjq);//获取拒绝条数
$bjchzq=mysql_query($bjrzsql." and `shqzht`='出组'");
$bjchz = mysql_num_rows($bjchzq);//获取出组条数
$bjrzbfq=mysql_query($bjrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$bjrzbf = mysql_num_rows($bjrzbfq);//获取入组部分条数
$bjrzqbq=mysql_query($bjrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$bjrzqb = mysql_num_rows($bjrzqbq);//获取入组全部条数
$tjshz[0][0]=$bjshq;
$tjshz[0][1]=$bjrz;
$tjshz[0][2]=$bjshh;
$tjshz[0][3]=$bjdb;
$tjshz[0][4]=$bjtzh;
$tjshz[0][5]=$bjjj;
$tjshz[0][6]=$bjchz;
$tjshz[0][7]=$bjrzbf;
$tjshz[0][8]=$bjrzqb;
}//获取北京发药条数
 
//长春
$chchyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='长春市'";
$chchyfidq=mysql_query($chchyfidsql);
while($chchyfidRecord = mysql_fetch_array($chchyfidq)){
$chchyfid[]=$chchyfidRecord[0];
}//获取全部长春药房名称
if($chchyfid!=""){
    $chchsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chchyfid);$i++){
      $chchsql .= " or `shqyy`='".$chchyfid[$i]."'";
    }
    $chchsql .= " )";
    $chchrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chchyfid);$i++){
      $chchrzsql .= " or `rzyy`='".$chchyfid[$i]."'";
    }
    $chchrzsql .= " )";
$chchshqq=mysql_query($chchsql);
$chchshq = mysql_num_rows($chchshqq);//获取申请条数

$chchrzq=mysql_query($chchrzsql." and `shqzht`='入组'");
$chchrz = mysql_num_rows($chchrzq);//获取入组条数

$chchshhq=mysql_query($chchsql." and `shqzht`='审核'");
$chchshh = mysql_num_rows($chchshhq);//获取审核条数

$chchdbq=mysql_query($chchsql." and `shqzht`='待办入组'");
$chchdb = mysql_num_rows($chchdbq);//获取待办入组条数

$chchtzhq=mysql_query($chchsql." and `shqzht`='停止申请'");
$chchtzh = mysql_num_rows($chchtzhq);//获取停止申请条数

$chchjjq=mysql_query($chchsql." and `shqzht`='拒绝'");
$chchjj = mysql_num_rows($chchjjq);//获取拒绝条数

$chchchzq=mysql_query($chchrzsql." and `shqzht`='出组'");
$chchchz = mysql_num_rows($chchchzq);//获取出组条数

$chchrzbfq=mysql_query($chchrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$chchrzbf = mysql_num_rows($chchrzbfq);//获取入组部分条数

$chchrzqbq=mysql_query($chchrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$chchrzqb = mysql_num_rows($chchrzqbq);//获取入组全部条数
$tjshz[1][0]=$chchshq;
$tjshz[1][1]=$chchrz;
$tjshz[1][2]=$chchshh;
$tjshz[1][3]=$chchdb;
$tjshz[1][4]=$chchtzh;
$tjshz[1][5]=$chchjj;
$tjshz[1][6]=$chchchz;
$tjshz[1][7]=$chchrzbf;
$tjshz[1][8]=$chchrzqb;
}//获取长春发药条数
   
//长沙
$chshyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='长沙市'";
$chshyfidq=mysql_query($chshyfidsql);
while($chshyfidRecord = mysql_fetch_array($chshyfidq)){
$chshyfid[]=$chshyfidRecord[0];
}//获取全部长沙药房名称
if($chshyfid!=""){
    $chshsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chshyfid);$i++){
      $chshsql .= " or `shqyy`='".$chshyfid[$i]."'";
    }
    $chshsql .= " )";
    $chshrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chshyfid);$i++){
      $chshrzsql .= " or `rzyy`='".$chshyfid[$i]."'";
    }
    $chshrzsql .= " )";
$chshshqq=mysql_query($chshsql);
$chshshq = mysql_num_rows($chshshqq);//获取申请条数

$chshrzq=mysql_query($chshrzsql." and `shqzht`='入组'");
$chshrz = mysql_num_rows($chshrzq);//获取入组条数

$chshshhq=mysql_query($chshsql." and `shqzht`='审核'");
$chshshh = mysql_num_rows($chshshhq);//获取审核条数

$chshdbq=mysql_query($chshsql." and `shqzht`='待办入组'");
$chshdb = mysql_num_rows($chshdbq);//获取待办入组条数

$chshtzhq=mysql_query($chshsql." and `shqzht`='停止申请'");
$chshtzh = mysql_num_rows($chshtzhq);//获取停止申请条数

$chshjjq=mysql_query($chshsql." and `shqzht`='拒绝'");
$chshjj = mysql_num_rows($chshjjq);//获取拒绝条数

$chshchzq=mysql_query($chshrzsql." and `shqzht`='出组'");
$chshchz = mysql_num_rows($chshchzq);//获取出组条数

$chshrzbfq=mysql_query($chshrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$chshrzbf = mysql_num_rows($chshrzbfq);//获取入组部分条数

$chshrzqbq=mysql_query($chshrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$chshrzqb = mysql_num_rows($chshrzqbq);//获取入组全部条数
$tjshz[2][0]=$chshshq;
$tjshz[2][1]=$chshrz;
$tjshz[2][2]=$chshshh;
$tjshz[2][3]=$chshdb;
$tjshz[2][4]=$chshtzh;
$tjshz[2][5]=$chshjj;
$tjshz[2][6]=$chshchz;
$tjshz[2][7]=$chshrzbf;
$tjshz[2][8]=$chshrzqb;
}//获取长沙发药条数
   
//成都
$chdyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='成都市'";
$chdyfidq=mysql_query($chdyfidsql);
while($chdyfidRecord = mysql_fetch_array($chdyfidq)){
$chdyfid[]=$chdyfidRecord[0];
}//获取全部成都药房名称
if($chdyfid!=""){
    $chdsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chdyfid);$i++){
      $chdsql .= " or `shqyy`='".$chdyfid[$i]."'";
    }
    $chdsql .= " )";
    $chdrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chdyfid);$i++){
      $chdrzsql .= " or `rzyy`='".$chdyfid[$i]."'";
    }
    $chdrzsql .= " )";
$chdshqq=mysql_query($chdsql);
$chdshq = mysql_num_rows($chdshqq);//获取申请条数

$chdrzq=mysql_query($chdrzsql." and `shqzht`='入组'");
$chdrz = mysql_num_rows($chdrzq);//获取入组条数

$chdshhq=mysql_query($chdsql." and `shqzht`='审核'");
$chdshh = mysql_num_rows($chdshhq);//获取审核条数

$chddbq=mysql_query($chdsql." and `shqzht`='待办入组'");
$chddb = mysql_num_rows($chddbq);//获取待办入组条数

$chdtzhq=mysql_query($chdsql." and `shqzht`='停止申请'");
$chdtzh = mysql_num_rows($chdtzhq);//获取停止申请条数

$chdjjq=mysql_query($chdsql." and `shqzht`='拒绝'");
$chdjj = mysql_num_rows($chdjjq);//获取拒绝条数

$chdchzq=mysql_query($chdrzsql." and `shqzht`='出组'");
$chdchz = mysql_num_rows($chdchzq);//获取出组条数

$chdrzbfq=mysql_query($chdrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$chdrzbf = mysql_num_rows($chdrzbfq);//获取入组部分条数

$chdrzqbq=mysql_query($chdrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$chdrzqb = mysql_num_rows($chdrzqbq);//获取入组全部条数
$tjshz[3][0]=$chdshq;
$tjshz[3][1]=$chdrz;
$tjshz[3][2]=$chdshh;
$tjshz[3][3]=$chddb;
$tjshz[3][4]=$chdtzh;
$tjshz[3][5]=$chdjj;
$tjshz[3][6]=$chdchz;
$tjshz[3][7]=$chdrzbf;
$tjshz[3][8]=$chdrzqb;
}//获取成都发药条数
   
//大连
$dlyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='大连市'";
$dlyfidq=mysql_query($dlyfidsql);
while($dlyfidRecord = mysql_fetch_array($dlyfidq)){
$dlyfid[]=$dlyfidRecord[0];
}//获取全部大连药房名称
if($dlyfid!=""){
    $dlsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($dlyfid);$i++){
      $dlsql .= " or `shqyy`='".$dlyfid[$i]."'";
    }
    $dlsql .= " )";
    $dlrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($dlyfid);$i++){
      $dlrzsql .= " or `rzyy`='".$dlyfid[$i]."'";
    }
    $dlrzsql .= " )";
$dlshqq=mysql_query($dlsql);
$dlshq = mysql_num_rows($dlshqq);//获取申请条数

$dlrzq=mysql_query($dlrzsql." and `shqzht`='入组'");
$dlrz = mysql_num_rows($dlrzq);//获取入组条数

$dlshhq=mysql_query($dlsql." and `shqzht`='审核'");
$dlshh = mysql_num_rows($dlshhq);//获取审核条数

$dldbq=mysql_query($dlsql." and `shqzht`='待办入组'");
$dldb = mysql_num_rows($dldbq);//获取待办入组条数

$dltzhq=mysql_query($dlsql." and `shqzht`='停止申请'");
$dltzh = mysql_num_rows($dltzhq);//获取停止申请条数

$dljjq=mysql_query($dlsql." and `shqzht`='拒绝'");
$dljj = mysql_num_rows($dljjq);//获取拒绝条数

$dlchzq=mysql_query($dlrzsql." and `shqzht`='出组'");
$dlchz = mysql_num_rows($dlchzq);//获取出组条数

$dlrzbfq=mysql_query($dlrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$dlrzbf = mysql_num_rows($dlrzbfq);//获取入组部分条数

$dlrzqbq=mysql_query($dlrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$dlrzqb = mysql_num_rows($dlrzqbq);//获取入组全部条数
$tjshz[4][0]=$dlshq;
$tjshz[4][1]=$dlrz;
$tjshz[4][2]=$dlshh;
$tjshz[4][3]=$dldb;
$tjshz[4][4]=$dltzh;
$tjshz[4][5]=$dljj;
$tjshz[4][6]=$dlchz;
$tjshz[4][7]=$dlrzbf;
$tjshz[4][8]=$dlrzqb;
}//获取大连发药条数
   
//福州
$fzhyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='福州市'";
$fzhyfidq=mysql_query($fzhyfidsql);
while($fzhyfidRecord = mysql_fetch_array($fzhyfidq)){
$fzhyfid[]=$fzhyfidRecord[0];
}//获取全部福州药房名称
if($fzhyfid!=""){
    $fzhsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($fzhyfid);$i++){
      $fzhsql .= " or `shqyy`='".$fzhyfid[$i]."'";
    }
    $fzhsql .= " )";
    $fzhrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($fzhyfid);$i++){
      $fzhrzsql .= " or `rzyy`='".$fzhyfid[$i]."'";
    }
    $fzhrzsql .= " )";
$fzhshqq=mysql_query($fzhsql);
$fzhshq = mysql_num_rows($fzhshqq);//获取申请条数

$fzhrzq=mysql_query($fzhrzsql." and `shqzht`='入组'");
$fzhrz = mysql_num_rows($fzhrzq);//获取入组条数

$fzhshhq=mysql_query($fzhsql." and `shqzht`='审核'");
$fzhshh = mysql_num_rows($fzhshhq);//获取审核条数

$fzhdbq=mysql_query($fzhsql." and `shqzht`='待办入组'");
$fzhdb = mysql_num_rows($fzhdbq);//获取待办入组条数

$fzhtzhq=mysql_query($fzhsql." and `shqzht`='停止申请'");
$fzhtzh = mysql_num_rows($fzhtzhq);//获取停止申请条数

$fzhjjq=mysql_query($fzhsql." and `shqzht`='拒绝'");
$fzhjj = mysql_num_rows($fzhjjq);//获取拒绝条数

$fzhchzq=mysql_query($fzhrzsql." and `shqzht`='出组'");
$fzhchz = mysql_num_rows($fzhchzq);//获取出组条数

$fzhrzbfq=mysql_query($fzhrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$fzhrzbf = mysql_num_rows($fzhrzbfq);//获取入组部分条数

$fzhrzqbq=mysql_query($fzhrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$fzhrzqb = mysql_num_rows($fzhrzqbq);//获取入组全部条数
$tjshz[5][0]=$fzhshq;
$tjshz[5][1]=$fzhrz;
$tjshz[5][2]=$fzhshh;
$tjshz[5][3]=$fzhdb;
$tjshz[5][4]=$fzhtzh;
$tjshz[5][5]=$fzhjj;
$tjshz[5][6]=$fzhchz;
$tjshz[5][7]=$fzhrzbf;
$tjshz[5][8]=$fzhrzqb;
}//获取福州发药条数
   
//广州
$gzhyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='广州市'";
$gzhyfidq=mysql_query($gzhyfidsql);
while($gzhyfidRecord = mysql_fetch_array($gzhyfidq)){
$gzhyfid[]=$gzhyfidRecord[0];
}//获取全部广州药房名称
if($gzhyfid!=""){
    $gzhsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($gzhyfid);$i++){
      $gzhsql .= " or `shqyy`='".$gzhyfid[$i]."'";
    }
    $gzhsql .= " )";
    $gzhrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($gzhyfid);$i++){
      $gzhrzsql .= " or `rzyy`='".$gzhyfid[$i]."'";
    }
    $gzhrzsql .= " )";
$gzhshqq=mysql_query($gzhsql);
$gzhshq = mysql_num_rows($gzhshqq);//获取申请条数

$gzhrzq=mysql_query($gzhrzsql." and `shqzht`='入组'");
$gzhrz = mysql_num_rows($gzhrzq);//获取入组条数

$gzhshhq=mysql_query($gzhsql." and `shqzht`='审核'");
$gzhshh = mysql_num_rows($gzhshhq);//获取审核条数

$gzhdbq=mysql_query($gzhsql." and `shqzht`='待办入组'");
$gzhdb = mysql_num_rows($gzhdbq);//获取待办入组条数

$gzhtzhq=mysql_query($gzhsql." and `shqzht`='停止申请'");
$gzhtzh = mysql_num_rows($gzhtzhq);//获取停止申请条数

$gzhjjq=mysql_query($gzhsql." and `shqzht`='拒绝'");
$gzhjj = mysql_num_rows($gzhjjq);//获取拒绝条数

$gzhchzq=mysql_query($gzhrzsql." and `shqzht`='出组'");
$gzhchz = mysql_num_rows($gzhchzq);//获取出组条数

$gzhrzbfq=mysql_query($gzhrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$gzhrzbf = mysql_num_rows($gzhrzbfq);//获取入组部分条数

$gzhrzqbq=mysql_query($gzhrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$gzhrzqb = mysql_num_rows($gzhrzqbq);//获取入组全部条数
$tjshz[6][0]=$gzhshq;
$tjshz[6][1]=$gzhrz;
$tjshz[6][2]=$gzhshh;
$tjshz[6][3]=$gzhdb;
$tjshz[6][4]=$gzhtzh;
$tjshz[6][5]=$gzhjj;
$tjshz[6][6]=$gzhchz;
$tjshz[6][7]=$gzhrzbf;
$tjshz[6][8]=$gzhrzqb;
}//获取广州发药条数
   
//哈尔滨
$herbyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='哈尔滨市'";
$herbyfidq=mysql_query($herbyfidsql);
while($herbyfidRecord = mysql_fetch_array($herbyfidq)){
$herbyfid[]=$herbyfidRecord[0];
}//获取全部哈尔滨药房名称
if($herbyfid!=""){
    $herbsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($herbyfid);$i++){
      $herbsql .= " or `shqyy`='".$herbyfid[$i]."'";
    }
    $herbsql .= " )";
    $herbrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($herbyfid);$i++){
      $herbrzsql .= " or `rzyy`='".$herbyfid[$i]."'";
    }
    $herbrzsql .= " )";
$herbshqq=mysql_query($herbsql);
$herbshq = mysql_num_rows($herbshqq);//获取申请条数

$herbrzq=mysql_query($herbrzsql." and `shqzht`='入组'");
$herbrz = mysql_num_rows($herbrzq);//获取入组条数

$herbshhq=mysql_query($herbsql." and `shqzht`='审核'");
$herbshh = mysql_num_rows($herbshhq);//获取审核条数

$herbdbq=mysql_query($herbsql." and `shqzht`='待办入组'");
$herbdb = mysql_num_rows($herbdbq);//获取待办入组条数

$herbtzhq=mysql_query($herbsql." and `shqzht`='停止申请'");
$herbtzh = mysql_num_rows($herbtzhq);//获取停止申请条数

$herbjjq=mysql_query($herbsql." and `shqzht`='拒绝'");
$herbjj = mysql_num_rows($herbjjq);//获取拒绝条数

$herbchzq=mysql_query($herbrzsql." and `shqzht`='出组'");
$herbchz = mysql_num_rows($herbchzq);//获取出组条数

$herbrzbfq=mysql_query($herbrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$herbrzbf = mysql_num_rows($herbrzbfq);//获取入组部分条数

$herbrzqbq=mysql_query($herbrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$herbrzqb = mysql_num_rows($herbrzqbq);//获取入组全部条数
$tjshz[7][0]=$herbshq;
$tjshz[7][1]=$herbrz;
$tjshz[7][2]=$herbshh;
$tjshz[7][3]=$herbdb;
$tjshz[7][4]=$herbtzh;
$tjshz[7][5]=$herbjj;
$tjshz[7][6]=$herbchz;
$tjshz[7][7]=$herbrzbf;
$tjshz[7][8]=$herbrzqb;
}//获取哈尔滨发药条数
   
//杭州
$hzhyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='杭州市'";
$hzhyfidq=mysql_query($hzhyfidsql);
while($hzhyfidRecord = mysql_fetch_array($hzhyfidq)){
$hzhyfid[]=$hzhyfidRecord[0];
}//获取全部杭州药房名称
if($hzhyfid!=""){
    $hzhsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($hzhyfid);$i++){
      $hzhsql .= " or `shqyy`='".$hzhyfid[$i]."'";
    }
    $hzhsql .= " )";
    $hzhrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($hzhyfid);$i++){
      $hzhrzsql .= " or `rzyy`='".$hzhyfid[$i]."'";
    }
    $hzhrzsql .= " )";
$hzhshqq=mysql_query($hzhsql);
$hzhshq = mysql_num_rows($hzhshqq);//获取申请条数

$hzhrzq=mysql_query($hzhrzsql." and `shqzht`='入组'");
$hzhrz = mysql_num_rows($hzhrzq);//获取入组条数

$hzhshhq=mysql_query($hzhsql." and `shqzht`='审核'");
$hzhshh = mysql_num_rows($hzhshhq);//获取审核条数

$hzhdbq=mysql_query($hzhsql." and `shqzht`='待办入组'");
$hzhdb = mysql_num_rows($hzhdbq);//获取待办入组条数

$hzhtzhq=mysql_query($hzhsql." and `shqzht`='停止申请'");
$hzhtzh = mysql_num_rows($hzhtzhq);//获取停止申请条数

$hzhjjq=mysql_query($hzhsql." and `shqzht`='拒绝'");
$hzhjj = mysql_num_rows($hzhjjq);//获取拒绝条数

$hzhchzq=mysql_query($hzhrzsql." and `shqzht`='出组'");
$hzhchz = mysql_num_rows($hzhchzq);//获取出组条数

$hzhrzbfq=mysql_query($hzhrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$hzhrzbf = mysql_num_rows($hzhrzbfq);//获取入组部分条数

$hzhrzqbq=mysql_query($hzhrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$hzhrzqb = mysql_num_rows($hzhrzqbq);//获取入组全部条数
$tjshz[8][0]=$chshshq;
$tjshz[8][1]=$chshrz;
$tjshz[8][2]=$chshshh;
$tjshz[8][3]=$chshdb;
$tjshz[8][4]=$chshtzh;
$tjshz[8][5]=$chshjj;
$tjshz[8][6]=$chshchz;
$tjshz[8][7]=$chshrzbf;
$tjshz[8][8]=$chshrzqb;
}//获取杭州发药条数
    
//济南
$jnyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='济南市'";
$jnyfidq=mysql_query($jnyfidsql);
while($jnyfidRecord = mysql_fetch_array($jnyfidq)){
$jnyfid[]=$jnyfidRecord[0];
}//获取全部济南药房名称
if($jnyfid!=""){
    $jnsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($jnyfid);$i++){
      $jnsql .= " or `shqyy`='".$jnyfid[$i]."'";
    }
    $jnsql .= " )";
    $jnrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($jnyfid);$i++){
      $jnrzsql .= " or `rzyy`='".$jnyfid[$i]."'";
    }
    $jnrzsql .= " )";
$jnshqq=mysql_query($jnsql);
$jnshq = mysql_num_rows($jnshqq);//获取申请条数

$jnrzq=mysql_query($jnrzsql." and `shqzht`='入组'");
$jnrz = mysql_num_rows($jnrzq);//获取入组条数

$jnshhq=mysql_query($jnsql." and `shqzht`='审核'");
$jnshh = mysql_num_rows($jnshhq);//获取审核条数

$jndbq=mysql_query($jnsql." and `shqzht`='待办入组'");
$jndb = mysql_num_rows($jndbq);//获取待办入组条数

$jntzhq=mysql_query($jnsql." and `shqzht`='停止申请'");
$jntzh = mysql_num_rows($jntzhq);//获取停止申请条数

$jnjjq=mysql_query($jnsql." and `shqzht`='拒绝'");
$jnjj = mysql_num_rows($jnjjq);//获取拒绝条数

$jnchzq=mysql_query($jnrzsql." and `shqzht`='出组'");
$jnchz = mysql_num_rows($jnchzq);//获取出组条数

$jnrzbfq=mysql_query($jnrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$jnrzbf = mysql_num_rows($jnrzbfq);//获取入组部分条数

$jnrzqbq=mysql_query($jnrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$jnrzqb = mysql_num_rows($jnrzqbq);//获取入组全部条数
$tjshz[9][0]=$jnshq;
$tjshz[9][1]=$jnrz;
$tjshz[9][2]=$jnshh;
$tjshz[9][3]=$jndb;
$tjshz[9][4]=$jntzh;
$tjshz[9][5]=$jnjj;
$tjshz[9][6]=$jnchz;
$tjshz[9][7]=$jnrzbf;
$tjshz[9][8]=$jnrzqb;
}//获取济南发药条数
    
//兰州
$lzhyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='兰州市'";
$lzhyfidq=mysql_query($lzhyfidsql);
while($lzhyfidRecord = mysql_fetch_array($lzhyfidq)){
$lzhyfid[]=$lzhyfidRecord[0];
}//获取全部兰州药房名称
if($lzhyfid!=""){
    $lzhsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($lzhyfid);$i++){
      $lzhsql .= " or `shqyy`='".$lzhyfid[$i]."'";
    }
    $lzhsql .= " )";
    $lzhrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($lzhyfid);$i++){
      $lzhrzsql .= " or `rzyy`='".$lzhyfid[$i]."'";
    }
    $lzhrzsql .= " )";
$lzhshqq=mysql_query($lzhsql);
$lzhshq = mysql_num_rows($lzhshqq);//获取申请条数

$lzhrzq=mysql_query($lzhrzsql." and `shqzht`='入组'");
$lzhrz = mysql_num_rows($lzhrzq);//获取入组条数

$lzhshhq=mysql_query($lzhsql." and `shqzht`='审核'");
$lzhshh = mysql_num_rows($lzhshhq);//获取审核条数

$lzhdbq=mysql_query($lzhsql." and `shqzht`='待办入组'");
$lzhdb = mysql_num_rows($lzhdbq);//获取待办入组条数

$lzhtzhq=mysql_query($lzhsql." and `shqzht`='停止申请'");
$lzhtzh = mysql_num_rows($lzhtzhq);//获取停止申请条数

$lzhjjq=mysql_query($lzhsql." and `shqzht`='拒绝'");
$lzhjj = mysql_num_rows($lzhjjq);//获取拒绝条数

$lzhchzq=mysql_query($lzhrzsql." and `shqzht`='出组'");
$lzhchz = mysql_num_rows($lzhchzq);//获取出组条数

$lzhrzbfq=mysql_query($lzhrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$lzhrzbf = mysql_num_rows($lzhrzbfq);//获取入组部分条数

$lzhrzqbq=mysql_query($lzhrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$lzhrzqb = mysql_num_rows($lzhrzqbq);//获取入组全部条数
$tjshz[10][0]=$lzhshq;
$tjshz[10][1]=$lzhrz;
$tjshz[10][2]=$lzhshh;
$tjshz[10][3]=$lzhdb;
$tjshz[10][4]=$lzhtzh;
$tjshz[10][5]=$lzhjj;
$tjshz[10][6]=$lzhchz;
$tjshz[10][7]=$lzhrzbf;
$tjshz[10][8]=$lzhrzqb;
}//获取兰州发药条数
    
//南昌
$nchyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='南昌市'";
$nchyfidq=mysql_query($nchyfidsql);
while($nchyfidRecord = mysql_fetch_array($nchyfidq)){
$nchyfid[]=$nchyfidRecord[0];
}//获取全部南昌药房名称
if($nchyfid!=""){
    $nchsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($nchyfid);$i++){
      $nchsql .= " or `shqyy`='".$nchyfid[$i]."'";
    }
    $nchsql .= " )";
    $nchrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($nchyfid);$i++){
      $nchrzsql .= " or `rzyy`='".$nchyfid[$i]."'";
    }
    $nchrzsql .= " )";
$nchshqq=mysql_query($nchsql);
$nchshq = mysql_num_rows($nchshqq);//获取申请条数

$nchrzq=mysql_query($nchrzsql." and `shqzht`='入组'");
$nchrz = mysql_num_rows($nchrzq);//获取入组条数

$nchshhq=mysql_query($nchsql." and `shqzht`='审核'");
$nchshh = mysql_num_rows($nchshhq);//获取审核条数

$nchdbq=mysql_query($nchsql." and `shqzht`='待办入组'");
$nchdb = mysql_num_rows($nchdbq);//获取待办入组条数

$nchtzhq=mysql_query($nchsql." and `shqzht`='停止申请'");
$nchtzh = mysql_num_rows($nchtzhq);//获取停止申请条数

$nchjjq=mysql_query($nchsql." and `shqzht`='拒绝'");
$nchjj = mysql_num_rows($nchjjq);//获取拒绝条数

$nchchzq=mysql_query($nchrzsql." and `shqzht`='出组'");
$nchchz = mysql_num_rows($nchchzq);//获取出组条数

$nchrzbfq=mysql_query($nchrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$nchrzbf = mysql_num_rows($nchrzbfq);//获取入组部分条数

$nchrzqbq=mysql_query($nchrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$nchrzqb = mysql_num_rows($nchrzqbq);//获取入组全部条数
$tjshz[11][0]=$nchshq;
$tjshz[11][1]=$nchrz;
$tjshz[11][2]=$nchshh;
$tjshz[11][3]=$nchdb;
$tjshz[11][4]=$nchtzh;
$tjshz[11][5]=$nchjj;
$tjshz[11][6]=$nchchz;
$tjshz[11][7]=$nchrzbf;
$tjshz[11][8]=$nchrzqb;
}//获取南昌发药条数
    
//南京
$njyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='南京市'";
$njyfidq=mysql_query($njyfidsql);
while($njyfidRecord = mysql_fetch_array($njyfidq)){
$njyfid[]=$njyfidRecord[0];
}//获取全部南京药房名称
if($njyfid!=""){
    $njsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($njyfid);$i++){
      $njsql .= " or `shqyy`='".$njyfid[$i]."'";
    }
    $njsql .= " )";
    $njrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($njyfid);$i++){
      $njrzsql .= " or `rzyy`='".$njyfid[$i]."'";
    }
    $njrzsql .= " )";
$njshqq=mysql_query($njsql);
$njshq = mysql_num_rows($njshqq);//获取申请条数

$njrzq=mysql_query($njrzsql." and `shqzht`='入组'");
$njrz = mysql_num_rows($njrzq);//获取入组条数

$njshhq=mysql_query($njsql." and `shqzht`='审核'");
$njshh = mysql_num_rows($njshhq);//获取审核条数

$njdbq=mysql_query($njsql." and `shqzht`='待办入组'");
$njdb = mysql_num_rows($njdbq);//获取待办入组条数

$njtzhq=mysql_query($njsql." and `shqzht`='停止申请'");
$njtzh = mysql_num_rows($njtzhq);//获取停止申请条数

$njjjq=mysql_query($njsql." and `shqzht`='拒绝'");
$njjj = mysql_num_rows($njjjq);//获取拒绝条数

$njchzq=mysql_query($njrzsql." and `shqzht`='出组'");
$njchz = mysql_num_rows($njchzq);//获取出组条数

$njrzbfq=mysql_query($njrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$njrzbf = mysql_num_rows($njrzbfq);//获取入组部分条数

$njrzqbq=mysql_query($njrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$njrzqb = mysql_num_rows($njrzqbq);//获取入组全部条数
$tjshz[12][0]=$njshq;
$tjshz[12][1]=$njrz;
$tjshz[12][2]=$njshh;
$tjshz[12][3]=$njdb;
$tjshz[12][4]=$njtzh;
$tjshz[12][5]=$njjj;
$tjshz[12][6]=$njchz;
$tjshz[12][7]=$njrzbf;
$tjshz[12][8]=$njrzqb;
}//获取南京发药条数
      
//南宁
$nnyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='南宁市'";
$nnyfidq=mysql_query($nnyfidsql);
while($nnyfidRecord = mysql_fetch_array($nnyfidq)){
$nnyfid[]=$nnyfidRecord[0];
}//获取全部南宁药房名称
if($nnyfid!=""){
    $nnsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($nnyfid);$i++){
      $nnsql .= " or `shqyy`='".$nnyfid[$i]."'";
    }
    $nnsql .= " )";
    $nnrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($nnyfid);$i++){
      $nnrzsql .= " or `rzyy`='".$nnyfid[$i]."'";
    }
    $nnrzsql .= " )";
$nnshqq=mysql_query($nnsql);
$nnshq = mysql_num_rows($nnshqq);//获取申请条数

$nnrzq=mysql_query($nnrzsql." and `shqzht`='入组'");
$nnrz = mysql_num_rows($nnrzq);//获取入组条数

$nnshhq=mysql_query($nnsql." and `shqzht`='审核'");
$nnshh = mysql_num_rows($nnshhq);//获取审核条数

$nndbq=mysql_query($nnsql." and `shqzht`='待办入组'");
$nndb = mysql_num_rows($nndbq);//获取待办入组条数

$nntzhq=mysql_query($nnsql." and `shqzht`='停止申请'");
$nntzh = mysql_num_rows($nntzhq);//获取停止申请条数

$nnjjq=mysql_query($nnsql." and `shqzht`='拒绝'");
$nnjj = mysql_num_rows($nnjjq);//获取拒绝条数

$nnchzq=mysql_query($nnrzsql." and `shqzht`='出组'");
$nnchz = mysql_num_rows($nnchzq);//获取出组条数

$nnrzbfq=mysql_query($nnrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$nnrzbf = mysql_num_rows($nnrzbfq);//获取入组部分条数

$nnrzqbq=mysql_query($nnrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$nnrzqb = mysql_num_rows($nnrzqbq);//获取入组全部条数
$tjshz[13][0]=$nnshq;
$tjshz[13][1]=$nnrz;
$tjshz[13][2]=$nnshh;
$tjshz[13][3]=$nndb;
$tjshz[13][4]=$nntzh;
$tjshz[13][5]=$nnjj;
$tjshz[13][6]=$nnchz;
$tjshz[13][7]=$nnrzbf;
$tjshz[13][8]=$nnrzqb;
}//获取南宁发药条数
      
//青岛
$qdyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='青岛市'";
$qdyfidq=mysql_query($qdyfidsql);
while($qdyfidRecord = mysql_fetch_array($qdyfidq)){
$qdyfid[]=$qdyfidRecord[0];
}//获取全部青岛药房名称
if($qdyfid!=""){
    $qdsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($qdyfid);$i++){
      $qdsql .= " or `shqyy`='".$qdyfid[$i]."'";
    }
    $qdsql .= " )";
    $qdrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($qdyfid);$i++){
      $qdrzsql .= " or `rzyy`='".$qdyfid[$i]."'";
    }
    $qdrzsql .= " )";
$qdshqq=mysql_query($qdsql);
$qdshq = mysql_num_rows($qdshqq);//获取申请条数

$qdrzq=mysql_query($qdrzsql." and `shqzht`='入组'");
$qdrz = mysql_num_rows($qdrzq);//获取入组条数

$qdshhq=mysql_query($qdsql." and `shqzht`='审核'");
$qdshh = mysql_num_rows($qdshhq);//获取审核条数

$qddbq=mysql_query($qdsql." and `shqzht`='待办入组'");
$qddb = mysql_num_rows($qddbq);//获取待办入组条数

$qdtzhq=mysql_query($qdsql." and `shqzht`='停止申请'");
$qdtzh = mysql_num_rows($qdtzhq);//获取停止申请条数

$qdjjq=mysql_query($qdsql." and `shqzht`='拒绝'");
$qdjj = mysql_num_rows($qdjjq);//获取拒绝条数

$qdchzq=mysql_query($qdrzsql." and `shqzht`='出组'");
$qdchz = mysql_num_rows($qdchzq);//获取出组条数

$qdrzbfq=mysql_query($qdrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$qdrzbf = mysql_num_rows($qdrzbfq);//获取入组部分条数

$qdrzqbq=mysql_query($qdrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$qdrzqb = mysql_num_rows($qdrzqbq);//获取入组全部条数
$tjshz[14][0]=$qdshq;
$tjshz[14][1]=$qdrz;
$tjshz[14][2]=$qdshh;
$tjshz[14][3]=$qddb;
$tjshz[14][4]=$qdtzh;
$tjshz[14][5]=$qdjj;
$tjshz[14][6]=$qdchz;
$tjshz[14][7]=$qdrzbf;
$tjshz[14][8]=$qdrzqb;
}//获取青岛发药条数
      
//上海
$shhyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='上海市'";
$shhyfidq=mysql_query($shhyfidsql);
while($shhyfidRecord = mysql_fetch_array($shhyfidq)){
$shhyfid[]=$shhyfidRecord[0];
}//获取全部上海药房名称
if($shhyfid!=""){
    $shhsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($shhyfid);$i++){
      $shhsql .= " or `shqyy`='".$shhyfid[$i]."'";
    }
    $shhsql .= " )";
    $shhrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($shhyfid);$i++){
      $shhrzsql .= " or `rzyy`='".$shhyfid[$i]."'";
    }
    $shhrzsql .= " )";
$shhshqq=mysql_query($shhsql);
$shhshq = mysql_num_rows($shhshqq);//获取申请条数

$shhrzq=mysql_query($shhrzsql." and `shqzht`='入组'");
$shhrz = mysql_num_rows($shhrzq);//获取入组条数

$shhshhq=mysql_query($shhsql." and `shqzht`='审核'");
$shhshh = mysql_num_rows($shhshhq);//获取审核条数

$shhdbq=mysql_query($shhsql." and `shqzht`='待办入组'");
$shhdb = mysql_num_rows($shhdbq);//获取待办入组条数

$shhtzhq=mysql_query($shhsql." and `shqzht`='停止申请'");
$shhtzh = mysql_num_rows($shhtzhq);//获取停止申请条数

$shhjjq=mysql_query($shhsql." and `shqzht`='拒绝'");
$shhjj = mysql_num_rows($shhjjq);//获取拒绝条数

$shhchzq=mysql_query($shhrzsql." and `shqzht`='出组'");
$shhchz = mysql_num_rows($shhchzq);//获取出组条数

$shhrzbfq=mysql_query($shhrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$shhrzbf = mysql_num_rows($shhrzbfq);//获取入组部分条数

$shhrzqbq=mysql_query($shhrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$shhrzqb = mysql_num_rows($shhrzqbq);//获取入组全部条数
$tjshz[15][0]=$shhshq;
$tjshz[15][1]=$shhrz;
$tjshz[15][2]=$shhshh;
$tjshz[15][3]=$shhdb;
$tjshz[15][4]=$shhtzh;
$tjshz[15][5]=$shhjj;
$tjshz[15][6]=$shhchz;
$tjshz[15][7]=$shhrzbf;
$tjshz[15][8]=$shhrzqb;
}//获取上海发药条数
      
//沈阳
$shyyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='沈阳市'";
$shyyfidq=mysql_query($shyyfidsql);
while($shyyfidRecord = mysql_fetch_array($shyyfidq)){
$shyyfid[]=$shyyfidRecord[0];
}//获取全部沈阳药房名称
if($shyyfid!=""){
    $shysql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($shyyfid);$i++){
      $shysql .= " or `shqyy`='".$shyyfid[$i]."'";
    }
    $shysql .= " )";
    $shyrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($shyyfid);$i++){
      $shyrzsql .= " or `rzyy`='".$shyyfid[$i]."'";
    }
    $shyrzsql .= " )";
$shyshqq=mysql_query($shysql);
$shyshq = mysql_num_rows($shyshqq);//获取申请条数

$shyrzq=mysql_query($shyrzsql." and `shqzht`='入组'");
$shyrz = mysql_num_rows($shyrzq);//获取入组条数

$shyshhq=mysql_query($shysql." and `shqzht`='审核'");
$shyshh = mysql_num_rows($shyshhq);//获取审核条数

$shydbq=mysql_query($shysql." and `shqzht`='待办入组'");
$shydb = mysql_num_rows($shydbq);//获取待办入组条数

$shytzhq=mysql_query($shysql." and `shqzht`='停止申请'");
$shytzh = mysql_num_rows($shytzhq);//获取停止申请条数

$shyjjq=mysql_query($shysql." and `shqzht`='拒绝'");
$shyjj = mysql_num_rows($shyjjq);//获取拒绝条数

$shychzq=mysql_query($shyrzsql." and `shqzht`='出组'");
$shychz = mysql_num_rows($shychzq);//获取出组条数

$shyrzbfq=mysql_query($shyrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$shyrzbf = mysql_num_rows($shyrzbfq);//获取入组部分条数

$shyrzqbq=mysql_query($shyrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$shyrzqb = mysql_num_rows($shyrzqbq);//获取入组全部条数
$tjshz[16][0]=$shyshq;
$tjshz[16][1]=$shyrz;
$tjshz[16][2]=$shyshh;
$tjshz[16][3]=$shydb;
$tjshz[16][4]=$shytzh;
$tjshz[16][5]=$shyjj;
$tjshz[16][6]=$shychz;
$tjshz[16][7]=$shyrzbf;
$tjshz[16][8]=$shyrzqb;
}//获取沈阳发药条数
          
//太原
$tyyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='太原市'";
$tyyfidq=mysql_query($tyyfidsql);
while($tyyfidRecord = mysql_fetch_array($tyyfidq)){
$tyyfid[]=$tyyfidRecord[0];
}//获取全部太原药房名称
if($tyyfid!=""){
    $tysql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($tyyfid);$i++){
      $tysql .= " or `shqyy`='".$tyyfid[$i]."'";
    }
    $tysql .= " )";
    $tyrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($tyyfid);$i++){
      $tyrzsql .= " or `shqyy`='".$tyyfid[$i]."'";
    }
    $tyrzsql .= " )";
$tyshqq=mysql_query($tysql);
$tyshq = mysql_num_rows($tyshqq);//获取申请条数

$tyrzq=mysql_query($tyrzsql." and `shqzht`='入组'");
$tyrz = mysql_num_rows($tyrzq);//获取入组条数

$tyshhq=mysql_query($tysql." and `shqzht`='审核'");
$tyshh = mysql_num_rows($tyshhq);//获取审核条数

$tydbq=mysql_query($tysql." and `shqzht`='待办入组'");
$tydb = mysql_num_rows($tydbq);//获取待办入组条数

$tytzhq=mysql_query($tysql." and `shqzht`='停止申请'");
$tytzh = mysql_num_rows($tytzhq);//获取停止申请条数

$tyjjq=mysql_query($tysql." and `shqzht`='拒绝'");
$tyjj = mysql_num_rows($tyjjq);//获取拒绝条数

$tychzq=mysql_query($tyrzsql." and `shqzht`='出组'");
$tychz = mysql_num_rows($tychzq);//获取出组条数

$tyrzbfq=mysql_query($tyrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$tyrzbf = mysql_num_rows($tyrzbfq);//获取入组部分条数

$tyrzqbq=mysql_query($tyrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$tyrzqb = mysql_num_rows($tyrzqbq);//获取入组全部条数
$tjshz[17][0]=$tyshq;
$tjshz[17][1]=$tyrz;
$tjshz[17][2]=$tyshh;
$tjshz[17][3]=$tydb;
$tjshz[17][4]=$tytzh;
$tjshz[17][5]=$tyjj;
$tjshz[17][6]=$tychz;
$tjshz[17][7]=$tyrzbf;
$tjshz[17][8]=$tyrzqb;
}//获取太原发药条数
              
//天津
$tjyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='天津市'";
$tjyfidq=mysql_query($tjyfidsql);
while($tjyfidRecord = mysql_fetch_array($tjyfidq)){
$tjyfid[]=$tjyfidRecord[0];
}//获取全部天津药房名称
if($tjyfid!=""){
    $tjsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($tjyfid);$i++){
      $tjsql .= " or `shqyy`='".$tjyfid[$i]."'";
    }
    $tjsql .= " )";
    $tjrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($tjyfid);$i++){
      $tjrzsql .= " or `rzyy`='".$tjyfid[$i]."'";
    }
    $tjrzsql .= " )";
$tjshqq=mysql_query($tjsql);
$tjshq = mysql_num_rows($tjshqq);//获取申请条数

$tjrzq=mysql_query($tjrzsql." and `shqzht`='入组'");
$tjrz = mysql_num_rows($tjrzq);//获取入组条数

$tjshhq=mysql_query($tjsql." and `shqzht`='审核'");
$tjshh = mysql_num_rows($tjshhq);//获取审核条数

$tjdbq=mysql_query($tjsql." and `shqzht`='待办入组'");
$tjdb = mysql_num_rows($tjdbq);//获取待办入组条数

$tjtzhq=mysql_query($tjsql." and `shqzht`='停止申请'");
$tjtzh = mysql_num_rows($tjtzhq);//获取停止申请条数

$tjjjq=mysql_query($tjsql." and `shqzht`='拒绝'");
$tjjj = mysql_num_rows($tjjjq);//获取拒绝条数

$tjchzq=mysql_query($tjrzsql." and `shqzht`='出组'");
$tjchz = mysql_num_rows($tjchzq);//获取出组条数

$tjrzbfq=mysql_query($tjrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$tjrzbf = mysql_num_rows($tjrzbfq);//获取入组部分条数

$tjrzqbq=mysql_query($tjrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$tjrzqb = mysql_num_rows($tjrzqbq);//获取入组全部条数
$tjshz[18][0]=$tjshq;
$tjshz[18][1]=$tjrz;
$tjshz[18][2]=$tjshh;
$tjshz[18][3]=$tjdb;
$tjshz[18][4]=$tjtzh;
$tjshz[18][5]=$tjjj;
$tjshz[18][6]=$tjchz;
$tjshz[18][7]=$tjrzbf;
$tjshz[18][8]=$tjrzqb;
}//获取天津发药条数
           
//乌鲁木齐
$wlmqyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='乌鲁木齐市'";
$wlmqyfidq=mysql_query($wlmqyfidsql);
while($wlmqyfidRecord = mysql_fetch_array($wlmqyfidq)){
$wlmqyfid[]=$wlmqyfidRecord[0];
}//获取全部乌鲁木齐药房名称
if($wlmqyfid!=""){
    $wlmqsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($wlmqyfid);$i++){
      $wlmqsql .= " or `shqyy`='".$wlmqyfid[$i]."'";
    }
    $wlmqsql .= " )";
    $wlmqrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($wlmqyfid);$i++){
      $wlmqrzsql .= " or `rzyy`='".$wlmqyfid[$i]."'";
    }
    $wlmqrzsql .= " )";
$wlmqshqq=mysql_query($wlmqsql);
$wlmqshq = mysql_num_rows($wlmqshqq);//获取申请条数

$wlmqrzq=mysql_query($wlmqrzsql." and `shqzht`='入组'");
$wlmqrz = mysql_num_rows($wlmqrzq);//获取入组条数

$wlmqshhq=mysql_query($wlmqsql." and `shqzht`='审核'");
$wlmqshh = mysql_num_rows($wlmqshhq);//获取审核条数

$wlmqdbq=mysql_query($wlmqsql." and `shqzht`='待办入组'");
$wlmqdb = mysql_num_rows($wlmqdbq);//获取待办入组条数

$wlmqtzhq=mysql_query($wlmqsql." and `shqzht`='停止申请'");
$wlmqtzh = mysql_num_rows($wlmqtzhq);//获取停止申请条数

$wlmqjjq=mysql_query($wlmqsql." and `shqzht`='拒绝'");
$wlmqjj = mysql_num_rows($wlmqjjq);//获取拒绝条数

$wlmqchzq=mysql_query($wlmqrzsql." and `shqzht`='出组'");
$wlmqchz = mysql_num_rows($wlmqchzq);//获取出组条数

$wlmqrzbfq=mysql_query($wlmqrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$wlmqrzbf = mysql_num_rows($wlmqrzbfq);//获取入组部分条数

$wlmqrzqbq=mysql_query($wlmqrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$wlmqrzqb = mysql_num_rows($wlmqrzqbq);//获取入组全部条数
$tjshz[19][0]=$wlmqshq;
$tjshz[19][1]=$wlmqrz;
$tjshz[19][2]=$wlmqshh;
$tjshz[19][3]=$wlmqdb;
$tjshz[19][4]=$wlmqtzh;
$tjshz[19][5]=$wlmqjj;
$tjshz[19][6]=$wlmqchz;
$tjshz[19][7]=$wlmqrzbf;
$tjshz[19][8]=$wlmqrzqb;
}//获取乌鲁木齐发药条数
           
//武汉
$whyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='武汉市'";
$whyfidq=mysql_query($whyfidsql);
while($whyfidRecord = mysql_fetch_array($whyfidq)){
$whyfid[]=$whyfidRecord[0];
}//获取全部武汉药房名称
if($whyfid!=""){
    $whsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($whyfid);$i++){
      $whsql .= " or `shqyy`='".$whyfid[$i]."'";
    }
    $whsql .= " )";
    $whrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($whyfid);$i++){
      $whrzsql .= " or `rzyy`='".$whyfid[$i]."'";
    }
    $whrzsql .= " )";
$whshqq=mysql_query($whsql);
$whshq = mysql_num_rows($whshqq);//获取申请条数

$whrzq=mysql_query($whrzsql." and `shqzht`='入组'");
$whrz = mysql_num_rows($whrzq);//获取入组条数

$whshhq=mysql_query($whsql." and `shqzht`='审核'");
$whshh = mysql_num_rows($whshhq);//获取审核条数

$whdbq=mysql_query($whsql." and `shqzht`='待办入组'");
$whdb = mysql_num_rows($whdbq);//获取待办入组条数

$whtzhq=mysql_query($whsql." and `shqzht`='停止申请'");
$whtzh = mysql_num_rows($whtzhq);//获取停止申请条数

$whjjq=mysql_query($whsql." and `shqzht`='拒绝'");
$whjj = mysql_num_rows($whjjq);//获取拒绝条数

$whchzq=mysql_query($whrzsql." and `shqzht`='出组'");
$whchz = mysql_num_rows($whchzq);//获取出组条数

$whrzbfq=mysql_query($whrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$whrzbf = mysql_num_rows($whrzbfq);//获取入组部分条数

$whrzqbq=mysql_query($whrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$whrzqb = mysql_num_rows($whrzqbq);//获取入组全部条数
$tjshz[20][0]=$whshq;
$tjshz[20][1]=$whrz;
$tjshz[20][2]=$whshh;
$tjshz[20][3]=$whdb;
$tjshz[20][4]=$whtzh;
$tjshz[20][5]=$whjj;
$tjshz[20][6]=$whchz;
$tjshz[20][7]=$whrzbf;
$tjshz[20][8]=$whrzqb;
}//获取武汉发药条数
         
//西安
$xanyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='西安市'";
$xanyfidq=mysql_query($xanyfidsql);
while($xanyfidRecord = mysql_fetch_array($xanyfidq)){
$xanyfid[]=$xanyfidRecord[0];
}//获取全部西安药房名称
if($xanyfid!=""){
    $xansql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($xanyfid);$i++){
      $xansql .= " or `shqyy`='".$xanyfid[$i]."'";
    }
    $xansql .= " )";
    $xanrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($xanyfid);$i++){
      $xanrzsql .= " or `rzyy`='".$xanyfid[$i]."'";
    }
    $xanrzsql .= " )";
$xanshqq=mysql_query($xansql);
$xanshq = mysql_num_rows($xanshqq);//获取申请条数

$xanrzq=mysql_query($xanrzsql." and `shqzht`='入组'");
$xanrz = mysql_num_rows($xanrzq);//获取入组条数

$xanshhq=mysql_query($xansql." and `shqzht`='审核'");
$xanshh = mysql_num_rows($xanshhq);//获取审核条数

$xandbq=mysql_query($xansql." and `shqzht`='待办入组'");
$xandb = mysql_num_rows($xandbq);//获取待办入组条数

$xantzhq=mysql_query($xansql." and `shqzht`='停止申请'");
$xantzh = mysql_num_rows($xantzhq);//获取停止申请条数

$xanjjq=mysql_query($xansql." and `shqzht`='拒绝'");
$xanjj = mysql_num_rows($xanjjq);//获取拒绝条数

$xanchzq=mysql_query($xanrzsql." and `shqzht`='出组'");
$xanchz = mysql_num_rows($xanchzq);//获取出组条数

$xanrzbfq=mysql_query($xanrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$xanrzbf = mysql_num_rows($xanrzbfq);//获取入组部分条数

$xanrzqbq=mysql_query($xanrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$xanrzqb = mysql_num_rows($xanrzqbq);//获取入组全部条数
$tjshz[21][0]=$xanshq;
$tjshz[21][1]=$xanrz;
$tjshz[21][2]=$xanshh;
$tjshz[21][3]=$xandb;
$tjshz[21][4]=$xantzh;
$tjshz[21][5]=$xanjj;
$tjshz[21][6]=$xanchz;
$tjshz[21][7]=$xanrzbf;
$tjshz[21][8]=$xanrzqb;
}//获取西安发药条数
              
//郑州
$zhzhyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='郑州市'";
$zhzhyfidq=mysql_query($zhzhyfidsql);
while($zhzhyfidRecord = mysql_fetch_array($zhzhyfidq)){
$zhzhyfid[]=$zhzhyfidRecord[0];
}//获取全部郑州药房名称
if($zhzhyfid!=""){
    $zhzhsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($zhzhyfid);$i++){
      $zhzhsql .= " or `shqyy`='".$zhzhyfid[$i]."'";
    }
    $zhzhsql .= " )";
    $zhzhrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($zhzhyfid);$i++){
      $zhzhrzsql .= " or `rzyy`='".$zhzhyfid[$i]."'";
    }
    $zhzhrzsql .= " )";
$zhzhshqq=mysql_query($zhzhsql);
$zhzhshq = mysql_num_rows($zhzhshqq);//获取申请条数

$zhzhrzq=mysql_query($zhzhrzsql." and `shqzht`='入组'");
$zhzhrz = mysql_num_rows($zhzhrzq);//获取入组条数

$zhzhshhq=mysql_query($zhzhsql." and `shqzht`='审核'");
$zhzhshh = mysql_num_rows($zhzhshhq);//获取审核条数

$zhzhdbq=mysql_query($zhzhsql." and `shqzht`='待办入组'");
$zhzhdb = mysql_num_rows($zhzhdbq);//获取待办入组条数

$zhzhtzhq=mysql_query($zhzhsql." and `shqzht`='停止申请'");
$zhzhtzh = mysql_num_rows($zhzhtzhq);//获取停止申请条数

$zhzhjjq=mysql_query($zhzhsql." and `shqzht`='拒绝'");
$zhzhjj = mysql_num_rows($zhzhjjq);//获取拒绝条数

$zhzhchzq=mysql_query($zhzhrzsql." and `shqzht`='出组'");
$zhzhchz = mysql_num_rows($zhzhchzq);//获取出组条数

$zhzhrzbfq=mysql_query($zhzhrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$zhzhrzbf = mysql_num_rows($zhzhrzbfq);//获取入组部分条数

$zhzhrzqbq=mysql_query($zhzhrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$zhzhrzqb = mysql_num_rows($zhzhrzqbq);//获取入组全部条数
$tjshz[22][0]=$zhzhshq;
$tjshz[22][1]=$zhzhrz;
$tjshz[22][2]=$zhzhshh;
$tjshz[22][3]=$zhzhdb;
$tjshz[22][4]=$zhzhtzh;
$tjshz[22][5]=$zhzhjj;
$tjshz[22][6]=$zhzhchz;
$tjshz[22][7]=$zhzhrzbf;
$tjshz[22][8]=$zhzhrzqb;
}//获取郑州发药条数
                      
//重庆
$chqyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='重庆市'";
$chqyfidq=mysql_query($chqyfidsql);
while($chqyfidRecord = mysql_fetch_array($chqyfidq)){
$chqyfid[]=$chqyfidRecord[0];
}//获取全部重庆药房名称
if($chqyfid!=""){
    $chqsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chqyfid);$i++){
      $chqsql .= " or `shqyy`='".$chqyfid[$i]."'";
    }
    $chqsql .= " )";
    $chqrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($chqyfid);$i++){
      $chqrzsql .= " or `rzyy`='".$chqyfid[$i]."'";
    }
    $chqrzsql .= " )";
$chqshqq=mysql_query($chqsql);
$chqshq = mysql_num_rows($chqshqq);//获取申请条数

$chqrzq=mysql_query($chqrzsql." and `shqzht`='入组'");
$chqrz = mysql_num_rows($chqrzq);//获取入组条数

$chqshhq=mysql_query($chqsql." and `shqzht`='审核'");
$chqshh = mysql_num_rows($chqshhq);//获取审核条数

$chqdbq=mysql_query($chqsql." and `shqzht`='待办入组'");
$chqdb = mysql_num_rows($chqdbq);//获取待办入组条数

$chqtzhq=mysql_query($chqsql." and `shqzht`='停止申请'");
$chqtzh = mysql_num_rows($chqtzhq);//获取停止申请条数

$chqjjq=mysql_query($chqsql." and `shqzht`='拒绝'");
$chqjj = mysql_num_rows($chqjjq);//获取拒绝条数

$chqchzq=mysql_query($chqrzsql." and `shqzht`='出组'");
$chqchz = mysql_num_rows($chqchzq);//获取出组条数

$chqrzbfq=mysql_query($chqrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$chqrzbf = mysql_num_rows($chqrzbfq);//获取入组部分条数

$chqrzqbq=mysql_query($chqrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$chqrzqb = mysql_num_rows($chqrzqbq);//获取入组全部条数
$tjshz[23][0]=$chqshq;
$tjshz[23][1]=$chqrz;
$tjshz[23][2]=$chqshh;
$tjshz[23][3]=$chqdb;
$tjshz[23][4]=$chqtzh;
$tjshz[23][5]=$chqjj;
$tjshz[23][6]=$chqchz;
$tjshz[23][7]=$chqrzbf;
$tjshz[23][8]=$chqrzqb;
}//获取重庆发药条数
                     
//厦门
$xmyfidsql="SELECT `id` FROM `yyyshdq` where `shi`='厦门市'";
$xmyfidq=mysql_query($xmyfidsql);
while($xmyfidRecord = mysql_fetch_array($xmyfidq)){
$xmyfid[]=$xmyfidRecord[0];
}//获取全部厦门药房名称
if($xmyfid!=""){
    $xmsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($xmyfid);$i++){
      $xmsql .= " or `shqyy`='".$xmyfid[$i]."'";
    }
    $xmsql .= " )";
    $xmrzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($xmyfid);$i++){
      $xmrzsql .= " or `rzyy`='".$xmyfid[$i]."'";
    }
    $xmrzsql .= " )";
$xmshqq=mysql_query($xmsql);
$xmshq = mysql_num_rows($xmshqq);//获取申请条数

$xmrzq=mysql_query($xmrzsql." and `shqzht`='入组'");
$xmrz = mysql_num_rows($xmrzq);//获取入组条数

$xmshhq=mysql_query($xmsql." and `shqzht`='审核'");
$xmshh = mysql_num_rows($xmshhq);//获取审核条数

$xmdbq=mysql_query($xmsql." and `shqzht`='待办入组'");
$xmdb = mysql_num_rows($xmdbq);//获取待办入组条数

$xmtzhq=mysql_query($xmsql." and `shqzht`='停止申请'");
$xmtzh = mysql_num_rows($xmtzhq);//获取停止申请条数

$xmjjq=mysql_query($xmsql." and `shqzht`='拒绝'");
$xmjj = mysql_num_rows($xmjjq);//获取拒绝条数

$xmchzq=mysql_query($xmrzsql." and `shqzht`='出组'");
$xmchz = mysql_num_rows($xmchzq);//获取出组条数

$xmrzbfq=mysql_query($xmrzsql." and `shqzht`='入组' and `jzhlx`='部分'");
$xmrzbf = mysql_num_rows($xmrzbfq);//获取入组部分条数

$xmrzqbq=mysql_query($xmrzsql." and `shqzht`='入组' and `jzhlx`='全部'");
$xmrzqb = mysql_num_rows($xmrzqbq);//获取入组全部条数
$tjshz[24][0]=$xmshq;
$tjshz[24][1]=$xmrz;
$tjshz[24][2]=$xmshh;
$tjshz[24][3]=$xmdb;
$tjshz[24][4]=$xmtzh;
$tjshz[24][5]=$xmjj;
$tjshz[24][6]=$xmchz;
$tjshz[24][7]=$xmrzbf;
$tjshz[24][8]=$xmrzqb;
}//获取厦门发药条数


//$objExcel->getActiveSheet()->mergeCellsByColumnAndRow( 'A1:A2' );
$objExcel->getActiveSheet()->setCellValue('A1', "$k1"); 
$objExcel->getActiveSheet()->setCellValue('B1', "$k2"); 
$objExcel->getActiveSheet()->setCellValue('C1', "$k3"); 
$objExcel->getActiveSheet()->setCellValue('D1', "$k4"); 
$objExcel->getActiveSheet()->setCellValue('E1', "$k5"); 
$objExcel->getActiveSheet()->setCellValue('F1', "$k6"); 
$objExcel->getActiveSheet()->setCellValue('G1', "$k7"); 
$objExcel->getActiveSheet()->setCellValue('H1', "$k8"); 
$objExcel->getActiveSheet()->setCellValue('I1', "$k9"); 
$objExcel->getActiveSheet()->setCellValue('J1', "$k10"); /*
$objExcel->getActiveSheet()->setCellValue('A2', "$k11"); 
$objExcel->getActiveSheet()->setCellValue('A3', "$k12"); 
$objExcel->getActiveSheet()->setCellValue('A4', "$k13"); 
$objExcel->getActiveSheet()->setCellValue('A5', "$k14"); 
$objExcel->getActiveSheet()->setCellValue('A6', "$k15"); 
$objExcel->getActiveSheet()->setCellValue('A7', "$k16"); 
$objExcel->getActiveSheet()->setCellValue('A8', "$k17"); 
$objExcel->getActiveSheet()->setCellValue('A9', "$k18"); 
$objExcel->getActiveSheet()->setCellValue('A10', "$k19"); 
$objExcel->getActiveSheet()->setCellValue('A11', "$k20"); 
$objExcel->getActiveSheet()->setCellValue('A12', "$k21"); 
$objExcel->getActiveSheet()->setCellValue('A13', "$k22"); 
$objExcel->getActiveSheet()->setCellValue('A14', "$k23"); 
$objExcel->getActiveSheet()->setCellValue('A15', "$k24"); 
$objExcel->getActiveSheet()->setCellValue('A16', "$k25"); 
$objExcel->getActiveSheet()->setCellValue('A17', "$k26"); 
$objExcel->getActiveSheet()->setCellValue('A18', "$k27");  
$objExcel->getActiveSheet()->setCellValue('A19', "$k28");  
$objExcel->getActiveSheet()->setCellValue('A20', "$k29");  
$objExcel->getActiveSheet()->setCellValue('A21', "$k30");  
$objExcel->getActiveSheet()->setCellValue('A22', "$k31");  
$objExcel->getActiveSheet()->setCellValue('A23', "$k32");  
$objExcel->getActiveSheet()->setCellValue('A25', "$k33");  
$objExcel->getActiveSheet()->setCellValue('A26', "$k34");*/  
 //设置font
/*$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(20);
$objExcel->setActiveSheetIndex(0)->getStyle('Q2')->getFont()->setSize(15);*/
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A1:J26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
/*$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);*/
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

//设置c 列 身份证号码
    //$objExcel->getActiveSheet()->getStyle('c')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);//文本
    //$objExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);//

  //$sql = "select * from `hzh`";
  
  

  for($i=0;$i<=24;$i++)
  {  
  $jshi=$i+2;
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('A'.$jshi, $tjshz[$i][9]); 
    $objExcel->getActiveSheet()->setCellValue('B'.$jshi, $tjshz[$i][0]); 
    $objExcel->getActiveSheet()->setCellValue('C'.$jshi, $tjshz[$i][1]); 
    $objExcel->getActiveSheet()->setCellValue('D'.$jshi, $tjshz[$i][2]); 
    $objExcel->getActiveSheet()->setCellValue('E'.$jshi, $tjshz[$i][3]); 
    $objExcel->getActiveSheet()->setCellValue('F'.$jshi, $tjshz[$i][4]); 
    $objExcel->getActiveSheet()->setCellValue('G'.$jshi, $tjshz[$i][5]); 
    $objExcel->getActiveSheet()->setCellValue('H'.$jshi, $tjshz[$i][6]); 
    $objExcel->getActiveSheet()->setCellValue('I'.$jshi, $tjshz[$i][8]); 
    $objExcel->getActiveSheet()->setCellValue('J'.$jshi, $tjshz[$i][7]); 
    //$objExcel->getActiveSheet()->setCellValue('K'.$jshi, $bjyfid[$i]); 
    //$objExcel->getActiveSheet()->setCellValue('L'.$jshi, $bjrzsql); 

  }

//$objExcel->getActiveSheet()->getStyle('A1:Y'.$jshi)->getAlignment()->setWrapText(true);//自动换行

   /* 
$objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(38);  
$objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(23);  
$objExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);  
// 高置列的宽度  
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10.6); 
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5.6);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5.6);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5.6);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.6);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5.6);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5.6);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5.6);    
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('M')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('N')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('P')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('S')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('T')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('V')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('W')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('X')->setWidth(5.6);      
$objExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(5.6);      

$styleArray = array(
			'borders' => array(
				'allborders' => array(
					//'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的
					'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框
					//'color' => array('argb' => 'FFFF0000'),
				),
			),
		);
$objExcel->getActiveSheet()->getStyle('A3:Y'.$jshi)->applyFromArray($styleArray);*/
$objExcel->getActiveSheet()->getStyle('A3:J'.$jshi)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //左右居中
$objExcel->getActiveSheet()->getStyle('A3:J'.$jshi)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
 /* 
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');  
  */

// 设置页方向和规模  
//$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//页边距
//        $sheet = $objPHPExcel->getActiveSheet();
//        $pageMargins = $sheet->getPageMargins();
//        //$margin = '0.5/0.7'; 
//        $pageMargins->setTop(0);    //上边距
//        $pageMargins->setBottom(0.21); //下
//        $pageMargins->setLeft(0.58);   //左
//        $pageMargins->setRight(0.3);  //右      
$objExcel->setActiveSheetIndex(0);  
if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="按城市统计'.date('Y-m-d').'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="按城市统计'.date('Y-m-d').'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>