<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

  $yhgldw = $_SESSION[gldw];
  
  $yhln = $_SESSION[yhln];
  $yhsql = "select id,yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yshid=$yhRecord[0];$yfmch=$yhRecord[1];}
  $yftmsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfid[]=$yftmRecord[0];}

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

/*$numsql="SELECT * FROM `yfshqzy` where (`yshid`='$yshid'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $numsql .= " or `yshid`='".$yfid[$i]."' ";
  }
}
$numsql.=")";*/
$numsql="SELECT * FROM `yfshqzy` where `yfmch`='$yhgldw'";

if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$kshrq=$_GET[kshrq];
$jshrq=$_GET[jshrq];
if($_GET[rqlx]=="1"){$guanjiancisql = "( `shqrq` >= '".$kshrq."' and `shqrq` <= '".$jshrq."' )";}
if($_GET[rqlx]=="2"){$guanjiancisql = "( `pfrq` >= '".$kshrq."' and `pfrq` <= '".$jshrq."' )";}
if($_GET[rqlx]=="3"){$guanjiancisql = "( `fyrq` >= '".$kshrq."' and `fyrq` <= '".$jshrq."' )";}
if($_GET[rqlx]=="4"){$guanjiancisql = "( `shdrq` >= '".$kshrq."' and `shdrq` <= '".$jshrq."' )";}

$numsql.=" and ".$guanjiancisql;
}
/*if($_GET[yf]!=""){//按药房
      $yfyshsql = "select yfyshname from `yf` where `shfzt`='1' and `id`='".$_GET[yf]."'";
      $yfyshQuery_ID = mysql_query($yfyshsql);
      while($yfyshRecord = mysql_fetch_array($yfyshQuery_ID)){
        $yfyshname=$yfyshRecord[0];
      }
      echo $yshidsql;
      $yshidsql = "select `id` from `manager` where `names`='".$yfyshname."'";
      $yshidQuery_ID = mysql_query($yshidsql);
      while($yshidRecord = mysql_fetch_array($yshidQuery_ID)){
        $yshid=$yshidRecord[0];
      }//echo $yshidsql;
      $guanjiancisql ="`fyr`='".$yshid."'";      
$numq=mysql_query("SELECT * FROM  `yfshqzy` where ".$guanjiancisql);

}*/

$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="赠药申请管理";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span></span>
				</div>
				<div class="incontact w955 flt">
       <div class="top">
<input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期" size="12" value="" class="grd-white" /> -
<input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期" size="12" value="" class="grd-white" />&nbsp;&nbsp;
       <select id="rqlx" name="rqlx"  class="grd-white2">
        <option <?php if($_GET[rqlx]=='1'){echo "selected=\"selected\"";}?> value="1">申请日期</option>
        <option <?php if($_GET[rqlx]=='2'){echo "selected=\"selected\"";}?> value="2">批准日期</option>
        <option <?php if($_GET[rqlx]=='3'){echo "selected=\"selected\"";}?> value="3">发运日期</option>
        <option <?php if($_GET[rqlx]=='4'){echo "selected=\"selected\"";}?> value="4">收到日期</option>

</select><input type="button" value="按日期过滤" class="uusub" onclick="guolv();"  />&nbsp;&nbsp;

<?php

/*$zshsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where `shqzht`='3' and (`yshid`='".$yshid."'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $zshsql .= " or `yshid`='".$yfid[$i]."' ";
  }
}
 $zshsql .= ")";*/
  $zshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='3' and `yfmch`='".$yhgldw."'";
   if($guanjiancisql!=""){
  $zshsql .=" and ".$guanjiancisql;
  }
$zsh=mysql_query($zshsql);
while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];}

/*$ztzhzshsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where `shqzht`='2' and (`yshid`='".$yshid."'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $ztzhzshsql .= " or `yshid`='".$yfid[$i]."' ";
  }
}
 $ztzhzshsql .= ")";*/
  $ztzhzshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='2' and `yfmch`='".$yhgldw."'";
   if($guanjiancisql!=""){
  $ztzhzshsql .=" and ".$guanjiancisql;
  }
$ztzhzsh=mysql_query($ztzhzshsql);
while($ztzhzshRecord = mysql_fetch_array($ztzhzsh)){$ztzhzshjs=$ztzhzshRecord[0];}
?>        &nbsp;已收到总数：<?php echo $zshjs;?>瓶 &nbsp;<?php if($ztzhzshjs>0){ echo "在途中总数：".$ztzhzshjs."瓶";}?></div>
     <div class="top">
<input type="button" value="新增赠药申请" class="uusub" onclick="javascript:{location.href='yshzyshq.php';}" />
           <?php
include('pagefy.php');
          ?>
    </div>
    <div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="8%" align="center" bgcolor="#FFFFFF">
                操作
            </td>
            <td width="9%" align="center" bgcolor="#FFFFFF">
                状态
            </td>  
            <td width="9%" align="center" bgcolor="#FFFFFF">
                申请日期
            </td>  
            <td width="9%" align="center" bgcolor="#FFFFFF">
                批准日期
            </td>  
            <td width="9%" align="center" bgcolor="#FFFFFF">
                发运日期
            </td>  
            <td width="9%" align="center" bgcolor="#FFFFFF">
                收到日期
            </td>  
            <td width="9%" align="center" bgcolor="#FFFFFF">
                运单号
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                批号
            </td>
            <td width="9%" align="center" bgcolor="#FFFFFF">
                应收到数量
            </td>
            <td width="9%" align="center" bgcolor="#FFFFFF">申请手册</td>            
            <td width="9%" align="center" bgcolor="#FFFFFF">
                药师
            </td>
        </tr>
<?php        

  /*$sql = "select * from `yfshqzy` where (`yshid`='".$yshid."' ";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $sql .= " or `yshid`='".$yfid[$i]."' ";
  }
}
$sql .= ")";*/
  $sql = "select * from `yfshqzy` where `yfmch`='".$yhgldw."' ";
  if($guanjiancisql!=""){
  $sql .=" and ".$guanjiancisql;
  }
  $sql .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td  align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"yshzyshqxx.php?id=".$Record[0]."\">详细</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[8]=='0'){echo "新申请";}else if($Record[8]=='1'){echo "已批准";}else if($Record[8]=='2'){echo "在途中";}else if($Record[8]=='3'){echo "已收到";}
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[13]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[14]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[12]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    $phnsql = "select `ph` from `kfrk` where `id`='".$Record[15]."'";
    $phnQuery_ID = mysql_query($phnsql);
    while($phnRecord = mysql_fetch_array($phnQuery_ID)){
      echo $phnRecord[0]." ";
    }
    $phnsql = "select `ph` from `kfrk` where `id`='".$Record[19]."'";
    $phnQuery_ID = mysql_query($phnsql);
    while($phnRecord = mysql_fetch_array($phnQuery_ID)){
      echo $phnRecord[0];
    }
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    echo "申:".($Record[4]+$Record[7])." ";
    if($Record[20]!=""||$Record[21]!=""){echo "批:".($Record[20]+$Record[21]);}
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    echo $Record[26];
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
  /*$yfsql = "select yfzhdysh from `yf` where `id`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){echo $yfRecord[0];}*/
    echo $Record[1];
    echo "</td></tr>";
  } 
?>
        
    </table>
    </div>
    <div class="top">
    
           <?php
include('pagefy.php');
          ?>
       </div>       
        
     <script type="text/javascript">
         function guolv() {
             var url = 'yshzyshqgl.php?kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val()) +'&rqlx=' + $('#rqlx').val();
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
    </div>
    </div>
    </div>
</body>
</html>
