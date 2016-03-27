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
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

$numq=mysql_query("SELECT * FROM `yyyshdq`");// group by yymch
$yzhguanjianci =0;
$guanjiancisql = "('1'='1'";
if($_GET[sheng]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `sheng`='".$_GET[sheng]."'";
}
if($_GET[shi]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `shi`='".$_GET[shi]."'";
}
if($_GET[yy]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `yymch` LIKE '%".$_GET[yy]."%'";
}
if($_GET[ysh]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `zhdysh` LIKE '%".$_GET[ysh]."%'";
}
if($_GET[shqysh]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and (`shqysh1` LIKE '%".$_GET[shqysh]."%' or `shqysh2` LIKE '%".$_GET[shqysh]."%' or `shqysh3` LIKE '%".$_GET[shqysh]."%')";
}
if($_GET[pxb]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `yshpxqsh` LIKE '%".$_GET[pxb]."%'";
}
if($_GET[shj]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `zhdyshdh` LIKE '%".$_GET[shj]."%'";
}
if($_GET[yyzht]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `yhszht`='".$_GET[yyzht]."'";
}
$guanjiancisql .= " )";
if($yzhguanjianci==1){
$numq=mysql_query("SELECT * FROM `yyyshdq` where ".$guanjiancisql);
}
//echo $guanjiancisql;
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医院医生管理</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script  src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
</head>

<body>
<div class="wrap">
	<div class="head">
		<div class="head_info">
			<div class="head_left"><img src="./images/tp_left.gif" /></div>
			<div class="head_right">
				<div class="head_right_top"><img src="./images/head_right_top.gif" /></div>
				<div class="head_right_middle">欢迎您，<?php echo $_SESSION[yhname];?> <a href="/">注销</a> <a href="xgmm.php">修改密码</a> <a href="manager.php">首页</a></div>
				<div class="head_right_nav">
					<ul>
						<li><strong><a href="#">高级搜索</a></strong></li>
						<li><strong><a href="#">数据备份</a></strong></li>
						<li><strong><a href="#">不良事件</a></strong></li>
						<li><strong><a href="#">统计</a></strong></li>
						<li><strong><a href="#">转诊</a></strong></li>
						<li><strong><a href="#">随访</a></strong></li>
						<li><strong><a href="#">出组</a></strong></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="zhdyygl.php">医院医生管理</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>指定医院记录</strong><span><a href="zhdyyxz.php">新增指定医院</a> <a href="zhdyshxz.php">新增指定医生</a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
					  	<div class="insinsins"><label style="width:230px;"><select id="s_province" name="sheng" class="grd-white2"></select>&nbsp;&nbsp;<select id="s_city" name="shi" class="grd-white2"></select>&nbsp;&nbsp;</label>
		<script class="resources library" src="js/area.js" type="text/javascript"></script><script type="text/javascript">_init_area();</script><span> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
					  	<div class="insinsins"><label>医　生：</label><span><input class="grd-white" type="text" name="ysh" id="ysh" value="" /> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
						<div class="insinsins"><label>医　院：</label><span><input class="grd-white" type="text" name="yy" id="yy" value="" /> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
						<div class="insinsins"><label>授权医生：</label><span><input class="grd-white"  type="text" name="shqysh" id="shqysh" value="" /> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
						<div class="insinsins"><label>培训班：</label><span><input class="grd-white" type="text" name="pxb" id="pxb" value="" /> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
						<div class="insinsins"><label>手机号：</label><span><input class="grd-white" type="text" name="shj" id="shj" value="" /> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
						<div class="insinsins"><label>状态：</label>
						<span><select id="yyzht" name="yyzht" class="grd-white2">
<option selected="selected" value="">不限状态</option>
<option value="0">停用</option>
<option value="1">启用</option>
</select>  <input type="button" class="uusub" value="全部查找" onclick="chazhao();" /></span></div>
					  </td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                      <td width="10%" align="center" bgcolor="#FFFFFF">操作</td>
                      <td width="7%" align="center" bgcolor="#FFFFFF">省</td>
                      <td width="6%" align="center" bgcolor="#FFFFFF">市</td>
                      <td width="17%" align="center" bgcolor="#FFFFFF">医院名称</td>
                      <td width="9%" align="center" bgcolor="#FFFFFF">指定医生</td>
                      <td width="9%" align="center" bgcolor="#FFFFFF">授权医生</td>
                      <td width="12%" align="center" bgcolor="#FFFFFF">培训班</td>
                      <td width="21%" align="center" bgcolor="#FFFFFF">医院地址</td>
<!--                       <td width="9%" align="center" bgcolor="#FFFFFF">治疗病种</td> -->
                    </tr>
<?php        

$sql = "select * from `yyyshdq` ";
if($yzhguanjianci==1){
$sql .=" where ".$guanjiancisql;
}
  $sql .= " order by sheng ASC,shi ASC,yymch ASC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"zhdyyglxg.php?id=".$Record[0]."\">修改</a> <a href=\"zhdyyglxx.php?id=".$Record[0]."\">详情</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[24]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[3]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[6]."</td>";
    //echo "<td>".$Record[7]."</td>";
    if($Record[9]!=""&&$Record[12]!=""){$yy912=",";}else{$yy912="";}
    if($Record[15]!=""&&$Record[12]!=""){$yy1215=",";}else{$yy1215="";}
    if($Record[9]!=""&&$Record[12]==""&&$Record[15]!=""){$yy915=",";}else{$yy915="";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9].$yy912,$Record[12].$yy915.$yy1215.$Record[15]."</td>";
    //echo "<td>".$Record[11]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
    if($Record[1]==$Record[24]){$yyshsh=$Record[1];}else{$yyshsh=$Record[1].$Record[24];}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yyshsh.$Record[26].$Record[20]."</td></tr>"; // <td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[28]."///</td>
    /*echo "<td>";if($Record[21]=="1"){echo "是";}else{echo "否";}echo"</td>";
    echo "<td>";if($Record[23]=="1"){echo "是";}else{echo "否";}echo"</td>";
    echo "<td><a href=\"zhdyyglyshxx.php?yymch=".$Record[3]."\">";
$yshsql = "select count(*) from `yyyshdq` where `yymch`='".$Record[3]."'";
$yshQuery_ID = mysql_query($yshsql);
while($yshRecord = mysql_fetch_array($yshQuery_ID)){echo $yshRecord[0];}
    echo "个指定医生</a> <a href=\"xzzhdysh.php?yyid=".$Record[0]."\">新增指定医生</a></td></tr>";*/
  } 
?>
                  </table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
                    <tr>
                      <td>
<?php
  $tjzshsql = "select COUNT(DISTINCT sheng),COUNT(DISTINCT shi),COUNT(DISTINCT yymch),COUNT(DISTINCT zhdyshdh),COUNT(DISTINCT shqyshdh1),COUNT(DISTINCT shqyshdh2),COUNT(DISTINCT shqyshdh3) from `yyyshdq` ";
if($yzhguanjianci==1){
$tjzshsql .=" where ".$guanjiancisql;
}
  $tjzshQuery_ID = mysql_query($tjzshsql);
  while($tjzshRecord = mysql_fetch_array($tjzshQuery_ID)){
  $shengshz=$tjzshRecord[0];
  $shishz=$tjzshRecord[1];
  $yymchshz=$tjzshRecord[2];
  $zhdyshshz=$tjzshRecord[3];
  $shqyshshz=$tjzshRecord[4]+$tjzshRecord[5]+$tjzshRecord[6]-3;
  }
  if($shqyshshz<0){$shqyshshz=0;}
  echo "<div class=\"pageleft\">共有".$shengshz."个省，".$shishz."个市，".$yymchshz."家医院，".$zhdyshshz."名指定医生，".$shqyshshz."名授权医生 </div>";

include('pagefy.php');
          ?>
					  </td>
                    </tr>
                  </table>
				</div>

			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
        var url = "";
        function chazhao() {
        var urlguanjianci = "zhdyygl.php";
        var jlsh=0;//记录数初始等于0
//省
if($('#s_province').val()!="省份"){
var sheng = encodeURIComponent($('#s_province').val().replace(/[ ]/g,""));
}else{var sheng = "";}
//市
if($('#s_city').val()!="地级市"){
var shi = encodeURIComponent($('#s_city').val().replace(/[ ]/g,""));
}else{var shi = "";}
//医院
var yy = encodeURIComponent($('#yy').val().replace(/[ ]/g,""));
//指定医生
var ysh = encodeURIComponent($('#ysh').val().replace(/[ ]/g,""));
//授权医生
var shqysh = encodeURIComponent($('#shqysh').val().replace(/[ ]/g,""));
//培训班
var pxb = encodeURIComponent($('#pxb').val().replace(/[ ]/g,""));
//手机号
var shj = encodeURIComponent($('#shj').val().replace(/[ ]/g,""));
//状态
var yyzht = encodeURIComponent($('#yyzht').val().replace(/[ ]/g,""));
if(sheng!=""&&sheng!="省份"){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&sheng=" + sheng;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?sheng=" + sheng;
  }
}
if(shi!=""&&shi!="地级市"){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shi=" + shi;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shi=" + shi;
  }
}
if(yy!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&yy=" + yy;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?yy=" + yy;
  }
}
if(ysh!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&ysh=" + ysh;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?ysh=" + ysh;
  }
}
if(shqysh!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shqysh=" + shqysh;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shqysh=" + shqysh;
  }
}
if(pxb!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&pxb=" + pxb;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?pxb=" + pxb;
  }
}
if(shj!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shj=" + shj;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shj=" + shj;
  }
}
if(yyzht!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&yyzht=" + yyzht;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?yyzht=" + yyzht;
  }
}
            location.href = urlguanjianci;
        };

    </script>
</html>