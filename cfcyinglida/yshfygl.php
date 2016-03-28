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
  $yhln = $_SESSION[yhln];
  $yhid = $_SESSION[yhid];
  $yhgldw = $_SESSION[gldw];
  $yfsql = "select yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){$yfmch=$yfRecord[0];}
  $yshtmsql = "select id from `manager` where `gldw`='".$yfmch."'";
  $yshtmQuery_ID = mysql_query($yshtmsql);
  while($yshtmRecord = mysql_fetch_array($yshtmQuery_ID)){$yshid[]=$yshtmRecord[0];}
  $yfidmchsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yfidmchQuery_ID = mysql_query($yfidmchsql);
  while($yfidmchRecord = mysql_fetch_array($yfidmchQuery_ID)){$yfidmch[]=$yfidmchRecord[0];}

if($_GET[guanjianci]!=""){ 
$guanjiancinr=$_GET[guanjianci];
// if(substr( $guanjiancinr, 0, 1 )=='s'||substr( $guanjiancinr, 0, 1 )=='S'){
// $guanjiancinr=str_ireplace('s','',$guanjiancinr,$i);
if(substr( $guanjiancinr, 0, 1 )=='i'||substr( $guanjiancinr, 0, 1 )=='I'){
	$guanjiancinr=str_ireplace('i','',$guanjiancinr,$i);
$hzhrzid=$guanjiancinr;
}else{
$guanjiancinr=preg_replace('/^0*/', '', $guanjiancinr);
$hzhshqid=$guanjiancinr;
}
$sql = "select id from `hzh` where (`hzhid`='".$hzhrzid."' or `hzhxm` LIKE '%".$guanjiancinr."%' or `zhjhm` LIKE '%".$guanjiancinr."%' or `ypgg` LIKE '%".$guanjiancinr."%')  and (`lyyf`='".$yhgldw."' )";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
//echo $Record[0];
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
if($_GET[KaishiRiqi]!=""&&$_GET[JiezhiRiqi]!=""){
if($guanjianci!=""){
$guanjianci.="and ( `fyrq`>='".$_GET[KaishiRiqi]."' and `fyrq`<='".$_GET[JiezhiRiqi]."')";
}else{
$guanjianci="( `fyrq`>='".$_GET[KaishiRiqi]."' and `fyrq`<='".$_GET[JiezhiRiqi]."')";
}
}
//if($_GET[shqbzh]!=""){
//if($guanjianci!=""){
//$guanjianci.="and `bzh`='".$_GET[shqbzh]."' ";
//}else{
//$guanjianci=" `bzh`='".$_GET[shqbzh]."' ";
//}
//}

$html_title="药品发放流向";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshfygl.php"><?php echo $html_title;?></a> </div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span></span>
				</div>
				<div class="incontact w955 flt">
       <table width="100%" border="0" cellspacing="0" cellpadding="5">
       <tr>
          <td><div class="insinsins"><label>
        <input type="text" id="Guanjianci" name="Guanjianci" class="grd-white" value="<?php echo $_GET[guanjianci];?>"
            placeholder="患者姓名,编码,身份号码,药品规格" style="width:280px" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub" /> <br /></label></div><div class="insinsins"  style="width:100%;"><label>
<!--        <select id="shqbzh" class="grd-white2" name="shqbzh" style="width:113px"><option value="">不限申请病种</option>-->
<!--<option value="RCC" --><?php //if($_GET['shqbzh']=="RCC"){ echo " selected=\"selected\"";}?><!--RCC</option>-->
<!--<option value="pNET" --><?php //if($_GET['shqbzh']=="pNET"){ echo " selected=\"selected\"";}?><!--pNET</option>-->
<!--<option value="GIST" --><?php //if($_GET['shqbzh']=="GIST"){ echo " selected=\"selected\"";}?><!--GIST</option>-->
<!--</select>-->
        <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期"
            size="12" value=""
            class="grd-white" style="width:120px" />
        -
        <input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期"
            size="12" value=""
            class="grd-white" style="width:120px" />
        <input type="button" value="高级过滤" onclick="guolv();" class="uusub" /></label>
    </div>
    <br /></td>
            
    </tr>
      </table>
   
<?php

/*$numsql="SELECT * FROM `zyff` where (`fyr`='$yhid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $numsql .= " or `fyr`='".$yshid[$i]."' ";
  }
};
$numsql .=")";*/
$numsql="SELECT * FROM `zyff` where `yfmch`='$yhgldw'";
if($guanjianci!=""){
$numsql .=" and ".$guanjianci;
}
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);
$pagenum = ceil($num/$pagesize);

/*$zshsql="SELECT SUM(fyshl),SUM(jhkpshl) FROM `zyff` where `tshqk`='0' and (`fyr`='$yhid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $zshsql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
$zshsql .= ")";*/
$zshsql="SELECT SUM(fyshl),SUM(jhkpshl) FROM `zyff` where `tshqk`='0' and `yfmch`='$yhgldw'";
if($guanjianci!=""){
$zshsql .=" and ".$guanjianci;
}
$zsh=mysql_query($zshsql);
//echo $zshsql;
while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];$jhkpshl=$zshRecord[1];}
?>
<div class="insinsins" style="width:100%;"><label><span>共计：<?php echo $zshjs+$jhkpshl ;?>盒&nbsp;已发药品总数: <?php echo $zshjs;?>盒&nbsp;回收空药盒总数:<?php echo $jhkpshl;?>盒</span></label></div>
      
 
        
        
        <div class="insinsins">
            <a href="yshfyglexcel.php" target=_blank>导出</a>&nbsp;&nbsp; </div>
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
            <td width="8%" align="center" bgcolor="#FFFFFF">发药日期 </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">患者姓名</td>
            <td width="8%" align="center" bgcolor="#FFFFFF">唯一编码</td>
            <td width="8%" align="center" bgcolor="#FFFFFF">规格</td>
            <td width="8%" align="center" bgcolor="#FFFFFF">发药盒数</td>
            <td width="8%" align="center" bgcolor="#FFFFFF">回收空药盒数</td>
            <td width="8%" align="center" bgcolor="#FFFFFF">批号</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">发药前库存量</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">发药后库存量</td>
            <td width="12%" align="center" bgcolor="#FFFFFF">发药人</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">领药人</td>
        </tr>
<?php        

  

  /*$sql = "select * from `zyff` where `tshqk`='0' and (`fyr`='".$yhid."' ";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $sql .= " or `fyr`='".$yshid[$i]."' ";
  }
}
  $sql .= ")";*/
$sql = "select * from `zyff` where `tshqk`='0' and `yfmch`='$yhgldw' ";  
if($guanjianci!=""){
$sql .=" and ".$guanjianci;
}
$sql .= " order by id DESC limit $page $pagesize ";
  $Query_ID = mysql_query($sql);
  //echo $sql;
  $_SESSION[ygfyglsql]=$sql;
  while($Record = mysql_fetch_array($Query_ID)){
      echo "<tr style=\"color:#1f4248; font-size:12px;\">";
      echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[20]."</td>";

      $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj`,`shqbzh`,`ypgg` from `hzh` where `id`='".$Record[1]."'";
      $hzhQuery_ID = mysql_query($hzhsql);
      while($hzhRecord = mysql_fetch_array($hzhQuery_ID)) {
          $hzhshj = $hzhRecord[2];
          echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $hzhRecord[1] . "</td>";
          echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">I-" . $hzhRecord[0] . "</td>";
          echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $hzhRecord[4] . "</td>";


          echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[4] . "</td>";
          echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">";
          if ($Record[7] != "" && $Record[7] > 0) {
              echo "是";
          } else {
              echo "否";
          }
//          if($Record[7]!=""){echo $Record[7]."/";}else{echo "0/";}
//          if($Record[8]!=""){echo $Record[8];}else{echo "0";}
          echo "</td>";
//      echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td>";
          echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[21] . "</td>";
          echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">";
          echo $Record[6];
//        if($Record[23]!=""){echo "瓶:";if($Record[23]=="1"){ echo "在药房";}else if($Record[23]=="2"){ echo "在CFC";}else{ echo "在国大";}echo "</br>";}else{echo "无</br>";}
//        if($Record[24]!=""){echo "药:";if($Record[24]=="1"){ echo "在药房";}elseif($Record[24]=="2"){ echo "在CFC";}else{ echo "在国大";} }else{echo "无";}
          echo "</td>";

          echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">";
          if ($Record[6] != "" && $Record[6] != 0) {
              echo $Record[6] - $Record[4];
          } else {
              echo "";
          }
          echo "</td>";
          echo "<td width=\"12%\" align=\"center\" bgcolor=\"#FFFFFF\">";
          /*$yshsql = "select `yhyl1` from `manager` where `id`='".$Record[18]."'";
          $yshQuery_ID = mysql_query($yshsql);
          while($yshRecord = mysql_fetch_array($yshQuery_ID)){
            echo $yshRecord[0];
          }*/
          echo $Record[18];
          echo "</td>";
//          if ($Record[9] != '0') {
//              $zhxqshsql = "select `xm`,`lxfsh` from `zhxqsh` where `id`='" . $Record[9] . "'";
//              //echo $zhxqshsql;
//              $zhxqshQuery_ID = mysql_query($zhxqshsql);
//              while ($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)) {
//                  $zhxqshxm = $zhxqshRecord[0];
//                  $zhxqshlxfsh = $zhxqshRecord[1];
//                  echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $zhxqshxm . "</td>";
//                  echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $zhxqshlxfsh . "</td>";
//              }
//          } else {
              echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">$hzhRecord[1]</td>";
//              echo "<td width=\"8%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $hzhshj . "</td>";
//          }
      }
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
    <script type="text/javascript">

        function guolv() {
            var url = 'yshfygl.php?guanjianci=' +encodeURIComponent($('#Guanjianci').val())
                        + '&KaishiRiqi=' + $('#KaishiRiqi').val()
                        + '&JiezhiRiqi=' + $('#JiezhiRiqi').val()
                        + '&shqbzh=' + $('#shqbzh').val();
            location.href = url;
        }
        function chazhao() {
            var url = 'yshfygl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        }

        $(function () {
            chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
        <?php
            if($_GET[KaishiRiqi]!=""){
        ?>
            $('#KaishiRiqi').val('<?php echo $_GET[KaishiRiqi]; ?>');
        <?php
            }
            if($_GET[JiezhiRiqi]!=""){
        ?>
            $('#JiezhiRiqi').val('<?php echo $_GET[JiezhiRiqi]; ?>');
        <?php
            }
        ?>
        });

    </script>

            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
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
    </div></div>
</body>
</html>
