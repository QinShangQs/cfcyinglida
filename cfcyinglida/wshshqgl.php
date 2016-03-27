<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb_yy.php');

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


$numq=mysql_query("SELECT * FROM `hzh`");
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}



if(($_GET[ShengfenMingcheng]!="省份"&&$_GET[ShengfenMingcheng]!="")||($_GET[ChengshiMingcheng]!="地级市"&&$_GET[ChengshiMingcheng]!="")||$_GET[YiyuanId]!=""||$_GET[YishengId]!=""||$_GET[ShijianLeixing]!=""||$_GET[ShenqingZhuangtai]!=""||$_GET[ZhuanzhenZhuangtai]!=""||$_GET[juanzhuleixing]!=""||$_GET[canbaoleixing]!=""||$_GET[ZuizaoJiehunRiqi]!=""||$_GET[ZuiwanJiehunRiqi]!=""||$_GET[Guanjianci]!=""){
$sheng=$_GET[ShengfenMingcheng];//省
$shi=$_GET[ChengshiMingcheng];//市
$yymch=$_GET[YiyuanId];//医院名称
$yshid=$_GET[YishengId];//医生id

$shqzht=$_GET[ShenqingZhuangtai];//申请状态
$cblx=$_GET[canbaoleixing];//参保类型

$kshrq=$_GET[ZuizaoJiehunRiqi];//开始日期
$jshrq=$_GET[ZuiwanJiehunRiqi];//结束日期
$shjlx=$_GET[ShijianLeixing];//时间类型
$guanjianci=$_GET[Guanjianci];//姓名、证件号、编号
$drzht=$_GET[drzht];//导入状态
$guanjiancisql="('1'='1' ";

if($yshid==''){
  if($yymch!=''){//申请状态
    $guanjiancisql.=" and ( ";
    Mysql_select_db("CFCSYSTEM");
    $yymchidsql = "select `id` from `yyyshdq` where `yymch`='".$yymch."'";
$jli=0;
      $yymchidQuery_ID = mysql_query($yymchidsql);
      while($yymchidRecord = mysql_fetch_array($yymchidQuery_ID)){
      if($jli==0){
      $guanjiancisql.=" `shqyy`='".$yymchidRecord[0]."'";
      }else{
      $guanjiancisql.=" or `shqyy`='".$yymchidRecord[0]."'";
      }
        //echo $yymchidRecord[0];
        $jli++;
      }
    Mysql_select_db("cfcwshshq");
        $guanjiancisql.=" ) ";
        //echo $guanjiancisql;
  }else if($sheng!='省份')
  {
    $guanjiancisql.=" and `hzhdzhsheng` ='".$sheng."'";
    if($shi!='地级市')
    {
    $guanjiancisql.=" and `hzhdzhshi` = '".$shi."'";
    }
  }
  if($shqzht!=''){//申请状态
    $guanjiancisql.=" and `shfwchtj`='".$shqzht."'";
  }
  
  if($cblx!=''){//参保类型
    $guanjiancisql.=" and `cblx`='".$cblx."'";
  }   
  if($shjlx!=""&&$shjlx=="1"){//时间类型
  if($kshrq!=''&&$jshrq!=""){//开始日期-结束日期
    $guanjiancisql.=" and `wshyyshj`>='".$kshrq."' and `wshyyshj`<='".$jshrq."'";
  } 
  }else if($shjlx!=""&&$shjlx=="2"){ 
  if($kshrq!=''&&$jshrq!=""){//开始日期-结束日期
    $guanjiancisql.=" and `wshyychgshj`>='".$kshrq."' and `wshyychgshj`<='".$jshrq."'";
  } 
  } 
  
  
}else{
  $guanjiancisql.=" and `shqyy`='".$yshid."' ";
  
  if($shqzht!=''){//申请状态
    $guanjiancisql.=" and `shfwchtj`='".$shqzht."'";
  }
  if($cblx!=''){//参保类型
    $guanjiancisql.=" and `cblx`='".$cblx."'";
  }
}
if($guanjianci!=''){
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$guanjiancisql.=" and (`id`='".$guanjianci."' or `hzhxm` LIKE '%".$guanjianci."%' or `zhjhm`='".$guanjianci."')";
}
if($drzht!=''){
$guanjiancisql.=" and `drxt`='".$drzht."'";
}
$guanjiancisql.=")";
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
//echo $guanjiancisql;
}

$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="网上预约管理";
include('spap_head.php');

?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="wshshqgl.php"><?php echo $html_title;?></a></div>
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
<select id="s_province" name="ShengfenMingcheng" class="grd-white2"></select>
<select id="s_city" name="ChengshiMingcheng" class="grd-white2"></select>
<script class="resources library" src="js/area.js" type="text/javascript"></script>
<script type="text/javascript">_init_area();</script>
<select id="YiyuanId" name="YiyuanId" style="width: 240px;" class="grd-white2">
  <option value="">--请选择医院--</option>
</select>
<select id="YishengId" name="YishengId" style="width: 116px;" class="grd-white2">
  <option value="">--请选择医生--</option>
</select>
                  </span>
                </div>
                <div class="insinsins">
                  <span>
<select id="ShenqingZhuangtai" name="ShenqingZhuangtai" style="width:110px" class="grd-white2">
  <option <?php if($_GET[ShenqingZhuangtai]==''){echo "selected=\"selected\"";}?> value="">不限申请状态</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='1'){echo "selected=\"selected\"";}?> value="1">已预约</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='0'){echo "selected=\"selected\"";}?> value="0">未完成</option>
</select>                
<select id="canbaoleixing" name="canbaoleixing" style="width:110px" class="grd-white2">
  <option <?php if($_GET[canbaoleixing]==''){echo "selected=\"selected\"";}?> value="">不限参保类型</option>
  <option <?php if($_GET[canbaoleixing]=='无'){echo "selected=\"selected\"";}?> value="无">无</option>
  <option <?php if($_GET[canbaoleixing]=='城镇职工（含离退休人员）医疗保险'){echo "selected=\"selected\"";}?> value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
  <option <?php if($_GET[canbaoleixing]=='城镇居民医疗保险'){echo "selected=\"selected\"";}?> value="城镇居民医疗保险">城镇居民医疗保险</option>
  <option <?php if($_GET[canbaoleixing]=='新农合医疗保险'){echo "selected=\"selected\"";}?> value="新农合医疗保险">新农合医疗保险</option>
  <option <?php if($_GET[canbaoleixing]=='公费医疗'){echo "selected=\"selected\"";}?> value="公费医疗">公费医疗</option>
  <option <?php if($_GET[canbaoleixing]=='现役军人医疗体系'){echo "selected=\"selected\"";}?> value="现役军人医疗体系">现役军人医疗体系</option>
</select>  
<input type="text" id="ZuizaoJiehunRiqi" name="ZuizaoJiehunRiqi" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="ZuiwanJiehunRiqi" name="ZuiwanJiehunRiqi" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
								<select id="ShijianLeixing" name="ShijianLeixing" style="width:130px" class="grd-white2">
	<option <?php if($_GET[ShijianLeixing]=='1'){echo "selected=\"selected\"";}?> value="1">首次预约日期</option>
	<option <?php if($_GET[ShijianLeixing]=='2'){echo "selected=\"selected\"";}?> value="2">预约成功日期</option>
	</select>
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <span>
<input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="患者姓名、预约号、患者身份号码" class="grd-white" style="width: 320px" />
导入状态：<select id="drzht" name="drzht"	style="width: 116px;" class="grd-white2">
		<option <?php if($_GET[drzht]==''){echo "selected=\"selected\"";}?> value="">不限</option>
		<option <?php if($_GET[drzht]=='1'){echo "selected=\"selected\"";}?> value="1">已导入</option>
		<option <?php if($_GET[drzht]=='0'){echo "selected=\"selected\"";}?> value="0">未导入</option>
	</select>
	<input id="btnGuolv" type="button" value="高级过滤" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">          
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="6%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">申请病种</td>
              <td width="20%" align="left" bgcolor="#FFFFFF">患者姓名&nbsp;&nbsp;预约号</br>患者身份号码</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">申请状态</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">预约日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">患者性别</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">户籍类型</td>
              <td width="20%" align="left" bgcolor="#FFFFFF">指定医院 - 指定医生<br/>指定药房</td>
            </tr>

<?php        

  $sql = "select * from `hzh` ";
  if($guanjiancisql!=""){
  $sql .="where ".$guanjiancisql;
  }
  $sql .= "order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"wshshqxq.php?id=".$Record[0]."\">查看</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><span  class=RuxianaiColor>肺癌</span></td>";
    echo "<td align=\"left\" bgcolor=\"#FFFFFF\">".$Record[2]."&nbsp;&nbsp;";
     echo sprintf("%05d", $Record[0]);
     echo "<br />".$Record[3].$Record[4]."</td>";
    echo "<td  align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[29]==0){echo "未完成";}
    else if($Record[29]==1){echo "已预约";}
    if($Record[32]==1){echo "</br>已导入";}
    echo "</td>";
    if($Record[31]!=""){$yyrq=$Record[31];}else if($Record[30]!=""){$yyrq=$Record[30];}else{$yyrq="";}
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$yyrq."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[5]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[14]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
      $yysql = "select `sheng`,`shi`,`qu`,`yymch`,`zhdysh`,`yyzhdyf` from `yyyshdq` where id='".$Record[23]."'";
      //echo $yysql;
      Mysql_select_db("CFCSYSTEM");
      
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $yyzhdyf=$yyRecord[5];
      //$yyRecord[0].$yyRecord[1].$yyRecord[2]." ".
        echo $yyRecord[3]." ".$yyRecord[4];
      }
     echo "<br />";
      $yfsql = "select `yfmch` from `yf` where id='".$yyzhdyf."'";
      //echo $yfsql;
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){
        echo $yfRecord[0];
      }   
     echo "</td></tr>";
      Mysql_select_db("cfcwshshq");
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
        function guolv() {
            var urlguolv = 'wshshqgl.php?ShengfenMingcheng=' + encodeURIComponent($('#s_province').val()) 
+ '&ChengshiMingcheng=' + encodeURIComponent($('#s_city').val()) 
+ '&YiyuanId=' + encodeURIComponent($('#YiyuanId').val())
+ '&YishengId=' + encodeURIComponent($('#YishengId').val())
+ '&ShenqingZhuangtai=' + encodeURIComponent($('#ShenqingZhuangtai').val())
+ '&juanzhuleixing=' + encodeURIComponent($('#juanzhuleixing').val())
+ '&canbaoleixing=' + encodeURIComponent($('#canbaoleixing').val())
+ '&ZuizaoJiehunRiqi=' + encodeURIComponent($('#ZuizaoJiehunRiqi').val())
+ '&ZuiwanJiehunRiqi=' + encodeURIComponent($('#ZuiwanJiehunRiqi').val())
+ '&ShijianLeixing=' + encodeURIComponent($('#ShijianLeixing').val())
+ '&Guanjianci=' + encodeURIComponent($('#Guanjianci').val());
if(encodeURIComponent($('#drzht').val())!=''){
urlguolv = urlguolv + '&drzht=' + encodeURIComponent($('#drzht').val());
}
            location.href = urlguolv;

        }



        $(function () {
            chooseDateNow('ZuizaoJiehunRiqi', 'ZuiwanJiehunRiqi', true, true);
            chooseDateNow('KaishiShijian', 'JieshuShijian', true, true);
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
  Mysql_select_db("CFCSYSTEM");
      $yyidmchsql = "select `zhdysh` from `yyyshdq` where `id`='".$_GET[YishengId]."'";
$jli=0;
      $yyidmchQuery_ID = mysql_query($yyidmchsql);
      while($yyidmchRecord = mysql_fetch_array($yyidmchQuery_ID)){
        ?>
      $("#YishengId option[value='']").text("<?php echo $yyidmchRecord[0];?>");
      $("#YishengId option[value='']").val("<?php echo $_GET[YishengId];?>"); 
        <?php
      }
  Mysql_select_db("cfcwshshq");
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