<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

if (!empty($_POST)) {
  $json = $_POST;
  $zjhm = $json['zjhm'];


    $sql = "select id from `hzh` where `zhjhm`='".$zjhm."'";
    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
        $id = $Record[0];
    }
      if($id>1){
        echo "已存在该证件号码患者";
      }
}
?>