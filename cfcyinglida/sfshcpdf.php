<?php session_start(); 
include('newdb.php');
    $id=$_GET['id'];
    $hzhsql = "select * from `hzh` where `id` = '".$id."'";
    $hzhQuery_ID = mysql_query($hzhsql);
    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
    $hzhxm=$hzhRecord[4];
    $hzhzhjhm=$hzhRecord[6];
    $hzhzhjlx=$hzhRecord[5];
    $hzhshqyy=$hzhRecord[9];
    $hzhyy=$hzhRecord[11];
    $hzhzz=$hzhRecord[12];
    $hzhid=$hzhRecord[2];
    $hzhshqzht=$hzhRecord[3];
    }
    $shhejlsql = "select * from `shhejl` where `hzhid`='$id'";
    $shhejlQuery_ID = mysql_query($shhejlsql);
    while($shhejlRecord = mysql_fetch_array($shhejlQuery_ID)){
    $shhrq=$shhejlRecord[4];
    $jjyy=str_ireplace('http://',' http://',$shhejlRecord[5]);
    
    }
    if($hzhid!=''){$hzhwyid='S-'.$hzhid;}
    if($hzhid!=''){$hzhid='S-'.$hzhid;$hzhbmmch="患者唯一编码：";}else {$hzhid=sprintf("%05d", $id); $hzhbmmch="患者申请号：";}
    if($hzhzz!=''){$yyid=$hzhzz;}else if($hzhyy!=""){$yyid=$hzhyy;}else{$yyid=$hzhshqyy;}
    $yysql = "select yymch,zhdysh,yyzhdyf from `yyyshdq` where `id`='".$yyid."'";
    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $yymch=$yyRecord[0];
      $zhdysh=$yyRecord[1];
      $yyzhdyf=$yyRecord[2];
    }
    $yfsql = "select yfmch,yfsheng,yfshi,yfdzh,yfqu from `yf` where `yfmch`='".$yyzhdyf."'";
    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){
    if($yfRecord[1]!=$yfRecord[2]){
    $yfshsh=$yfRecord[1].$yfRecord[2];
    }else{$yfshsh=$yfRecord[1];}
    if($yfRecord[4]!=''&&$yfRecord[4]!="市、县级市"){
    $yfshsh .=$yfRecord[4];
    }
      $lydzh=$yfRecord[0].' '.$yfshsh.$yfRecord[3];
      
    }
    if($lydzh==''){$lydzh=$yyzhdyf;}
//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=".$hzhid."_".$hzhxm."_审核记录表.pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');


$pdf = new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
/*function Footer()
{
    //Go to 1.5 cm from bottom
    $pdf->SetY(-15);
    //Select Arial italic 8
    $pdf->SetFont('Arial','I',8);
    //Print centered page number
    $pdf->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}*/
$pdf->AddPage();
$pdf->SetAutoPageBreak('on' ,'1');//设置自动分页，底部距离1cm
$pdf->SetFont('GB', 'B', 24);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk//IGNORE", "索坦患者援助项目审核记录表"), 0, 0, 'C');


//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk//IGNORE", "一、患者基本信息:"), 0, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(40, 10, iconv("UTF-8", "gbk//IGNORE", "患者姓名"), 1, 0, 'C');
$pdf->Cell(55, 10, iconv("UTF-8", "gbk//IGNORE", $hzhxm ), 1, 0, 'C');
$pdf->Cell(40, 10, iconv("UTF-8", "gbk//IGNORE", $hzhzhjlx.""), 1, 0, 'C');
$pdf->Cell(55, 10, iconv("UTF-8", "gbk//IGNORE", $hzhzhjhm), 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(40, 10, iconv("UTF-8", "gbk//IGNORE", "患者申请号"), 1, 0, 'C');
$pdf->Cell(55, 10, iconv("UTF-8", "gbk//IGNORE", sprintf("%05d", $id) ), 1, 0, 'C');
$pdf->Cell(40, 10, iconv("UTF-8", "gbk//IGNORE", "患者唯一编码"), 1, 0, 'C');

$pdf->Cell(55, 10, iconv("UTF-8", "gbk//IGNORE", $hzhwyid), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(40, 10, iconv("UTF-8", "gbk//IGNORE", "指定医院名称"), 1, 0, 'C');
$pdf->Cell(150, 10, iconv("UTF-8", "gbk//IGNORE", $yymch), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(40, 10, iconv("UTF-8", "gbk//IGNORE", "指定医生姓名"), 1, 0, 'C');
$pdf->Cell(150, 10, iconv("UTF-8", "gbk//IGNORE", $zhdysh ), 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk//IGNORE", "二、审核记录:"), 0, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(20, 12, iconv("UTF-8", "gbk//IGNORE", "收到日期"), 1, 0, 'C');
$pdf->Cell(20, 12, iconv("UTF-8", "gbk//IGNORE", "审核日期"), 1, 0, 'C');
$pdf->Cell(20, 12, iconv("UTF-8", "gbk//IGNORE", "审核人"), 1, 0, 'C');
$pdf->Cell(20, 12, iconv("UTF-8", "gbk//IGNORE", "审核结果"), 1, 0, 'C');
$pdf->Cell(110, 12, iconv("UTF-8", "gbk//IGNORE", "备注"), 1, 0, 'C');

$pdf->Ln();
/*
$shpsql = "select `shdrq`,`shhrrq`,`shhr`,`shhyj`,`wtgyy`,`bzhshm` from `clshh` where hzhid='$id' order by id ASC";
$shpQuery_ID = mysql_query($shpsql);
while($shpRecord = mysql_fetch_array($shpQuery_ID)){
$shdrq = explode(",",$shpRecord[0]);
if($shpRecord[3]==1){$shhyj="材料齐全，通过";}else{
$shhyj="补寄材料";}
$bzh=$shpRecord[5];
$wtgyy=$shpRecord[4];
$wtgyy=str_ireplace('<li style="width:700px; float:left" ><span  style="float:left;">','',$wtgyy);
$wtgyy=str_ireplace('</span></br><span style=" color:red;float:left"><b>',' ',$wtgyy);
$wtgyy=str_ireplace('</span></br><span style=" color:#DF3F00;float:left;"><b>',' ',$wtgyy);
$wtgyy=str_ireplace('</b></span><span  style="float:left;">',',',$wtgyy);
$wtgyy=str_ireplace('</span><span style=" color:#336699;float:left;">','',$wtgyy);
$wtgyy=str_ireplace('</span></li>',';',$wtgyy);

$y = $pdf->gety();
$x = $pdf->getx();
$pdf->MultiCell(30, 16, iconv("UTF-8", "gbk//IGNORE", $shdrq[0] ), 1, 'C');
$pdf->setxy($x+30,$y);
$pdf->MultiCell(30, 16, iconv("UTF-8", "gbk//IGNORE", $shpRecord[1] ), 1,  'C');
$pdf->setxy($x+60,$y);
$pdf->MultiCell(30, 16, iconv("UTF-8", "gbk//IGNORE", $shpRecord[2] ), 1,  'C');
$pdf->setxy($x+90,$y);
$pdf->MultiCell(50, 16, iconv("UTF-8", "gbk//IGNORE", $shhyj ), 1,  'C');
$pdf->setxy($x+140,$y);
$pdf->SetFont('GB', '', 6);
$pdf->MultiCell(50,16, iconv("UTF-8", "gbk//IGNORE", "" ), 1,  'C');
$pdf->setxy($x+140,$y);
$pdf->MultiCell(50,4, iconv("UTF-8", "gbk//IGNORE", $bzh.$wtgyy ), 0,  'L');
$pdf->setxy($x+190,$y+12);
$pdf->SetFont('GB', '', 14);
$pdf->Ln();

}*/

$shhejlsql = "select * from `shhejl` where `hzhid`='".$id."' order by `shhrq` asc";
$shhejlQuery_ID = mysql_query($shhejlsql);
while($shhejlRecord = mysql_fetch_array($shhejlQuery_ID)){


/*function AcceptPageBreak()
{
$y = $pdf->gety();
}
$x = $pdf->getx();*/
$shhyjbzh=str_ireplace('™','',$shhejlRecord[5]);
$shhyjbzh=str_ireplace('http://',' http://',$shhyjbzh);
$shhyjbzh=str_ireplace('患者本人近期1寸照片2张','【患者本人近期1寸照片2张】',$shhyjbzh);
$shhyjbzh=str_ireplace('项目知情同意书第一联','【项目知情同意书第一联】',$shhyjbzh);
$shhyjbzh=str_ireplace('医学条件确认表第一联','【医学条件确认表第一联】',$shhyjbzh);
$shhyjbzh=str_ireplace('首次确诊（局部晚期或转移的非小细胞肺癌）的住院病案首页和出院小结复印件','【首次确诊（局部晚期或转移的非小细胞肺癌）的住院病案首页和出院小结复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('索坦™发票原件（4瓶）','【索坦™发票原件（4瓶）】',$shhyjbzh);
$shhyjbzh=str_ireplace('近期影像学报告单复印件','【近期影像学报告单复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('病理报告及ALK检测报告复印件','【病理报告及ALK检测报告复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('项目申请信息表','【项目申请信息表】',$shhyjbzh);
$shhyjbzh=str_ireplace('患者本人收入证明表','【患者本人收入证明表】',$shhyjbzh);
$shhyjbzh=str_ireplace('患者所有直系亲属收入证明表','【患者所有直系亲属收入证明表】',$shhyjbzh);
$shhyjbzh=str_ireplace('低保户证明复印件','【低保户证明复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('患者本人身份证复印件','【患者本人身份证复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('患者医保卡复印件','【患者医保卡复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('患者所有直系亲属身份证复印件','【患者所有直系亲属身份证复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('患者本人及其直系亲属户口本复印件','【患者本人及其直系亲属户口本复印件】',$shhyjbzh);
$shhyjbzh=str_ireplace('房产证明复印件','【房产证明复印件】',$shhyjbzh);
$hharr=array("\r\n", "\n", "\r");
$shhyjbzh=str_ireplace($hharr,' ',$shhyjbzh);
//$sxhsh=(ceil((strlen($shhyjbzh)/2)/25/3))-1;//所需行数
$sxhsh=(ceil((strlen($shhyjbzh)+mb_strlen($shhyjbzh,'UTF8'))/2/2/25));//所需行数
if($sxhsh>0){$sxhsh_y=$sxhsh*6;}
else{$sxhsh_y=0;}
$pdf->SetFont('GB', '', 10);
$pdf->Cell(20, 6+$sxhsh_y, iconv("UTF-8", "gbk//IGNORE", $shhejlRecord[6]), 1, 0, 'C');

$pdf->Cell(20, 6+$sxhsh_y, iconv("UTF-8", "gbk//IGNORE", $shhejlRecord[4] ), 1, 0,'C');
$pdf->SetFont('GB', '', 12);

if((strlen($shhejlRecord[2])/3)>4){
$pdf->SetFont('GB', 'B', 8);
}
$pdf->Cell(20, 6+$sxhsh_y, iconv("UTF-8", "gbk//IGNORE", $shhejlRecord[2] ), 1, 0, 'C');
if((strlen($shhejlRecord[2])/3)>4){
$pdf->SetFont('GB', '', 12);
}


if($shhejlRecord[3]=="申诉审核"){$shhzhtjl="系统记录的申诉";}
if($shhejlRecord[3]=="申诉待审核"){$shhzhtjl="系统记录的申诉";}
else{$shhzhtjl=$shhejlRecord[3];}

if((strlen($shhzhtjl)/3)>4.4){
$pdf->SetFont('GB', 'B', 8);
}
$pdf->Cell(20, 6+$sxhsh_y, iconv("UTF-8", "gbk//IGNORE", $shhzhtjl ), 1, 0, 'C');
if((strlen($shhzhtjl)/3)>4.4){
$pdf->SetFont('GB', '', 12);
}
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->Cell(110,6+$sxhsh_y, iconv("UTF-8", "gbk//IGNORE", "" ), 1, 0,  'C');
$pdf->setxy($x,$y);
    //$shhyjbzh=str_ireplace(' http://','http://',$shhyjbzh);
$pdf->MultiCell(110,6, iconv("UTF-8", "gbk//IGNORE", $shhyjbzh ), 0,  'L');
//$pdf->write(110,iconv("UTF-8", "gbk//IGNORE", $shhyjbzh ));
$pdf->setxy($x+110,$y+$sxhsh_y);

$pdf->Ln();

}

$pdf->SetFont('GB', 'B', 12);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk//IGNORE", "三、索坦患者援助项目办公室审核意见:"), 0, 0, 'L');


$pdf->Ln();
$pdf->SetFont('GB', '', 12);
if($hzhshqzht=="申诉审核"){$hzhshqzht="系统记录的申诉";}if($hzhshqzht=="申诉待审核"){$hzhshqzht="系统记录的申诉";}else{$hzhshqzht=$hzhshqzht;}
$pdf->Cell(40, 32, iconv("UTF-8", "gbk//IGNORE", $hzhshqzht), 1, 0, 'C');
$pdf->Cell(150, 16, iconv("UTF-8", "gbk//IGNORE", $hzhbmmch.$hzhid), 1, 0, 'C');

$pdf->Ln();
$y = $pdf->gety();
$x = $pdf->getx();
if($hzhshqzht!='拒绝'&&$hzhshqzht!='停止申请'&&$hzhshqzht!='申诉拒绝'){
$pdf->Cell(40, 0, iconv("UTF-8", "gbk//IGNORE", ""), 0, 0, 'C');
$pdf->SetFont('GB', '', 12);
$pdf->Cell(150, 16, iconv("UTF-8", "gbk//IGNORE", "领药地点: ".$lydzh), 1, 0, 'L');
}
else{
$pdf->SetFont('GB', '', 8);
$pdf->setxy($x+40,$y);
$pdf->MultiCell(150,16, iconv("UTF-8", "gbk//IGNORE", "" ), 1,  'C');
$pdf->setxy($x+40,$y);
    //$jjyy=str_ireplace(' http://','http://',$jjyy);
$pdf->MultiCell(150, 4, iconv("UTF-8", "gbk//IGNORE", "原因: ".$jjyy ), 0,  'L');
}

$pdf->SetFont('GB', '', 12);




/*
$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk//IGNORE", ""), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk//IGNORE", "审批人签字:"), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk//IGNORE", ""), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk//IGNORE", "日期: ".$shhrq), 0, 0, 'L');*/


$pdf->Output($hzhid."_".$hzhxm."_审核记录表.pdf",I);


/*$pdf->Output('aa.pdf');
echo "<a href=\"aa.pdf\">右键目标另存为</a>";*/

?>