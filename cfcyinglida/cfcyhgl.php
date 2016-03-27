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

$numsql="SELECT * FROM `manager` where '1'='1' and `yhyl2`='2' and `names`<>'cfcadmin' ";// group by yymch
$guanjiancisql="";
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];
$guanjiancisql.="and (`names` LIKE '%".$guanjianci."%' or`yhyl1` LIKE '%".$guanjianci."%' or `phones` LIKE '%".$guanjianci."%')";
}
if($_GET[zht]!=""){
$guanjiancisql .=" and `yhzht`='".$_GET[zht]."' ";
}
$numsql.=$guanjiancisql;
$numq=mysql_query($numsql);// group by yymch
//echo $numsql;
$num = mysql_num_rows($numq);//获取总条数

$pagenum = ceil($num/$pagesize);

  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
$html_title="用户权限管理";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
                <div class="insinsins">
                  <span>
<input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="请输入用户名姓名或手机" class="grd-white" />
<select id="IsApproved" name="IsApproved" class="grd-white2" ><option <?php if($_GET[zht]==""){echo "selected=\"selected\"";}?> value="">不限是否启用</option>
<option <?php if($_GET[zht]==1){echo "selected=\"selected\"";}?> value="1">已启用</option>
<option <?php if($_GET[zht]==0){echo "selected=\"selected\"";}?> value="0">未启用</option>
</select>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="7%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">用户名</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">姓名</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">手机</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">是否启用</td>
            </tr>
<?php        

  $sql = "select * from `manager`  where '1'='1'  and `yhyl2`='2' and `names`<>'cfcadmin' ";
if($guanjiancisql!=""){
$sql .=$guanjiancisql;
}
  $sql .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcmanager.php?id=".$Record[0]."\">修改权限</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[3]."</td>";
    if($Record[14]=="1")
    {
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";
    }else {echo "<td align=\"center\" bgcolor=\"#FFFFFF\">未启用</td>";}
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
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
    <script type="text/javascript">
        var url = "";
        function chazhao() { 
            var urlguanjianci = 'cfcyhgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val())+'&zht='+encodeURIComponent($('#IsApproved').val());
            location.href = urlguanjianci;
        };
    </script>
</body>
</html>