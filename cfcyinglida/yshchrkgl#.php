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
$guanjiancisql = "( `pdrq` >= '".$kshrq."' and `pdrq` <= '".$jshrq."' )";

$numsql.=" and ".$guanjiancisql;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
}
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
			<div class="thislink">当前位置：<a href="kfrkgl.php">出入库统计</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>出入库统计</strong>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
       <div class="insinsins">
        <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly"
            placeholder="请输入开始日期" size="12" value=""
            class="input searchInput" /> -
        <input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly"
            placeholder="请输入结束日期" size="12" value=""
            class="input searchInput" />&nbsp;&nbsp;<input type="button" value="按日期过滤" onclick="guolv();" class="lgSub" /> &nbsp;&nbsp;<br />
    </div><br />
             </td>
            </tr>
          </table> 
          
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="10%" align="center" bgcolor="#FFFFFF">药房名称
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">入库总数
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">出库总数
            </td>
        </tr>
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
           
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
$zshsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where `yfmch`='".$yhgldw."'";
if($rkrq!=''){$zshsql .= " and ".$rkrq;}//增加日期筛选条件
$zsh=mysql_query($zshsql);

while($zshRecord = mysql_fetch_array($zsh)){
if($zshRecord[0]>0){echo $zshjs=$zshRecord[0];}else{echo $zshjs=0;}
}
$pfshl1ztsql="SELECT SUM(pfshl1)+SUM(pfshl2) FROM `yfshqzy` where `shqzht`='2' and `yfmch`='".$yhgldw."'";
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
            var url = 'yshchrkgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();
            location.href = url;
        }

        $(function () {
            chooseDateNow('KaishiRiqi', 'JiezhiRiqi',true,true);
            
        });
       
    </script>
</html>

