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
$k1="不良事件报告汇总表";  
$k2="CFC编码";  
$k3="辉瑞编码";  
$k4="CFC获知日期";  
$k5="报送辉瑞日期";  
$k6="患者编码";   
$k7="患者姓名";  
$k8="病种";  
$k9="用法及用量";  
$k10="事件描述";  
$k11="CFC填表人";  
$k12="事件来源人";  
$k13="医生接受随访";  
$k14="事件来源";  
$shjrq=$_SESSION[blshjzzrq]."-".$_SESSION[blshjzwrq];
  
$objExcel->getActiveSheet()->mergeCells( 'A1:M1' );

//$objExcel->getActiveSheet()->mergeCellsByColumnAndRow( 'A1:A2' );
$objExcel->getActiveSheet()->setCellValue('A1', "$k1"); 
$objExcel->getActiveSheet()->setCellValue('M2', "$shjrq"); 
$objExcel->getActiveSheet()->setCellValue('A3', "$k2"); 
$objExcel->getActiveSheet()->setCellValue('B3', "$k3"); 
$objExcel->getActiveSheet()->setCellValue('C3', "$k4"); 
$objExcel->getActiveSheet()->setCellValue('D3', "$k5"); 
$objExcel->getActiveSheet()->setCellValue('E3', "$k6");
 
$objExcel->getActiveSheet()->setCellValue('F3', "$k7"); 
$objExcel->getActiveSheet()->setCellValue('G3', "$k8"); 
$objExcel->getActiveSheet()->setCellValue('H3', "$k9"); 
$objExcel->getActiveSheet()->setCellValue('I3', "$k10"); 
$objExcel->getActiveSheet()->setCellValue('J3', "$k11"); 
$objExcel->getActiveSheet()->setCellValue('K3', "$k12"); 
$objExcel->getActiveSheet()->setCellValue('L3', "$k13"); 
$objExcel->getActiveSheet()->setCellValue('M3', "$k14"); 
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
$sqlchfq=explode("limit",$_SESSION[blshjsql]);
$sql=$sqlchfq[0];
  //$sql = "select * from `hzh`";
  $jshi=4;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){

            //患者编码以及姓名
$hzhxxq=mysql_query("SELECT * FROM `hzh` where  `id`='".$Record[1]."'");
while($hzhxxr= mysql_fetch_array($hzhxxq)){
if($hzhxxr[2]!=''){$hzhbm="X-".$hzhxxr[2];}else{$hzhbm=sprintf("%05d", $hzhxxr[0]);}
$hzhxm=$hzhxxr[4];
          $rzyysql = "select zhdysh,yymch,yyksh,shfjshhf from `yyyshdq` where ";
          if($Record[11]!=''){
          $rzyysql .= " id='".$Record[11]."'";
          }else if($hzhxxr[12]!=''){
          $rzyysql .= " id='".$hzhxxr[12]."'";
          }else if($hzhxxr[11]!=''){
          $rzyysql .= " id='".$hzhxxr[11]."'";
          }else if($hzhxxr[9]!=''){
          $rzyysql .= " id='".$hzhxxr[9]."'";
          }
          /*echo $rzyysql;*/
          $rzyyQuery_ID = mysql_query($rzyysql);
          while($rzyyRecord = mysql_fetch_array($rzyyQuery_ID)){
          $zhdysh=$rzyyRecord[0];
          $yymch=$rzyyRecord[1];
          $yyksh=$rzyyRecord[2];
          $shfjshhf=$rzyyRecord[3];
          }
} 
  
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('a'.$jshi, $Record[0]);  
    $objExcel->getActiveSheet()->setCellValue('b'.$jshi, $Record[12]);  
    $objExcel->getActiveSheet()->setCellValue('c'.$jshi, $Record[6]);  
    $objExcel->getActiveSheet()->setCellValue('d'.$jshi, $Record[8]); 
    $objExcel->getActiveSheet()->setCellValue('e'.$jshi, $hzhbm); 
    $objExcel->getActiveSheet()->setCellValue('f'.$jshi, $hzhxm);  
    $objExcel->getActiveSheet()->setCellValue('g'.$jshi, "肺癌"); 
    $objExcel->getActiveSheet()->setCellValue('h'.$jshi, $Record[4]);  
    $objExcel->getActiveSheet()->setCellValue('i'.$jshi, $Record[5]);  
    $objExcel->getActiveSheet()->setCellValue('j'.$jshi, $Record[9]);  
    if($Record[2]==0){$blshjly="医生";}else if($Record[2]==1){$blshjly="患者";}else if($Record[2]==2){$blshjly="患者家属";}
    $objExcel->getActiveSheet()->setCellValue('k'.$jshi, $blshjly);
                
    //if($shfjshhf==1){$blshjyshsf="是";}else{$blshjyshsf="否";}
    if($Record[3]==1){$blshjyshsf="是";}else if($Record[3]==0){$blshjyshsf="否";}else if($Record[3]==2){$blshjyshsf="不详";}
    $objExcel->getActiveSheet()->setCellValue('L'.$jshi, $blshjyshsf);
    $objExcel->getActiveSheet()->setCellValue('M'.$jshi, $yymch.",".$yyksh.",".$zhdysh);
    $hzhbm='';
    $hzhxm='';
    $jshi++;  

  }


$objExcel->getActiveSheet()->getStyle('A1:M'.$jshi)->getAlignment()->setWrapText(true);//自动换行
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
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);    
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);    
$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);    
$objExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);    
$objExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);    
$objExcel->getActiveSheet()->getColumnDimension('M')->setWidth(50);    

  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');  
  
// 设置页方向和规模  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);  
$objExcel->setActiveSheetIndex(0);  

if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="不良事件汇总表-'.date('Y-m-d').'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="不良事件汇总表-'.date('Y-m-d').'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>