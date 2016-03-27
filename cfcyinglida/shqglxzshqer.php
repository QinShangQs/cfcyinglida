<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqid=$_GET['id'];
if($shqid!=""&&$shqid>0){
$html_title="新增申请";
include('spap_head.php');
$sql = "select * from `hzh` where `id`='$shqid'";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title."(".$Record[7].")";?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <form action="shqglxzshqac.php" method="post">
<input id="rzer" name="rzer" type="hidden" value="2" />
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
        <fieldset class="incontact flt">
            <legend>申请信息</legend>
<div class="insinsins" style="width:100%;">
  <label>姓名：</label><span>
  <input class="grd-white" id="hzhxm" name="hzhxm" type="text" value="<?php echo $Record[4];?>" /><font color="red">*</font></span>
  <label>证件类型：</label><span>
    <select class="grd-white2" id="zhjlx" name="zhjlx">
      <option <?php if($Record[5]=="身份证"){echo 'selected="selected"';}?> value="身份证">身份证</option>
      <option <?php if($Record[5]=="军官证"){echo 'selected="selected"';}?>  value="军官证">军官证</option>
    </select>
    <input class="grd-white" id="zhjhm" name="zhjhm" type="text" value="<?php echo $Record[6];?>" /><font color="red">*</font>
    <span style="color:red;" id="zhjhmtx" name="zhjhmtx"></span>
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>申请病种：</label><span>
  <select class="grd-white2" id="shqlx" name="shqlx">
    <option selected="selected" value="<?php echo $Record[7];?>"><?php echo $Record[7];?></option>
  </select><font color="red">*</font>
  </span>
  <label>出生日期：</label><span>
    <input class="grd-white" id="hzhchshrq"  name="hzhchshrq"  readonly type="text" value="<?php echo $Record[38];?>" /><font color="red">*</font>
  </span>
  <label>性别：</label><span>
  <select class="grd-white2" id="hzhxb" name="hzhxb"><option value="">--请选择--</option>
    <option <?php if($Record[37]=="男"){echo 'selected="selected"';}?>  value="男">男</option>
    <option <?php if($Record[37]=="女"){echo 'selected="selected"';}?>   value="女">女</option>
  </select><font color="red">*</font>
  </span>
</div>
<?php
if($Record[12]!=""){
  $dqysh=$Record[12];
}else if($Record[11]!=""){
  $dqysh=$Record[11];
}else if($Record[9]!=""){
  $dqysh=$Record[9];
}

    $dqyshsql = "select * from `yyyshdq` where `id`='".$dqysh."'";
    $dqyshquery = mysql_query($dqyshsql);
    while($dqyshRecord = mysql_fetch_array($dqyshquery)){
      $dqyshsheng = $dqyshRecord[1];
      $dqyshshi = $dqyshRecord[24];
      $dqyshyy = $dqyshRecord[3].' '.$dqyshRecord[6];
    } 
?>
<!--  07-14徐勤杰修改 开始 -->
<div class="insinsins" style="width:100%;">
<label>选择医生省：</label>
<span><select class="grd-white2" id="shengid" name="shengid">
    <option value="<?php echo $dqyshsheng;?>"><?php echo $dqyshsheng;?></option>
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
    <option value="<?php echo $dqyshshi;?>" select="selected"><?php echo $dqyshshi;?></option>
    </select>
  </span>
  <label>医院/医生：</label>
    <span><select class="grd-white2" id="yshid" name="shqyyid" onchange="qzyzh()">
    <option value="<?php echo $dqysh;?>"><?php echo $dqyshyy;?></option>
  
  </select>
  </span>
  <label>药房名称：</label>
  <span><select class="grd-white2" id="yfid" name="shqyfid">
  <option value="<?php echo $Record[36];?>"><?php echo $Record[36];?></option>
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
    /*$sql = "select id,shengjx,sheng,yymch,zhdysh,zhdyshyzh,shqysh1,shqysh2,shqysh3 from `yyyshdq` where `yhszht`='1' order by shengjx ASC";
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
    }*/
?>  
  </select>* 
  </span>
</div-->
<div class="insinsins" style="width:100%;">
  <label>街道地址：</label><span>
    <input class="grd-white" id="jddzh" name="jddzh" style="width:500px" type="text" value="<?php echo $Record[14];?>" />*
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
    <input class="grd-white" id="shj" name="shouji" type="text" value="<?php echo $Record[15];?>"  onblur="yzshj(this.value)"/>*
  </span>
  <label>联系电话1：</label><span>
  <input class="grd-white" id="dh1" name="dianhua2" type="text" value="<?php echo $Record[16];?>" />
  </span>
  <label>联系电话2：</label><span>
  <input class="grd-white" id="dh2" name="dianhua3" type="text" value="<?php echo $Record[17];?>" />
  </span>
  <label>联系电话3：</label><span>
  <input class="grd-white" id="dh3" name="dh3" type="text" value="<?php echo $Record[51];?>" />
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>户籍类型：</label><span>
    <select class="grd-white2" name="hzhhj" id="hzhhj">
      <option <?php if($Record[19]=="非农业户口"){echo 'selected="selected"';}?>  value="非农业户口">非农业户口</option>
      <option <?php if($Record[19]=="农业户口"){echo 'selected="selected"';}?>  value="农业户口">农业户口</option>
    </select>*
  </span>
  <label>患者年收入：</label><span>
    <input class="grd-white" style="width: 60px; " id="hzhnshr" name="hzhnshr"  type="text" value="<?php echo $Record[52];?>" onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" />元*
  </span>
  <label>家庭人口：</label><span>
    <input class="grd-white" style="width: 60px; " id="hzhjtrk" name="hzhjtrk"  type="text" value="<?php echo $Record[20];?>" readonly />*
  </span>
  <label>家庭年收入：</label><span>
    <input class="grd-white" id="hzhjtnshr" name="hzhjtnshr" readonly type="text" value="<?php echo $Record[21];?>" />元*
  </span><span style="width: 180px; color: Green;" id="hzhjtpjnshr"></span>
</div>
<div class="insinsins" style="width:100%;">
  <label>参保类型：</label><span>
    <select class="grd-white2" name="hzhcblx" id="hzhcblx" style="width:100px" onchange="cblxxz()">
      <option <?php if($Record[23]=="无"){echo 'selected="selected"';}?>  value="无">无</option>
      <option <?php if($Record[23]=="城镇职工（含离退休人员）医疗保险"){echo 'selected="selected"';}?>  value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
      <option <?php if($Record[23]=="城镇居民医疗保险"){echo 'selected="selected"';}?>  value="城镇居民医疗保险">城镇居民医疗保险</option>
      <option <?php if($Record[23]=="新农合医疗保险"){echo 'selected="selected"';}?>  value="新农合医疗保险">新农合医疗保险</option>
      <option <?php if($Record[23]=="公费医疗"){echo 'selected="selected"';}?>  value="公费医疗">公费医疗</option>
      <option <?php if($Record[23]=="现役军人医疗体系"){echo 'selected="selected"';}?>  value="现役军人医疗体系">现役军人医疗体系</option>
      <option <?php if($Record[23]=="贫困救助"){echo 'selected="selected"';}?>  value="贫困救助">贫困救助</option>
      <option <?php if($Record[23]=="商业医疗保险"){echo 'selected="selected"';}?>  value="商业医疗保险">商业医疗保险</option>
      <option <?php if($Record[23]=="全自费"){echo 'selected="selected"';}?>  value="全自费">全自费</option>
      <option <?php if($Record[23]=="其他社会保险"){echo 'selected="selected"';}?>  value="其他社会保险">其他社会保险</option>
      <option <?php if($Record[23]=="其他"){echo 'selected="selected"';}?>  value="其他">其他</option>
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
    <input id="jzhlx" name="jzhlx" type="radio" value="全部" <?php if($Record[25]=="全部"){echo 'checked';}?> /><label for="jzhlx">全部</label>
    <?php if($Record[7]=='RCC'){?>
    <input id="jzhlx" name="jzhlx" type="radio" value="原部分" <?php if($Record[25]=="原部分"){echo 'checked';}?> /><label for="jzhlx">原部分</label>
    <input id="jzhlx" name="jzhlx" type="radio" value="1+1+1" <?php if($Record[25]=="1+1+1"){echo 'checked';}?> /><label for="jzhlx">1+1+1</label>
    <?php 
    }else{
    ?>
    <input id="jzhlx" name="jzhlx" type="radio" value="部分" <?php if($Record[25]=="部分"){echo 'checked';}?> /><label for="jzhlx">部分</label>
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
<div class="insinsins" style="width:100%;">
  <label>用法：</label><span>
    <select class="grd-white2" id="yfjl" name="yfjl">
      <option <?php if($Record[28]=="12.5mg"){echo 'selected="selected"';}?>  value="12.5mg">12.5mg</option>
      <option <?php if($Record[28]=="25mg"){echo 'selected="selected"';}?>  value="25mg">25mg</option>
      <option <?php if($Record[28]=="37.5mg"){echo 'selected="selected"';}?>  value="37.5mg">37.5mg</option>
      <option <?php if($Record[28]=="50mg"){echo 'selected="selected"';}?>  value="50mg">50mg</option>
      <option <?php if($Record[28]=="62.5mg"){echo 'selected="selected"';}?>  value="62.5mg">62.5mg</option>
      <option <?php if($Record[28]=="75mg"){echo 'selected="selected"';}?>  value="75mg">75mg</option>
      <option <?php if($Record[28]=="87.5mg"){echo 'selected="selected"';}?>  value="87.5mg">87.5mg</option>
      <option <?php if($Record[28]=="100mg"){echo 'selected="selected"';}?>  value="100mg">100mg</option>
    </select>*
    <?php $ypyl=explode(',',$Record[29]);?>
    <select class="grd-white2" id="yfcsh" name="yfcsh">
      <option <?php if(in_array('Qid',$ypyl)){echo 'selected="selected"';}?> value="Qid">Qid</option>
      <option <?php if(in_array('Bid',$ypyl)){echo 'selected="selected"';}?>  value="Bid">Bid</option>
      <option <?php if(in_array('Tid',$ypyl)){echo 'selected="selected"';}?>  value="Tid">Tid</option>
    </select>*
    <select class="grd-white2" id="yfzhq" name="yfzhq">
      <option <?php if(in_array('2/4',$ypyl)){echo 'selected="selected"';}?>  value="2/4">2/4</option>
      <option <?php if(in_array('连续服用',$ypyl)){echo 'selected="selected"';}?>  value="连续服用">连续服用</option>
    </select>*
  </span>
</div>
<div class="insinsins" style="width:100%;">
  <label>首次申请材料登记日期：</label><span>
    <input class="grd-white" id="djrq" name="djrq" type="text" value="<?php echo $Record[43];?>"  readonly />*
  </span>
</div>
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
				<strong>直系亲属</strong><span></span>
				</div>
        <div class="incontact w955 flt">
<input id="ZhixiQinshusJson" name="ZhixiQinshusJson" type="hidden" value="[<?php
$qshsql = "select * from `zhxqsh` where `hzhid`='".$shqid."' and `gxzf`='1'";
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
				<div class="title w977 flt top">
				<strong>医学条件评估</strong><span></span>
				</div>
        <div class="incontact w955 flt">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td>

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
                        <!-- <div class="insinsins" style="width:100%;"> -->
                        <!--     <label>指定医生/授权医生签字：</label> -->
                        <!--     <input type="text" name="docname"/> -->
                        <!-- </div> -->
                        <label>本次就诊和填表日期：</label>
                        <input class="grd-white" id="quetime"  name="start_time"  readonly type="text" value="" />

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
      <td width="70%" bgcolor="#FFFFFF" align="center"><img id="zhdyshyzh" width="100"/><img id="zhdyshqzh" width="100"/></td>
    </tr>

    <tr id="qzyzhshq" style="display:none;">
      <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生<br/><span id='shqyshxsh'></span></td>
      <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
    </tr>
  </table>
</div>
<script type="text/javascript">
 
chooseDate('djrq', true); //首次登记日期
chooseDate('zhdrq', true); //诊断日期
chooseDate('ygShouciYongyaoRiqi', true);
chooseDate('stkshfyshj', true); //索坦开始服用日期
chooseDate('tbrq', true); //填表日期
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
  var $roukou = $("#JiatingRenkou");
  var $nianshouru = $("#NianShouru");
  if (isNaN($nianshouru.val()))
  $nianshouru.val("0");
  var renjun = Number($nianshouru.val()) / Number($roukou.val());
  $("#hzhjtnshr").text("人均收入：" + (String(renjun).indexOf(".") > -1 ? String(renjun).substr(0, String(renjun).indexOf(".")) : renjun) + "元/人");
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
  if(guanxi!='本人'){
    var zhxqshshchann='<td align=\'center\' bgcolor=\'#FFFFFF\'><a href=\'javascript:deltr(' + index + ')\'>删除</a></td>';
  }else{
    var zhxqshshchann='<td align=\'center\' bgcolor=\'#FFFFFF\'>删除</td>';
  }
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
  }
}

//页面加载后
$(function () {
$("#cbdq_province option[value='省份']").text("<?php echo $Record[24];?>");
$("#cbdq_province option[value='省份']").val("<?php echo $Record[24];?>");
$("#cbdq_city option[value='地级市']").text("<?php echo $Record[39];?>");        
$("#cbdq_city option[value='地级市']").val("<?php echo $Record[39];?>");        
$("#cbdq_county option[value='市、县级市']").text("<?php echo $Record[40];?>");
$("#cbdq_county option[value='市、县级市']").val("<?php echo $Record[40];?>");

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
    //if("#shouji")
    var jtnshouru = $("#hzhjtnshr").val();
    //alert(jtnshouru);
    if(jtnshouru==0){
      alert('患者家庭年收入为0');
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
      //alert($rknshrjson.length);
      $("#hzhjtnshr").val(hzhjtnshr);
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


function qzyzh(v,i){
   //alert('aaaaa');
  //医生签字样张
  if(v==0){
    document.getElementById('qzyzh').style.display='none';
  }
  else{
    v=yyqzyzh[$('#yshid').val()];
    //alert(v);
    i=yshshq[$('#shqyyid').val()];
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
}
}else{
echo "错误!返回重新登录！ <a href=\"/\">登陆</a>";exit();
}
?>