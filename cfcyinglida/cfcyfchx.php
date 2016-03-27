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

$numsql="SELECT * FROM `yf` where  `shfzt`='1'";// group by yymch
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];

$guanjiancisql="(`yfmch` LIKE '%".$guanjianci."%' or `yfsheng` LIKE '%".$guanjianci."%' or `yfshi` LIKE '%".$guanjianci."%' or `yfzhdysh` LIKE '%".$guanjianci."%' or `yfshj` LIKE '%".$guanjianci."%' or `yfdh` LIKE '%".$guanjianci."%')";

$numsql="SELECT * FROM `yf` where  `shfzt`='1' and ".$guanjiancisql;
}

$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }

$html_title="指定药房药师管理";
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
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
                <div class="insinsins" style="width:100%;">
<span>
  <input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="请输入药房省、市、名称、药师姓名、电话号码" class="grd-white" />
  <input type="button" value="查找" onclick="chazhao();" class="uusub2" />
</span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="17%" align="center" bgcolor="#FFFFFF">药房名称</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">所在城市</td>
              <td width="17%" align="center" bgcolor="#FFFFFF">药房地址</td>
<!--               <td width="9%" align="center" bgcolor="#FFFFFF">药房状态</td> -->
              <td width="7%" align="center" bgcolor="#FFFFFF">指定药师姓名</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">办公电话</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">手机号</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">授权药师姓名</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">手机号</td>
<!--               <td width="9%" align="center" bgcolor="#FFFFFF">操作</td> -->
            </tr>
<?php        
  $sql = "select * from `yf` where `shfzt`='1'";
if($guanjiancisql!=""){
$sql .=" and ".$guanjiancisql;
}
  $sql .= " group by yfdzh order by id DESC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
$yfsql = "select count(*),SUM(shfzt) from `yf` where `yfmch`='".$Record[1]."'";
$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){$yfyshshl=$yfRecord[0];$yfzt=$yfRecord[1];}
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[14]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";
//     if($yfzt>'0'){echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";}else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\">停用</td>";}
      $shqyshshl=0;
      if($Record[19]!=''){$shqyshshl++;}
      if($shqyshshl==0){$shqyshshl="";}else{$shqyshshl=",".$shqyshshl;}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a  onclick=\"qzyzh(".$Record[18].$shqyshshl.")\">".$Record[11]."</a></td>";
    $yshbgdh=str_replace("/", "</br>", $Record[3]);
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yshbgdh."</td>";
    $yshdh=str_replace("/", "</br>", $Record[4]);
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yshdh."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[19]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[22]."</td>";
//     echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcyfchxxx.php?yfmch=".$Record[1]."\">详细</a></td></tr>";
    
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
      <td width="30%" bgcolor="#FFFFFF" align="center">指定药师</td>
      <td width="70%" bgcolor="#FFFFFF" align="center"><img id="zhdyshyzh"/></td>
    </tr>
    <tr id="qzyzhshq" style="display:none;">
      <td width="30%"  bgcolor="#FFFFFF" align="center">授权药师</td>
      <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
    </tr>
  </table>
</div>
<script type="text/javascript">
  var url = "";
  function chazhao() {
      var urlguanjianci = 'cfcyfchx.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
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
document.getElementById('zhdyshyzh').src='./qzyzhyf/'+imgsrc+'.jpg';
if(i!=undefined&&i>0){
//alert('怎么来着了?');
document.getElementById('qzyzhshq').style.display='';
var shqimg="";
  for(j=0;j<i;j++){
  shqimg = shqimg+'<img src="./qzyzhyf/'+imgsrc+'-'+(j+1)+'.jpg"/>';
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