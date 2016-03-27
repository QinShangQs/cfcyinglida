<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=(\d+)&/", "", $url[query]);
$url[query] = preg_replace("/&page=(\d+)/", "", $url[query]);
$url[query] = preg_replace("/page=(\d+)/", "", $url[query]);

if($url[query]!="undefined"&&$url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}

$numsql="SELECT * FROM `yfshqzy` where `shqzht` = '3'";
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$kshrq=$_GET[kshrq];
$jshrq=$_GET[jshrq];
if($_GET[rqlx]=="1"){$guanjiancisql = "and ( `shqrq` >= '".$kshrq."' and `shqrq` <= '".$jshrq."' ".$yfmchsql.")";}
if($_GET[rqlx]=="2"){$guanjiancisql = "and ( `pfrq` >= '".$kshrq."' and `pfrq` <= '".$jshrq."' ".$yfmchsql.")";}
if($_GET[rqlx]=="3"){$guanjiancisql = "and ( `fyrq` >= '".$kshrq."' and `fyrq` <= '".$jshrq."' ".$yfmchsql.")";}
if($_GET[rqlx]=="4"){$guanjiancisql = "and ( `shdrq` >= '".$kshrq."' and `shdrq` <= '".$jshrq."' ".$yfmchsql.")";}

$numsql="SELECT * FROM `yfshqzy` where `shqzht` = '3' and ".$guanjiancisql;
}
if($_GET[yfmch]!=""){
$yfmch=$_GET[yfmch];
$numsql.="and `yfmch`='".$yfmch."'";
$guanjiancisql.="and `yfmch`='".$yfmch."'";
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

$zshsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where `shqzht`='3'";
  if($guanjiancisql!=""){
  $zshsql .=$guanjiancisql;
  }
$zsh=mysql_query($zshsql);
while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];}

$html_title="药房赠药收到管理";
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
placeholder="请输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期" size="12" value="" class="grd-white" />
<select id="rqlx" name="rqlx" style="width:120px;" class="grd-white2">
  <option <?php if($_GET[rqlx]=="1"){echo "selected=\"selected\"";}?> value="1">申请日期</option>
  <option <?php if($_GET[rqlx]=="2"){echo "selected=\"selected\"";}?> value="2">批准日期</option>
  <option <?php if($_GET[rqlx]=="3"){echo "selected=\"selected\"";}?> value="3">发运日期</option>
  <option <?php if($_GET[rqlx]=="4"){echo "selected=\"selected\"";}?> value="4">收到日期</option>
</select>    
<select id="YaoFangId" name="YaoFangId" style="width:400px;" class="grd-white2">
  <option selected="selected" value="">选择药房</option>
  <?php
  $yfsql = "select id,yfshijx,yfmch from `yf` where `shfzt`='1' order by yfshijx ASC";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
  echo "<option value=\"".$yfRecord[2]."\">".$yfRecord[1]." ".$yfRecord[2]."</option>";
  }
  ?> 
</select>
<input type="button" value="查找" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table> 
          <div class="insinsins"><span>
          <?php
$zshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='3'";
  if($guanjiancisql!=""){
  $zshsql .=$guanjiancisql;
  }
$zsh=mysql_query($zshsql);

while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];}
?>
          已收到总数：<?php echo $zshjs;?>瓶（测试阶段为全部包含申请药品）   </span></div>              
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="80" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="80" align="center" bgcolor="#FFFFFF">状态</td>
              <td width="90" align="center" bgcolor="#FFFFFF">申请日期</td>
              <td width="90" align="center" bgcolor="#FFFFFF">批准日期</td>
              <td width="90" align="center" bgcolor="#FFFFFF">发运日期</td>
              <td width="90" align="center" bgcolor="#FFFFFF">收到日期</td>
              <td width="80" align="center" bgcolor="#FFFFFF">运单号</td>
              <td width="80" align="center" bgcolor="#FFFFFF">批号</td>
              <td width="90" align="center" bgcolor="#FFFFFF">应收到数量</td>
              <td width="80" align="center" bgcolor="#FFFFFF">药师</td>
            </tr>

<?php        

  $sql = "select * from `yfshqzy` where `shqzht`='3' ";
  if($guanjiancisql!=""){
  $sql .=$guanjiancisql;
  }
  $sql .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfczyshdxx.php?id=".$Record[0]."\">详细</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">已收到</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[13]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[14]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[12]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
                $ph1 = explode(",",$Record[15]);
for($i=0;$i<=count($ph1);$i++)
{
  $ph1sql = "select ph from `kfrk` where `id`='".$ph1[$i]."'";
  $ph1Query_ID = mysql_query($ph1sql);
  while($ph1Record = mysql_fetch_array($ph1Query_ID)){
  echo $ph1Record['0']." ";
  }
}
                $ph2 = explode(",",$Record[19]);
for($i=0;$i<=count($ph2);$i++)
{
  $ph2sql = "select ph from `kfrk` where `id`='".$ph2[$i]."'";
  $ph2Query_ID = mysql_query($ph2sql);
  while($ph2Record = mysql_fetch_array($ph2Query_ID)){
  echo $ph2Record['0']." ";
  }
}
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".($Record[20]+$Record[21])."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
  /*$yfsql = "select yfzhdysh from `yf` where `id`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){echo $yfRecord[0];}*/
    echo $Record[1];
    echo "</td></tr>";
  } 
?>
       
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
            <tr>
              <td>
           <?php
include('pagefy.php');
          ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
    <script type="text/javascript">
         function guolv() {
             var url = 'cfczyshdgl.php?kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val()) +'&rqlx=' + $('#rqlx').val() + '&yfmch=' + encodeURIComponent($('#YaoFangId').val());
             location.href = url;
         }

         $(function () {
             chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
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