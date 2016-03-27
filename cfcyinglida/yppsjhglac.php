<?php
session_start(); //破损药品打包交回
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw = $_SESSION[gldw];//关联药房名称
$yhname = $_SESSION[yhname];//药师姓名
$yhln = $_SESSION[yhln];
$yhyshid = $_SESSION[yhid];
//$yhsql = "select yfmch,`id` from `yf` where `yfyshname`='".$yhln."'";
//$yhQuery_ID = mysql_query($yhsql);//得到药房名称
//while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yfmch=$yhRecord[0];$yfid=$yhRecord[1];}
$yfsql = "select `id`,`yfzhdysh` from `yf` WHERE `yfmch`='".$yhgldw."'";
$yfQueryId = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQueryId)){
    //药房医生名称
    $yfzhdysh=$yfRecord[1];
    //药房id
    $yfid=$yfRecord[0];
}


$numquery="select SUM(pshsh) from `psyp` WHERE `state`='1' and `yfmch`='$yhgldw'";
$numresult=mysql_query($numquery);
//$tjshl = mysql_num_rows($numresult);
while($numRecord = mysql_fetch_array($numresult)){
    $tjshl =$numRecord[0];
}
if($tjshl>0)
{
    $dqrq=date('Y-m-d');
    $psshquery = "insert into `psypjh` (`yfid`,`yfmch`,`tjrq`,`state`,`psshl`) VALUES('$yfid', '$yhgldw', '$dqrq', '1', '$tjshl')";
    $psjhResult=mysql_query($psshquery);
    if(!$psjhResult)
    {
        echo mysql_error();
        echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
    }
    else{
        $getID=mysql_insert_id();
        //1 药房，2 cfc，3 国大,4 销毁
        $query="UPDATE `psyp` SET `state`='2',`pihao`='$getID' WHERE `state`='1' and `yfmch`='$yhgldw'";
        $result=mysql_query($query);
        //echo $query;
        if(!$result)
        {
            echo mysql_error();
            echo "药房无破损药盒 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
        }else{
            //$tjshl=mysql_affected_rows();
            echo "成功 打包破损药盒$tjshl 盒<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
        }
    }
}else{
    echo "药房无破损药盒 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
}



