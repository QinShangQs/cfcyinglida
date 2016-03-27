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
$html_title="药品申请";
include('spap_head.php');
?>

	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshdgl.php"><?php echo $html_title;?></a></div>
       <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span></span></div>
    <div class="incontact w955 flt">
     <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td><div class="insinsins"><label>
        <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly"  class="grd-white" placeholder="请输入开始日期" size="12" value=""/> -
        <input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly"
            placeholder="请输入结束日期" size="12" value=""
             class="grd-white" />&nbsp;&nbsp;
        <select id="rqlx" name="rqlx" style="width:120px;" class="grd-white2"  >
        <option <?php if($_GET[rqlx]=='1'){echo "selected=\"selected\"";}?> value="1">申请日期</option>
        <option <?php if($_GET[rqlx]=='2'){echo "selected=\"selected\"";}?> value="2">批准日期</option>
        <option <?php if($_GET[rqlx]=='3'){echo "selected=\"selected\"";}?> value="3">发运日期</option>
        <option <?php if($_GET[rqlx]=='4'){echo "selected=\"selected\"";}?> value="4">收到日期</option>

</select>    
            <input type="button" value="按日期过滤" onclick="guolv();" class="uusub" />&nbsp;&nbsp;</td>
            
    
<?php


/*$zshsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where ( `yshid`='".$yshid."'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $zshsql .= " or `yshid`='".$yfid[$i]."' ";
  }
}
$zshsql .= ")";*/
  $zshsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `yfmch`='".$yhgldw."'";
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
?> 
<input type="button" value="新增赠药申请" class="uusub" onclick="javascript:{location.href='yshzyshq.php';}" />       &nbsp;已收到总数：<?php echo ($zshjs-$ztzhzshjs);?>瓶 &nbsp;<?php if($ztzhzshjs>0){ echo "在途中总数：".$ztzhzshjs."瓶";}?></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
            <tr>
              <td>
           <?php
include('pagefy.php');
          ?>
              </td>
            </tr>
          </table>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="8%" align="center" bgcolor="#FFFFFF">
                状态
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                运单号
            </td>
            <td width="8%" align="center" bgcolor="#FFFFFF">
                申请日期
            </td>  
            <td width="8%" align="center" bgcolor="#FFFFFF">
                批准日期
            </td>  
            <td width="8%" align="center" bgcolor="#FFFFFF">
                发货日期
            </td>  
            <td width="8%" align="center" bgcolor="#FFFFFF">
                签收日期
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                申请数量
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                实收数量
            </td>
            <td  width="10%" align="center" bgcolor="#FFFFFF">
                批号
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                药师姓名
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                操作
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
    echo "<tr style=\"color:#1f4248; font-size:12px;\">";
    echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[8]=='0')
    {
        echo "申请中";
    }else if($Record[8]=='1')
    {
        echo "已审批";
    }else if($Record[8]=='2')
    {
        echo "已发货";
    }else if($Record[8]=='3')
    {
        echo "已签收";
    }
    echo "</td>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[12]."</td>";
    echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td>";
    echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
    echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[13]."</td>";
    echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[14]."</td>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."<br>".$Record[4]."盒"."</td>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
      if($Record[20]!=""||$Record[21]!="")
      {
          echo "申:".($Record[4]+$Record[7])." 批:".($Record[20]+$Record[21]);
      }else{
          echo "申:".($Record[4]+$Record[7]);
      }
    echo "</td>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
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
    echo "</td>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
  /*$yfsql = "select yfzhdysh from `yf` where `id`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){echo $yfRecord[0];}*/
    echo $Record[1];
    echo "</td>";
    echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
    echo "<a href=\"yshzyshqbpdf.php?id=".$Record[0]."\">申请表</a>";
    if($Record[8]=='2')
    {
      echo "|<a href=\"yshzyshd.php?id=".$Record[0]."\">收到</a>";
    }else if($Record[8]=='3')
    {
      echo "|<a href=\"yshzyshdbpdf.php?id=".$Record[0]."\">收到表</a>";
    }
    echo "</td>";
    echo "</tr>";
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
          </tr>
      </table>
     <script type="text/javascript">
         function guolv() {
             var url = 'yshzyshdgl.php?kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val()) +'&rqlx=' + $('#rqlx').val();
             location.href = url;
         }

         $(function () {
             chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
         });
    </script>
    </div>
        </div>
    </div>
</body>
</html>
