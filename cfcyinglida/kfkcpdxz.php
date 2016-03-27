<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$ri = date('d');
//$yuri = date('d',strtotime(date('Y-m')."+1 month -1 day"));
	  $xtggxxsql = "select ggnr from `xtggxx` where `ggzht`='1' and `tshgn`='1'";
  $xtggxxQuery_ID = mysql_query($xtggxxsql);
  while($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)){
$xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
$xtggxxggnr = $xtggxxRecord[0];//读取数据库，盘点当月 1 或者 上月 0
}
$dayyd=date("d",strtotime("+1 day"));

if(($ri>=1&&$ri<=5)||$xtggxx==1||$dayyd==1){
if($xtggxxggnr==1||$dayyd==1){$dzhny=date('Y-m');}
else{$dzhny=date('Y-m',strtotime("-1 month",strtotime(date('Y-m'))));}
$html_title="库房库存盘点新增";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="manager.php">管理首页</a> - <?php echo $html_title;?> </div>
			<div class="inwrap flt top">
		<div class="title w977 flt">
		<strong>库房库存盘点新增</strong>
				</div>
			<div class="incontact w955 flt">
<?php
echo "<b>开始盘点".$dzhny."</b>";
$pdrq=date('Y-m-d');
$pdr=$_SESSION['yhname'];
?>

    <form action="kfkcpdxzac.php" method="post">
<input name="xtggxx" type="hidden" value="<?php echo $xtggxx;?>" />
<input name="xtggxxggnr" type="hidden" value="<?php echo $xtggxxggnr;?>" />
<input name="dzhny" type="hidden" value="<?php echo $dzhny;?>" />
<input name="pdrq" type="hidden" value="<?php echo $pdrq;?>" />
<input name="pdr" type="hidden" value="<?php echo $pdr;?>" />
    <fieldset class="top">
        <legend>新增库房盘点</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    批号
                </td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    期初库存
                </td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    当月入库
                </td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    当月出库
                </td>

                <td width="20%" align="center" bgcolor="#FFFFFF">
                    实际库存
                </td>
            </tr>
<?php

  $sql = "select ph from `kfrk` group by ph";
  $i=1;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    <input class="grd-white" id="ypph" name="ypph<?php echo $i;?>" type="hidden" value="<?php echo $Record[0];?>" /><?php echo $Record[0];?>
                </td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    <input class="grd-white" type="text" name="qchkc<?php echo $i;?>"  value="0"/>
                </td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    <input class="grd-white" type="text" name="byrk<?php echo $i;?>"  value="0"/>
                </td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    <input class="grd-white" type="text" name="bychk<?php echo $i;?>"  value="0"/>
                </td>

                <td width="20%" align="center" bgcolor="#FFFFFF">
                    <input class="grd-white" type="text" name="shjkc<?php echo $i;?>"  value="0"/>
                </td>
            </tr>
<?php
    $i++;
  }
?>
</table>


        <br />
        <input name="phshl" type="hidden" value="<?php echo $i;?>" />
        <input type="submit" class="uusub" value="保存" class="lgSub" />
        <input id="IsChaxun" name="IsChaxun" type="hidden" value="0" />
    </fieldset>
    </form>
 </div>
        </div>
    </div>
        </div>
    </div>
</body>
</html>
<?php
}
else{echo "未到盘点日期";}
?>