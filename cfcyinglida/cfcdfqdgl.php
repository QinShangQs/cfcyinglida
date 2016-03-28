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
if($_GET[guanjianci]!=""){
$guanjiancinr=$_GET[guanjianci];
if(substr( $guanjiancinr, 0, 1 )=='s'||substr( $guanjiancinr, 0, 1 )=='S'){
$guanjiancinr=str_ireplace('s','',$guanjiancinr,$i);
$hzhrzid=$guanjiancinr;
}else{
$guanjiancinr=preg_replace('/^0*/', '', $guanjiancinr);
$hzhshqid=$guanjiancinr;
}
$guanjianci="(`hzhid`='".$hzhshqid."' or `hzhxm` LIKE '%'".$guanjiancinr."%')";
$guanjianci1="(a.`hzhid`='".$hzhrzid."' or a.`hzhxm` LIKE '%".$guanjiancinr."%')";
}
if($_GET[day]!=""){//按天数
$zdrq=date('Y-m-d',strtotime('+'.$_GET[day].' day',strtotime(date('Y-m-d'))));
$bxclyrq=date('Y-m-d',strtotime('+'.$_GET[day].' day',strtotime(date('Y-m-d'))));
if($guanjianci1!=""){
$guanjianci.=" and (select hzhid from `xclyrq` where `xclyrq`<='".$zdrq."' and `hzhid`=`hzh`.`id`)')";
$guanjianci1.=" and (b.`xclyrq`<='".$bxclyrq."' )";}else{
$guanjianci.=" (select hzhid from `xclyrq` where `xclyrq`<='".$zdrq."' and `hzhid`=`hzh`.`id`)";
$guanjianci1.=" (b.`xclyrq`<='".$bxclyrq."' )";}
}
if($_GET[fypsh]!=""){//按瓶数

$hzhidsql="SELECT hzhid,count(hzhid) FROM `zyff` where  `tshqk`='0' group by hzhid  having count(hzhid)='".$_GET[fypsh]."' ";
$jli=0;
$guanjiancisql="(";
  $hzhidQuery_ID = mysql_query($hzhidsql);
  while($hzhidRecord = mysql_fetch_array($hzhidQuery_ID)){
      if($jli==0){$jli=1;
      $guanjiancisql.=" `a`.`id`='".$hzhidRecord[0]."'";
      }else{
      $guanjiancisql.=" or `a`.`id`='".$hzhidRecord[0]."'";
      }
  }  
$guanjiancisql .= ") ";
$guanjianci.=$guanjiancisql;
$guanjianci1.=$guanjiancisql;

}
if($_GET[yf]!=""){//按药房
$guanjianci.=" (`lyyf` = '".$_GET[yf]."')";
$guanjianci1.=" (`lyyf` = '".$_GET[yf]."' )";
}
$numsql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`>='".date('Y-m-d',strtotime('-29 day',strtotime(date('Y-m-d'))))."'";
if($guanjianci1!=""){
$numsql .=" and ".$guanjianci1;
}
//echo $numsql;
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

$kcshshdsql="SELECT SUM(pfshl1),SUM(pfshl2) FROM `yfshqzy` where `shqzht`='3' ";

  $kcshshdQuery_ID = mysql_query($kcshshdsql);
  while($kcshshdRecord = mysql_fetch_array($kcshshdQuery_ID)){
  $kcshshd1=$kcshshdRecord[0];
  $kcshshd2=$kcshshdRecord[1];
  }
$kcshfy1sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='1' ";
//echo $kcshfy1sql;
  $kcshfy1Query_ID = mysql_query($kcshfy1sql);
  while($kcshfy1Record = mysql_fetch_array($kcshfy1Query_ID)){
  $kcshfy1=$kcshfy1Record[0];
  } 
$kcshfy2sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='2'";
  $kcshfy2Query_ID = mysql_query($kcshfy2sql);
  while($kcshfy2Record = mysql_fetch_array($kcshfy2Query_ID)){
  $kcshfy2=$kcshfy2Record[0];
  } 
$html_title="待发清单管理";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="cfcdfqdgl.php"><?php echo $html_title;?></a></div>
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
<input type="text" id="Guanjianci" name="Guanjianci" class="grd-white" value="<?php echo $_GET[guanjianci];?>" placeholder="输入患者姓名或编码" />
<input type="button" value="查找" onclick="chazhao();" class="uusub2" />
预估发药日期在<select Style="width:60px" id="Day" name="Day" onchange="guolv();" class="grd-white2">
<?php
for($i=1;$i<=31;$i++){
if($_GET[day]!=""&&$_GET[day]==$i){
$dayselect="selected=\"selected\"";
}else if($i==20&&($_GET[day]==""||$_GET[day]==$i)){
$dayselect="selected=\"selected\"";
}else{
$dayselect="";
}
echo "<option ".$dayselect." value=\"".$i."\">".$i."</option>";
}
?>
</select>天内&nbsp;
<select Style="width:120px" id="YifayaoZhishu" name="YifayaoZhishu" onchange="guolvpsh();" class="grd-white2">
<?php
for($i=0;$i<=12;$i++){

if($_GET[fypsh]==$i){
$dayselect="selected=\"selected\"";
}else {
$dayselect="";
}
if($i==0){
if($_GET[fypsh]==''||$_GET[fypsh]==0){
echo "<option selected=\"selected\" value=\"0\">不限已发瓶数</option>";
}else{
echo "<option value=\"0\">不限已发瓶数</option>";
}
}else {
echo "<option ".$dayselect." value=\"".$i."\">".$i."</option>";
}

}
?>
</select>
<div class="top">
<select id="YaoFangId" name="YaoFangId" style="width:400px;"  onchange="guolvyf();" class="grd-white2">
<?php
if($_GET[yf]!=''){
echo "<option selected=\"selected\" value=\"".$_GET[yf]."\">".$_GET[yf]."</option>";
}
?>
<option  value="">选择药房</option>
<?php
$yfsql = "select id,yfshijx,yfsheng,yfshi,yfmch from `yf` where `shfzt`='1' order by yfshijx ASC";
$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){
echo "<option value=\"".$yfRecord[4]."\">".$yfRecord[1]."  ".$yfRecord[3]." ".$yfRecord[4]."</option>";
}
?>   
</select></div>

                  </span>
                </div>
              </td>
            </tr>
          </table> 
          <div class="insinsins"><span>
          预估待发药数：<?php echo $num." ";?>瓶 当前各药房总库存数： <?php echo $kcshshd1-$kcshfy1;?> 瓶  <?php /*(当前药房id: <?php echo $yshid." ";?>开发期间调用)*/?>
          </span></div>
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">药房地区</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">患者编码</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">患者姓名</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">联系电话</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">已领赠药次数瓶数</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">当前剂量</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">预估下次发药时间</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">入组医院</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">正式入组日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">病种</td>
            </tr>
<?php   
  $sql = "select * from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`>='".date('Y-m-d',strtotime('-1 month',strtotime(date('Y-m-d'))))."'";
if($guanjianci1!=""){
$sql .=" and ".$guanjianci1;
}
  $sql .= " order by b.`xclyrq` ASC limit $page $pagesize ";
  $_SESSION[ygfysql]=$sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $hzhygshcyyshj=$Record[35];//预估首次赠药日期
  $hzhjzhlx=$Record[25];//捐助类型
  $hzhshqypgg=$Record[28];//药品规格
            //读取次数
$lynumq=mysql_query("SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='".$Record[0]."'");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}
?>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><?php
//读取药房省
      $yfsql = "select `yfsheng`,`yfshi` from `yf` where `yfmch`='".$Record[36]."'";
      $hzhlyyf='';//清空
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){
      if($yfRecord[1]!=''){ $hzhlyyf=$yfRecord[1];}else{$hzhlyyf=$yfRecord[0];}
      }
      echo $hzhlyyf;
 
            ?></td>
            <td align="center" bgcolor="#FFFFFF">I-<?php echo $Record[2];?></td>
            <td align="center" bgcolor="#FFFFFF"><a href="shqxq.php?id=<?php echo $Record[0];?>"><?php echo $Record[4];?></a></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[15];?></td>
            <td align="center" bgcolor="#FFFFFF"><a href="cfcfyxx.php?id=<?php echo $Record[0];?>"><?php
            echo $lynum;?>次/<?php
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){if($lyshlnum[0]!=""){echo $lyshlnum[0];}else{echo "0";}}
            ?>瓶</a></td>
            <td align="center" bgcolor="#FFFFFF"><?php
            if($lynum>0){
$hzhlyjlsql="SELECT yyyf FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' order by `id` desc limit 1";
$hzhlyjlq=mysql_query($hzhlyjlsql);
  while($hzhlyjl = mysql_fetch_array($hzhlyjlq)){
    if($hzhlyjl[0]==""){echo "错误";}else{echo $hzhlyjl[0];}
  }
            }else{
              echo $hzhshqypgg;
            }
            ?></td>
            <td align="center" bgcolor="#FFFFFF"><?php

if($lynum=="0"){
  if($hzhygshcyyshj!=""){echo date('Y-m-d',strtotime('-7 day',strtotime($hzhygshcyyshj)));
  }else{echo "日期错误";}
}
else if($lynum>"0"){
  $ygxcfyrqq=mysql_query("SELECT ygxcfyrq FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' order by id DESC limit 0,1");
  while($ygxcfyrq = mysql_fetch_array($ygxcfyrqq)){
  $ygxcfyrqshj=$ygxcfyrq[0];
  }
  if($ygxcfyrqshj!=""){
  echo $ygxcfyrqshj;
  }else {echo "日期错误";}
} 

            ?></td>
            <td align="center" bgcolor="#FFFFFF"><?php 
            if($Record[12]!=''){
            $hzhdqyy=$Record[12];
            }else if($Record[11]!=''){
            $hzhdqyy=$Record[11];
            }else{
            $hzhdqyy=$Record[9];
            }
            //读取医院
      $yysql = "select sheng,shi,qu,yymch,zhdysh,zhdyshyzh,shqysh1,shqysh2,shqysh3 from `yyyshdq` where id='".$hzhdqyy."'";
      $hzhdqyy='';//清空
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $shqyshshl=0;
      if($yyRecord[6]!=''){$shqyshshl++;}
      if($yyRecord[7]!=''){$shqyshshl++;}
      if($yyRecord[8]!=''){$shqyshshl++;}
      if($shqyshshl==0){$shqyshshl="";}else{$shqyshshl=",".$shqyshshl;}
        echo "<a onclick=\"qzyzh(".$yyRecord[5].$shqyshshl.")\">".$yyRecord[3]." ".$yyRecord[4]."</a><input type='hidden' name='zhdysh".$yyRecord[5]."' id='zhdysh".$yyRecord[5]."' value='".$yyRecord[4]."'><input type='hidden' name='shqysh".$yyRecord[5]."' id='shqysh".$yyRecord[5]."' value='".$yyRecord[6]." ".$yyRecord[7]." ".$yyRecord[8]."'>";
      }
            ?></a></td>
            <td style="text-align: center" bgcolor="#FFFFFF"><?php echo $Record[34];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[7];?></td>
        </tr>

<?php
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
          <div class="insinsins"><span>超过时间未领药的患者：</span></div>
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">药房地区</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">患者编码</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">患者姓名</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">联系电话</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">已领赠药次数瓶数</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">当前剂量</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">预估下次发药时间</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">入组医院</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">正式入组日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">病种</td>
            </tr>
<?php        
  $sql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`<'".date('Y-m-d',strtotime('-1 month',strtotime(date('Y-m-d'))))."'";
if($guanjianci1!=""){
$sql .=" and ".$guanjianci1;
}
  $sql .= " GROUP BY a.`id` order by b.`xclyrq` ASC limit $page $pagesize ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $hzhygshcyyshj=$Record[35];//预估首次赠药日期
  $hzhjzhlx=$Record[25];//捐助类型
  $hzhshqypgg=$Record[28];//药品规格
            //读取次数
$lynumq=mysql_query("SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='".$Record[0]."'");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}
?>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><?php
//读取药房省
      $yfsql = "select `yfsheng`,`yfshi` from `yf` where `yfmch`='".$Record[36]."'";
      $hzhlyyf='';//清空
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){
      if($yfRecord[1]!=''){ $hzhlyyf=$yfRecord[1];}else{$hzhlyyf=$yfRecord[0];}
      }
      echo $hzhlyyf;
 
            ?></td>
            <td align="center" bgcolor="#FFFFFF">X-<?php echo $Record[2];?></td>
            <td align="center" bgcolor="#FFFFFF"><a href="shqxq.php?id=<?php echo $Record[0];?>"><?php echo $Record[4];?></a></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[15];?></td>
            <td align="center" bgcolor="#FFFFFF"><a href="cfcfyxx.php?id=<?php echo $Record[0];?>"><?php
            echo $lynum;?>次/<?php
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){if($lyshlnum[0]!=""){echo $lyshlnum[0];}else{echo "0";}}
            ?>瓶</a></td>
            <td align="center" bgcolor="#FFFFFF"><?php
            if($lynum>0){
$hzhlyjlsql="SELECT yyyf FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' order by `id` desc limit 1";
$hzhlyjlq=mysql_query($hzhlyjlsql);
  while($hzhlyjl = mysql_fetch_array($hzhlyjlq)){
    if($hzhlyjl[0]==""){echo "错误";}else{echo $hzhlyjl[0];}
  }
            }else{
              echo $hzhshqypgg;
            }
            ?></td>
            <td align="center" bgcolor="#FFFFFF"><?php

if($lynum=="0"){
  if($hzhygshcyyshj!=""){echo date('Y-m-d',strtotime('-7 day',strtotime($hzhygshcyyshj)));
  }else{echo "日期错误";}
}

else if($lynum>"0"){
  $ygxcfyrqq=mysql_query("SELECT ygxcfyrq FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' order by id DESC limit 0,1");
  while($ygxcfyrq = mysql_fetch_array($ygxcfyrqq)){
  $ygxcfyrqshj=$ygxcfyrq[0];
  }
  if($ygxcfyrqshj!=""){
  echo $ygxcfyrqshj;
  //echo date('Y-m-d',strtotime('-7 day',strtotime($ygxcfyrqshj)));
  }else {echo "日期错误";}
} 
            ?></td>
            <td align="center" bgcolor="#FFFFFF"><?php 
            if($Record[12]!=''){
            $hzhdqyy=$Record[12];
            }else if($Record[11]!=''){
            $hzhdqyy=$Record[11];
            }else{
            $hzhdqyy=$Record[9];
            }
            //读取医院
      $yysql = "select sheng,shi,qu,yymch,zhdysh,zhdyshyzh,shqysh1,shqysh2,shqysh3 from `yyyshdq` where id='".$hzhdqyy."'";
      $hzhdqyy='';//清空
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $shqyshshl=0;
      if($yyRecord[6]!=''){$shqyshshl++;}
      if($yyRecord[7]!=''){$shqyshshl++;}
      if($yyRecord[8]!=''){$shqyshshl++;}
      if($shqyshshl==0){$shqyshshl="";}else{$shqyshshl=",".$shqyshshl;}
        echo "<a onclick=\"qzyzh(".$yyRecord[5].$shqyshshl.")\">".$yyRecord[3]." ".$yyRecord[4]."</a><input type='hidden' name='zhdysh".$yyRecord[5]."' id='zhdysh".$yyRecord[5]."' value='".$yyRecord[4]."'><input type='hidden' name='shqysh".$yyRecord[5]."' id='shqysh".$yyRecord[5]."' value='".$yyRecord[6]." ".$yyRecord[7]." ".$yyRecord[8]."'>";
      }
            ?></a></td>
            <td style="text-align: center" bgcolor="#FFFFFF"><?php echo $Record[34];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[7];?></td>
        </tr>

<?php
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
<style>
.mindess {
  width:966px;
  font-size:12px;
  height:auto;
  position:fixed;
  z-index:100;
  left:50%;
  margin:0 auto 0 -494px; /* margin-left需要是宽度的一半 */
  top:35%;
  padding:0px;
  background:#25679c;
  border:1px #25679c solid;
}
</style>
<div class="mindess" id="qzyzh" style="width:325px;  padding-top:5px; margin:0 auto 0 -181px; display:none;">
  <div style="position:absolute; right:15px;	background:#25679c;"><a style="color:#ffffff; cursor:pointer;" onclick="qzyzh(0)">关闭</a></div>
  <table style="margin-top:30px;" width="100%" border="1" cellpadding="10" cellspacing="1">
    <tr>
      <td width="30%" bgcolor="#FFFFFF" align="center">指定医生<br/><span id='zhdyshxsh'></span></td>
      <td width="70%" bgcolor="#FFFFFF" align="center"><img id="zhdyshyzh" width="100"/><img  id="zhdyshqzh" width="100"/></td>
    </tr>
    <tr id="qzyzhshq" style="display:none;">
      <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生<br/><span id='shqyshxsh'></span></td>
      <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
    </tr>
  </table>
</div>
<script type="text/javascript">
function guolv() {
    var url = 'cfcdfqdgl.php?day=' + $('#Day').val();
    location.href = url;
}
function chazhao() {
    var url = 'cfcdfqdgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
    location.href = url;
}
function guolvpsh() {
if($('#YifayaoZhishu').val()==0){var url = 'cfcdfqdgl.php';}
else{
    var url = 'cfcdfqdgl.php?fypsh=' + encodeURIComponent($('#YifayaoZhishu').val());}
    location.href = url;
}
function guolvyf() {
    var url = 'cfcdfqdgl.php?yf=' + encodeURIComponent($('#YaoFangId').val());
    location.href = url;
}
function padLeft(str, lenght) {
  if (str.length >= lenght){
  //alert(str.length+'b'+lenght);
    return str;
    }
  else{
  //alert(str.length+'a'+lenght);
    if(str.length==undefined){
      return padLeft("" + str, lenght);
    }else{
      return padLeft("0" + str, lenght);
    }
    }
}


function qzyzh(v,i){
if(v==0){
document.getElementById('qzyzh').style.display='none';
}
else{
imgsrc=padLeft(v,3);
document.getElementById('zhdyshyzh').src='./qzyzh/'+imgsrc+'-1.jpg';
document.getElementById('zhdyshqzh').src='./qzyzh/'+imgsrc+'-2.jpg';
$('#zhdyshxsh').html($('#zhdysh'+v).val());
$('#shqyshxsh').html($('#shqysh'+v).val());
if(i!=undefined&&i>0){
//alert('怎么来着了?');
document.getElementById('qzyzhshq').style.display='';
var shqimg="";
  for(j=0;j<i;j++){
  shqimg = shqimg+'<img src="./qzyzh/'+imgsrc+'-'+(j+3)+'.jpg"  width="100"/>';
  }
  if(shqimg!=""){
  $('#qzyzhshqysh').html(shqimg);
  }
}else{
document.getElementById('qzyzhshq').style.display='none';
  $('#qzyzhshqysh').html('');
}


document.getElementById('qzyzh').style.display='block';
}

}
</script>
</body>
</html>