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
$html_title="发药管理";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="kfcfcfy.php"><?php echo $html_title;?></a></div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span></span>
				</div>
				<div class="incontact w955 flt">
				 <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
           <td>
        <div class="insinsins">
        <input type="text" id="ksrq" name="ksrq" readonly="readonly" placeholder="请输入开始日期"
            size="12" value=""
            class="grd-white" style="width:120px" />
        -
        <input type="text" id="jsrq" name="jsrq" readonly="readonly" placeholder="请输入结束日期"
            size="12" value=""
            class="grd-white" style="width:120px" />
        <input type="button" value="按发药日期过滤" onclick="guolv();" class="uusub" />
        </div>
 
    <br />
<?php
  $hzhid = $_GET['id'];
  $ksrq = $_GET['ksrq'];
  $jsrq = $_GET['jsrq'];
  $numsql="SELECT * FROM `zyff` where `hzhid`='".$hzhid."' and `zyffzht` IS NULL  and `tshqk`='0' ";
  $zshsql="SELECT SUM(fyshl),SUM(jhkpshl) FROM `zyff` where `hzhid`='".$hzhid."' and `zyffzht` IS NULL  and `tshqk`='0' ";
  if($ksrq!=""){
    $numsql.=" and `fyrq`>='".$ksrq."'";
    $zshsql.=" and `fyrq`>='".$ksrq."'";
  }
  if($jsrq!=""){
    $numsql.=" and `fyrq`<='".$jsrq."'";
    $zshsql.=" and `fyrq`<='".$jsrq."'";
  }
 
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$zsh=mysql_query($zshsql);
while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];$jhkpshl=$zshRecord[1];}
?>
     <div class="insinsins" style="width:100%;"><span>
      已发药总数:<?php if($zshjs!=""){echo $zshjs;}else {echo "0";}?>瓶&nbsp;空药瓶总数:<?php if($jhkpshl!=""){echo $jhkpshl;}else {echo "0";}?>支</span>
      </div>
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
            <td width="60" align="center" bgcolor="#FFFFFF">操作</td>
            <td width="60" align="center" bgcolor="#FFFFFF">发药日期 </td>
            <td width="60" align="center" bgcolor="#FFFFFF">发药<br />瓶数</td>
            <td width="60" align="center" bgcolor="#FFFFFF">交回空瓶(瓶)<br />交回余药(粒)</td>
            <td width="60" align="center" bgcolor="#FFFFFF">空瓶、余药 状态</td>
            <td width="60" align="center" bgcolor="#FFFFFF">患者编码</td>
            <td width="60" align="center" bgcolor="#FFFFFF">患者姓名</td>
            <td width="60" align="center" bgcolor="#FFFFFF">病种</td>
            <td width="60" align="center" bgcolor="#FFFFFF">领药人</td>
            <td width="60" align="center" bgcolor="#FFFFFF">患者电话号码</td>
            <td width="60" align="center" bgcolor="#FFFFFF">药师</td>
        </tr>
<?php        
  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
  $sql = "select * from `zyff` where `hzhid`='".$hzhid."'";
  
  if($ksrq!=""){
    $sql.=" and `fyrq`>='".$ksrq."'";
  }
  if($jsrq!=""){
    $sql.=" and `fyrq`<='".$jsrq."'";
  }
  $sql .=" order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[20]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[7]!=""){echo $Record[7]."/";}else{echo "0/";}
    if($Record[8]!=""){echo $Record[8];}else{echo "0";}
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[23]!=""){echo "瓶:";if($Record[23]=="1"){ echo "在药房";}else if($Record[23]=="2"){ echo "在CFC";}else{ echo "在国大";}echo "</br>";}else{echo "无</br>";}
    if($Record[24]!=""){echo "药:";if($Record[24]=="1"){ echo "在药房";}elseif($Record[24]=="2"){ echo "在CFC";}else{ echo "在国大";} }else{echo "无";}
    echo "</td>";
  $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj`,`shqbzh` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
  $hzhshj=$hzhRecord[2];
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">I-".$hzhRecord[0]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$hzhRecord[1]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$hzhRecord[3]."</td>";
  } 
  $zhxqshsql = "select `xm`,`lxfsh` from `zhxqsh` where `id`='".$Record[9]."'";
  $zhxqshQuery_ID = mysql_query($zhxqshsql);
  while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
    
    $zhxshqtf=1;
    $zhxqshxm=$zhxqshRecord[0];
    $zhxqshlxfsh=$zhxqshRecord[1];
    
  } if($zhxshqtf!="1"){echo "<td align=\"center\" bgcolor=\"#FFFFFF\">本人</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$hzhshj."</td>";}else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$zhxqshxm."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$zhxqshlxfsh."</td>";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[18]."</td>";
  
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
            var url = 'yshfyxx.php?id=<?php echo $hzhid;?>&ksrq=' + $('#ksrq').val() + '&jsrq=' + $('#jsrq').val();
            location.href = url;
        }
//        $('#Guanjianci').bind('keyup', function (event) {
//            if (event.keyCode == "13") {
//                var url = '/YaoshiArea/Fayao/Index?guanjianci=' + encodeURIComponent($('#Guanjianci').val()) + '&ischaxun=1';
//                location.href = url;
//            }
//        });
        /*$("#Guanjianci").keypress(function (e) {
            var key;
            if (window.event)
                key = window.event.keyCode;
            else
                key = e.which;
            if (key == 13) {
                var url = '#=' + encodeURIComponent($('#Guanjianci').val()) + '&ischaxun=1';
                location.href = url;
            }
            return (key != 13);
        });*/
        $(function () {
            chooseDateRange('ksrq', 'jsrq', true, true);
        });
    </script>
   </div>
        </div>
    </div>
    
</body>
</html>
