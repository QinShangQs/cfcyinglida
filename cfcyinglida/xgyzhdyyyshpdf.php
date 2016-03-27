<?php session_start(); 
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
$yhqxxf=str_ireplace(",","','","'".implode(",",$_SESSION[yhqxxf])."'");
$xgyyfsql = "select `yfmch` from `yf` where `yfshi` in (".$yhqxxf.")  group by  yfmch order by id DESC ";
//echo $sql;
$xgyyfQuery_ID = mysql_query($xgyyfsql);
$xgyyf="";
while($xgyyfRecord = mysql_fetch_array($xgyyfQuery_ID)){
  if($xgyyf!=""){
    $xgyyf.=",";
  }
  $xgyyf.="'".$xgyyfRecord[0]."'";
}
$yhgldw=$xgyyf;
if($_SESSION[xgyzhdyyyshdchsql]!=""){

$sqltmp=explode("limit",$_SESSION[xgyzhdyyyshdchsql]);
$sql=$sqltmp[0];
//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=指定医生/授权医生信息导出.pdf");
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
$pdf->Cell(190, 16, iconv("UTF-8", "gbk", "指定医生/授权医生信息"), 0, 0, 'C');

//以上是表头

$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "一、医院城市"), 1, 0, 'L');
$pdf->SetFont('GB', '', 12);
$yfmchshz=explode(",",str_ireplace("'","",$yhgldw));
foreach($yfmchshz as $k =>$v){
$tjzshsql = "select `shi`,COUNT(DISTINCT yymch),COUNT(DISTINCT zhdyshdh),COUNT(DISTINCT shqysh1),COUNT(DISTINCT shqysh2),COUNT(DISTINCT shqysh3) from `yyyshdq` where `yhszht`='1'  and `yyzhdyf`='$v'  group by  `shi` ";
  $tjzshQuery_ID = mysql_query($tjzshsql);
  $shqyshtjfsh=0;
  while($tjzshRecord = mysql_fetch_array($tjzshQuery_ID)){
  $yymchshz=$tjzshRecord[1];
  $zhdyshshz=$tjzshRecord[2];
  if($tjzshRecord[3]>1){$shqyshtjfsh+=1;}
  if($tjzshRecord[4]>1){$shqyshtjfsh+=1;}
  if($tjzshRecord[5]>1){$shqyshtjfsh+=1;}
  if($_GET[shfyshqysh]!=1&&$shqyshtjfsh<3){$shqyshtjfsh=3;}
  $shqyshshz=$tjzshRecord[3]+$tjzshRecord[4]+$tjzshRecord[5]-$shqyshtjfsh;
  if($shqyshshz<0){$shqyshshz=0;}
$pdf->Ln();
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", $tjzshRecord[0]), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $yymchshz."家医院"), 1, 0, 'L');
$pdf->Cell(50, 8, iconv("UTF-8", "gbk", $zhdyshshz."名指定医生"), 1, 0, 'L');
$pdf->Cell(45, 8, iconv("UTF-8", "gbk", $shqyshshz."名授权医生"), 1, 0, 'L');
  }
}


$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "二、详细信息"), 1, 0, 'L');
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "医院城市"), 1, 0, 'L');
$pdf->Cell(125, 10, iconv("UTF-8", "gbk", "医院名称"), 1, 0, 'L');
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", "医生科室"), 1, 0, 'L');
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[24]), 1, 0, 'L');
$pdf->Cell(125, 10, iconv("UTF-8", "gbk", $Record[3]), 1, 0, 'L');
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", $Record[5]), 1, 0, 'L');
$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "指定医生"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "联系电话"), 1, 0, 'L');
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", "签字样张"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "授权医生"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "联系电话"), 1, 0, 'L');
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", "签字样张"), 1, 0, 'L');
$pdf->Ln();
$pdf->SetFont('GB', '', 14);
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[6]), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[7]), 1, 0, 'L');
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

if($Record[12]!=""||$Record[15]!=""){

$pdf->Ln();
$pdf->SetFont('GB', 'B', 14);
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "授权医生"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "联系电话"), 1, 0, 'L');
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", "签字样张"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "授权医生"), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", "联系电话"), 1, 0, 'L');
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", "签字样张"), 1, 0, 'L');
$pdf->Ln();
$pdf->SetFont('GB', '', 14);
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[12]), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[14]), 1, 0, 'L');
if($Record[12]!=""){
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->Image('./qzyzh/'.sprintf("%03d", $Record[8]).'-4.jpg',$x,$y,18,0);
}
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", ""), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[15]), 1, 0, 'L');
$pdf->Cell(30, 10, iconv("UTF-8", "gbk", $Record[17]), 1, 0, 'L');
if($Record[15]!=""){
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->Image('./qzyzh/'.sprintf("%03d", $Record[8]).'-3.jpg',$x,$y,18,0);
}
$pdf->Cell(35, 10, iconv("UTF-8", "gbk", ""), 1, 0, 'L');

}
}
$pdf->Output("指定医生/授权医生信息导出.pdf",I);
/*$pdf->Output('aa.pdf');
echo "<a href=\"aa.pdf\">右键目标另存为</a>";*/
}else{
exit();
}
?>