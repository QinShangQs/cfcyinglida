<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=[0-9]&/", "", $url[query]);
$url[query] = preg_replace("/&page=[0-9]/", "", $url[query]);
$url[query] = preg_replace("/page=[0-9]/", "", $url[query]);

if($url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

$numsql="SELECT * FROM `yf` where  '1'='1'";// group by yymch
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];

$guanjiancisql="(`yfmch` LIKE '%".$guanjianci."%' or `yfsheng` LIKE '%".$guanjianci."%' or `yfshi` LIKE '%".$guanjianci."%' or `yfzhdysh` LIKE '%".$guanjianci."%' or `yfshj` LIKE '%".$guanjianci."%' or `yfdh` LIKE '%".$guanjianci."%')";

$numsql="SELECT * FROM `yf` where  '1'='1' and ".$guanjiancisql;
}

$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>药房药师管理</title>
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
			<div class="thislink">当前位置：药房药师管理</div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>药房药师管理</strong><span><a href="zhdyfxz.php">新增指定药房</a>  <a href="zhdyfth.php">替换指定药房</a> </span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
					  	<div class="insinsins"><span><input class="grd-white" type="text" id="Guanjianci" name="Guanjianci" value=""
            placeholder="请输入药房省、市、名称、药师姓名、电话号码" style="width:360px;"/> <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
					  </td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
		
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                        <td width="9%" align="center" bgcolor="#FFFFFF">状态</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">城市</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">药房名称</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">指定药师姓名</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">手机(对内)</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">座机(对外)</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">授权药师姓名</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">药房地址</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">授权医师手机</td>
                        <td width="10%" align="center" bgcolor="#FFFFFF">指定药师数量</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">操作</td>
                    </tr>

<?php        
  $sql = "select * from `yf` where '1'='1'";
if($guanjiancisql!=""){
$sql .=" and ".$guanjiancisql;
}
  $sql .= " group by yfdzh order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
$yfsql = "select count(*),SUM(shfzt) from `yf` where `yfmch`='".$Record[1]."'";
$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){$yfyshshl=$yfRecord[0];$yfzt=$yfRecord[1];}
    echo "<tr style=\"color:#1f4248; font-size:12px;\">";
    if($yfzt>'0'){echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";}else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">停用</td>";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[10]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
  if($Record[7]!=1&&$yfzt>'0'){
      $yfsql = "select `yfzhdysh` from `yf` where `yfmch`='".$Record[1]."' and `shfzt`='1'";
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){$yfzhdysh=$yfRecord[0];}
  }else{
      $yfzhdysh=$Record[11];
  }
  echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yfzhdysh."</td>";
  $yshdh=str_replace("/", "</br>", $Record[4]);
  echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yshdh."</td>";
      $yshbgdh=str_replace("/", "</br>", $Record[3]);
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yshbgdh."</td>";
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[19]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[22]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"zhdyfyshgl.php?yfmch=".$Record[1]."\">".$yfyshshl."个指定药师</a> </td>";
    //<a href=\"zhdyfyshxz.php?yfid=".$Record[0]."\">新增指定药师</a>
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($yfyshshl>'1'){echo "<a href=\"zhdyfyshgl.php?yfmch=".$Record[1]."\">修改 </a>";}
    else {echo "<a href=\"zhdyfxg.php?id=".$Record[0]."\">修改 </a>";}
      echo "| <a href=\"zhdyfxq.php?id=".$Record[0]."\">详情</a>";
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
	</div>
</div>
</body>
    <script type="text/javascript">
        var url = "";
        function chazhao() {
            var urlguanjianci = 'zhdyfgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
            location.href = urlguanjianci;
        };
    </script>
</html>