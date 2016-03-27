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

$numq=mysql_query("SELECT * FROM `yyyshdq` where `yhszht`='1' ");// group by yymch
$yzhguanjianci =0;
$guanjiancisql = "('1'='1'";
if($_GET[sheng]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `sheng`='".$_GET[sheng]."'";
}
if($_GET[shi]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `shi`='".$_GET[shi]."'";
}
if($_GET[yy]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `yymch` LIKE '%".$_GET[yy]."%'";
}
if($_GET[ysh]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `zhdysh` LIKE '%".$_GET[ysh]."%'";
}
if($_GET[shqysh]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and (`shqysh1` LIKE '%".$_GET[shqysh]."%' or `shqysh2` LIKE '%".$_GET[shqysh]."%' or `shqysh3` LIKE '%".$_GET[shqysh]."%')";
}
if($_GET[pxb]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `yshpxqsh` LIKE '%".$_GET[pxb]."%'";
}
if($_GET[pxbrqksh]!=""&&$_GET[pxbrqjsh]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `yshpxrq`>='".$_GET[pxbrqksh]."' and `yshpxrq`<='".$_GET[pxbrqjsh]."'";
}
if($_GET[shj]!=""){$yzhguanjianci=1;
$guanjiancisql .=" and `zhdyshdh` LIKE '%".$_GET[shj]."%'";
}
if($_GET[shfyshqysh]!=""){$yzhguanjianci=1;
  if($_GET[shfyshqysh]==1){
    $guanjiancisql .=" and (`shqysh1`<>'' or `shqysh2`<>'' or `shqysh3`<>'')";
  }
  else{
    $guanjiancisql .=" and `shqysh1`='' and `shqysh2`='' and `shqysh3`=''";
  }
}
$guanjiancisql .= " )";
if($yzhguanjianci==1){
$numq=mysql_query("SELECT * FROM `yyyshdq` where `yhszht`='1' and".$guanjiancisql);
}
//echo $guanjiancisql;
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
$html_title="指定医院医生管理";
include('spap_head.php');

  $tjzshsql = "select COUNT(DISTINCT sheng),COUNT(DISTINCT shi),COUNT(DISTINCT yymch),COUNT(DISTINCT zhdyshdh),COUNT(DISTINCT shqysh1),COUNT(DISTINCT shqysh2),COUNT(DISTINCT shqysh3) from `yyyshdq` where `yhszht`='1'";
if($yzhguanjianci==1){
$tjzshsql .="  and  ".$guanjiancisql;
}
  $tjzshQuery_ID = mysql_query($tjzshsql);
  $shqyshtjfsh=0;
  while($tjzshRecord = mysql_fetch_array($tjzshQuery_ID)){
  $shengshz=$tjzshRecord[0];
  $shishz=$tjzshRecord[1];
  $yymchshz=$tjzshRecord[2];
  $zhdyshshz=$tjzshRecord[3];
  if($tjzshRecord[4]>1){$shqyshtjfsh+=1;}
  if($tjzshRecord[5]>1){$shqyshtjfsh+=1;}
  if($tjzshRecord[6]>1){$shqyshtjfsh+=1;}
  if($_GET[shfyshqysh]!=1&&$shqyshtjfsh<3){$shqyshtjfsh=3;}
  $shqyshshz=$tjzshRecord[4]+$tjzshRecord[5]+$tjzshRecord[6]-$shqyshtjfsh;
  }
  if($shqyshshz<0){$shqyshshz=0;}
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="cfcyyyshchx.php"><?php echo $html_title;?></a></div>
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
  <select id="s_province" name="sheng" class="grd-white2"></select>
  <select id="s_city" name="shi" class="grd-white2"></select>
  <script class="resources library" src="js/area.js" type="text/javascript"></script>
  <script type="text/javascript">_init_area();</script>
  <input type="button" value="查找" onclick="chazhao();" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins">
<label>指定医生</label><span>
<input type="text" name="ysh" id="ysh" value="<?php echo $_GET[ysh];?>" class="grd-white" style="width: 160px"/>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
                </div>
                <div class="insinsins">
<label>医院</label><span><input type="text" name="yy" id="yy" value="<?php echo $_GET[yy];?>" class="grd-white" style="width: 160px"/>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
                </div>
                <div class="insinsins">
<label>授权医生</label><span><input type="text" name="shqysh" id="shqysh" value="<?php echo $_GET[shqysh];?>" class="grd-white" style="width: 160px"/>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
<label>培训班</label><span><input type="text" name="pxb" id="pxb" value="<?php echo $_GET[pxb];?>" class="grd-white" style="width: 160px"/>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
<label>手机号</label><span><input type="text" name="shj" id="shj" value="<?php echo $_GET[shj];?>" class="grd-white" style="width: 160px"/>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
                </div>
                <div class="insinsins" style="width:100%;">
<span><input type="text" id="ZuizaoJiehunRiqi" name="ZuizaoJiehunRiqi" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="ZuiwanJiehunRiqi" name="ZuiwanJiehunRiqi" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
<input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
<label>是否有授权医生</label><span><select id="shfyshqysh" name="shfyshqysh" style="width: 116px;" class="grd-white2">
  <option <?php if($_GET[shfyshqysh]==""){echo "selected=\"selected\"";}?> value="">不限</option>
  <option <?php if($_GET[shfyshqysh]=="1"){echo "selected=\"selected\"";}?> value="1">是</option>
  <option <?php if($_GET[shfyshqysh]=="0"){echo "selected=\"selected\"";}?> value="0">否</option>
	</select>
<input type="button" value="查找" onclick="chazhao();" class="uusub2" />
<input type="button" value="全部条件查找" onclick="chazhao();" class="uusub2" /></span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="7%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="10%" align="center" bgcolor="#FFFFFF">省</td>
              <td width="10%" align="center" bgcolor="#FFFFFF">城市</td>
              <td width="17%" align="center" bgcolor="#FFFFFF">医院名称</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">指定医生</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">授权医生</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">培训班</td>
              <td width="17%" align="center" bgcolor="#FFFFFF">医院地址</td>
            </tr>

<?php        

  $sql = "select * from `yyyshdq`  where `yhszht`='1'";
if($yzhguanjianci==1){
$sql .=" and ".$guanjiancisql;
}
  $sql .= " order by sheng ASC,shi ASC,yymch ASC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
      $shqyshshl=0;
      if($Record[9]!=''){$shqyshshl++;}
      if($Record[12]!=''){$shqyshshl++;}
      if($Record[15]!=''){$shqyshshl++;}
      if($shqyshshl==0){$shqyshshl="";}else{$shqyshshl=",".$shqyshshl;}
      if($Record[1]==$Record[24]){$yyshengshi=$Record[1];}else{$yyshengshi=$Record[1].$Record[24];}
?>
            <tr style="color:#1f4248; font-size:12px;">
              <td align="center" bgcolor="#FFFFFF"><a href="cfcyyyshchxxx.php?id=<?php echo $Record[0];?>">详情</a></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[1];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[24];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[3];?></td>
              <td align="center" bgcolor="#FFFFFF"><a onclick="qzyzh('<?php echo$Record[8].$shqyshshl;?>')"><?php echo $Record[6];?></a><input type='hidden' name='zhdysh<?php echo $Record[8];?>' id='zhdysh<?php echo $Record[8];?>' value='<?php echo $Record[6];?>'></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[9]." ".$Record[12]." ".$Record[15];?><input type='hidden' name='shqysh<?php echo  $Record[8];?>' id='shqysh<?php echo $Record[8];?>' value='<?php echo $Record[9]." ".$Record[12]." ".$Record[15];?>'></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[18];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $yyshengshi.$Record[26].$Record[20];?></td>
            </tr>
<?php
}
?>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
            <tr>
              <td>
                <div class="pageleft"><?php echo "共有".$shengshz."个省，".$shishz."个市，".$yymchshz."家医院，".$zhdyshshz."名指定医生，".$shqyshshz."名授权医生 ";?></div>
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
      <td width="70%" bgcolor="#FFFFFF" align="center"><img src="" id="zhdyshyzh" width="100"/><img src="" id="zhdyshqzh" width="100"/></td>
    </tr>

    <tr id="qzyzhshq" style="display:none;">
      <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生<br/><span id='shqyshxsh'></span></td>
      <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
    </tr>
  </table>
</div>

<script type="text/javascript">
 chooseDateNow('ZuizaoJiehunRiqi', 'ZuiwanJiehunRiqi', true, true);
<?php 
if($_GET[sheng]!=''){ 
?>
$("#s_province option[value='省份']").text("<?php echo $_GET[sheng];?>");
$("#s_province option[value='省份']").val("<?php echo $_GET[sheng];?>");
<?php 
}
if($_GET[shi]!=''){ 
?>
$("#s_city option[value='地级市']").text("<?php echo $_GET[shi];?>"); 
$("#s_city option[value='地级市']").val("<?php echo $_GET[shi];?>");
        <?php
}
            if($_GET[pxbrqksh]!=""){
        ?>
            $('#ZuizaoJiehunRiqi').val('<?php echo $_GET[pxbrqksh]; ?>');
        <?php
            }
            if($_GET[pxbrqjsh]!=""){
        ?>
            $('#ZuiwanJiehunRiqi').val('<?php echo $_GET[pxbrqjsh]; ?>');
        <?php
            }
        ?>

        var url = "";
        function chazhao() {
        var urlguanjianci = "cfcyyyshchx.php";
        var jlsh=0;//记录数初始等于0
//省
if($('#s_province').val()!="省份"){
var sheng = encodeURIComponent($('#s_province').val().replace(/[ ]/g,""));
}else{var sheng = "";}
//市
if($('#s_city').val()!="地级市"){
var shi = encodeURIComponent($('#s_city').val().replace(/[ ]/g,""));
}else{var shi = "";}
//医院
var yy = encodeURIComponent($('#yy').val().replace(/[ ]/g,""));
//指定医生
var ysh = encodeURIComponent($('#ysh').val().replace(/[ ]/g,""));
//授权医生
var shqysh = encodeURIComponent($('#shqysh').val().replace(/[ ]/g,""));
//培训班
var pxb = encodeURIComponent($('#pxb').val().replace(/[ ]/g,""));
var pxbrqksh = encodeURIComponent($('#ZuizaoJiehunRiqi').val().replace(/[ ]/g,""));
var pxbrqjsh = encodeURIComponent($('#ZuiwanJiehunRiqi').val().replace(/[ ]/g,""));
//手机号
var shj = encodeURIComponent($('#shj').val().replace(/[ ]/g,""));
//是否有授权医生
var shfyshqysh = encodeURIComponent($('#shfyshqysh').val().replace(/[ ]/g,""));

if(sheng!=""&&sheng!="省份"){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&sheng=" + sheng;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?sheng=" + sheng;
  }
}
if(shi!=""&&shi!="地级市"){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shi=" + shi;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shi=" + shi;
  }
}
if(yy!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&yy=" + yy;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?yy=" + yy;
  }
}
if(ysh!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&ysh=" + ysh;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?ysh=" + ysh;
  }
}
if(shqysh!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shqysh=" + shqysh;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shqysh=" + shqysh;
  }
}
if(pxb!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&pxb=" + pxb;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?pxb=" + pxb;
  }
}
if(pxbrqksh!=""&&pxbrqjsh!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&pxbrqksh=" + pxbrqksh + "&pxbrqjsh=" + pxbrqjsh;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?pxbrqksh=" + pxbrqksh + "&pxbrqjsh=" + pxbrqjsh;
  }
}
if(shj!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shj=" + shj;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shj=" + shj;
  }
}
if(shfyshqysh!=""){
  if(jlsh>0){
    urlguanjianci = urlguanjianci + "&shfyshqysh=" + shfyshqysh;
  }else{jlsh=1;
    urlguanjianci = urlguanjianci + "?shfyshqysh=" + shfyshqysh;
  }
}
            location.href = urlguanjianci;
        };
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