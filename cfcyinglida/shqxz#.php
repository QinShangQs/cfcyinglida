<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
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
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a>
        > 新增申请</div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>新增申请</strong><span><a href="saahqxz.php">新增申请</a></span>
				</div>
    <div class="form">
        <form action="shqglxzshqac.php" method="post">
        <fieldset>
            <legend>申请信息</legend>
            <div>
                <span class="label">姓名：</span><input class="grd-white" id="Xingming" name="Xingming" type="text" value="" /><font color="red">*</font>
                <span class="label">证件类型：</span><select class="grd-white2" id="zhjlx" name="zhjlx">
<option selected="selected" value="身份证">身份证</option>
<option value="军官证">军官证</option>
</select> <input class="grd-white" id="ShenfenHaoma" name="ShenfenHaoma" type="text" value="" /><font color="red">*</font><span style="color:red;" id="shfzhcztx" name="shfzhcztx"></span>
            </div>
            <div>
                <span class="label">申请病种：</span><select id="ShenqingBingzhongq" class="grd-white2" name="ShenqingBingzhongq">
<option selected="selected" value="肺癌">肺癌</option>
</select><font color="red">*</font>
<span class="label">出生日期：</span><input class="grd-white" id="hzhchshrq"  name="hzhchshrq"  readonly type="text" value="" /><font color="red">*</font></div>
<div><span class="label">性别：</span><select id="hzhxingbie" class="grd-white2" name="hzhxingbie"><option value="">--请选择--</option>
<option value="男">男</option>
<option value="女">女</option>
</select><font color="red">*</font></div>
            <div>
                <span class="label">申请的医院/医生：</span><select id="ShenqingYishengId" class="grd-white2" name="ShenqingYishengId" style="width: 500px;"  onchange="qzyzh()">
    <option value=""></option>
<?php        
    $sql = "select id,shengjx,sheng,yymch,zhdysh,zhdyshyzh from `yyyshdq` where `yhszht`='1' order by shengjx ASC";

    $Query_ID = mysql_query($sql);
    $yyqzyzh=array();
    while($Record = mysql_fetch_array($Query_ID)){
      $yyqzyzh[$Record[0]]=$Record[5];
      echo "<option value=\"".$Record[0]."\"> ".$Record[1]." ".$Record[2]." ".$Record[3]." ".$Record[4]."</option>";
    }
?>  
</select>* 
</div>
           
           <div>
                <span class="label">患者通讯住址：</span><select class="grd-white2" id="s_province" name="sheng"></select>&nbsp;&nbsp;
    <select class="grd-white2" id="s_city" name="shi" ></select>&nbsp;&nbsp;
    <select class="grd-white2" id="s_county" name="qu"></select>*
    <script class="resources library" src="js/area.js" type="text/javascript"></script>
    
    <script type="text/javascript">_init_area();</script>

</div>
            <div>
                <span class="label">街道地址：</span><input class="grd-white" id="Zhuzhi" name="Zhuzhi" style="width:50%" type="text" value="" />*
            </div>
            <div>
<script>  

var yyqzyzh=eval(<?php echo json_encode($yyqzyzh);?>);
//alert(yyqzyzh[25]);
function yzshj(v){  
var a = /^((\(\d{3}\))|(\d{3}\-))?13\d{9}|15\d{9}|18\d{9}|14\d{9}$/ ;  
if( v.length!=11||!v.match(a) ){  
  alert("手机号错误!");
  return false;
}else{return true;}  
}  
</script>
                <span class="label">手机：</span><input class="grd-white" id="shouji" name="shouji" type="text" value=""  onblur="yzshj(this.value)"/>*
                <span class="label">联系电话1：</span><input class="grd-white" id="dianhua2" name="dianhua2" type="text" value="" />
                <span class="label">联系电话2：</span><input class="grd-white" id="dianhua3" name="dianhua3" type="text" value="" />
            </div>
            <!--div>
                <span id="span_Zhengduan"><span class="label">诊断类型：</span><input checked="true" id="Zhengduan_0" name="Zhengduan" type="radio" value="局部晚期"></input><label for="Zhengduan_0">局部晚期</label> <input id="Zhengduan_1" name="Zhengduan" type="radio" value="转移"></input><label for="Zhengduan_1">转移</label> *</span>
            </div-->
            <div>
                <span class="label">户籍类型：</span><select class="grd-white2" name="hzhhj" id="hzhhj">
						  <option value="非农业户口">非农业户口</option>
						  <option value="农业户口">农业户口</option>
						</select>*
                <span class="label">家庭人口：</span><select class="grd-white2" id="JiatingRenkou" name="JiatingRenkou"><option value="1">1</option>
<option value="2">2</option>
<option selected="selected" value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
</select>*
                家庭年收入：<input class="grd-white" id="NianShouru" name="NianShouru" style="width:100px" type="text" value="0" />元*
                <span style="width: 180px; color: Green;" id="span_pinjunshouru"></span>
            </div>
            <div>
                <span class="label">参保类型：</span><select class="grd-white2" name="CanBaoLeiXing" id="CanBaoLeiXing" style="width:100px" onchange="cblxxz()">
						  <option value="无">无</option>
						  <option value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
						  <option value="城镇居民医疗保险">城镇居民医疗保险</option>
						  <option value="新农合医疗保险">新农合医疗保险</option>
						  <option value="公费医疗">公费医疗</option>
						  <option value="现役军人医疗体系">现役军人医疗体系</option>
						</select>*
<div  id="cbdqxz" Style="display:none;">
                <span class="label">参保地区：</span><select class="grd-white2" id="cbdqs_province" name="cbdqsheng"></select>&nbsp;&nbsp;
    <select class="grd-white2" id="cbdqs_city" name="cbdqshi" ></select>*
    <script class="resources library" src="js/areaa.js" type="text/javascript"></script>
    
    <script type="text/javascript">_init_areaa();</script>

            </div>
            </div>
            <div>
                <span class="label">捐助类型：</span><input id="jzhlx"  name="jzhlx" type="radio" value="全部"></input><label for="jzhlx">全部</label> <input id="jzhlx" name="jzhlx" type="radio" value="部分"></input><label for="jzhlx">部分</label> *
                <span class="label">捐赠数量：</span><input class="input addInput" id="JuanZengShuLiang" name="JuanZengShuLiang" style="width:18px" type="text" value="" readonly/>瓶*
            </div>
            <div>
                <span class="label">用药剂量：</span><select class="grd-white2" id="YongYaoJiLiang" name="YongYaoJiLiang"><option value="12.5mg*28粒/瓶">12.5mg*28粒/瓶</option>
</select>*
                <span class="label">用法：</span><select class="grd-white2" id="YongYaoFangFao" name="YongYaoFangFao" onchange="showText()"><option value="4粒/天 每天一次，服4周休2周（qd4/2）">4粒/天 每天一次，服4周休2周（qd4/2）</option>
<option value="3粒/天 QD">3粒/天 QD</option>
</select>*
<script type="text/javascript">
function showText(){
if(document.getElementById('YongYaoFangFao').value=='其他'){
document.getElementById('textValue').style.display='block';
}else{
document.getElementById('textValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textValue">
<span class="label" >其他说明：</span><input class="grd-white" id="qtshm" name="qtshm" style="width:300px;" type="text" value="" /></div>
                <span style="width: 180px; color: Red;" id="span_Yichang"></span><span style="width: 180px; color: Green;" id="span_JuanzhuShuliang"></span>
            </div>
            <div>
                <!--span class="label" style="width: 150px">项目申请信息表日期：</span><input class="input addInput" id="XiangmuShenqingXinxiBiaoRiqi" name="XiangmuShenqingXinxiBiaoRiqi" type="text" value=""  readonly /--->
                <span class="label" style="width: 160px">首次申请材料登记日期：</span><input class="grd-white" id="djrq" name="djrq" type="text" value="<?php echo date('Y-m-d');?>"  readonly />*
                <!--div id="shcyyrqqb">
                <span class="label" style="">首次用药日期：</span><input class="input addInput" id="ShouciYongyaoRiqi" name="ShouciYongyaoRiqi" readonly type="text" value="" />
                <span class="label" style="width:180px;">预估首次赠药用药日期：</span><input class="input addInput" id="ygShouciYongyaoRiqi1" name="ygShouciYongyaoRiqi" readonly type="text" value="" />  首次用药日期 不记录了 id="ygshcyyrqqb" style="display:none;"
                </div-->
                <div >
                <span class="label" style="width: 180px">预估首次赠药用药日期：</span><input class="grd-white" id="ygShouciYongyaoRiqi2" readonly name="ygShouciYongyaoRiqi" type="text" value="" />
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>直系亲属*</legend>
            <input id="ZhixiQinshusJson" class="grd-white" name="ZhixiQinshusJson" type="hidden" value="[]" />
            <table id="tb_ZhixiQinshus" class="table">
                <tr>
                    <th style="text-align: center">
                        姓名
                    </th>
                    <th style="text-align: center">
                        身份号码
                    </th>
                    <th style="text-align: center">
                        军官证
                    </th>
                    <th style="text-align: center">
                        与患者关系
                    </th>
                    <th style="text-align: center">
                        联系方式
                    </th>                    
                    <th style="text-align: center">
                        操作
                    </th>
                </tr>
                <tr id="tr_action">
                    <td style="text-align: center">
                        <input type="text" class="grd-white" id="txtXingming" name="txtXingming" />
                    </td>
                    <td style="text-align: center">
                        <input type="text" class="grd-white" id="txtShenfenzheng" name="txtShenfenzheng" />
                    </td>
                    <td style="text-align: center">
                        <input type="text" class="grd-white" id="txtjgzh" name="txtjgzh" />
                    </td>
                    <td style="text-align: center">
                        <select class="grd-white2" Style="width:130px" id="txtGuanxi" name="txtGuanxi"><option selected="selected" value="父亲">父亲</option>
<option value="母亲">母亲</option>
<option value="本人">本人</option>
<option value="配偶">配偶</option>
<option value="儿子">儿子</option>
<option value="女儿">女儿</option>
<option value="其他关系">其他关系</option>
</select>
                    </td>
                    <td style="text-align: center">
                        <input type="text" class="grd-white" id="txtLianXiFangShi" name="txtLianXiFangShi" />
                    </td>
                    <td style="text-align: center">
                        <input type="button" id="btnAdd" value="添加"  class="uusub" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>医学条件评估</legend>
            <div>
                <span class="label" style="width: 180px;">临床诊断：</span><select class="grd-white2" id="lchzhd" name="lchzhd" onchange="showpgText()"  style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
<option value="间变性淋巴瘤激酶(ALK)阳性的局部晚期非小细胞肺癌(NSCLC)">间变性淋巴瘤激酶(ALK)阳性的局部晚期非小细胞肺癌(NSCLC)</option>
<option value="间变性淋巴瘤激酶(ALK)阳性的转移性的非小细胞肺癌(NSCLC)">间变性淋巴瘤激酶(ALK)阳性的转移性的非小细胞肺癌(NSCLC)</option>
<option value="其他">其他</option>
</select> 

<script type="text/javascript">
function showpgText(){
if(document.getElementById('lchzhd').value=='其他'){
document.getElementById('textpgValue').style.display='block';
}else{
document.getElementById('textpgValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textpgValue">
<span class="label"  style="width: 180px;">其他说明：</span><input class="grd-white" id="qtlchzhd" name="qtlchzhd" style="width:300px;" type="text" value="" /></div>
            </div>
            <div>
                <span class="label" style="width: 180px;">诊断日期：</span><input class="grd-white" id="zhdrq"  name="zhdrq"  readonly type="text" value="" />*
                <span class="label" style="width: 180px;">肿瘤病理类型：</span><select class="grd-white2" id="zhlbl" name="zhlbl"onchange="showlxText()"><option selected="selected"  value="">--请选择--</option>
<option value="鳞癌">鳞癌</option>
<option value="腺癌">腺癌</option>
<option value="腺鳞癌">腺鳞癌</option>
<option value="大细胞癌">大细胞癌</option>
<option value="其他">其他</option>
</select>*
<script type="text/javascript">
function showlxText(){
if(document.getElementById('zhlbl').value=='其他'){
document.getElementById('textlxValue').style.display='block';
}else{
document.getElementById('textlxValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textlxValue">
<span class="label"  style="width: 180px;">其他说明：</span><input class="grd-white" id="qtzhlbl" name="qtzhlbl" style="width:300px;" type="text" value="" /></div>
</div>
<div><span class="label" style="width: 180px;">分期：</span><select class="grd-white2" id="fq" name="fq" onchange="showfqText()">
<option selected="selected" value="">--请选择--</option>
<option value="IIIa">IIIa</option>
<option value="IIIb">IIIb</option>
<option value="IV">IV</option>
<option value="其他">其他</option>
</select>*
<script type="text/javascript">
function showfqText(){
if(document.getElementById('fq').value=='其他'){
document.getElementById('textfqValue').style.display='block';
}else{
document.getElementById('textfqValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textfqValue">
<span class="label"  style="width: 180px;">其他说明：</span><input class="grd-white" id="qtfq" name="qtfq" style="width:300px;" type="text" value="" /></div>
</div>
            <div>
                <span class="label" style="width: 180px;">ALK检测：</span><select class="grd-white2" id="alkjc" name="alkjc" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="阳性">阳性</option>
    <option value="阴性">阴性</option>  
</select>*
</div>
            <div>
                <span class="label" style="width: 180px;">ALK诊断方法：</span><select class="grd-white2" id="alkzhdff" name="alkzhdff" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="IHC">IHC</option>
    <option value="PT-PCR">PT-PCR</option>  
    <option value="FISH">FISH</option>  
</select>*
</div>        
            <!--div>
                <span class="label" style="width: 180px;">该患者的诊断为：</span><select id="ghzhdzhdw" name="ghzhdzhdw" style="width: 500px;">
    <option value="间变性淋巴瘤激酶(ALK)阳性的局部晚期非小细胞肺癌(NSCLC)">间变性淋巴瘤激酶(ALK)阳性的局部晚期非小细胞肺癌(NSCLC)</option>
    <option value="间变性淋巴瘤激酶(ALK)阳性的转移性的非小细胞肺癌(NSCLC)">间变性淋巴瘤激酶(ALK)阳性的转移性的非小细胞肺癌(NSCLC)</option>
</select>*

</div-->
            <div>
                <span class="label" style="width: 180px;">索坦开始治疗时间：</span><input class="grd-white" id="skrkshzhlshj"  name="skrkshzhlshj"  readonly type="text" value="" />*
                <span class="label" style="width: 180px;">索坦治疗疗程：</span><input class="grd-white" id="skrzhllch" name="skrzhllch" type="text" value=""/> 月*
            </div>
            <div>
                <span class="label" style="width: 180px;">索坦治疗效果(RECIST 标准)评估：</span><select class="grd-white2" id="skrzhlxgpg" name="skrzhlxgpg" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="未用药">未用药</option>
    <option value="CR">CR</option>
    <option value="PR">PR</option>  
    <option value="SD">SD</option>  
    <option value="PD">PD</option>  
</select>
            </div>
            <div>
                <span class="label" style="width: 180px;">出现无法耐受的副作用：</span><select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="未用药">未用药</option>
    <option value="是">是</option>
    <option value="否">否</option>  
</select>
            </div>
            <div>
                <span class="label"  style="width: 180px;">是否应该继续索坦治疗：</span><select class="grd-white2" id="shfygjxskrzhl" name="shfygjxskrzhl" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="是">是</option>
    <option value="否">否</option>  
</select>
            </div>

        </fieldset>
        <div class="btnPos">
            <input id="submitBtn" type="submit" value="保存"  class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回"  class="uusub2" /></div>
        </form></div>
    <script type="text/javascript">
    
    chooseDateOld('ygShouciYongyaoRiqi1', true); 
    chooseDate('djrq', true); 
    chooseDate('zhdrq', true); 
    chooseDate('hzhchshrq', true); 
    chooseDate('skrkshzhlshj', true); 
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
            return true;
        }

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
        function AddRow(index, xingming, shenfenzheng ,jgzh, guanxi,lianxidianhua, isCheck) {
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
            $("#tr_action").before(
                    "<tr id=" + index + ">" +
                    "<td align=\'center\'>" + xingming + "</td>" +
                    "<td align=\'center\'>" + shenfenzheng + "</td>" +
                    "<td align=\'center\'>" + jgzh + "</td>" +
                    "<td align=\'center\'>" + guanxi + "</td>" +
                    "<td align=\'center\'>" + lianxidianhua + "</td>" +
                    "<td align=\'center\'><a href=\'javascript:deltr(" + index + ")\'>删除</a></td></tr>");
            return true;
        }
        function InitZhixiQinshus() {
            var $tr = $("#tb_ZhixiQinshus tr");
            var len = $tr.length;
            var json = eval($("#ZhixiQinshusJson").val());
            for (var i = 0; i < json.length; i++) {
                AddRow(len + i, json[i]["姓名"], json[i]["公民身份号码"], json[i]["军官证"], json[i]["与患者关系"], json[i]["联系方式"], false);
            }
            return true;
        }
        //删除行
        function deltr(index) {
            if (confirm("确定要删除吗？")) {
                $("tr[id=\'" + index + "\']").remove();
                var json = eval("(" + $("#ZhixiQinshusJson").val() + ")");
                json.splice(index - 2, 1);
                $("#ZhixiQinshusJson").val(JSON.stringify(json));
            }
        }

        //页面加载后
        $(function () {
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
        /*$("#s_province option[value='省份']").text("sdaf");        
        $("#s_province option[value='省份']").val("sdaf");*/

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
                  首次用药日期不记录了
                  document.getElementById('shcyyrqqb').style.display='block';
                  document.getElementById('ygshcyyrqqb').style.display='none';*/
              }else {
              $('#JuanZengShuLiang').val("12");
                  /*首次用药日期不记录了
                  document.getElementById('shcyyrqqb').style.display='none';
                  document.getElementById('ygshcyyrqqb').style.display='block';
                  
                document.getElementById('ygShouciYongyaoRiqi2').disabled = false;
                document.getElementById('ygShouciYongyaoRiqi1').disabled = true;*/
                  
              }
          });
          
          
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
                if (!AddRow(len, txtXingming, txtShenfenzheng, txtjgzh, txtGuanxi, txtLianXiFangShi, true)) {
                    return false;
                }
                //清空输入框
                $("#txtXingming").val('');
                $("#txtShenfenzheng").val('');
                $("#txtjgzh").val('');
                $("#txtGuanxi").val('');
                $("#txtLianXiFangShi").val('');

                var json = eval($("#ZhixiQinshusJson").val());
                var assignment = { "姓名": txtXingming, "公民身份号码": txtShenfenzheng, "军官证": txtjgzh, "与患者关系": txtGuanxi, "联系方式": txtLianXiFangShi };
                json.push(assignment);
                var str = JSON.stringify(json);
                $("#ZhixiQinshusJson").val(str);
            })
        });
    </script>
            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
    
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
    <td width="30%" bgcolor="#FFFFFF" align="center">指定医生</td>
    <td width="70%" bgcolor="#FFFFFF" align="center"><img src="" id="zhdyshyzh"/><img src="" id="zhdyshqzh"/></td>
  </tr>
  
  <tr id="qzyzhshq" style="display:none;">
    <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生</td>
    <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
  </tr>
  
</table>

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
</body>
<script type="text/javascript">
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
v=yyqzyzh[$('#ShenqingYishengId').val()];
imgsrc=padLeft(v,3);
document.getElementById('zhdyshyzh').src='./qzyzh/'+imgsrc+'-1.jpg';
document.getElementById('zhdyshqzh').src='./qzyzh/'+imgsrc+'-2.jpg';
if(i!=undefined&&i>0){
//alert('怎么来着了?');
document.getElementById('qzyzhshq').style.display='';
var shqimg="";
  for(j=0;j<i;j++){
  shqimg = shqimg+'<img src="./qzyzh/'+imgsrc+'-'+(j+3)+'.jpg"/>';
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
</html>
