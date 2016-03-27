<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
if($_POST['sub']){
  if($_FILES["myFile"]["error"]>0){
    switch ($_FILES["myFile"]["error"]){
       case 1:  echo '上传文件大小超出了PHP配置文件中的约定值';  break;
       case 2:  echo '上传文件大小超出了表单中的约定值：';  break;
       case 3:  echo '文件只被部分上载';  break;
       case 4:  echo '没有上传任何文件';  break;
    }
    //exit();
  }else{
    //echo "Upload: " . $_FILES["myFile"]["name"] . "<br />";
    //echo "Type: " . $_FILES["myFile"]["type"] . "<br />";
    //echo "Size: " . ($_FILES["myFile"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["myFile"]["tmp_name"] . "<br />";
  }
  if($_FILES['myFile']['name']){
    //上传文件
    if(!empty($_FILES['myFile']['name'])){
      $savename= 'uploadFile.xlsx';
      $file = './myFile/'.$savename;
      $result=move_uploaded_file($_FILES['myFile']['tmp_name'],$file);
      if($result){
        include '/PHPExcel_1.7.9_doc/Classes/PHPExcel/IOFactory.php';
        //echo 'Loading file ',pathinfo($file,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //echo '<hr />';
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
for($i=2;$i<=count($sheetData);$i++){
  /*for($j=0;$j<count($sheetData[$i]);$j++){
    
    //$drshjsql="insert into `hzh`(``,``,``,``)";
    //echo $ai." : ".$sheetData[$i][$ai]."</br>";
  }*/
   $shqyyysh=explode('/',$sheetData[$i][J]);
   //echo $shqyyysh[0];die;
  $shqyyyshsql="select `id` from `yyyshdq` where `yymch`='$shqyyysh[0]' and `zhdysh`='$shqyyysh[1]'";
   $shqyyyshquery=mysql_query($shqyyyshsql);
   while($shqyyyshRecord=mysql_fetch_array($shqyyyshquery)){
     $shqyyyshid=$shqyyyshRecord[0];
   }
   $rzyyysh=explode('/',$sheetData[$i][L]);
  $rzyyyshsql="select `id` from `yyyshdq` where `yymch`='$rzyyysh[0]' and `zhdysh`='$rzyyysh[1]'";
   $rzyyyshquery=mysql_query($rzyyyshsql);
   while($rzyyyshRecord=mysql_fetch_array($rzyyyshquery)){
     $rzyyyshid=$rzyyyshRecord[0];
   }
   $zhzhyyysh=explode('/',$sheetData[$i][M]);
  $zhzhyyyshsql="select `id` from `yyyshdq` where `yymch`='$zhzhyyysh[0]' and `zhdysh`='$zhzhyyysh[1]'";
   $zhzhyyyshquery=mysql_query($zhzhyyyshsql);
   while($zhzhyyyshRecord=mysql_fetch_array($zhzhyyyshquery)){
     $zhzhyyyshid=$zhzhyyyshRecord[0];
   }
   //echo $sheetData[$i][B];die;
   $drshjsql="insert into `hzh`(`hzhid`,`shqzht`,`hzhxm`,`zhjlx`,`zhjhm`,`hzhxb`,`hzhchshrq`,`shqbzh`,`shqyy`,`shhyj`,`rzyy`,`zhzhyy`,`hzhtxdzh`,`hzhshj`,`dylxrdh`,`derlxrdh`,`hzhhj`,`hzhjtrk`,`jtnshr`,`rjshr`,`cblx`,`cbdqsheng`,`cbdqshi`,`cbdqqu`,`jzhlx`,`mrchzrq`,`ypgg`,`ypyl`,`zhshrzshj`,`ygshcyyrq`,`lyyf`,`hzhchzrq`,`hzhchzyy`,`djrq`,`djr`,`wshshq`,`shhxcl`,`jjrq`,`tzhrq`,`jjxxshm`) values ('".$sheetData[$i][B]."','".$sheetData[$i][C]."','".$sheetData[$i][D]."','".$sheetData[$i][E]."','".$sheetData[$i][F]."','".$sheetData[$i][G]."','".$sheetData[$i][H]."','".$sheetData[$i][I]."','".$shqyyyshid."','".$sheetData[$i][k]."','".$rzyyyshid."','".$zhzhyyyshid."','".$sheetData[$i][N]."','".$sheetData[$i][O]."','".$sheetData[$i][P]."','".$sheetData[$i][Q]."','".$sheetData[$i][S]."','".$sheetData[$i][U]."','".$sheetData[$i][V]."','".$sheetData[$i][W]."','".$sheetData[$i][X]."','".$sheetData[$i][Y]."','".$sheetData[$i][Z]."','".$sheetData[$i][AA]."','".$sheetData[$i][AB]."','".$sheetData[$i][AC]."','".$sheetData[$i][AD]."','".$sheetData[$i][AE]."','".$sheetData[$i][AF]."','".$sheetData[$i][AG]."','".$sheetData[$i][AH]."','".$sheetData[$i][AI]."','".$sheetData[$i][AJ]."','".$sheetData[$i][AK]."','".$sheetData[$i][AL]."','".$sheetData[$i][AM]."','".$sheetData[$i][AN]."','".$sheetData[$i][AO]."','".$sheetData[$i][AP]."','".$sheetData[$i][AQ]."')";
   //ECHO "</br>";
   $query=mysql_query($drshjsql);
}
        /*require_once 'PHPExcel/reader.php';
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('utf-8'); 
        //”data.xls”是指要导入到mysql中的excel文件 
        $data->read($file);
        //删除不要的表头部分，我的有三行不要的，删除三次
        //dump($arrExcel);die();array_shift($arrExcel);
        //array_shift($arrExcel);
        //array_shift($arrExcel);//现在可以打印下$arrExcel，就是你想要的数组啦
        //查询数据库的字段
        for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) { 
        //以下注释的for循环打印excel表数据 
        for ($j = 1; $j < = $data->sheets[0]['numCols']; $j++) { 
        echo "\"".$data->sheets[0]['cells'][$i][$j]."\","; 
        } 
        echo "\n"; 
        }
        die('aaaa');
        //$this->success('添加成功','__APP__/Rand/daochuuser');*/
      }
    }else{
      exit();
    }
  }
}
?>
    