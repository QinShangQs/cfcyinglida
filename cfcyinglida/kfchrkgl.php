<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhid=$_SESSION['yhid'];
  $sql = "select gldw from `manager` where `id`='$yhid' ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){$dwmch=$Record [0];}
$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=[0-9]&/", "", $url[query]);
$url[query] = preg_replace("/page=[0-9]/", "", $url[query]);

if($url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}
$numsql="SELECT * FROM `kfkcpd` where `dwmch`='$dwmch'";
  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }

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

if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$kshrq=$_GET[kshrq];
$jshrq=$_GET[jshrq];
$guanjiancisql = "( `pdrq` >= '".$kshrq."' and `pdrq` <= '".$jshrq."' )";

$numsql.=" and ".$guanjiancisql;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>出入库统计</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="style/jquery.autocomplete.css" rel="Stylesheet" type="text/css" />
<link href="style/AnniuCaidan.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.all.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.tabs.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.dialog.css" rel="Stylesheet" type="text/css" />
<link href="style/textboxlist.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>

<script type="text/javascript" src="js/SelectDate.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
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
			<div class="thislink">当前位置：<a href="kfchrkgl.php">出入库统计</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>出入库统计</strong><span><?php
  $xtggxxsql = "select id from `xtggxx` where `ggzht`='1' and `tshgn`='1'";
  $xtggxxQuery_ID = mysql_query($xtggxxsql);
  while($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)){
$xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
}
$day=date('d');
if(($day>=1&&$day<=5)||$day==31||$xtggxx==1){
?>
  
<?php
}
?></span>
				</div>
				<div class="incontact w955 flt">
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
       
					  	<div class="insinsins"><span><input class="grd-white" type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期" size="12" value=""/> - <input class="grd-white" type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期" size="12" value=""/>  <input type="button" value="按盘点日期过滤" onclick="guolv();" class="uusub" /></span></div>
					  </td>
                    </tr>
                  </table>
                  
                  
                  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td  width="10%" align="center" bgcolor="#FFFFFF">
                库房名称
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                入库总数(1mg/5mg)
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                出库总数(1mg/5mg)
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                当前库存数量(1mg/5mg)
            </td>
        </tr>
<?php
$id=$_SESSION['yhid'];
$sql = "select gldw from `manager` WHERE  `id` ='$id'";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
$kfmch=$Record[0];
}
//1mg*14片/盒  入库统计
$kfrksql = "select SUM(bjshl) from `kfrk`";
if($shyrq!="")
{//添加判断条件
    $kfrksql .= " where ".$shyrq." and gg='1mg*14片/盒'";
}else{
    $kfrksql .="where gg='1mg*14片/盒'";
}
$kfrkQuery_ID = mysql_query($kfrksql);
while($kfrkRecord = mysql_fetch_array($kfrkQuery_ID)){
$rkzsh=$kfrkRecord[0];
}
//5mg*28片/盒 入库统计
$kfrksql1 = "select SUM(bjshl) from `kfrk`";
if($shyrq!="")
{//添加判断条件
    $kfrksql1 .= " where ".$shyrq." and gg='5mg*28片/盒'";
}else {
    $kfrksql1 .=" where gg='5mg*28片/盒'";
}
$kfrkQuery_ID1 = mysql_query($kfrksql1);
while($kfrkRecord1 = mysql_fetch_array($kfrkQuery_ID1)){
    $rkzsh1=$kfrkRecord1[0];
}

//1mg  出库统计
$kfchksql = "select SUM(pfshl1),SUM(pfshl2) from `yfshqzy` where `shqzht`>='2'";
if($fyrq!="")
{//添加判断条件
    $kfchksql .= " and ".$fyrq." and gg1='1mg'";
}else{
    $kfchksql .= " and gg1='1mg'";
}
$kfchkQuery_ID = mysql_query($kfchksql);
while($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)){
$chkzsh=$kfchkRecord[0]+$kfchkRecord[1];
}

//5mg  出库统计
$kfchksql1 = "select SUM(pfshl1),SUM(pfshl2) from `yfshqzy` where `shqzht`>='2'";
if($fyrq!="")
{//添加判断条件
    $kfchksql1 .= " and ".$fyrq." and gg1='5mg'";
}else{
    $kfchksql1 .= " and gg1='5mg'";
}
$kfchkQuery_ID1 = mysql_query($kfchksql1);
while($kfchkRecord1 = mysql_fetch_array($kfchkQuery_ID1)){
$chkzsh1=$kfchkRecord1[0]+$kfchkRecord1[1];
}



//在运输途中的 1mg 统计
$kfchksql = "select SUM(pfshl1),SUM(pfshl2) from `yfshqzy` where `shqzht`='2'";
if($fyrq!="")
{//添加判断条件
    $kfchksql .= " and ".$fyrq." and gg1='1mg'";
}else{
    $kfchksql .= " and gg1='1mg'";
}
$kfchkQuery_ID = mysql_query($kfchksql);
while($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)){
$chkztzsh=$kfchkRecord[0]+$kfchkRecord[1];
}
//在运输途中的  5mg统计
$kfchksql1 = "select SUM(pfshl1),SUM(pfshl2) from `yfshqzy` where `shqzht`='2'";
if($fyrq!="")
{//添加判断条件
    $kfchksql1 .= " and ".$fyrq." and gg1='5mg'";
}else{
    $kfchksql1 .= " and gg1='5mg'";
}
$kfchkQuery_ID1 = mysql_query($kfchksql1);
while($kfchkRecord1 = mysql_fetch_array($kfchkQuery_ID1)){
$chkztzsh1=$kfchkRecord1[0]+$kfchkRecord1[1];
}
?>
         <tr style="color:#1f4248; font-weight:bold; height:30px;">
           
            <td  width="10%" align="center" bgcolor="#FFFFFF">
                <?php echo $kfmch;?>
            </td>
             <td  width="10%" align="center" bgcolor="#FFFFFF">
             <a href="kfrkgl.php"><?php echo $rkzsh;?>/<?php echo $rkzsh1;?>盒</a>
               
               
            </td>
            <td  width="10%" align="center" bgcolor="#FFFFFF">
             <a href="kfchkgl.php">
                 <?php echo $chkzsh;?>/<?php echo $chkzsh1?>盒
                 <?php if($chkztzsh!=""){echo "(其中".$chkztzsh."/".$chkztzsh1."瓶在途中)";}?></a>
               
                
            </td>
            <td  width="10%" align="center" bgcolor="#FFFFFF">
             <?php echo $rkzsh-$chkzsh;?>/<?php echo $rkzsh1-$chkzsh1;?>盒
               
                
            </td>
         </tr>
       
    </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
                    <tr>
                      <td>

<?php
if($num ){
 if($pageval==""&&$pageval<=1)$pageval=1;///第0页 时出现错误
//echo "共 $num 条  ";
echo "<div class=\"pageright\">
					  	<ul>
							<li class=\"uppage\">";
if($pageval-1<=0){ echo "<a href=".$url."page=1>首页</a></li> ";}
else{ echo "<a href=".$url."page=1>首页</a></li> <li style=\"width:60px;\"><a href=".$url."page=".($pageval-1).">上一页</a>";}
for($i=1;$i<=$pagenum;$i++){
if($pageval==$i){echo "<li class=\"this\">".$i."</li> ";}
else{echo " <li><a href=".$url."page=$i>$i</a></li> ";}
}
if($pageval+1>$pagenum) echo "<li class=\"downpage\">末页</li>";
if($pageval!=$pagenum){ echo "<li style=\"width:60px;\"><a href=".$url."page=".($pageval+1).">下页</a></li>  <li class=\"downpage\"><a href=".$url."page=".($pagenum).">末页</a></li>";}
echo "</ul>
					  </div>";
}
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
        function guolv() {
            var url = 'kfchrkgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();
            location.href = url;
        }
        $(function () {
            chooseDateNow('KaishiRiqi', 'JiezhiRiqi',true,true);
            
        });
    </script>
</html>