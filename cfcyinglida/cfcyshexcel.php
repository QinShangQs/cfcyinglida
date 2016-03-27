<?php  session_start(); 
Mysql_connect("localhost","root","117791536");
Mysql_select_db("CFCSYSTEM");
mysql_query("set names utf8");
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
$objExcel->getDefaultStyle()->getFont()->setName('宋体');
$i=0;  
//表头  
$k1="医生名称"; 
$k2="申请患者数量"; 
$k3="入组患者数量";  
$k4="审核中患者数量"; 
$k5="待入组患者数量"; 
$k6="停止申请患者数量";  
$k7="拒绝患者数量";  
$k8="出组患者数量";  
$k9="入组全部捐赠患者数量"; 
$k10="入组部分捐赠患者数量"; 



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
 //设置font
/*$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(20);
$objExcel->setActiveSheetIndex(0)->getStyle('Q2')->getFont()->setSize(15);*/
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objExcel->getActiveSheet()->getStyle('A1:J26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
/*$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);*/
//$objExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

//设置c 列 身份证号码
    //$objExcel->getActiveSheet()->getStyle('c')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);//文本
    //$objExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);//

  //$sql = "select * from `hzh`";
  
  

  
$tjshzi=0;
//获取全部医生id，名称
$yymchsql="SELECT zhdysh,id FROM `yyyshdq` ORDER BY `yymch` ASC";
$yymchq=mysql_query($yymchsql);
while($yymchRecord = mysql_fetch_array($yymchq)){
  $tjshz[$tjshzi][9]=$yymchRecord[0];
  $yyid[]=$yymchRecord[1];//药房名称获取全部id
  if($yyid!=""){
    $sql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($yyid);$i++){
      $sql .= " or `shqyy`='".$yyid[$i]."'";
    }
    $sql .= " )";
    $rzsql="SELECT * FROM `hzh` where ('1'='2' ";    
    for($i=0;$i<count($yyid);$i++){
      $rzsql .= " or `rzyy`='".$yyid[$i]."'";
    }
    $rzsql .= " )";
    $shqq=mysql_query($sql);
    $shq = mysql_num_rows($shqq);//获取申请条数
    $rzq=mysql_query($rzsql." and `shqzht`='入组'");
    $rz = mysql_num_rows($rzq);//获取入组条数
    $shhq=mysql_query($sql." and `shqzht`='审核'");
    $shh = mysql_num_rows($shhq);//获取审核条数
    $dbq=mysql_query($sql." and `shqzht`='待办入组'");
    $db = mysql_num_rows($dbq);//获取待办入组条数
    $tzhq=mysql_query($sql." and `shqzht`='停止申请'");
    $tzh = mysql_num_rows($tzhq);//获取停止申请条数
    $jjq=mysql_query($sql." and `shqzht`='拒绝'");
    $jj = mysql_num_rows($jjq);//获取拒绝条数
    $chzq=mysql_query($rzsql." and `shqzht`='出组'");
    $chz = mysql_num_rows($chzq);//获取出组条数
    $rzbfq=mysql_query($rzsql." and `shqzht`='入组' and `jzhlx`='部分'");
    $rzbf = mysql_num_rows($rzbfq);//获取入组部分条数
    $rzqbq=mysql_query($rzsql." and `shqzht`='入组' and `jzhlx`='全部'");
    $rzqb = mysql_num_rows($rzqbq);//获取入组全部条数
    $tjshz[$tjshzi][0]=$shq;
    $tjshz[$tjshzi][1]=$rz;
    $tjshz[$tjshzi][2]=$shh;
    $tjshz[$tjshzi][3]=$db;
    $tjshz[$tjshzi][4]=$tzh;
    $tjshz[$tjshzi][5]=$jj;
    $tjshz[$tjshzi][6]=$chz;
    $tjshz[$tjshzi][7]=$rzbf;
    $tjshz[$tjshzi][8]=$rzqb;
  }//获取北京发药条数
  
  $tjshzi++;
  unset($yyid);
}

  for($i=0;$i<count($tjshz);$i++)
  {  
  $jshi=$i+2;
    /*----------写入内容-------------*/  
    $objExcel->getActiveSheet()->setCellValue('A'.$jshi, $tjshz[$i][9]); 
    $objExcel->getActiveSheet()->setCellValue('B'.$jshi, $tjshz[$i][0]); 
    $objExcel->getActiveSheet()->setCellValue('C'.$jshi, $tjshz[$i][1]); 
    $objExcel->getActiveSheet()->setCellValue('D'.$jshi, $tjshz[$i][2]); 
    $objExcel->getActiveSheet()->setCellValue('E'.$jshi, $tjshz[$i][3]); 
    $objExcel->getActiveSheet()->setCellValue('F'.$jshi, $tjshz[$i][4]); 
    $objExcel->getActiveSheet()->setCellValue('G'.$jshi, $tjshz[$i][5]); 
    $objExcel->getActiveSheet()->setCellValue('H'.$jshi, $tjshz[$i][6]); 
    $objExcel->getActiveSheet()->setCellValue('I'.$jshi, $tjshz[$i][8]); 
    $objExcel->getActiveSheet()->setCellValue('J'.$jshi, $tjshz[$i][7]); 

  }

//$objExcel->getActiveSheet()->getStyle('A1:Y'.$jshi)->getAlignment()->setWrapText(true);//自动换行
// 高置列的宽度  
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30.6); 
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10.6);  
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10.6);  
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10.6);  
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10.6);  
$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.6);  
$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10.6);  
$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10.6);    
$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10.6);      
$objExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10.6);
   /* 
$objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(38);  
$objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(23);  
$objExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);  
     

$styleArray = array(
			'borders' => array(
				'allborders' => array(
					//'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的
					'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框
					//'color' => array('argb' => 'FFFF0000'),
				),
			),
		);
$objExcel->getActiveSheet()->getStyle('A3:Y'.$jshi)->applyFromArray($styleArray);*/
$objExcel->getActiveSheet()->getStyle('A2:J'.$jshi)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //左右居中
$objExcel->getActiveSheet()->getStyle('A2:J'.$jshi)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
 /* 
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');  
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');  
  */

// 设置页方向和规模  
//$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);  
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);  
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//页边距
//        $sheet = $objPHPExcel->getActiveSheet();
//        $pageMargins = $sheet->getPageMargins();
//        //$margin = '0.5/0.7'; 
//        $pageMargins->setTop(0);    //上边距
//        $pageMargins->setBottom(0.21); //下
//        $pageMargins->setLeft(0.58);   //左
//        $pageMargins->setRight(0.3);  //右      
$objExcel->setActiveSheetIndex(0);  
if($ex == '2007') { //导出excel2007文档  
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
    header('Content-Disposition: attachment;filename="按医生统计'.date('Y-m-d').'.xlsx"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');  
    $objWriter->save('php://output');  
    exit;  
} else {  //导出excel2003文档  
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
    header('Content-Disposition: attachment;filename="按医生统计'.date('Y-m-d').'.xls"');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');  
    $objWriter->save('php://output');  
    exit;  
}  
?>