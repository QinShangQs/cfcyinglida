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
$ym=$_GET[ym];
$gg=$_GET[gg];
$bbrq=date('Y年m月',strtotime("-".$ym." month".date('Y-m')));
$bbrqi=date('Y-m',strtotime("-".$ym." month".date('Y-m')));
$bbrqiz=date('d',strtotime("+1 month -1 day ".$bbrqi));
$k1="中国癌症基金会赛可瑞患者援助项目".$bbrq."药品配送明细 ";  
if($gg==1){
$k2="剂量：200mg  单位：瓶";  
}else{
$k2="剂量：250mg  单位：瓶";  
}
$k3="日期";  
$k4="北京"; 
$k5="长春"; 
$k6="长沙";  
$k7="成都";  
$k8="大连";  
$k9="福州"; 
$k10="广州";  
$k11="哈尔滨"; 
$k12="杭州"; 
$k13="济南"; 
$k14="兰州";  
$k15="南昌";  
$k16="南京";
$k17="南宁";   
$k18="青岛";  
$k19="上海";  
$k20="沈阳";  
$k21="太原";  
$k22="天津";  
$k23="乌鲁木齐";  
$k24="武汉"; 
$k25="西安";  
$k26="郑州"; 
$k27="重庆";  
$bjyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='北京市'";
$bjyfmchq=mysql_query($bjyfmchsql);
while($bjyfmchRecord = mysql_fetch_array($bjyfmchq)){
$bjyfmch[]=$bjyfmchRecord[0];
}//获取全部北京药房名称
if($bjyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $bjzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $bjzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($bjyfmch);$i++){
      $bjzyshsql .= " or `yfmch`='".$bjyfmch[$i]."'";
    }
    $bjzyshsql .= " )";
    $bjzyshq=mysql_query($bjzyshsql);
    while($bjzyshRecord = mysql_fetch_array($bjzyshq)){
      if($bjzyshRecord[0]>0){$bjzysh[$rqi]=$bjzyshRecord[0];}else{$bjzysh[$rqi]="";}
    }//获取本月北京发药条数
  }
}//获取北京发药条数
 
$chchyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='长春市'";
$chchyfmchq=mysql_query($chchyfmchsql);
while($chchyfmchRecord = mysql_fetch_array($chchyfmchq)){
$chchyfmch[]=$chchyfmchRecord[0];
}//获取全部长春药房名称
if($chchyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $chchzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $chchzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($chchyfmch);$i++){
      $chchzyshsql .= " or `yfmch`='".$chchyfmch[$i]."'";
    }
    $chchzyshsql .= " )";
    $chchzyshq=mysql_query($chchzyshsql);
    while($chchzyshRecord = mysql_fetch_array($chchzyshq)){
      if($chchzyshRecord[0]>0){$chchzysh[$rqi]=$chchzyshRecord[0];}else{$chchzysh[$rqi]="";}
    }//获取本月长春发药条数
  }
}//获取长春发药条数
   
$chshyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='长沙市'";
$chshyfmchq=mysql_query($chshyfmchsql);
while($chshyfmchRecord = mysql_fetch_array($chshyfmchq)){
$chshyfmch[]=$chshyfmchRecord[0];
}//获取全部长沙药房名称
if($chshyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $chshzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $chshzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($chshyfmch);$i++){
      $chshzyshsql .= " or `yfmch`='".$chshyfmch[$i]."'";
    }
    $chshzyshsql .= " )";
    $chshzyshq=mysql_query($chshzyshsql);
    while($chshzyshRecord = mysql_fetch_array($chshzyshq)){
      if($chshzyshRecord[0]>0){$chshzysh[$rqi]=$chshzyshRecord[0];}else{$chshzysh[$rqi]="";}
    }//获取本月长沙发药条数
  }
}//获取长沙发药条数
   
$chdyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='成都市'";
$chdyfmchq=mysql_query($chdyfmchsql);
while($chdyfmchRecord = mysql_fetch_array($chdyfmchq)){
$chdyfmch[]=$chdyfmchRecord[0];
}//获取全部成都药房名称
if($chdyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $chdzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $chdzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($chdyfmch);$i++){
      $chdzyshsql .= " or `yfmch`='".$chdyfmch[$i]."'";
    }
    $chdzyshsql .= " )";
    $chdzyshq=mysql_query($chdzyshsql);
    while($chdzyshRecord = mysql_fetch_array($chdzyshq)){
      if($chdzyshRecord[0]>0){$chdzysh[$rqi]=$chdzyshRecord[0];}else{$chdzysh[$rqi]="";}
    }//获取本月成都发药条数
  }
}//获取成都发药条数
 
$dlyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='大连市'";
$dlyfmchq=mysql_query($dlyfmchsql);
while($dlyfmchRecord = mysql_fetch_array($dlyfmchq)){
$dlyfmch[]=$dlyfmchRecord[0];
}//获取全部大连药房名称
if($dlyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $dlzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $dlzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($dlyfmch);$i++){
      $dlzyshsql .= " or `yfmch`='".$dlyfmch[$i]."'";
    }
    $dlzyshsql .= " )";
    $dlzyshq=mysql_query($dlzyshsql);
    while($dlzyshRecord = mysql_fetch_array($dlzyshq)){
      if($dlzyshRecord[0]>0){$dlzysh[$rqi]=$dlzyshRecord[0];}else{$dlzysh[$rqi]="";}
    }//获取本月大连发药条数
  }
}//获取大连发药条数
    
$fzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='福州市'";
$fzhyfmchq=mysql_query($fzhyfmchsql);
while($fzhyfmchRecord = mysql_fetch_array($fzhyfmchq)){
$fzhyfmch[]=$fzhyfmchRecord[0];
}//获取全部福州药房名称
if($fzhyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $fzhzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $fzhzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($fzhyfmch);$i++){
      $fzhzyshsql .= " or `yfmch`='".$fzhyfmch[$i]."'";
    }
    $fzhzyshsql .= " )";
    $fzhzyshq=mysql_query($fzhzyshsql);
    while($fzhzyshRecord = mysql_fetch_array($fzhzyshq)){
      if($fzhzyshRecord[0]>0){$fzhzysh[$rqi]=$fzhzyshRecord[0];}else{$fzhzysh[$rqi]="";}
    }//获取本月福州发药条数
  }
}//获取福州发药条数
    
$gzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='广州市'";
$gzhyfmchq=mysql_query($gzhyfmchsql);
while($gzhyfmchRecord = mysql_fetch_array($gzhyfmchq)){
$gzhyfmch[]=$gzhyfmchRecord[0];
}//获取全部广州药房名称
if($gzhyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $gzhzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $gzhzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($gzhyfmch);$i++){
      $gzhzyshsql .= " or `yfmch`='".$gzhyfmch[$i]."'";
    }
    $gzhzyshsql .= " )";
    $gzhzyshq=mysql_query($gzhzyshsql);
    while($gzhzyshRecord = mysql_fetch_array($gzhzyshq)){
      if($gzhzyshRecord[0]>0){$gzhzysh[$rqi]=$gzhzyshRecord[0];}else{$gzhzysh[$rqi]="";}
    }//获取本月广州发药条数
  }
}//获取广州发药条数
      
$herbyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='哈尔滨市'";
$herbyfmchq=mysql_query($herbyfmchsql);
while($herbyfmchRecord = mysql_fetch_array($herbyfmchq)){
$herbyfmch[]=$herbyfmchRecord[0];
}//获取全部哈尔滨药房名称
if($herbyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $herbzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $herbzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($herbyfmch);$i++){
      $herbzyshsql .= " or `yfmch`='".$herbyfmch[$i]."'";
    }
    $herbzyshsql .= " )";
    $herbzyshq=mysql_query($herbzyshsql);
    while($herbzyshRecord = mysql_fetch_array($herbzyshq)){
      if($herbzyshRecord[0]>0){$herbzysh[$rqi]=$herbzyshRecord[0];}else{$herbzysh[$rqi]="";}
    }//获取本月哈尔滨发药条数
  }
}//获取哈尔滨发药条数
        
$hzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='杭州市'";
$hzhyfmchq=mysql_query($hzhyfmchsql);
while($hzhyfmchRecord = mysql_fetch_array($hzhyfmchq)){
$hzhyfmch[]=$hzhyfmchRecord[0];
}//获取全部杭州药房名称
if($hzhyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $hzhzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $hzhzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($hzhyfmch);$i++){
      $hzhzyshsql .= " or `yfmch`='".$hzhyfmch[$i]."'";
    }
    $hzhzyshsql .= " )";
    $hzhzyshq=mysql_query($hzhzyshsql);
    while($hzhzyshRecord = mysql_fetch_array($hzhzyshq)){
      if($hzhzyshRecord[0]>0){$hzhzysh[$rqi]=$hzhzyshRecord[0];}else{$hzhzysh[$rqi]="";}
    }//获取本月杭州发药条数
  }
}//获取杭州发药条数
         
$jnyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='济南市'";
$jnyfmchq=mysql_query($jnyfmchsql);
while($jnyfmchRecord = mysql_fetch_array($jnyfmchq)){
$jnyfmch[]=$jnyfmchRecord[0];
}//获取全部济南药房名称
if($jnyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $jnzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $jnzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($jnyfmch);$i++){
      $jnzyshsql .= " or `yfmch`='".$jnyfmch[$i]."'";
    }
    $jnzyshsql .= " )";
    $jnzyshq=mysql_query($jnzyshsql);
    while($jnzyshRecord = mysql_fetch_array($jnzyshq)){
      if($jnzyshRecord[0]>0){$jnzysh[$rqi]=$jnzyshRecord[0];}else{$jnzysh[$rqi]="";}
    }//获取本月济南发药条数
  }
}//获取济南发药条数
         
$lzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='兰州市'";
$lzhyfmchq=mysql_query($lzhyfmchsql);
while($lzhyfmchRecord = mysql_fetch_array($lzhyfmchq)){
$lzhyfmch[]=$lzhyfmchRecord[0];
}//获取全部济南药房名称
if($lzhyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $lzhzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $lzhzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($lzhyfmch);$i++){
      $lzhzyshsql .= " or `yfmch`='".$lzhyfmch[$i]."'";
    }
    $lzhzyshsql .= " )";
    $lzhzyshq=mysql_query($lzhzyshsql);
    while($lzhzyshRecord = mysql_fetch_array($lzhzyshq)){
      if($lzhzyshRecord[0]>0){$lzhzysh[$rqi]=$lzhzyshRecord[0];}else{$lzhzysh[$rqi]="";}
    }//获取本月济南发药条数
  }
}//获取济南发药条数
       
$nchyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='南昌市'";
$nchyfmchq=mysql_query($nchyfmchsql);
while($nchyfmchRecord = mysql_fetch_array($nchyfmchq)){
$nchyfmch[]=$nchyfmchRecord[0];
}//获取全部济南药房名称
if($nchyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $nchzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $nchzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($nchyfmch);$i++){
      $nchzyshsql .= " or `yfmch`='".$nchyfmch[$i]."'";
    }
    $nchzyshsql .= " )";
    $nchzyshq=mysql_query($nchzyshsql);
    while($nchzyshRecord = mysql_fetch_array($nchzyshq)){
      if($nchzyshRecord[0]>0){$nchzysh[$rqi]=$nchzyshRecord[0];}else{$nchzysh[$rqi]="";}
    }//获取本月济南发药条数
  }
}//获取济南发药条数
            
$njyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='南京市'";
$njyfmchq=mysql_query($njyfmchsql);
while($njyfmchRecord = mysql_fetch_array($njyfmchq)){
$njyfmch[]=$njyfmchRecord[0];
}//获取全部南京药房名称
if($njyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $njzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $njzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($njyfmch);$i++){
      $njzyshsql .= " or `yfmch`='".$njyfmch[$i]."'";
    }
    $njzyshsql .= " )";
    $njzyshq=mysql_query($njzyshsql);
    while($njzyshRecord = mysql_fetch_array($njzyshq)){
      if($njzyshRecord[0]>0){$njzysh[$rqi]=$njzyshRecord[0];}else{$njzysh[$rqi]="";}
    }//获取本月南京发药条数
  }
}//获取南京发药条数
         
$nnyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='南宁市'";
$nnyfmchq=mysql_query($nnyfmchsql);
while($nnyfmchRecord = mysql_fetch_array($nnyfmchq)){
$nnyfmch[]=$nnyfmchRecord[0];
}//获取全部南宁药房名称
if($nnyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $nnzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $nnzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($nnyfmch);$i++){
      $nnzyshsql .= " or `yfmch`='".$nnyfmch[$i]."'";
    }
    $nnzyshsql .= " )";
    $nnzyshq=mysql_query($nnzyshsql);
    while($nnzyshRecord = mysql_fetch_array($nnzyshq)){
      if($nnzyshRecord[0]>0){$nnzysh[$rqi]=$nnzyshRecord[0];}else{$nnzysh[$rqi]="";}
    }//获取本月南宁发药条数
  }
}//获取南宁发药条数
         
$qdyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='青岛市'";
$qdyfmchq=mysql_query($qdyfmchsql);
while($qdyfmchRecord = mysql_fetch_array($qdyfmchq)){
$qdyfmch[]=$qdyfmchRecord[0];
}//获取全部青岛药房名称
if($qdyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $qdzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $qdzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($qdyfmch);$i++){
      $qdzyshsql .= " or `yfmch`='".$qdyfmch[$i]."'";
    }
    $qdzyshsql .= " )";
    $qdzyshq=mysql_query($qdzyshsql);
    while($qdzyshRecord = mysql_fetch_array($qdzyshq)){
      if($qdzyshRecord[0]>0){$qdzysh[$rqi]=$qdzyshRecord[0];}else{$qdzysh[$rqi]="";}
    }//获取本月青岛发药条数
  }
}//获取青岛发药条数
          
$shhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='上海市'";
$shhyfmchq=mysql_query($shhyfmchsql);
while($shhyfmchRecord = mysql_fetch_array($shhyfmchq)){
$shhyfmch[]=$shhyfmchRecord[0];
}//获取全部上海药房名称
if($shhyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $shhzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $shhzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($shhyfmch);$i++){
      $shhzyshsql .= " or `yfmch`='".$shhyfmch[$i]."'";
    }
    $shhzyshsql .= " )";
    $shhzyshq=mysql_query($shhzyshsql);
    while($shhzyshRecord = mysql_fetch_array($shhzyshq)){
      if($shhzyshRecord[0]>0){$shhzysh[$rqi]=$shhzyshRecord[0];}else{$shhzysh[$rqi]="";}
    }//获取本月上海发药条数
  }
}//获取上海发药条数
            
$shyyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='沈阳市'";
$shyyfmchq=mysql_query($shyyfmchsql);
while($shyyfmchRecord = mysql_fetch_array($shyyfmchq)){
$shyyfmch[]=$shyyfmchRecord[0];
}//获取全部沈阳药房名称
if($shyyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $shyzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $shyzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($shyyfmch);$i++){
      $shyzyshsql .= " or `yfmch`='".$shyyfmch[$i]."'";
    }
    $shyzyshsql .= " )";
    $shyzyshq=mysql_query($shyzyshsql);
    while($shyzyshRecord = mysql_fetch_array($shyzyshq)){
      if($shyzyshRecord[0]>0){$shyzysh[$rqi]=$shyzyshRecord[0];}else{$shyzysh[$rqi]="";}
    }//获取本月沈阳发药条数
  }
}//获取沈阳发药条数
             
$tyyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='太原市'";
$tyyfmchq=mysql_query($tyyfmchsql);
while($tyyfmchRecord = mysql_fetch_array($tyyfmchq)){
$tyyfmch[]=$tyyfmchRecord[0];
}//获取全部太原药房名称
if($tyyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $tyzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $tyzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($tyyfmch);$i++){
      $tyzyshsql .= " or `yfmch`='".$tyyfmch[$i]."'";
    }
    $tyzyshsql .= " )";
    $tyzyshq=mysql_query($tyzyshsql);
    while($tyzyshRecord = mysql_fetch_array($tyzyshq)){
      if($tyzyshRecord[0]>0){$tyzysh[$rqi]=$tyzyshRecord[0];}else{$tyzysh[$rqi]="";}
    }//获取本月太原发药条数
  }
}//获取太原发药条数
          
$tjyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='天津市'";
$tjyfmchq=mysql_query($tjyfmchsql);
while($tjyfmchRecord = mysql_fetch_array($tjyfmchq)){
$tjyfmch[]=$tjyfmchRecord[0];
}//获取全部天津药房名称
if($tjyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $tjzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $tjzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($tjyfmch);$i++){
      $tjzyshsql .= " or `yfmch`='".$tjyfmch[$i]."'";
    }
    $tjzyshsql .= " )";
    $tjzyshq=mysql_query($tjzyshsql);
    while($tjzyshRecord = mysql_fetch_array($tjzyshq)){
      if($tjzyshRecord[0]>0){$tjzysh[$rqi]=$tjzyshRecord[0];}else{$tjzysh[$rqi]="";}
    }//获取本月天津发药条数
  }
}//获取天津发药条数
           
$wlmqyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='乌鲁木齐市'";
$wlmqyfmchq=mysql_query($wlmqyfmchsql);
while($wlmqyfmchRecord = mysql_fetch_array($wlmqyfmchq)){
$wlmqyfmch[]=$wlmqyfmchRecord[0];
}//获取全部乌鲁木齐药房名称
if($wlmqyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $wlmqzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $wlmqzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($wlmqyfmch);$i++){
      $wlmqzyshsql .= " or `yfmch`='".$wlmqyfmch[$i]."'";
    }
    $wlmqzyshsql .= " )";
    $wlmqzyshq=mysql_query($wlmqzyshsql);
    while($wlmqzyshRecord = mysql_fetch_array($wlmqzyshq)){
      if($wlmqzyshRecord[0]>0){$wlmqzysh[$rqi]=$wlmqzyshRecord[0];}else{$wlmqzysh[$rqi]="";}
    }//获取本月乌鲁木齐发药条数
  }
}//获取乌鲁木齐发药条数
              
$whyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='武汉市'";
$whyfmchq=mysql_query($whyfmchsql);
while($whyfmchRecord = mysql_fetch_array($whyfmchq)){
$whyfmch[]=$whyfmchRecord[0];
}//获取全部武汉药房名称
if($whyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $whzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $whzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($whyfmch);$i++){
      $whzyshsql .= " or `yfmch`='".$whyfmch[$i]."'";
    }
    $whzyshsql .= " )";
    $whzyshq=mysql_query($whzyshsql);
    while($whzyshRecord = mysql_fetch_array($whzyshq)){
      if($whzyshRecord[0]>0){$whzysh[$rqi]=$whzyshRecord[0];}else{$whzysh[$rqi]="";}
    }//获取本月武汉发药条数
  }
}//获取武汉发药条数
          
$xanyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='西安市'";
$xanyfmchq=mysql_query($xanyfmchsql);
while($xanyfmchRecord = mysql_fetch_array($xanyfmchq)){
$xanyfmch[]=$xanyfmchRecord[0];
}//获取全部西安药房名称
if($xanyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $xanzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $xanzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($xanyfmch);$i++){
      $xanzyshsql .= " or `yfmch`='".$xanyfmch[$i]."'";
    }
    $xanzyshsql .= " )";
    $xanzyshq=mysql_query($xanzyshsql);
    while($xanzyshRecord = mysql_fetch_array($xanzyshq)){
      if($xanzyshRecord[0]>0){$xanzysh[$rqi]=$xanzyshRecord[0];}else{$xanzysh[$rqi]="";}
    }//获取本月西安发药条数
  }
}//获取西安发药条数
          
$zhzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='郑州市'";
$zhzhyfmchq=mysql_query($zhzhyfmchsql);
while($zhzhyfmchRecord = mysql_fetch_array($zhzhyfmchq)){
$zhzhyfmch[]=$zhzhyfmchRecord[0];
}//获取全部郑州药房名称
if($zhzhyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $zhzhzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $zhzhzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($zhzhyfmch);$i++){
      $zhzhzyshsql .= " or `yfmch`='".$zhzhyfmch[$i]."'";
    }
    $zhzhzyshsql .= " )";
    $zhzhzyshq=mysql_query($zhzhzyshsql);
    while($zhzhzyshRecord = mysql_fetch_array($zhzhzyshq)){
      if($zhzhzyshRecord[0]>0){$zhzhzysh[$rqi]=$zhzhzyshRecord[0];}else{$zhzhzysh[$rqi]="";}
    }//获取本月郑州发药条数
  }
}//获取郑州发药条数
         
  
$chqyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='重庆市'";
$chqyfmchq=mysql_query($chqyfmchsql);
while($chqyfmchRecord = mysql_fetch_array($chqyfmchq)){
$chqyfmch[]=$chqyfmchRecord[0];
}//获取全部重庆药房名称
if($chqyfmch!=""){
  for($rqi=1;$rqi<=$bbrqiz;$rqi++){
    if($gg==1){
      $chqzyshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }else{
      $chqzyshsql="SELECT SUM(pfshl2) FROM `yfshqzy` where `shdrq`='".date('Y-m-d',strtotime($bbrqi."-".$rqi))."' and ('1'='2' ";
    }
    for($i=0;$i<count($chqyfmch);$i++){
      $chqzyshsql .= " or `yfmch`='".$chqyfmch[$i]."'";
    }
    $chqzyshsql .= " )";
    $chqzyshq=mysql_query($chqzyshsql);
    while($chqzyshRecord = mysql_fetch_array($chqzyshq)){
      if($chqzyshRecord[0]>0){$chqzysh[$rqi]=$chqzyshRecord[0];}else{$chqzysh[$rqi]="";}
    }//获取本月重庆发药条数
  }
}//获取重庆发药条数
         
 
$objExcel->getActiveSheet()->mergeCells( 'A1:Y1' );
$objExcel->getActiveSheet()->mergeCells( 'Q2:Y2' );

//$objExcel->getActiveSheet()->mergeCellsByColumnAndRow( 'A1:A2' );
$objExcel->getActiveSheet()->setCellValue('A1', "$k1"); 
$objExcel->getActiveSheet()->setCellValue('Q2', "$k2"); 
$objExcel->getActiveSheet()->setCellValue('A3', "$k3"); 
$objExcel->getActiveSheet()->setCellValue('B3', "$k4"); 
$objExcel->getActiveSheet()->setCellValue('C3', "$k5"); 
$objExcel->getActiveSheet()->setCellValue('D3', "$k6"); 
$objExcel->getActiveSheet()->setCellValue('E3', "$k7"); 
$objExcel->getActiveSheet()->setCellValue('F3', "$k8"); 
$objExcel->getActiveSheet()->setCellValue('G3', "$k9"); 
$objExcel->getActiveSheet()->setCellValue('H3', "$k10"); 
$objExcel->getActiveSheet()->setCellValue('I3', "$k11"); 
$objExcel->getActiveSheet()->setCellValue('J3', "$k12"); 
$objExcel->getActiveSheet()->setCellValue('K3', "$k13"); 
$objExcel->getActiveSheet()->setCellValue('L3', "$k14"); 
$objExcel->getActiveSheet()->setCellValue('M3', "$k15"); 
$objExcel->getActiveSheet()->setCellValue('N3', "$k16"); 
$objExcel->getActiveSheet()->setCellValue('O3', "$k17"); 
$objExcel->getActiveSheet()->setCellValue('P3', "$k18"); 
$objExcel->getActiveSheet()->setCellValue('Q3', "$k19"); 
$objExcel->getActiveSheet()->setCellValue('R3', "$k20"); 
$objExcel->getActiveSheet()->setCellValue('S3', "$k21"); 
$objExcel->getActiveSheet()->setCellValue('T3', "$k22"); 
$objExcel->getActiveSheet()->setCellValue('U3', "$k23"); 
$objExcel->getActiveSheet()->setCellValue('V3', "$k24"); 
$objExcel->getActiveSheet()->setCellValue('W3', "$k25"); 
$objExcel->getActiveSheet()->setCellValue('X3', "$k26"); 
$objExcel->getActiveSheet()->setCellValue('Y3', "$k27"); 
//$objExcel->getActiveSheet()->setCellValue('J2', "$k11"); 
 //设置font
$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(20);
$objExcel->setActiveSheetIndex(0)->getStyle('Q2')->getFont()->setSize(15);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

//设置c 列 身份证号码
    //$objExcel->getActiveSheet()->getStyle('c')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);//文本
    //$objExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);//

  //$sql = "select * from `hzh`";
  
  

  for($di=1;$di<=$bbrqiz;$di++)
  {
    $jshi=$di+3;  
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('A'.$jshi, date('Y/m/d',strtotime($bbrqi."-".$di))); 
   $objExcel->getActiveSheet()->setCellValue('B'.$jshi, $bjzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('C'.$jshi, $chchzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('D'.$jshi, $chshzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('E'.$jshi, $chdzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('F'.$jshi, $dlzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('G'.$jshi, $fzhzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('H'.$jshi, $gzhzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('I'.$jshi, $herbzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('J'.$jshi, $hzhzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('K'.$jshi, $jnzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('L'.$jshi, $lzhzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('M'.$jshi, $nchzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('N'.$jshi, $njzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('O'.$jshi, $nnzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('P'.$jshi, $qdzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('Q'.$jshi, $shhzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('R'.$jshi, $shyzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('S'.$jshi, $tyzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('T'.$jshi, $tjzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('U'.$jshi, $wlmqzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('V'.$jshi, $whzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('W'.$jshi, $xanzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('X'.$jshi, $zhzhzysh[$di]); 
    $objExcel->getActiveSheet()->setCellValue('Y'.$jshi, $chqzysh[$di]);  

  }

    $objExcel->getActiveSheet()->setCellValue('K'.($jshi+2), "审核人："); 
    $objExcel->getActiveSheet()->setCellValue('T'.($jshi+2), "制表人："); 
$objExcel->getActiveSheet()->getStyle('A1:Y'.$jshi)->getAlignment()->setWrapText(true);//自动换行

    
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
$objExcel->getActiveSheet()->getStyle('A3:Y'.$jshi)->applyFromArray($styleArray);
$objExcel->getActiveSheet()->getStyle('A3:Y'.$jshi)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //左右居中
$objExcel->getActiveSheet()->getStyle('A3:Y'.$jshi)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
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
if($gg==1){$ggzhw="200mg";}else{$ggzhw="250mg";}
if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="'.$bbrq.$ggzhw.'分配明细.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="'.$bbrq.$ggzhw.'分配明细.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>