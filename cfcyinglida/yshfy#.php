<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="药品发放";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置：<a href="yshfygl.php">发药管理</a> > <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong>发药内容</strong>
    </div>
    <div class="incontact w955 flt">

        <form action="yshfyac.php" method="post">
<?php
  $hzhid = $_GET['id'];
  $sql = "select * from `hzh` where `id`='$hzhid'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $ygshcyyjshrqq=mysql_query("SELECT ygshcyyjshrq FROM `zyff` where `hzhid`='".$Record[0]."' order by `id` desc limit 0,1");
  while($ygshcyyjshrqs = mysql_fetch_array($ygshcyyjshrqq)){
  $ygshcyyjshrq=$ygshcyyjshrqs[0];}
  $hzhzjhm=$Record[5].$Record[6];
?>
        <div>
            患者姓名:<?php echo $Record[4];?>&nbsp;患者编码:X-<?php echo $Record[2];?>&nbsp;患者病种:<?php echo $hzhshqbzh=$Record[7];?>&nbsp;已领药<?php 
            $hzhzhjlxhm=$Record[5].":".$Record[6];
            $hzhzhjlx=$Record[5];
            $hzhzhjhm=$Record[6];
            $hzhjzhshl=$Record[26];
            
$lynumq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$Record[0]."' and `tshqk`<>'1'");
$lynum = mysql_num_rows($lynumq);//获取总条数
            echo $lynum;?>次
            , 已领<?php 
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){
  if($lyshlnum[0]!=""){$ylypsh=$lyshlnum[0];}else{$ylypsh="0";}}
  echo $ylypsh;
            ?>瓶  </div>
        <script type="text/javascript" src="js/jquery.alerts.js"
            charset="gb2312"></script>
            <input type="hidden" name="zhshrzrq" value="<?php echo $Record[34];?>"><input type="hidden" name="bzh" value="<?php echo $Record[7];?>"><input type="hidden" name="rzyy" value="<?php echo $Record[11];?>">
            <input type="hidden" name="hzxm" id="hzxm" value="<?php echo $Record[4];?>">

<?php
}

$fycode = mt_rand(0,1000000);
$_SESSION['fycode'] = $fycode;      //将此随机数暂存入到session

//if($hzhshqbzh=='RCC'&&$lynum<='3'){
if(1==1){
?>
<div class="top">
  <table id="yongyaoTable" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <tr style="color:#1f4248; font-weight:bold; height:30px;">
    <td width="180" align="center" bgcolor="#FFFFFF">申请手册：<input type="radio" name="shqshc" value="是" id="shqshc" onclick="shqshouce();">是</td><td width="90" align="center" bgcolor="#FFFFFF"><span id="shcshl" style="display:none">数量：<input type="text" name="shouceshl" class="grd-white" value="" id="shqshouceshl" onblur="shqshcshl();"><span></td>
  </tr>
    <tr style="color:#1f4248; font-weight:bold; height:30px;">
      <td width="180" align="center" bgcolor="#FFFFFF" colspan="6">发票验证</td>
    </tr>
    <tr style="color:#1f4248; font-size:12px;">
    <form action="yzhfp.php" method="post" name="">
      <td align="center" bgcolor="#FFFFFF" colspan="3">发票号码：<input name="hzhjhfph" id="hzhjhfph" class="grd-white" style="width:180px;" value=""/><span id="yahjg"></span> <input type="button"  onclick="yzhfp();" value="验证" class="uusub2" /></td>
      </form>
    </tr>
  </table>
</div>
<?php
}

?>

<input name="id" type="hidden" value="<?php echo $hzhid;?>" />
<input name="fycode" type="hidden" value="<?php echo $fycode;?>" />
<div class="top">
        <table id="yongyaoTable" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="180" align="center" bgcolor="#FFFFFF">
                    发药剂量与数量                </td>
                <td width="270" align="center" bgcolor="#FFFFFF">
                    领药批号                </td>
                <td width="150" align="center" bgcolor="#FFFFFF">
                    应交回空瓶                </td>
                <td width="130" align="center" bgcolor="#FFFFFF">
                    实际交回空瓶                </td>
                <td width="100" align="center" bgcolor="#FFFFFF">
                    剩余药量                </td>
                <td width="120" align="center" bgcolor="#FFFFFF">
                    用药方法                </td>
            </tr>
            <tr style="color:#1f4248; font-size:12px;">
<td align="center" bgcolor="#FFFFFF">
  <input name="ypgg" id="ypgg1" type="radio"  onclick="fayaguize(1)" value="12.5mg*28粒"/>12.5mg*28粒&nbsp;<input style="width:30px;" name="shl" id="shl1" value="1"/>&nbsp;瓶
</td>
<td align="center" bgcolor="#FFFFFF">
        
<?php  
  $yhgldw = $_SESSION[gldw];
  $yhln = $_SESSION[yhln];
  $yhsql = "select id,yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yshid=$yhRecord[0];$yfmch=$yhRecord[1];}
  $yftmsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfid[]=$yftmRecord[0];}
/*    $phidsql = "select `ph1`,`ph2` from `yfshqzy` where `shqzht`='3' and (`yshid`='".$yshid."'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $phidsql  .= " or `yshid`='".$yfid[$i]."' ";
  }
}
$phidsql  .= ")";*/
$phidsql = "select `ph1`,`ph2` from `yfshqzy` where `shqzht`='3' and `yfmch`='".$yhgldw."'";
    $phidQuery_ID = mysql_query($phidsql);
    $phidshzi=0;
    while($phidRecord = mysql_fetch_array($phidQuery_ID)){
      $ph1ids[$phidshzi]=$phidRecord[0];
      $ph2ids[$phidshzi]=$phidRecord[1];
      $phidshzi++;
    }
$ph1idtmp=array_values(array_unique($ph1ids));
$ph2idtmp=array_values(array_unique($ph2ids));
//$ph1idtmp=Array ("0"=> "4","1"=> "2" ,);
$ph1id=Array();
$ph2id=Array();
for($i=0;$i<count($ph1idtmp);$i++){
$ph1id=array_values(array_unique(array_merge($ph1id,explode(",",$ph1idtmp[$i]))));
}
for($i=0;$i<count($ph2idtmp);$i++){
$ph2id=array_values(array_unique(array_merge($ph2id,explode(",",$ph2idtmp[$i]))));
}
//print_r($ph1id);
    $phnsql = "select `ph` from `kfrk` order by id ASC";
    $phnQuery_ID = mysql_query($phnsql);
    $phnshzi=1;
    while($phnRecord = mysql_fetch_array($phnQuery_ID)){
      $phn[$phnshzi]=$phnRecord[0];
      $phnshzi++;
    }//echo count($ph1id);
?>
<span style="float:left;">药品批号：</span><span style="float:left;"><select id="ypph1" name="ypph" style="width: 120px;display:none;" >
<option value="">请选择批号</option>
      <?php //disabled
      for($i=0;$i<count($ph1id);$i++){
        if($phn[$ph1id[$i]]!=""){
        echo "<option value=\"".$ph1id[$i]."\"> ".$phn[$ph1id[$i]]."</option>";
        
        }
      }
        ?>
</select><select id="ypph2" name="ypph" style="width: 120px;display:none;">
<option value="">请选择批号</option>
<?php        

      for($i=0;$i<count($ph2id);$i++){
        if($phn[$ph2id[$i]]!=""){
        echo "<option value=\"".$ph2id[$i]."\"> ".$phn[$ph2id[$i]]."</option>";
        
        }
      }
?>    
</select></span>

</td>
<td align="center" bgcolor="#FFFFFF">
<?php
if($lynum=="0"){
$hzhyjhkpzsh=12-$hzhjzhshl;
echo "应交回 ".(12-$hzhjzhshl)." 瓶";
}
else{

  $shcfyggsql="SELECT fyjl FROM `zyff` where `hzhid`='".$hzhid ."'  order by id desc limit 1";
  $shcfyggq=mysql_query($shcfyggsql);
  while($shcfyggr = mysql_fetch_array($shcfyggq)){
$shcfygg=$shcfyggr[0];
  }
    if($shcfygg=="1"){$shcfyjlsh1="1";$shcfyjlsh2="0";
?>
    <script type="text/javascript">
var shcfyjlsh=1;
    </script>
<?php
}else if($shcfygg=="2"){$shcfyjlsh1="0";$shcfyjlsh2="1";
?>
    <script type="text/javascript">
var shcfyjlsh=2;
    </script>
<?php
}else{$shcfyjlsh1="0";$shcfyjlsh2="0";
?>
    <script type="text/javascript">
var shcfyjlsh=0;
    </script>
<?php
}
//echo $shcfyggsql;
?>
  12.5mg&nbsp;<?php
  echo $shcfyjlsh2;
  ?>&nbsp;瓶
<?php
}
?>
</td>
<td align="center" bgcolor="#FFFFFF">
<?php
if($lynum=="0"){
?>
  <input name="kpgg1" id="kpgg1" type="checkbox" value="1" />12.5mg&nbsp;<input name="kpshl1" style="width:30px;" id='kpshl1'  value="<?php
  echo (12-$hzhjzhshl);
  ?>" onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')"/>&nbsp;瓶
<?php
}
else{
?>
  <input name="kpgg" id="kpgg1" type="radio" value="1" onclick="fayaguizehy(1)"/>12.5mg&nbsp;<input name="kpshl" style="width:30px;" id='kpshl1'  value="0"    onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')"/>&nbsp;瓶
<?php
}
?>
</td>
<td align="center" bgcolor="#FFFFFF">
<?php
if($lynum=="0"){
?>
  <input name="yyshl" style="width:30px;"  value="0"   onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')"/>&nbsp;粒
<?php
}
else{
?>
  <input name="yyshl" style="width:30px;" id='yyshl2' value="0"   onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')"/>&nbsp;粒
<?php
}
?>
</td>

<td align="center" bgcolor="#FFFFFF">
    <select class="grd-white2" id="yfjl" name="yfjl">
      <option value="12.5mg">12.5mg</option>
      <option value="25mg">25mg</option>
      <option value="37.5mg">37.5mg</option>
      <option value="50mg">50mg</option>
      <option value="62.5mg">62.5mg</option>
      <option value="75mg">75mg</option>
      <option value="87.5mg">87.5mg</option>
      <option value="100mg">100mg</option>
    </select>
    <select class="grd-white2" id="yfcsh" name="yfcsh">
      <option value="Qid">Qid</option>
      <option value="Bid">Bid</option>
      <option value="Tid">Tid</option>
    </select>
    <select class="grd-white2" id="yfzhq" name="yfzhq">
      <option value="2/4">2/4</option>
      <option value="连续服用">连续服用</option>
    </select>
</td>
<script language="javascript"> 
function fayaguize(v){
  if(v=='1'){
document.getElementById('ypph1').style.display='block';
document.getElementById('ypph2').style.display='none';
document.getElementById('ypph2').disabled = true;
document.getElementById('ypph1').disabled = false;
    document.getElementById('shl1').disabled = false;
    document.getElementById('shl2').disabled = true;
  }else{
document.getElementById('ypph2').style.display='block';
document.getElementById('ypph1').style.display='none';
document.getElementById('ypph1').disabled = true;
document.getElementById('ypph2').disabled = false;
    document.getElementById('shl2').disabled = false;
    document.getElementById('shl1').disabled = true;
  }
}
function fayaguizehy(v){
  if(v=='1'){
    document.getElementById('yyshl1').value = "0";
    document.getElementById('yyshl1').disabled = false;
    document.getElementById('yyshl2').disabled = true;
    /*if($("input[name='ypgg']:checked").val() == "1"){
    document.getElementById('yyshl1').readOnly = true;
    }else{
    document.getElementById('yyshl1').readOnly = false;
    }*/
    document.getElementById('kpshl1').disabled = false;
    document.getElementById('kpshl2').disabled = true;
  }else{
    document.getElementById('yyshl2').value = "0";
    document.getElementById('yyshl2').disabled = false;
    document.getElementById('yyshl1').disabled = true;
    /*if($("input[name='ypgg']:checked").val() == "2"){
    document.getElementById('yyshl2').readOnly = true;
    }else{
    document.getElementById('yyshl2').readOnly = false;
    }*/
    document.getElementById('kpshl2').disabled = false;
    document.getElementById('kpshl1').disabled = true;
  }
}
</script>  

            </tr>
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="180" align="center" bgcolor="#FFFFFF">
                    领药人                </td>
                <td width="270" align="center" bgcolor="#FFFFFF">
                    关系                </td>
                <td width="150" align="center" bgcolor="#FFFFFF">
                    证件号                </td>
                <td width="130" align="center" bgcolor="#FFFFFF">
                    预估上次用药结束时间                </td>
                <td width="100" align="center" bgcolor="#FFFFFF">
                    预估本次用药开始时间                </td>
                <td width="120" align="center" bgcolor="#FFFFFF">
                    预估本次用药天数                </td>
            </tr>
            <tr style="color:#1f4248; font-size:12px;">
<td align="center" bgcolor="#FFFFFF">
<label class="top">
<select id="selectzhxqsh" name="selectzhxqsh" style="width:60px;" class="grd-white2">
<option value="0">本人</option>
<?php
  $shqcxsql = "select * from `tshzhtzyfywu` where `hzhid`='$hzhid' and `shqzht`='1'";
  $shqcxQuery_ID = mysql_query($shqcxsql);
  while($shqcxRecord = mysql_fetch_array($shqcxQuery_ID)){
  $shqids=$shqcxRecord[0];
  }if($shqids>0){$shqid=$shqids;}else{$shqid=0;}
  $shqcx2sql = "select * from `tshzhtzyfywu` where `hzhid`='$hzhid' and `shqzht`='2'";
  $shqcx2Query_ID = mysql_query($shqcx2sql);
  while($shqcx2Record = mysql_fetch_array($shqcx2Query_ID)){
  $shqids2=$shqcx2Record[0];
  }if($shqids2>0){$shqid2=$shqids2;}else{$shqid2=0;}
  if($shqid2>0){
  $zhxqshsql = "select * from `zhxqsh` where `hzhid`='$hzhid' and `gxzf`='1'";

  $zhxqshQuery_ID = mysql_query($zhxqshsql);
  while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
?>
<option value="<?php echo $zhxqshRecord['0'];?>"><?php echo $zhxqshRecord['2'];?></option>
<?php
  }
}
?>
</select>
</label>
</td>
<td align="center" bgcolor="#FFFFFF" id="zhxqshgx" name="zhxqshgx">本人</td>
<td align="center" bgcolor="#FFFFFF" id="zhxqshzhj" name="zhxqshzhj"><?php echo $hzhzhjlx."</br>".$hzhzhjhm;?></td>
<td align="center" bgcolor="#FFFFFF" ><?php
if($lynum=="0"){echo "初次领药";}else{echo $ygshcyyjshrq;}
?></td>
<td align="center" bgcolor="#FFFFFF"><input name="ygbcyy" id="ygbcyy" readonly style="width:80px;" value="<?php if($lynum!="0"&&$ygshcyyjshrq!=""){
//echo date('Y-m-d',strtotime('+1 day',strtotime($ygshcyyjshrq)));
  if(date('Y-m-d',strtotime('+1 day',strtotime($ygshcyyjshrq)))>=date('Y-m-d',strtotime('+1 day'))){echo date('Y-m-d',strtotime('+1 day',strtotime($ygshcyyjshrq)));$jszxxzrq=date('Y-m-d',strtotime('+1 day',strtotime($ygshcyyjshrq)));}else{echo date('Y-m-d');$jszxxzrq=date('Y-m-d');}
}else if($lynum=="0"||$ygshcyyjshrq==""){
  $chcyyrqsql = "select ygshcyyrq from `hzh` where `id`='$hzhid'";
  $chcyyrqQuery_ID = mysql_query($chcyyrqsql);
  while($chcyyrqRecord = mysql_fetch_array($chcyyrqQuery_ID)){
  $ygshcyyrq=$chcyyrqRecord[0];
  }
  if($ygshcyyrq>=date('Y-m-d',strtotime('+1 day'))){echo $ygshcyyrq;$jszxxzrq=$ygshcyyrq;}else{echo date('Y-m-d');$jszxxzrq=date('Y-m-d');}
}else {echo date('Y-m-d',strtotime('+1 day'));
  $jszxxzrq=date('Y-m-d',strtotime('+1 day'));
}?>"/></td>

<td align="center" bgcolor="#FFFFFF">
<input name="hzhyytssh" style="width:50px;" id='hzhyytssh' value="30" />天
</td>
            </tr>

        </table>
        </div>
        </br>

    </div>
<script type="text/javascript">
    $(function () {
        chooseDateNow('YongyaoRiqi');
<?php 
$nowdate=date('Y-m-d');
$nowdate_List=explode("-",$nowdate);
$nowdate_d=mktime(0,0,0,$nowdate_List[1],$nowdate_List[2],$nowdate_List[0]);
$jszxxzrq_List=explode("-",$jszxxzrq);
$jszxxzrq_d=mktime(0,0,0,$jszxxzrq_List[1],$jszxxzrq_List[2],$jszxxzrq_List[0]);
if($jszxxzrq_d<=$nowdate_d)
{
$jszxxzrqs=date('Y-m-d');
}else{
$jszxxzrqs=$jszxxzrq;
}
?>
        chooseDateOlds('ygbcyy','<?php echo $jszxxzrqs;?>');
    });
</script>
<style>
.mindess {
	width:666px;
	font-size:12px;
	height:auto;
	position:fixed;
	z-index:100;
	left:25%;
	/*margin:0 auto 0 -343px; /* margin-left需要是宽度的一半 */
	top:30%;
	padding:1px;
	background:#25679c;
	border:1px #25679c solid;
}</style>
<table id="tjyzh1"  height="100%" style="display:none; position:absolute; z-index:80; background:#000000; filter:alpha(opacity=10);-moz-opacity:0.2; opacity:0.2; width:100%; height:100%; left:0px; top:0px;" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="height:1000px;">&nbsp;</td>
  </tr>
</table>
  <div class="mindess" id="tjyzh" style="display:none; border:3px solid #FFFFFF; clear:both;">
	<div style="position:absolute; right:15px;"><a style="color:#FFFFFF; cursor:pointer;" onclick="tjyzh(0)">关闭</a></div>
		<fieldset style="background:#ffffff;">
            <legend style="background:#ffffff;">确认发药</legend>
<input name="shouquanid" id="shouquanid" type="hidden" value="<?php echo $shqid;?>" />
<input name="shouquanid2" id="shouquanid2" type="hidden" value="<?php echo $shqid2;?>" />
<input name="jzhpsh" type="hidden" value="<?php echo $hzhjzhshl;?>" />
<input name="ylypsh" type="hidden" value="<?php echo $ylypsh;?>" />
        </fieldset>
	  </div>
    </div>
    
    <div class="top">
        患者需提交的材料:<br />
        
            1.<label>《随访表》的“项目办公室联”和“药房联”原件；</label><br />
            2.<label>	回收已使用完的索坦™空药瓶（首次领药时需回收前期自费的索坦™空瓶及空药盒）。</label><br />
            <div id='dailingrencl' style="display:none;">
            <label>代领人领药时需额外提供一下材料：</label><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;①患者本人身份证复印件；</label><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;②	代领人身份证复印件（代领人须为在线管理系统在册的患者直系亲属）；</label><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;③委托书原件（患者签字）</label><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;④患者本人无法亲自领药证明原件（指定医院指定医生开具）</label><br />
          </div>
           </div>      
    

    <div class="top">
        <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
    </form>
  
    <script type="text/javascript">
    function shqshcshl(){
      var shcshl = document.getElementById('shqshouceshl').value;
      //alert(shcshl);
      if(shcshl>100){
        alert('申请手册数量不能大于100');
        document.getElementById('shqshouceshl').focus();
      }
      if(shcshl<0){
        alert('申请手册数量不能小于0');
      }
    }
    function shqshouce(){
      document.getElementById('shcshl').style.display='block';
    }
    function yzhfp(){
      var haoma = document.getElementById('hzhjhfph').value;
      var hzhxm = document.getElementById('hzxm').value;
      if(haoma!=''){
        $(function(){
          $.get('yzhfp.php',{'fphm':haoma,'xm':hzhxm},function(data){
            $("#yahjg").html(data);
          });
        });
      }else{
        alert('发票号码为空，请检查！！');
      }
    }
    var shdzhmcl=0;
    var ercitj=0;
    var shcitj=0;
function tjyzh(v){
if(v=='1'){
document.getElementById('tjyzh').style.display='block';
document.getElementById('tjyzh1').style.display='block';
document.getElementById("submitBtn").disabled=true;
}else{
document.getElementById('tjyzh').style.display='none';
document.getElementById('tjyzh1').style.display='none';
document.getElementById("submitBtn").disabled=false;
}
}
function ercisubmit(){
 ercitj=1;
        if (SubmitCheck() && confirm("是否提交保存？")) {
            $("input:submit").attr("disabled", true);
            $("form").submit();
            return false;
        }else{ return false;}
   
}
function yxgzhm(v){
if(v=='1'){
shdzhmcl=1;
document.getElementById('xgzhmy').style.display='block';
document.getElementById('xgzhmw').style.display='none';
}else{
shdzhmcl=2;
document.getElementById('xgzhmw').style.display='block';
document.getElementById('xgzhmy').style.display='none';
}
}
function SubmitCheck(){
fygg=$("input[name='ypgg']:checked").val();//发药规格
ypph=$("#ypph"+fygg).val();//药瓶批号
//ypph=$("#ypph1").val();//药瓶批号
shjshdjlsh=$("input[name='kpgg']:checked").val();//实际收到空瓶规格
shjjhkpshl=$("#kpshl"+shjshdjlsh).val();//实际收到空瓶数量
//alert(shjjhkpshl);
kpshl1=$("#kpshl1").val();//首次收到空瓶数量
kpshl2=$("#kpshl2").val();//首次收到空瓶数量
if(fygg==undefined){
$('#txbt').html("请选择本次发药规格");
tjyzh(1);
//return true;
return false;
}else if(ypph==""){
$('#txbt').html("请选择本次发药批号");
tjyzh(1);
//return true;
return false;
}<?php
if($lynum>"0"){  //生成非首次发药js
?>else if(shjshdjlsh==undefined){
$('#txbt').html("请选择本次实际收回的空瓶规格");
tjyzh(1);
//return true;
return false;
}else if(shjjhkpshl!=1){   
var kpjhshlbf="应交回空瓶数量与实际收到的数量不相符1111。 ";
<?php
  if($shqid>0){
?>
var fyjzh="SPAP项目办已授权。";
$("#shouquanid").val('<?php echo $shqid;?>');
var bcanniu="<input type=\"button\" onclick=\"ercisubmit()\" value=\"保存\" class=\"lgSub\" />";
<?php
  }else {
?>
var fyjzh="本次发药终止，请核实情况并与SPAP项目办联系。";
var bcanniu="";
<?php
}
?>

var shfxgzhm="是否有相关证明：<input name=\"shdzhm\"  type=\"radio\" value=\"1\" onclick=\"yxgzhm(1)\"/>有<input type=\"radio\"  name=\"shdzhm\" value=\"0\" onclick=\"yxgzhm(0)\"/>无<div id=\"xgzhmy\" style=\"display:none;\"><input type=\"text\" name=\"zhjmch\" value=\"\"/><input type=\"button\" onclick=\"ercisubmit()\" value=\"保存\" class=\"lgSub\" /></div><div id=\"xgzhmw\" style=\"display:none;\">"+fyjzh+bcanniu+"</div>";

if(ercitj==0&&shcitj!=1){
     shcitj=1;
//$('#txbt').html(kpjhshlbf+"</br>"+shfxgzhm);
$('#txbt').html(kpjhshlbf+"</br>"+fyjzh);//首次发药后的都不可以直接填写证明
}
tjyzh(1);
//return true;
<?php
  if($shqid>0){
?>
if(shdzhmcl==1&&$("input[name='zhjmch']").val()!=undefined&&$("input[name='zhjmch']").val()!=""){
return true;
}else if(shdzhmcl==2){
tjyzh(1);
}else {
return false;
}
<?php
  }else {
?>
if(shdzhmcl==1&&$("input[name='zhjmch']").val()!=undefined&&$("input[name='zhjmch']").val()!=""){
return true;
}else {
return false;
}
<?php
}
?>
}else if(shcfyjlsh<0){     //shcfyjlsh>0&&shcfyjlsh!=shjshdjlsh
//alert(shcfyjlsh);
var kpjhbf="收回的空瓶规格与实际发放的药品规格不符111。";
<?php
  if($shqid>0){
?>
var fyjzh="SPAP项目办已授权。";
$("#shouquanid").val('<?php echo $shqid;?>');
<?php
  }else {
?>
var fyjzh="本次发药终止，请核实情况并与SPAP项目办联系。";
<?php
}
?>

$('#txbt').html(kpjhbf+"</br>"+fyjzh);
tjyzh(1);
//return true;
<?php
  if($shqid>0){
?>
return true;
<?php
  }else {
?>
return false;
<?php
}
?>
}else if(shcfyjlsh<0){
var kpjhbf="收回的空瓶规格与实际发放的药品规格不符。 ";
<?php
  $shqcxsql = "select id from `tshzhtzyfywu` where `hzhid`='$hzhid' and `shqzht`='1'";
  $shqcxQuery_ID = mysql_query($shqcxsql);
  while($shqcxRecord = mysql_fetch_array($shqcxQuery_ID)){
  $shqid=$shqcxRecord[0];
  }
  if($shqid>0){
?>
var fyjzh="SPAP项目办已授权。";
$("#shouquanid").val('<?php echo $shqid;?>');
<?php
  }else {
?>
var fyjzh="本次发药终止，请核实情况并与SPAP项目办联系。";
<?php
}
?>

$('#txbt').html(kpjhbf+"</br>"+fyjzh);
tjyzh(1);
//return true;
<?php
  if($shqid>0){
?>
return true;
<?php
  }else {
?>
return false;
<?php
}
?>
}<?php
}
else{
?>
else if(1==1){//验证空瓶数量是否正确，
  var kpshlzsh=0;
  var kpshl1=$("#kpshl1").val();
  var kpshl2=$("#kpshl2").val();
  if($("#kpgg1").attr('checked')){kpshlzsh=Number(kpshlzsh)+Number(kpshl1);}
  if($("#kpgg2").attr('checked')){kpshlzsh=Number(kpshlzsh)+Number(kpshl2);}
  kpshlyjhzsh=<?php echo $hzhyjhkpzsh;?>;
  if(kpshlzsh!=kpshlyjhzsh){
<?php
  $shqcxsql = "select id from `tshzhtzyfywu` where `hzhid`='$hzhid' and `shqzht`='1'";
  $shqcxQuery_ID = mysql_query($shqcxsql);
  while($shqcxRecord = mysql_fetch_array($shqcxQuery_ID)){
  $shqid=$shqcxRecord[0];
  }
?>
var kpjhshlbf="应交回空瓶数量与实际收到的数量不相符。 ";
<?php
  if($shqid>0){
?>
var fyjzh="SPAP项目办已授权。";
$("#shouquanid").val('<?php echo $shqid;?>');
var bcanniu="<input type=\"button\" onclick=\"ercisubmit()\" value=\"保存\" class=\"lgSub\" />";
<?php
  }else {
?>
var fyjzh="本次发药终止，请核实情况并与SPAP项目办联系。";
var bcanniu="";
<?php
}
?>

var shfxgzhm="是否有相关证明：<input name=\"shdzhm\"  type=\"radio\" value=\"1\" onclick=\"yxgzhm(1)\"/>有<input type=\"radio\"  name=\"shdzhm\" value=\"0\" onclick=\"yxgzhm(0)\"/>无<div id=\"xgzhmy\" style=\"display:none;\"><input type=\"text\" name=\"zhjmch\" value=\"\"/><input type=\"button\" onclick=\"ercisubmit()\" value=\"保存\" class=\"lgSub\" /></div><div id=\"xgzhmw\" style=\"display:none;\">"+fyjzh+bcanniu+"</div>";

if(ercitj==0){
$('#txbt').html(kpjhshlbf+"</br>"+shfxgzhm);
}
tjyzh(1);
//return true;
<?php
  if($shqid>0){
?>
if(shdzhmcl==1&&$("input[name='zhjmch']").val()!=undefined&&$("input[name='zhjmch']").val()!=""){
return true;
}else if(shdzhmcl==2){
return true;
}else {
return false;
}
<?php
  }else {
?>
if(shdzhmcl==1&&$("input[name='zhjmch']").val()!=undefined&&$("input[name='zhjmch']").val()!=""){
return true;
}else {
return false;
}
<?php
}
?>
  }else{return true;}
}
<?php
}
?>else {return true;}

}


        $(function () {
    //绑定提交验证
    $("input:submit").unbind("click");
    $("#submitBtn").bind("click", function () {

        if (SubmitCheck() && confirm("是否提交保存？")) {
            $("input:submit").attr("disabled", true);
            $("form").submit();
            return false;
        }
        return false;
    });
    $("input:submit").attr("disabled", false);

                  //post()方式  
          $('#selectzhxqsh').click(function (){ 
          if($(this).val()!="0"){
                document.getElementById('dailingrencl').style.display='block';
                $.post(  
                    'yshfyzhxqshac.php',  
                    {
                        id:$(this).val(),
                        hzhid:$('input[name="id"]').val(),
                        cq:'1'
                    },  
                    function (data) { //回调函数  
                        $('#zhxqshgx').html(data);
                    }  
                ); 
                 $.post(  
                    'yshfyzhxqshac.php',  
                    {
                        id:$(this).val(),
                        hzhid:$('input[name="id"]').val(),
                        cq:'2'
                    },  
                    function (data) { //回调函数  
                        $('#zhxqshzhj').html(data);
                    }  
                );
          }
          else{
            document.getElementById('dailingrencl').style.display='none';
            $('#zhxqshgx').html("本人");
            $('#zhxqshzhj').html("<?php echo $hzhzhjlx."</br>".$hzhzhjhm;?>");
          }
          });


        });
    </script>
            </div>
        </div>
    </div>
    
</body>
</html>
