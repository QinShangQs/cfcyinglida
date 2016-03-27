<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqlx=$_GET['lx'];
if($shqlx=='RCC'||$shqlx=='GIST'||$shqlx=='pNET'){
$html_title="新增申请";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title."(".$shqlx.")";?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <form action="shqglxzshqac.php" method="post">
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
        <fieldset class="incontact flt">
            <legend>申请信息</legend>
<div class="insinsins" style="width:100%;">
  <label>姓名：</label><span>
  <input class="grd-white" id="Xingming" name="Xingming" type="text" value="" /><font color="red">*</font></span>
  <label>证件类型：</label><span>
    <select class="grd-white2" id="zhjlx" name="zhjlx">
      <option selected="selected" value="身份证">身份证</option>
      <option value="军官证">军官证</option>
    </select>
    <input class="grd-white" id="ShenfenHaoma" name="ShenfenHaoma" type="text" value="" /><font color="red">*</font>
    <span style="color:red;" id="shfzhcztx" name="shfzhcztx"></span>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>申请病种：</label><span>
  <select class="grd-white2" id="shqlx" name="shqlx">
    <option selected="selected" value="<?php echo $shqlx;?>"><?php echo $shqlx;?></option>
  </select><font color="red">*</font>
  </span>
  <label>出生日期：</label><span>
    <input class="grd-white" id="hzhchshrq"  name="hzhchshrq"  readonly type="text" value="" /><font color="red">*</font>
  </span>
  <label>性别：</label><span>
  <select class="grd-white2" id="hzhxingbie" name="hzhxingbie"><option value="">--请选择--</option>
    <option value="男">男</option>
    <option value="女">女</option>
  </select><font color="red">*</font>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>申请的医院/医生：</label><span>
  <select class="grd-white2" id="ShenqingYishengId" name="ShenqingYishengId" style="width: 500px;"  onchange="qzyzh()">
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
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>患者通讯住址：</label><span>
    <select class="grd-white2" id="s_province" name="sheng"></select>
    <select class="grd-white2" id="s_city" name="shi" ></select>
    <select class="grd-white2" id="s_county" name="qu"></select>*
    <script src="js/area.js" type="text/javascript"></script>
    <script type="text/javascript">_init_area();</script>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>街道地址：</label><span>
    <input class="grd-white" id="Zhuzhi" name="Zhuzhi" style="width:500px" type="text" value="" />*
  </span>
</div>
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
<div class="insinsins" style="width:100%;">
  <label>手机：</label><span>
    <input class="grd-white" id="shouji" name="shouji" type="text" value=""  onblur="yzshj(this.value)"/>*
  </span>
  <label>联系电话1：</label><span>
  <input class="grd-white" id="dianhua1" name="dianhua1" type="text" value="" />
  </span>
  <label>联系电话2：</label><span>
  <input class="grd-white" id="dianhua2" name="dianhua2" type="text" value="" />
  </span>
  <label>联系电话3：</label><span>
  <input class="grd-white" id="dianhua3" name="dianhua3" type="text" value="" />
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>户籍类型：</label><span>
    <select class="grd-white2" name="hzhhj" id="hzhhj">
      <option value="非农业户口">非农业户口</option>
      <option value="农业户口">农业户口</option>
    </select>*
  </span>
  <label>家庭人口：</label><span>
    <select class="grd-white2" id="JiatingRenkou" name="JiatingRenkou">
      <option value="1">1</option>
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
  </span>
  <label>家庭年收入：</label><span>
    <input class="grd-white" id="NianShouru" name="NianShouru"  type="text" value="0" />元*
  </span><span style="width: 180px; color: Green;" id="span_pinjunshouru"></span>
</div>
<div class="insinsins" style="width:100%;">
  <label>参保类型：</label><span>
    <select class="grd-white2" name="CanBaoLeiXing" id="CanBaoLeiXing" style="width:100px" onchange="cblxxz()">
      <option value="无">无</option>
      <option value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
      <option value="城镇居民医疗保险">城镇居民医疗保险</option>
      <option value="新农合医疗保险">新农合医疗保险</option>
      <option value="公费医疗">公费医疗</option>
      <option value="现役军人医疗体系">现役军人医疗体系</option>
    </select>*
  </span>
  <div id="cbdqxz" Style="display:none;">
    <label>参保地区：</label><span>
      <select class="grd-white2" id="cbdqs_province" name="cbdqsheng"></select>&nbsp;&nbsp;
      <select class="grd-white2" id="cbdqs_city" name="cbdqshi" ></select>*
      <script src="js/areaa.js" type="text/javascript"></script>
      <script type="text/javascript">_init_areaa();</script>
    </span>
  </div>
</div>
<div style="width:100%;">
  <label>捐助类型：</label><span>
    <input id="jzhlx" name="jzhlx" type="radio" value="全部"></input><label for="jzhlx">全部</label> 
    <?php if($shqlx=='RCC'){?>
    <input id="jzhlx" name="jzhlx" type="radio" value="原部分"></input><label for="jzhlx">原部分</label> 
    <input id="jzhlx" name="jzhlx" type="radio" value="1+1+1"></input><label for="jzhlx">1+1+1</label> 
    <?php 
    }else{
    ?>
    <input id="jzhlx" name="jzhlx" type="radio" value="部分"></input><label for="jzhlx">部分</label> 
    <?php
    }
    ?>*
  </span>
  <label>捐赠数量：</label><span>
    <input class="grd-white" id="JuanZengShuLiang" name="JuanZengShuLiang" style="width:18px" type="text" value="" readonly/>瓶*
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>用法：</label><span>
    <select class="grd-white2" id="yfjl" name="yfjl">
      <option value="12.5mg">12.5mg</option>
      <option value="25mg">25mg</option>
      <option value="37.5mg">37.5mg</option>
      <option value="50mg">50mg</option>
      <option value="62.5mg">62.5mg</option>
      <option value="75mg">75mg</option>
      <option value="87.5mg">87.5mg</option>
      <option value="100mg">100mg</option>
    </select>*
    <select class="grd-white2" id="yfcsh" name="yfcsh">
      <option value="Qid">Qid</option>
      <option value="Bid">Bid</option>
      <option value="Tid">Tid</option>
    </select>*
    <select class="grd-white2" id="yfzhq" name="yfzhq">
      <option value="2/4">2/4</option>
      <option value="连续服用">连续服用</option>
    </select>*
  </span>
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
    <label>其他说明：</label><span>
      <input class="grd-white" id="qtshm" name="qtshm" style="width:300px;" type="text" value="" />
    </span>
  </div>
  <span style="width: 180px; color: Red;" id="span_Yichang"></span><span style="width: 180px; color: Green;" id="span_JuanzhuShuliang"></span>
</div>
<div class="insinsins" style="width:100%;">
  <label>首次申请材料登记日期：</label><span>
    <input class="grd-white" id="djrq" name="djrq" type="text" value="<?php echo date('Y-m-d');?>"  readonly />*
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
<input id="ZhixiQinshusJson" name="ZhixiQinshusJson" type="hidden" value="[]" />
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
    <input  style="width:80px;" type="text" id="txtLianXiFangShi" name="txtLianXiFangShi" class="grd-white" />
  </td>
  <td align="center" bgcolor="#FFFFFF">
    <input type="button" id="btnAdd" value="添加" class="uusub2" />
  </td>
</tr>
</table>
        </div>
				<div class="title w977 flt top">
				<strong>医学条件评估</strong><span></span>
				</div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
<div class="insinsins" style="width:100%;">
  <label>临床诊断：</label><span>
    <select class="grd-white2" id="lchzhd" name="lchzhd" style="width: 500px;">
      <?php if($shqlx=='GIST'){?>
      <option selected="selected" value="">--请选择--</option>
      <option value="甲磺酸伊马替尼治疗失败的胃肠间质瘤（GIST）">甲磺酸伊马替尼治疗失败的胃肠间质瘤（GIST）</option>
      <option value="甲磺酸伊马替尼不能耐受的胃肠间质瘤（GIST）">甲磺酸伊马替尼不能耐受的胃肠间质瘤（GIST）</option>
      <?php
      }else if($shqlx=='RCC'){?>
      <option selected="selected" value="不能手术的晚期肾细胞癌（RCC）">不能手术的晚期肾细胞癌（RCC）</option>
      <?php
      }else if($shqlx=='pNET'){?>
      <option selected="selected" value="不可切除的，转移性高分化进展期胰腺神经内分泌瘤（pNET）">不可切除的，转移性高分化进展期胰腺神经内分泌瘤（pNET）</option>
      <?php
      }
      ?>
    </select> 
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>诊断日期：</label><span>
    <input class="grd-white" id="zhdrq"  name="zhdrq"  readonly type="text" value="" />*
  </span>
  <label>肿瘤病理类型：</label><span>
    <select class="grd-white2" id="zhlbl" name="zhlbl">
      <?php if($shqlx=='GIST'){?>
      <option selected="selected" value="">--请选择--</option>
      <option value="梭形细胞型">梭形细胞型</option>
      <option value="上皮样细胞型">上皮样细胞型</option>
      <option value="梭形细胞-上皮样细胞混合型">梭形细胞-上皮样细胞混合型</option>
      <?php
      }else if($shqlx=='RCC'){?>
      <option selected="selected" value="">--请选择--</option>
      <option value="肾透明细胞癌">肾透明细胞癌</option>
      <option value="乳头状肾细胞癌">乳头状肾细胞癌</option>
      <option value="肾嫌色细胞癌">肾嫌色细胞癌</option>
      <option value="肾集合管癌">肾集合管癌</option>
      <option value="未分类肾细胞癌">未分类肾细胞癌</option>
      <?php
      }else if($shqlx=='pNET'){?>
      <option selected="selected" value="">--请选择--</option>
      <option value="G1">G1</option>
      <option value="G2">G2</option>
      <option value="其他（Ki67指数≤20）">其他（Ki67指数≤20）</option>
      <?php
      }
      ?> 
    </select>*
  </span>
</div>
<div class="insinsins" style="width:100%;">
<?php
if($shqlx=='GIST'){
?>
<label>甲磺酸伊马替尼服用时长：</label><span>
    <input class="grd-white" id="skrzhllch" name="skrzhllch" type="text" value=""/> 月*
  </span>
<?php
}
?>
  
  <label>索坦开始服用时间：</label><span>
    <input class="grd-white" id="skrkshzhlshj"  name="skrkshzhlshj"  readonly type="text" value="" />*
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>填表日期：</label><span>
    <input class="grd-white" id="skrkshzhlshj"  name="skrkshzhlshj"  readonly type="text" value="" />*
  </span>
</div>
<div class="insinsins">
  <label>器官功能是否良好：</label>
</div>
<div class="insinsins">
  <label>甲状腺功能：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="否">否</option>  
    </select>
  </span>
</div>
<div class="insinsins">
  <label>肝脏功能：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="否">否</option>  
    </select> 
  </span>
</div>
<div class="insinsins">
  <label>肾脏功能：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="否">否</option>  
    </select> 
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>是否怀孕：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="否">否</option>  
    </select>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>过去12个月有无以下情况：</label>
</div>
<div class="insinsins">
  <label>充血性心脏衰竭：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="无">无</option>  
    </select>
  </span>
</div>
<div class="insinsins">
  <label>不稳定心绞痛：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="无">无</option>  
    </select>
  </span>
</div>
<div class="insinsins">
  <label>不稳定心律异常：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="无">无</option>  
    </select>
  </span>
</div>
<div class="insinsins">
  <label>不稳定心肌梗塞：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="无">无</option>  
    </select>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>放射治疗毒副作用是否缓解：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="否">否</option>  
      <option value="未行">未行</option>
    </select>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>化学治疗毒副作用是否缓解：</label><span>
    <select class="grd-white2" id="chxwfnshdfzy" name="chxwfnshdfzy" >
      <option selected="selected" value="">--请选择--</option>
      <option value="是">是</option>
      <option value="否">否</option>  
      <option value="未行">未行</option>
    </select>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>备注：</label><span>
    <TEXTaREa class="grd-white" rows="2" cols="20" id="bzh" name="bzh"></TEXTaREa>
  </span>
</div>
              </td>
            </tr>
          </table> 
        </div>
				<div class="incontact w955 flt">
<input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
				</div>
</form>
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
    
    chooseDateOld('ygShouciYongyaoRiqi1', true); 
    //chooseDate('djrq', true); 
    chooseDate('zhdrq', true); 
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
              }else {
              $('#JuanZengShuLiang').val("12");
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
<?php
}else{
echo "错误!返回重新登录！ <a href=\"/\">登陆</a>";exit();
}
?>