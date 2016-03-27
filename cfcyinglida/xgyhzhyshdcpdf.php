<?php session_start(); 
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
$yhqxxf=str_ireplace(",","','","'".implode(",",$_SESSION[yhqxxf])."'");
$xgyyfsql = "select `yfmch` from `yf` where `yfshi` in (".$yhqxxf.")  group by  yfmch order by id DESC ";
//echo $xgyyfsql;
$xgyyfQuery_ID = mysql_query($xgyyfsql);
$xgyyf="";
while($xgyyfRecord = mysql_fetch_array($xgyyfQuery_ID)){
  if($xgyyf!=""){
    $xgyyf.=",";
  }
  $xgyyf.="'".$xgyyfRecord[0]."'";
}
$yhgldw=$xgyyf;

//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=患者申请信息.pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');


class PDF extends PDF_Chinese 
{ 
  /*function Header() //设置页眉 
  { 
    $this->SetFont('GB','',10); 
    $this->Write(10,iconv("UTF-8", "gbk", "中国癌症基金会赛可瑞患者援助项目")); 
    $this->Ln(20); //换行 
  } */
  function Footer() //设置页脚 
  { 
    $this->SetY(-15); 
    $this->SetFont('GB','',10); 
    $this->Cell(0,10,iconv("UTF-8", "gbk", '第'.$this->PageNo().'页')); 
  } 
}
 
$pdf = new PDF();

$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB', 'B', 24);
//$pdf->Image('./images/image003.jpg',25,5,10,0);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "中国癌症基金会索坦患者援助项目"), 0, 0, 'C');
//$pdf->Image('./images/image004.jpg',175,5,20,0);
$pdf->Ln();
$pdf->Cell(190, 16, iconv("UTF-8", "gbk", "患者申请信息"), 0, 0, 'C');

//以上是表头

$hzhtmp=Array();
$sql="select `id`,`shqyy`,`rzyy`,`zhzhyy` from `hzh` where  `lyyf` in ($xgyyf) order by id ";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
  if($Record[3]!=""){
    $hzhtmp[$Record[3]][]=$Record[0];
  }else if($Record[2]!=""){
    $hzhtmp[$Record[2]][]=$Record[0];
  }else{
    $hzhtmp[$Record[1]][]=$Record[0];
  }
  
}
foreach($hzhtmp as $k =>$v){
$yshsql="select * from `yyyshdq` where  `id`='".$k."'";
$yshQuery_ID = mysql_query($yshsql);
while($ysRecord = mysql_fetch_array($yshQuery_ID)){
$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(130, 10, iconv("UTF-8", "gbk", "医生医院"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "医生姓名"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "患者总人数"), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(130, 10, iconv("UTF-8", "gbk", $ysRecord[3]), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $ysRecord[6]), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", count($v)), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(50, 10, iconv("UTF-8", "gbk", "患者姓名"), 1, 0, 'L');
$pdf->Cell(45, 10, iconv("UTF-8", "gbk", "患者状态"), 1, 0, 'L');
$pdf->Cell(50, 10, iconv("UTF-8", "gbk", "服用剂量"), 1, 0, 'L');
$pdf->Cell(45, 10, iconv("UTF-8", "gbk", "领药次数"), 1, 0, 'L');
foreach($v as $k1 => $v1){
$hzhsql="select * from `hzh` where `id`='".$v1."' ";
$hzhQuery_ID = mysql_query($hzhsql);
while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(50, 10, iconv("UTF-8", "gbk", $hzhRecord[4]), 1, 0, 'L');
$pdf->Cell(45, 10, iconv("UTF-8", "gbk", $hzhRecord[3]), 1, 0, 'L');

            //读取次数
//$lynumq=mysql_query("SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='".$hzhRecord[0]."' and `zyffzht` IS NULL ");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}
//显示当前剂量
if($lynum>=1){
  $hzhlyjlsql="SELECT `yyyf` FROM `zyff` where `tshqk`='0' and `hzhid`='".$hzhRecord[0]."' and `zyffzht` IS NULL order by `id` desc limit 1";
  $hzhlyjlq=mysql_query($hzhlyjlsql);
  while($hzhlyjlr = mysql_fetch_array($hzhlyjlq)){
      $hzhlyjl=$hzhlyjlr[0];
  }
}else{
  //$hzhshqypgg=$Record[28];
  $hzhlyjl=str_ireplace('','',$hzhRecord[28],$i);
}
if($hzhlyjl==""){$hzhlyjl="错误";}
$pdf->Cell(50, 10, iconv("UTF-8", "gbk", $hzhlyjl), 1, 0, 'L');
$pdf->Cell(45, 10, iconv("UTF-8", "gbk", $lynum), 1, 0, 'L');
$lynum=0;
$hzhlyjl="错误";
}
}
/*
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->Image('./qzyzh/'.sprintf("%03d", $Record[8]).'-1.jpg',$x,$y,18,0);
$pdf->Image('./qzyzh/'.sprintf("%03d", $Record[8]).'-2.jpg',$x+18,$y,18,0);
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", ""), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[9]), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[11]), 1, 0, 'L');
if($Record[9]!=""){
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->Image('./qzyzh/'.sprintf("%03d", $Record[8]).'-3.jpg',$x,$y,18,0);
}
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", ""), 1, 0, 'L');
*/
}
}
$pdf->Output("患者申请信息.pdf",I);
?>