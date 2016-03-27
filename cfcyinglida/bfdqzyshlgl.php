<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=[0-9]&/", "", $url[query]);
$url[query] = preg_replace("/page=[0-9]/", "", $url[query]);

if($url[query]!="undefined"){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}

$numq=mysql_query("SELECT * FROM `cblxdq`  group by id ");// group by yymch
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];

$guanjiancisql="(`sheng` LIKE '%".$guanjianci."%' or `shi` LIKE '%".$guanjianci."%' or `qu` LIKE '%".$guanjianci."%')";

$numq=mysql_query("SELECT * FROM `cblxdq` where  ".$guanjiancisql." group by id ");
}

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
<title>部分地区赠药管理</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
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
			<div class="thislink">当前位置：<a href="bfdqzyshlgl.php">部分地区赠药管理</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">       
				<strong>部分地区赠药管理</strong><span><a href="bfdqshlxz.php">新增指定地区</a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
					  	<div class="insinsins"><span><input type="text" id="Guanjianci" name="Guanjianci" value="" placeholder="请输入地区名称" class="grd-white" />  <input type="button" class="uusub2" value="查找" onclick="chazhao();" /></span></div>
					  </td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="10%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="10%" align="center" bgcolor="#FFFFFF">地区</td>
              <td width="15%" align="center" bgcolor="#FFFFFF">医保类型</td>
              <td width="15%" align="center" bgcolor="#FFFFFF">户籍类型</td>
              <td width="10%" align="center" bgcolor="#FFFFFF">是否生效</td>
              <td width="40%" align="center" bgcolor="#FFFFFF">备注说明</td>
            </tr>

<?php        

  $sql = "select * from `cblxdq` ";
if($guanjiancisql!=""){
$sql .="where ".$guanjiancisql;
}
  $slq .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"bfdqshlxg.php?id=".$Record[0]."\">修改</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1].$Record[2]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[6]."</td>";
    if($Record[8]=='1'){echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";}else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">停用</td>";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[7]."</td>";
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
            var urlguanjianci = 'bfdqzyshlgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
            location.href = urlguanjianci;
        };
    </script>
</html>