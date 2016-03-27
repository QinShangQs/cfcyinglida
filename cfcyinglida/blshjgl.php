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


$numq=mysql_query("SELECT * FROM `blshj`");
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$hzhidsql="select `id` from `hzh` where `hzhxm` LIKE '%".$guanjianci."%' or `zhjhm` LIKE '%".$guanjianci."%'";
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
$numq=mysql_query("SELECT * FROM `blshj` where ".$guanjiancisql);
}
if($_GET[cfcbm]!=""){
$cfcbm=$_GET[cfcbm];
$guanjiancisql = "( `id` = '".$cfcbm."')";
$numq=mysql_query("SELECT * FROM `blshj` where ".$guanjiancisql);
}
if($_GET[hrbm]!=""){
$hrbm=$_GET[hrbm];
$guanjiancisql = "( `hrbm` = '".$hrbm."')";
$numq=mysql_query("SELECT * FROM `blshj` where ".$guanjiancisql);
}
if($_GET[ZuizaoRiqi]!=""&&$_GET[ZuiwanRiqi]!=""){
$ZuizaoRiqi=$_GET[ZuizaoRiqi];
$ZuiwanRiqi=$_GET[ZuiwanRiqi];
$guanjiancisql = "( `hzhrq` >= '".$ZuizaoRiqi."' and `hzhrq` <= '".$ZuiwanRiqi."' )";
$numq=mysql_query("SELECT * FROM `blshj` where ".$guanjiancisql);
}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="不良事件报告管理";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="blshjgl.php"><?php echo $html_title;?></a></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span><a href='blshjglexcel.php'>导出AE汇总表</a></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
                <div class="insinsins" style="width:100%;">
                  <span>
  <input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="请输入患者姓名或身份号码" class="grd-white" />
  <input type="text" id="cfcbm" name="cfcbm" value="<?php echo $_GET[cfcbm];?>" placeholder="CFC编码"  class="grd-white"/>
  <input type="text" id="hrbm" name="hrbm" value="<?php echo $_GET[hrbm];?>" placeholder="辉瑞编码"  class="grd-white"/>
  <input type="button" value="查找" onclick="chazhao();" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins">
                  <span>
<input type="text" id="ZuizaoRiqi" name="ZuizaoRiqi" readonly="readonly" placeholder="请输入获知开始日期" size="12" value="" class="grd-white" />-<input type="text" id="ZuiwanRiqi" name="ZuiwanRiqi"  readonly="readonly" placeholder="请输入获知结束日期" size="12" value="" class="grd-white" />
<input id="btnGuolv" type="button" value="按获知日期过滤" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">          
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="7%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">编码</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">辉瑞编码</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">病种</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">患者</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">事件来源</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">医生是否接收回访</td>
              <td width="11%" align="center" bgcolor="#FFFFFF">赛可瑞用量及用法</td>
              <td width="10%" align="center" bgcolor="#FFFFFF">事件描述</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">获知日期</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">是否继续用药</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">报送辉瑞日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">CFC填表人</td>
            </tr>
<?php        

  $sql = "select * from `blshj` ";
  if($guanjiancisql!=""){
  $sql .="where ".$guanjiancisql;
  }
  $sql .= "order by id DESC limit $page $pagesize ";
  $_SESSION[blshjsql]=$sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"blshjxx.php?id=".$Record[0]."\">详情</a> ";
    if($_SESSION['yhln']=="admin"){
    echo "<a href=\"blshjxg.php?id=".$Record[0]."\">修改</a>";
    }
    echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><span  class=RuxianaiColor>".$Record[0]."</span></td>";
    if($Record[12]!=""){
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><span  class=RuxianaiColor>".$Record[12]."</span></td>";    
    }else{
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"blshjxzhr.php?id=".$Record[0]."\">新增</a></td>";
    }
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><span  class=RuxianaiColor>肺癌</span></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"shqxq.php?id=".$Record[1]."\" title=\"点击查看患者申请详细信息\">";
  $hzhsql = "select `hzhxm` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){echo $hzhRecord[0];}
    echo "</a></td>";
    if($Record[2]==0){$shjly="医生";}else if($Record[2]==1){$shjly="患者";}else if($Record[2]==2){$shjly="患者家属";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$shjly."</td>";
    if($Record[3]==1){$shfjshhf="是";}else if($Record[3]==0){$shfjshhf="否";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$shfjshhf."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[4]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[5]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[6]."</td>";
    if($Record[7]==1){$shfjxyy="是";}else if($Record[7]==0){$shfjxyy="否";}else if($Record[7]==2){$shfjxyy="不详";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$shfjxyy."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[8]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td></tr>";
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
            var url = '';
            if(encodeURIComponent($('#Guanjianci').val())!=""){
              if(url==''){
                url = 'blshjgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
              }else{
                url = url + '&guanjianci=' + encodeURIComponent($('#Guanjianci').val());
              }              
            }             
            if(encodeURIComponent($('#hrbm').val())!=""){
              if(url==''){
                url = 'blshjgl.php?hrbm=' + encodeURIComponent($('#hrbm').val());
              }else{
                url = url + '&hrbm=' + encodeURIComponent($('#hrbm').val());
              }  
            }
            if(encodeURIComponent($('#cfcbm').val())!=""){
              if(url==''){
                url = 'blshjgl.php?cfcbm=' + encodeURIComponent($('#cfcbm').val());
              }else{
                url = url + '&cfcbm=' + encodeURIComponent($('#cfcbm').val());
              }  
            }
            location.href = url;
        };
        function guolv() {
            //var guanjianci = encodeURIComponent($('#Guanjianci').val());guanjianci=' + guanjianci + '&
            var zuizaoRiqi = encodeURIComponent($('#ZuizaoRiqi').val());
            var zuiwanRiqi = encodeURIComponent($('#ZuiwanRiqi').val());
            var url = 'blshjgl.php?ZuizaoRiqi=' + zuizaoRiqi + '&ZuiwanRiqi=' + zuiwanRiqi;
            location.href = url;
        }
        $(function () {
            chooseDateNow('ZuizaoRiqi', 'ZuiwanRiqi', true, true);
        <?php
            if($_GET[ZuizaoRiqi]!=""){
            $_SESSION[blshjzzrq]=date('Y/m/d',strtotime($_GET[ZuizaoRiqi]));
        ?>
            $('#ZuizaoRiqi').val('<?php echo $_GET[ZuizaoRiqi]; ?>');
        <?php
            }else{
            $_SESSION[blshjzzrq]="2014/4/14";
            }
            if($_GET[ZuiwanRiqi]!=""){
            $_SESSION[blshjzwrq]=date('Y/m/d',strtotime($_GET[ZuiwanRiqi]));
        ?>
            $('#ZuiwanRiqi').val('<?php echo $_GET[ZuiwanRiqi]; ?>');
        <?php
            }else{
            $_SESSION[blshjzwrq]="至今";
            }
        ?>
        });
    </script>
</body>
</html>