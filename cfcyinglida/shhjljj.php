<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid = $_GET['id'];
$html_title="审核记录 - 拒绝";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></div><div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
    <div>
<form method=post action="shhjljjac.php">
<input type="hidden" name="id" value="<?php echo $hzhid;?>" />
    <div class="form">
    <div class="top">
        <span class="label" style="width: 100px">拒绝原因：</span>
        <select id="jujue" name="jujue" style="width:300px;" onchange="showText()" class="grd-white">
<option  value="">请选择</option>
<option  value="死亡">死亡</option>
<option  value="严重的、需永久停药的副作用">严重的、需永久停药的副作用</option>
<option  value="疾病进展">疾病进展</option>
<option  value="不属于索坦的适应症">不属于索坦的适应症</option>
<option  value="更换治疗方案">更换治疗方案</option>
<option  value="患者不依从">患者不依从</option>
<option  value="患者主动退出">患者主动退出</option>
<option  value="失去联系">失去联系</option>
<option  value="提供虚假的医学或经济证明，或隐瞒真实信息">提供虚假的医学或经济证明，或隐瞒真实信息</option>
<option  value="其他">其他</option>
</select>
<script type="text/javascript">
function showText(){
if(document.getElementById('jujue').value=='其他'){
document.getElementById('textValue').style.display='block';
}else{
document.getElementById('textValue').style.display='none';
}
}
</script>
    </div>
    <div style="display:none;" id="textValue" class="top">
<span class="label" >其他说明：</span><input class="grd-white" id="qtshm" name="qtshm" style="width:300px;" type="text" value="" /></div>
    <div id="textValue" class="top">
<span class="label" >拒绝详细说明：</span><textarea  id="jjxxshm" name="jjxxshm"  rows="3" cols="30"></textarea></div>
    <div class="top">
            <input type="submit" value="保存" class="uusub" />
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>

</form>
    </div>
        </div>
    </div>
</body>
</html>
