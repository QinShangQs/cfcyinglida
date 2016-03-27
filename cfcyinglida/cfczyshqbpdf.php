<?php session_start(); 
include('newdb.php');
  $id=$_GET['id'];

//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=".$id."_药物申请表.pdf");
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
$pdf->Image('./images/image003.jpg',25,5,10,0);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "中国癌症基金会英立达患者援助项目"), 0, 0, 'C');
$pdf->Image('./images/image004.jpg',175,5,20,0);
$pdf->Ln();
$pdf->Cell(190, 16, iconv("UTF-8", "gbk", "药物申请表"), 0, 0, 'C');

//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "1.申请捐赠药物发放中心的信息和申请数量"), 1, 0, 'L');
  $yfsql = "select * from `yf` where `id`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
$pdf->Ln();
$pdf->SetFont('GB', '', 14);
//$pdf->Cell(1, 8, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "药房名称:"), 1, 0, 'L');
$pdf->Cell(75, 10, iconv("UTF-8", "gbk", "$yfRecord[1]"), 1, 0, 'L');
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "负责药师:"), 1, 0, 'L');
$pdf->Cell(65, 10, iconv("UTF-8", "gbk", "$yfRecord[11]"), 1, 0, 'L');


if($yfRecord[10]=="省份"){$yfsheng="";}else{$yfsheng="$yfRecord[10]";}
    if($yfRecord[14]=="地级市"){$yfshi="";}else{$yfshi="$yfRecord[14]";}
    if($yfRecord[16]=="市、县级市"){$yfqu="";}else{$yfqu="$yfRecord[16]";}
     $dizhi=$yfsheng.$yfshi.$yfqu.$yfRecord[2];

$pdf->Ln();
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "地址:"), 1, 0, 'L');
$pdf->Cell(165, 10, iconv("UTF-8", "gbk", "$dizhi"), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "直线电话:"), 1, 0, 'L');
$pdf->Cell(75, 10, iconv("UTF-8", "gbk", "$yfRecord[3]"), 1, 0, 'L');
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "手机:"), 1, 0, 'L');
$pdf->Cell(65, 10, iconv("UTF-8", "gbk", "$yfRecord[4]"), 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "传真:"), 1, 0, 'L');
$pdf->Cell(75, 10, iconv("UTF-8", "gbk", "$yfRecord[5]"), 1, 0, 'L');
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "Email:"), 1, 0, 'L');
$pdf->Cell(65, 10, iconv("UTF-8", "gbk", "$yfRecord[6]"), 1, 0, 'L');
}
if($Record[4]!=""){

$pdf->Ln();
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "规格(1):"), 1, 0, 'L');
$pdf->Cell(165, 10, iconv("UTF-8", "gbk", "200mg*60粒/瓶"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 10);
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "库存数量(瓶):"), 1, 0, 'L');
$pdf->SetFont('GB', '', 14);
if($Record[3]!=""){$kcshl1=$Record[3];}else {$kcshl1="0";}

$pdf->Cell(75, 10, iconv("UTF-8", "gbk", "$kcshl1"), 1, 0, 'L');
$pdf->SetFont('GB', '', 10);
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "申请数量(瓶):"), 1, 0, 'L');
$pdf->SetFont('GB', '', 14);
if($Record[4]!=""){$shqshl1=$Record[4];}else {$shqshl1="0";}

$pdf->Cell(65, 10, iconv("UTF-8", "gbk", "$shqshl1"), 1, 0, 'L');
}

if($Record[7]!=""){
$pdf->Ln();
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "规格(2):"), 1, 0, 'L');
$pdf->Cell(165, 10, iconv("UTF-8", "gbk", "250mg*60粒/瓶"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 10);
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "库存数量(瓶):"), 1, 0, 'L');
$pdf->SetFont('GB', '', 14);
if($Record[6]!=""){$kcshl2=$Record[6];}else {$kcshl2="0";}

$pdf->Cell(75, 10, iconv("UTF-8", "gbk", $kcshl2), 1, 0, 'L');
$pdf->SetFont('GB', '', 10);
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "申请数量(瓶):"), 1, 0, 'L');
$pdf->SetFont('GB', '', 14);
if($Record[7]!=""){$shqshl2=$Record[7];}else {$shqshl2="0";}

$pdf->Cell(65, 10, iconv("UTF-8", "gbk", $shqshl2), 1, 0, 'L');
}
$pdf->Ln();
$pdf->SetFont('GB', '', 9);
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "申请经办人签字:"), 1, 0, 'L');
$pdf->SetFont('GB', '', 14);
  $shhrsql = "select yhyl1 from `manager` where `id`='".$Record[16]."'";
  $shhrQuery_ID = mysql_query($shhrsql);
  while($shhrRecord = mysql_fetch_array($shhrQuery_ID)){$shqr=$shhrRecord[0];}
$pdf->Cell(75, 10, iconv("UTF-8", "gbk", $shqr), 1, 0, 'L');
$pdf->SetFont('GB', '', 9);
$pdf->Cell(25, 10, iconv("UTF-8", "gbk", "申请日期:"), 1, 0, 'L');
$pdf->SetFont('GB', '', 14);
$pdf->Cell(65, 10, iconv("UTF-8", "gbk", date('Y年m月d日',strtotime($Record[9]))), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "2.项目办公室意见"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 10);
$pdf->Cell(190, 32, iconv("UTF-8", "gbk", ""), 1, 0, 'L');
$pdf->Cell(190, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "已审阅以上申请"), 0, 0, 'L');

$pdf->Ln();

if($Record[20]!=""){$qizhong= "200mg*60粒/瓶 ".$Record[20]." 瓶";}
if($Record[20]!=""&&$Record[21]!=""){$qizhong .=",";} 
if($Record[21]!=""){$qizhong .="250mg*60粒/瓶 ".$Record[21]." 瓶";}
$zongshu = $Record[20]+$Record[21];
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "请给以上地址运输英立达 $zongshu 瓶，其中 $qizhong 。"),0, 0, 'L');

$pdf->Ln();
$pdf->Ln();

$pdf->Cell(95, 8, iconv("UTF-8", "gbk", "签字、盖章:"), 0, 0, 'L');
$pdf->Cell(95, 8, iconv("UTF-8", "gbk", "日期: ".date('Y年m月d日',strtotime($Record[9]))), 0, 0, 'L');

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "填表说明:"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(20, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(150, 8, iconv("UTF-8", "gbk", "1.本表供各药物发放处使用;"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(20, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(150, 8, iconv("UTF-8", "gbk", "2.当药物发放处需要药物时，可随时填报本表并传真至项目办公室;"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(20, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(150, 8, iconv("UTF-8", "gbk", "3.原件请于次月5日前邮寄到项目办公室;"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(20, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(150, 8, iconv("UTF-8", "gbk", "4.项目办公室审阅并通知运输。进行相关记录。"), 0, 0, 'L');

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

$pdf->Output($id."_药物申请表.pdf",I);

}
/*$pdf->Output('aa.pdf');
echo "<a href=\"aa.pdf\">右键目标另存为</a>";*/

?>