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

if($url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}
$numq=mysql_query("SELECT * FROM `xtggxx` group by id");
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
$html_title="系统公告管理";
include('spap_head.php');
?>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="xtggxx.php">系统公告管理</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">       
				<strong>系统公告管理</strong><span><a href="xtggxxxz.php">新增公告信息</a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">				 
          <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="10%" align="center" bgcolor="#FFFFFF">操作</td>
            <td width="20%" align="center" bgcolor="#FFFFFF">公告标题</td>
            <td width="40%" align="center" bgcolor="#FFFFFF">公告内容</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">公告日期</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">公告状态</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">发起人</td>
          </tr>
<?php        

  $sql = "select * from `xtggxx` order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"xtggxxxg.php?id=".$Record[0]."\">修改</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
    if($Record[6]==1){
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">开启盘点";
      if($Record[2]==1){echo "当月";}
      else{echo "上月";}
      echo "库存状态</td>";
    }else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[4]."</td>";
    if($Record[5]==1){echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";}else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">停用</td>";}
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
</html>