<?php
require_once './PHPExcel.php';  
require_once './phpExcel/Writer/Excel2007.php';  
require_once './phpExcel/Writer/Excel5.php';  
include_once './phpExcel/IOFactory.php';  
  
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
$k1="中国癌症基金会赛可瑞™患者援助项目药品流向单";  
$k2="（        年      月）";  
$k3="期初库存（时间、批号）";  
$k4="本期发放数量";  
$k5="本期收到数量（时间、批号）";  
$k6="期末库存";  
$k7="经办人签字";  
$k8="日期";  
$k9="患者姓名";  
$k10="患者唯一编码";  
$k11="产品批号";  
$k12="规格";  
$k13="发药数量
（瓶）";  
$k14="空盒/瓶回收";  
$k15="领药人签字";  
$k16="代领人
与患者关系";  
$k17="发药人签字"; 
  
$objExcel->getActiveSheet()->mergeCells( 'A1:J2' );
$objExcel->getActiveSheet()->mergeCells( 'A4:C4' );
$objExcel->getActiveSheet()->mergeCells( 'D4:E4' );
$objExcel->getActiveSheet()->mergeCells( 'F4:H4' );
$objExcel->getActiveSheet()->mergeCells( 'A5:C5' );
$objExcel->getActiveSheet()->mergeCells( 'D5:E5' );
$objExcel->getActiveSheet()->mergeCells( 'F5:H5' );
$objExcel->getActiveSheet()->mergeCells( 'A6:C6' );
$objExcel->getActiveSheet()->mergeCells( 'D6:E6' );
$objExcel->getActiveSheet()->mergeCells( 'F6:H6' );
/*$objExcel->getActiveSheet()->mergeCells( 'A2:J2' );
$objExcel->getActiveSheet()->mergeCells( 'A1:A2' );*/

//$objExcel->getActiveSheet()->mergeCellsByColumnAndRow( 'A1:A2' );
$objExcel->getActiveSheet()->setCellValue('A1', "$k1"); 
$objExcel->getActiveSheet()->setCellValue('A4', "$k3"); 
$objExcel->getActiveSheet()->setCellValue('D4', "$k4"); 
$objExcel->getActiveSheet()->setCellValue('F4', "$k5"); 
$objExcel->getActiveSheet()->setCellValue('I4', "$k6"); 
$objExcel->getActiveSheet()->setCellValue('J4', "$k7");
 
$objExcel->getActiveSheet()->setCellValue('A7', "$k8"); 
$objExcel->getActiveSheet()->setCellValue('B7', "$k9"); 
$objExcel->getActiveSheet()->setCellValue('C7', "$k10"); 
$objExcel->getActiveSheet()->setCellValue('D7', "$k11"); 
$objExcel->getActiveSheet()->setCellValue('E7', "$k12"); 
$objExcel->getActiveSheet()->setCellValue('F7', "$k13"); 
$objExcel->getActiveSheet()->setCellValue('G7', "$k14"); 
$objExcel->getActiveSheet()->setCellValue('H7', "$k15"); 
$objExcel->getActiveSheet()->setCellValue('I7', "$k16"); 
$objExcel->getActiveSheet()->setCellValue('J7', "$k17"); 
 //设置font
$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(14);
$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objExcel->getActiveSheet()->mergeCells( 'A3:J3' );
$objExcel->getActiveSheet()->setCellValue('A3', "$k2"); 
 //设置font
$objExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setSize(14);
$objExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setBold(true);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$objExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A3:J3')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A5:J5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A6:J6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A7:J7')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A8:J8')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('A9:J9')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

$objExcel->getActiveSheet()->getStyle('A1:A9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('B1:B9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('C1:C9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('D1:D9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('E1:E9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('F1:F9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('G1:G9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('H1:H9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('I1:I9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$objExcel->getActiveSheet()->getStyle('J1:J9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

$objExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objExcel->getActiveSheet()->getStyle('A1:A3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


/*$objExcel->getActiveSheet()->setCellValue('b1', "$k2");  
$objExcel->getActiveSheet()->setCellValue('c1', "$k3");  
$objExcel->getActiveSheet()->setCellValue('d1', "$k4");  
$objExcel->getActiveSheet()->setCellValue('e1', "$k5");  */

//debug($links_list);  
foreach($links_list as $k=>$v) {  
    $u1=$i+2;  
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('a'.$u1, $v["id"]);  
    $objExcel->getActiveSheet()->setCellValue('b'.$u1, $v["num"]);  
    $objExcel->getActiveSheet()->setCellValue('c'.$u1, $v["referer"]);  
    $objExcel->getActiveSheet()->setCellValue('d'.$u1, $v["ip"]);  
    $objExcel->getActiveSheet()->setCellValue('e'.$u1, $v["dateline"]);  
    $i++;  
}  
 
$objExcel->setActiveSheetIndex(0)->getStyle('A4:J7')->getFont()->setSize(12); 
 
 
$objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(50);  
$objExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(25);  
$objExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(25);  
$objExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(25);  
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(25);  
$objExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(25);  
 
  
// 高置列的宽度  
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);  
$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);  
  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');  
  
// 设置页方向和规模  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);  
$objExcel->setActiveSheetIndex(0);  
$timestamp = time();  
if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="links_out'.$timestamp.'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="links_out'.$timestamp.'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>