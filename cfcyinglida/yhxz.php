<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增用户记录";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div> 
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <form action="yhxzac.php" method="post">
    <table class="addTable">
        <tr>
            <td>用户类型
            </td>
            <td>
                <input id="yhlx" name="yhlx" type="radio" value="2" checked="checked" onclick="yhlxselect(0)" /><label for="yhlx">CFC</label>
                <input id="yhlx" name="yhlx" type="radio" value="4"  onclick="yhlxselect(1)" /><label for="yhlx">协管员</label>
    <div style="display:none;width:700px;" id="yhlxxgy">
    选择区域：</br><?php
  $sql = "select * from `yf` group by  yfshi order by yfsheng ASC";
  $Query_ID = mysql_query($sql);
  $xgyi=1;
  while($Record = mysql_fetch_array($Query_ID)){
    echo " <input name='xgyqy[]' type='checkbox' class='np' id='xgyqy".$xgyi."' value='".$Record[14]."'>".$xgyi.".".$Record[14]." ";
    $xgyi++;
  }
    ?>

    </div>
            </td>
        </tr>
        
<script type="text/javascript">
function yhlxselect(v){
if(v=='1'){
document.getElementById('yhlxxgy').style.display='block';
}else{
document.getElementById('yhlxxgy').style.display='none';
}
}
</script>
        <tr>
            <td>
                用户名
            </td>
            <td>
                <input class="grd-white" id="UserName" name="UserName" type="text" value="" /><span style="color: red">*</span><span id="yhnames0" name="yhnames0">用户名重复将无法添加</span><span id="yhnames1" name="yhnames1"></span>
            </td>
        </tr>
        <tr>
            <td>
                密码
            </td>
            <td>
                <input class="grd-white" id="Password" name="Password" type="password" /><span style="color: red">*</span>
            </td>
        </tr>
        <tr>
            <td>
                确认密码
            </td>
            <td>
                <input class="grd-white" id="ConfirmPassword" name="ConfirmPassword" type="password" /><span
                    style="color: red">*</span>
            </td>
        </tr>
        <tr>
            <td>
                名称
            </td>
            <td>
                <input class="grd-white" id="Xingming" name="Xingming" type="text" value="" /><span style="color: red">*</span>
            </td>
        </tr>
        <tr>
            <td>
                联系电话
            </td>
            <td>
                <input class="grd-white" id="Shouji" name="Shouji" type="text" value="" />
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input id="IsApproved" name="IsApproved" type="radio" value="1" /><label for="IsApproved">启用</label>
                <input id="IsApproved" name="IsApproved" type="radio" value="0" /><label for="IsApproved">不启用</label>
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="保存" class="uusub" /></p>
    </form>
<script language="javascript">  
$(document).ready(function(){
  /** ----------- 用户名输入框事件 ----------- */
 
  //当文本框失去焦点时
  $("#UserName").bind("blur", function(){
   $("#yhnames0").hide();
   $("#yhnames1").show();
    $.get( 
        'xzyhacname.php',  
        {  
            name:$("#UserName").val()
        },  
        function (data) { //回调函数  
            $("#yhnames1").html(data);
        }  
    );
  }); 
});
</script> 
        </div>
    </div>
</body>
</html>
