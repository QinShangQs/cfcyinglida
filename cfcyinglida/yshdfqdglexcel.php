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
$k1="中国癌症基金会赛可瑞™患者援助项目待发清单";  
$k2="患者编码";  
$k3="患者姓名";  
$k4="患者证件号码";  
$k5="联系电话";   
$k6="已领赠药次数、瓶数";  
$k7="上次赠药规格";  
$k8="预估下次发药日期";  
$k9="入组医院";  
$k10="直系亲属";  //后期调整全部姓名就行。 证件号码不要了
//$k11="证件号码";  
  
$objExcel->getActiveSheet()->mergeCells( 'A1:I1' );
/*$objExcel->getActiveSheet()->mergeCells( 'A4:C4' );
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
$objExcel->getActiveSheet()->setCellValue('A2', "$k2"); 
$objExcel->getActiveSheet()->setCellValue('B2', "$k3"); 
$objExcel->getActiveSheet()->setCellValue('C2', "$k4"); 
$objExcel->getActiveSheet()->setCellValue('D2', "$k5"); 
$objExcel->getActiveSheet()->setCellValue('E2', "$k6");
 
$objExcel->getActiveSheet()->setCellValue('F2', "$k7"); 
$objExcel->getActiveSheet()->setCellValue('G2', "$k8"); 
$objExcel->getActiveSheet()->setCellValue('H2', "$k9"); 
$objExcel->getActiveSheet()->setCellValue('I2', "$k10"); 
//$objExcel->getActiveSheet()->setCellValue('J2', "$k11"); 
 //设置font
$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(14);
$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

//设置c 列 身份证号码
    //$objExcel->getActiveSheet()->getStyle('c')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);//文本
    //$objExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);//

Mysql_connect("localhost","root","117791536");
Mysql_select_db("CFCSYSTEM");
mysql_query("set names utf8");
$sqlchfq=explode("limit",$_SESSION[ygfysql]);
$sql=$sqlchfq[0];
  //$sql = "select * from `hzh`";
  $jshi=3;
  
$ztshq=mysql_query($sql);
$ztsh = mysql_num_rows($ztshq);//获取总条数
$ztsh=$ztsh+2;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){

  $hzhygshcyyshj=$Record[35];//预估首次赠药日期
  $hzhjzhlx=$Record[25];//捐助类型
  //$hzhjzhshl=$Record[26];
  
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
    $objExcel->getActiveSheet()->setCellValue('a'.$jshi, "X-".$Record[2]);  
    $objExcel->getActiveSheet()->setCellValue('b'.$jshi,  $Record[4]);  


    $objExcel->getActiveSheet()->setCellValue('c'.$jshi, $Record[6]." "); 
    $objExcel->getActiveSheet()->setCellValue('d'.$jshi, $Record[15]); 
    
    $lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){if($lyshlnum[0]!=""){$psh=$lyshlnum[0];}else{$psh= "0";}}
   
    $objExcel->getActiveSheet()->setCellValue('e'.$jshi, $lynum."次/".$psh."瓶");  
    

if($lynum=="0"){
  if($hzhygshcyyshj!=""){$ygxcfyrq=  date('Y-m-d',strtotime('-7 day',strtotime($hzhygshcyyshj)));
  }else{$ygxcfyrq= "日期错误";}
}

else if($lynum>"0"){
  if($ygxcfyrqshj!=""){
  $ygxcfyrq= $ygxcfyrqshj;
  
  }else {$ygxcfyrq= "日期错误";}
}
if($hzhfyjl==1){$hzhfyjlgg="200mg*1瓶";$hzhfyjl=0;}else if($hzhfyjl==2){$hzhfyjlgg="250mg*1瓶";$hzhfyjl=0;}else {$hzhfyjlgg="";}
    $objExcel->getActiveSheet()->setCellValue('f'.$jshi, $hzhfyjlgg); 
    $objExcel->getActiveSheet()->setCellValue('g'.$jshi, $ygxcfyrq);  
    
      $yysql = "select sheng,shi,qu,yymch,zhdysh from `yyyshdq` where id='".$Record[9]."'";
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
        $yzyy=$yyRecord[3]." ".$yyRecord[4];
      }
    
    $objExcel->getActiveSheet()->setCellValue('h'.$jshi, $yzyy);   

  $zhxqshsql = "select * from `zhxqsh` where `hzhid`='".$Record[0]."' and `gxzf`<>'0' order by id DESC";
//echo $sql;
$hzhzhxqsh="";
  $zhxqshQuery_ID = mysql_query($zhxqshsql);
  while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
      $hzhzhxqsh.=$zhxqshRecord[2]." ";
    //$objExcel->getActiveSheet()->setCellValue('j'.$jshi, $zhjhm );  
}$objExcel->getActiveSheet()->setCellValue('i'.$jshi, $hzhzhxqsh );
 
    $jshi++;  

  }


$objExcel->getActiveSheet()->getStyle('A1:I'.$ztsh)->getAlignment()->setWrapText(true);//自动换行
/*$objExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);//自动换行*/
//$objExcel->getActiveSheet()->getStyle('J2')->getAlignment()->setWrapText(true);//自动换行

  
// 高置列的宽度  
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);    
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);    
//$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);    

  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');  
  
// 设置页方向和规模  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);  
$objExcel->setActiveSheetIndex(0);  

if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="待发清单-'.date('Y-m-d').'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="待发清单-'.date('Y-m-d').'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>