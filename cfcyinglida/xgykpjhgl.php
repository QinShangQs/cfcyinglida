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
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
if($_GET[guanjianci]!=""){
$guanjiancinr=$_GET[guanjianci];
if(substr( $guanjiancinr, 0, 1 )=='s'||substr( $guanjiancinr, 0, 1 )=='S'){
$guanjiancinr=str_ireplace('s','',$guanjiancinr,$i);
$hzhrzid=$guanjiancinr;
}else{
$guanjiancinr=preg_replace('/^0*/', '', $guanjiancinr);
$hzhshqid=$guanjiancinr;
}
/*$sql = "select id from `hzh` where (`hzhid`='".$hzhrzid."' or `hzhxm`='".$guanjiancinr."' or `zhjhm`='".$guanjiancinr."') ";
if($yfidmch[0]!=""){
$sql .= "and (`lyyf`='".$yfidmch[0]."'";
for($i=1;$i<count($yfidmch);$i++)
{
  if($yfidmch[$i]!=null){
    $sql .= " or `lyyf`='".$yfidmch[$i]."' ";
  }
}
}
  $sql .= ")";*/
  if($i>0){$sqlwhere=" `hzhid`='".$hzhrzid."' ";}else{ $sqlwhere=" `hzhxm` LIKE '%".$guanjiancinr."%' or `zhjhm` LIKE '%".$guanjiancinr."%' ";}
  $sql = "select id from `hzh` where ( ".$sqlwhere." ) and `lyyf` in ($yhgldw)";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
$hzhid[]=$Record[0];
}
if($hzhid[0]!=""){
$guanjianci="(`hzhid`='".$hzhid[0]."'";
  for($i=1;$i<count($hzhid);$i++)
  {
    if($yfid[$i]!=null){
      $guanjianci .= " or `hzhid`='".$hzhid[$i]."' ";
    }
  }
$guanjianci .= ")";

}
//echo $guanjianci;
}

$html_title="空药盒回收";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="/manager.php">首页</a>-><a href="xgykpjhgl.php"><?php echo $html_title;?></a></div>
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
<?php

/*$numsql="SELECT * FROM `zyff` where `jhkpshl`>'0' and (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $numsql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
$numsql .=")";*/
  $dqznumquery="select SUM(jhkpshl) from `zyff` WHERE  `zyffzht` IS NULL and `kpzht`='1' and `yfmch` in ($yhgldw)";
  $dqznumresult=mysql_query($dqznumquery);
  //$tjshl = mysql_num_rows($numresult);
  while($dqznumRecord = mysql_fetch_array($dqznumresult)){$dqztjshl =$dqznumRecord[0];}
  $jhznumquery="select SUM(jhkpshl) from `zyff` WHERE  `zyffzht` IS NULL and `kpzht`<>'1' and `yfmch` in ($yhgldw)";
  $jhznumresult=mysql_query($jhznumquery);
  //$tjshl = mysql_num_rows($numresult);
  while($jhznumRecord = mysql_fetch_array($jhznumresult)){$jhztjshl =$jhznumRecord[0];}
  $znumquery="select SUM(jhkpshl) from `zyff` WHERE  `zyffzht` IS NULL and `yfmch` in ($yhgldw)";
  $znumresult=mysql_query($znumquery);
  //$tjshl = mysql_num_rows($numresult);
  while($znumRecord = mysql_fetch_array($znumresult)){$ztjshl =$znumRecord[0];}
$numsql="SELECT * FROM `zyff` where  `zyffzht` IS NULL and `yfmch` in ($yhgldw)";
if($guanjianci!=""){
$numsql .=" and ".$guanjianci;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

?>

                <div class="insinsins" style="width:100%;">
                  <span>
<?php
$tjkpsql="SELECT SUM(`jhkpshl`),SUM(`fyshl`) FROM`zyff` where `kpdbpc`='1' and `zyffzht` IS NULL and `yfmch` in ($yhgldw)";
$tjkpQuery_ID = mysql_query($tjkpsql);
while($tjkpRecord = mysql_fetch_array($tjkpQuery_ID)){
$tjkpzf=$tjkpRecord[0];
$tjkpfy=$tjkpRecord[1];
$tjkphj=$tjkpRecord[0]+$tjkpRecord[1];

}
if($tjkpzf==""){$tjkpzf=0;}
if($tjkpfy==""){$tjkpfy=0;}
if($tjkphj==""){$tjkphj=0;}
echo "患者自费药交回空瓶总数：".$tjkpzf."   发药交回空瓶数：".$tjkpfy."    合计：".$tjkphj." ";
?>  
                  </span>
                </div>


    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <!--th style="width: 36px">
                操作
            </th-->
            <td width="13%" align="center" bgcolor="#FFFFFF">
                患者编码
            </td>
            <td width="13%" align="center" bgcolor="#FFFFFF">
                患者
            </td>
            <td width="18%" align="center" bgcolor="#FFFFFF">
                病种
            </td>
            <td width="15%" align="center" bgcolor="#FFFFFF">
                收到日期
            </td>
            <td width="13%" align="center" bgcolor="#FFFFFF">
                交回数量
            </td>
            <td width="13%" align="center" bgcolor="#FFFFFF">
                经办人
            </td>
            <td width="15%" align="center" bgcolor="#FFFFFF">
                状态
            </td>            
        </tr>
<?php        

  /*$sql = "SELECT * FROM `zyff` where `jhkpshl`>'0' and (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $sql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
  $sql .= ")";*/
  $sql = "SELECT * FROM `zyff` where  `zyffzht` IS NULL and `yfmch` in ($yhgldw)";
if($guanjianci!=""){
$sql .=" and ".$guanjianci;
}
$sql .=" order by id DESC limit $page $pagesize ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  //<td><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td>
    $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj`,`shqbzh` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
  $hzhshj=$hzhRecord[2];
    echo "<tr  style=\"color:#1f4248; font-size:12px;\"><td width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">S-".$hzhRecord[0]."</td><td width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">".$hzhRecord[1]."</td><td width=\"18%\" align=\"center\" bgcolor=\"#FFFFFF\">".$hzhRecord[3]."</td><td width=\"15%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[20]."</td><td width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[7]!=""){echo $Record[7]."个";}else{echo "0个";}
  /*$jbrsql = "select `yhyl1` from `manager` where `id`='".$Record[18]."'";
  $jbrQuery_ID = mysql_query($jbrsql);
  while($jbrRecord = mysql_fetch_array($jbrQuery_ID)){
    echo "<td>".$jbrRecord[0]."</td>";
  }*/
    echo "<td width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
    echo "<td width=\"15%\" align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[23]!=""){echo "瓶:";if($Record[23]=="1"){ echo "在药房";}else if($Record[23]=="2"){ echo "在CFC";}else if($Record[23]=="3"){ echo "在国大";}else if($Record[23]=="4"){ echo "已销毁";}}else{echo "无";}
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
    <script type="text/javascript">
        function chazhao() {
            var url = 'xgykpjhgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        };
    </script>
        </div>
    </div>
</body>
</html>