<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid = $_GET["id"];
$html_title="修改患者基本信息";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
<form action="xgjbxxac.php" method="post">
<input id="hzhid" name="hzhid" type="hidden" value="<?php echo $hzhid;?>" />
        <div class="incontact w955 flt">
<?php        
    $hzhsql = "select * from `hzh` where `id` = '".$hzhid."'";

    $hzhQuery_ID = mysql_query($hzhsql);
    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
?>
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
        <fieldset class="incontact flt">
            <legend>申请信息</legend>
<div class="insinsins" style="width:100%;">
  <label>姓名：</label><span>
  <input class="grd-white" id="Xingming" name="Xingming" type="text" value="<?php echo $hzhRecord[4];?>" /><font color="red">*</font></span>
  <label>证件类型：</label><span>
    <select class="grd-white2" id="zhjlx" name="zhjlx">
<option <?php if($hzhRecord[5]=="身份证"){echo "selected=\"selected\"";}?> value="身份证">身份证</option>
<option <?php if($hzhRecord[5]=="军官证"){echo "selected=\"selected\"";}?> value="军官证">军官证</option>
</select> <input class="grd-white" id="ShenfenHaoma" name="ShenfenHaoma" type="text" value="<?php echo $hzhRecord[6];?>" /><font color="red">*</font>
    <span style="color:red;" id="zhjhmtx" name="zhjhmtx"></span>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>申请病种：</label><span>
  <select class="grd-white2" id="shqlx" name="shqlx">
    <option selected="selected" value="<?php echo $hzhRecord[7];?>"><?php echo $hzhRecord[7];?></option>
  </select><font color="red">*</font>
  </span>
  <label>出生日期：</label><span>
    <input class="grd-white" id="hzhchshrq"  onClick="javascript:ShowCalendar(this.id)" name="hzhchshrq"  readonly type="text" value="<?php echo $hzhRecord[38];?>" /><font color="red">*</font>
  </span>
  <label>性别：</label><span>
  <select id="hzhxingbie" name="hzhxingbie"class="grd-white2"><option value="">--请选择--</option>
<option <?php if($hzhRecord[37]=="男"){echo "selected=\"selected\"";}?> value="男">男</option>
<option <?php if($hzhRecord[37]=="女"){echo "selected=\"selected\"";}?> value="女">女</option>
  </select><font color="red">*</font>
  </span>
</div>


<!--div class="insinsins" style="width:100%;">
<label>选择医生省：</label>
<span><select class="grd-white2" id="shengid" name="shengid">
    <option value="">-请选择-</option>
    <?php
    $sql_sheng = "select * from `yyyshdq`";
    $query_sheng = mysql_query($sql_sheng);
    while($Record_sheng = mysql_fetch_array($query_sheng)){
      $sheng[] = $Record_sheng[1];
    }
    //for($i=0;$i<count($sheng_two);$i++){array_flip(array_flip($arr1)); 
      $sheng2 = array_flip(array_flip($sheng)); //array_unique($sheng);
    //}
    for($i=0;$i<count($sheng);$i++){
      if($sheng2[$i]!=''){
        echo "<option value=\"".$sheng2[$i]."\"> ".$sheng2[$i]."</option>";
      }
    }
    ?>
    </select>
    </span>
    <label>市：</label>
    <span><select class="grd-white2" id="shiid" name="shiid">
    <option value="" select="selected">-请选择-</option>
    </select>
  </span>
  <label>申请的医院/医生：</label>
    <span><select class="grd-white2" id="yshid" name="shqyyid">
    <option value="">-请选择-</option>
    </select>
  </span>
</div-->



<div class="insinsins" style="width:100%;">
  <label>申请的医院/医生：</label><span>
  <select id="ShenqingYishengId" name="ShenqingYishengId" style="width: 500px;" class="grd-white2" onchange="qzyzh()">
  
<?php      
    $yyqzyzh=array();
    $yshshq=array(); 
         
    $yysql = "select id,shengjx,sheng,yymch,zhdysh,zhdyshyzh,shqysh1,shqysh2,shqysh3 from `yyyshdq` where `id`='".$hzhRecord[9]."'";
    $yyQuery_ID = mysql_query($yysql);
    
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
    
      $yyqzyzh[$yyRecord[0]]=$yyRecord[5];
      $shqyshshl=0;
      if($yyRecord[6]!=''){$shqyshshl++;}
      if($yyRecord[7]!=''){$shqyshshl++;}
      if($yyRecord[8]!=''){$shqyshshl++;} 
      $yshshq[$yyRecord[0]]=$shqyshshl;
      echo "<option value=\"".$yyRecord[0]."\"> ".$yyRecord[1]." ".$yyRecord[2]." ".$yyRecord[3]." ".$yyRecord[4]."</option>";
    }
           
    $yy2sql = "select id,shengjx,sheng,yymch,zhdysh,zhdyshyzh,shqysh1,shqysh2,shqysh3 from `yyyshdq` where `yhszht`='1' order by shengjx ASC";

    $yy2Query_ID = mysql_query($yy2sql);

    while($yy2Record = mysql_fetch_array($yy2Query_ID)){
    if($yy2Record[0]==$hzhRecord[9]){}
      else{
      $yyqzyzh[$yy2Record[0]]=$yy2Record[5];
      $shqyshshl=0;
      if($yy2Record[6]!=''){$shqyshshl++;}
      if($yy2Record[7]!=''){$shqyshshl++;}
      if($yy2Record[8]!=''){$shqyshshl++;} 
      $yshshq[$yy2Record[0]]=$shqyshshl;      
        echo "<option value=\"".$yy2Record[0]."\"> ".$yy2Record[1]." ".$yy2Record[2]." ".$yy2Record[3]." ".$yy2Record[4]."</option>";
      }
    }
?>    
  </select>* 
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>患者通讯住址：</label><span><input class="grd-white" id="Zhuzhi" name="Zhuzhi" style="width:500px" type="text" value="<?php echo $hzhRecord[14];?>" />*
  </span>
</div>
<!--div class="insinsins" style="width:100%;">
  <label>街道地址：</label><span>
    <input class="grd-white" id="jddzh" name="jddzh" style="width:500px" type="text" value="" />*
  </span>
</div-->
<script>  
function yzshj(v){  
var a = /^((\(\d{3}\))|(\d{3}\-))?13\d{9}|15\d{9}|18\d{9}|14\d{9}$/ ;  
if( v.length!=11||!v.match(a) ){  
  alert("手机号错误!");
  return false;
}else{return true;}  
}  
</script>
<div class="insinsins" style="width:100%;">
  <label>手机：</label><span>
    <input class="grd-white" id="shouji" name="shouji" type="text" value="<?php echo $hzhRecord[15];?>"  onblur="yzshj(this.value)"/>*
  </span>
  <label>联系电话1：</label><span>
  <input class="grd-white" id="dianhua2" name="dianhua2" type="text" value="<?php echo $hzhRecord[16];?>" />
  </span>
  <label>联系电话2：</label><span>
  <input class="grd-white" id="dianhua3" name="dianhua3" type="text" value="<?php echo $hzhRecord[17];?>" />
  </span>
  <label>联系电话3：</label><span>
  <input class="grd-white" id="dianhua3" name="dianhua3" type="text" value="<?php echo $hzhRecord[51];?>" />
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>户籍类型：</label><span>
    <select name="hzhhj" id="hzhhj" style="width: 160px;" class="grd-white2">
						  <option <?php if($hzhRecord[19]=='非农业户口'){echo "selected=\"selected\"";}?> value="非农业户口">非农业户口</option>
						  <option <?php if($hzhRecord[19]=='农业户口'){echo "selected=\"selected\"";}?>  value="农业户口">农业户口</option>
    </select>*
  </span>
  <label>患者年收入：</label><span>
    <input class="grd-white" style="width: 60px; " id="hzhnshr" name="hzhnshr"  type="text" value="<?php
    $hzhnshrsql = "select * from `zhxqsh` where hzhid='$hzhid' and gxzf='1' and zhjhm='$hzhRecord[6]'";
$hzhnshrQuery_ID = mysql_query($hzhnshrsql);
while($hzhnshrRecord = mysql_fetch_array($hzhnshrQuery_ID)){
echo $hzhnshrRecord[9];
}
    ?>" onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" />元*
  </span>
  <label>家庭人口：</label><span>
    <select id="JiatingRenkou" name="JiatingRenkou" class="grd-white2" readonly >
<?php
for($i=1;$i<20;$i++)
{
echo "<option ";
if($hzhRecord[20]==$i)
{echo "selected=\"selected\"";}
echo"value=\"$i\">$i</option>";
}
?>*
  </span>
  <label>家庭年收入：</label><span>
    <input class="grd-white" id="NianShouru" name="NianShouru" style="width:100px" type="text" value="<?php if($hzhRecord[21]!=''){echo $hzhRecord[21];}else {echo "0";}?>" />元*
  </span><span style="width: 180px; color: Green;" id="hzhjtpjnshr"></span>
</div>
<div class="insinsins" style="width:100%;">
  <label>参保类型：</label><span>
    <select name="CanBaoLeiXing" id="CanBaoLeiXing" style="width:100px" onchange="cblxxz()" class="grd-white2">
						  <option <?php if($hzhRecord[23]=='无'){echo "selected=\"selected\"";}?> value="无">无</option>
						  <option <?php if($hzhRecord[23]=='城镇职工（含离退休人员）医疗保险'){echo "selected=\"selected\"";}?>  value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
						  <option <?php if($hzhRecord[23]=='城镇居民医疗保险'){echo "selected=\"selected\"";}?>  value="城镇居民医疗保险">城镇居民医疗保险</option>
						  <option <?php if($hzhRecord[23]=='新农合医疗保险'){echo "selected=\"selected\"";}?>  value="新农合医疗保险">新农合医疗保险</option>
						  <option <?php if($hzhRecord[23]=='公费医疗'){echo "selected=\"selected\"";}?>  value="公费医疗">公费医疗</option>
						  <option <?php if($hzhRecord[23]=='现役军人医疗体系'){echo "selected=\"selected\"";}?>  value="现役军人医疗体系">现役军人医疗体系</option>
    </select>*
  </span>
  <div id="cbdqxz" Style="display:none;">
    <label>参保地区：</label><span>
      <select class="grd-white2" id="cbdqs_province" name="cbdqsheng"></select>&nbsp;&nbsp;
      <select class="grd-white2" id="cbdqs_city" name="cbdqshi" ></select>*
      <script src="js/areaa.js" type="text/javascript"></script>
      <script type="text/javascript">_init_areaa();</script>
<?php 
$cbdqsheng=$hzhRecord[24];
$cbdqshi=$hzhRecord[39];
?>
    </span>
  </div>
</div>
<div style="width:100%;">
  <label>捐助类型：</label><span>
  
    <input id="jzhlx" name="jzhlx" type="radio" <?php if($hzhRecord[25]=="全部"){echo "checked=\"true\"";}?> value="全部"></input><label for="jzhlx">全部</label> 
    <?php if($hzhRecord[7]=='RCC'){?>
    <input id="jzhlx" name="jzhlx" <?php if($hzhRecord[25]=="原部分"){echo "checked=\"true\"";}?> type="radio" value="原部分"></input><label for="jzhlx">原部分</label> 
    <input id="jzhlx" name="jzhlx" <?php if($hzhRecord[25]=="1+1+1"){echo "checked=\"true\"";}?> type="radio" value="1+1+1"></input><label for="jzhlx">1+1+1</label> 
    <?php 
    }else{
    ?>
    <input id="jzhlx" name="jzhlx" <?php if($hzhRecord[25]=="部分"){echo "checked=\"true\"";}?> type="radio" value="部分"></input><label for="jzhlx">部分</label> 
    <?php
    }
    ?>*
  </span>
  <?php /*
  <label>捐赠数量：</label><span>
    <input class="grd-white" id="jzhshl" name="jzhshl" style="width:18px" type="text" value="" readonly/>瓶*
  </span>*/
  ?>
</div>
<div class="top" style="width:100%;">
  <label>用法：</label><span>
    <select class="grd-white2" id="yfjl" name="yfjl">
      <option value="12.5mg" <?php if($hzhRecord[28]=="12.5mg"){echo "selected=\"selected\"";}?> >12.5mg</option>
      <option value="25mg" <?php if($hzhRecord[28]=="25mg"){echo "selected=\"selected\"";}?> >25mg</option>
      <option value="37.5mg" <?php if($hzhRecord[28]=="37.5mg"){echo "selected=\"selected\"";}?> >37.5mg</option>
      <option value="50mg" <?php if($hzhRecord[28]=="50mg"){echo "selected=\"selected\"";}?> >50mg</option>
      <option value="62.5mg" <?php if($hzhRecord[28]=="62.5mg"){echo "selected=\"selected\"";}?> >62.5mg</option>
      <option value="75mg" <?php if($hzhRecord[28]=="75mg"){echo "selected=\"selected\"";}?> >75mg</option>
      <option value="87.5mg" <?php if($hzhRecord[28]=="87.5mg"){echo "selected=\"selected\"";}?> >87.5mg</option>
      <option value="100mg" <?php if($hzhRecord[28]=="100mg"){echo "selected=\"selected\"";}?> >100mg</option>
    </select>*
    <?php if($hzhRecord[29]!=""){$yfcshzhq=explode(",",$hzhRecord[29]);}?>
    <select class="grd-white2" id="yfcsh" name="yfcsh">
      <option value="Qid" <?php if($yfcshzhq[0]=="Qid"){echo "selected=\"selected\"";}?> >Qid</option>
      <option value="Bid" <?php if($yfcshzhq[0]=="Bid"){echo "selected=\"selected\"";}?> >Bid</option>
      <option value="Tid" <?php if($yfcshzhq[0]=="Tid"){echo "selected=\"selected\"";}?> >Tid</option>
    </select>*
    <select class="grd-white2" id="yfzhq" name="yfzhq">
      <option value="2/4" <?php if($yfcshzhq[1]=="2/4"){echo "selected=\"selected\"";}?> >2/4</option>
      <option value="连续服用" <?php if($yfcshzhq[1]=="连续服用"){echo "selected=\"selected\"";}?> >连续服用</option>
    </select>*
  </span>
</div>
<div class="top" style="width:100%;">
  <label>首次申请材料登记日期：</label><span>
    <input class="grd-white" id="djrq" name="djrq" type="text" value="<?php echo $hzhRecord[43];?>"  readonly />*
  </span>
</div>
        </fieldset>
              </td>
            </tr>
          </table> 
        </div>
				<div class="title w977 flt top">
				<strong>直系亲属</strong><span></span>
				</div>
        <div class="incontact w955 flt">
<input id="ZhixiQinshusJson" name="ZhixiQinshusJson" type="hidden" value="[<?php
$qshsql = "select * from `zhxqsh` where hzhid='$hzhid' and gxzf='1'";
$qshQuery_ID = mysql_query($qshsql);
$num=mysql_num_rows($qshQuery_ID);
$i=1;
while($qshRecord = mysql_fetch_array($qshQuery_ID)){

?>{
    &quot;姓名&quot;: &quot;<?php echo $qshRecord[2];?>&quot;,
    &quot;公民身份号码&quot;: &quot;<?php echo $qshRecord[3];?>&quot;,
    &quot;军官证&quot;: &quot;<?php echo $qshRecord[7];?>&quot;,
    &quot;与患者关系&quot;: &quot;<?php echo $qshRecord[4];?>&quot;,
    &quot;联系方式&quot;: &quot;<?php echo $qshRecord[6];?>&quot;,
    &quot;年收入&quot;: &quot;<?php echo $qshRecord[9];?>&quot;
  }<?php if($i!=$num){echo ",";}
  $i++;
}
?>]" />
<table id="tb_ZhixiQinshus" class="table" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
<tr style="color:#1f4248; font-weight:bold; height:30px;">
  <td width="9%" align="center" bgcolor="#FFFFFF">姓名</td>
  <td width="12%" align="center" bgcolor="#FFFFFF">身份号码</td>
  <td width="12%" align="center" bgcolor="#FFFFFF">军官证</td>
  <td width="9%" align="center" bgcolor="#FFFFFF">与患者关系</td>
  <td width="9%" align="center" bgcolor="#FFFFFF">联系方式</td>
  <td width="9%" align="center" bgcolor="#FFFFFF">年收入</td>
  <td width="9%" align="center" bgcolor="#FFFFFF">操作</td>
</tr>
<tr id="tr_action" style="color:#1f4248; font-size:12px;">
  <td align="center" bgcolor="#FFFFFF">
    <input style="width:120px;" type="text" id="txtXingming" name="txtXingming" class="grd-white" />
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <input type="text" id="txtShenfenzheng" name="txtShenfenzheng" class="grd-white" />
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <input type="text" id="txtjgzh" name="txtjgzh" class="grd-white" />
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <select Style="width:130px" id="txtGuanxi" name="txtGuanxi" class="grd-white2" >
      <option selected="selected" value="父亲">父亲</option>
      <option value="母亲">母亲</option>
      <option value="配偶">配偶</option>
      <option value="儿子">儿子</option>
      <option value="女儿">女儿</option>
      <option value="其他关系">其他关系</option>
    </select>
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <input type="text" id="txtLianXiFangShi" name="txtLianXiFangShi" class="grd-white" />
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <input  style="width:80px;" type="text" id="txtnshr" name="txtnshr" class="grd-white" />
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <input type="button" id="btnAdd" value="添加" class="uusub2" />
  </td>
</tr>
</table>
        </div>

  <div class="incontact w955 flt">
      <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
  </div>
  
        </form>
<?php
}
?>
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
      <td width="70%" bgcolor="#FFFFFF" align="center"><img id="zhdyshyzh" width="100"/><img id="zhdyshqzh" width="100"/></td>
    </tr>

    <tr id="qzyzhshq" style="display:none;">
      <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生<br/><span id='shqyshxsh'></span></td>
      <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
    </tr>
  </table>
</div>

      </div>
		</div>
	</div>
</div>
    <script type="text/javascript">
    chooseDate('djrq', true); //首次登记日期
    chooseDateOld('ygShouciYongyaoRiqi1', true); 
    chooseDateOld('ygShouciYongyaoRiqi2', true); 
function cblxxz(){

  if($("#CanBaoLeiXing").val()!='无'&&$("#CanBaoLeiXing").val()!='现役军人医疗体系'){
  document.getElementById('cbdqxz').style.display='block';
  }else{
  document.getElementById('cbdqxz').style.display='none';
  }
}
        function JisuanRenjun() {
            var $roukou = $("#JiatingRenkou");
            var $nianshouru = $("#NianShouru");
            if (isNaN($nianshouru.val()))
                $nianshouru.val("0");
            var renjun = Number($nianshouru.val()) / Number($roukou.val());
            $("#span_pinjunshouru").text("人均收入：" + (String(renjun).indexOf(".") > -1 ? String(renjun).substr(0, String(renjun).indexOf(".")) : renjun) + "元/人");
        }
        function YichangTishi(yichang) {
            $("#span_Yichang").text(yichang);
        }
        function QingkongYichangTishi() {
            $("#span_Yichang").text("");
        }

        function Xianzhishuru() {
            var tianshuValue = $("#MeiciTianshu").val();
            var ShoujiliangValue = $("#Shoujiliang").val();
            var WeichiJiliangValue = $("#WeichiJiliang").val();
            if (tianshuValue == "" && ShoujiliangValue == "" && ShoujiliangValue == "") {
                return true;
            }

    
            QingkongYichangTishi();

            //计算捐助支数
            JisuanZhishu();

            return true;
        }

        function panduanbitian(v) {        /*alert("姓名不能为空。");*/
var Xingming = $("#Xingming").val();
var hzhchshrq = $("#hzhchshrq").val();
var hzhxingbie = $("#hzhxingbie").val();
var ShenqingYishengId = $("#ShenqingYishengId").val();
var s_province = $("#s_province").val();
var s_city = $("#s_city").val();
var s_county = $("#s_county").val();
var Zhuzhi = $("#Zhuzhi").val();
var shouji = $("#shouji").val();
var hzhhj = $("#hzhhj").val();
var NianShouru = $("#NianShouru").val();   //!=0
var CanBaoLeiXing = $("#CanBaoLeiXing").val();
var cbdqs_province = $("#cbdqs_province").val();
var cbdqs_city = $("#cbdqs_city").val();
var cbdqs_county = $("#cbdqs_county").val();
var jzhlx = $("#jzhlx").val();
var JuanZengShuLiang = $("#JuanZengShuLiang").val();
var XiangmuShenqingXinxiBiaoRiqi = $("#XiangmuShenqingXinxiBiaoRiqi").val();

            if(Xingming == "" ){alert("姓名不能为空。");return false;}
            if(hzhchshrq == ""){alert("出生日期不能为空。");return false;}
            if(hzhxingbie == ""){alert("请选择性别。");return false;}
            //最新要求性别以下内容不填写可用录入
            /*if(ShenqingYishengId == ""){alert("请选择医院/医生。");return false;}
            if(s_province == ""){alert("请选择省");return false;}
            if(s_city == ""){alert("请选择市");return false;}
            if(s_county == ""){alert("请选择区");return false;}
            if(Zhuzhi == ""){alert("请填写通讯地址");return false;}
            if(shouji == ""){alert("请填写手机");return false;}
            if(hzhhj == ""){alert("请选择户籍");return false;}
            if(NianShouru == "0"){alert("年收入不能为空");return false;}
            if(CanBaoLeiXing == ""){alert("请选择参保类型");return false;}
            if(cbdqs_province == ""){alert("请选择参保省");return false;}
            if(cbdqs_city == ""){alert("请选择参保市");return false;}
            if(cbdqs_county == ""){alert("请选择参保区");return false;}
            if(jzhlx == ""){alert("请选择捐赠类型");return false;}
            if(JuanZengShuLiang == ""){alert("捐赠数量不能为空");return false;}
            if(XiangmuShenqingXinxiBiaoRiqi == ""){alert("项目申请日期不能为空");return false;}*/
                return true;
            }
        function SubmitCheck() {

            if ($("#zhjlx").val() == "身份证" && !IsIdCard($("#ShenfenHaoma").val())) { 
                return false;  
            }
            
            //最新要求性别以下内容不填写可用录入
            /*if(!yzshj($("#shouji").val())){return false; }*/
            if(!panduanbitian('1')){return false; }

            //CheckDate($("#hzhchshrq").val());
            if ($("#ZhixiQinshusJson").val() == "[]"&&$("#JiatingRenkou").val()!='1'){
                if (!confirm("没有录入患者直系亲属信息。是否继续保存？")) {
                    return false;
                }
            }
            var zhxiqshjson = eval($("#ZhixiQinshusJson").val()).length;
            if (zhxiqshjson != $("#JiatingRenkou").val()-1){
                if (!confirm("录入患者直系亲属信息与家庭人口数量不符。是否继续保存？")) {
                    return false;
                }
            }
            return true;        }

        function JisuanZhishu() {
            var bingzhongValue = $("#ShenqingBingzhong").val();
            var tianshuValue = $("#MeiciTianshu").val();
            var ShoujiliangValue = $("#Shoujiliang").val();
            var WeichiJiliangValue = $("#WeichiJiliang").val();
            var juanzhuLeixingMingcheng = $("input:checked[name='JuanzhuLeixingMingcheng']").val();
            $.getJSON("#", { "Shouji": ShoujiliangValue, "WeichiJiliang": WeichiJiliangValue, "MeiciTianshu": tianshuValue, "JuanzhuLeixing": juanzhuLeixingMingcheng, "ShenqingBingzhong": bingzhongValue }, function (json) {
                if (json != undefined && json != null) {
                    if (json.Result == "true") {
                        $("#span_JuanzhuShuliang").text("捐助数量：" + json.JuanzhuShuliang + "支");
                    }
                    else {
                        alert(json.Msg);
                    }
                }
            });

        }
        function BingzhongKongzhi() {
            var thisValue = $("#ShenqingBingzhong").val();
            /*if (thisValue == '') {
                $("#span_Zhengduan").show();
                $("#span_MeiciTianshu").show();
                JisuanZhishu();
            }
            else if (thisValue == '乳腺癌') {
                $("#span_Zhengduan").show();
                $("#span_MeiciTianshu").show();
                JisuanZhishu();
            }
            else if (thisValue == '胃癌') {
                $("#span_Zhengduan").hide();
                $("#span_MeiciTianshu").hide();
                $("#span_Zhengduan input:radio").each(function () {
                    $(this).attr("checked", false);
                });
                $("#span_Zhengduan input:radio[value='晚期']").attr("checked", true);
                $("#MeiciTianshu").val("21");
                JisuanZhishu();
            }*/
        }

//初始化直系亲属数据
function AddRow(index, xingming, shenfenzheng ,jgzh, guanxi,lianxidianhua,nshr, isCheck) {
  if (isCheck && xingming == "") {
    alert("亲属姓名不能为空。");
    return false;
  }
  if (isCheck && xingming != "" && $("#ZhixiQinshusJson").val().indexOf('"' + xingming + '"') >= 0) {
    alert("已存在该姓名的亲属。");
    return false;
  }
  if (isCheck && guanxi != "" && $("#ZhixiQinshusJson").val().indexOf('"' + guanxi + '"') >= 0) {
    if(!confirm("已存在" + guanxi + "关系的亲属。确认继续添加吗？")){
      return false;
    }
  }
  if (isCheck && shenfenzheng != "" && !IsIdCard(shenfenzheng)) {
    return false;
  }

  if (isCheck && jgzh != "" && $("#ZhixiQinshusJson").val().indexOf('"' + jgzh + '"') >= 0) {
    alert("已存在该军官证的亲属。");
    return false;
  }
  if (isCheck && shenfenzheng == ""  && jgzh == "" ) {
    alert("亲属证件不能为空。");
    return false;
  }
  if (isCheck && shenfenzheng != "" && $("#ZhixiQinshusJson").val().indexOf('"' + shenfenzheng + '"') >= 0) {
    alert("已存在该身份证的亲属。");
    return false;
  }
  if (isCheck && nshr < 1) {
    alert("年收入必须大于0。");
    return false;
  }
  if(guanxi!='本人'){
    var zhxqshshchann='<td align=\'center\' bgcolor=\'#FFFFFF\'><a href=\'javascript:deltr(' + index + ')\'>删除</a></td>';
  }else{
    var zhxqshshchann='<td align=\'center\' bgcolor=\'#FFFFFF\'>删除</td>';
  }
  $("#tr_action").before(
  "<tr id=" + index + ">" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'><input type='text' class='grd-white' style='width:120px;' value=" + xingming + "></td>" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + shenfenzheng + "</td>" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + jgzh + "</td>" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + guanxi + "</td>" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + lianxidianhua + "</td>" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + nshr + "</td>" + zhxqshshchann +  
  "</tr>");
  return true;
}
function InitZhixiQinshus() {
  var $tr = $("#tb_ZhixiQinshus tr");
  var len = $tr.length;
  var json = eval($("#ZhixiQinshusJson").val());
  for (var i = 0; i < json.length; i++) {
    AddRow(len + i, json[i]["姓名"], json[i]["公民身份号码"], json[i]["军官证"], json[i]["与患者关系"], json[i]["联系方式"], json[i]["年收入"], false);
  }
  return true;
}
//删除行
function deltr(index) {
  if (confirm("确定要删除吗？")) {
      var json = eval("(" + $("#ZhixiQinshusJson").val() + ")");
      var $tr = $("#tb_ZhixiQinshus tr");
      var len = $tr.length;
      for (var i = 0; i < (json.length+len); i++) {
          $("tr[id=\'" + i + "\']").remove();
      }
      json.splice(index - 2, 1);                
      $("#ZhixiQinshusJson").val(JSON.stringify(json));
      InitZhixiQinshus();
      var $rknshrjson = eval($("#ZhixiQinshusJson").val());
      $("#hzhjtrk").val($rknshrjson.length);
      var hzhjtnshr=0;
      for (var i = 0; i < $rknshrjson.length; i++) {
         hzhjtnshr=parseInt(hzhjtnshr)+parseInt($rknshrjson[i]["年收入"]);
      }
      $("#hzhjtnshr").val(hzhjtnshr);    
  }
}

        //页面加载后
        $(function () {  
          //post()方式  
          $('input[name="jzhlx"]').click(function (){ 
              var $shdi=$(this).val();
              //document.getElementById('shcyyrqqb').style.display='block';
              if($shdi=="部分"){
                $.post(  
                    'shqglxzshqjzhshlac.php',  
                    {
                        cbdqshi:$('#cbdqs_city').val(),
                        cblx:$('#CanBaoLeiXing').val(),
                        //hzhhj:$("input[name='hzhhj']:checked").val()
                        hzhhj:$('#hzhhj').val()
                    },  
                    function (data) { //回调click函数  
                        $('#JuanZengShuLiang').val(data);
                    }  
                ); 
                /*document.getElementById('ygShouciYongyaoRiqi2').disabled = true;
                document.getElementById('ygShouciYongyaoRiqi1').disabled = false;
                  document.getElementById('shcyyrqqb').style.display='block';
                  document.getElementById('ygshcyyrqqb').style.display='none';*/
              }else {
                  /*document.getElementById('shcyyrqqb').style.display='none';
                  document.getElementById('ygshcyyrqqb').style.display='block';
                document.getElementById('ygShouciYongyaoRiqi2').disabled = false;
                document.getElementById('ygShouciYongyaoRiqi1').disabled = true;*/
                  $('#JuanZengShuLiang').val("12");
              }
          });
        
          $("#ShenfenHaoma").blur(function(){
//参保地区显示问题
  if($("#CanBaoLeiXing").val()!='无'&&$("#CanBaoLeiXing").val()!='现役军人医疗体系'){
  document.getElementById('cbdqxz').style.display='block';
  }else{
  document.getElementById('cbdqxz').style.display='none';
  }
          if($("#zhjlx").val()=="身份证"){
    if(IsIdCard($("#ShenfenHaoma").val())){
    var shfzhhm=$("#ShenfenHaoma").val();
    $('#hzhchshrq').val(shfzhhm.substring(6,10)+"-"+shfzhhm.substring(10,12)+"-"+shfzhhm.substring(12,14));
if (parseInt(shfzhhm.substr(16, 1)) % 2 == 1) { 
$("#hzhxingbie").empty();
$("<option value=\"男\">男</option>").appendTo("#hzhxingbie");
} else { 
$("#hzhxingbie").empty();
$("<option value=\"女\">女</option>").appendTo("#hzhxingbie");
} 
    }
  $.post(  
    'shqglxzshqzhjhmtxac.php',  
    {
      zjhm:$('#ShenfenHaoma').val()
    },  
    function (data) { //回调click函数  
      $('#shfzhcztx').html(data);
    }  
  );
    }
          if($("#zhjlx").val()=="军官证"){
 
$("#hzhxingbie").empty();
$("<option value=\"男\">男</option><option value=\"女\">女</option>").appendTo("#hzhxingbie");
chooseDateNownian('hzhchshrq', true); 
  $.post(  
    'shqglxzshqzhjhmtxac.php',  
    {
      zjhm:$('#ShenfenHaoma').val()
    },  
    function (data) { //回调click函数  
      $('#shfzhcztx').html(data);
    }  
  );
    }
          });
          

  $("#hzhnshr").blur(function(){
    //患者收入验证
    if($("#hzhnshr").val()<1){
      alert('患者收入不能小于0');
    }else{
      if($("#hzhxm").val()==''){
        alert('患者姓名不能为空');
      }else{
        if($("#shj").val()==''){
          alert('手机号码不能为空');
        }else{
          if($("#zhjhm").val()==''){
            alert('证件号码不能为空');
          }else{
    var hzhShenfenzheng = '';
    var hzhjgzh = '';
            if($("#zhjlx").val()=='身份证'){
              hzhShenfenzheng = $("#zhjhm").val();
            }else{
              hzhjgzh = $("#zhjhm").val();
            }
    var $hzhtable = $("#tb_ZhixiQinshus tr");
    var hzhlen = $hzhtable.length;
    var hzhXingming = $("#hzhxm").val();
    var hzhGuanxi = '本人';
    var hzhLianXiFangShi = $("#shj").val();
    var hzhnshr = $("#hzhnshr").val();
    if (!AddRow(hzhlen, hzhXingming, hzhShenfenzheng, hzhjgzh, hzhGuanxi, hzhLianXiFangShi,hzhnshr, true)) {
      //alert('失败');
      return false;
    }
    if(hzhXingming!=''){
      var hzhjson = eval($("#ZhixiQinshusJson").val());
      var hzhassignment = { "姓名": hzhXingming, "公民身份号码": hzhShenfenzheng, "军官证": hzhjgzh, "与患者关系": hzhGuanxi, "联系方式": hzhLianXiFangShi, "年收入": hzhnshr };
      hzhjson.push(hzhassignment);
      var hzhstr = JSON.stringify(hzhjson);
      $("#ZhixiQinshusJson").val(hzhstr);
      var $rknshrjson = eval($("#ZhixiQinshusJson").val());
      $("#hzhjtrk").val($rknshrjson.length);
      var hzhjtnshr=0;
      for (var i = 0; i < $rknshrjson.length; i++) {
         hzhjtnshr=parseInt(hzhjtnshr)+parseInt($rknshrjson[i]["年收入"]);
      }
      $("#hzhjtnshr").val(hzhjtnshr);
    }
          }
        }
      }
    }
  });
          
          $("#s_province option[value='省份']").text("<?php echo $cbdqsheng;?>");
          $("#s_province option[value='省份']").val("<?php echo $cbdqsheng;?>");
          $("#s_city option[value='地级市']").text("<?php echo $cbdqshi;?>");        
          $("#s_city option[value='地级市']").val("<?php echo $cbdqshi;?>");        
         /* $("#s_county option[value='市、县级市']").text("<?php echo $cbdqqu;?>");
          $("#s_county option[value='市、县级市']").val("<?php echo $cbdqqu;?>");*/

          
          
            chooseDateNow('ShouciYongyaoRiqi', true);
            chooseDateNow('XiangmuShenqingXinxiBiaoRiqi', true);
            $("#JiatingRenkou").bind("change", JisuanRenjun);
            $("#NianShouru").bind("keyup", JisuanRenjun);
            JisuanRenjun();
            //绑定提交验证
            $("input:submit").unbind("click");
            $("#submitBtn").bind("click", function () {
            //if("#shouji")
            
            

                if (SubmitCheck() && confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("form").submit();
                    return false;
                }
                return false;
            });
            $("input:submit").attr("disabled", false);

            $("#Shoujiliang,#WeichiJiliang,#MeiciTianshu").bind("change", Xianzhishuru);
            $("input[name='JuanzhuLeixingMingcheng']").bind("click", JisuanZhishu);
            Xianzhishuru();
            //病种选择控制
            BingzhongKongzhi();
            $("#ShenqingBingzhong").bind("change", BingzhongKongzhi);
            if ($("#ShenqingBingzhong").val() != "")
                $("#ShenqingBingzhong").attr("disabled", "disabled");
              //直系亲属相关
  InitZhixiQinshus();
  $("#btnAdd").click(function () {
    var $table = $("#tb_ZhixiQinshus tr");
    var len = $table.length;
    var txtXingming = $("#txtXingming").val();
    var txtShenfenzheng = $("#txtShenfenzheng").val();
    var txtjgzh = $("#txtjgzh").val();
    var txtGuanxi = $("#txtGuanxi").val();
    var txtLianXiFangShi = $("#txtLianXiFangShi").val();
    var txtnshr = $("#txtnshr").val();
    if (!AddRow(len, txtXingming, txtShenfenzheng, txtjgzh, txtGuanxi, txtLianXiFangShi,txtnshr, true)) {
      return false;
    }
    //清空输入框
    $("#txtXingming").val('');
    $("#txtShenfenzheng").val('');
    $("#txtjgzh").val('');
    $("#txtGuanxi").val('');
    $("#txtLianXiFangShi").val('');
    $("#txtnshr").val('');

    var json = eval($("#ZhixiQinshusJson").val());
    var assignment = { "姓名": txtXingming, "公民身份号码": txtShenfenzheng, "军官证": txtjgzh, "与患者关系": txtGuanxi, "联系方式": txtLianXiFangShi, "年收入": txtnshr };
    json.push(assignment);
    var str = JSON.stringify(json);
    $("#ZhixiQinshusJson").val(str);
      var $rknshrjson = eval($("#ZhixiQinshusJson").val());
      $("#hzhjtrk").val($rknshrjson.length);
      var hzhjtnshr=0;
      for (var i = 0; i < $rknshrjson.length; i++) {
         hzhjtnshr=parseInt(hzhjtnshr)+parseInt($rknshrjson[i]["年收入"]);
      }
      $("#hzhjtnshr").val(hzhjtnshr);
  });
        });
var yyqzyzh=eval(<?php echo json_encode($yyqzyzh);?>);
var yshshq=eval(<?php echo json_encode($yshshq);?>);
//alert(yyqzyzh[25]);

function padLeft(str, lenght) {
  //医生编号的遍历
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
 
  //医生签字样张
  if(v==0){
    document.getElementById('qzyzh').style.display='none';
  }
  else{
    v=yyqzyzh[$('#ShenqingYishengId').val()];
    i=yshshq[$('#ShenqingYishengId').val()];
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
