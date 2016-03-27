<?php session_start(); 
include('newdb.php');
$id=$_GET['id'];
$blshsql = "select * from `blshj` where id='$id'";
$blshQuery_ID = mysql_query($blshsql);
while($blshRecord = mysql_fetch_array($blshQuery_ID)){
 $sql = "select * from `hzh` where id='$blshRecord[1]' ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $shchhzhxm=$Record[4];
  }
}
//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=AE-".$id."_".$shchhzhxm.".pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');

$blshsql = "select * from `blshj` where id='$id'";
$blshQuery_ID = mysql_query($blshsql);
while($blshRecord = mysql_fetch_array($blshQuery_ID)){

$pdf = new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 18, iconv("UTF-8", "gbk", "中国癌症基金会（CFC）赛可瑞患者援助项目（XPAP） CEP ID：4895"), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('GB', 'B', 20);
$pdf->Cell(190, 16, iconv("UTF-8", "gbk", "不良事件报告表"), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('GB', '', 16);
$pdf->Cell(120,8, iconv("UTF-8", "gbk", "必须于获知不良事件后24h内报告"), 0, 0, 'R');
$pdf->Cell(50,8, iconv("UTF-8", "gbk", "编号：").$id, 0, 0, 'R');
//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "患者资料"), 1, 0, 'L');
 $sql = "select * from `hzh` where id='$blshRecord[1]' ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
if($Record[2]!=''){$hzhwybm="X-".$Record[2];$hzhbmmch="患者唯一编码：";}else{$hzhwybm=sprintf("%05d", $Record[0]);$hzhbmmch="患者申请号：";}
$pdf->Cell(94, 10, iconv("UTF-8", "gbk", $hzhbmmch.$hzhwybm), 0, 0, 'L');
$pdf->Cell(94, 10, iconv("UTF-8", "gbk", "患者姓名：$Record[4]"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');

$pdf->Ln();
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(94, 10, iconv("UTF-8", "gbk", "性别：$Record[37]"), 0, 0, 'L');
$pdf->Cell(94, 10, iconv("UTF-8", "gbk", "患者出生日期：$Record[38]"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');

$pdf->Ln();
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(94, 10, iconv("UTF-8", "gbk", "适应症：肺癌"), 0, 0, 'L');
if($Record[34]!=''){$hzhrzshj=$Record[34];}else{$hzhrzshj="未入组";}
$pdf->Cell(94, 10, iconv("UTF-8", "gbk", "入组时间：".$hzhrzshj), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');
          $rzyysql = "select zhdysh,yymch,yyksh from `yyyshdq` where ";
          if($blshRecord[11]!=''){
          $rzyysql .= " id='".$blshRecord[11]."'";
          }else if($Record[12]!=''){
          $rzyysql .= " id='".$Record[12]."'";
          }else if($Record[11]!=''){
          $rzyysql .= " id='".$Record[11]."'";
          }else if($Record[9]!=''){
          $rzyysql .= " id='".$Record[9]."'";
          }
          /*echo $rzyysql;*/
          $rzyyQuery_ID = mysql_query($rzyysql);
          while($rzyyRecord = mysql_fetch_array($rzyyQuery_ID)){
            $zhdysh=$rzyyRecord[0];
            $zhdyymch=$rzyyRecord[1]." ".$rzyyRecord[2];
          }
  }

$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "该事件信息来源"), 1, 0, 'L');
                if($blshRecord[2]=="0"){
                $shjxxlz="医生";
                }else  if($blshRecord[2]=="1"){
                $shjxxlz="患者";
                }else  if($blshRecord[2]=="2"){
                $shjxxlz="患者家属";
                }
$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "该事件信息来自$shjxxlz"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');
                $yshshf="医生是否愿意接受随访：";
                if($blshRecord[2]=="0"){
                  if($blshRecord[3]=="0"){
                    $yshshf.="否";
                  }else{
                    $yshshf.="是";
                    $yshshf1="医生姓名：".$zhdysh."   医院名称（科室）：".$zhdyymch."";
                  }
                }else{
                  if($blshRecord[3]=="0"){
                    $yshshf.="无法提供医生联系方式";
                  }else{
                    $yshshf.="是";
                    $yshshf1="医生姓名：".$zhdysh."   医院名称（科室）：".$zhdyymch."";
                  }
                }
$pdf->Ln();
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "$yshshf"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');
$pdf->Ln();
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "$yshshf1"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "赛可瑞用量及用法"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "$blshRecord[4]"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(20, 10, iconv("UTF-8", "gbk", "事件描述"), 'L,T,B', 0, 'L');
$pdf->SetFont('GB', '', 8);
$pdf->Cell(170, 10, iconv("UTF-8", "gbk", "（包括既往病史、合并用药、相关实验室检查结果及不良事件转归等，如需更多地方填写，可另附一张表格）"), 'R,T,B', 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "$blshRecord[5]"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "CFC获知不良事件的日期"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", date('Y年m月d日',strtotime($blshRecord[6]))), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');

if($blshRecord[7]=="1"){$shfchx="是";}else if($blshRecord[7]=="0"){$shfchx="否";}else if($blshRecord[7]=="2"){$shfchx="不详";}

$pdf->Ln();
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "赛可瑞治疗是否仍持续：$shfchx"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');


$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "报告至辉瑞中国药物安全部门的日期"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", date('Y年m月d日',strtotime($blshRecord[8]))), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');


$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "CFC 填表人信息"), 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "L", 0, 'C');
$pdf->Cell(188, 10, iconv("UTF-8", "gbk", "CFC填表人签名：$blshRecord[9]"), 0, 0, 'L');
$pdf->Cell(1, 10, iconv("UTF-8", "gbk", ""), "R", 0, 'C');
$pdf->Ln();
$pdf->Cell(190,0, iconv("UTF-8", "gbk", ""), 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('GB', 'B', 12);
$pdf->Cell(190, 10, iconv("UTF-8", "gbk", "版本生效日：2013年11月27日"), 0, 0, 'R');

$pdf->Output("AE-".$id."_".$shchhzhxm.".pdf",I);
/*$pdf->Output('aa.pdf');
echo "<a href=\"aa.pdf\">右键目标另存为</a>";*/
}
?>