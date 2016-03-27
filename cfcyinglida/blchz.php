<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid=$_GET['id'];
$html_title="办理出组";
include('spap_head.php');
?>
     <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="blchz.php"><?php echo $html_title;?></a> </div> 
    <h1>
        请选择患者出组原因，操作实时生效。</h1>
    <form action="blchzac.php" method="post">
<input type="hidden" name="id" value="<?php echo $hzhid;?>" />
    <div>
        申请状态 :
        <select id="ZhuangtaiMingcheng" name="ZhuangtaiMingcheng" style="width:300px;" onchange="showText()" class="grd-white2">
            <option  value="">请选择</option>
            <option  value="患者死亡">患者死亡</option>
            <option  value="经指定医生确诊患者有不可耐受的严重不良反应">经指定医生确诊患者有不可耐受的严重不良反应</option>
            <option  value="经指定医生确诊患者疾病进展——对于使用英立达治疗没有效果">经指定医生确诊患者疾病进展——对于使用英立达治疗没有效果</option>
            <option  value="失去联系">失去联系</option>
            <option  value="患者或直系亲属主动要求退出项目或更改治疗方案">患者或直系亲属主动要求退出项目或更改治疗方案</option>
            <option  value="不依从项目各项规定">不依从项目各项规定</option>
            <option  value="不能坚持到指定医生处定期随访">不能坚持到指定医生处定期随访</option>
            <option  value="患者拒绝入组后与项目有关的核查">患者拒绝入组后与项目有关的核查</option>
            <option  value="提供任何虚假医学或经济证明，或隐瞒真实信息">提供任何虚假医学或经济证明，或隐瞒真实信息</option>
            <option  value="将援助药品出售或转赠他人">将援助药品出售或转赠他人</option>
            <option  value="因不可抗力或特殊原因必须停止援助项目">因不可抗力或特殊原因必须停止援助项目</option>
</select>
<script type="text/javascript">
function showText(){
if(document.getElementById('ZhuangtaiMingcheng').value=='其他'){
document.getElementById('textValue').style.display='block';
}else{
document.getElementById('textValue').style.display='none';
}
}
</script>
    </div>
    <div style="display:none;" id="textValue">
<span class="label" >其他说明：</span><input class="grd-white" id="qtshm" name="qtshm" style="width:300px;" type="text" value="" /></div>
    <div id="textValue">
<span class="label" >出组详细说明：</span><textarea  id="jjxxshm" name="jjxxshm"  rows="3" cols="30"></textarea></div>
    <div>
            <input type="submit" value="保存" class="uusub" />
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
    </form>
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
