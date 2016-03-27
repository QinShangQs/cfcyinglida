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

$numq=mysql_query("SELECT * FROM `xjsfjl`");// group by yymch
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];
if(substr( $guanjianci, 0, 1 )=='x'||substr( $guanjianci, 0, 1 )=='X'){
$guanjianci=str_ireplace('x','',$guanjianci,$i);
$hzhrzid=$guanjianci;
}else{
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$hzhshqid=$guanjianci;
}
$hzhcxpjsql="(`hzhxm` LIKE '%".$guanjianci."%' or `zhjhm` LIKE '%".$guanjianci."%' or `id` = '".$hzhshqid."' or `hzhid` = '".$hzhrzid."' )";

    $hzhcxsql = "select `id` from `hzh` where ".$hzhcxpjsql."";
$guanjiancisql ="(";
$jli=0;
      $hzhcxQuery_ID = mysql_query($hzhcxsql);
      while($hzhcxRecord = mysql_fetch_array($hzhcxQuery_ID)){
      if($jli==0){$jli=1;
      $guanjiancisql.=" `hzhid`='".$hzhcxRecord[0]."'";
      }else{
      $guanjiancisql.=" or `hzhid`='".$hzhcxRecord[0]."'";
      }
      }
$guanjiancisql .=")";
      

//echo $guanjiancisql.$hzhcxsql;
$numq=mysql_query("SELECT * FROM `xjsfjl` where ".$guanjiancisql);
}
if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$guanjiancisql ="(`sfrq`>='".$_GET[kshrq]."' and `sfrq`<='".$_GET[jshrq]."')";
$numq=mysql_query("SELECT * FROM `xjsfjl` where ".$guanjiancisql);
}
//echo $guanjiancisql;
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
$html_title="随访记录管理";
include('spap_head.php');
?> 
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span><a href="cfchzhsf.php">患者随访</a></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
                <div class="insinsins">
                  <span>
<input type="text" id="Guanjianci" name="Guanjianci" class="grd-white" value="<?php echo $_GET[guanjianci];?>" placeholder="患者姓名,编码,身份号码" style="width:280px" />
<input type="button" value="查找" onclick="chazhao();" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins">
                  <span>
<input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期" size="12" value="" class="grd-white" style="width:120px" />-<input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期" size="12" value="" class="grd-white" style="width:120px" />
<input type="button" value="按日期过滤" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="7%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">随访时间</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">随访方式</td>
              <!--td width="9%" align="center" bgcolor="#FFFFFF">被随访人</td-->
              <td width="9%" align="center" bgcolor="#FFFFFF">与患者的关系</td>
              <td width="17%" align="center" bgcolor="#FFFFFF">随访事件详情</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">随访人</td>
            </tr>
<?php        

  $sql = "select * from `xjsfjl` ";
if($guanjiancisql!=""){
$sql .=" where ".$guanjiancisql;
}
  $sql .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcsfjlxx.php?id=".$Record[1]."\">详细</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[3]."</td>";
    //echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[4]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[5]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[6]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[8]."</td></tr>";
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
            var url = 'cfcsfjlgl.php?kshrq=' + $('#KaishiRiqi').val()
                        + '&jshrq=' + $('#JiezhiRiqi').val();
            location.href = url;
        }
        function chazhao() {
            var urlguanjianci = 'cfcsfjlgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
            location.href = urlguanjianci;
        }

        $(function () {
            chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
        <?php
            if($_GET[kshrq]!=""){
        ?>
            $('#KaishiRiqi').val('<?php echo $_GET[kshrq]; ?>');
        <?php
            }
            if($_GET[jshrq]!=""){
        ?>
            $('#JiezhiRiqi').val('<?php echo $_GET[jshrq]; ?>');
        <?php
            }
        ?>
        });

    </script>
</body>
</html>