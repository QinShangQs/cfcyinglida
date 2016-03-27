<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $yhgldw = $_SESSION[gldw];
if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$kshrq=$_GET[kshrq];
$jshrq=$_GET[jshrq];
$rkrq = "( `shdrq` >= '".$kshrq."' and `shdrq` <= '".$jshrq."' )";
$fyrq = "( `fyrq` >= '".$kshrq."' and `fyrq` <= '".$jshrq."' )";
}
$html_title="出入库统计";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="kfcfcfy.php"><?php echo $html_title;?></a></div>
     <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>出入库统计</strong></span>
				</div>
			<div class="incontact w955 flt">
        <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly"
            placeholder="请输入开始日期" size="12" value=""
             class="grd-white" /> -
        <input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly"
            placeholder="请输入结束日期" size="12" value=""
             class="grd-white" />&nbsp;&nbsp;<input type="button" value="按日期过滤" onclick="guolv();" class="uusub" /> &nbsp;&nbsp;
            
        </div>
    	
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="10%" align="center" bgcolor="#FFFFFF">
                药房名称
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                入库总数
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                出库总数
            </td>
            
           
            
        </tr>
       
        <tr style="color:#1f4248; font-size:12px;">
           
            <td width="10%" align="center" bgcolor="#FFFFFF"><?php
  $yhln = $_SESSION[yhln];
  $yhyshid = $_SESSION[id];
  $yhsql = "select yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){echo $yfmch=$yhRecord[0];}
            ?></td>
           
             <td width="10%" align="center" bgcolor="#FFFFFF">
                <a href="yshzyshdgl.php"><?php
  $yftmsql = "select `id`,`yfyshname` from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfid[]=$yftmRecord[0];$yfyshname[]=$yftmRecord[1];}
/*$zshsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where (`yshid`='".$yshid."'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $zshsql .= " or `yshid`='".$yfid[$i]."' ";
  }
}
$zshsql .= " )"; */
$zshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `yfmch`='".$yhgldw."'";
if($rkrq!=''){$zshsql .= " and ".$rkrq;}//增加日期筛选条件
$zsh=mysql_query($zshsql);

while($zshRecord = mysql_fetch_array($zsh)){
if($zshRecord[0]>0){echo $zshjs=$zshRecord[0];}else{echo $zshjs=0;}
}
$pfshl1ztsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='2' and `yfmch`='".$yhgldw."'";
$pfshl1ztq=mysql_query($pfshl1ztsql);
while($pfshl1ztRecord = mysql_fetch_array($pfshl1ztq)){$pfshl1zt=$pfshl1ztRecord[0];}
                ?>瓶<?php if($pfshl1zt>0){echo "（其中".$pfshl1zt."在途中）";}?></a>
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                <a href="yshfygl.php"><?php
  /*$yshidsql = "select `id` from `manager` where (`names`='".$yhln."'";
for($i=0;$i<count($yfyshname);$i++)
{
  if($yfyshname[$i]!=null){
    $yshidsql .= " or `names`='".$yfyshname[$i]."' ";
  }
}
$yshidsql .=")";
  $yshidQuery_ID = mysql_query($yshidsql);
  while($yshidRecord = mysql_fetch_array($yshidQuery_ID)){$yshid[]=$yshidRecord[0];}*/
/*$zshsql="SELECT SUM(fyshl) FROM `zyff` where (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $zshsql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
$zshsql .= ")";*/
$zshsql="SELECT SUM(fyshl) FROM `zyff` where `yfmch`='$yhgldw'";
if($fyrq!=''){$zshsql .= " and ".$fyrq;}//增加日期筛选条件
$zsh=mysql_query($zshsql);
//echo $zshsql;
while($zshRecord = mysql_fetch_array($zsh)){
if($zshRecord[0]>0){echo $zshjs=$zshRecord[0];}else{echo $zshjs=0;}
}
                ?>瓶</a>
            </td>
              
            
            
            
        </tr>
        
    </table>
    </div>
    
    </div>
    <script type="text/javascript">
       

        function guolv() {
            var url = 'yshchrkgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();
            location.href = url;
        }

        $(function () {
            chooseDateNow('KaishiRiqi', 'JiezhiRiqi',true,true);
        <?php
            if($_GET[kshrq]!=""){
        ?>
            $('#KaishiRiqi').val('<?php echo $_GET[kshrq]; ?>');
        <?php
            }
            if($_GET[jshrq]!=""){
        ?>
            $('#JiezhiRiqi').val('<?php echo $_GET[jshrq]; ?>');
        <?php
            }
        ?>
        });
       
    </script>
    </div>
        </div>
    </div>
</body>
</html>
