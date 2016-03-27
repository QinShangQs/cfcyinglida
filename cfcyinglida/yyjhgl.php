<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $yhgldw = $_SESSION[gldw];
  $yhln = $_SESSION[yhln];
  $yhyshid = $_SESSION[id];
  $yhsql = "select yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yfmch=$yhRecord[0];}
  $yftmsql = "select `yfyshname`,`id` from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfyshname[]=$yftmRecord[0];$yfidmch[]=$yftmRecord[1];}
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
if(substr( $guanjiancinr, 0, 1 )=='x'||substr( $guanjiancinr, 0, 1 )=='X'){
$guanjiancinr=str_ireplace('x-','',$guanjiancinr,$i);
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
  $sql = "select id from `hzh` where ( `hzhxm` LIKE '%".$guanjiancinr."%' )  and `lyyf`='$yhgldw'";
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
//print_r($hzhid);
} 
$html_title="药品归还";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yyjhgl.php"><?php echo $html_title;?></a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span><a href="#"></a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
					  	<div class="insinsins" style="width: 100%;">
					  	<label><input type="text" id="Guanjianci" name="Guanjianci" value=""
            placeholder="姓名、唯一编码" class="grd-white2" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub" /></label>
<?php

/*$numsql="SELECT * FROM `zyff` where `jhshyyyshl`>'0' and (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $numsql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
$numsql .=")";*/
$numsql="SELECT * FROM `zyff` where `jhshyyyshl`>'0' and `yfmch`='$yhgldw'";
if($guanjianci!=""){
$numsql .=" and ".$guanjianci;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

?>
        <div class="insinsins" style="width:100%;"><label>
        <input type="button" value="打包邮寄回CFC" onclick="fahui();" class="uusub"  /></label></div>
            &nbsp;&nbsp;
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
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <!--th style="width: 36px">
                操作
            </th-->
            <td width="13%" align="center" bgcolor="#FFFFFF">
                患者姓名
            </td>
            <td width="13%" align="center" bgcolor="#FFFFFF">
                唯一编码
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

  /*$sql = "SELECT * FROM `zyff` where `jhshyyyshl`>'0' and (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $sql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
  $sql .= ")";*/
$sql = "SELECT * FROM `zyff` where `jhshyyyshl`>'0' and `yfmch`='$yhgldw'";  
if($guanjianci!=""){
$sql .=" and ".$guanjianci;
}
$sql .=" order by id DESC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  //<td><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td>
    $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
  $hzhshj=$hzhRecord[2];
    echo "<tr style=\"color:#1f4248; font-weight:bold; height:30px;\">";
      echo "<td  width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">".$hzhRecord[1]."</td>";
      echo "<td  width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">X-".$hzhRecord[0]."</td>";
      echo "<td   width=\"18%\" align=\"center\" bgcolor=\"#FFFFFF\">肺癌</td>";
      echo "<td   width=\"15%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[20]."</td>";
      echo "<td  width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">";
            if($Record[8]!=""){echo $Record[8]."粒";}else{echo "0粒";}
  /*$jbrsql = "select `yhyl1` from `manager` where `id`='".$Record[18]."'";
  $jbrQuery_ID = mysql_query($jbrsql);
  while($jbrRecord = mysql_fetch_array($jbrQuery_ID)){
    echo "<td>".$jbrRecord[0]."</td>";
  }*/
    echo "<td  width=\"13%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
    echo "<td  width=\"15%\" align=\"center\" bgcolor=\"#FFFFFF\">";
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
    <script type="text/javascript">
        function chazhao() {
            var url = 'yyjhgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        };
        function fahui() {
            if (confirm("确认是否打包寄回？")) {
                    location.href='yyjhglac.php';
            }
        };

    </script>

            
        </div>
    </div>
    </div>
</body>
</html>
