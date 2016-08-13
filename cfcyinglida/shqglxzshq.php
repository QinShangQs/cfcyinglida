<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqlx=$_GET['lx'];
if($shqlx=='RCC'||$shqlx=='GIST'||$shqlx=='pNET'){
$html_title="申请信息";
include('spap_head.php');
include('wdb.php');
$db = new DB();
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title."(".$shqlx.")";?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <form action="shqglxzshqac.php" method="post" name="shqglxzshqForm">
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
        <fieldset class="incontact flt">
            <legend>申请信息</legend>
<div class="insinsins" style="width:100%;">
  <label>姓名：</label><span>
  <input class="grd-white" id="hzhxm" name="hzhxm" type="text" value="" /><font color="red">*</font></span>
  <label>证件类型：</label><span>
    <select class="grd-white2" id="zhjlx" name="zhjlx">
      <option selected="selected" value="身份证">身份证</option>
      <option value="军官证">军官证</option>
    </select>
    <input class="grd-white" id="zhjhm" name="zhjhm" type="text" value="" /><font color="red">*</font>
    <span style="color:red;" id="zhjhmtx" name="zhjhmtx"></span>
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
  <select class="grd-white2" id="hzhxb" name="hzhxb"><option value="">--请选择--</option>
    <option value="男">男</option>
    <option value="女">女</option>
  </select><font color="red">*</font>
  </span>
</div>
<!--  07-14徐勤杰修改 开始 -->
<div class="insinsins" style="width:100%;">
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
  <label>医院/医生：</label>
    <span><select class="grd-white2" id="yshid" name="shqyyid" onchange="qzyzh()">
    <option value="">-请选择-</option>
  
  </select>
  </span>
  <label style="display: none;">药房名称：</label>
  <span style="display: none;"><select class="grd-white2" id="yfid" name="shqyfid">
  <option value="">-请选择-</option>
  </select>
  </span>
</div>
<script type="text/javascript">
    $("#shengid").change(function(){
      var shmch = document.getElementById('shengid').value; 
      $.get('xzyshym.php',{'shmch':shmch},function(data){
        //alert(data);
        $("#shiid").html(data);//alert(data);
      });
    });
</script>
<script type="text/javascript">
    $("#shiid").change(function(){ 
      //alert('aaaaa');
      var shimch = document.getElementById('shiid').value;
      $.get('xzyyyshym.php',{'shimch':shimch},function(data){
        $("#yshid").html(data);//alert(data);
      });
    });
</script>
<script type="text/javascript">
    $("#yshid").change(function(){ 
      //alert('aaaaa');
      var yfmch = document.getElementById('yshid').value;
      //alert(yfmch);
      $.get('xzyfym.php',{'yfmch':yfmch},function(data){
        $("#yfid").html(data);
        //alert(data);
      });
    });
</script>
<!--  07-14徐勤杰修改 结束  -->
<!--div class="insinsins" style="width:100%;">
  <label>申请的医院/医生：</label><span>
  <select class="grd-white2" id="shqyyid" name="shqyyid" style="width: 500px;"  onchange="qzyzh()">
    <option value=""></option>
<?php
/*  
    $sql = "select id,shengjx,sheng,yymch,zhdysh,zhdyshyzh,shqysh1,shqysh2,shqysh3 from `yyyshdq` where `yhszht`='1' order by shengjx ASC";
    $Query_ID = mysql_query($sql);
    $yyqzyzh=array();
    $yshshq=array();
    while($Record = mysql_fetch_array($Query_ID)){
      $yyqzyzh[$Record[0]]=$Record[5];
      
      $shqyshshl=0;
      if($Record[6]!=''){$shqyshshl++;}
      if($Record[7]!=''){$shqyshshl++;}
      if($Record[8]!=''){$shqyshshl++;} 
      $yshshq[$Record[0]]=$shqyshshl;
      echo "<option value=\"".$Record[0]."\"> ".$Record[1]." ".$Record[2]." ".$Record[3]." ".$Record[4]."</option>";
    }
    */
?>  
  </select>* 
  </span>
</div-->
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
    <input class="grd-white" id="jddzh" name="jddzh" style="width:500px" type="text" value="" />*
  </span>
</div>
<script>  
var yyqzyzh=eval(<?php echo json_encode($yyqzyzh);?>);
var yshshq=eval(<?php echo json_encode($yshshq);?>);
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
    <input class="grd-white" id="shj" name="shouji" type="text" value=""  onblur="yzshj(this.value)" size='19'/>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>第一联系人姓名：</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
  <input class="grd-white" id="dh1xm" name="dianhua2xm" type="text" value="" size='19' placeholder="项目办将优先与该电话联系"/>
  </span>
  <label>与患者关系：</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
  <input class="grd-white" id="dh1gx" name="dianhua2gx" type="text" value="" size='19' />
  </span>
  <label>联系方式：</label><span>
  <input class="grd-white" id="dh1" name="dianhua2" type="text" value="" size='19' />
  </span>
</div>
<div class="insinsins" style="width:100%;">
 <label>第二联系人姓名：</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
  <input class="grd-white" id="dh2xm" name="dianhua3xm" type="text" value="" size='17'/>
  </span>
   <label>与患者关系：</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
  <input class="grd-white" id="dh2gx" name="dianhua3gx" type="text" value="" size='17'/>
  </span>
  <label>联系方式：</label><span>
  <input class="grd-white" id="dh2" name="dianhua3" type="text" value="" size='17'/>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>第三联系人姓名：</label><span>
  <input class="grd-white" id="dh3xm" name="dh3xm" type="text" value="" size='17'/>
  </span>
  <label>与患者关系：</label><span>
  <input class="grd-white" id="dh3gx" name="dh3gx" type="text" value="" size='17'/>
  </span>
  <label>联系方式：</label><span>
  <input class="grd-white" id="dh3" name="dh3" type="text" value="" size='17'/>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>户籍类型：</label><span>
    <select class="grd-white2" name="hzhhj" id="hzhhj">
      <option value="非农业户口">非农业户口</option>
      <option value="农业户口">农业户口</option>
    </select>*
  </span>
<!--   <label>患者年收入：</label><span> -->
<!-- <input class="grd-white" style="width: 60px; " id="hzhnshr" name="hzhnshr"  type="text" value="0" onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" />元* -->
<!--   </span> -->
  
</div>
<div class="insinsins" style="width:100%;">
  <label>参保类型：</label><span>
    <select class="grd-white2" name="hzhcblx" id="hzhcblx" style="width:100px" onchange="cblxxz()">
      <option value="无">无</option>
      <option value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
      <option value="城镇居民医疗保险">城镇居民医疗保险</option>
      <option value="新农合医疗保险">新农合医疗保险</option>
      <option value="公费医疗">公费医疗</option>
      <option value="现役军人医疗体系">现役军人医疗体系</option>
      <option value="贫困救助">贫困救助</option>
      <option value="商业医疗保险">商业医疗保险</option>
      <option value="全自费">全自费</option>
      <option value="其他社会保险">其他社会保险</option>
      <option value="其他">其他</option>
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

<!--用法功能取消-->
<!--<div class="insinsins" style="width:100%;">-->
<!--  <label>用法：</label><span>-->
<!--    <select class="grd-white2" id="yfjl" name="yfjl">-->
<!--      <option value="12.5mg">12.5mg</option>-->
<!--      <option value="25mg">25mg</option>-->
<!--      <option value="37.5mg">37.5mg</option>-->
<!--      <option value="50mg">50mg</option>-->
<!--      <option value="62.5mg">62.5mg</option>-->
<!--      <option value="75mg">75mg</option>-->
<!--      <option value="87.5mg">87.5mg</option>-->
<!--      <option value="100mg">100mg</option>-->
<!--    </select>*-->
<!--    <select class="grd-white2" id="yfcsh" name="yfcsh">-->
<!--      <option value="Qid">Qid</option>-->
<!--      <option value="Bid">Bid</option>-->
<!--      <option value="Tid">Tid</option>-->
<!--    </select>*-->
<!--    <select class="grd-white2" id="yfzhq" name="yfzhq">-->
<!--      <option value="2/4">2/4</option>-->
<!--      <option value="连续服用">连续服用</option>-->
<!--    </select>*-->
<!--  </span>-->
<!--</div>-->

<?php /*?>
<div class="insinsins" style="width:100%;">
  <label>首次申请材料登记日期：</label><span>
    <input class="grd-white" id="djrq" name="djrq" type="text" value="<?php echo date('Y-m-d');?>"  readonly />*
  </span>
</div>
<?php */?>
<!--div class="insinsins" style="width:100%;">
  <label>预估首次用药日期：</label><span>
    <input class="grd-white" id="ygShouciYongyaoRiqi" name="ygShouciYongyaoRiqi" type="text" value="<?php echo date('Y-m-d');?>"  readonly />*
  </span>
</div-->

        </fieldset>
              </td>
            </tr>
          </table> 
        </div>
				<div class="title w977 flt top">
				<strong>患者及其直系亲属信息和收入情况</strong><span></span>
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
  <td width="9%" align="center" bgcolor="#FFFFFF">上年度收入</td>
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
      <option selected="selected" value="本人">本人</option>
      <option value="父亲">父亲</option>
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

<label>家庭人口：</label>
    <input class="grd-white" style="width: 60px; " id="hzhjtrk" name="hzhjtrk"  type="text" value="0" onchange="jspjnshr()" readonly/>
  
  <label>家庭年收入：</label>
    <span>
        <input class="grd-white" id="hzhjtnshr" name="hzhjtnshr" type="text" value="0" onchange="jspjnshr()" readonly/>元
    </span>
    <label>家庭人均收入</label>
    <span>
        <input class="grd-white" id="hzhjtrjshr" name="hzhjtrjshr" type="text" value="0" onchange="jspjnshr()" readonly>元
    </span>
    <span style="width: 180px; color: Green;" id="hzhjtpjnshr"></span>

</div>
<div class="title w977 flt top">
    <strong>医学条件评估</strong><span></span>
</div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>

                  <div class="insinsins">
                      <label>一线药品名称：</label>
    <span>

        <select class="grd-white2" id="yxypname" name="yxypname" onchange="alertyes()">
            <option value="">-请选择-</option>
            <?php
            $yxsql = "select * from ypname";
            $yplist = $db->getAll($yxsql);
            if(!empty($yplist)):
                foreach($yplist as $key=>$val):
                    ?>
                    <option value='<?php echo $val['ypname']; ?>'><?php echo $val['ypname']; ?></option>
                <?php
                endforeach;
            endif;
            ?>
        </select>


    </span>
                      <div id="sthsw" style="display: none;">
                          <label>索坦入组编码后四位：<input type="text" name="bianmahousiwei" id="sthswba" onchange="yzsuotianhsw()"/></label>
                      </div>
                      <div id="ttps" style="display: none;">
                          <label>前期服用过索坦的瓶数：<input type="text" name="ttpnum"/></label>
                      </div>
                  </div>

<div class="insinsins" style="width:100%;">
  <label>该患者诊断为：</label>
  <span>
     <label>既往</label>
     <select name="bying">
        <option value="">--请选择--</option>
        <option value="细胞因子">细胞因子</option>
        <option value="酪氨酸激酶抑制剂">酪氨酸激酶抑制剂</option>
     </select>
     <select name="xbzlsb" onchange="jbfz()"  id="jbfzs">
        <option value="">--请选择--</option>
        <option value="疾病进展">疾病进展</option>
        <option value="不能耐受">不能耐受</option>
     </select>
  </span>
  <span id="xbzlsbkaos" style="display: none;">　原因：<input type="text" name="xbzlsbkaos"/></span>
  <span >　所用药物名称：<input type="text" name="yaoname"/></span>
  <span >　治疗开始时间：<input type="text" name="zhiliaotime" id='zl1' readonly/></span>
  <span>
</div>

<div class="insinsins" style="width:100%;">
    <label>英立达开始治疗时间：</label>
    <span>
        <input class="grd-white" id="zhdrq"  name="starttime"  readonly type="text" value="" />
    </span>
</div>

<div class="insinsins" style="width:100%;">
  <label>英立达治疗RECIST评估：</label>
  <span>
    <select name="yldpg" id='pd' onchange="PD()">
        <option value="CR">CR</option>
        <option value="PR">PR</option>
        <option value="SD">SD</option>
        <option value="PD">PD</option>
    </select>
  </span>
  <span style="display: none" id="yldsf">
 &nbsp;若勾选PD则是否愿意接受辉瑞公司随访：<input type="radio" name="yldsf" value="1"/>是 <input type="radio" name="yldsf" value="2"/>否
  </span>
  <span>　评估时间：</span><input class="grd-white" id="pgtime2"  name="pgtime"  readonly type="text" value="" />
</div>
<div class="insinsins" style="width:100%;">
    <label>是否继续服用英立达：</label>
    <input type="radio" name="sfyld" value="1"/>是
    <input type="radio" name="sfyld" value="2"/>否
</div>

<div class="insinsins" style="width:100%;">
    <label>该患者的诊断为：</label>
    <input type="checkbox" name="docmes" value="1"/>
    既往接受过一种酪氨酸激酶抑制剂或细胞因子治疗失败的进展期肾细胞癌（RCC）的成人患者
</div>
<div class="insinsins" style="width:100%;">
    <label>该患者是否符合入组医学标准：</label>
    <input type="radio" name="fuhe" value="符合"/>符合
    <input type="radio" name="fuhe" value="不符合"/>不符合
</div>
                  <div class="insinsins" style="width: 100%;">
                      <label>本次就诊和填表日期：</label>
                      <input class="grd-white" id="quetime"  name="start_time"  readonly type="text" value="" />
                  </div>
<!-- <div class="insinsins" style="width:100%;"> -->
<!--     <label>指定医生/授权医生签字：</label> -->
<!--     <input type="text" name="docname"/> -->
<!-- </div> -->

              </td>
            </tr>
          </table> 
        </div>
				<div class="incontact w955 flt">
                    <input id="submitBtn" type="submit" value="保存" class="uusub" />
                    <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
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
      <td width="70%" bgcolor="#FFFFFF" align="center">
      <img id="zhdyshyzh" width="100"/><img id="zhdyshqzh" width="100"/>
      </td>
    </tr>

    <tr id="qzyzhshq" style="display;">
      <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生<br/><span id='shqyshxsh'></span></td>
      <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div><img id="shouquanyishengyangzhang" width="100"/></td>
    </tr>
  </table>
</div>



<div class="mindess" id="tjyzh" style="display:none; border:3px solid #FFFFFF; clear:both; height: 132px;">
    <div style="position:absolute; right:15px;"><a style="color:#FFFFFF; cursor:pointer;" onclick="tjyzh(0)">关闭</a></div>
    <fieldset style="background:#ffffff; height: 100px;margin-top: 11px;">
        <legend style="background:#ffffff;">修改直属亲属信息</legend>

        <table id="tb_ZhixiQinshu" class="table" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="9%" align="center" bgcolor="#FFFFFF">姓名</td>
                <td width="12%" align="center" bgcolor="#FFFFFF">身份号码</td>
                <td width="12%" align="center" bgcolor="#FFFFFF">军官证</td>
                <td width="9%" align="center" bgcolor="#FFFFFF">与患者关系</td>
                <td width="9%" align="center" bgcolor="#FFFFFF">联系方式</td>
                <td width="9%" align="center" bgcolor="#FFFFFF">上年度收入</td>
                <td width="9%" align="center" bgcolor="#FFFFFF">操作</td>
            </tr>
            <tr id="update_zhixiqinshu" style="color:#1f4248; font-size:12px;">

            </tr>
        </table>

    </fieldset>
</div>

<script type="text/javascript">

//验证索坦入组后四位
function yzsuotianhsw() {
    var hsw = document.getElementById('sthswba').value;
    if(hsw == '') {
        alert('请填写索坦后四位');
    }
//     var json = '';
//     var count = '';
//     $.ajax({
//         url: '/i_shenqinginfo.php',
//         type: 'post',
//         async: false,
//         data: {ajax: 'ajax', hzhid: hsw},
//         dataType: 'json',
//         success: function(data) {
//             if(data == 0) {
//                 alert('无此编码');
//                 return ;
//             } else {
//                 //患者基本信息
//                 json = data.json;
//                 //查询领药次数
//                 count = data.count;

//                 //一级验证是非入组和RCC
//                 //RCC通过后，进行二级验证是否为1+1+1，否的话是直接通过
//                 //如果选是则进行三级验证是否领药次数超过四次，如果是则过，如果否则提示刚刚给你写的那个内容
//                 if(json.shqbzh == 'RCC' && json.shqzht == '入组') {
//                     //json.jzhlx == '1+1+1'
//                     alert('您为RCC1+1+1患者,请与项目办热线进行联系');
//                 } else {
//                     if(count.count < 4) {
//                         alert('您为RCC1+1+1患者，未完全进入全部捐赠状态，请与项目办热线进行联系');
//                     }
//                 }
//             }
//         }
//     });
}

           
function lasjmsbs() {
	$val = $("#jbfzss").val();
	if($val == "不能耐受") {
		document.getElementById('lasjmsd').style.display='block';
	} else {
		document.getElementById('lasjmsd').style.display='none';
	}
}

//显示辉瑞公司随访
function PD() {
    $val = $("#pd").val();
    if($val == 'PD') {
        document.getElementById('yldsf').style.display='block';
    } else {
    	document.getElementById('yldsf').style.display='none';
    }
}

//医学条件诊断
function jbfz() {
    $val = $('#jbfzs').val();
    if($val == '不能耐受') {
        document.getElementById('xbzlsbkaos').style.display='block';
    } else {
    	document.getElementById('xbzlsbkaos').style.display='none';
    }
}

chooseDate('djrq', true); //首次登记日期
chooseDate('zhdrq', true); //诊断日期
chooseDate('ygShouciYongyaoRiqi', true);
chooseDate('stkshfyshj', true); //索坦开始服用日期
chooseDate('tbrq', true); //填表日期
chooseDate('pgtime2', true); //填表日期
chooseDate('quetime', true); //填表日期
chooseDate('zl1', true); //填表日期
chooseDate('zl2', true); //填表日期
function alertyes(){
	$val = $("#yxypname").val();
    if($val == '索坦') {
        $seltrue = confirm("是否接受过索坦患者援助项目（非1+1+1模式）");
        if($seltrue == true) {
            document.getElementById('sthsw').style.display='block';
        } else {
            document.getElementById('ttps').style.display='block';
        }
    } else {
    	document.getElementById('sthsw').style.display='none';
    	document.getElementById('ttps').style.display='none';
    }
}
function cblxxz(){ 
  //患者参保类型选择
  if($("#hzhcblx").val()!='无'&&$("#hzhcblx").val()!='现役军人医疗体系'&&$("#hzhcblx").val()!='贫困救助'&&$("#hzhcblx").val()!='商业医疗保险'&&$("#hzhcblx").val()!='全自费'&&$("#hzhcblx").val()!='其他社会保险'&&$("#hzhcblx").val()!='其他'){
    document.getElementById('cbdqxz').style.display='block';
  }else{
    document.getElementById('cbdqxz').style.display='none';
  }
}

function jspjnshr() {
	  //计算家庭平均年收入
	  var $roukou = $("#hzhjtrk");
	  var $nianshouru = $("#hzhjtnshr");
	  if (isNaN($nianshouru.val()))
	  $nianshouru.val("0");
	  if($nianshouru.val() == '' || $roukou.val() == '') {
	      return ;
	  }
	  var renjun = Number($nianshouru.val()) / Number($roukou.val());
	  $("#hzhjtpjnshr").text("人均收入：" + (String(renjun).indexOf(".") > -1 ? String(renjun).substr(0, String(renjun).indexOf(".")) : renjun) + "元/人");
}

function pdbtnr(v) {        /*alert("姓名不能为空。");*/
  //判断必填项
  //var hzhxm = $("#hzhxm").val();
  /*if(Xingming == "" ){alert("姓名不能为空。");return false;}
  if(hzhchshrq == ""){alert("出生日期不能为空。");return false;}
  if(hzhxingbie == ""){alert("请选择性别。");return false;}*/
  return true;
}
function SubmitCheck() {
  //提交验证
  if ($("#zhjlx").val() == "身份证" && !IsIdCard($("#zhjhm").val())) { 
    return false;  
  }
  //最新要求性别以下内容不填写可用录入
  /*if(!yzshj($("#shouji").val())){return false; }*/
  if(!pdbtnr('1')){return false; }

  if ($("#ZhixiQinshusJson").val() == "[]"&&$("#hzhjtrk").val()!='1'){
    if (!confirm("没有录入患者直系亲属信息。是否继续保存？")) {
      return false;
    }
  }
  /*var zhxiqshjson = eval($("#ZhixiQinshusJson").val()).length;
  if (zhxiqshjson != $("#zhjhm").val()-1){var zhxiqshjson = eval($("#ZhixiQinshusJson").val()).length;
    if (!confirm("录入患者直系亲属信息与家庭人口数量不符。是否继续保存？")) {
      return false;
    }
  }*/
  return true;
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
  if (isCheck && nshr < 0) {
    alert("年收入不能小于0。");
    return false;
  }
//  if(guanxi!='本人'){
    var zhxqshshchann='<td align=\'center\' bgcolor=\'#FFFFFF\'><a href=\'javascript:deltr(' + index + ')\'>删除</a>|<a href=\'javascript:xgltr(' + index + ')\'>修改</a></td>';
//  }else{
//    var zhxqshshchann='<td align=\'center\' bgcolor=\'#FFFFFF\'>删除</td>';
//  }
  $("#tr_action").before(
  "<tr id=" + index + ">" +
  "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + xingming + "</td>" +
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
      var hzhjtrjshr = hzhjtnshr/$rknshrjson.length;
      $("#hzhjtrjshr").val(hzhjtrjshr);
  }
}

//修改行
function xgltr(index) {
    var json = eval("(" + $("#ZhixiQinshusJson").val() + ")");
    for (var i = 0; i < json.length; i++) {
        if(index == json[i]['id']){
            var currentData = json[i];
        }
    }
    tjyzh(currentData)
}

function tjyzh(v){
    //当v为0的时候，执行关闭操作
    if(v == 0){
        document.getElementById('tjyzh').style.display='none';
        document.getElementById("submitBtn").disabled=false;
    }else{
        document.getElementById('tjyzh').style.display='block';
        document.getElementById("submitBtn").disabled=true;

        var html = "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                   "<input style=\'width:120px;\' type=\'text\' value=\'"+ v.姓名 +"\' id=\'current_xingming\' name=\'txtXingming\' class=\'grd-white\' />" +
                   "</td>"+
                   "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                   "<input type=\'text\' id=\'current_sfzh\' value=\'"+ v.公民身份号码 +"\' name=\'current_sfzh\' class=\'grd-white\' />" +
                   "</td>" +
                   "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                   "<input type=\'text\' id=\'current_jgzh\' value=\'"+ v.军官证 +"\'  name=\'current_jgzh\' class=\'grd-white\' />" +
                   "</td>" +
                   "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                       "<select Style=\'width:130px\' id=\'current_Guanxi\' name=\'current_Guanxi\' class=\'grd-white2\' >" +
                           "<option value=\'本人\'>本人</option>" +
                           "<option value=\'父亲\'>父亲</option>" +
                           "<option value=\'母亲\'>母亲</option>" +
                           "<option value=\'配偶\'>配偶</option>" +
                           "<option value=\'儿子\'>儿子</option>" +
                           "<option value=\'女儿\'>女儿</option>" +
                           "<option value=\'其他关系\'>其他关系</option>" +
                       "</select>" +
                   "</td>" +
                   "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                   "<input type=\'text\' value=\'"+ v.联系方式 +"\' id=\'current_lxfsh\' name=\'current_lxfsh\' class=\'grd-white\' />" +
                   "</td>" +
                   "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                   "<input  style=\'width:80px;\' value=\'"+ v.年收入 +"\' type=\'text\' id=\'current_nshr\' name=\'current_nshr\' class=\'grd-white\' />" +
                   "</td>" +
                   "<td align=\'center\' bgcolor=\'#FFFFFF\'>" +
                   "<input type=\'hidden\' id=\'current_id\' value=\'"+ v.id +"\' />" +
                   "<input type=\'button\' id=\'btnUpdate\' onclick='updateZhxiqinshu();\' value=\'修改\' class=\'uusub2\' />" +
                   "</td>";
        $("#update_zhixiqinshu").html(html);
        $("#current_Guanxi").find("option[value='"+ v.与患者关系 +"']").attr("selected",true);



    }
}

//修改直系亲属数据
function updateZhxiqinshu()
{
    var current_xingming = $("#current_xingming").val();
    var current_sfzh     = $("#current_sfzh").val();
    var current_jgzh     = $("#current_jgzh").val();
    var current_Guanxi   = $("#current_Guanxi").val();
    var current_lxfsh    = $("#current_lxfsh").val();
    var current_nshr     = $("#current_nshr").val();
    var current_id       = $("#current_id").val();

    var json = eval("(" + $("#ZhixiQinshusJson").val() + ")");
    for (var i = 0; i < json.length; i++) {
        if(current_id == json[i]['id']){
            json[i]['姓名'] = current_xingming;
            json[i]['公民身份号码'] = current_sfzh;
            json[i]['军官证'] = current_jgzh;
            json[i]['与患者关系'] = current_Guanxi;
            json[i]['联系方式'] = current_lxfsh;
            json[i]['年收入'] = current_nshr;
        }
    }

    $("#ZhixiQinshusJson").val(JSON.stringify(json));
    //清空当前列
    var $tr = $("#tb_ZhixiQinshus tr");
    var len = $tr.length;
    for (var i = 0; i < (json.length+len); i++) {
        $("tr[id=\'" + i + "\']").remove();
    }
    //关闭窗口
    tjyzh(0);
    InitZhixiQinshus();
    var $rknshrjson = eval($("#ZhixiQinshusJson").val());

    $("#hzhjtrk").val($rknshrjson.length);
    var hzhjtnshr=0;
    for (var i = 0; i < $rknshrjson.length; i++) {
        hzhjtnshr=parseInt(hzhjtnshr)+parseInt($rknshrjson[i]["年收入"]);
    }
    $("#hzhjtnshr").val(hzhjtnshr);
    var hzhjtrjshr = hzhjtnshr/$rknshrjson.length;
    $("#hzhjtrjshr").val(hzhjtrjshr);
}

    //页面加载后
$(function () {

  $("#zhjhm").blur(function(){
    //参保地区显示问题
    if($("#hzhcblx").val()!='无'&&$("#hzhcblx").val()!='现役军人医疗体系'){
    document.getElementById('cbdqxz').style.display='block';
    }else{
    document.getElementById('cbdqxz').style.display='none';
    }
    if($("#zhjlx").val()=="身份证"){
      if(IsIdCard($("#zhjhm").val())){
        var shfzhhm=$("#zhjhm").val();
        $('#hzhchshrq').val(shfzhhm.substring(6,10)+"-"+shfzhhm.substring(10,12)+"-"+shfzhhm.substring(12,14));
        if (parseInt(shfzhhm.substr(16, 1)) % 2 == 1) { 
          $("#hzhxb").empty();
          $("<option value=\"男\">男</option>").appendTo("#hzhxb");
        } else { 
          $("#hzhxb").empty();
          $("<option value=\"女\">女</option>").appendTo("#hzhxb");
        } 
      }
      $.post(  
        'shqglxzshqzhjhmtxac.php',  
        {
          zjhm:$('#zhjhm').val()
        },  
        function (data) { //回调click函数  
          $('#zhjhmtx').html(data);
        }  
      );
    }
    if($("#zhjlx").val()=="军官证"){

      $("#hzhxingbie").empty();
      $("<option value=\"男\">男</option><option value=\"女\">女</option>").appendTo("#hzhxingbie");
      chooseDateNownian('hzhchshrq', true); 
      $.post(  
        'shqglxzshqzhjhmtxac.php',  //验证患者是否存在改系统
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
    if($("#hzhnshr").val()<0){              //2014-07-07修改  患者年收入可以为0
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

  //post()方式  
  /*$('input[name="jzhlx"]').click(function (){ 
    var $shdi=$(this).val();
    //document.getElementById('shcyyrqqb').style.display='block';
    if($shdi=="部分"||$shdi=="原部分"||$shdi=="1+1+1"){
      $.post(  
      'shqglxzshqjzhshlac.php',  
      {
        cbdqshi:$('#cbdqs_city').val(),
        cblx:$('#hzhcblx').val(),
        //hzhhj:$("input[name='hzhhj']:checked").val()
        hzhhj:$('#hzhhj').val()
      },  
      function (data) { //回调click函数  
        $('#jzhshl').val(data);
      }  
      ); 
    }else {
      $('#jzhshl').val("12");
    }
  });*/

  //jspjnshr();
  //绑定提交验证
  $("input:submit").unbind("click");
  $("#submitBtn").bind("click", function () {

    var jtnshouru = $("#hzhjtnshr").val();
    if(jtnshouru==0){
      alert('患者家庭年收入为0');
    }

      //“医学条件评估”内涉及到四个时间需要有一定的次序，“治疗开始时间”>“英立达开始时间”>“评估时间”≥“本次就诊和填表日期”
      var zhiliaotime = new Date($("#zl1").val().replace("-","/").replace("-","/"));
      var zhdrq = new Date($("#zhdrq").val().replace("-","/").replace("-","/"));
      var pgtime = new Date($("#pgtime2").val().replace("-","/").replace("-","/"));
      var quetime = new Date($("#quetime").val().replace("-","/").replace("-","/"));

      if(zhiliaotime < zhdrq) {
          if(zhdrq < pgtime){
              if(pgtime <= quetime){
              }else{
                  alert("医学条件确认表填写时间不对");
                  return false;
              }
          } else {
              alert("医学条件确认表填写时间不对");
              return false;
          }
      } else {
          alert("医学条件确认表填写时间不对");
          return false;
      }


      if (SubmitCheck() && confirm("是否提交保存？")) {
      $("input:submit").attr("disabled", true);
      $("form").submit();
      return false;
    }
    
    return false;
  });
  $("input:submit").attr("disabled", false);

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
    var assignment = { "id":len, "姓名": txtXingming, "公民身份号码": txtShenfenzheng, "军官证": txtjgzh, "与患者关系": txtGuanxi, "联系方式": txtLianXiFangShi, "年收入": txtnshr };
    json.push(assignment);
    var str = JSON.stringify(json);
    $("#ZhixiQinshusJson").val(str);
      var $rknshrjson = eval($("#ZhixiQinshusJson").val());
      $("#hzhjtrk").val($rknshrjson.length);
      var hzhjtnshr=0;
      for (var i = 0; i < $rknshrjson.length; i++) {
         hzhjtnshr=parseInt(hzhjtnshr)+parseInt($rknshrjson[i]["年收入"]);
      }
      //alert($rknshrjson.length);
      $("#hzhjtnshr").val(hzhjtnshr);
      var hzhjtrjshr = hzhjtnshr/$rknshrjson.length;
      $("#hzhjtrjshr").val(hzhjtrjshr);
  });
});

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

//选择医院弹框
function qzyzh(v,i){
  //医生签字样张
  if(v==0){
    document.getElementById('qzyzh').style.display='none';
  }
  else{
    //v=yyqzyzh[$('#yshid').val()];
    v=$('#yshid').val();
    //alert(v);
    //i=yshshq[$('#shqyyid').val()];
    imgsrc=padLeft(v,3);
    document.getElementById('zhdyshyzh').src='./qzyzh/'+imgsrc+'-1.jpg';
    document.getElementById('zhdyshqzh').src='./qzyzh/'+imgsrc+'-2.jpg';
    document.getElementById('shouquanyishengyangzhang').src='./qzyzh/'+imgsrc+'-8.jpg';
    
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
      /* document.getElementById('qzyzhshq').style.display='none';
      $('#qzyzhshqysh').html(''); */
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