<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="发药管理";
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
        <input type="text" id="Guanjianci" name="Guanjianci" class="grd-white" value="G00086"
            placeholder="患者姓名,编码,身份号码" style="width:280px" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub" /><br /><div class="top">
        <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期"
            size="12" value=""
             class="grd-white"  style="width:120px" />
        -
        <input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期"
            size="12" value=""
             class="grd-white"  style="width:120px" />
        <input type="button" value="按发药日期过滤" onclick="guolv();" class="uusub" />
        <select id="ShenqingBingzhong" name="ShenqingBingzhong" onchange="javascript:guolv();" style="width:113px" class="grd-white2"><option value="">不限申请病种</option>
<option value="RCC">RCC</option>
<option value="pNET">pNET</option>
<option value="GIST">GIST</option>
</select></div>
        
   
    <br />
<?php
  $hzhid = $_GET['id'];
$pagesize=10;//每页显示的条数：
$numq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$hzhid."'");
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$zsh=mysql_query("SELECT SUM(fyshl),SUM(jhkpshl) FROM `zyff` where `hzhid`='".$hzhid."'");
while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];$jhkpshl=$zshRecord[1];}
?>
      <div class="forB">
      已发药总数:<?php if($zshjs!=""){echo $zshjs;}else {echo "0";}?>瓶&nbsp;空药瓶总数:<?php if($jhkpshl!=""){echo $jhkpshl;}else {echo "0";}?>支
      </div>
    <div class="forB">
        
        
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
            <tr>
              <td>
          <?php
          if($num ){
           if($pageval==""&&$pageval<=1)$pageval=1;///第0页 时出现错误
          //echo "共 $num 条  ";
          echo "<div class=\"pageright\">
                        <ul>
                        <li class=\"uppage\">";
          if($pageval-1<=0){ echo "<a href=".$url."page=1>首页</a></li> ";}
          else{ echo "<a href=".$url."page=1>首页</a></li> <li style=\"width:60px;\"><a href=".$url."page=".($pageval-1).">上一页</a>";}
          for($i=1;$i<=$pagenum;$i++){
          if($pageval==$i){echo "<li class=\"this\">".$i."</li> ";}
          else{echo " <li><a href=".$url."page=$i>$i</a></li> ";}
          }
          if($pageval+1>$pagenum) echo "<li class=\"downpage\">末页</li>";
          if($pageval!=$pagenum){ echo "<li style=\"width:60px;\"><a href=".$url."page=".($pageval+1).">下页</a></li>  <li class=\"downpage\"><a href=".$url."page=".($pagenum).">末页</a></li>";}
          echo "</ul>
                      </div>";
          }
          ?>
              </td>
            </tr>
          </table>
   
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF">操作</td>
            <td align="center" bgcolor="#FFFFFF">发药日期 </td>
            <td align="center" bgcolor="#FFFFFF">发药<br />瓶数</td>
            <td align="center" bgcolor="#FFFFFF">交回空瓶(瓶)<br />交回余药(粒)</td>
            <td align="center" bgcolor="#FFFFFF">空瓶、余药 状态</td>
            <td align="center" bgcolor="#FFFFFF">患者编码</td>
            <td align="center" bgcolor="#FFFFFF">患者姓名</td>
            <td align="center" bgcolor="#FFFFFF">病种</td>
            <td align="center" bgcolor="#FFFFFF">领药人</td>
            <td align="center" bgcolor="#FFFFFF">患者电话号码</td>
            <td align="center" bgcolor="#FFFFFF">药师</td>
        </tr>
<?php        
  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
  $sql = "select * from `zyff` where `hzhid`='".$hzhid."' order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-weight:bold; height:30px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td><td align=\"center\" bgcolor=\"#FFFFFF\" >".$Record[20]."</td><td>".$Record[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[7]!=""){echo $Record[7]."/";}else{echo "0/";}
    if($Record[8]!=""){echo $Record[8];}else{echo "0";}
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[23]!=""){echo "瓶:";if($Record[23]=="1"){ echo "在药房";}else if($Record[23]=="2"){ echo "在CFC";}else{ echo "在国大";}echo "/";}else{echo "无/";}
    if($Record[24]!=""){echo "药:";if($Record[24]=="1"){ echo "在药房";}elseif($Record[24]=="2"){ echo "在CFC";}else{ echo "在国大";} }else{echo "无";}
    echo "</td>";
  $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj` from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
  $hzhshj=$hzhRecord[2];
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">X-".$hzhRecord[0]."</td><td>".$hzhRecord[1]."</td>";
  } 
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">肺癌</td>";
  $zhxqshsql = "select `xm`,`lxfsh` from `zhxqsh` where `id`='".$Record[9]."'";
  $zhxqshQuery_ID = mysql_query($zhxqshsql);
  while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
    
    $zhxshqtf=1;
    $zhxqshxm=$zhxqshRecord[0];
    $zhxqshlxfsh=$zhxqshRecord[1];
    
  } if($zhxshqtf!="1"){echo "<td align=\"center\" bgcolor=\"#FFFFFF\">本人</td><td>".$hzhshj."</td>";}else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$zhxqshxm."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$zhxqshlxfsh."</td>";}
    echo "<td>";
  $fyrnsql = "select `names` from `manager` where `id`='".$Record[18]."'";
  $fyrnQuery_ID = mysql_query($fyrnsql);
  while($fyrnRecord = mysql_fetch_array($fyrnQuery_ID)){ 
    $fyrname=$fyrnRecord[0];
  }
  $fyrsql = "select `yfzhdysh` from `yf` where `yfyshname`='".$fyrname."'";
  $fyrQuery_ID = mysql_query($fyrsql);
  while($fyrRecord = mysql_fetch_array($fyrQuery_ID)){ 
    echo $fyrRecord[0];
  }
    echo "</td></tr>";
}
?>
    </table>
    <div class="forBr">
            &nbsp;&nbsp;
<?php
if($num ){
 if($pageval==""&&$pageval<=1)$pageval=1;///第0页 时出现错误
echo "共 $num 条  ";
if($pageval-1<=0) echo "<a href=$url?page=1>首页</a> ";
else echo "<a href=$url?page=1>首页</a> <a href=$url?page=".($pageval-1).">上页</a>";
if($pageval+1>$pagenum) echo "下页";
if($pageval!=$pagenum){ echo "<a href=$url?page=".($pageval+1).">下页</a>  <a href=$url?page=".($pagenum).">末页</a>";}}
?>
    </div>
    <script type="text/javascript">

        function guolv() {
            var url = '#=' + $('#KaishiRiqi').val()
                        + '&jiezhiRiqi=' + $('#JiezhiRiqi').val()
                        + '&yaofangId=' + $('#YaoFangId').val()
                        + '&guanjianci=' + $('#Guanjianci').val()
                        + '&ShenqingBingzhong=' + encodeURIComponent($('#ShenqingBingzhong').val())
                        + '&ischaxun=1';
            location.href = url;
        }
        function chazhao() {
            var url = '#i=' + encodeURIComponent($('#Guanjianci').val()) + '&ischaxun=1';
            location.href = url;
        }
//        $('#Guanjianci').bind('keyup', function (event) {
//            if (event.keyCode == "13") {
//                var url = '/YaoshiArea/Fayao/Index?guanjianci=' + encodeURIComponent($('#Guanjianci').val()) + '&ischaxun=1';
//                location.href = url;
//            }
//        });
        $("#Guanjianci").keypress(function (e) {
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
        });
        $(function () {
            chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
        });
        $(function () {
            $('#YaoFangId').change(function () {
                var url = '#=' + $('#KaishiRiqi').val()
                        + '&jiezhiRiqi=' + $('#JiezhiRiqi').val()
                        + '&yaofangId=' + $('#YaoFangId').val()
                        + '&ShenqingBingzhong=' + encodeURIComponent($('#ShenqingBingzhong').val())
                        + '&ischaxun=1';
                location.href = url;
            })
        });
    </script>

            
        </div>
    </div>
    </div>
    </div>
</body>
</html>
