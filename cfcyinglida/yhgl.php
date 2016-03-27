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

$numq=mysql_query("SELECT * FROM `manager`");// group by yymch
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];

$guanjiancisql="(`names` LIKE '%".$guanjianci."%' or`yhyl1` LIKE '%".$guanjianci."%' or `phones` LIKE '%".$guanjianci."%')";
if($_GET[shf]!=""){
$guanjiancisql .=" and `yhyl2`='".$_GET[shf]."' ";
}
if($_GET[zht]!=""){
$guanjiancisql .=" and `yhzht`='".$_GET[zht]."' ";
}
//echo $guanjiancisql;
$numq=mysql_query("SELECT * FROM `manager` where  ".$guanjiancisql);
}else{
$jlcsh=0;
if($_GET[shf]!=""){
  if($jlcsh==0){ $jlcsh=1;
  $guanjiancisql .=" `yhyl2`='".$_GET[shf]."' ";
  }else{
  $guanjiancisql .=" and `yhyl2`='".$_GET[shf]."' ";
  }
}
if($_GET[zht]!=""){
  if($jlcsh==0){ $jlcsh=1;
  $guanjiancisql .=" `yhzht`='".$_GET[zht]."' ";
  }else{
  $guanjiancisql .=" and `yhzht`='".$_GET[zht]."' ";
  }
}
//echo $guanjiancisql;
$numq=mysql_query("SELECT * FROM `manager` where ".$guanjiancisql);
}
//2024/06/12 徐勤杰修改
$sql_2 = "select * from `manager` ";
$query_2=mysql_query($sql_2);
$num = mysql_num_rows($query_2);//获取总条数
//结束
$pagenum = ceil($num/$pagesize);

  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
$html_title="用户管理";
include('spap_head.php');
?>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yhgl.php">用户管理</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>用户管理</strong><span><a href="yhxz.php">新增用户</a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
					  	<div class="insinsins"><span><input type="text" id="Guanjianci" name="Guanjianci" value="" placeholder="请输入用户名姓名或手机" class="grd-white" /><select id="RoleName" name="RoleName"  class="grd-white2"><option value="">不限角色</option>
<option value="2">CFC</option>
<option value="3">指定药师</option>
<option value="1">库管</option>
</select>
        <select id="IsApproved" name="IsApproved"  class="grd-white2"><option selected="selected" value="">不限是否启用</option>
<option value="1">已启用</option>
<option value="0">未启用</option>
</select>
        <input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span></div>
					  </td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd"> 
          <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="10%" align="center" bgcolor="#FFFFFF">操作</td>
            <td width="15%" align="center" bgcolor="#FFFFFF">用户名</td>
            <td width="15%" align="center" bgcolor="#FFFFFF">姓名</td>
            <td width="20%" align="center" bgcolor="#FFFFFF">手机</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">是否启用</td>
            <td width="30%" align="center" bgcolor="#FFFFFF">已分配角色</td>
          </tr>
<?php        

  $sql = "select * from `manager` ";
if($guanjiancisql!=""){
$sql .=" where ".$guanjiancisql;
}
  $sql .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"xgyh.php?id=".$Record[0]."\">改资料</a> <a href=\"xgmmxt.php?id=".$Record[0]."\">改密码</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[3]."</td>";
    if($Record[14]=="1")
    {
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";
    }else {echo "<td align=\"center\" bgcolor=\"#FFFFFF\">未启用</td>";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[10]=='2'){echo "CFC员工";}
    if($Record[10]=='3'){echo "药房药师";}
    if($Record[10]=='1'){echo "库房管理员";}
    if($Record[10]=='4'){echo "医生";}
    if($Record[10]=='5'){echo "协管员";}
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
				</div>
			</div>
		</div>
	</div>
</div>
</body>
    <script type="text/javascript">
        function chazhao() {            var urlguanjianci = 'yhgl.php?guanjianci=' + encodeURIComponent($("#Guanjianci").val()) + '&shf=' + encodeURIComponent($("#RoleName").val()) + '&zht=' + encodeURIComponent($("#IsApproved").val());
            location.href = urlguanjianci;
        }
    </script>
</html>