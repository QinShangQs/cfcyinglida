<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid = $_GET['id'];
$html_title="二次审核";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></div>
			<div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        
        <div class="incontact w955 flt">
    <div class="top">
<form method=post action="shhjlerciac.php" onsubmit="return check()">
<input type="hidden" name="id" value="<?php echo $hzhid;?>" />
<script type="text/javascript">
function shifoupizhun(v){
if(v=='1'){
document.getElementById('rzh1').style.display='block';
document.getElementById('jujue').style.display='none';
}else{
document.getElementById('rzh1').style.display='none';
document.getElementById('jujue').style.display='block';
}
}
</script>
    <div id="rzh1" class="top">
    <span class="top">手册寄出日期：</span><input id="shcrq" name="shcrq" type="txt" value="<?php echo date('Y-m-d');?>" class="grd-white"></input></br>
    <div class="top">
    <span>运单号：</span><input id="shcydh" name="shcydh" type="txt" value="" class="grd-white"></input></br>
    </div>
    <div class="top">
    <span>确认入组医院：</span><?php 
    $hzhsql = "select zhzhyy,zhshrzshj from `hzh` where `id`='".$hzhid."'";

    $hzhQuery_ID = mysql_query($hzhsql);
    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
      $hzhzhzhyy=$hzhRecord[0];
      $zhshrzshj=$hzhRecord[1];//正式入组日期
    }
    echo "<input type='hidden' id='zhshrzshj' value='{$zhshrzshj}'/>";
    if($hzhzhzhyy>0){$hzhjzhyy=$hzhzhzhyy;}
    else{
      $hzhsql = "select rzyy from `hzh` where `id`='".$hzhid."'";
      $hzhQuery_ID = mysql_query($hzhsql);
      while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
        $hzhrzyy=$hzhRecord[0];
      }
      if($hzhrzyy>0){$hzhjzhyy=$hzhrzyy;}
      else{
        $hzhsql = "select shqyy from `hzh` where `id`='".$hzhid."'";
        $hzhQuery_ID = mysql_query($hzhsql);
        while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
          $hzhshqyy=$hzhRecord[0];
        }
        if($hzhshqyy>0){$hzhjzhyy=$hzhshqyy;} 
      }
    }  
    $yysql = "select sheng,yymch,zhdysh,yyzhdyf from `yyyshdq` where `id`='".$hzhjzhyy."'";

    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      echo "【".$yyRecord[0]." ".$yyRecord[1]." ".$yyRecord[2]."】";$yyzhdyf=$yyRecord[3];
    }
    $yfsql = "select yfsheng,yfmch,yfzhdysh from `yf` where `yfmch`='".$yyzhdyf."' group by `yfdzh`";

    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){
      echo " 领药药房：【".$yfRecord[0]." ".$yfRecord[1]." ".$yfRecord[2]."】";
    }
?>
</div><input type="hidden" name="zhdyyid" value="<?php echo $hzhjzhyy;?>" /></br>
<span class="label">是否更换医院：</span><input  onclick="qryyyf(1)" name="qryy" type="radio" value="1"></input><label for="qryy">是</label> <input  onclick="qryyyf(0)" name="qryy" type="radio" value="0"  checked="checked" ></input><label for="qryy">否</label>*</br>
     
    <div style="display:none;" id="selectyy">
    <select  name="selzhdyyid" class="grd-white2" style="width: 500px;">
    <option value=""></option>
<?php        
    $sql = "select id,shengjx,sheng,yymch,zhdysh from `yyyshdq` where `id`<> '$hzhjzhyy' order by shengjx ASC";

    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
      echo "<option value=\"".$Record[0]."\"> ".$Record[1]." ".$Record[2]." ".$Record[3]." ".$Record[4]."</option>";
    }
?>    
</select></br>
    </div>
</br>
<span class="label">是否更换药房：</span><input  onclick="qrthyf(1)" name="qryf" type="radio" value="1"></input><label for="qryf">是</label> <input  onclick="qrthyf(0)" name="qryf" type="radio" value="0"  checked="checked" ></input><label for="qryf">否</label>*</br>
     
    <div style="display:none;" id="selectyf">
    <select  name="selzhdyf" class="grd-white2" style="width: 500px;">
    <option value=""></option>
<?php        
    $sql = "select `yfshijx`,`yfmch` from `yf` where `yfmch`<>'".$yyzhdyf."' group by `yfmch` order by `yfshijx` ASC";

    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
      echo "<option value=\"".$Record[1]."\"> ".$Record[0]." ".$Record[1]."</option>";
    }
?>    
</select></br>
    </div>
</br>
    
<span class="label">首次服药日期：</span> <input id="ygrqgh" name="ygrqgh" type="txt" class="grd-white" value="<?php echo date('Y-m-d');?>"></input></br>
<!--   <input  onclick="qryyyf(11)" name="ygrq" type="radio" value="1"></input><label for="ygrq">是</label> <input  onclick="qryyyf(10)" name="ygrq" type="radio" value="0"></input><label for="ygrq">否</label>*</br> -->


    </div>
    </div>
    

<script type="text/javascript">
function shifourzh(v){
if(v=='0'){
document.getElementById('rzh').style.display='block';
document.getElementById('rzh1').style.display='none';
}else{
document.getElementById('rzh1').style.display='block';
document.getElementById('rzh').style.display='none';
}
}
function qryyyf(v){
if(v=='1'){
document.getElementById('selectyy').style.display='block';
}
else if(v=='0'){
document.getElementById('selectyy').style.display='none';
}
else if(v=='11'){
document.getElementById('ygrqghdiv').style.display='block';
}
else if(v=='10'){
document.getElementById('ygrqghdiv').style.display='none';
}
}
function qrthyf(v){
if(v=='1'){
document.getElementById('selectyf').style.display='block';
}
else {
document.getElementById('selectyf').style.display='none';
}
}
chooseDateOld('ygrqgh', true); 
chooseDateOld('ygrzhrq', true); 
chooseDate('shcrq', true); 
//chooseDate('rzrqid', true); 

function check(){
	var zhshrzshj = $("#zhshrzshj").val();//正式入组日期
	var ygrqgh = $("#ygrqgh").val();
	if(Date.parse(ygrqgh) < Date.parse(zhshrzshj)){
		alert('首次服药日期必须晚于或等于'+zhshrzshj);
		return false;
	}
	
	return true;
}
</script>
    
            <div class="top">
            <input type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
</form>
    </div>
        </div>
    </div>
</body>
</html>
