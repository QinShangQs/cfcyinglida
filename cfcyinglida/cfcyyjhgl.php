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

$numq=mysql_query("SELECT * FROM `zyff` where `jhshyyyshl`>'0'");
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];
if(substr( $guanjianci, 0, 1 )=='x'||substr( $guanjianci, 0, 1 )=='X'){
$guanjianci=str_ireplace('x','',$guanjianci,$i);
$hzhrzid=$guanjianci;
}else{
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$hzhshqid=$guanjianci;
}
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$hzhidsql="select `id` from `hzh` where `hzhxm` LIKE '%".$guanjianci."%' or `zhjhm` LIKE '%".$guanjianci."%' or `id` = '".$hzhshqid."' or `hzhid` = '".$hzhrzid."' ";
$jli=0;
$guanjiancisql="(";
  $hzhidQuery_ID = mysql_query($hzhidsql);
  while($hzhidRecord = mysql_fetch_array($hzhidQuery_ID)){
      if($jli==0){$jli=1;
      $guanjiancisql.=" `hzhid`='".$hzhidRecord[0]."'";
      }else{
      $guanjiancisql.=" or `hzhid`='".$hzhidRecord[0]."'";
      }
  }  
$guanjiancisql .= ") ";
//echo $guanjiancisql.$hzhidsql;
$numq=mysql_query("SELECT * FROM `zyff` where `jhshyyyshl`>'0' and ".$guanjiancisql);
}

$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="剩余药物交回明细";
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
                <div class="insinsins" style="width:100%;">
                  <span>
<input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="患者姓名、编码、身份号码" class="grd-white" />
<input type="button" value="查找" onclick="chazhao();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">患者编码</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">患者</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">病种</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">收到日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">交回数量</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">经办人</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">状态</td>
            </tr>
<?php        

  $sql = "SELECT * FROM `zyff` where `jhshyyyshl`>'0' ";
  if($guanjiancisql!=""){
  $sql .="and ".$guanjiancisql;
  }
  $sql .= "  order by id DESC limit $page $pagesize ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  //<td><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td>
    $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
  $hzhshj=$hzhRecord[2];
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">X-".$hzhRecord[0]."</td><td>".$hzhRecord[1]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">肺癌</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[20]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[8]!=""){echo $Record[8]."粒";}else{echo "0粒";}
  /*$jbrsql = "select `yhyl1` from `manager` where `id`='".$Record[18]."'";
  $jbrQuery_ID = mysql_query($jbrsql);
  while($jbrRecord = mysql_fetch_array($jbrQuery_ID)){
    echo "<td>".$jbrRecord[0]."</td>";
  }*/
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[24]!=""){echo "药:";if($Record[24]=="1"){ echo "在药房";}else if($Record[24]=="2"){ echo "在CFC";}else if($Record[24]=="3"){ echo "在国大";}else if($Record[24]=="4"){ echo "已销毁";}}else{echo "无";}
    if($Record[25]=="1"){echo "(非发药交回)";}
    echo "</td></tr>";
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
        function chazhao() {
            var url = 'cfcyyjhgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        };
    </script>
</body>
</html>