<?php
/**
 * 库存盘点时，如果实际数量与计算的数量不符的情况下，锁定新增盘点功能，在此解锁
 */
session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$id = $_GET['id'];

$query = "UPDATE `kfkcpd` SET `islock` = 0 WHERE id='$id'";
$result = mysql_query($query);
if (!$result) {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
} else {
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=kfkcpdhfgl.php\">";
}

