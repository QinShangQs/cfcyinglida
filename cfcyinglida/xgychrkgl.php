<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=4;//设置协管员可以查看的页面
include('newdb.php');
$yhqxxf=str_ireplace(",","','","'".implode(",",$_SESSION[yhqxxf])."'");
$xgyyfsql = "select `yfmch` from `yf` where `yfshi` in (".$yhqxxf.")  group by  yfmch order by id DESC ";
//echo $sql;
$xgyyfQuery_ID = mysql_query($xgyyfsql);
$xgyyf="";
while($xgyyfRecord = mysql_fetch_array($xgyyfQuery_ID)){
  if($xgyyf!=""){
    $xgyyf.=",";
  }
  $xgyyf.="'".$xgyyfRecord[0]."'";
}
$yhgldw=$xgyyf;
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
$html_title="出入库统计";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="/manager.php">首页</a>-><a href="/xgychrkgl.php"><?php echo $html_title;?></a></div>
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
<input type="button" value="筛选" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                      
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
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

  echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">";


$zshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`>'2' and `yfmch` in (".$yhgldw.")";
if($fyrq!=""){$zshsql .= " and ".$fyrq;}//添加判断条件
$zsh=mysql_query($zshsql);

while($zshRecord = mysql_fetch_array($zsh)){
if($zshRecord[0]>0){$zshjs1=$zshRecord[0];}else{$zshjs1=0;}
}
$zshzsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`>'2' and `yfmch` in (".$yhgldw.")";
if($fyrqz!=""){$zshzsql .= " and ".$fyrqz;}//添加判断条件
$zshz=mysql_query($zshzsql);

while($zshzRecord = mysql_fetch_array($zshz)){
if($zshzRecord[0]>0){$zshjs1z=$zshzRecord[0];}else{$zshjs1z=0;}
}

$dbzsh1sql="SELECT SUM(dbyppsh) FROM `yfdb` where `dbzht`='2' and `fryfid` in (".$yhgldw.")  ";
$dbzsh1=mysql_query($dbzsh1sql);
while($dbzsh1Record = mysql_fetch_array($dbzsh1)){
if($dbzsh1Record[0]>0){$dbzshjs1=$dbzsh1Record[0];}else{$dbzshjs1=0;}
}
echo ($zshjs1+$dbzshjs1)."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";

$zsh1sql="SELECT SUM(fyshl) FROM `zyff` where `yfmch` in (".$yhgldw.") and `zyffzht` IS NULL";
if($fyrq!=""){$zsh1sql .= " and ".$fyrq;}//添加判断条件
$zsh1=mysql_query($zsh1sql);
//echo $zshsql;
while($zsh1Record = mysql_fetch_array($zsh1)){if($zsh1Record[0]>0){$fyzshjs1=$zsh1Record[0];}else{$fyzshjs1=0;}}

$zsh1zsql="SELECT SUM(fyshl) FROM `zyff` where `yfmch` in (".$yhgldw.") and `zyffzht` IS NULL";
if($fyrqz!=""){$zsh1zsql .= " and ".$fyrqz;}//添加判断条件
$zsh1z=mysql_query($zsh1zsql);
//echo $zshsql;
while($zsh1zRecord = mysql_fetch_array($zsh1z)){if($zsh1zRecord[0]>0){$fyzshjs1z=$zsh1zRecord[0];}else{$fyzshjs1z=0;}}

echo $fyzshjs1."</td>";

$shqzshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='1' and `yfmch` in (".$yhgldw.")";
if($fyrq!=""){$shqzshsql .= " and ".$fyrq;}//添加判断条件
$shqzsh=mysql_query($shqzshsql);
while($shqzshRecord = mysql_fetch_array($shqzsh)){
if($shqzshRecord[0]>0){$shqzshjs1=$shqzshRecord[0];}else{$shqzshjs1=0;}
}
$shqztzshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='2' and `yfmch` in (".$yhgldw.")";
if($fyrq!=""){$shqztzshsql .= " and ".$fyrq;}//添加判断条件
$shqztzsh=mysql_query($shqztzshsql);
while($shqztzshRecord = mysql_fetch_array($shqztzsh)){
if($shqztzshRecord[0]>0){$shqztzshjs1=$shqztzshRecord[0];}else{$shqztzshjs1=0;}
}
?>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo ($zshjs1z+$dbzshjs1-$fyzshjs1z);?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo $shqzshjs1;?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo $shqztzshjs1;?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
             0
            </td>
            <td align="center" bgcolor="#FFFFFF">
             <?php echo "0";?>
            </td>
<?php
echo "</tr>";
     ?>
          </table>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>

    <script type="text/javascript">
        function guolv() {
            var url = 'xgychrkgl.php?kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val());
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