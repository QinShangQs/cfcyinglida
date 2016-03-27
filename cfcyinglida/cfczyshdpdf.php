<?php session_start(); 
include('newdb.php');
  $id=$_GET['id'];
//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=".$id."_收到捐赠药物说明.pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');

  $sql = "select * from `yfshqzy` where `id`='".$id."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){

$pdf = new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB', 'B', 24);
$pdf->Cell(190, 24, iconv("UTF-8", "gbk", "中国癌症基金会英立达患者援助项目"), 0, 0, 'C');
$pdf->Ln();//
$pdf->Cell(190, 24, iconv("UTF-8", "gbk", "收到捐赠药物说明"), 0, 0, 'C');

//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk", "1. 申请捐赠药物发放中心的信息"), 1, 0, 'L');

  $yfsql = "select * from `yf` where `yfzhdysh`='".$Record[1]."' and `yfmch`='".$Record[25]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){

$pdf->Ln();
$pdf->SetFont('GB', '', 14);
$pdyfmchzsh=mb_strlen($yfRecord[1],'UTF8');
if($pdyfmchzsh>15){
//药方名称超出15个汉字时会超出边框
$yfmchwidth=105;
}else{
$yfmchwidth=75;
}
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "药房名称："), 1, 0, 'L');
$pdf->Cell($yfmchwidth, 16, iconv("UTF-8", "gbk", $yfRecord[1]), 1, 0, 'L');
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "负责药师："), 1, 0, 'L');
$pdf->Cell(140-$yfmchwidth, 16, iconv("UTF-8", "gbk", $yfRecord[11]), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "地址："), 1, 0, 'L');
if($yfRecord[10]==$yfRecord[14]){$yfshengshi=$yfRecord[10].$yfRecord[16];}
else{$yfshengshi=$yfRecord[10].$yfRecord[14].$yfRecord[16];}
$pdf->Cell(165, 16, iconv("UTF-8", "gbk", $yfshengshi.$yfRecord[2]), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "直线电话："), 1, 0, 'L');
$pdf->Cell(75, 16, iconv("UTF-8", "gbk", $yfRecord[3]), 1, 0, 'L');
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "手机："), 1, 0, 'L');
$pdf->Cell(65, 16, iconv("UTF-8", "gbk", $yfRecord[4]), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "传真："), 1, 0, 'L');
$pdf->Cell(75, 16, iconv("UTF-8", "gbk", $yfRecord[5]), 1, 0, 'L');
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "Email："), 1, 0, 'L');
$pdf->Cell(65, 16, iconv("UTF-8", "gbk", $yfRecord[6]), 1, 0, 'L');
}
$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk", "2. 收到捐赠药物记录"), 1, 0, 'L');


if($Record[20]>0&&$Record[20]!=""){
$pdf->Ln();
$pdf->SetFont('GB', '', 14);
$pdf->Cell(25,16, iconv("UTF-8", "gbk", "收到数量："), 1, 0, 'L');
$pdf->Cell(75,16, iconv("UTF-8", "gbk", $Record[20]."瓶（200mg*60粒/瓶）"), 1, 0, 'L');
$pdf->Cell(25,16, iconv("UTF-8", "gbk", "批号："), 1, 0, 'L');
if($Record[15]!=""&&$Record[22]!=""){
  $ph1nr="";
  $ph1 = explode(",",$Record[15]);
  $phs1 = explode(",",$Record[22]);
  for($i=0;$i<=count($ph1);$i++)
  {
    $ph1sql = "select ph from `kfrk` where `id`='".$ph1[$i]."'";
    $ph1Query_ID = mysql_query($ph1sql);
    while($ph1Record = mysql_fetch_array($ph1Query_ID)){
    $ph1nr.=$ph1Record['0']."(".$phs1[$i]."瓶) ";
    }
  }
$pdf->Cell(65,16, iconv("UTF-8", "gbk", $ph1nr), 1, 0, 'L');
}
}

if($Record[21]>0&&$Record[21]!=""){
$pdf->Ln();
$pdf->SetFont('GB', '', 14);
$pdf->Cell(25,16, iconv("UTF-8", "gbk", "收到数量："), 1, 0, 'L');
$pdf->Cell(75,16, iconv("UTF-8", "gbk", $Record[21]."瓶（250mg*60粒/瓶）"), 1, 0, 'L');
$pdf->Cell(25,16, iconv("UTF-8", "gbk", "批号："), 1, 0, 'L');
if($Record[19]!=""&&$Record[23]!=""){
  $ph1nr="";
  $ph1 = explode(",",$Record[19]);
  $phs1 = explode(",",$Record[23]);
  for($i=0;$i<=count($ph1);$i++)
  {
    $ph1sql = "select ph from `kfrk` where `id`='".$ph1[$i]."'";
    $ph1Query_ID = mysql_query($ph1sql);
    while($ph1Record = mysql_fetch_array($ph1Query_ID)){
    $ph1nr.=$ph1Record['0']."(".$phs1[$i]."瓶) ";
    }
  }
$pdf->Cell(65,16, iconv("UTF-8", "gbk", $ph1nr), 1, 0, 'L');
}
}

$pdf->Ln();
$pdf->SetFont('GB', '', 14);
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "收到日期："), 1, 0, 'L');
$pdf->Cell(40, 16, iconv("UTF-8", "gbk", date('Y年m月d日',strtotime($Record[14]))), 1, 0, 'R');
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "运单编码："), 1, 0, 'L');
$pdf->Cell(40, 16, iconv("UTF-8", "gbk", $Record[12]), 1, 0, 'L');
$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "签字盖章："), 1, 0, 'L');
$pdf->Cell(35, 16, iconv("UTF-8", "gbk", ""), 1, 0, 'L');

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 5, iconv("UTF-8", "gbk", "填表说明："), 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(10, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(140, 4, iconv("UTF-8", "gbk", "1.本表供各药物发放处使用;"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(10, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->MultiCell(160, 4, iconv("UTF-8", "gbk", "2.请在每次收到捐赠药物后完整记录并加盖公章传真到项目办公室，请将原件于次月5日随月报邮寄至项目办公室。"),  0, 'L');


$pdf->Ln();
$pdf->Cell(190, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(40, 35, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(110, 35, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(40, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'C');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('GB', '', 12);

$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "意见或者建议，请联系"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "中国癌症基金会"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "英立达患者援助项目办公室"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "电话：010-67123993    传真：010-67770237"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "电子邮件：ipapfc@163.com 网站：www.cfchina.org.cn"), 0, 0, 'C');


$pdf->Output($id.'_收到捐赠药物说明.pdf',I);
}
?>