<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增指定医院";
include('spap_head.php');
?>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="zhdyygl.php">指定医院管理</a>
        - 新增指定医院</div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>新增指定医院</strong><span></span>
				</div>
              <form action="zhdyyxzac.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
<div class="insinsins" style="width:100%;"><label>医院名称：</label><span>
        <input class="grd-white" id="yymch" name="yymch" style="width: 460px;" type="text" value="" onblur="getyyid()" />*
        <input type="hidden" value="" name="yymch_id" id="yymch_id" />
    </span></div>
<div class="insinsins" style="width:100%;"><label>医院所在城市：</label><span><select id="s_province" name="sheng" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_city" name="shi" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_county" name="qu" class="grd-white2"></select>*
    <script class="resources library" src="js/area.js" type="text/javascript"class="grd-white2"></script>
    
    <script type="text/javascript">_init_area();</script>
</span></div>
<div class="insinsins" style="width:100%;"><label>医院地址：</label><span><input class="grd-white" id="yydhz" name="yydhz" style="width: 460px;" type="text" value="" />*无需填写省市区</span></div>
<div class="insinsins" style="width:100%;"><label>医院科室：</label><span><input class="grd-white" id="yyksh" name="yyksh" style="width: 460px;" type="text" value="" />*</span></div>
<div class="insinsins" style="width:100%;"><label>指定医生：</label><span><input class="grd-white" id="zhdysh" name="zhdysh" style="width: 460px;" type="text" value="" />*</span><span id="zhdyshtx" name="zhdyshtx" style="color:red;"></span></div>
<div class="insinsins" style="width:100%;">
    <label>医生联系方式：</label>
    <span>
        <input class="grd-white" id="zhdyshdh" name="zhdyshdh" style="width: 360px;" type="text" value="" />*
    </span>
    <label>电子邮箱：</label>
    <span>
        <input class="grd-white" id="zhdyshemail" name="zhdyshemail" style="width: 360px;" type="text" value="" />*
    </span>
</div>
<div class="insinsins" style="width:100%;">
    <label>医生联系方式2：</label>
    <span>
        <input class="grd-white" id="zhdyshdh2" name="zhdyshdh2" style="width: 360px;" type="text" value="" />*
    </span>
</div>
<div class="insinsins" style="width:100%;"><label>指定医生样张：</label>
    <span>
        <img src="/images/loading.gif" style="display: none;" id="loadimg"/>
        <p id="img_div1"><img id="img_path1" width="100" height="100"></p>
        <input type="button" onclick="tjyzh(1)" value="上传" class="uusub2" id="upload_button1">
<!--        <input class="grd-white" id="zhdyshyzh" name="shqyshyzh1" style="width: 460px;" type="file" value="" />*-->
    </span>
    <div class="insinsins" style="width:100%;"><label>指定医生签字：</label><span>
        <p id="img_div2"><img id="img_path2" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(2)" value="上传" class="uusub2" id="upload_button2">
    </span></div>
</div>
<div class="insinsins" style="width:100%;"><label>授权一医生：</label><span><input class="grd-white" id="shqysh1" name="shqysh1" style="width: 460px;" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>授权一医生样张：</label><span>
        <p id="img_div8"><img id="img_path8" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(8)" value="上传" class="uusub2" id="upload_button8">
    </span></div>
<div class="insinsins" style="width:100%;">
    <label>授权一联系方式：</label>
    <span>
        <input class="grd-white" id="shqyshdh1" name="shqyshdh1" style="width: 340px;" type="text" value="" />
    </span>
    <label>授权医生电子邮箱：</label>
    <span>
        <input class="grd-white" id="shqyshemail" name="\" style="width: 340px;" type="text" value="" />
    </span>
</div>
<div class="insinsins" style="width:100%;"><label>授权二医生：</label><span><input class="grd-white" id="shqysh2" name="shqysh2" style="width: 460px;" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>授权二医生样张：</label><span>
<!--        <input class="grd-white" id="shqyshyzh2" name="shqyshyzh3" style="width: 460px;" type="file" value="" />-->
        <p id="img_div3"><img id="img_path3" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(3)" value="上传" class="uusub2" id="upload_button3">
    </span></div>
<div class="insinsins" style="width:100%;"><label>授权二联系方式：</label><span><input class="grd-white" id="shqyshdh2" name="shqyshdh2" style="width: 460px;" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>授权三医生：</label><span><input class="grd-white" id="shqysh3" name="shqysh3" style="width: 460px;" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>授权三医生样张：</label><span>
<!--        <input class="grd-white" id="shqyshyzh3" name="shqyshyzh4" style="width: 460px;" type="file" value="" />-->
        <p id="img_div4"><img id="img_path4" width='100' height='100'/></p>
            <input type="button" onclick="tjyzh(4)" value="上传" class="uusub2" id="upload_button4">
    </span></div>
<div class="insinsins" style="width:100%;"><label>授权三联系方式：</label><span><input class="grd-white" id="shqyshdh3" name="shqyshdh3" style="width: 460px;" type="text" value="" /></span></div>
<div class="insinsins" style="width:100%;"><label>医生培训期数：</label><span><input class="grd-white" id="yshpxqsh" name="yshpxqsh" style="width: 460px;" type="text" value="" />*</span></div>
<div class="insinsins" style="width:100%;"><label>医生培训日期：</label><span><input class="grd-white" id="yshpxrq" name="yshpxrq" style="width: 460px;" type="text" value="" />*</span></div>
<div class="top">
<span class="label">医生是否生效：</span><input checked="true" id="yhszht" name="yhszht" type="radio" value="1"/><label for="yhszht">是</label> <input id="yhszht" name="yhszht" type="radio" value="0" /><label for="yhszht">否</label>
*</div>

<!--          <div class="insinsins" style="width:100%;"><label>擅长病种：</label><span> -->
<!--             <input name='shchbzh[]' type='checkbox' class='np' id='shchbzh1' value='RCC'  >RCC -->
<!--           	<input name='shchbzh[]' type='checkbox' class='np' id='shchbzh2' value='GIST' >GIST -->
<!--           	<input name='shchbzh[]' type='checkbox' class='np' id='shchbzh3' value='pNET' >pNET</span> -->
<!--         </div> -->
        <div class="insinsins" style="width:100%;"><label>医院指定药房：</label><span>
          <div  id="zhdyyyfac"></div>
        </div>
<div class="top"><label>是否接收AE回访：</label><span><input checked="true" id="shfjshhf" name="shfjshhf" type="radio" value="1" /><label for="shfjshhf">是</label> <input id="shfjshhf" name="shfjshhf" type="radio" value="0" /><label for="shfjshhf">否</label>*</span></div>

<script type="text/javascript" src="/js/ajaxupload.3.5.js"></script>
<script language="javascript">

    //页面初始化上传按钮
    function reda() {
        upload('1');
        upload('2');
        upload('3');
        upload('4');
        upload('8');
    }

    //新增上传功能,当填写完成医院名称，生成新的医院数据，然后后续操作执行修改功能
    function tjyzh(v) {
        var yyid = $('#yymch_id').val();
        if(yyid == '' || yyid < 0) {
            alert('请输入医院名称!');
            return false;
        }
        upload(v);
    }
    //上传方法
    function upload(v) {
        var yyid = $('#yymch_id').val();
        ajaxUpload(
            'upload_button'+v, //上传的按钮id名称
            1024,  //允许上传的文件大小（单位：kb）
            'ajaxupload.php?form_name=userfile&file_size=1024&name_f='+yyid+'-'+v, //提交服务器端地址
            'userfile', //提交服务器文件表单名称
            "$(\".img_div"+v+"\").show();$(\"#img_path"+v+"\").attr('src', obj.filename+'?'+Math.random());$(\"#is_upload\").val('1');", //上传成功后执行的 js callback
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

    var flag = 1;
    function getyyid() {
        if(flag == 1){
            $.ajax({
                url: '/zhdyyxzac.php',
                type: 'post',
                async: false,
                data: {ajax: 'ajax', yymch: $("#yymch").val()},
                dataType: 'json',
                success: function (data) {
                    $("#yymch_id").val(data.yyid);
                }
            });
            reda();
        }
        flag = 0;
    }
    //END 图片上传功能

    //点击取消功能时，删除新加的医院数据
    function removeyy(){
		if($.trim($('#yymch_id').val()).length == 0){
			window.location.href='../manager.php'
		}else{
			$.ajax({
	            url: '/zhdyyxzac.php',
	            type: 'post',
	            async: false,
	            data: {ajaxremove: 'ajaxremove', yyid:$('#yymch_id').val()},
	            dataType: 'json',
	            success: function(data){
	                window.location.href='../manager.php'
	            }
	        })
		}
    }

    $(document).ready(function(){
    chooseDateNow('yshpxrq', true);
  /** ----------- 用户名输入框事件 ----------- */
  //当文本框失去焦点时
  $("#zhdysh").bind("blur", function(){
  //alert("asdf");
    $.get( 
        'zhdyyxzyzhac.php',  
        {  
            zhdysh:$("#zhdysh").val(),
            yymch:$("#yymch").val()
        },  
        function (data) { //回调函数  
            $("#zhdyshtx").html(data);
        }  
    );
  }); 
    });  
    
    $("#s_city").change(function(){ 
      //alert('aaaaa');
      var shimch = $("#s_city").val();
      $.get('zhdyyyfac.php',{'shimch':shimch},function(data){
        $("#zhdyyyfac").html(data);//alert(data);
      });
    });

    function validate(){
		if($.trim($("#yymch").val()).length == 0){
			alert('请填写医院名称!');
			return false;
		}
		if($("#s_county").val() == "市、县级市"){
			alert('请选择医院所在城市!');
			return false;
		}

		if($.trim($("#yydhz").val()).length == 0){
			alert('请填写医院地址!');
			return false;
		}

		if($.trim($("#yyksh").val()).length == 0){
			alert('请填写医院科室!');
			return false;
		}

		if($.trim($("#zhdysh").val()).length == 0){
			alert('请填写指定医生!');
			return false;
		}

		if($.trim($("#zhdyshdh").val()).length == 0){
			alert('请填写医生联系方式!');
			return false;
		}

		if($.trim($("#zhdyshemail").val()).length == 0){
			alert('请填写电子邮箱!');
			return false;
		}
		if($.trim($("#zhdyshdh2").val()).length == 0){
			alert('请填写医生联系方式2!');
			return false;
		}

		if($("input[name='yyzhdyfs[]']:checked").length == 0){
			alert('请选择医院指定药房	!');
			return false;
		}
		$("#isSubmit").val('save');
		return true;
    }

    window.onbeforeunload = onbeforeunload_handler;    
    function onbeforeunload_handler(){   
    	if($.trim($('#yymch_id').val()).length != 0 && $("#isSubmit").val() != "save"){
			$.ajax({
	            url: '/zhdyyxzac.php',
	            type: 'post',
	            async: false,
	            data: {ajaxremove: 'ajaxremove', yyid:$('#yymch_id').val()},
	            dataType: 'json',
	            success: function(data){
	                window.location.href='../manager.php'
	            }
	        })
		}
    }   	
</script> 
					  </td>
                    </tr>
                  </table>

				</div>
        <div class="incontact w955 flt">
        	<input type="hidden" id="isSubmit" value="" />
          <input type="submit" class="uusub" value="提交保存" /> 
          <input type="button" class="uusub2" value="取消" onclick="removeyy();" />
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>