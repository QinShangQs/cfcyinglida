<?php session_start();
include('newdb.php');
$kshnyr=date('Y-m-d',strtotime($_GET['ny']));
$jshnyr=date('Y-m-d',strtotime("$kshnyr +1 month"));
$yhgldw = $_SESSION[gldw];
$sql = "select SUM(pshsh) from `psyp` WHERE `yfmch`='$yhgldw' and `createDate`>='$kshnyr' and `createDate`<'$jshnyr'";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
//header('Content-type: text/html;charset=utf-8');
    header('content-type:application/pdf');
    header("Content-Disposition: attachment; filename=破损药盒回收记录表.pdf");
    ini_set('display_errors', '0');
    ini_set('max_execution_time', '60');


    require ('./pdf/fpdf.php');
    require ('./pdf/chinese.php');


    $pdf = new PDF_Chinese();
    $pdf->AddGBFont();
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetFont('GB', 'B', 24);
    $pdf->Image('./images/image003.jpg',25,5,10,0);
    $pdf->Cell(190, 24, iconv("UTF-8", "gbk", "中国癌症基金会索坦患者援助项目"), 0, 0, 'C');
    $pdf->Image('./images/image004.jpg',175,5,20,0);
    $pdf->Ln();//
    $pdf->Cell(190, 24, iconv("UTF-8", "gbk", "破损药盒回收记录表"), 0, 0, 'C');

//以上是表头
    $pdf->Ln();
    $pdf->SetFont('GB', 'B', 16);
    $pdf->SetLeftMargin(10.0);
    $pdf->Cell(190, 16, iconv("UTF-8", "gbk", "捐赠药物发放中心的信息"), 1, 0, 'L');

    $yfsql = "select * from `yf` where `yfmch`='".$yhgldw."'";
    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){

        $pdf->Ln();
        $pdf->SetFont('GB', '', 14);
        $pdyfmchzsh=mb_strlen($yfRecord[1],'UTF8');
        if($pdyfmchzsh>15){
//药方名称超出15个汉字时会超出边框
            $yfmchwidth=105;
        }else{
            $yfmchwidth=65;
        }
        $pdf->Cell(25, 16, iconv("UTF-8", "gbk", "药房名称："), 1, 0, 'L');
        $pdf->Cell($yfmchwidth, 16, iconv("UTF-8", "gbk", $yfRecord[1]), 1, 0, 'L');
        $pdf->Cell(25, 16, iconv("UTF-8", "gbk", "负责药师："), 1, 0, 'L');
        $pdf->Cell(140-$yfmchwidth, 16, iconv("UTF-8", "gbk", $yfRecord[11]), 1, 0, 'L');

    }

    $pdf->Ln();
    $pdf->SetFont('GB', '', 14);
    $pdf->Cell(25,16, iconv("UTF-8", "gbk", "破损数量："), 1, 0, 'L');
    $pdf->Cell(165,16, iconv("UTF-8", "gbk", round($Record[0])."瓶"), 1, 0, 'L');
//    $pdf->Cell(25,16, iconv("UTF-8", "gbk", "赠药数量："), 1, 0, 'L');
//    $pdf->Cell(75,16, iconv("UTF-8", "gbk", round($Record[1])."瓶"), 1, 0, 'L');
    $pdf->Ln();
    $pdf->Cell(25, 16, iconv("UTF-8", "gbk", "记录年月："), 1, 0, 'L');
    $pdf->Cell(65, 16, iconv("UTF-8", "gbk", date('Y年m月',strtotime($kshnyr))), 1, 0, 'L');
    $pdf->Cell(25, 16, iconv("UTF-8", "gbk", "签字："), 1, 0, 'L');
    $pdf->Cell(75, 16, iconv("UTF-8", "gbk", ""), 1, 0, 'L');
    /*
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(190, 5, iconv("UTF-8", "gbk", "填表说明："), 0, 0, 'L');
    $pdf->Ln();
    $pdf->SetFont('GB', '', 12);
    $pdf->Cell(10, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
    $pdf->Cell(140, 4, iconv("UTF-8", "gbk", "1.本表供各药物发放处使用;"), 0, 0, 'L');
    $pdf->Ln();
    $pdf->Cell(10, 25, iconv("UTF-8", "gbk", ""), 0, 0, 'C');
    $pdf->MultiCell(160, 4, iconv("UTF-8", "gbk", "2.请在每次收到捐赠药物后完整记录并加盖公章传真到项目办公室，原件于次月5日随月报邮寄至项目办公室。"),  0, 'L');


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
    $pdf->Cell(190, 6, iconv("UTF-8", "gbk", "索坦患者援助项目办公室"), 0, 0, 'C');
    $pdf->Ln();
    $pdf->Cell(190, 6, iconv("UTF-8", "gbk", "电话：010-67770237    传真：010-67770236"), 0, 0, 'C');
    $pdf->Ln();
    $pdf->Cell(190, 6, iconv("UTF-8", "gbk", "电子邮件：spapcfc@163.com 网站：www.cfchina.org.cn"), 0, 0, 'C');

    */
    $pdf->Output('破损药盒回收记录表.pdf',I);
}
