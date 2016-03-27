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

$html_title="切换药房身份";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置：<a href="qhyfshf.php">管理首页</a> - <?php echo $html_title;?></div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>切换药房药师身份</strong><span>
<!-- 				<a href="#">新增指定医院</a></span> -->
				</div>
    <div class="incontact w955 flt">
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
        <input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>"
            placeholder="请输入药房省、市、名称、药师姓名、电话号码" class="grd-white" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub2" />
    </td>
    </tr>
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
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" width="30px;" bgcolor="#FFFFFF">状态</td>
            <td align="center" width="38px;" bgcolor="#FFFFFF">城市</td>
            <td align="center" bgcolor="#FFFFFF">药房名称</td>
            <td align="center" bgcolor="#FFFFFF">指定药师姓名</td>
            <td align="center" bgcolor="#FFFFFF">药房地址</td>
            <td align="center" bgcolor="#FFFFFF">办公电话</td>
            <td align="center" bgcolor="#FFFFFF">手机号</td>
            <td align="center" bgcolor="#FFFFFF">授权药师姓名</td>
            <td align="center" bgcolor="#FFFFFF">手机号</td>
            <td width="8%" align="center" bgcolor="#FFFFFF">操作</td>
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
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";

        $yshbgdh=str_replace("/", "</br>", $Record[3]);
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yshbgdh."</td>";
    $yshdh=str_replace("/", "</br>", $Record[4]);
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yshdh."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[19]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[22]."</td>";
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"qhyfshfjr.php?yfmch=".$Record[1]."\">进入</a></td>";
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
            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
            </div></div>
    <script type="text/javascript">
        var url = "";
        function chazhao() {
            var urlguanjianci = 'qhyfshf.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
            location.href = urlguanjianci;
        };
    </script>
    <div id="footerCon">
        <div id="foot">
            <div id="footNav">
                <div>
                    <div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
