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

$numq=mysql_query("SELECT * FROM `zhzh`");

if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];
if(substr( $guanjianci, 0, 1 )=='x'||substr( $guanjianci, 0, 1 )=='X'){
$guanjianci=str_ireplace('x','',$guanjianci,$i);
$hzhrzid=$guanjianci;
}else{
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$hzhshqid=$guanjianci;
}
$hzhcxpjsql="(`hzhxm` LIKE '%".$guanjianci."%' or `zhjhm` LIKE '%".$guanjianci."%' or `id` = '".$hzhshqid."' or `hzhid` = '".$hzhrzid."' )";

    $hzhcxsql = "select `id` from `hzh` where ".$hzhcxpjsql."";
$guanjiancisql ="(";
$jli=0;
      $hzhcxQuery_ID = mysql_query($hzhcxsql);
      while($hzhcxRecord = mysql_fetch_array($hzhcxQuery_ID)){
      if($jli==0){
      $guanjiancisql.=" `hzhid`='".$hzhcxRecord[0]."'";
      }else{
      $guanjiancisql.=" or `hzhid`='".$hzhcxRecord[0]."'";
      }
      }
$guanjiancisql .=")";
      

//echo $guanjiancisql.$hzhcxsql;
$numq=mysql_query("SELECT * FROM `zhzh` where ".$guanjiancisql);
}

if(($_GET[ShengfenMingcheng]!="省份"&&$_GET[ShengfenMingcheng]!="")||($_GET[ChengshiMingcheng]!="地级市"&&$_GET[ChengshiMingcheng]!="")||$_GET[YiyuanId]!=""||$_GET[YishengId]!=""||$_GET[ZhuanzhenZhuangtai]!=""||$_GET[ZuizaoJiehunRiqi]!=""||$_GET[ZuiwanJiehunRiqi]!=""){
$sheng=$_GET[ShengfenMingcheng];//省
$shi=$_GET[ChengshiMingcheng];//市
$yymch=$_GET[YiyuanId];//医院名称
$yshid=$_GET[YishengId];//医生id
$zhzhzht=$_GET[ZhuanzhenZhuangtai];//转诊状态
$kshrq=$_GET[ZuizaoJiehunRiqi];//开始日期
$jshrq=$_GET[ZuiwanJiehunRiqi];//结束日期
$guanjiancisql="('1'='1' ";

if($yshid==''){
  if($yymch!=''){
  $guanjiancisql.=" and ( ";
      $yymchidsql = "select `id` from `yyyshdq` where `yymch`='".$yymch."'";
  $jli=0;
      $yymchidQuery_ID = mysql_query($yymchidsql);
      while($yymchidRecord = mysql_fetch_array($yymchidQuery_ID)){
      if($zhzhzht==''){
        if($jli==0){
          $guanjiancisql.=" `zhzhyy`='".$yymchidRecord[0]."' or `jzhyy`='".$yymchidRecord[0]."' ";
        }else{
          $guanjiancisql.=" or `zhzhyy`='".$yymchidRecord[0]."' or `jzhyy`='".$yymchidRecord[0]."'";
        }
      }
      if($zhzhzht=='0'){
        if($jli==0){
          $guanjiancisql.=" `jzhyy`='".$yymchidRecord[0]."' ";  
        }else{
          $guanjiancisql.=" or `jzhyy`='".$yymchidRecord[0]."' ";
        }    
      }
      if($zhzhzht=='1'){
        if($jli==0){
          $guanjiancisql.=" `zhzhyy`='".$yymchidRecord[0]."' ";  
        }else{
          $guanjiancisql.=" or `zhzhyy`='".$yymchidRecord[0]."' ";
        }  
      }
        //echo $yymchidRecord[0];
        $jli++;
      }
  $guanjiancisql.=" ) ";
  }
}else{
  if($zhzhzht==''){
  $guanjiancisql.=" and ( `zhzhyy`='".$yshid."' or `jzhyy`='".$yshid."' )";  
  }
  if($zhzhzht=='0'){
  $guanjiancisql.=" and  `jzhyy`='".$yshid."' ";
  }
  if($zhzhzht=='1'){
  $guanjiancisql.=" and  `zhzhyy`='".$yshid."' ";
  }
}
if($kshrq!=''||$jshrq!=''){
  //时间
  $guanjiancisql.=" and `jbrq`>='".$kshrq."' and `jbrq`<='".$jshrq."'";
}
$guanjiancisql.=")";
$numq=mysql_query("SELECT * FROM `zhzh` where ".$guanjiancisql);
//echo $guanjiancisql;
}

$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="转诊管理";
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
                  <span><input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="患者姓名、申请号、患者身份号码或患者编码" class="grd-white" /> <input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span>
                </div>
                <div class="insinsins">
                  <span>
                    <select id="s_province" name="ShengfenMingcheng"  class="grd-white2"></select>
                    <select id="s_city" name="ChengshiMingcheng"  class="grd-white2"></select>
                    <script class="resources library" src="js/area.js" type="text/javascript"></script>
                    <script type="text/javascript">_init_area();</script>
                    <select id="YiyuanId" name="YiyuanId" class="grd-white2"  style="width: 240px;">
                      <option value="">--请选择医院--</option>
                    </select>
                    <select id="YishengId" name="YishengId" class="grd-white2"  style="width: 116px;">
                      <option value="">--请选择医生--</option>
                    </select>
                    <select id="ZhuanzhenZhuangtai" name="ZhuanzhenZhuangtai" class="grd-white2" style="width:110px">
                      <option <?php if($_GET[ZhuanzhenZhuangtai]==''){echo "selected=\"selected\"";}?> value="">不限转诊</option>
                      <option <?php if($_GET[ZhuanzhenZhuangtai]=='0'){echo "selected=\"selected\"";}?> value="0">转入</option>
                      <option <?php if($_GET[ZhuanzhenZhuangtai]=='1'){echo "selected=\"selected\"";}?> value="1">转出</option>
                    </select>
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <span><input type="text" id="ZuizaoJiehunRiqi" name="ZuizaoJiehunRiqi" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="ZuiwanJiehunRiqi" name="ZuiwanJiehunRiqi" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
                  <input id="btnGuolv" type="button" value="高级过滤" onclick="guolv();" class="uusub2"  /></span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="7%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">患者</td>
              <td width="17%" align="center" bgcolor="#FFFFFF">转诊医院/转诊医生</td>
              <td width="17%" align="center" bgcolor="#FFFFFF">接诊医院/接诊医生</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">申请日期</td>
              <td width="12%" align="center" bgcolor="#FFFFFF">转诊状态</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">经办日期</td>
            </tr>
          <?php        

            //$sql = "select * from `zhzh` order by id DESC limit $page $pagesize ";
            $sql = "select * from `zhzh` ";
            if($guanjiancisql!=""){
            $sql .="where ".$guanjiancisql;
            }
            $sql .= "order by id DESC limit $page $pagesize ";
            //echo $sql;
            $Query_ID = mysql_query($sql);
            while($Record = mysql_fetch_array($Query_ID)){
          ?>
            <tr style="color:#1f4248; font-size:12px;">
              <td align="center" bgcolor="#FFFFFF"><a href="zhzhshqxq.php?id=<?php echo $Record[0];?>">详细</a></td>
              <td align="center" bgcolor="#FFFFFF"><a href="shqxq.php?id=<?php echo $Record[1];?>" title="点击查看患者申请详细信息">
                  <?php
                    $hzhsql = "select * from `hzh` where id='$Record[1]'";
                    $hzhQuery_ID = mysql_query($hzhsql);
                    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
                    echo $hzhRecord[4];
                    }
                  ?></a></td>
              <td align="center" bgcolor="#FFFFFF"><?php        
              $yysql = "select sheng,yymch,zhdysh,zhdyshdh from `yyyshdq` where `id`='".$Record[5]."'";

              $yyQuery_ID = mysql_query($yysql);
              while($yyRecord = mysql_fetch_array($yyQuery_ID)){
                echo $yyRecord[0]." ".$yyRecord[1]." ".$yyRecord[2];
              }
          ?></td>
              <td align="center" bgcolor="#FFFFFF"><?php        
              $yy2sql = "select sheng,yymch,zhdysh,zhdyshdh from `yyyshdq` where `id`='".$Record[8]."'";

              $yy2Query_ID = mysql_query($yy2sql);
              while($yy2Record = mysql_fetch_array($yy2Query_ID)){
                echo $yy2Record[0]." ".$yy2Record[1]." ".$yy2Record[2];
              }
              ?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[7];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[4];?></td>
              <td align="center" bgcolor="#FFFFFF"><?php echo $Record[13];?></td>
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
<script type="text/javascript">
var url = "";
function chazhao() {
  var urlguanjianci = 'zhzhshqgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
  location.href = urlguanjianci;
};

function guolv() {
  var urlguolv = 'zhzhshqgl.php?ShengfenMingcheng=' + encodeURIComponent($('#s_province').val()) 
  + '&ChengshiMingcheng=' + encodeURIComponent($('#s_city').val()) 
  + '&YiyuanId=' + encodeURIComponent($('#YiyuanId').val())
  + '&YishengId=' + encodeURIComponent($('#YishengId').val())
  + '&ZhuanzhenZhuangtai=' + encodeURIComponent($('#ZhuanzhenZhuangtai').val())
  + '&ZuizaoJiehunRiqi=' + encodeURIComponent($('#ZuizaoJiehunRiqi').val())
  + '&ZuiwanJiehunRiqi=' + encodeURIComponent($('#ZuiwanJiehunRiqi').val());

  location.href = urlguolv;
}


$(function () {
  chooseDateNow('ZuizaoJiehunRiqi', 'ZuiwanJiehunRiqi', true, true);
  <?php
  if($_GET[ShengfenMingcheng]!=""){
  ?>
  $("#s_province option[value='省份']").text("<?php echo $_GET[ShengfenMingcheng];?>");
  $("#s_province option[value='省份']").val("<?php echo $_GET[ShengfenMingcheng];?>");
  <?php
  }
  if($_GET[ChengshiMingcheng]!=""){
  ?>
  $("#s_city option[value='地级市']").text("<?php echo $_GET[ChengshiMingcheng];?>");
  $("#s_city option[value='地级市']").val("<?php echo $_GET[ChengshiMingcheng];?>"); 
  <?php
  }
  if($_GET[YiyuanId]!=""){
  ?>
  $("#YiyuanId option[value='']").text("<?php echo $_GET[YiyuanId];?>");
  $("#YiyuanId option[value='']").val("<?php echo $_GET[YiyuanId];?>");
  <?php
  }
  if($_GET[YishengId]!=""){
  $yyidmchsql = "select `zhdysh` from `yyyshdq` where `id`='".$_GET[YishengId]."'";
  $jli=0;
  $yyidmchQuery_ID = mysql_query($yyidmchsql);
  while($yyidmchRecord = mysql_fetch_array($yyidmchQuery_ID)){
  ?>
  $("#YishengId option[value='']").text("<?php echo $yyidmchRecord[0];?>");
  $("#YishengId option[value='']").val("<?php echo $_GET[YishengId];?>"); 
  <?php
  }
  }
  if($_GET[ZuizaoJiehunRiqi]!=""){
  ?>
  $('#ZuizaoJiehunRiqi').val('<?php echo $_GET[ZuizaoJiehunRiqi]; ?>');
  <?php
  }
  if($_GET[ZuiwanJiehunRiqi]!=""){
  ?>
  $('#ZuiwanJiehunRiqi').val('<?php echo $_GET[ZuiwanJiehunRiqi]; ?>');
  <?php
  }
  ?>
  $("#s_province").click( function () {
    $("#YiyuanId").empty();
    $("#YiyuanId").html("");
    $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>");
    $("#YishengId").empty();        
    $("#YishengId").html(""); 
    $("#YishengId").append("<option value=\"\">--请选择医生--</option>");
  });
  $("#s_city").click( function () {
    $("#YiyuanId").empty();
    $("#YiyuanId").html("");
    $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>");
    $("#YishengId").empty();        
    $("#YishengId").html(""); 
    $("#YishengId").append("<option value=\"\">--请选择医生--</option>");
  });
//省市医院医生 联动 开始
  $("#s_city").change( function () {
    var chsh = $("#s_city").val();
    if(chsh!='' && chsh!='地级市'){
    //alert("手机号错误!");
    //$("#YiyuanId").append( "<option value=\"1\">Select</option>" );
      $.post(  
        'shqglchxyyac.php',  
        {
          shf:$('#s_province').val(),
          chsh:$('#s_city').val()
        },  
        function (data) { //回调click函数  
          $("#YiyuanId").empty();
          $("#YiyuanId").html(""); 
          $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>"+data);
          //alert(data);
        } 
      );
    }
  });
  $("#s_city").click( function () {
    var chsh = $("#s_city").val();
    if(chsh!='' && chsh!='地级市'){
    //alert("手机号错误!");
    //$("#YiyuanId").append( "<option value=\"1\">Select</option>" );
      $.post(  
        'shqglchxyyac.php',  
        {
          shf:$('#s_province').val(),
          chsh:$('#s_city').val()
        },  
        function (data) { //回调click函数  
          $("#YiyuanId").empty();
          $("#YiyuanId").html(""); 
          $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>"+data);
          //alert(data);
        } 
      );
    }
  });

  $("#YiyuanId").change( function () {
    var yymch = $("#YiyuanId").val();
    if(yymch!=''){
      $.post(  
        'shqglchxyyyshac.php',  
        {
          yymch:$('#YiyuanId').val()
        },  
        function (data) { //回调click函数  
          $("#YishengId").empty();        
          $("#YishengId").html(""); 
          $("#YishengId").append("<option value=\"\">--请选择医生--</option>"+data);
          //alert(data);
        } 
      );
    }
  }); 
  $("#YiyuanId").click( function () {
    var yymch = $("#YiyuanId").val();
    if(yymch!=''){
      $.post(  
        'shqglchxyyyshac.php',  
        {
          yymch:$('#YiyuanId').val()
        },  
        function (data) { //回调click函数  
          $("#YishengId").empty();        
          $("#YishengId").html(""); 
          $("#YishengId").append("<option value=\"\">--请选择医生--</option>"+data);
          //alert(data);
        } 
      );
    }
  });      
//省市医院医生 联动 结束

});
</script>
</body>
</html>
