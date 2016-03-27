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

if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

$gjcsql=" `shqzht`='入组' ";
if($_GET[gjc]!=""){
  $gjc=$_GET[gjc];

  if(substr( $gjc, 0, 1 )=='x'||substr( $gjc, 0, 1 )=='X'){
    $gjc=str_ireplace('x','',$gjc,$i);
    $gjcsql .=" and (`hzhid`='".$gjc."')";

  }else{
    $gjc=preg_replace('/^0*/', '', $gjc);
    $gjcsql .=" and (`id`='".$gjc."' or `hzhxm` LIKE '%".$gjc."%' or `zhjhm`='".$gjc."')";
  }
}
if($_GET[kshrq]!=""||$_GET[jshrq]!=""){
  $kshrq=$_GET[kshrq];
  $jshrq=$_GET[jshrq];
  if($jshrq!='')
  {
    $xclyrqsql="SELECT * FROM `xclyrq` WHERE `xclyrq`>='".$kshrq."' and `xclyrq`<='".$jshrq."'";
  }else{
    echo $xclyrqsql="SELECT * FROM `xclyrq` WHERE `xclyrq`<='".$kshrq."'";
  }
  $xclyrqQuery_ID = mysql_query($xclyrqsql);
  while($xclyrqRecord = mysql_fetch_array($xclyrqQuery_ID)){
    $xclyrqids[]=$xclyrqRecord[1];
  }
  if(empty($xclyrqids)){
    $xclyrqid=0;
  }else{
    $xclyrqid=implode(",",$xclyrqids);
  } 
  $gjcsql .=" and id in (".$xclyrqid.")";
}
if($gjcsql!=''){
$numq=mysql_query("SELECT * FROM `hzh` where ".$gjcsql);
}else{
$numq=mysql_query("SELECT * FROM `hzh`");
}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="患者随访管理";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="zhzhshqgl.php"><?php echo $html_title;?></a></div>
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
<input type="text" id="gjc" name="gjc" value="<?php echo $_GET[gjc];?>" placeholder="患者姓名、申请号、患者身份号码或患者编码" class="grd-white" style="width: 320px" />
<input type="button" value="查找" onclick="guolv();" class="uusub2" />
                  </span>
                </div>

                <div class="insinsins" style="width:100%;">
                  <label>未领药查询：</label>
                  <span>
<input type="text" id="kshrq" name="kshrq" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="jshrq" name="jshrq" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
<input id="btnGuolv" type="button" value="高级过滤" onclick="guolv();" class="uusub2"/>
                  </span>
                </div>

              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">          
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="6%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">申请病种</td>
              <td width="15%" align="left" bgcolor="#FFFFFF">患者姓名 申请号 编码</br>患者身份号码</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">患者状态</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">最后随访日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">首次申请日期<br/>批准入组日期</td>
              <td width="20%" align="left" bgcolor="#FFFFFF">指定医院 - 指定医生<br/>指定药房</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">审核人</td>
            </tr>

<?php        

  $sql = "select * from `hzh` ";
  if($gjcsql!=""){
  $sql .="where ".$gjcsql;
  }
  $sql .= "order by id DESC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"xzsfjl.php?id=".$Record[0]."\">新增随访</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><span  class=RuxianaiColor>".$Record[7]."</span></td>";
    echo "<td  align=\"left\" bgcolor=\"#FFFFFF\">".$Record[4]."  ";
     echo sprintf("%05d", $Record[0]);
     if($Record[45]==1){echo "网";}
     if($Record[50]==1){echo "二";}
     echo "  ";
     if($Record[2]!=""){
     echo "".$Record[2];}
     echo "<br />".$Record[5].$Record[6]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
if($Record[3]=="申诉审核"||$Record[3]=="申诉待审核"){echo "审核";}else{echo $Record[3];}
 echo "</td>";
 $sfrq_sql="select MAX(sfrq) from `xjsfjl` where `hzhid`='$Record[0]'";
 $sfrq_query=mysql_query($sfrq_sql);
 while($sfrqRecord=mysql_fetch_array($sfrq_query)){
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$sfrqRecord[0]."</td>";
    }
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    //根据要求，无日期显示空白
    if($Record[43]!=""){echo $Record[43];}else{echo " ";} echo "<br />";
    if($Record[34]!=""){echo $Record[34];}else{echo " ";} echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[12]!="")
    {
      $yyid=$Record[12];
    }else if($Record[11]!="")
    {
      $yyid=$Record[11];
    }else{
      $yyid=$Record[9];
    }
      $yysql = "select `sheng`,`shi`,`qu`,`yymch`,`zhdysh`,`yyzhdyf` from `yyyshdq` where id='".$yyid."'";
      //echo $yysql;
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $yyzhdyf=$yyRecord[5];
      //$yyRecord[0].$yyRecord[1].$yyRecord[2]." ".
        echo $yyRecord[3]." ".$yyRecord[4];
      }
     echo "<br />";
      /*$yfsql = "select `yfmch` from `yf` where `yfmch`='".$yyzhdyf."'";
      //echo $yfsql;
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){
        echo $yfRecord[0];
      }*/ 
     echo $yyzhdyf;
     echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
     
     //echo "入组用户";
    $shhejlsql = "select * from `shhejl` where `hzhid`='".$Record[0]."' and id in (select max(id) from `shhejl` where `hzhid`='".$Record[0]."')";
    $shhejlQuery_ID = mysql_query($shhejlsql);
    while($shhejlRecord = mysql_fetch_array($shhejlQuery_ID)){
    $wrzshhr=$shhejlRecord[2];
    }
    if($wrzshhr!=""){echo $wrzshhr;$wrzshhr="";}
    else{
    echo $Record[44];
    }         
     echo "</td></tr>";
    
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
function guolv() {
  var urlguolv = 'cfchzhsf.php?chx=1';//alert(urlguolv);
  if(encodeURIComponent($('#gjc').val())!=''){
    urlguolv = urlguolv +'&gjc=' + encodeURIComponent($('#gjc').val());
  }
  if(encodeURIComponent($('#kshrq').val())!=''){
    urlguolv = urlguolv + '&kshrq=' + encodeURIComponent($('#kshrq').val());
  }
  if(encodeURIComponent($('#jshrq').val())!=''){
    urlguolv = urlguolv + '&jshrq=' + encodeURIComponent($('#jshrq').val());
  }
  location.href = urlguolv;
}

        $(function () {
        <?php
            if($_GET[kshrq]!=""){
        ?>
            $('#kshrq').val('<?php echo $_GET[kshrq]; ?>');
        <?php
            }
            if($_GET[jshrq]!=""){
        ?>
            $('#jshrq').val('<?php echo $_GET[jshrq]; ?>');
        <?php
            }
        ?>
        
            chooseDateNow('kshrq', 'jshrq', true, true);
        });
    </script>

</body>
</html>