<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=[0-9]&/", "", $url[query]);
$url[query] = preg_replace("/&page=[0-9]/", "", $url[query]);
$url[query] = preg_replace("/page=[0-9]/", "", $url[query]);

if($url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}

$numq=mysql_query("SELECT * FROM `hzh`");
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];

if(substr( $guanjianci, 0, 1 )=='x'||substr( $guanjianci, 0, 1 )=='X'){
$guanjianci=str_ireplace('x','',$guanjianci,$i);
$guanjiancisql="(`hzhid`='".$guanjianci."')";

}else{
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$guanjiancisql="(`id`='".$guanjianci."' or `hzhxm` LIKE '%".$guanjianci."%' or `zhjhm`='".$guanjianci."')";
}
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
}
if($_GET[wlykshrq]!=""&&$_GET[wlyjshrq]!=""){
$wlykshrq=$_GET[wlykshrq];
$wlyjshrq=$_GET[wlyjshrq];
$xclyrqsql="SELECT * FROM `xclyrq` WHERE `xclyrq`>='".date('Y-m-d',strtotime('-90 day',strtotime($wlykshrq)))."' and `xclyrq`<='".date('Y-m-d',strtotime('-90 day',strtotime($wlyjshrq)))."'";
$guanjiancisql="(";
$jli=0;
  $xclyrqQuery_ID = mysql_query($xclyrqsql);
  while($xclyrqRecord = mysql_fetch_array($xclyrqQuery_ID)){
  if($jli==0){$guanjiancisql.=" `id`='".$xclyrqRecord[0]."'";}else{
      $guanjiancisql.=" or `id`='".$xclyrqRecord[0]."'";}
  } 
$guanjiancisql.=")";
//echo $guanjiancisql;
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
}
if($_GET[ygrzrqksh]!=""&&$_GET[ygrzrqjsh]!=""){
$ygrzrqksh=$_GET[ygrzrqksh];
$ygrzrqjsh=$_GET[ygrzrqjsh];

$guanjiancisql="(`dbrzshxshj`>='".$ygrzrqksh."' and `dbrzshxshj`<='".$ygrzrqjsh."' )";

$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
}
if(($_GET[ShengfenMingcheng]!="省份"&&$_GET[ShengfenMingcheng]!="")||($_GET[ChengshiMingcheng]!="地级市"&&$_GET[ChengshiMingcheng]!="")||$_GET[YiyuanId]!=""||$_GET[YishengId]!=""||$_GET[ShijianLeixing]!=""||$_GET[ShenqingZhuangtai]!=""||$_GET[ZhuanzhenZhuangtai]!=""||$_GET[juanzhuleixing]!=""||$_GET[canbaoleixing]!=""||$_GET[ZuizaoJiehunRiqi]!=""||$_GET[ZuiwanJiehunRiqi]!=""){
$sheng=$_GET[ShengfenMingcheng];//省
$shi=$_GET[ChengshiMingcheng];//市
$yymch=$_GET[YiyuanId];//医院名称
$yshid=$_GET[YishengId];//医生id

$shqzht=$_GET[ShenqingZhuangtai];//申请状态
$zhzhzht=$_GET[ZhuanzhenZhuangtai];//转诊状态
$jzhlx=$_GET[juanzhuleixing];//捐助类型
$cblx=$_GET[canbaoleixing];//参保类型
$kshrq=$_GET[ZuizaoJiehunRiqi];//开始日期
$jshrq=$_GET[ZuiwanJiehunRiqi];//结束日期
$shjlx=$_GET[ShijianLeixing];//时间类型
$guanjiancisql="('1'='1' ";

if($yshid==''){

  if($yymch!=''){//申请状态
    $guanjiancisql.=" and ( ";
    $yymchidsql = "select `id` from `yyyshdq` where `yymch`='".$yymch."'";
$jli=0;
      $yymchidQuery_ID = mysql_query($yymchidsql);
      while($yymchidRecord = mysql_fetch_array($yymchidQuery_ID)){
      if($jli==0){
        if($shqzht==""||$shqzht=="拒绝"){ 
        $guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."' or `shqyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.=" `shqyy`='".$yymchidRecord[0]."'";
        }
      }else{
        if($shqzht==""||$shqzht=="拒绝"){ 
        $guanjiancisql.=" or `rzyy`='".$yymchidRecord[0]."' or `shqyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.=" or `shqyy`='".$yymchidRecord[0]."'";
        }
      }
        //echo $yymchidRecord[0];
        $jli++;
      }
        $guanjiancisql.=" ) ";
  }else   if($sheng!='省份')
  {
    $guanjiancisql.=" and `hzhtxdzh` LIKE '".$sheng."%'";
    if($shi!='地级市')
    {
    $guanjiancisql.=" and `hzhtxdzh` LIKE '%".$shi."%'";
    }
  }
  if($shqzht!=''){//申请状态
    $guanjiancisql.=" and `shqzht`='".$shqzht."'";
  }
  if($zhzhzht=='1'){//转诊状态
        $guanjiancisql.=" and `zhzhyy`<>''";
  }
  if($jzhlx!=''){//捐助类型
    $guanjiancisql.=" and `jzhlx`='".$jzhlx."'";
  }  
  if($cblx!=''){//参保类型
    $guanjiancisql.=" and `cblx`='".$cblx."'";
  }   
  
}else{

        if($shqzht==""||$shqzht=="拒绝"){ 
        $guanjiancisql.="and ( `rzyy`='".$yshid."' or `shqyy`='".$yshid."' or `zhzhyy`='".$yshid."' )";
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.="and ( `shqyy`='".$yshid."')";
        }
  
  if($shqzht!=''){//申请状态
    $guanjiancisql.=" and `shqzht` LIKE '%".$shqzht."%'";
  }
  if($zhzhzht!=''){//转诊状态
    $guanjiancisql.=" and `zhzhyy`<>''";
  }
  if($jzhlx!=''){//捐助类型
    $guanjiancisql.=" and `jzhlx`='".$jzhlx."'";
  }  
  if($cblx!=''){//参保类型
    $guanjiancisql.=" and `cblx`='".$cblx."'";
  }
}
if($kshrq!=''||$jshrq!=''){
  //$shjlx 时间类型
  if($shjlx=='1'){
  $guanjiancisql.=" and `djrq`>='".$kshrq."' and `djrq`<='".$jshrq."'";
  }
  if($shjlx=='2'){
  $guanjiancisql.=" and `chcshhrq`>='".$kshrq."' and `chcshhrq`<='".$jshrq."'";
  }
  if($shjlx=='3'){
  $guanjiancisql.=" and `zhshrzshj`>='".$kshrq."' and `zhshrzshj`<='".$jshrq."'";
  }
  if($shjlx=='4'){
  $guanjiancisql.=" and `hzhchzrq`>='".$kshrq."' and `hzhchzrq`<='".$jshrq."'";
  }
}
$guanjiancisql.=")";
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
//echo $guanjiancisql;
}

$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申请管理</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="style/jquery.autocomplete.css" rel="Stylesheet" type="text/css" />
<link href="style/AnniuCaidan.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.all.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.tabs.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.dialog.css" rel="Stylesheet" type="text/css" />
<link href="style/textboxlist.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>

<script type="text/javascript" src="js/SelectDate.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
</head>

<body>
<div class="wrap">
	<div class="head">
		<div class="head_info">
			<div class="head_left"><img src="./images/tp_left.gif" /></div>
			<div class="head_right">
				<div class="head_right_top"><img src="./images/head_right_top.gif" /></div>
				<div class="head_right_middle">欢迎您，<?php echo $_SESSION[yhname];?> <a href="/">注销</a> <a href="xgmm.php">修改密码</a> <a href="manager.php">首页</a></div>
				<div class="head_right_nav">
					<ul>
						<li><strong><a href="#">高级搜索</a></strong></li>
						<li><strong><a href="#">数据备份</a></strong></li>
						<li><strong><a href="#">不良事件</a></strong></li>
						<li><strong><a href="#">统计</a></strong></li>
						<li><strong><a href="#">转诊</a></strong></li>
						<li><strong><a href="#">随访</a></strong></li>
						<li><strong><a href="#">出组</a></strong></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>申请管理</strong><span><a href="shqxz.php">新增申请</a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>

					  	<div class="insinsins" style="width:100%;"><span><input type="text" id="Guanjianci" name="Guanjianci" value="" placeholder="患者姓名、申请号、患者身份号码或患者编码" class="grd-white" /> <input type="button" value="查找" onclick="chazhao();" class="uusub2" /></span></div>
						<div class="insinsins" style="width:100%;"><span><select id="s_province" name="ShengfenMingcheng" class="grd-white2"></select>
		<select id="s_city" name="ChengshiMingcheng"  class="grd-white2"></select>		<script src="js/area.js" type="text/javascript"></script><script type="text/javascript">_init_area();</script>
		<select id="YiyuanId" name="YiyuanId" class="grd-white2">
		<option value="">--请选择医院--</option> 
	</select> 
	<select id="YishengId" name="YishengId" class="grd-white2">
		<option value="">--请选择医生--</option>
	</select>
	<select id="ShenqingZhuangtai" name="ShenqingZhuangtai" class="grd-white2">
<option selected="selected" value="">不限申请状态</option>
<option value="审核">审核</option>
<option value="待办入组">待办入组</option>
<option value="入组">入组</option>
<option value="出组">出组</option>
<option value="拒绝">拒绝</option>
<option value="停止申请">停止申请</option>
</select>                
							   <select id="ZhuanzhenZhuangtai" name="ZhuanzhenZhuangtai" class="grd-white2">
<option selected="selected" value="">不限是否转诊</option>
<option value="0">没有转诊</option>
<option value="1">曾经转诊</option>
</select>
							 
<select id="juanzhuleixing" name="juanzhuleixing" class="grd-white2">
<option selected="selected" value="">不限捐赠类型</option>
<option value="全部">全部</option>
<option value="部分">部分</option>
</select>
<select id="canbaoleixing" name="canbaoleixing" class="grd-white2">
<option selected="selected" value="">不限参保类型</option>
<option value="无">无</option>
<option value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
<option value="城镇居民医疗保险">城镇居民医疗保险</option>
<option value="新农合医疗保险">新农合医疗保险</option>
<option value="公费医疗">公费医疗</option>
<option value="现役军人医疗体系">现役军人医疗体系</option>
</select> 
<input type="text" id="ZuizaoJiehunRiqi" name="ZuizaoJiehunRiqi" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value=""  class="grd-white" />-<input type="text" id="ZuiwanJiehunRiqi" name="ZuiwanJiehunRiqi" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value=""  class="grd-white" />
								<select id="ShijianLeixing" name="ShijianLeixing" class="grd-white2"><option value="1">首次登记日期</option>
	<option value="2">审核日期</option>
	<option value="3">入组日期</option>
	<option value="4">出组日期</option>
	</select>
							<input id="btnGuolv" type="button" value="高级过滤" onclick="guolv();" class="uusub" /> 
	</span></div>
	
						<div class="insinsins" style="width:100%;"><label>网上申请预约码：</label><span><input type="text" id="wshshqyym" name="wshshqyym" value="" placeholder="患者预约码" class="grd-white" /> <input type="button" value="信息导入" onclick="wshshqyym()" class="uusub" /></span></div>
						
						<div class="insinsins"><label>预估入组日期:</label><span><input type="text" id="ygrzrqksh" name="ygrzrqksh" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="ygrzrqjsh" name="ygrzrqjsh" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
	 <input type="button" value="查找" onclick="ygchaxun();" class="uusub2" /></span></div>	
	 
						<div class="insinsins"><label>未领药查询：</label><span><input type="text" id="wlykshrq" name="wlykshrq" readonly="readonly" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="wlyjshrq" name="wlyjshrq" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
							<input id="btnGuolv" type="button" value="查询" onclick="guolvwly();" class="uusub2" /></span></div>

					  </td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
      <tr style="color:#1f4248; font-weight:bold; height:30px;">
        <td width="6%" align="center" bgcolor="#FFFFFF">操作</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">申请病种</td>
        <td width="20%" align="left" bgcolor="#FFFFFF">患者姓名&nbsp;&nbsp;申请号&nbsp;&nbsp;编码</br>患者身份号码</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">申请状态</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">登记日期<br/>待办日期</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">初审日期<br/>入组日期</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">预估首次赠药用药日期</td>
        <td width="20%" align="left" bgcolor="#FFFFFF">指定医院 - 指定医生<br/>指定药房</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">审核人</td>
      </tr>

<?php        

  $sql = "select * from `hzh` ";
  if($guanjiancisql!=""){
  $sql .="where ".$guanjiancisql;
  }
  $sql .= "order by id DESC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"shqxq.php?id=".$Record[0]."\">查看</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[7]."</td>";
    echo "<td align=\"left\" bgcolor=\"#FFFFFF\">".$Record[4]."&nbsp;&nbsp;";
     echo sprintf("%05d", $Record[0]);
     if($Record[45]==1){echo "网";}
     echo "&nbsp;&nbsp;";
     if($Record[2]!=""){echo "X-".$Record[2];}
     echo "<br />".$Record[5].$Record[6]."</td>";
     echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
if($Record[3]=="申诉审核"||$Record[3]=="申诉待审核"){echo "审核";}else{echo $Record[3];}
 echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    //根据要求，无日期显示空白
    if($Record[43]!=""){echo $Record[43];}else{echo " ";} echo "<br />";
    if($Record[33]!=""){echo $Record[33];}else{echo " ";} echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[32]!=""){echo $Record[32];}else{echo " ";} echo "<br />";
    if($Record[34]!=""){echo $Record[34];}else{echo " ";} echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[35]."</td><td align=\"left\" bgcolor=\"#FFFFFF\">";
    if($Record[12]!="")
    {
      $yyid=$Record[12];
    }else if($Record[11]!="")
    {
      $yyid=$Record[11];
    }else{
      $yyid=$Record[9];
    }
      $yysql = "select `sheng`,`shi`,`qu`,`yymch`,`zhdysh`,`yyzhdyf` from `yyyshdq` where id='".$yyid."'";
      //echo $yysql;
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $yyzhdyf=$yyRecord[5];
      //$yyRecord[0].$yyRecord[1].$yyRecord[2]." ".
        echo $yyRecord[3]." ".$yyRecord[4];
      }
     echo "<br />";
      /*$yfsql = "select `yfmch` from `yf` where `yfmch`='".$yyzhdyf."'";
      //echo $yfsql;
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){
        echo $yfRecord[0];
      }*/ 
     echo $yyzhdyf;
     echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
     if($Record[3]=="入组"){
     //echo "入组用户";
     $shhejlsql = "select * from `shhejl` where `hzhid`='".$Record[0]."' and id in (select max(id) from `shhejl` where `hzhid`='".$Record[0]."')";
          $shhejlQuery_ID = mysql_query($shhejlsql);
          while($shhejlRecord = mysql_fetch_array($shhejlQuery_ID)){
          echo $shhejlRecord[2];
          }
     
     }else{
     //echo "未入组";
               $clsql = "select * from `clshh` where hzhid='".$Record[0]."' and id in (select max(id) from `clshh` where hzhid='".$Record[0]."')";
          $clQuery_ID = mysql_query($clsql);
          while($clRecord = mysql_fetch_array($clQuery_ID)){
           $wrzshhr=$clRecord[7];
          }
          if($wrzshhr!=""){echo $wrzshhr;$wrzshhr="";}
          else{
          echo $Record[44];
          }
     }     
     echo "</td></tr>";
    
  } 
?>
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
				</div>
			</div>
		</div>
	</div>
</div>
</body>
    <script type="text/javascript">
        var url = "";
        function chazhao() {
            var urlguanjianci = 'shqgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val());
            location.href = urlguanjianci;
        };
        function ygchaxun() {
            var urlygrq = 'shqgl.php?ygrzrqksh='+encodeURIComponent($('#ygrzrqksh').val())+'&ygrzrqjsh='+encodeURIComponent($('#ygrzrqjsh').val());
            location.href = urlygrq;
        };
        function wshshqyym() {
            var urlwshshqyym = 'wshshqdr.php?wshshqyym='+encodeURIComponent($('#wshshqyym').val());
            location.href = urlwshshqyym;
        };
        function guolv() {
            var urlguolv = 'shqgl.php?ShengfenMingcheng=' + encodeURIComponent($('#s_province').val()) 
+ '&ChengshiMingcheng=' + encodeURIComponent($('#s_city').val()) 
+ '&YiyuanId=' + encodeURIComponent($('#YiyuanId').val())
+ '&YishengId=' + encodeURIComponent($('#YishengId').val())
+ '&ShijianLeixing=' + encodeURIComponent($('#ShijianLeixing').val())
+ '&ShenqingZhuangtai=' + encodeURIComponent($('#ShenqingZhuangtai').val())
+ '&ZhuanzhenZhuangtai=' + encodeURIComponent($('#ZhuanzhenZhuangtai').val())
+ '&juanzhuleixing=' + encodeURIComponent($('#juanzhuleixing').val())
+ '&canbaoleixing=' + encodeURIComponent($('#canbaoleixing').val())
+ '&ZuizaoJiehunRiqi=' + encodeURIComponent($('#ZuizaoJiehunRiqi').val())
+ '&ZuiwanJiehunRiqi=' + encodeURIComponent($('#ZuiwanJiehunRiqi').val());

            location.href = urlguolv;

        }
        function guolvwly() {
            var urlguolv = 'shqgl.php?wlykshrq=' + encodeURIComponent($('#wlykshrq').val()) 
+ '&wlyjshrq=' + encodeURIComponent($('#wlyjshrq').val());

            location.href = urlguolv;

        }
        function qitaguolv() {
            var guanjianci = encodeURIComponent($('#Guanjianci').val());
            url = url.format([guanjianci]);
            url = url + '&zuizaoRiqi=' + $('#ZuizaoJiehunRiqi').val()
                        + '&zuiwanRiqi=' + $('#ZuiwanJiehunRiqi').val()
                        + '&ShenqingBingzhong=' + encodeURIComponent($('#ShenqingBingzhong').val())
                        + '&ShenqingZhuangtai=' + encodeURIComponent($('#ShenqingZhuangtai').val())
                        + '&ShengfenMingcheng=' + encodeURIComponent($('#ShengfenMingcheng').val())
                        + '&ChengshiMingcheng=' + encodeURIComponent($('#ChengshiMingcheng').val())
                        + '&YiyuanId=' + $('#YiyuanId').val()
                        + '&YishengId=' + $('#YishengId').val()
                        + '&ZhuanzhenZhuangtai=' + encodeURIComponent($('#ZhuanzhenZhuangtai').val())
                        + '&ZaiciShenqingZhuangtai=' + encodeURIComponent($('#ZaiciShenqingZhuangtai').val())
                        + '&XieguanyuanId=' + $('#XieguanyuanId').val()
                        + '&IsShouci=' + $("input:radio:checked[name='IsShouci']").val()
                        + '&ShijianLeixing=' + $('#ShijianLeixing').val()
                        //+ '&KaishiShijian=' + $('#KaishiShijian').val()
                        //+ '&JieshuShijian=' + $('#JieshuShijian').val()
                        //+ '&Shenheren=' + encodeURIComponent($('#Shenheren').val())
                        + '&IsShouciriqi=' + $("input:radio:checked[name='IsShouciriqi']").val()
                        + '&searchType=2'
                        ;

            location.href = url;
        }

        function SetRuzushenheren() {
            var idStrs = "";
            $("td[id^='tdRuzuShenheren']").each(function () {
                idStrs += $(this).attr("id").replace("tdRuzuShenheren", "") + "$";
            });
            if (idStrs.length > 0) {
                idStrs = idStrs.substr(0, idStrs.length - 1);
                $.getJSON("#", { ids: idStrs }, function (data) {
                    if (data != undefined && data != null) {
                        if (data.Result == "true") {
                            var idsArr = data.Xingmings.split('$');
                            for (var i = 0; i < idsArr.length; i++) {
                                var tempArr = idsArr[i].split('&');
                                $("#tdRuzuShenheren" + tempArr[0]).html(tempArr[1]);
                            }
                            return false;
                        }
                        else {
                            $(this).html("");
                            return false;
                        }
                    }
                    else {
                        $(this).html("");
                        return false;
                    }
                });
            }
        }
        function InitXieguanyuan() {
            var $xieguanyan = $("#XieguanyuanId");
            if ($xieguanyan.val() != "" && $xieguanyan.val() != 0) {
                $("#spanIsShouci").show();
            }
            else {
                $("#spanIsShouci").hide();
            }
        }
        function InitShenheriqi() {
            var $xieguanyan = $("#ShijianLeixing");
            if ($xieguanyan.val() == "shrq") {
                $("#spanIsShouciriqi").show();
            }
            else {
                $("#spanIsShouciriqi").hide();
            }
        }

        $(function () {
            chooseDateNow('ZuizaoJiehunRiqi', 'ZuiwanJiehunRiqi', true, true);
            chooseDateNow('KaishiShijian', 'JieshuShijian', true, true);
            chooseDateRange('ygrzrqksh', 'ygrzrqjsh', true, true);
            chooseDateRange('wlykshrq', 'wlyjshrq', true, true);

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
//省市医院医生 联动 结束

        });
    </script>
</html>