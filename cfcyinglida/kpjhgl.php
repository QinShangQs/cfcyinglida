<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $yhgldw = $_SESSION[gldw];
  $yhln = $_SESSION[yhln];
  $yhyshid = $_SESSION[id];
  $yhsql = "select yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yfmch=$yhRecord[0];}
  $yftmsql = "select `yfyshname` from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfyshname[]=$yftmRecord[0];}
    $yfidmchsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yfidmchQuery_ID = mysql_query($yfidmchsql);
  while($yfidmchRecord = mysql_fetch_array($yfidmchQuery_ID)){$yfidmch[]=$yfidmchRecord[0];}
  $yshidsql = "select `id` from `manager` where (`names`='".$yhln."'";
for($i=0;$i<count($yfyshname);$i++)
{
  if($yfyshname[$i]!=null){
    $yshidsql .= " or `names`='".$yfyshname[$i]."' ";
  }
}
$yshidsql .=")";
  $yshidQuery_ID = mysql_query($yshidsql);
  while($yshidRecord = mysql_fetch_array($yshidQuery_ID)){$yshid[]=$yshidRecord[0];}
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
//     if(substr( $guanjiancinr, 0, 1 )=='s'||substr( $guanjiancinr, 0, 1 )=='S'){
//         $guanjiancinr=str_ireplace('s-','',$guanjiancinr,$i);
if(substr( $guanjiancinr, 0, 1 )=='i'||substr( $guanjiancinr, 0, 1 )=='I'){
	$guanjiancinr=str_ireplace('i-','',$guanjiancinr,$i);
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
  $sql = "select id from `hzh` where (`hzhxm` LIKE '%".$guanjiancinr."%' or `zhjhm` LIKE '%".$guanjiancinr."%') and `lyyf`='$yhgldw'";
    if($hzhrzid){
        $sql .=" or `hzhid`='".$hzhrzid."'";
    }
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
if($_GET[KaishiRiqi]!=""){
    if($guanjianci!=""){
        $guanjianci.="and ( `fyrq`>='".$_GET[KaishiRiqi]."')";
    }else{
        $guanjianci="( `fyrq`>='".$_GET[KaishiRiqi]."')";
    }
}

$html_title="空药盒回收";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="kpjhgl.php"><?php echo $html_title;?></a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
					  	<div class="insinsins">
					  	<label><input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>"
            placeholder="姓名、编码、身份证号" class="grd-white2" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub" /></label>
                            <div class="insinsins" style="width: 100%; margin-top: 10px;">
                                <span>

        <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入日期"
               size="12" value=""
               class="grd-white" style="width:120px" />
        <input type="button" value="高级过滤" onclick="guolv();" class="uusub" /></label>
                                </span>
                            </div>
<?php

/*$numsql="SELECT * FROM `zyff` where `jhkpshl`>'0' and (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $numsql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
$numsql .=")";*/
$numsql="SELECT * FROM `zyff` where  `yfmch`='$yhgldw'";
if($guanjianci!=""){
$numsql .=" and ".$guanjianci;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

?>
<div class="insinsins" style="width:100%;">
                  <span>
                  <input type="button" value="打包邮寄(按自然月)" onclick="fahui();" class="uusub" />
<?php
$tjkpsql="SELECT SUM(`jhkpshl`),SUM(`fyshl`) FROM `zyff` where `zyffzht` IS NULL and `yfmch` = '$yhgldw'";
$tjkpQuery_ID = mysql_query($tjkpsql);
while($tjkpRecord = mysql_fetch_array($tjkpQuery_ID)){
$tjkpzf=$tjkpRecord[0];
$tjkpfy=$tjkpRecord[1];
$tjkphj=$tjkpRecord[0]+$tjkpRecord[1];

}
if($tjkpzf==""){$tjkpzf=0;}
if($tjkpfy==""){$tjkpfy=0;}
if($tjkphj==""){$tjkphj=0;}
echo "</br>患者自费药交回空瓶总数：".$tjkpzf."   发药交回空瓶数：".number_format($tjkpfy, 2, '.', '')."    合计：".$tjkphj." ";

$dayyd=date("d",strtotime("+1 day")); 
if($dayyd==1){
$ny=date('Y-m');
}else {
$ny=date('Y-m',strtotime("-1 month"));
}
echo "<a href=\"kpjhglxzpdf.php?ny=".$ny."\">下载《空药盒回收记录表》</a>";
?>  
                  </span>
                </div>
        </div>
    </div>
    
                
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="9%" align="center" bgcolor="#FFFFFF">药盒状态</td>
            <td width="9%" align="center" bgcolor="#FFFFFF">患者姓名</td>
            <td width="9%" align="center" bgcolor="#FFFFFF">唯一编码</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">收到日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">回收数量</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">自购药盒数(5mg)</td>
              <td width="15%" align="center" bgcolor="#FFFFFF">援助药盒数(1mg 5mg)</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">经办人</td>
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
  $sql = "SELECT * FROM `zyff` where `yfmch`='$yhgldw'";
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
      echo "<tr style=\"color:#1f4248;  font-size:12px;\">";
        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
          if($Record[23]!=""){if($Record[23]=="1"){ echo "在药房";}else if($Record[23]=="2"){ echo "在CFC";}else if($Record[23]=="3"){ echo "在国大";}else if($Record[23]=="4"){ echo "已销毁";}}else{echo "无";}
          if($Record[25]=="1"){echo "(非发药交回)";}
        echo "</td>";
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$hzhRecord[1]."</td>";
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">I-".$hzhRecord[0]."</td>";
      echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[20]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    echo ($Record[4]+$Record[7])."";
    echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[7]!=""){echo $Record[7]."";}else{echo "0";}
    echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[4]!=""){echo $Record[4]."";}else{echo "0";}
    echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
      echo "</tr>";
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
            var url = 'kpjhgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        };
        function fahui() {
            if (confirm("确认是否打包寄回？")) {
                    location.href='kpjhglac.php';
            }
        };
        function guolv() {
            var url = 'kpjhgl.php?guanjianci=' +encodeURIComponent($('#Guanjianci').val())
                + '&KaishiRiqi=' + $('#KaishiRiqi').val();
            location.href = url;
        }
        $(function () {
            chooseDate('KaishiRiqi');
            <?php
                if($_GET[KaishiRiqi]!=""){
            ?>
            $('#KaishiRiqi').val('<?php echo $_GET[KaishiRiqi]; ?>');
            <?php
                }
            ?>
        });
    </script>
        </div>
    </div>
</body>
</html>
