<?php  session_start(); 
/*@header('Content-type: text/html;charset=utf-8');
echo $_SESSION[ygfyglsql];exit();*/
//include('newdb.php');
set_time_limit(0);
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
$k1="中国癌症基金会索坦患者援助项目药品发放明细";  
$k2="发药日期";  
$k3="发药瓶数";  
$k4="交回空瓶/交回余药";  
$k5="空瓶、余药状态";   
$k6="患者编码";  
$k7="患者姓名";  
$k8="领药人";  
$k9="患者电话";  
$k10="药师";  
  
$objExcel->getActiveSheet()->mergeCells( 'A1:H1' );
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
$objExcel->getActiveSheet()->setCellValue('J2', "$k11"); 
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

Mysql_connect("localhost","root","xx.13579");
Mysql_select_db("cfcyinglida");
mysql_query("set names utf8");
$sqlchfq=explode("limit",$_SESSION[ygfyglsql]);
$sql=$sqlchfq[0];
  //$sql = "select * from `hzh`";
  $jshi=3;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){ 
  
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('a'.$jshi, $Record[20]);  
    $objExcel->getActiveSheet()->setCellValue('b'.$jshi, $Record[4]);  

if($Record[7]!=""){$jhkpyyshl=$Record[7]."/";}else{$jhkpyyshl="0/";}
if($Record[8]!=""){$jhkpyyshl.=$Record[8];}else{$jhkpyyshl.="0";}
    $objExcel->getActiveSheet()->setCellValue('c'.$jshi, $jhkpyyshl); 
    
    if($Record[23]!=""){$kpyyzht="瓶:";if($Record[23]=="1"){$kpyyzht.="在药房";}else if($Record[23]=="2"){$kpyyzht.="在CFC";}else{$kpyyzht.="在国大";}$kpyyzht.="/";}else{$kpyyzht.="无/";}
    if($Record[24]!=""){$kpyyzht.="药:";if($Record[24]=="1"){$kpyyzht.="在药房";}elseif($Record[24]=="2"){$kpyyzht.="在CFC";}else{$kpyyzht.="在国大";} }else{$kpyyzht.="无";}    
        $objExcel->getActiveSheet()->setCellValue('d'.$jshi, $kpyyzht); 
        
  $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
  $hzhshj=$hzhRecord[2];
    $hzhrzbm="S-".$hzhRecord[0];
    $hzhxm=$hzhRecord[1];
  } 
    $objExcel->getActiveSheet()->setCellValue('e'.$jshi, $hzhrzbm);  
    $objExcel->getActiveSheet()->setCellValue('f'.$jshi, $hzhxm); 
    
    
    if($Record[9]!='0'){
  $zhxqshsql = "select `xm`,`lxfsh` from `zhxqsh` where `id`='".$Record[9]."'";
  //echo $zhxqshsql;
  $zhxqshQuery_ID = mysql_query($zhxqshsql);
  while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
    $zhxqshxm=$zhxqshRecord[0];
    $zhxqshlxfsh=$zhxqshRecord[1];
  }
  }else{$zhxqshxm="本人";$zhxqshlxfsh=$hzhshj;}
    $objExcel->getActiveSheet()->setCellValue('g'.$jshi, $zhxqshxm);  
    $objExcel->getActiveSheet()->setCellValue('h'.$jshi, $zhxqshlxfsh);   

    $objExcel->getActiveSheet()->setCellValue('i'.$jshi, $Record[18] );  
 
    $jshi++;  

  }


$objExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('E2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('I2')->getAlignment()->setWrapText(true);//自动换行
$objExcel->getActiveSheet()->getStyle('J2')->getAlignment()->setWrapText(true);//自动换行

  
// 高置列的宽度  
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);    
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);    
$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);    

  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');  
  
// 设置页方向和规模  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);  
$objExcel->setActiveSheetIndex(0);  

if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="发药明细-'.date('Y-m-d').'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="发药明细-'.date('Y-m-d').'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>