<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$kshrq=$_GET[kshrq];
$jshrq=$_GET[jshrq];
$rkrq = "( `shdrq` >= '".$kshrq."' and `shdrq` <= '".$jshrq."' )";
$rkrqz = "( `shdrq` <= '".$jshrq."' )";
$fyrq = "( `fyrq` >= '".$kshrq."' and `fyrq` <= '".$jshrq."' )";
$fyrqz = "( `fyrq` <= '".$jshrq."' )";
$shyrq = "( `shyrq` >= '".$kshrq."' and `shyrq` <= '".$jshrq."' )";
$shyrqz = "( `shyrq` <= '".$jshrq."' )";
}
if($_GET[yf]!=""){//按药房
$xzyf=" (`yfmch` = '".$_GET[yf]."')";
}
$html_title="出入库统计";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
                <div class="insinsins" style="width:100%;">
                  <span>
<input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly"
placeholder="请输入开始日期" size="12" value="" class="grd-white" /> -
<input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly"
placeholder="请输入结束日期" size="12" value="" class="grd-white" /> 
<select id="YaoFangId" name="YaoFangId" style="width:400px;" class="grd-white2">
<?php
if($_GET[yf]!=""){
?>
<option value="<?php echo $_GET[yf];?>"><?php echo $_GET[yf];?></option>
<?php
}
?>
<option value="">选择药房</option>
<?php
$yfsql = "select id,yfshijx,yfsheng,yfshi,yfmch from `yf` where `shfzt`='1' order by yfshijx ASC";
$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){
echo "<option value=\"".$yfRecord[4]."\">".$yfRecord[1]."  ".$yfRecord[3]." ".$yfRecord[4]."</option>";
}
?>   
</select>
<input type="button" value="筛选" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">药房名称</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">入库总数</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">出库总数</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">当前库存</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">已申请数量</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">发运在途</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">预计N天内发药数量</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">安全库存天数</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">推荐申请数量</td>
            </tr>
<?php
$kfrk1sql = "select SUM(bjshl) from `kfrk` where `id`<>''";
if($shyrq!=""){$kfrk1sql .= " and ".$shyrq;}//添加判断条件
$kfrk1Query_ID = mysql_query($kfrk1sql);
while($kfrk1Record = mysql_fetch_array($kfrk1Query_ID)){
if($kfrk1Record[0]>0){$rkzsh1=$kfrk1Record[0];}else{$rkzsh1=0;}
}
$kfrk1zsql = "select SUM(bjshl) from `kfrk` where `id`<>''";
if($shyrqz!=""){$kfrk1zsql .= " and ".$shyrqz;}//添加判断条件
$kfrk1zQuery_ID = mysql_query($kfrk1zsql);
while($kfrk1zRecord = mysql_fetch_array($kfrk1zQuery_ID)){
if($kfrk1zRecord[0]>0){$rkzsh1z=$kfrk1zRecord[0];}else{$rkzsh1z=0;}
}
//$rkzsh=$rkzsh1+$rkzsh2;
$kfchksql = "select SUM(pfshl1) from `yfshqzy` where `shqzht`>'2'";
if($fyrq!=""){$kfchksql .= " and ".$fyrq;}//添加判断条件
$kfchkQuery_ID = mysql_query($kfchksql);
while($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)){
if($kfchkRecord[0]>0){$chkzsh1=$kfchkRecord[0];}else{$chkzsh1=0;}
}
$kfchkzsql = "select SUM(pfshl1) from `yfshqzy` where `shqzht`>'2'";
if($fyrqz!=""){$kfchkzsql .= " and ".$fyrqz;}//添加判断条件
$kfchkzQuery_ID = mysql_query($kfchkzsql);
while($kfchkzRecord = mysql_fetch_array($kfchkzQuery_ID)){
if($kfchkzRecord[0]>0){$chkzsh1z=$kfchkzRecord[0];}else{$chkzsh1z=0;}
}
?>
         <tr style="color:#1f4248; font-size:12px;">           
            <td align="center" bgcolor="#FFFFFF">
                国药外贸库房
            </td>
             <td align="center" bgcolor="#FFFFFF">
             <?php echo $rkzsh1;?>/<?php echo $rkzsh2;?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo $chkzsh1;?>/<?php echo $chkzsh2;?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo ($rkzsh1z-$chkzsh1z);?>/<?php echo ($rkzsh2z-$chkzsh2z);?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             0
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
         </tr>
         <tr style="color:#1f4248; font-size:12px;">           
            <td align="center" bgcolor="#FFFFFF">
                CFC库房
            </td>
             <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             0
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
         </tr>
     <?php   
$sql = "select yfmch from `yf` where `shfzt`='1'";
if($xzyf!=''){
$sql.=" and ".$xzyf;
}
$sql.=" group by yfdzh ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[0]."</td><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfczyshdgl.php?yfmch=".$Record[0]."\">";


$zshsql="SELECT SUM(pfshl1),SUM(pfshl2) FROM `yfshqzy` where `shqzht`>'2' and `yfmch`='".$Record[0]."'";
if($fyrq!=""){$zshsql .= " and ".$fyrq;}//添加判断条件
$zsh=mysql_query($zshsql);

while($zshRecord = mysql_fetch_array($zsh)){
if($zshRecord[0]>0){$zshjs1=$zshRecord[0];}else{$zshjs1=0;}
if($zshRecord[1]>0){$zshjs2=$zshRecord[1];}else{$zshjs2=0;}
}
$zshzsql="SELECT SUM(pfshl1),SUM(pfshl2) FROM `yfshqzy` where `shqzht`>'2' and `yfmch`='".$Record[0]."'";
if($fyrqz!=""){$zshzsql .= " and ".$fyrqz;}//添加判断条件
$zshz=mysql_query($zshzsql);

while($zshzRecord = mysql_fetch_array($zshz)){
if($zshzRecord[0]>0){$zshjs1z=$zshzRecord[0];}else{$zshjs1z=0;}
if($zshzRecord[1]>0){$zshjs2z=$zshzRecord[1];}else{$zshjs2z=0;}
}

echo $zshjs1."/".$zshjs2."</a></td><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcfygl.php?yf=".$Record[0]."\">";

$zsh1sql="SELECT SUM(fyshl) FROM `zyff` where `yfmch`='".$Record[0]."' and `fyjl`='1' ";
if($fyrq!=""){$zsh1sql .= " and ".$fyrq;}//添加判断条件
$zsh1=mysql_query($zsh1sql);
//echo $zshsql;
while($zsh1Record = mysql_fetch_array($zsh1)){if($zsh1Record[0]>0){$fyzshjs1=$zsh1Record[0];}else{$fyzshjs1=0;}}

$zsh2sql="SELECT SUM(fyshl) FROM `zyff` where `yfmch`='".$Record[0]."' and `fyjl`='2' ";
if($fyrq!=""){$zsh2sql .= " and ".$fyrq;}//添加判断条件
$zsh2=mysql_query($zsh2sql);
//echo $zshsql;
while($zsh2Record = mysql_fetch_array($zsh2)){if($zsh2Record[0]>0){$fyzshjs2=$zsh2Record[0];}else{$fyzshjs2=0;}}

$zsh1zsql="SELECT SUM(fyshl) FROM `zyff` where `yfmch`='".$Record[0]."' and `fyjl`='1' ";
if($fyrqz!=""){$zsh1zsql .= " and ".$fyrqz;}//添加判断条件
$zsh1z=mysql_query($zsh1zsql);
//echo $zshsql;
while($zsh1zRecord = mysql_fetch_array($zsh1z)){if($zsh1zRecord[0]>0){$fyzshjs1z=$zsh1zRecord[0];}else{$fyzshjs1z=0;}}

$zsh2zsql="SELECT SUM(fyshl) FROM `zyff` where `yfmch`='".$Record[0]."' and `fyjl`='2' ";
if($fyrqz!=""){$zsh2zsql .= " and ".$fyrqz;}//添加判断条件
$zsh2z=mysql_query($zsh2zsql);
//echo $zshsql;
while($zsh2zRecord = mysql_fetch_array($zsh2z)){if($zsh2zRecord[0]>0){$fyzshjs2z=$zsh2zRecord[0];}else{$fyzshjs2z=0;}}
echo $fyzshjs1."/".$fyzshjs2."</a></td>";

$shqzshsql="SELECT SUM(pfshl1),SUM(pfshl2) FROM `yfshqzy` where `shqzht`='1' and `yfmch`='".$Record[0]."'";
if($fyrq!=""){$shqzshsql .= " and ".$fyrq;}//添加判断条件
$shqzsh=mysql_query($shqzshsql);
while($shqzshRecord = mysql_fetch_array($shqzsh)){
if($shqzshRecord[0]>0){$shqzshjs1=$shqzshRecord[0];}else{$shqzshjs1=0;}
if($shqzshRecord[1]>0){$shqzshjs2=$shqzshRecord[1];}else{$shqzshjs2=0;}
}
$shqztzshsql="SELECT SUM(pfshl1),SUM(pfshl2) FROM `yfshqzy` where `shqzht`='2' and `yfmch`='".$Record[0]."'";
if($fyrq!=""){$shqztzshsql .= " and ".$fyrq;}//添加判断条件
$shqztzsh=mysql_query($shqztzshsql);
while($shqztzshRecord = mysql_fetch_array($shqztzsh)){
if($shqztzshRecord[0]>0){$shqztzshjs1=$shqztzshRecord[0];}else{$shqztzshjs1=0;}
if($shqztzshRecord[1]>0){$shqztzshjs2=$shqztzshRecord[1];}else{$shqztzshjs2=0;}
}
?>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo ($zshjs1z-$fyzshjs1z);?>/<?php echo ($zshjs2z-$fyzshjs2z);?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo $shqzshjs1;?>/<?php echo $shqzshjs2;?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo $shqztzshjs1;?>/<?php echo $shqztzshjs2;?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             0
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>/<?php echo "0";?>
            </td>
<?php
echo "</tr>";
                
  }
     ?>
          </table>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
<script type="text/javascript">
    function guolv() {
        var url = 'cfcchrkgl.php?yf=' + encodeURIComponent($('#YaoFangId').val()) + '&kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val());
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
</body>
</html>