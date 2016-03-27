<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

if (!empty($_POST)) {
  $json = $_POST;
  $shf = $json['shf'];
  $chsh = $json['chsh'];
  $rdata='';

    $sql = "select * from `yyyshdq` where `sheng`='".$shf."' and `shi`='".$chsh."' and `yhszht`='1'  group by `yymch`";
    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
        if($Record[0]==$Record[9]){}
      else{
        $rdata .="<option value=\"".$Record[3]."\">".$Record[3]."</option>";
        }
    }
    echo $rdata;
    //echo "<option value=\"1\">1</option>";
}
?>