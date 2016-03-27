<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid = $_GET['id'];
$html_title="患者申诉";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="cfcsfjlxx.php"><?php echo $html_title;?></a> </div>
			<div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
    <div>
<form method=post action="shhjlshsac.php">
<input type="hidden" name="id" value="<?php echo $hzhid;?>" />
    <span class="label">是否批准：</span><input name="shfpzh" onclick="shifoupizhun(1)" type="radio" value="1"></input><label for="shfpzh">批准</label> <input name="shfpzh" onclick="shifoupizhun(0)" type="radio" value="0"></input><label for="shfpzh">拒绝</label></br>
<script type="text/javascript">
function shifoupizhun(v){
if(v=='1'){
document.getElementById('pizhun').style.display='block';
document.getElementById('jujue').style.display='none';
}else{
document.getElementById('pizhun').style.display='none';
document.getElementById('jujue').style.display='block';
}
}
</script>
    <div style="display:none;" id="jujue" class="top">
    拒绝原因：<TEXTaREa style="WIDth: 400px" rows="2" cols="20" name="jujue"></TEXTaREa>

    </div>
    <div style="display:none;" id="pizhun" class="top">
    <span class="label">是否办理重新材料审核：</span><input  onclick="shifoushh(1)" name="shfshh" type="radio" value="1"></input><label for="shfshh">是</label> <input  onclick="shifoushh(0)" name="shfshh" type="radio" value="0"></input><label for="shfshh">否</label></br></br>
    <div style="display:none;" id="shh">
    <span class="label">是否办理入组：</span><input  onclick="shifourzh(1)" name="shfrzh" type="radio" value="1"></input><label for="shfrzh">是</label> <input  onclick="shifourzh(0)" name="shfrzh" type="radio" value="0"></input><label for="shfrzh">否</label></br></br>

    <div style="display:none;" id="rzh">
    <span class="label">预估办理入组时间：</span><input id="ygrzhrq" name="ygrzhrq" type="txt" value="<?php echo date('Y-m-d');?>" class="grd-white"></input></br></br>
    </div>
    <div style="display:none;" id="rzh1">
    <span class="label">手册寄出日期：</span><input id="shcrq" name="shcrq" type="txt" value="<?php echo date('Y-m-d');?>" class="grd-white"></input></br></br>
    <span class="label">运单号：</span><input id="shcydh" name="shcydh" type="txt" value="" class="grd-white"></input></br></br>
    <span class="label">确认入组医院：</span><?php 
    $hzhsql = "select zhzhyy from `hzh` where `id`='".$hzhid."'";

    $hzhQuery_ID = mysql_query($hzhsql);
    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
      $hzhzhzhyy=$hzhRecord[0];
    }
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
?><input type="hidden" name="zhdyyid" value="<?php echo $hzhjzhyy;?>" /></br></br>
<span class="label">是否更换医院：</span><input  onclick="qryyyf(1)" name="qryy" type="radio" value="1"></input><label for="qryy">是</label> <input  onclick="qryyyf(0)" name="qryy" type="radio" value="0"></input><label for="qryy">否</label>*</br>
     
    <div style="display:none;" id="selectyy">
    <select  name="selzhdyyid" style="width: 500px;" class="grd-white">
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
    <select  name="selzhdyf" style="width: 500px;" class="grd-white">
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
    <span class="label">确认预估首次赠药日期：</span><?php 
    $ygshcyyrqsql = "select ygshcyyrq from `hzh` where `id`='".$hzhid."'";

    $ygshcyyrqQuery_ID = mysql_query($ygshcyyrqsql);
    while($ygshcyyrqRecord = mysql_fetch_array($ygshcyyrqQuery_ID)){
      echo "【".$ygshcyyrqRecord[0]."】";
      $ygrq=$ygshcyyrqRecord[0];
    }
?></br></br>
<span class="label">是否更换首次赠药日期：</span><input  onclick="qryyyf(11)" name="ygrq" type="radio" value="1"></input><label for="ygrq">是</label> <input  onclick="qryyyf(10)" name="ygrq" type="radio" value="0"></input><label for="ygrq">否</label>*</br>
     
    <div style="display:none;" id="ygrqghdiv"><input id="ygrqgh" name="ygrqgh" type="txt" value="<?php echo $ygrq;?>" class="grd-white"></input></br>
    </div></br>

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
</script>




    </div>
    </div>
    

<script type="text/javascript">
function shifoushh(v){
if(v=='0'){
document.getElementById('shh').style.display='block';
}else{
document.getElementById('shh').style.display='none';
}
}
</script>
            <div class="top">
            <input type="submit" value="保存" class="uusub" /></div>
</form>
    </div>
 

            <div class="clearFoot noPrint">
            </div>
        </div>
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
</html>
