<?php  session_start(); 
//include('newdb.php');
date_default_timezone_set('prc');

require_once 'PHPExcel_1.7.9_doc/Classes/PHPExcel.php';  
require_once 'PHPExcel_1.7.9_doc/Classes/phpExcel/Writer/Excel2007.php';  
require_once 'PHPExcel_1.7.9_doc/Classes/phpExcel/Writer/Excel5.php';  
include_once 'PHPExcel_1.7.9_doc/Classes/phpExcel/IOFactory.php';  
  
$objExcel = new PHPExcel();  
//设置属性 (这段代码无关紧要，其中的内容可以替换为你需要的)  
$objExcel->getProperties()->setCreator("andy");  
$objExcel->getProperties()->setLastModifiedBy("andy");  
$objExcel->getProperties()->setTitle("Office 2003 XLS Test Document");  
$objExcel->getProperties()->setSubject("Office 2003 XLS Test Document");  
$objExcel->getProperties()->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");  
$objExcel->getProperties()->setKeywords("office 2003 openxml php");  
$objExcel->getProperties()->setCategory("Test result file");  
$objExcel->setActiveSheetIndex(0);  
  
$i=0;  
//表头  
$k1="姓名";  
$k2="状态";  
$k3="身份证号码";  
$k4="性别";  
$k5="出生日期";   
$k6="通讯地址";  
$k7="患者手机";  
$k8="第一联系人电话";  
$k9="户籍类型";  
$k10="医保类型";  
$k11="参保地区";  
$k12="家庭人口";  
$k13="家庭年收入";  
$k14="人均收入";  
$k15="申请来源";  
$k16="申请号";  
$k17="申请城市";  
$k18="申请医院";  
$k19="申请医生";  
$k20="临床诊断";  
$k21="诊断日期";  
$k22="病理类型";  
$k23="ALK检测方法";  
$k24="ALK检测结果";  
$k25="赛可瑞开始治疗日期";  
$k26="赛可瑞剂量";  
$k27="用药方法";  
$k28="首次材料登记日期";  
$k29="初次审核日期";  
$k30="批准日期";  
$k31="审核时长";  
$k32="入组日期";  
$k33="捐赠类型";  
$k34="患者编码";  
$k35="入组城市";  
$k36="入组医院";  
$k37="入组医生";  
$k38="退出日期";  
$k39="退出原因";  
$k40="随访次数";  
$k41="领取赠药数量250mg（瓶）";  
$k42="领取赠药数量200mg（瓶）";  
$k43="赛可瑞获益时长（天）";  
$k44="XPAP获益时长（天）";  
$k45="入组前疗效评估";  
$k46="AE获知日期";  
$k47="AE事件描述";  

 
  
/*$objExcel->getActiveSheet()->mergeCells( 'A1:I1' );
$objExcel->getActiveSheet()->mergeCells( 'A4:C4' );
$objExcel->getActiveSheet()->mergeCells( 'D4:E4' );
$objExcel->getActiveSheet()->mergeCells( 'F4:H4' );
$objExcel->getActiveSheet()->mergeCells( 'A5:C5' );
$objExcel->getActiveSheet()->mergeCells( 'D5:E5' );
$objExcel->getActiveSheet()->mergeCells( 'F5:H5' );
$objExcel->getActiveSheet()->mergeCells( 'A6:C6' );
$objExcel->getActiveSheet()->mergeCells( 'D6:E6' );
$objExcel->getActiveSheet()->mergeCells( 'F6:H6' );
$objExcel->getActiveSheet()->mergeCells( 'A2:J2' );
$objExcel->getActiveSheet()->mergeCells( 'A1:A2' );*/

//$objExcel->getActiveSheet()->mergeCellsByColumnAndRow( 'A1:A2' );
$objExcel->getActiveSheet()->setCellValue('A1', "$k1"); 
$objExcel->getActiveSheet()->setCellValue('B1', "$k2"); 
$objExcel->getActiveSheet()->setCellValue('C1', "$k3"); 
$objExcel->getActiveSheet()->setCellValue('D1', "$k4"); 
$objExcel->getActiveSheet()->setCellValue('E1', "$k5"); 
$objExcel->getActiveSheet()->setCellValue('F1', "$k6"); 
$objExcel->getActiveSheet()->setCellValue('G1', "$k7"); 
$objExcel->getActiveSheet()->setCellValue('H1', "$k8"); 
$objExcel->getActiveSheet()->setCellValue('I1', "$k9"); 
$objExcel->getActiveSheet()->setCellValue('J1', "$k10");  
$objExcel->getActiveSheet()->setCellValue('K1', "$k11");  
$objExcel->getActiveSheet()->setCellValue('L1', "$k12");  
$objExcel->getActiveSheet()->setCellValue('M1', "$k13");  
$objExcel->getActiveSheet()->setCellValue('N1', "$k14");  
$objExcel->getActiveSheet()->setCellValue('O1', "$k15");  
$objExcel->getActiveSheet()->setCellValue('P1', "$k16");  
$objExcel->getActiveSheet()->setCellValue('Q1', "$k17");  
$objExcel->getActiveSheet()->setCellValue('R1', "$k18");  
$objExcel->getActiveSheet()->setCellValue('S1', "$k19");  
$objExcel->getActiveSheet()->setCellValue('T1', "$k20");  
$objExcel->getActiveSheet()->setCellValue('u1', "$k21");  
$objExcel->getActiveSheet()->setCellValue('V1', "$k22");  
$objExcel->getActiveSheet()->setCellValue('W1', "$k23");  
$objExcel->getActiveSheet()->setCellValue('X1', "$k24");  
$objExcel->getActiveSheet()->setCellValue('Y1', "$k25");  
$objExcel->getActiveSheet()->setCellValue('Z1', "$k26");  
$objExcel->getActiveSheet()->setCellValue('AA1', "$k27");  
$objExcel->getActiveSheet()->setCellValue('AB1', "$k28");  
$objExcel->getActiveSheet()->setCellValue('AC1', "$k29");
$objExcel->getActiveSheet()->setCellValue('AD1', "$k30");
$objExcel->getActiveSheet()->setCellValue('AE1', "$k31");
$objExcel->getActiveSheet()->setCellValue('AF1', "$k32");
$objExcel->getActiveSheet()->setCellValue('AG1', "$k33");
$objExcel->getActiveSheet()->setCellValue('AH1', "$k34");
$objExcel->getActiveSheet()->setCellValue('AI1', "$k35");
$objExcel->getActiveSheet()->setCellValue('AJ1', "$k36");
$objExcel->getActiveSheet()->setCellValue('AK1', "$k37");
$objExcel->getActiveSheet()->setCellValue('AL1', "$k38");
$objExcel->getActiveSheet()->setCellValue('AM1', "$k39");
$objExcel->getActiveSheet()->setCellValue('AN1', "$k40");
$objExcel->getActiveSheet()->setCellValue('AO1', "$k41");
$objExcel->getActiveSheet()->setCellValue('AP1', "$k42");
$objExcel->getActiveSheet()->setCellValue('AQ1', "$k43");
$objExcel->getActiveSheet()->setCellValue('AR1', "$k44");
$objExcel->getActiveSheet()->setCellValue('AS1', "$k45");
$objExcel->getActiveSheet()->setCellValue('AT1', "$k46");
$objExcel->getActiveSheet()->setCellValue('AU1', "$k47");

//$k48="第一次领取赠药日期";  
$k49="赛可瑞剂量";  
$k50="用药方法";  
$k51="疗效评估";  
$k52="AE发生时间";  
$k53="AE事件描述";
$lrlksh='av';
for($lrli=1;$lrli<=8;$lrli++){
$objExcel->getActiveSheet()->setCellValue(($lrlksh++).'1', "第".$lrli."次领取赠药日期");
$objExcel->getActiveSheet()->setCellValue(($lrlksh++).'1', "$k49");
$objExcel->getActiveSheet()->setCellValue(($lrlksh++).'1', "$k50");
$objExcel->getActiveSheet()->setCellValue(($lrlksh++).'1', "$k51");
$objExcel->getActiveSheet()->setCellValue(($lrlksh++).'1', "$k52");
$objExcel->getActiveSheet()->setCellValue(($lrlksh++).'1', "$k53");
}
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A1:BA1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('A1:BA1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

//设置c 列 身份证号码
//$objExcel->getActiveSheet()->getStyle('c')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);//文本
$objExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);//

Mysql_connect("localhost","root","117791536");
Mysql_select_db("CFCSYSTEM");
mysql_query("set names utf8");
$sql = "select * from `hzh`";
  $jshi=2;

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){

            //读取次数
$lynumq=mysql_query("SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='".$Record[0]."'");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}

$nowdate=date('Y-m-d');
$nowdate_List=explode("-",$nowdate);
$nowdate_d=mktime(0,0,0,$nowdate_List[1],$nowdate_List[2],$nowdate_List[0]);
if($lynum=="0"){

} 
else if($lynum>"0"){
  $ygxcfyrqq=mysql_query("SELECT ygxcfyrq,fyjl FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' order by id DESC limit 0,1");
  while($ygxcfyrq = mysql_fetch_array($ygxcfyrqq)){
  $ygxcfyrqshj=$ygxcfyrq[0];
  $hzhfyjl=$ygxcfyrq[1];
  }

}  
  
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('a'.$jshi, $Record[4]);  
    $objExcel->getActiveSheet()->setCellValue('b'.$jshi, $Record[3]);
    $objExcel->getActiveSheet()->setCellValue('c'.$jshi, $Record[6]); 
    $objExcel->getActiveSheet()->setCellValue('d'.$jshi, $Record[37]); 
    $objExcel->getActiveSheet()->setCellValue('e'.$jshi, $Record[38]); 
    $objExcel->getActiveSheet()->setCellValue('f'.$jshi, $Record[14]); 
    $objExcel->getActiveSheet()->setCellValue('g'.$jshi, $Record[15]); 
    $objExcel->getActiveSheet()->setCellValue('h'.$jshi, $Record[16]); 
    $objExcel->getActiveSheet()->setCellValue('i'.$jshi, $Record[19]); 
    $objExcel->getActiveSheet()->setCellValue('j'.$jshi, $Record[23]); 
    $objExcel->getActiveSheet()->setCellValue('k'.$jshi, $Record[24]); 
    $objExcel->getActiveSheet()->setCellValue('l'.$jshi, $Record[20]); 
    $objExcel->getActiveSheet()->setCellValue('m'.$jshi, $Record[21]); 
    $objExcel->getActiveSheet()->setCellValue('n'.$jshi, $Record[22]); 
    if($Record[45]==1){$hzhshqly='网上申请';}else{$hzhshqly='线下申请';}
    $objExcel->getActiveSheet()->setCellValue('o'.$jshi, $hzhshqly); 
    $objExcel->getActiveSheet()->setCellValue('p'.$jshi, sprintf("%05d", $Record[0])); 
    //获得申请信息
    $yysql = "select shi,yymch,zhdysh from `yyyshdq` where id='".$Record[9]."'";
    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $shqchsh=$yyRecord[0];
      $shqyy=$yyRecord[1];
      $shqysh=$yyRecord[2];
    }
      
    $objExcel->getActiveSheet()->setCellValue('q'.$jshi, $shqchsh); 
    $objExcel->getActiveSheet()->setCellValue('r'.$jshi, $shqyy); 
    $objExcel->getActiveSheet()->setCellValue('s'.$jshi, $shqysh); 
    //清空申请信息
      $shqchsh='';
      $shqyy='';
      $shqysh='';
      
    //获得医学评估信息
    $yxpgsql = "select * from `yxpgbg` where `hzhid`='".$Record[0]."' and `bglx`='1'";
    $yxpgQuery_ID = mysql_query($yxpgsql);
    while($yxpgRecord = mysql_fetch_array($yxpgQuery_ID)){
      $yxpglchzhd=$yxpgRecord[4];//"临床诊断"
      $yxpgzhdrq=$yxpgRecord[5];//"诊断日期"
      $yxpgbllx=$yxpgRecord[6];//"病理类型"
      $yxpgalkjcff=$yxpgRecord[9];//"ALK检测方法"
      $yxpgalkjcjg=$yxpgRecord[8];//"ALK检测结果"
      $yxpgskrkshzhlrq=$yxpgRecord[11];//"赛可瑞开始治疗日期"
      $yxpgskrlxpg=$yxpgRecord[13];//"赛可瑞疗效评估"
    }      
      
    $objExcel->getActiveSheet()->setCellValue('t'.$jshi, $yxpglchzhd); 
    $objExcel->getActiveSheet()->setCellValue('u'.$jshi, $yxpgzhdrq); 
    $objExcel->getActiveSheet()->setCellValue('v'.$jshi, $yxpgbllx); 
    $objExcel->getActiveSheet()->setCellValue('w'.$jshi, $yxpgalkjcff); 
    $objExcel->getActiveSheet()->setCellValue('x'.$jshi, $yxpgalkjcjg); 
    $objExcel->getActiveSheet()->setCellValue('y'.$jshi, $yxpgskrkshzhlrq); 
    
    //获得塞克瑞获益时长 今天日期-开始治疗日期
    $dtrq=date('Y-m-d');
    if($yxpgskrkshzhlrq!=""){
      $skrhyshch=round((strtotime($dtrq)-strtotime($yxpgskrkshzhlrq))/3600/24);
    }else if($Record[45]!=""){
      $skrhyshch=round((strtotime($dtrq)-strtotime($Record[45]))/3600/24);
    }else if($Record[32]!=""){
      $skrhyshch=round((strtotime($dtrq)-strtotime($Record[32]))/3600/24);
    }
    //获得XPAP获益时长 今天日期-入组日期
    $dtrq=date('Y-m-d');
    if($Record[34]!=""){
      $xpaphyshch=round((strtotime($dtrq)-strtotime($Record[34]))/3600/24);
    }
    //清空医学评估信息
      $yxpglchzhd='';//"临床诊断"
      $yxpgzhdrq='';//"诊断日期"
      $yxpgbllx='';//"病理类型"
      $yxpgalkjcff='';//"ALK检测方法"
      $yxpgalkjcjg='';//"ALK检测结果"
      $yxpgskrkshzhlrq='';//"赛可瑞开始治疗日期"
    $objExcel->getActiveSheet()->setCellValue('z'.$jshi, $Record[28]);
    $objExcel->getActiveSheet()->setCellValue('aa'.$jshi, $Record[29]);  
    $objExcel->getActiveSheet()->setCellValue('ab'.$jshi, $Record[43]);
    $objExcel->getActiveSheet()->setCellValue('ac'.$jshi, $Record[32]);
    if($Record[33]!=''){$hzhpzhrq=$Record[33];}else if($Record[34]!=''){$hzhpzhrq=$Record[34];}else if($Record[48]!=''){$hzhpzhrq=$Record[48];}else if($Record[47]!=''){$hzhpzhrq=$Record[47];} else{$hzhpzhrq="";}
    $objExcel->getActiveSheet()->setCellValue('ad'.$jshi, $hzhpzhrq);
    if($hzhpzhrq!=''){$hzhshhshch=round((strtotime($hzhpzhrq)-strtotime($Record[43]))/3600/24);}else{$hzhshhshch='';} 
    $objExcel->getActiveSheet()->setCellValue('ae'.$jshi, $hzhshhshch); 
    $objExcel->getActiveSheet()->setCellValue('af'.$jshi, $Record[34]); 
    $objExcel->getActiveSheet()->setCellValue('ag'.$jshi, $Record[25]); 
    //患者编码
    if($Record[2]!=''){$hzhbm="X-".sprintf("%05d", $Record[2]);}else{$hzhbm="";}
    
    $objExcel->getActiveSheet()->setCellValue('ah'.$jshi, $hzhbm); 
    
    //获得入组信息
    $rzyysql = "select shi,yymch,zhdysh from `yyyshdq` where id='".$Record[11]."'";
    $rzyyQuery_ID = mysql_query($rzyysql);
    while($rzyyRecord = mysql_fetch_array($rzyyQuery_ID)){
      $rzchsh=$rzyyRecord[0];
      $rzyy=$rzyyRecord[1];
      $rzysh=$rzyyRecord[2];
    }
    $objExcel->getActiveSheet()->setCellValue('ai'.$jshi, $rzchsh); 
    $objExcel->getActiveSheet()->setCellValue('aj'.$jshi, $rzyy); 
    $objExcel->getActiveSheet()->setCellValue('ak'.$jshi, $rzysh); 
    //清空入组医院信息
      $rzchsh='';
      $rzyy='';
      $rzysh='';
    if($Record[41]!=''){$hzhtchrq=$Record[41];$hzhtchshm=$Record[42];}else if($Record[48]!=''){$hzhtchrq=$Record[48];$hzhtchshm=$Record[49];}else if($Record[47]!=''){$hzhtchrq=$Record[47];$hzhtchshm=$Record[49];}else{$hzhtchrq="";$hzhtchshm="";}  
    $objExcel->getActiveSheet()->setCellValue('al'.$jshi, $hzhtchrq); 
    $objExcel->getActiveSheet()->setCellValue('am'.$jshi, $hzhtchshm); 
    //领药就随访所以随访次数是领药次数
    $lynumq=mysql_query("SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='".$Record[0]."'");
    $lynum = mysql_num_rows($lynumq);//获取总条数
    if($lynum==""){$lynum="0";}
    
    $objExcel->getActiveSheet()->setCellValue('an'.$jshi, $lynum); 
    //清空领药次数
    $lynum="";
    
    //获取领药数量
    $lyshl1numq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' and `fyjl`='1'");
  while($lyshl1num = mysql_fetch_array($lyshl1numq)){if($lyshl1num[0]!=""){$psh1=$lyshl1num[0];}else{$psh1= "0";}}
    $lyshl2numq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' and `fyjl`='2'");
  while($lyshl2num = mysql_fetch_array($lyshl2numq)){if($lyshl2num[0]!=""){$psh2=$lyshl2num[0];}else{$psh2= "0";}}
  
    $objExcel->getActiveSheet()->setCellValue('ao'.$jshi, $psh2); 
    $objExcel->getActiveSheet()->setCellValue('ap'.$jshi, $psh1); 
    //清空领药瓶数
    $psh1='';
    $psh2='';
    
    $objExcel->getActiveSheet()->setCellValue('aq'.$jshi, $skrhyshch); 
    //清空塞克瑞获益时长
    $skrhyshch='';
    
    $objExcel->getActiveSheet()->setCellValue('ar'.$jshi, $xpaphyshch); 
    //清空XPAP获益时长
    $xpaphyshch='';
    $objExcel->getActiveSheet()->setCellValue('as'.$jshi, $yxpgskrlxpg); 
    //清空疗效评估
    $yxpgskrlxpg='';//"赛可瑞疗效评估"
    $objExcel->getActiveSheet()->setCellValue('at'.$jshi, ""); 
    $objExcel->getActiveSheet()->setCellValue('au'.$jshi, ""); 
    $lwbm='av';
$hzhlyq=mysql_query("SELECT * FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."'");
while($hzhlyrs = mysql_fetch_array($hzhlyq)){
    $objExcel->getActiveSheet()->setCellValue(($lwbm++).$jshi, $hzhlyrs[20]); //"第一次领取赠药日期"
    if($hzhlyrs[5]==1){$hzhlyyyjl='200mg/60粒';}else{$hzhlyyyjl='250mg/60粒';}
    $objExcel->getActiveSheet()->setCellValue(($lwbm++).$jshi, $hzhlyyyjl); //"赛可瑞剂量"
    $objExcel->getActiveSheet()->setCellValue(($lwbm++).$jshi, $Record[29]); //"用药方法"
    $objExcel->getActiveSheet()->setCellValue(($lwbm++).$jshi, "疗效评估"); //"疗效评估"
    $objExcel->getActiveSheet()->setCellValue(($lwbm++).$jshi, "AE发生时间");//"AE发生时间"
    $objExcel->getActiveSheet()->setCellValue(($lwbm++).$jshi, "AE事件描述");//"AE事件描述"
}

    $jshi++;  

  }


//$objExcel->getActiveSheet()->getStyle('A1:BA10')->getAlignment()->setWrapText(true);//自动换行


  
// 高置列的宽度  
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);    
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);    
//$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);    

  
  
// 设置页方向和规模  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);  
$objExcel->setActiveSheetIndex(0);  

if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="XPAP患者数据导出-'.date('Y-m-d').'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="XPAP患者数据导出-'.date('Y-m-d').'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>