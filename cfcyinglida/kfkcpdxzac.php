<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$dzhny = $_POST['dzhny'];
$pdrq = $_POST['pdrq'];
$pdr = $_POST['pdr'];
$jlshjch = microtime_float();//记录发药时间戳精确到毫秒
$sql = "select gldw from `manager` where `yhyl1`='$pdr' ";
$Query_ID = mysql_query($sql);
while ($Record = mysql_fetch_array($Query_ID)) {
    $dwmch = $Record [0];
}
if ($dwmch != "") {
    $dzhnykshshjch = strtotime($dzhny);//盘点月开始第一天
    $dzhnyjshshjch = strtotime("$dzhny +1 month -1 day");//盘点月结束最后一天
    $dqny = date('Y-m');//当前年月
    $dqnyshjch = mktime();//当前年月时间戳
    $phshl = $_POST['phshl'];
    if ($dqnyshjch < $dzhnyjshshjch) {
        $tjshj = 1;
        $dzhnyjshshjch = $dqnyshjch;
    } else {
        $tjshj = 0;
    }//0为统计上月,1为当月
    $shfchfsql = "select * from `kfkcpd` where `dzhny`='$dzhny' and `dwmch`='$dwmch'";
    $shfchfq = mysql_query($shfchfsql);
    $shfchf = mysql_num_rows($shfchfq);
    if ($shfchf == 0) {
        $shcpdidsql = "select id,jlshjch from `kfkcpd` where `dwmch`='$dwmch' order by id DESC limit 0,1";
        $shcpdidQuery_ID = mysql_query($shcpdidsql);
        while ($shcpdidRecord = mysql_fetch_array($shcpdidQuery_ID)) {
            $shcpdid = $shcpdidRecord[0];
            $shcpdshjch = $shcpdidRecord[1];
        }

        $query = "insert into `kfkcpd`(`dzhny`,`pdrq`,`pdr`,`dwmch`,`jlshjch`)values('$dzhny','$pdrq','$pdr','$dwmch','$jlshjch')";
        $result = mysql_query($query);
        if (!$result) {
            echo mysql_error();
            echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
        } else {
            $getID = mysql_insert_id();
            for ($i = 1; $i <= $phshl; $i++) {
                $ypph = $_POST['ypph' . $i];
                $qchkc = $_POST['qchkc' . $i];
                $byrk = $_POST['byrk' . $i];
                $bychk = $_POST['bychk' . $i];
                $shjkc = $_POST['shjkc' . $i];
                if ($qchkc == "") {
                    $qchkc = "0";
                }
                if ($byrk == "") {
                    $byrk = "0";
                }
                if ($bychk == "") {
                    $bychk = "0";
                }
                if ($shjkc == "") {
                    $shjkc = "0";
                }
                if ($shcpdid != "") {
                    $shcpdkcshlsql = "select `shjkc` from `kfkcpdmx` where `pdid`='$shcpdid',`ypph`='$ypph'";
                    $shcpdkcshlQuery_ID = mysql_query($shcpdkcshlsql);
                    while ($shcpdkcshlRecord = mysql_fetch_array($shcpdkcshlQuery_ID)) {
                        $shcpdkcshl = $shcpdkcshlRecord[0];
                    }
                    if ($qchkc != $shcpdkcshl) {
                        $zhtsd = 1;
                    } else if ($qchkc + $byrk - $bychk != $shjkc) {
                        $zhtsd = 1;
                    } else {
                        $zhtsd = 0;
                    }

                }
                if ($shcpdid == "") {
                    $rkshlsql = "select SUM(bjshl) from `kfrk` where `ph`='$ypph' and (`jlshjch`>='$dzhnykshshjch' or `jlshjch`<'$dzhnyjshshjch')";
                    $rkshlQuery_ID = mysql_query($rkshlsql);
                    while ($rkshlRecord = mysql_fetch_array($rkshlQuery_ID)) {
                        $rkshl = $rkshlRecord[0];
                    }
//                    if ($rkshl != $byrk) {
//                        $zhtsd = 1;
//                    } else
                        if ($qchkc + $byrk - $bychk != $shjkc) {
                        $zhtsd = 1;
                    } else {
                        $zhtsd = 0;
                    }
                }
                $mxquery = "insert into `kfkcpdmx`(`pdid`,`ypph`,`qchkc`,`byrk`,`bychk`,`shjkc`,`zhtsd`)values('$getID','$ypph','$qchkc','$byrk','$bychk','$shjkc','$zhtsd')";
                $mxresult = mysql_query($mxquery);
                if (!$mxresult) {
                    echo mysql_error();
                    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
                }
            }
            echo "成功！<br/>";
            echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=kfkcpdgl.php\">";
        }
    } else {
        echo $dzhny . "已经盘点过<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
} else {
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
?>

