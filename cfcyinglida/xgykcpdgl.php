<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
$yhqxxf=str_ireplace(",","','","'".implode(",",$_SESSION[yhqxxf])."'");
$xgyyfsql = "select `yfmch` from `yf` where `yfshi` in (".$yhqxxf.")  group by  yfmch order by id DESC ";
//echo $sql;
$xgyyfQuery_ID = mysql_query($xgyyfsql);
$xgyyf="";
while($xgyyfRecord = mysql_fetch_array($xgyyfQuery_ID)){
  if($xgyyf!=""){
    $xgyyf.=",";
  }
  $xgyyf.="'".$xgyyfRecord[0]."'";
}
$yhgldw=$xgyyf;
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
$numsql="SELECT * FROM `kfkcpd` where `dwmch` in ($yhgldw)";
  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
if($_GET[pdny]!=""){
$selpdnysql = " ( `dzhny` = '".$_GET[pdny]."') ";

$numsql.=" and ".$selpdnysql;
}
if($_GET[pdyf]!=""){
$selpdyfsql = " ( `dwmch` = '".$_GET[pdyf]."') ";

$numsql.=" and ".$selpdyfsql;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="库存盘点";
include('spap_head.php');
?>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="/manager.php">首页</a>-><a href="xgykcpdgl.php"><?php echo $html_title;?></a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>库存盘点</strong>
				</div>
				<div class="incontact w955 flt">
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
           <td>
           <div class="insinsins" style="width:100%;">
    <script type="text/javascript" src="js/jquery.alerts.js" charset="gb2312"class="grd-white2"></script>
    <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery.alerts.js" charset="gb2312"></script>
    <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
        <select id="pdny" name="pdny"  style="width: 120px;">
          <option value="">不限日期</option>
<?php        
    $pdnysql= "select * from `kfkcpd` where `dwmch` in ($yhgldw) group by `dzhny` order by `dzhny` DESC";
  $pdnyQuery_ID = mysql_query($pdnysql);
  while($pdnyRecord = mysql_fetch_array($pdnyQuery_ID)){
    echo "<option value=\"".$pdnyRecord[1]."\"> ".$pdnyRecord[1]."</option>";
  }
?>    
</select>&nbsp;&nbsp;
        <select id="pdyf" name="pdyf"  style="width: 300px;">
          <option value="">全部药房</option>
<?php        
    $pdyfsql= "select * from `yf` where `yfmch` in ($yhgldw) group by `yfmch` order by `yfshijx` ASC";
  $pdyfQuery_ID = mysql_query($pdyfsql);
  while($pdyfRecord = mysql_fetch_array($pdyfQuery_ID)){
    echo "<option value=\"".$pdyfRecord[1]."\">".$pdyfRecord[15]." ".$pdyfRecord[14]." ".$pdyfRecord[1]."</option>";
  }
?>    
</select>&nbsp;&nbsp;
        <input type="button" value="按盘点日期过滤" onclick="guolv();" class="lgSub" />
        </span>
                </div>
              </td>
            </tr>
          </table>  
          
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td rowspan="2" align="center" bgcolor="#FFFFFF">单位名称</td>
            <td rowspan="2" align="center" bgcolor="#FFFFFF">对账年月</td>
            <td rowspan="2" align="center" bgcolor="#FFFFFF">盘点日期</td>
            <td rowspan="2" align="center" bgcolor="#FFFFFF">盘点人</td>
            <td colspan="5" align="center" bgcolor="#FFFFFF">库存盘点明细</td>          
        </tr>
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
          <td align="center" bgcolor="#FFFFFF">赠药批号</td>
          <td align="center" bgcolor="#FFFFFF">期初库存</td>
          <td align="center" bgcolor="#FFFFFF">本月入库</td>
          <td align="center" bgcolor="#FFFFFF">本月出库</td>
          <td align="center" bgcolor="#FFFFFF">实际库存</td>
        </tr>

<?php 
  /*$sql = "select yfmch from `yf` ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){$dwmch=$Record [0];}*/
         
  //$sql = "select * from `kfkcpd` where `dwmch`='$dwmch'";
  $sql = "select * from `kfkcpd` where `dwmch` in ($yhgldw)";
  if($selpdnysql!=""){
  $sql .=" and ".$selpdnysql;
  }
  if($selpdyfsql!=""){
  $sql .=" and ".$selpdyfsql;
  }
  $sql .=" order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>

<tr style="color:#1f4248; font-size:12px;">
  <td align="center" bgcolor="#FFFFFF"><?php echo $Record[4];?></td>
  <td align="center" bgcolor="#FFFFFF"><?php echo $Record[1];?></td>
  <td align="center" bgcolor="#FFFFFF"><?php echo $Record[2];?></td>
  <td align="center" bgcolor="#FFFFFF"><?php 
  $pdrsql = "select yhyl1 from `manager` where `id`='$Record[3]' ";
  $pdrQuery_ID = mysql_query($pdrsql);
  while($pdrRecord = mysql_fetch_array($pdrQuery_ID)){echo $pdrRecord[0];}
  ?></td>
  <?php
  $mxsql = "select `ypph`,`qchkc`,`byrk`,`bychk`,`shjkc` from `kfkcpdmx` where `pdid`='".$Record[0]."'";
  //echo $mxsql;
  $mxQuery_ID = mysql_query($mxsql);
  $mxi=0;
  $mxi1=0;
  while($mxRecord = mysql_fetch_array($mxQuery_ID)){

    if($mxRecord[1]=="0"&&$mxRecord[2]=="0"&&$mxRecord[3]=="0"&&$mxRecord[4]=="0"){$mxi1++;}else{  
    if($mxi>0&&$mxi1==0){echo "<tr>
      <td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td>";}    
  ?>
      <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[0];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[1];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[2];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[3];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[4];?></td>
      </tr>
  <?php
      $hjqchshl+=$mxRecord[1];
      $hjrkshl+=$mxRecord[2];
      $hjchkshl+=$mxRecord[3];
      $hjshjshl+=$mxRecord[4];
    }$mxi++;
  }if($mxi==$mxi1){
  ?>
      <td align="center" bgcolor="#FFFFFF">无</td>
      <td align="center" bgcolor="#FFFFFF">无</td>
      <td align="center" bgcolor="#FFFFFF">无</td>
      <td align="center" bgcolor="#FFFFFF">无</td>
      <td align="center" bgcolor="#FFFFFF">无</td>
      </tr>
  <?php
  }if($mxi!=$mxi1){
echo "<tr style=\"color:#1f4248; font-size:12px;\">
      <td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td>";
  ?>
      <td align="center" bgcolor="#FFFFFF">合计：</td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $hjqchshl;$hjqchshl=0;?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $hjrkshl;$hjrkshl=0;?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $hjchkshl;$hjchkshl=0;?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $hjshjshl;$hjshjshl=0;?></td>
      </tr>
<?php
    }
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
        function guolv() {
          if($('#pdny').val()!=""||$('#pdyf').val()!=""){
            var url = 'xgykcpdgl.php?pdny=' + $('#pdny').val() + '&pdyf=' + $('#pdyf').val();

            location.href = url;
          }
        }

        $(function () {
            $("#pdny").val('<?php echo $_GET[pdny];?>');
            $("#pdyf").val('<?php echo $_GET[pdyf];?>');
        });   
    </script>

</body>
</html>
