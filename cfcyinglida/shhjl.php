<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid = $_GET['id'];
$html_title="审核记录";
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
<form method=post action="shhjlac.php">
<input type="hidden" name="id" value="<?php echo $hzhid;?>" />

    <span class="label">是否批准：</span><input name="shfpzh" onclick="shifoupizhun(1)" type="radio" value="1"></input><label for="shfpzh">批准</label> <input name="shfpzh" onclick="shifoupizhun(0)" type="radio" value="0"></input><label for="shfpzh">拒绝</label></br>
<script type="text/javascript">
function shifoupizhun(v){
if(v=='1'){
document.getElementById('rzrqkid').style.display='block';
document.getElementById('jujue').style.display='none';
}else{
document.getElementById('rzrqkid').style.display='none';
document.getElementById('jujue').style.display='block';
}
}
</script>
    <div style="display:none;" id="jujue" class="top">
    拒绝原因：<TEXTaREa style="WIDth: 400px" rows="2" cols="20" name="jujue"></TEXTaREa>
 <div class="top">
    <input type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />    </div>
    </div>
</br>
<div style="display:none;" id="rzrqkid" class="top">
    <span class="label">入组日期：<input type="text" name="rzrq" id="rzrqid"  class="grd-white" value="<?php echo date("Y-m-d");?>" readonly></span><?php 
    /*$ygshcyyrqsql = "select ygshcyyrq from `hzh` where `id`='".$hzhid."'";

    $ygshcyyrqQuery_ID = mysql_query($ygshcyyrqsql);
    while($ygshcyyrqRecord = mysql_fetch_array($ygshcyyrqQuery_ID)){
      echo "【".$ygshcyyrqRecord[0]."】";
      $ygrq=$ygshcyyrqRecord[0];
    }*/
?></br>
<script type="text/javascript">
chooseDateOld('ygrqgh', true); 
chooseDateOld('ygrzhrq', true); 
chooseDate('shcrq', true); 
chooseDate('rzrqid', true); 
</script>
    <div class="top">
    备注：<TEXTaREa style="WIDth: 400px" rows="2" cols="20" name="bzh"></TEXTaREa>
    </div>
    <div class="top">
     <input type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
</form>
</div>
</div>
</div>
</body>
</html>
