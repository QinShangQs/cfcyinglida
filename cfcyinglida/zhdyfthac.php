<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//替换前指定药房id
$thqyfid = $_POST['thqyfid'];
//替换后指定药房：
$thhyfid = $_POST['thhyfid'];
//经办人
$jbr = $_POST['jbr'];
//经办日期：
$thrq = $_POST['thrq'];
//替换药房理由
$thly = $_POST['thly'];
//新入组替换
$xrzth = $_POST['xrzth'];
//老患者替换
$lhzhth = $_POST['lhzhth'];
if($thqyfid !=""&&$thhyfid !=""&&$thqyfid !=$thhyfid){
    $query="insert into `thyf`(thqyfid,thhyfid,jbr,thrq,thly,xrzth,lhzhth)values('$thqyfid','$thhyfid','$jbr','$thrq','$thly','$xrzth','$lhzhth')";
    //echo $query;
    $result=mysql_query($query);
    if(!$result)
    {
        echo mysql_error();
        echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
        /*$thqyfmchsql = "select yfmch from `yf` where `id`='$thqyfid'";
        $thqyfmchQuery_ID = mysql_query($thqyfmchsql);
        while($thqyfmchRecord = mysql_fetch_array($thqyfmchQuery_ID)){
          $thqyfmch=$thqyfmchRecord[0];
        }
        $thqyfidsql = "select id from `yf` where `yfmch`='$thqyfmch'";
        $thqyfidQuery_ID = mysql_query($thqyfidsql);
        while($thqyfidRecord = mysql_fetch_array($thqyfidQuery_ID)){
          $thqyfidsh.=$thqyfidRecord[0].",";
        }*/
        if($xrzth=="是"){
            $query="UPDATE `yyyshdq` SET `yyzhdyf`='$thhyfid' WHERE `yyzhdyf` ='$thqyfid'";
            //echo $query;
            $result=mysql_query($query);
            if(!$result)
            {
                echo mysql_error();
                echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
            }
            else{      }
        }
        if($lhzhth=="是"){
            $query="UPDATE `hzh` SET `lyyf`='$thhyfid' WHERE `lyyf` ='$thqyfid'";
            //echo $query;
            $result=mysql_query($query);
            if(!$result)
            {
                echo mysql_error();
                echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
            }
            else{      }
        }
        echo "成功！<br/>";
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyfgl.php\">";
    }
}else{
    echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}


?> 