<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');

/** PHPExcel_IOFactory */
require_once 'PHPExcel/IOFactory.php';
$filename = "aa.xls";
$objReader = PHPExcel_IOFactory::createReader('Excel5');

$objPHPExcel = $objReader->load($filename);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setCellValue('I',99999);
$objWriter->save(str_replace('.xls', '.csv',$filename));
?>