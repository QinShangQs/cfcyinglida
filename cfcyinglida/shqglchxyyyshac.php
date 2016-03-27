<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

if (!empty($_POST)) {
  $json = $_POST;
  $yymch = $json['yymch'];
  $rdata='';

    $sql = "select * from `yyyshdq` where `yymch`='".$yymch."' and `yhszht`='1'";
    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
        $rdata .="<option value=\"".$Record[0]."\">".$Record[6]."</option>";
    }
    echo $rdata;
    //echo "<option value=\"1\">1</option>";
}
?>