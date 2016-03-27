<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
//echo "清空前session：".$_SESSION['wshshqdrcode']; 
//unset($_SESSION["wshshqdrcode"]);
//echo "清空后session：".$_SESSION['wshshqdrcode']; 
//$wshshqdrcode = mt_rand(0,1000000);

if($_SESSION['wshshqdrcode']==''){
$_SESSION['wshshqdrcode'] =  strtotime(date('Y-m-d h:i:s'));//将此随机数暂存入到session
}   
//echo "当前session：".$_SESSION['wshshqdrcode']." 当前生成：".$wshshqdrcode;

include('newdb_yy.php');
$wshshqyym=preg_replace('/^0*/', '', $_GET['wshshqyym']);
$html_title="新增申请";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>

    <div class="insmain">
      <div class="thislink">当前位置：<a href="wshshqgl.php">网上申请管理</a>
        > <?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
<?php
  $sql = "select * from `hzh` where `id`='$wshshqyym'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <form action="wshshqglxzshqac.php" method="post">
        <fieldset>
            <legend>申请信息</legend>
            <div>
            <?php
  $hzhdzhsheng=$Record[7];
  $hzhdzhshi=$Record[8];
  $hzhdzhqu=$Record[9];
  $cbhzhdzhsheng=$Record[19];
  $cbhzhdzhshi=$Record[20];
  $cbhzhdzhqu=$Record[21];
  $shfydrxt=$Record[32];
  if($shfydrxt!=1){
            ?>
<input name="wshshqdrcode" type="hidden" value="<?php echo $_SESSION['wshshqdrcode'];?>" />
<input id="yyid" name="yyid" type="hidden" value="<?php echo $wshshqyym;?>" />
                <span class="label">姓名：</span><input class="grd-white" id="Xingming" name="Xingming" type="text" value="<?php echo $Record[2];?>" /><font color="red">*</font>
                <span class="label">证件类型：</span><select id="zhjlx" class="grd-white" name="zhjlx">
<option <?php if($Record[3]=="身份证"){echo "selected=\"selected\"";}?>  value="身份证">身份证</option>
<option <?php if($Record[3]=="军官证"){echo "selected=\"selected\"";}?> value="军官证">军官证</option>
</select> <input class="grd-white" id="ShenfenHaoma" name="ShenfenHaoma" type="text" value="<?php if($Record[4]!=""){echo $Record[4];}?>" /><font color="red">*</font><span style="color:red;" id="shfzhcztx" name="shfzhcztx"></span>
            </div>
            <div>
                <span class="label">申请病种：</span><select id="ShenqingBingzhongq" name="ShenqingBingzhongq" class="grd-white">
<option selected="selected" value="肺癌">肺癌</option>
</select><font color="red">*</font>
<span class="label">出生日期：</span><input  class="grd-white" id="hzhchshrq"  name="hzhchshrq"  readonly type="text" value="" /><font color="red">*</font></div>
<div><span class="label">性别：</span><select class="grd-white2" id="hzhxingbie" name="hzhxingbie"><option value="">--请选择--</option>
<option value="男">男</option>
<option value="女">女</option>
</select><font color="red">*</font></div>
            <div>
                <span class="label">申请的医院/医生：</span><select id="ShenqingYishengId" name="ShenqingYishengId" class="grd-white2" style="width: 500px;">

<?php        
  Mysql_select_db("CFCSYSTEM");
    $shqyysql = "select id,shengjx,sheng,yymch,zhdysh from `yyyshdq` where `yhszht`='1' and `id`='".$Record[23]."' order by shengjx ASC";

    $shqyyQuery_ID = mysql_query($shqyysql);
    while($shqyyRecord = mysql_fetch_array($shqyyQuery_ID)){
      echo "<option value=\"".$shqyyRecord[0]."\"> ".$shqyyRecord[1]." ".$shqyyRecord[2]." ".$shqyyRecord[3]." ".$shqyyRecord[4]."</option>";
    }
    Mysql_select_db("cfcwshshq");
?>    
</select>*
</div>
            
            <div>
                <span class="label">患者通讯住址：</span><select id="s_province" name="sheng" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_city" name="shi" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_county" name="qu" class="grd-white2"></select>*
    <script class="resources library" src="js/area.js" type="text/javascript"></script>
    
    <script type="text/javascript">_init_area();</script>

</div>
            <div>
                <span class="label">街道地址：</span><input  class="grd-white" id="Zhuzhi" name="Zhuzhi" style="width:50%" type="text" value="<?php if($Record[10]!=""){echo $Record[10];}?>" />*
            </div>
            <div>
<script>  
function yzshj(v){  
var a = /^((\(\d{3}\))|(\d{3}\-))?13\d{9}|15\d{9}|18\d{9}|14\d{9}$/ ;  
if( v.length!=11||!v.match(a) ){  
  alert("手机号错误!");
  return false;
}else{return true;}  
}  
</script>
                <span class="label">手机：</span><input  class="grd-white" id="shouji" name="shouji" type="text" value="<?php if($Record[11]!=""){echo $Record[11];}?>"  onblur="yzshj(this.value)"/>*
                <span class="label">联系电话1：</span><input  class="grd-white" id="dianhua2" name="dianhua2" type="text" value="<?php if($Record[12]!=""){echo $Record[12];}?>" />
                <span class="label">联系电话2：</span><input  class="grd-white" id="dianhua3" name="dianhua3" type="text" value="<?php if($Record[13]!=""){echo $Record[13];}?>" />
            </div>
            <div>
                <span id="span_Zhengduan"><span class="label">诊断类型：</span><input checked="true" id="Zhengduan_0" name="Zhengduan" type="radio" value="局部晚期"></input><label for="Zhengduan_0">局部晚期</label> <input id="Zhengduan_1" name="Zhengduan" type="radio" value="转移"></input><label for="Zhengduan_1">转移</label> *</span>
            </div>
            <div>
                <span class="label">户籍类型：</span><select name="hzhhj" id="hzhhj" class="grd-white2">
						  <option <?php if($Record[14]=='非农业户口'){echo "selected=\"selected\"";}?> value="非农业户口">非农业户口</option>
						  <option <?php if($Record[14]=='农业户口'){echo "selected=\"selected\"";}?> value="农业户口">农业户口</option>
						</select>*
                <span class="label">家庭人口：</span><select id="JiatingRenkou" name="JiatingRenkou" class="grd-white2">
<?php
for($i=1;$i<20;$i++)
{
echo "<option ";
if($Record[15]==$i)
{echo "selected=\"selected\"";}
echo"value=\"$i\">$i</option>";
}
?>
</select>*
                家庭年收入：<input  class="grd-white" id="NianShouru" name="NianShouru" style="width:100px" type="text" value="<?php if($Record[16]!=''){echo $Record[16];}else {echo "0";}?>" />元*
                <span style="width: 180px; color: Green;" id="span_pinjunshouru"></span>
            </div>
            <div>
                <span class="label">参保类型：</span><select name="CanBaoLeiXing" id="CanBaoLeiXing" style="width:100px" class="grd-white2" onchange="cblxxz()">
                
						  <option <?php if($Record[18]=='无'){echo "selected=\"selected\"";}?> value="无">无</option>
						  <option <?php if($Record[18]=='城镇职工（含离退休人员）医疗保险'){echo "selected=\"selected\"";}?> value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
						  <option <?php if($Record[18]=='城镇居民医疗保险'){echo "selected=\"selected\"";}?> value="城镇居民医疗保险">城镇居民医疗保险</option>
						  <option <?php if($Record[18]=='新农合医疗保险'){echo "selected=\"selected\"";}?> value="新农合医疗保险">新农合医疗保险</option>
						  <option <?php if($Record[18]=='公费医疗'){echo "selected=\"selected\"";}?> value="公费医疗">公费医疗</option>
						  <option <?php if($Record[18]=='现役军人医疗体系'){echo "selected=\"selected\"";}?> value="现役军人医疗体系">现役军人医疗体系</option>
						</select>*
<div  id="cbdqxz" Style="display:none;">
                参保地区：<select id="cbdqs_province" class="grd-white2" name="cbdqsheng"></select>&nbsp;&nbsp;
    <select id="cbdqs_city" name="cbdqshi" class="grd-white2"></select>*
    <script class="resources library" src="js/areaa.js" type="text/javascript"></script>
    
    <script type="text/javascript">_init_areaa();</script>
            </div>
            </div>
            <div>
                <span class="label">捐助类型：</span><input id="jzhlx" name="jzhlx" type="radio" value="全部"></input><label for="jzhlx">全部</label> <input id="jzhlx" name="jzhlx" type="radio" value="部分"></input><label for="jzhlx">部分</label> *
                <span class="label">捐赠数量：</span><input  class="grd-white" id="JuanZengShuLiang" name="JuanZengShuLiang" style="width:18px" type="text" value="" readonly />瓶*
            </div>
            <div>
                <span class="label">用药剂量：</span><select id="YongYaoJiLiang" name="YongYaoJiLiang" class="grd-white2"><option <?php if($Record[27]=='250mg*60粒/瓶'){echo "selected=\"selected\"";}?> value="250mg*60粒/瓶">250mg*60粒/瓶</option>
<option <?php if($Record[27]=='200mg*60粒/瓶'){echo "selected=\"selected\"";}?> value="200mg*60粒/瓶">200mg*60粒/瓶</option>
</select>*
                <span class="label">用法：</span><select id="YongYaoFangFao" name="YongYaoFangFao" class="grd-white2" onchange="showText()"><option <?php if($Record[26]=='2粒/天*30天'){echo "selected=\"selected\"";}?> value="2粒/天*30天">2粒/天*30天</option>
<option <?php if($Record[26]!='2粒/天*30天'){echo "selected=\"selected\"";}?> value="其他">其他</option>
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
<div <?php if($Record[26]!='2粒/天*30天'&&$Record[26]!=''){echo "style=\"display:block;\"";}else{echo "style=\"display:none;\"";}?> id="textValue">
<span class="label" >其他说明：</span><input  class="grd-white" id="qtshm" name="qtshm" style="width:300px;" type="text" value="<?php if($Record[26]!='2粒/天*30天'&&$Record[26]!=''){echo $Record[26];}?>" /></div>
                <span style="width: 180px; color: Red;" id="span_Yichang"></span><span style="width: 180px; color: Green;" id="span_JuanzhuShuliang"></span>
            </div>
            <div>
            <?php 
            /*
                <!--span class="label" style="width: 150px">项目申请信息表日期：</span><input  class="grd-white" id="XiangmuShenqingXinxiBiaoRiqi" name="XiangmuShenqingXinxiBiaoRiqi" type="text" value=""  readonly /--->
                <span class="label" style="width: 160px">首次申请材料登记日期：</span><input  class="grd-white" id="djrq" name="djrq" type="text" value="<?php echo date('Y-m-d');?>"  readonly />*
                
                <!--div id="shcyyrqqb">
                <span class="label" style="">首次用药日期：</span><input  class="grd-white" id="ShouciYongyaoRiqi" name="ShouciYongyaoRiqi" readonly type="text" value="" />
                <span class="label" style="width:180px;">预估首次赠药用药日期：</span><input  class="grd-white" id="ygShouciYongyaoRiqi1" name="ygShouciYongyaoRiqi" readonly type="text" value="" />  首次用药日期 不记录了 id="ygshcyyrqqb" style="display:none;"
                </div--> */
             ?>  
                <div >
                <span class="label" style="width: 180px">预估首次赠药用药日期：</span><input  class="grd-white" id="ygShouciYongyaoRiqi2" readonly name="ygShouciYongyaoRiqi" type="text" value="<?php
                if($Record[25]!=""){
echo date('Y-m-d',strtotime('+120 day',strtotime($Record[25])));
}
?>" />
                </div>
            </div>
        </fieldset>
        <fieldset class="top">
            <legend>直系亲属*</legend>
            <input id="ZhixiQinshusJson" name="ZhixiQinshusJson" type="hidden" value="[<?php
             Mysql_select_db("cfcwshshq");
$qshsql = "select * from `zhxqsh` where hzhid='".$wshshqyym."'";
$qshQuery_ID = mysql_query($qshsql);
$num=mysql_num_rows($qshQuery_ID);
$i=1;
while($qshRecord = mysql_fetch_array($qshQuery_ID)){

?>{
    &quot;姓名&quot;: &quot;<?php echo $qshRecord[2];?>&quot;,
    &quot;公民身份号码&quot;: &quot;<?php echo $qshRecord[3];?>&quot;,
    &quot;军官证&quot;: &quot;<?php echo $qshRecord[7];?>&quot;,
    &quot;与患者关系&quot;: &quot;<?php echo $qshRecord[4];?>&quot;,
    &quot;联系方式&quot;: &quot;<?php echo $qshRecord[6];?>&quot;
  }<?php if($i!=$num){echo ",";}
  $i++;
}
Mysql_select_db("cfcwshshq");
?>]" />
            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                <tr style="color:#1f4248; font-weight:bold; height:30px;">
                    <td align="center" bgcolor="#FFFFFF">
                        姓名
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        身份号码
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        军官证
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        与患者关系
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        联系方式
                    </td>                    
                    <td align="center" bgcolor="#FFFFFF">
                        操作
                    </td>
                </tr>
                <tr style="color:#1f4248; font-size:12px;" id="tr_action">
                    <td align="center" bgcolor="#FFFFFF">
                        <input type="text" class="grd-white" id="txtXingming" name="txtXingming" />
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        <input type="text" class="grd-white" id="txtShenfenzheng" name="txtShenfenzheng" />
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        <input type="text" class="grd-white" id="txtjgzh" name="txtjgzh" />
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        <select class="grd-white2" Style="width:130px" id="txtGuanxi" name="txtGuanxi"><option selected="selected" value="父亲">父亲</option>
<option value="母亲">母亲</option>
<option value="配偶">配偶</option>
<option value="儿子">儿子</option>
<option value="女儿">女儿</option>
<option value="其他关系">其他关系</option>
</select>
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        <input type="text" class="grd-white" id="txtLianXiFangShi" name="txtLianXiFangShi" />
                    </td>
                    <td align="center" bgcolor="#FFFFFF">
                        <input type="button" id="btnAdd" value="添加" class="uusub2" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <?php 
        }
        $shfczshq=1;
        }
          if($shfydrxt!=1&&$shfczshq==1){
        ?>
        <fieldset class="top">
            <legend>医学条件评估</legend>
            <div>
                <span class="label" style="width: 180px;">临床诊断：</span><select id="lchzhd" class="grd-white" name="lchzhd" onchange="showpgText()"  style="width: 500px;">
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
<span class="label"  style="width: 180px;">其他说明：</span><input  class="grd-white" id="qtlchzhd" name="qtlchzhd" style="width:300px;" type="text" value="" /></div>
            </div>
            <div>
                <span class="label" style="width: 180px;">诊断日期：</span><input  class="grd-white" id="zhdrq"  name="zhdrq"  readonly type="text" value="" />*
                <span class="label" style="width: 180px;">肿瘤病理类型：</span><select id="zhlbl" class="grd-white" name="zhlbl"onchange="showlxText()"><option selected="selected"  value="">--请选择--</option>
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
<span class="label"  style="width: 180px;">其他说明：</span><input  class="grd-white" id="qtzhlbl" name="qtzhlbl" style="width:300px;" type="text" value="" /></div>
</div>
<div><span class="label" style="width: 180px;">分期：</span><select id="fq" name="fq" class="grd-white" onchange="showfqText()">
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
                <span class="label" style="width: 180px;">ALK检测：</span><select id="alkjc" class="grd-white" name="alkjc" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="阳性">阳性</option>
    <option value="阴性">阴性</option>  
</select>*
</div>
            <div>
                <span class="label" style="width: 180px;">ALK诊断方法：</span><select id="alkzhdff" class="grd-white" name="alkzhdff" style="width: 500px;">
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
                <span class="label" style="width: 180px;">赛可瑞开始治疗时间：</span><input  class="grd-white" id="skrkshzhlshj"  name="skrkshzhlshj"  readonly type="text" value="" />*
                <span class="label" style="width: 180px;">赛可瑞治疗疗程：</span><input  class="grd-white" id="skrzhllch" name="skrzhllch" type="text" value=""/> 月*
            </div>
            <div>
                <span class="label" style="width: 180px;">赛可瑞治疗效果(RECIST 标准)评估：</span><select id="skrzhlxgpg" class="grd-white" name="skrzhlxgpg" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="未用药">未用药</option>
    <option value="CR">CR</option>
    <option value="PR">PR</option>  
    <option value="SD">SD</option>  
    <option value="PD">PD</option>  
</select>
            </div>
            <div>
                <span class="label" style="width: 180px;">出现无法耐受的副作用：</span><select id="chxwfnshdfzy" class="grd-white" name="chxwfnshdfzy" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="未用药">未用药</option>
    <option value="是">是</option>
    <option value="否">否</option>  
</select>
            </div>
            <div>
                <span class="label"  style="width: 180px;">是否应该继续赛可瑞治疗：</span><select id="shfygjxskrzhl" class="grd-white" name="shfygjxskrzhl" style="width: 500px;">
<option selected="selected" value="">--请选择--</option>
    <option value="是">是</option>
    <option value="否">否</option>  
</select>
            </div>

        </fieldset>
        <div class="top">
            <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
        </form></div>

              </td>
            </tr>
          </table>     
        </div>
      </div>
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
                    "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + xingming + "</td>" +
                    "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + shenfenzheng + "</td>" +
                    "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + jgzh + "</td>" +
                    "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + guanxi + "</td>" +
                    "<td align=\'center\' bgcolor=\'#FFFFFF\'>" + lianxidianhua + "</td>" +
                    "<td align=\'center\' bgcolor=\'#FFFFFF\'><a href=\'javascript:deltr(" + index + ")\'>删除</a></td></tr>");
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
           /* var shfzhhm=$("#ShenfenHaoma").val();
    $('#hzhchshrq').val(shfzhhm.substring(6,10)+"-"+shfzhhm.substring(10,12)+"-"+shfzhhm.substring(12,14));
if (parseInt(shfzhhm.substr(16, 1)) % 2 == 1) { 
$("#hzhxingbie").empty();
$("<option value=\"男\">男</option>").appendTo("#hzhxingbie");
} else { 
$("#hzhxingbie").empty();
$("<option value=\"女\">女</option>").appendTo("#hzhxingbie");
} */

         $("#s_province option[value='省份']").text("<?php echo $hzhdzhsheng;?>");
          $("#s_province option[value='省份']").val("<?php echo $hzhdzhsheng;?>");
          $("#s_city option[value='地级市']").text("<?php echo $hzhdzhshi;?>");        
          $("#s_city option[value='地级市']").val("<?php echo $hzhdzhshi;?>");        
          $("#s_county option[value='市、县级市']").text("<?php echo $hzhdzhqu;?>");
          $("#s_county option[value='市、县级市']").val("<?php echo $hzhdzhqu;?>");
         $("#cbdqs_province option[value='省份']").text("<?php echo $cbhzhdzhsheng;?>");
          $("#cbdqs_province option[value='省份']").val("<?php echo $cbhzhdzhsheng;?>");
          $("#cbdqs_city option[value='地级市']").text("<?php echo $cbhzhdzhshi;?>");        
          $("#cbdqs_city option[value='地级市']").val("<?php echo $cbhzhdzhshi;?>");        
          /*$("#cbdqs_county option[value='市、县级市']").text("<?php echo $cbhzhdzhqu;?>");
          $("#cbdqs_county option[value='市、县级市']").val("<?php echo $cbhzhdzhqu;?>");*/
          //$("#ShenfenHaoma").blur(function(){
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
          if($("#zhjlx").val()!="身份证"){
 //alert("军官证");
$("#hzhxingbie").empty();
$("<option value=\"男\">男</option><option value=\"女\">女</option>").appendTo("#hzhxingbie");


  $.post(  
    'shqglxzshqzhjhmtxac.php',  
    {
      zjhm:$('#ShenfenHaoma').val()
    },  
    function (data) { //回调click函数  
      $('#shfzhcztx').html(data);
    }  
  );
              if(1===1){
          chooseDateNownian('hzhchshrq', true);}
    
    }
          //});
          
        /*$("#s_province option[value='省份']").text("sdaf");        
        $("#s_province option[value='省份']").val("sdaf");*/


          
            chooseDateNow('ShouciYongyaoRiqi', true);
            chooseDateNow('XiangmuShenqingXinxiBiaoRiqi', true);
            //chooseDateNow('hzhchshrq', true);
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
    </script><?php
    }else{echo '该患者已导入系统或不存在！';}
    ?>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>