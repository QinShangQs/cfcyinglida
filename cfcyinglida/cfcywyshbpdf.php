<?php session_start(); 
include('newdb.php');
  $shqid=$_GET['id'];
//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=".$shqid."_药物运输申请表.pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');
  $sql = "select * from `yfshqzy` where `id`='".$shqid."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){

$pdf = new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB', 'B', 24);

$pdf->Cell(190, 0, iconv("UTF-8", "gbk", "中国癌症基金会英立达患者援助项目"), 0, 0, 'C');
$pdf->Ln();//
$pdf->SetFont('GB', 'B', 20);
$pdf->Cell(190, 20, iconv("UTF-8", "gbk", "药物运输表"), 0, 0, 'C');


$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);  
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "中国医药对外贸易公司:"),"B", 0, 'L');
$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", ""), 0, 0, 'L');
$pdf->Cell(160, 8, iconv("UTF-8", "gbk", "请将药物按照以下详细地址送交接收医院的负责药师。"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", ""), 0, 0, 'L');
$pdf->Cell(160, 8, iconv("UTF-8", "gbk", "非常感谢！"), 0, 0, 'L');

//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "一、接受药物药房和地址"), 1, 0, 'L');

  $yfsql = "select * from `yf` where  `yfmch`='".$Record[25]."' and `yfzhdysh`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(45, 12, iconv("UTF-8", "gbk", "药房名称："), 1, 0, 'L');
$pdf->Cell(145, 12, iconv("UTF-8", "gbk", $yfRecord[1]), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(45, 12, iconv("UTF-8", "gbk", "负责药师："), 1, 0, 'L');
$pdf->Cell(145, 12, iconv("UTF-8", "gbk", $yfRecord[11]), 1, 0, 'L');

if($yfRecord[10]=="省份"){$yfsheng="";}else{$yfsheng=$yfRecord[10];}
    if($yfRecord[14]=="地级市"){$yfshi="";}else{$yfshi=$yfRecord[14];}
    if($yfRecord[16]=="市、县级市"){$yfqu="";}else{$yfqu=$yfRecord[16];}

$pdf->Ln();
$pdf->Cell(45, 12, iconv("UTF-8", "gbk", "地址："), 1, 0, 'L');
$pdf->Cell(145, 12, iconv("UTF-8", "gbk", $yfsheng.$yfshi.$yfqu.$yfRecord[2]), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "直线电话："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yfRecord[3]), 1, 0, 'L');
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "手机："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yfRecord[4]), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "传真："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yfRecord[5]), 1, 0, 'L');
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "Email："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yfRecord[6]), 1, 0, 'L');
}
$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "二、药物数量"), 1, 0, 'L');
if($Record[20]!=""){$shl1=$Record[20];}else {$shl1="0";}
if($Record[20]!=""){
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "规格(1)："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", "200mg*60粒/瓶"), 1, 0, 'L');
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "数量："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $shl1."瓶"), 1, 0, 'L');
}
if($Record[21]!=""){$shl2=$Record[21];}else {$shl2="0";}
if($Record[21]!=""){
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "规格(2)："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", "250mg*60粒/瓶"), 1, 0, 'L');
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "数量："), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $shl2."瓶"), 1, 0, 'L');
}


$pdf->Ln();

$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "项目办公室签字盖章："), 0, 0, 'L');
$pdf->Ln();
$pdf->Ln();
$shhrsql = "select yhyl1 from `manager` where `id`='".$Record[16]."'";
  $shhrQuery_ID = mysql_query($shhrsql);
  while($shhrRecord = mysql_fetch_array($shhrQuery_ID)){$qz=$shhrRecord[0];}
$pdf->Cell(95, 8, iconv("UTF-8", "gbk", "签字：".$qz), 0, 0, 'L');
$pdf->Cell(95, 8, iconv("UTF-8", "gbk", "日期：".date('Y年m月d日',strtotime($Record[18]))), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(1, -32, iconv("UTF-8", "gbk", ""), L, 0, 'L');
$pdf->Cell(189, -32, iconv("UTF-8", "gbk", ""), R, 0, 'L');
$pdf->Cell(-190, 1, iconv("UTF-8", "gbk", ""), T, 0, 'L');






$pdf->SetFont('GB', 'B', 12);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "三、药物运输记录（以下由负责发货的公司填写）"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "运输日期："), 1, 0, 'L');
if($Record[8]>=2){$yshrq=date('Y年m月d日',strtotime($Record[13]));}
$pdf->Cell(145, 8, iconv("UTF-8", "gbk", $yshrq), 1, 0, 'L');


$pdf->Ln();
if($Record[8]>=2){$zpsh=$Record[20]+$Record[21];$zpshp=$zpsh."瓶";}

$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "运输数量："), 1, 0, 'L');
$pdf->Cell(145, 8, iconv("UTF-8", "gbk", $zpshp ), 1, 0, 'L');


$pdf->Ln();
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "运单编码："), 1, 0, 'L');
if($Record[8]>=2){$yshnm=$Record[12];}
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yshnm ), 1, 0, 'L');
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "运输公司电话："), 1, 0, 'L');
if($Record[8]>=2){$yshgsdh="400-920-1336";}
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yshgsdh), 1, 0, 'L');



$pdf->Ln();
if($Record[8]>=2){$yshgs="国药外贸发货组";}
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", "运输经办人："), 1, 0, 'L');
$pdf->Cell(145, 8, iconv("UTF-8", "gbk", $yshgs), 1, 0, 'L');


$pdf->Ln();
$pdf->Cell(45, 10, iconv("UTF-8", "gbk", "备注："), 1, 0, 'L');
$pdf->Cell(145,10, iconv("UTF-8", "gbk", ""), 1, 0, 'L');


$pdf->Ln();
$pdf->Ln();
$pdf->Cell(20, 8, iconv("UTF-8", "gbk", "填表说明"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(20, 8, iconv("UTF-8", "gbk", "1.	本表由项目办公室向负责发货的公司发出通知，请相应公司及时做出安排。"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", "2.	请运输后将该文件签字后及时传真给项目办公室。"), 0, 0, 'L');


$pdf->Ln();
$pdf->Cell(190, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', '', 10);
$pdf->Cell(40, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(110, 25, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(40, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'C');

$pdf->Ln();
$pdf->Ln();

$pdf->Cell(190, 4, iconv("UTF-8", "gbk", "意见或者建议，请联系"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 4, iconv("UTF-8", "gbk", "中国癌症基金会"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 4, iconv("UTF-8", "gbk", "英立达患者援助项目办公室"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 4, iconv("UTF-8", "gbk", "电话：010-67123993    传真：010-67770237"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 4, iconv("UTF-8", "gbk", "电子邮件：ipapfc@163.com 网站：www.cfchina.org.cn"), 0, 0, 'C');



$pdf->Output($shqid.'_药物运输申请表.pdf',I);
}
?>