<?php
session_start ();
include ('newdb.php');
$kshnyr = date ( 'Y-m-d', strtotime ( $_GET ['ny'] ) );
$jshnyr = date ( 'Y-m-d', strtotime ( "$kshnyr +1 month" ) );
$yhgldw = $_SESSION [gldw];
$sql = "select SUM(`jhkpshl`),SUM(`fyshl`), fyjl from `zyff` where `yfmch`='" . $yhgldw . "' and `zyffzht` IS NULL and `fyrq`>='$kshnyr' and `fyrq`<'$jshnyr' and fyjl like '1mg%'";
$Query_ID = mysql_query ( $sql );
$mg1R = null;
while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
	$mg1R = $Record;
}
$sql = "select SUM(`jhkpshl`),SUM(`fyshl`), fyjl from `zyff` where `yfmch`='" . $yhgldw . "' and `zyffzht` IS NULL and `fyrq`>='$kshnyr' and `fyrq`<'$jshnyr' and fyjl like '5mg%'";
$Query_ID = mysql_query ( $sql );
$mg5R = null;
while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
	$mg5R = $Record;
}
// header('Content-type: text/html;charset=utf-8');
header ( 'content-type:application/pdf' );
header ( "Content-Disposition: attachment; filename=空瓶回收记录表.pdf" );
ini_set ( 'display_errors', '0' );
ini_set ( 'max_execution_time', '60' );

require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');

$pdf = new PDF_Chinese ();
$pdf->AddGBFont ();
$pdf->Open ();
$pdf->AddPage ();
$pdf->SetFont ( 'GB', 'B', 22 );
$pdf->Image ( './images/image005.jpg', 25, 5, 160, 0 );
$pdf->Ln (); //
$pdf->Ln (); //
$pdf->Cell ( 190, 50, iconv ( "UTF-8", "gbk", "空药盒回收记录表" ), 0, 0, 'C' );

// 以上是表头
$pdf->Ln ();
$pdf->SetFont ( 'GB', 'B', 16 );
$pdf->SetLeftMargin ( 10.0 );
$pdf->Cell ( 190, 16, iconv ( "UTF-8", "gbk", "指定药房信息" ), 1, 0, 'C' );

$yfsql = "select * from `yf` where `yfmch`='" . $yhgldw . "'";
$yfQuery_ID = mysql_query ( $yfsql );
while ( $yfRecord = mysql_fetch_array ( $yfQuery_ID ) ) {
	
	$pdf->Ln ();
	$pdf->SetFont ( 'GB', '', 14 );
	$pdyfmchzsh = mb_strlen ( $yfRecord [1], 'UTF8' );
	if ($pdyfmchzsh > 15) {
		// 药方名称超出15个汉字时会超出边框
		$yfmchwidth = 105;
	} else {
		$yfmchwidth = 65;
	}
	$pdf->Cell ( 40, 14, iconv ( "UTF-8", "gbk", "指定药房名称" ), 1, 0, 'C' );
	$pdf->Cell ( 150, 14, iconv ( "UTF-8", "gbk", $yfRecord [1] ), 1, 0, 'L' );
	$pdf->Ln ();
	$pdf->Cell ( 40, 14, iconv ( "UTF-8", "gbk", "指定药师姓名" ), 1, 0, 'C' );
	$pdf->Cell ( 65, 14, iconv ( "UTF-8", "gbk", $yfRecord [11] ), 1, 0, 'L' );
	$pdf->Cell ( 25, 14, iconv ( "UTF-8", "gbk", "日期" ), 1, 0, 'C' );
	$pdf->Cell ( 60, 14, iconv ( "UTF-8", "gbk", date ( 'Y年m月', strtotime ( $kshnyr ) ) ), 1, 0, 'L' );
}
$pdf->Ln ();
$pdf->SetFont ( 'GB', 'B', 16);
$pdf->Cell ( 190, 16, iconv ( "UTF-8", "gbk", "空药盒回收信息" ), 1, 0, 'C' );
$pdf->Ln ();
$pdf->SetFont ( 'GB', '', 12 );
$pdf->Cell ( 40, 12, iconv ( "UTF-8", "gbk", "自费药盒数" ), 1, 0, 'C' );
$pdf->Cell ( 75, 12, iconv ( "UTF-8", "gbk","1mg*14片/盒    " ."共计 " .round ( (!empty($mg1R)? $mg1R[0] :0) ) . " 盒" ), 1, 0, 'C' );
$pdf->Cell ( 75, 12, iconv ( "UTF-8", "gbk","5mg*14片/盒    " ."共计 " .round ( (!empty($mg5R)? $mg5R[0] :0) ) . " 盒" ), 1, 0, 'C' );
$pdf->Ln ();
$pdf->Cell ( 40, 12, iconv ( "UTF-8", "gbk", "援助药盒数" ), 1, 0, 'C' );
$pdf->Cell ( 75, 12, iconv ( "UTF-8", "gbk","1mg*14片/盒    " ."共计 " .round ( (!empty($mg1R)? $mg1R[1] :0) ) . " 盒" ), 1, 0, 'C' );
$pdf->Cell ( 75, 12, iconv ( "UTF-8", "gbk","5mg*14片/盒    " ."共计 " .round ( (!empty($mg5R)? $mg5R[1] :0) ) . " 盒" ), 1, 0, 'C' );
$pdf->Ln ();
$pdf->Cell ( 40, 12, iconv ( "UTF-8", "gbk", "空药盒数量(共计)" ), 1, 0, 'C' );
$pdf->Cell ( 75, 12, iconv ( "UTF-8", "gbk","1mg*14片/盒    " ."共计 " .round ( (!empty($mg1R)? ($mg1R[0] + $mg1R[1]) :0) ) . " 盒" ), 1, 0, 'C' );
$pdf->Cell ( 75, 12, iconv ( "UTF-8", "gbk","5mg*14片/盒    " ."共计 " .round ( (!empty($mg5R)? ($mg5R[0] + $mg5R[1]):0) ) . " 盒" ), 1, 0, 'C' );
$pdf->Ln ();
$pdf->Cell ( 40, 12, iconv ( "UTF-8", "gbk", "总  计" ), 1, 0, 'C' );
$pdf->Cell ( 150, 12, iconv ( "UTF-8", "gbk", (round ( (!empty($mg1R)? ($mg1R[0] + $mg1R[1]) :0) ) + round ( (!empty($mg5R)? ($mg5R[0] + $mg5R[1]):0) )) . " 盒" ), 1, 0, 'C' );
$pdf->Ln ();

$pdf->MultiCell ( 190, 10, iconv ( "UTF-8", "gbk", "
       签字 :                                                                                      
  二0_____年___月___日" ), 1, 0, 'L' );
$pdf->Ln ();
$pdf->SetFont ( 'GB', '', 11 );
$pdf->Cell ( 10, 10, iconv ( "UTF-8", "gbk", "" ), 0, 0, 'C' );
$pdf->Cell ( 140, 4, iconv ( "UTF-8", "gbk", "注：1.本表（原件）下载后，须指定药师填写并加盖单位公章。" ), 0, 0, 'L' );
$pdf->Ln ();
$pdf->Cell ( 10, 25, iconv ( "UTF-8", "gbk", "" ), 0, 0, 'C' );
$pdf->MultiCell ( 160, 4, iconv ( "UTF-8", "gbk", "    2.请将本表原件务必于次月5日前随月报邮寄至项目办；复印件药师自行备案留存。" ), 0, 'L' );

$pdf->Ln ();
$pdf->Cell ( 190, 1, iconv ( "UTF-8", "gbk", "" ), 0, 0, 'C' );

$pdf->Ln ();
$pdf->SetFont ( 'GB', '', 12 );
$pdf->Cell ( 40, 35, iconv ( "UTF-8", "gbk", "" ), 0, 0, 'C' );
$pdf->Cell ( 110, 35, iconv ( "UTF-8", "gbk", "" ), 0, 0, 'C' );
$pdf->Cell ( 40, 1, iconv ( "UTF-8", "gbk", "" ), 0, 0, 'C' );

$pdf->Ln ();
$pdf->Ln ();
$pdf->Ln ();
$pdf->SetFont ( 'GB', '', 12 );

$pdf->Ln ();
$pdf->Ln ();
$pdf->Ln ();
$pdf->Ln ();
$pdf->Image ( './images/image006.jpg', 58, 240, 20, 0 );
$pdf->Cell ( 190, 6, iconv ( "UTF-8", "gbk", "联系电话：010-6715 0515" ), 0, 0, 'C' );
$pdf->Ln ();
$pdf->Cell ( 190, 6, iconv ( "UTF-8", "gbk", "   邮寄地址：北京市 2258 信箱" ), 0, 0, 'C' );
$pdf->Ln ();
$pdf->Cell ( 190, 6, iconv ( "UTF-8", "gbk", "           接 收 人：英立达患者援助项目办公室" ), 0, 0, 'C' );
$pdf->Image ( './images/image007.jpg', 25, 265, 160, 0 );

$pdf->Output ( '空瓶回收记录表.pdf', I );

?>