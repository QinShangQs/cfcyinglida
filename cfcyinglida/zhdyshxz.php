<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增指定医生";
include('spap_head.php');

$newidsql = "select MAX(id+1) from yyyshdq;";
$Query_ID = mysql_query($newidsql);
$newid = 0;
while($Record = mysql_fetch_array($Query_ID)){
	$newid = $Record[0];
}
?>
     <div class="main">
		<div class="insmain">
    <div class="thislink">
      当前位置：  <a href="zhdyygl.php">指定医院管理</a>
        -<?php echo $html_title;?></div>
        <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <div class="form">
        <form action="zhdyshxzac.php" method="post">
        <div>
            <span class="label">所属医院：</span>
            <select id="yyid" name="yyid" style="width:400px;" class="grd-white2" onchange='reda()'>
<?php 
  $yyid=$_GET[yyid];
  if($yyid != '') {
    $sql = "select `id`,`shengjx`,`sheng`,`shi`,`yymch` from `yyyshdq` where `id`='".$yyid."' group by yymch order by shengjx ASC";

    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
      echo "<option value=\"".$Record[0]."\">".$Record[1];
      if($Record[2]!=$Record[3]){echo " ".$Record[2].$Record[3];}else{echo " ".$Record[2];}
      echo " ".$Record[4]."</option>";
    } 
  } else {
?>            
    <option value=""></option>
<?php        
    $sql = "select `id`,`shengjx`,`sheng`,`shi`,`yymch` from `yyyshdq` group by yymch  order by `shengjx` ASC";

    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
      echo "<option value=\"".$Record[0]."\">".$Record[1];
      if($Record[2]!=$Record[3]){echo " ".$Record[2].$Record[3];}else{echo " ".$Record[2];}
      echo " ".$Record[4]."</option>";
    }
  }
?>

</select>

</div>
        <div class="top">
            <span class="label">医院科室：</span><input class="grd-white2" id="yyksh" name="yyksh" style="width: 460px;" type="text" value="" />*</div>
        <div class="top">
            <span class="label">指定医生：</span><input class="grd-white2" id="zhdysh" name="zhdysh" style="width: 460px;" type="text" value="" />*</div>
        <div class="top">
            <span class="label">医生联系方式：</span><input class="grd-white2" id="zhdyshdh" name="zhdyshdh" style="width: 460px;" type="text" value="" />*</div>
        <div class="top">
            <span class="label">电子邮箱：</span>
            <input class="grd-white2" id="zhdyshemail" name="zhdyshemail" style="width: 460px;" type="text" value="" />*
        </div>
        <div class="top">
            <span class="label">医生联系方式2：</span>
            <input class="grd-white2" id="zhdyshdh2" name="zhdyshdh2" style="width: 460px;" type="text" value="" />
        </div>
        <div class="top">
            <span class="label">指定医生样章：</span>
            <img src="/images/loading.gif" style="display:none;" id="loadimg" />
            <p id="img_div1"><img id="img_path1" width='100' height='100' /></p>
            <input type="button" onclick="tjyzh(1)" value="上传" class="uusub2" id="upload_button1">
        </div>
        <div class="top">
            <span class="label">指定医生签字：</span>
            <img src="/images/loading.gif" style="display:none;" id="loadimg" />
            <p id="img_div1"><img id="img_path2" width='100' height='100' /></p>
            <input type="button" onclick="tjyzh(2)" value="上传" class="uusub2" id="upload_button2">
        </div>
        <div class="top">
            <span class="label">授权一医生：</span><input class="grd-white2" id="shqysh1" name="shqysh1" style="width: 460px;" type="text" value="" /></div>
        <div class="top">
            <span class="label">授权一医生签字：</span>
            <p id="img_div8"><img id="img_path8" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(8)" value="上传" class="uusub2" id="upload_button8">
        </div>
        <div class="top">
            <span class="label">授权一联系方式：</span><input class="grd-white2" id="shqyshdh1" name="shqyshdh1" style="width: 460px;" type="text" value="" /></div>
        <div class="top">
            <span class="label">授权二医生：</span><input class="grd-white2" id="shqysh2" name="shqysh2" style="width: 460px;" type="text" value="" /></div>
        <div class="top">
            <span class="label">授权二医生签字：</span>
            <p id="img_div3"><img id="img_path3" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(3)" value="上传" class="uusub2" id="upload_button3">
        </div>
        <div class="top">
            <span class="label">授权二联系方式：</span><input class="grd-white2" id="shqyshdh2" name="shqyshdh2" style="width: 460px;" type="text" value="" /></div>
        <div class="top">
            <span class="label">授权三医生：</span><input class="grd-white2" id="shqysh3" name="shqysh3" style="width: 460px;" type="text" value="" /></div>
        <div class="top">
            <span class="label">授权三医生签字：</span>
            <p id="img_div4"><img id="img_path4" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(4)" value="上传" class="uusub2" id="upload_button4">
        </div>
        <div class="top">
            <span class="label">授权三联系方式：</span><input class="grd-white2" id="shqyshdh3" name="shqyshdh3" style="width: 460px;" type="text" value="" /></div>
        <div class="top">
            <span class="label">医生培训期数：</span><input class="grd-white2" id="yshpxqsh" name="yshpxqsh" style="width: 460px;" type="text" value="" />*</div>
        <div class="top">
            <span class="label">医生培训日期：</span><input class="grd-white2" id="yshpxrq" name="yshpxrq" style="width: 460px;" type="text" value="" />*</div>
        <div class="top">
            <span class="label">医生是否生效：</span><input checked="true" id="yhszht" name="yhszht" type="radio" value="1" /><label for="yhszht">是</label> <input id="yhszht" name="yhszht" type="radio" value="0" /><label for="yhszht">否</label>*</div>
<!--        <div class="insinsins" style="width:100%;"><label>擅长病种：</label><span> -->
<!--             <input name='shchbzh[]' type='checkbox' class='np' id='shchbzh1' value='RCC'  >RCC -->
<!--           	<input name='shchbzh[]' type='checkbox' class='np' id='shchbzh2' value='GIST' >GIST -->
<!--           	<input name='shchbzh[]' type='checkbox' class='np' id='shchbzh3' value='pNET' >pNET</span> -->
<!--         </div> -->
        <div class="top">
            <span class="label">是否接收AE回访：</span><input checked="true" id="shfjshhf" name="shfjshhf" type="radio" value="1" /><label for="shfjshhf">是</label> <input id="shfjshhf" name="shfjshhf" type="radio" value="0" /><label for="shfjshhf">否</label>*</div>
<?php /*
            <div class="top" style="width:100%;"><label>用户名：</label><span><input class="grd-white" id="yfyshname" name="yfyshname" type="text" value="" /></span> <span id="yfyshnames0" name="yfyshnames0">*用户名重复将无法添加</span><span id="yfyshnames1" name="yfyshnames1"></span></div>
<div class="top" style="width:100%;"><label>密码：</label><span><input class="grd-white" id="yfyshpwd" name="yfyshpwd" type="text" value="" /></span></div>
<div class="top" style="width:100%;"><label>重复密码：</label><span><input class="grd-white" id="yfyshrpwd" name="yfyshrpwd" type="text" value="" /></span></div>
*/
?>
<div class="top" style="width:100%;"><label>状态：</label><label for="shfzt">启用</label><span><input checked="checked" id="shfzt" name="shfzt" type="radio" value="1" /></span> <label for="shfzt">停用</label><span><input name="shfzt" value="0"  type="radio" /></span></div>
    <div class="top">
    <input type="submit" value="保存" class="uusub" /></div>
</form>
    </div>
    
<!-- 文件上传配置参数 -->
<?php
// $yyid = $_GET['id'];
// //上传文件类型列表  
// $uptypes = array(  
//     'image/jpg',  
//     'image/jpeg'  
// );
// $max_file_size=200000;     //上传文件大小限制, 单位BYTE  
// $destination_folder="qzyzh/"; //上传文件路径 
?>
<!-- <script type="text/javascript" src="/js/jquery-1.6.2.js"></script> -->
<script type="text/javascript" src="/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
    //页面初始化上传按钮
    function reda() {
    	upload('1');
    	upload('2');
    	upload('3');
    	upload('4');
    	upload('8');
    }
    
    //上传附件
    function tjyzh(v) {
        var yyid = $('#yyid').val();
        if(yyid == '' || yyid < 0) {
            alert('请先选择医院'); return ;
        }
        upload(v);
    }
    //上传方法
    function upload(v) {
    	//var yyid = $('#yyid').val();
    	var newid = '<?php echo $newid?>'
    	ajaxUpload(
            'upload_button'+v, //上传的按钮id名称
            1024,  //允许上传的文件大小（单位：kb）
            'ajaxupload.php?form_name=userfile&file_size=1024&name_f='+newid+'-'+v, //提交服务器端地址
            'userfile', //提交服务器文件表单名称
            "$(\".img_div"+v+"\").show();$(\"#img_path"+v+"\").removeAttr('src');$(\"#img_path"+v+"\").attr('src', obj.filename + '?'+Math.random());$(\"#is_upload\").val('1');", //上传成功后执行的 js callback
            'loadimg'  //loading 图片id
        );
    }

    function ajaxUpload(id_name, filesize, url, filename, callback, loadingid) {
        var button = $('#'+id_name), interval;
        var fileType = "pic", fileNum = "one";
        new AjaxUpload(button,{
            action: url,
            name: filename,
            onSubmit : function(file, ext){
                if(fileType == "pic") {
                    if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
                        this.setData({
                            'info': '文件类型为图片'
                        });
                    } else {
                        alert('提示：您上传的是非图片类型！');
                        return false;
                    }
                }
                $("#"+loadingid).show();
                if(fileNum == 'one') this.disable();
            },
            onComplete: function(file, response){
                eval("var obj="+response);
                if (obj.ok) {
                    eval(callback);
                } else {
                    switch (response) {
                        case '1':
                            alert('提示：上传失败，图片不能大于'+filesize+'k！');
                            break;
                        case '3':
                            alert('提示：图片只有部分文件被上传，请重新上传！');
                            break;
                        case '4':
                            alert('提示：没有任何文件被上传！');
                            break;
                        case '5':
                            alert('提示：非图片类型，请上传jpg|png|gif图片！');
                            break;
                        default:
                            alert('提示：上传失败，错误未知，请您及时联系网站客服人员！');
                            break;
                    }
                }
                $("#"+loadingid).hide();
                window.clearInterval(interval);
                this.enable();
            }
        });
    }
</script>
    
<script>
chooseDateNow('yshpxrq', true);
</script>
<script language="javascript">  
/*function chkUsername() {
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
} */
$(document).ready(function(){
chooseDateNow('pxrq', true);
  /** ----------- 用户名输入框事件 ----------- */
 /*  //当文本框成为焦点时
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
  }); */
});
</script> 
        </div>
    </div></div></div>
</body>
</html>
