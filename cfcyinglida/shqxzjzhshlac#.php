<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

if (!empty($_POST)) {
  $json = $_POST;
  $shi = $json['cbdqshi'];
  $cblx = $json['cblx'];
  $hzhhj = $json['hzhhj'];
  if($cblx)
  {

    $sql = "select shl from `cblxdq` where `shi`='".$shi."' and `lx` = '".$cblx."' and `hj` = '".$hzhhj."' and `shfshx`='1'";
    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
        $jzhshl = $Record[0];
    }
      if($jzhshl!=""){
        echo $jzhshl;
      }else{
        $jzhshl = "8";
        //$jzhshl = $shi.$cblx.$hzhhj ;
        echo $jzhshl;
      } 
      //echo $sql;   
  }
  //echo '2'.$shi." ".$cblx." ".$hzhhj;
}//echo '1';
?>