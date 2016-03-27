<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增指定药房</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="style/jquery.autocomplete.css" rel="Stylesheet" type="text/css" />
<link href="style/AnniuCaidan.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.all.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.tabs.css" rel="Stylesheet" type="text/css" />
<link href="style/jquery.ui.dialog.css" rel="Stylesheet" type="text/css" />
<link href="style/textboxlist.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>

<script type="text/javascript" src="js/SelectDate.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
</head>

<body>
<div class="wrap">
	<div class="head">
		<div class="head_info">
			<div class="head_left"><img src="./images/tp_left.gif" /></div>
			<div class="head_right">
				<div class="head_right_top"><img src="./images/head_right_top.gif" /></div>
				<div class="head_right_middle">欢迎您，<?php echo $_SESSION[yhname];?> <a href="/">注销</a> <a href="xgmm.php">修改密码</a> <a href="manager.php">首页</a></div>
				<div class="head_right_nav">
					<ul>
						<li><strong><a href="#">高级搜索</a></strong></li>
						<li><strong><a href="#">数据备份</a></strong></li>
						<li><strong><a href="#">不良事件</a></strong></li>
						<li><strong><a href="#">统计</a></strong></li>
						<li><strong><a href="#">转诊</a></strong></li>
						<li><strong><a href="#">随访</a></strong></li>
						<li><strong><a href="#">出组</a></strong></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="zhdyfgl.php">指定药房管理</a>
        - 新增指定药房</div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>新增指定药房</strong><span></span>
				</div>
                            <form action="zhdyfxzac.php" method="post" enctype="multipart/form-data">
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>

<div class="insinsins" style="width:100%;"><label>药房名称：</label><span><input class="grd-white" id="yfmch" name="yfmch" style="width: 660px;" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>药房所在城市：</label><span><select id="s_province" name="yfsheng"></select>&nbsp;&nbsp;
    <select id="s_city" name="yfshi" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_county" name="yfqu" class="grd-white2"></select>*
    <script class="resources library" src="js/area.js" type="text/javascript" class="grd-white2"></script>
    
    <script type="text/javascript">_init_area();</script>
</span></div>
<div class="insinsins" style="width:100%;"><label>药房地址：</label><span><input class="grd-white" id="yfdzh" name="yfdzh" style="width: 660px;" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>办公时间：</label>
    <span>
        <input type="checkbox" name="bgsj[]" value="1"/>星期一
        <input type="checkbox" name="bgsj[]" value="2"/>星期二
        <input type="checkbox" name="bgsj[]" value="3"/>星期三
        <input type="checkbox" name="bgsj[]" value="4"/>星期四
        <input type="checkbox" name="bgsj[]" value="5"/>星期五
        <input type="checkbox" name="bgsj[]" value="6"/>星期六
        <input type="checkbox" name="bgsj[]" value="7"/>星期日
    </span>
    <span>
        &nbsp;上午：
        <select name="start1">
            <option value="">--请选择--</option>
            <?php for($i=1; $i<25; $i++):?>
                <option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
            <?php endfor; ?>
        </select> -
        <select name="start2">
            <option value="">--请选择--</option>
            <?php for($i=1; $i<25; $i++):?>
                <option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
            <?php endfor; ?>
        </select>
        下午：
        <select name="end1">
            <option value="">--请选择--</option>
            <?php for($i=1; $i<25; $i++):?>
                <option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
            <?php endfor; ?>
        </select> -
        <select name="end2">
            <option value="">--请选择--</option>
            <?php for($i=1; $i<25; $i++):?>
                <option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
            <?php endfor; ?>
        </select>
    </span>
                          </div>
                          <div class="insinsins" style="width:100%;"><label>指定药师：</label><span><input class="grd-white" id="yfzhdysh" name="yfzhdysh" type="text" value="" /></span></div>
                           <div class="insinsins" style="width:100%;"><label>性别：</label><span><select name="yfzhdyshxb" style="width: 116px;" class="grd-white2">
                                      <option value="男">男</option><option value="女">女</option></select></span></div>
                          <div class="insinsins" style="width:100%;"><label>年龄：</label><span><input class="grd-white" id="zhdyshnl" name="zhdyshnl" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>手机(对内)：</label><span><input class="grd-white" id="yfshj" name="yfshj" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>座机(对外)：</label><span><input class="grd-white" id="yfdh" name="yfdh" type="text" value="" /></span></div>

<div class="insinsins" style="width:100%;"><label>传真(对外)：</label><span><input class="grd-white" id="yfchzh" name="yfchzh" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>联系方式(email)：</label><span><input class="grd-white" id="yfemail" name="yfemail" type="text" value="" /></span></div>
<!-- <div class="insinsins" style="width:100%;"><label>库容：</label><span><input class="grd-white" id="yfkcrl" name="yfkcrl" type="text" value="" />瓶</span></div> -->

<div class="insinsins" style="width:100%;"><label>指定药师样张：</label><span><input class="grd-white" id="yfzhdyshyzh" name="yfzhdyshyzh" type="file" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>备案日期：</label><span><input class="grd-white" id="pxrq" name="newtime" type="text" /></span></div>
                          <div class="insinsins" style="width: 100%;">--------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
                          <div class="insinsins" style="width:100%;"><label>授权药师：</label><span><input class="grd-white" id="yfshqysh" name="yfshqysh" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>性别：</label>
                              <span>
                                  <select name="yfshqyshxb" style="width: 116px;" class="grd-white2">
                                      <option value="男">男</option><option value="女">女</option></select>
                              </span></div>
                          <div class="insinsins" style="width:100%;"><label>年龄：</label><span><input class="grd-white" id="yfshqyshnl" name="yfshqyshnl" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>手机(对内)：</label><span><input class="grd-white" id="yfshqyshshj" name="yfshqyshshj" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>座机(对外)：</label><span><input class="grd-white" id="yfshqyshdh" name="yfshqyshdh" type="text" value="" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>电子邮箱：</label><span><input class="grd-white" id="yfshqyshemail" name="yfshqyshemail" type="text" value="" /></span></div>

<div class="insinsins" style="width:100%;"><label>授权药师样张：</label><span><input class="grd-white" id="yfshqyshyzh" name="yfshqyshyzh" type="file" /></span></div>
                          <div class="insinsins" style="width:100%;"><label>备案日期：</label><span><input class="grd-white" id="yfshqyshbarq" name="yfshqyshbarq" type="text" value="" /></span></div>

<!-- <div class="insinsins" style="width:100%;"><label>培训班：</label><span><input class="grd-white" id="pxb" name="pxb" type="text" value="" /></span></div> -->


<div class="insinsins" style="width:100%;"><label>用户名：</label><span><input class="grd-white" id="yfyshname" name="yfyshname" type="text" value="" /></span> <span id="yfyshnames0" name="yfyshnames0">*用户名重复将无法添加药房</span><span id="yfyshnames1" name="yfyshnames1"></span></div>
<div class="insinsins" style="width:100%;"><label>密码：</label><span><input class="grd-white" id="yfyshpwd" name="yfyshpwd" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>重复密码：</label><span><input class="grd-white" id="yfyshrpwd" name="yfyshrpwd" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>状态：</label><label for="shfzt">启用</label><span><input checked="checked" id="shfzt" name="shfzt" type="radio" value="1" /></span> <label for="shfzt">停用</label><span><input name="shfzt" value="0"  type="radio" /></span></div>




					  </td>
                    </tr>
                  </table>

				</div>
        <div class="incontact w955 flt">
          <input type="submit" class="uusub" value="提交保存" /> <input type="button" class="uusub2" onclick="javascript:{history.go(-1);}" value="取消" />
				</div>				
			</form>
			</div>
		</div>
	</div>
</div>
</body>
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
chooseDateNow('pxrq', true);
chooseDateNow('yfshqyshbarq', true);
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
        'zhdyfxzyzhac.php',  
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
</html>