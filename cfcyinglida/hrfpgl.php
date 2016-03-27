<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$pagesize=10;//每页显示的条数：
/*$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=(\d+)&/", "", $url[query]);
$url[query] = preg_replace("/&page=(\d+)/", "", $url[query]);
$url[query] = preg_replace("/page=(\d+)/", "", $url[query]);

if($url[query]!="undefined"&&$url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}*/
$numq=mysql_query("SELECT * FROM `hrfpdj`");
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="发票列表";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
    <div class="thislink">当前位置： <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong><?php echo $html_title;?></strong><span><a href="hrxzfp.php">新增发票</a></span>
    </div>
    <div class="incontact w955 flt">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
      <tr style="color:#1f4248; font-weight:bold; height:30px;">
        <td width="15%" align="center" bgcolor="#FFFFFF">操作</td>
        <td width="20%" align="center" bgcolor="#FFFFFF">发票号码</td>
        <td width="20%" align="center" bgcolor="#FFFFFF">药房信息</td>
        <td width="20%" align="center" bgcolor="#FFFFFF">用户信息</td>
        <td width="15%" align="center" bgcolor="#FFFFFF">发票日期</td>
        <td width="10%" align="center" bgcolor="#FFFFFF">状态</td>
      </tr>
    <?php 
    $sql = "select * from `hrfpdj`";
    $query = mysql_query($sql);
    while($result = mysql_fetch_array($query)){
    ?>
    <tr style="color:#1f4248; font-size:12px;">
      <td align="center" bgcolor="#FFFFFF"><a href="hrfpxg.php?id=<?php echo $result[0];?>">修改</a></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $result[1];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $result[2];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $result[3];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $result[4];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php if($result[5]=='1') echo "有效";else echo "无效";?></td>
    </tr>
    <?php
    }
    ?>
     </table>
     <div class="top">
     <?php
include('pagefy.php');
          ?>
          </div>
     </div>
    </div>
    </div>
</div>
</body>
</html>