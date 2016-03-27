<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增指定药房";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
            
    <div class="thislink">
        <a href="zhdyfgl.php">指定药房管理</a>
        > 新增指定药房</div>
    <div class="form">
        <form action="xzzhdyfac.php" method="post" enctype="multipart/form-data">
        <div>
            <span class="label">药房名称：</span><input class="grd-white" id="yfmch" name="yfmch" style="width: 660px;" type="text" value="" /></div>
        <div>
            <span class="label">药房所在城市：</span>	<select class="grd-white2" id="s_province" name="yfsheng"></select>&nbsp;&nbsp;
    <select class="grd-white2" id="s_city" name="yfshi" ></select>&nbsp;&nbsp;
    <select class="grd-white2" id="s_county" name="yfqu"></select>*
    <script class="resources library" src="js/area.js" type="text/javascript"></script>
    
    <script type="text/javascript">_init_area();</script>
<script type="text/javascript">
var Gid  = document.getElementById ;
var showArea = function(){
	Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + 	
	Gid('s_city').value + " - 县/区" + 
	Gid('s_county').value + "</h3>"
							}
Gid('s_county').setAttribute('onchange','showArea()');
</script>
</div>
        <div>
            <span class="label">药房地址：</span><input class="grd-white" id="yfdzh" name="yfdzh" style="width: 660px;" type="text" value="" /></div>
        <div>
            <span class="label">联系方式(座机)：</span><input class="grd-white" id="yfdh" name="yfdh" type="text" value="" /></div>
        <div>
            <span class="label">联系方式(移动)：</span><input class="grd-white" id="yfshj" name="yfshj" type="text" value="" /></div>
        <div>
            <span class="label">联系方式(传真)：</span><input class="grd-white" id="yfchzh" name="yfchzh" type="text" value="" /></div>
        <div>
            <span class="label">联系方式(email)：</span><input class="grd-white" id="yfemail" name="yfemail" type="text" value="" /></div>
        <div>
            <span class="label">库容：</span><input class="grd-white" id="yfkcrl" name="yfkcrl" type="text" value="" />瓶</div>
        <div>
            <span class="label">指定药师：</span><input class="grd-white" id="yfzhdysh" name="yfzhdysh" type="text" value="" /></div>
        <div>
            <span class="label">指定药师性别：</span><select name="yfzhdyshxb" style="width: 116px;" class="grd-white2">
    <option value="男">男</option><option value="女">女</option></select></div>
        <div>
            <span class="label">指定药师样张：</span><input class="grd-white" id="yfzhdyshyzh" name="yfzhdyshyzh" type="file" /></div>
        <div>
            <span class="label">授权药师：</span><input class="grd-white" id="yfshqysh" name="yfshqysh" type="text" value="" /></div>
        <div>
            <span class="label">授权药师样张：</span><input class="grd-white" id="yfshqyshyzh" name="yfshqyshyzh" type="file" /></div>
        <div>
            <span class="label">授权药师电话：</span><input class="grd-white" id="yfshq
yshdh" name="yfshqyshyzh" type="text" value="" /></div>
        <div>
            <span class="label">培训班：</span><input class="grd-white" id="pxb" name="pxb" type="text" value="" /></div>
        <div>
            <span class="label">培训日期：</span><input class="grd-white" id="pxrq" name="pxrq" type="text" value="" /></div>
        <div>
            <span class="label">用户名：</span><input class="grd-white" id="yfyshname" name="yfyshname" type="text" value="" /> <span id="yfyshnames0" name="yfyshnames0">*用户名重复将无法添加药房</span><span id="yfyshnames1" name="yfyshnames1"></span></div>
        <div>
            <span class="label">密码：</span><input class="grd-white" id="yfyshpwd" name="yfyshpwd" type="text" value="" /></div>
        <div>
            <span class="label">重复密码：</span><input class="grd-white" id="yfyshrpwd" name="yfyshrpwd" type="text" value="" /></div>
        <div>
            <span class="label"></span>
            <input checked="checked" id="shfzt" name="shfzt" type="radio" value="1" /><label for="shfzt">启用</label> <input name="shfzt" value="0"  type="radio" /><label for="shfzt">停用</label></div>
        <div class="btnPos">
            <input type="submit" value="保存" class="uusub" /></div>
<script language="javascript">  
function chkUsername() {
 var username = $.trim($("#yfyshname").val());
 if(username=="") {
  return 0;
 }
 else if( /^\d.*$/.test( username ) ){
  //用户名不能以数字开头
  return -1;
 }
 else if(username.length<6 || username.length>18 ){
  //合法长度为6-18个字符
  return -2;
 }
  else if(! /^\w+$/.test( username ) ){
  //用户名只能包含_,英文字母，数字
   return -3;
 }
 else if(! /^([a-z]|[A-Z])[0-9a-zA-Z_]+$/.test( username ) ){
  //用户名只能英文字母开头
  return -4;
 }
 else if(!(/[0-9a-zA-Z]+$/.test( username ))){
  //用户名只能英文字母或数字结尾
  return -5;
 }
  return 1;
} 
$(document).ready(function(){
  /** ----------- 用户名输入框事件 ----------- */
  //当文本框成为焦点时
  $("#yfyshname").bind("focus", function(){
  var ret=chkUsername();
  if(ret==0){
  //用户名输入框为空,显示规则
   $("#yfyshnames1").hide();
   $("#yfyshnames0").show();  
  }
  return false;
  }); 
  
  //当文本框失去焦点时
  $("#yfyshname").bind("blur", function(){
   var ret=chkUsername();
   $("#yfyshnames0").hide();
   $("#yfyshnames1").show();
   if (ret>0){
    $.get( 
        'xzzhdyfacname.php',  
        {  
            name:$("#yfyshname").val()
        },  
        function (data) { //回调函数  
            $("#yfyshnames1").html(data);
        }  
    );
   }
   else if(ret==0){
   //用户名输入框为空,显示规则
    $("#yfyshnames1").html("用户名不能为空");  
   } 
  else {
   
    if(ret == -1){
     //显示具体的错误内容
     $("#yfyshnames1").html("用户名不能以数字开头");
    }
    else if(ret == -2){
     $("#yfyshnames1").html("合法长度为6-18个字符");
    }
    else if(ret == -3){
     $("#yfyshnames1").html("用户名只能包含_,英文字母,数字 ");
    }
    else if(ret == -4){
     $("#yfyshnames1").html("用户名只能英文字母开头");
    }
    else if(ret == -5){
     $("#yfyshnames1").html("用户名只能英文字母或数字结尾");
    }
  }
  
   return false;
  }); 
});
</script> 
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
