<?php session_start(); 
include('newdb.php');
  $id=$_GET['id'];
  $sql = "select * from `yfshqzy` where `id`='".$id."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=".$id."_收到捐赠药物说明.pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');


$pdf = new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB', 'B', 20);
$pdf->Image('./images/image005.jpg',25,5,160,0);
//$pdf->Cell(190, 24, iconv("UTF-8", "gbk", "中国癌症基金会英立达患者援助项目"), 0, 0, 'C');
//$pdf->Image('./images/image004.jpg',175,5,20,0);
$pdf->Ln();//
$pdf->Cell(190, 40, iconv("UTF-8", "gbk", "药品接收确认表"), 0, 0, 'C');

//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 14, iconv("UTF-8", "gbk", "指定药房信息"), 1, 0, 'C');

  $yfsql = "select * from `yf` where `yfmch`='".$Record[25]."' AND `yfzhdysh`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){

$pdf->Ln();
$pdf->SetFont('GB', '', 13);
$pdyfmchzsh=mb_strlen($yfRecord[1],'UTF8');
if($pdyfmchzsh>15){
//药方名称超出15个汉字时会超出边框
$yfmchwidth=105;
}else{
$yfmchwidth=75;
}
$pdf->Cell(40, 14, iconv("UTF-8", "gbk", "指定药房名称"), 1, 0, 'C');
//$pdf->Cell($yfmchwidth, 16, iconv("UTF-8", "gbk", $yfRecord[1]), 1, 0, 'L');
//$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "负责药师："), 1, 0, 'L');
//$pdf->Cell(140-$yfmchwidth, 16, iconv("UTF-8", "gbk", $yfRecord[11]), 1, 0, 'L');
$pdf->Cell(150, 14, iconv("UTF-8", "gbk", $yfRecord[1]), 1, 0, 'L');
$pdf->Ln();

$pdf->Cell(40, 14, iconv("UTF-8", "gbk", "指定药房地址"), 1, 0, 'C');
if($yfRecord[10]==$yfRecord[14]){$yfshengshi=$yfRecord[10].$yfRecord[16];}
else{$yfshengshi=$yfRecord[10].$yfRecord[14].$yfRecord[16];}
$pdf->Cell(150, 14, iconv("UTF-8", "gbk", $yfshengshi.$yfRecord[2]), 1, 0, 'L');
$pdf->Ln();

$pdf->Cell(40, 14, iconv("UTF-8", "gbk", "药师姓名"), 1, 0, 'C');
$pdf->Cell(150, 14, iconv("UTF-8", "gbk", $yfRecord[11]), 1, 0, 'L');
$pdf->Ln();

$pdf->Cell(40, 14, iconv("UTF-8", "gbk", "联系方式"), 1, 0, 'C');
$pdf->Cell(150, 14, iconv("UTF-8", "gbk", $yfRecord[3]), 1, 0, 'L');
//$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "手机："), 1, 0, 'L');
//$pdf->Cell(65, 16, iconv("UTF-8", "gbk", $yfRecord[4]), 1, 0, 'L');

$pdf->Ln();
//$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "传真："), 1, 0, 'L');
//$pdf->Cell(75, 16, iconv("UTF-8", "gbk", $yfRecord[5]), 1, 0, 'L');
//$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "Email："), 1, 0, 'L');
//$pdf->Cell(65, 16, iconv("UTF-8", "gbk", $yfRecord[6]), 1, 0, 'L');
}

$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->Cell(190, 14, iconv("UTF-8", "gbk", "收到援助药品记录"), 1, 0, 'C');



$pdf->Ln();
$pdf->SetFont('GB', '', 13);
$pdf->Cell(30, 14, iconv("UTF-8", "gbk", "申请日期"), 1, 0, 'C');
$pdf->Cell(65, 14, iconv("UTF-8", "gbk", date('Y年m月d日',strtotime($Record[14]))), 1, 0, 'L');

$pdf->SetFont('GB', '', 13);
$pdf->Cell(30, 14, iconv("UTF-8", "gbk", "接收日期"), 1, 0, 'C');
$pdf->Cell(65, 14, iconv("UTF-8", "gbk", date('Y年m月d日',strtotime($Record[14]))), 1, 0, 'L');

//$pdf->Cell(25,16, iconv("UTF-8", "gbk", "收到数量："), 1, 0, 'L');
//$pdf->Cell(75,16, iconv("UTF-8", "gbk", $Record[20]."瓶（12.5mg*28粒/瓶）"), 1, 0, 'L');
$pdf->Ln();

      if($Record[15]!=""){
          $ph1nr="";
          $ph1 = explode(",",$Record[15]);
          $phs1 = explode(",",$Record[22]);
          for($i=0;$i<=count($ph1);$i++)
          {
              $ph1sql = "select ph from `kfrk` where `id`='".$ph1[$i]."'";
              $ph1Query_ID = mysql_query($ph1sql);
              while($ph1Record = mysql_fetch_array($ph1Query_ID)){
//                  $ph1nr.=$ph1Record['0']."(".$phs1[$i]."瓶) ";
                  $ph1nr.=$ph1Record['0'];
              }
          }

$pdf->SetFont('GB', '', 13);
$pdf->Cell(30,14, iconv("UTF-8", "gbk", "申请数量"), 1, 0, 'C');
$pdf->Cell(65,14, iconv("UTF-8", "gbk", "(".$Record[2].")".$Record[4]."盒 批号".$ph1nr), 1, 0, 'L');


$pdf->SetFont('GB', '', 13);
$pdf->Cell(30,14, iconv("UTF-8", "gbk", "收到数量"), 1, 0, 'C');
$pdf->Cell(65,14, iconv("UTF-8", "gbk", "(".$Record[2].")".$Record[20]."盒 批号".$ph1nr), 1, 0, 'L');

$pdf->Ln();


$pdf->Cell(30, 14, iconv("UTF-8", "gbk", "运单号"), 1, 0, 'C');
$pdf->Cell(160, 14, iconv("UTF-8", "gbk", $Record[12]), 1, 0, 'L');
//$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "签字："), 1, 0, 'L');
//$pdf->Cell(75, 16, iconv("UTF-8", "gbk", ""), 1, 0, 'L');
$pdf->Ln();

$pdf->MultiCell(190, 14, iconv("UTF-8", "gbk", "英立达患者援助项目办：                                                               我已于二0     年     月     日接收上述援助药品，并已入库保存。                    特此证明！                                                                         经办人签字：_________________
二0    年    月    日
（加盖药房公章）"), 1, 0, 'L');
//          $pdf->Ln();
//          $pdf->Cell(190, 16, iconv("UTF-8", "gbk", "英立达患者援助项目办："), 0, 0, 'L');
          $pdf->Ln();
//$pdf->Cell(25,16, iconv("UTF-8", "gbk", "批号："), 1, 0, 'L');
//
//$pdf->Cell(65,16, iconv("UTF-8", "gbk", $ph1nr), 1, 0, 'L');
}

//$pdf->Cell(25, 16, iconv("UTF-8", "gbk", "药房公章："), 1, 0, 'L');
//$pdf->Cell(75, 16, iconv("UTF-8", "gbk", ""), 1, 0, 'L');

$pdf->Ln();
$pdf->Ln();
//$pdf->Cell(190, 5, iconv("UTF-8", "gbk", "注："), 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('GB', '', 11);
$pdf->Cell(10, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(140, 4, iconv("UTF-8", "gbk", "注：1.本表（原件）下载后，须指定药师填写并加盖单位公章。"), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(10, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->MultiCell(160, 4, iconv("UTF-8", "gbk", "    2.请将本表原件务必于次月5日前随月报邮寄至项目办；复印件药师自行备案留存。"),  0, 'L');


$pdf->Ln();
$pdf->Cell(190, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(40, 35, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(110, 35, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
$pdf->Cell(40, 1, iconv("UTF-8", "gbk", ""), 0, 0, 'C');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('GB', '', 12);

//$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "意见或者建议，请联系"), 0, 0, 'C');
$pdf->Ln();
//$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "中国癌症基金会"), 0, 0, 'C');
$pdf->Ln();
//$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "英立达患者援助项目办公室"), 0, 0, 'C');
$pdf->Ln();
      $pdf->Image('./images/image006.jpg',58,28,20,0);
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "联系电话：010-6715 0515"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "   邮寄地址：北京市 2258 信箱"), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 6, iconv("UTF-8", "gbk", "           接 收 人：英立达患者援助项目办公室"), 0, 0, 'C');
      $pdf->Image('./images/image007.jpg',25,70,160,0);

$pdf->Output($id.'_收到捐赠药物说明.pdf',I);
}
?>