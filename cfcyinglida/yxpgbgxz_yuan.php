<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET["id"];
$html_title="新增医学评估报告";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <form action="yxpgbgxzac.php" method="post">
        <input id="id" name="id" type="hidden" value="<?php echo $id;?>" />
        <fieldset>
            <legend>医学条件评估</legend>
            <div>
                <span class="label" style="width: 180px;">胸片：</span><select id="xp" name="xp" onchange="showxpText()"  style="width: 100px;">
<option selected="selected" value="不确定">不确定</option>
<option value="正常">正常</option>
<option value="异常">异常</option>
</select> 

<script type="text/javascript">
function showxpText(){
if(document.getElementById('xp').value=='异常'){
document.getElementById('textxpValue').style.display='block';
}else{
document.getElementById('textxpValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textxpValue">
<span class="label"  style="width: 180px;">异常说明：</span><input class="input addInput" id="xpychshm" name="xpychshm" style="width:300px;" type="text" value="" /></div>
<span class="label" style="width: 180px;">诊断日期：</span><input class="input addInput" id="xpzhdrq"  name="xpzhdrq"  readonly type="text" value="" />

            </div>
            <div>
                <span class="label" style="width: 180px;">CT：</span><select id="ct" name="ct" onchange="showctText()"  style="width: 100px;">
<option selected="selected" value="不确定">不确定</option>
<option value="正常">正常</option>
<option value="异常">异常</option>
</select> 

<script type="text/javascript">
function showctText(){
if(document.getElementById('ct').value=='异常'){
document.getElementById('textctValue').style.display='block';
}else{
document.getElementById('textctValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textctValue">
<span class="label"  style="width: 180px;">异常说明：</span><input class="input addInput" id="ctychshm" name="ctychshm" style="width:300px;" type="text" value="" /></div>
<span class="label" style="width: 180px;">诊断日期：</span><input class="input addInput" id="ctzhdrq"  name="ctzhdrq"  readonly type="text" value="" />
            </div>
            <div>
                <span class="label" style="width: 180px;">其他检查：</span><input class="input addInput" id="qtjch" name="qtjch" style="width:100px;" type="text" value="" />
            </div>
            <div>
                <span class="label" style="width: 180px;"></span><select id="qt" name="qt" onchange="showqtText()"  style="width: 100px;">
<option selected="selected" value="不确定">不确定</option>
<option value="正常">正常</option>
<option value="异常">异常</option>
</select>
<script type="text/javascript">
function showqtText(){
if(document.getElementById('qt').value=='异常'){
document.getElementById('textqtValue').style.display='block';
}else{
document.getElementById('textqtValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textqtValue">
<span class="label"  style="width: 180px;">异常说明：</span><input class="input addInput" id="qtychshm" name="qtychshm" style="width:300px;" type="text" value="" /></div>
<span class="label"  style="width: 180px;">诊断日期：</span><input class="input addInput" id="qtzhdrq"  name="qtzhdrq"  readonly type="text" value="" />
            </div>
           <div>
                <span class="label" style="width: 180px;">本次随访 RECIST  评估：</span><select id="bcsfpg" name="bcsfpg" style="width: 100px;">
    <option value="CR">CR</option>
    <option value="PR">PR</option>  
    <option value="SD">SD</option>  
    <option value="PD">PD</option>  
</select>
<span class="label" style="width: 180px;">评估日期：</span><input class="input addInput" id="pgrq"  name="pgrq"  readonly type="text" value="" />
            </div>



            <div>
                <span class="label" style="width: 180px;">治疗期间有无不良事件：</span><select id="ywblshj" name="ywblshj"  onchange="showywText()" style="width: 100px;">
    <option value="无">无</option>
    <option value="有">有</option>  
</select>
<script type="text/javascript">
function showywText(){
if(document.getElementById('ywblshj').value=='有'){
document.getElementById('textywValue').style.display='block';
}else{
document.getElementById('textywValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textywValue">
<span class="label"  style="width: 180px;">描述说明：</span><input class="input addInput" id="yblshjshm" name="yblshjshm" style="width:300px;" type="text" value="" /> 
<span class="label"  style="width: 180px;">医生是否接受回访：</span><select id="shfjshhf" name="shfjshhf" style="width: 100px;">
    <option value="是">是</option>
    <option value="否">否</option>  
</select>
</div>
            </div>
            <div>
                <span class="label"  style="width: 180px;">是否应该继续赛可瑞治疗：</span><select id="shfygjxskrzhl"  onchange="showshfText()" name="shfygjxskrzhl" style="width: 100px;">
    <option value="是">是</option>
    <option value="否">否</option>  
</select>
<script type="text/javascript">
function showshfText(){
if(document.getElementById('shfygjxskrzhl').value=='否'){
document.getElementById('textshfValue').style.display='block';
}else{
document.getElementById('textshfValue').style.display='none';
}
}
</script>
<div style="display:none;" id="textshfValue">
<span class="label"  style="width: 180px;">注明原因：</span><input class="input addInput" id="zhmyy" name="zhmyy" style="width:300px;" type="text" value="" /></div>
            </div>

        </fieldset>
        <div class="btnPos">
            <input id="btnSave" type="submit" value="保存" class="lgSub" />
            <input id="btnReturn" type="button" value="返回" class="lgSub" /></div>

      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
    <script type="text/javascript">
        $(function () {
    chooseDate('pgrq', true); 
    chooseDate('xpzhdrq', true); 
    chooseDate('ctzhdrq', true); 
    chooseDate('qtzhdrq', true); 

            //返回按钮
            $("#btnReturn").bind("click", function () {
                var returnUrl = '';
                if (returnUrl == "") {
                    history.go(-1);
                }
            });

        });
    </script>

</body>
</html>