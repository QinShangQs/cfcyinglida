<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yyid = $_GET['id'];
//上传文件类型列表  
$uptypes=array(  
    'image/jpg',  
    'image/jpeg'  
);    
$max_file_size=200000;     //上传文件大小限制, 单位BYTE  
$destination_folder="qzyzh/"; //上传文件路径 
$html_title="修改指定医院";
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
    <div class="form">
<?php        
  $sql = "select * from `yyyshdq` where `id`='".$yyid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $yshyzhid=$Record[0];
?>
        <form action="zhdyyglxgac.php" method="post" onsubmit="return validate()">
        <div>
            <span class="label">医院名称：</span><input id="yyid" name="yyid" type="hidden" value="<?php echo $Record[0];?>" /><input class="grd-white2" id="yymch" name="yymch" style="width: 460px;" type="text" value="<?php echo $Record[3];?>" /></div>
        <div>
            <span class="label">医院所在城市：</span>
            <select id="s_province" name="sheng" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_city" name="shi" class="grd-white2"></select>&nbsp;&nbsp;
    <select id="s_county" name="qu" class="grd-white2"></select>*
    <script class="resources library" src="js/area.js" type="text/javascript"class="grd-white2"></script>
    
    <script type="text/javascript">_init_area();</script>

<script type="text/javascript">
$(function () {
  $("#s_province option[value='省份']").text("<?php echo $Record[1];?>");
  $("#s_province option[value='省份']").val("<?php echo $Record[1];?>");
  $("#s_city option[value='地级市']").text("<?php echo $Record[24];?>");        
  $("#s_city option[value='地级市']").val("<?php echo $Record[24];?>"); 
  $("#s_county option[value='市、县级市']").text("<?php echo $Record[26];?>");
  $("#s_county option[value='市、县级市']").val("<?php echo $Record[26];?>");
});
</script>
</div>
        <div>
            <span class="label">医院地址：</span><input class="grd-white2" id="yydhz" name="yydhz" style="width: 460px;" type="text" value="<?php echo $Record[20];?>" /></div>
        <div>
            <span class="label">医院科室：</span><input class="grd-white2" id="yyksh" name="yyksh" style="width: 460px;" type="text" value="<?php echo $Record[5];?>" /></div>
        <div>
            <span class="label">指定医生：</span><input class="grd-white2" id="zhdysh" name="zhdysh" style="width: 460px;" type="text" value="<?php echo $Record[6];?>" /></div>
        <div>
            <span class="label">医生联系方式：</span>
            <input class="grd-white2" id="zhdyshdh" name="zhdyshdh" style="width: 460px;" type="text" value="<?php echo $Record[7];?>" />
        </div>
        <div>
            <span class="label">医生联系方式2：</span>
            <input class="grd-white2" id="zhdyshdh2" name="zhdyshdh2" style="width: 460px;" type="text" value="<?php echo $Record[29];?>" />
        </div>
        <div>
            <span class="label">电子邮箱：</span>
            <input class="grd-white2" id="zhdyshemail" name="zhdyshemail" style="width: 460px;" type="text" value="<?php echo $Record[30];?>" />
        </div>
        <div>
            <span class="label">指定医生样章：</span><img src="qzyzh/<?php echo sprintf("%03d", $Record[0]);?>-1.jpg?r=<?php echo rand(0, 100);?>" width="105" height="45"/>   
  <input type="button" onclick="tjyzh(1)" value="上传" class="uusub2"></div>
        <div>
            <span class="label">指定医生签字：</span><img src="qzyzh/<?php echo sprintf("%03d", $Record[0]);?>-2.jpg?r=<?php echo rand(0, 100);?>" width="105" height="45"/>
  <input type="button" onclick="tjyzh(2)" value="上传" class="uusub2"></div>
        <div>
            <span class="label">授权一医生：</span><input class="grd-white2" id="shqysh1" name="shqysh1" style="width: 460px;" type="text" value="<?php echo $Record[9];?>" /></div>
        <?php /*div>
            <span class="label">授权一医生样张：</span><input class="grd-white2" id="shqyshyzh1" name="shqyshyzh1" style="width: 460px;" type="text" value="<?php echo $Record[10];?>" /></div */?>
        <div>
            <span class="label">授权一联系方式：</span><input class="grd-white2" id="shqyshdh1" name="shqyshdh1" style="width: 460px;" type="text" value="<?php echo $Record[11];?>" /></div>
        <div>
            <span class="label">授权一医生签字：</span><img src="qzyzh/<?php echo sprintf("%03d", $Record[0]);?>-8.jpg?r=<?php echo rand(0, 100);?>" width="105" height="45"/>  
  <input type="button" onclick="tjyzh(8)" value="上传" class="uusub2"></div>
        <div>
            <span class="label">授权二医生：</span><input class="grd-white2" id="shqysh2" name="shqysh2" style="width: 460px;" type="text" value="<?php echo $Record[12];?>" /></div>

        <div>
            <span class="label">授权二联系方式：</span><input class="grd-white2" id="shqyshdh2" name="shqyshdh2" style="width: 460px;" type="text" value="<?php echo $Record[14];?>" /></div>
        <div>
            <span class="label">授权二医生签字：</span><img src="qzyzh/<?php echo sprintf("%03d", $Record[0]);?>-3.jpg?r=<?php echo rand(0, 100);?>" width="105" height="45"/>  
  <input type="button" onclick="tjyzh(3)" value="上传" class="uusub2"></div>
        <div>
            <span class="label">授权三医生：</span><input class="grd-white2" id="shqysh3" name="shqysh3" style="width: 460px;" type="text" value="<?php echo $Record[15];?>" /></div>

        <div>
            <span class="label">授权三联系方式：</span><input class="grd-white2" id="shqyshdh3" name="shqyshdh3" style="width: 460px;" type="text" value="<?php echo $Record[17];?>" /></div>
        <div>
            <span class="label">授权三医生签字：</span><img src="qzyzh/<?php echo sprintf("%03d", $Record[0]);?>-4.jpg?r=<?php echo rand(0, 100);?>" width="105" height="45"/>  
  <input type="button" onclick="tjyzh(4)" value="上传" class="uusub2"></div>
        <div>
            <span class="label">医生培训期数：</span><input class="grd-white2" id="yshpxqsh" name="yshpxqsh" style="width: 460px;" type="text" value="<?php echo $Record[18];?>" /></div>
        <div>
            <span class="label">医生培训日期：</span><input class="grd-white2" id="yshpxrq" name="yshpxrq" style="width: 460px;" type="text" value="<?php echo $Record[19];?>" /></div>
        <div>
            <span class="label">医生是否生效：</span><input <?php if($Record[21]=='1'){echo "checked=\"true\"";}?> id="yhszht" name="yhszht" type="radio" value="1" /><label for="yhszht">是</label> <input <?php if($Record[21]=='0'){echo "checked=\"true\"";}?> id="yhszht" name="yhszht" type="radio" value="0" /><label for="yhszht">否</label></div>
<?php   
$shchbzh = explode(",",$Record[28]);
?> 
<!--         <div> -->
<!--             <span class="label">擅长病种：</span> -->
<!--            <input name='shchbzh[]' type='checkbox' class='np' id='shchbzh1' value='RCC' --><?php //if(in_array('RCC',$shchbzh)){echo "checked";}?><!-- >RCC-->
<!--          	<input name='shchbzh[]' type='checkbox' class='np' id='shchbzh2' value='GIST' --><?php //if(in_array('GIST',$shchbzh)){echo "checked";}?><!-- >GIST-->
<!--          	<input name='shchbzh[]' type='checkbox' class='np' id='shchbzh3' value='pNET' --><?php //if(in_array('pNET',$shchbzh)){echo "checked";}?><!-- >pNET-->
<!--        </div> -->
        <div class="insinsins" style="width:100%;"><label>医院指定药房：</label><span>
            <div  id="zhdyyyfac">
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
    <tr style="color:#1f4248; height:30px;">
    <?php
    $zhdyyyfs = explode(",",$Record[22]);
    $yfjshi=1;
    foreach($zhdyyyfs as $k => $v){
      echo "<td align=\"left\" bgcolor=\"#FFFFFF\"><input name='yyzhdyfs[]' type='checkbox' class='np' id='yyzhdyf".$yfjshi."' value='".$v."' checked >".$v."</td>";
      if($yfjshi%3==0){echo "</tr><tr style=\"color:#1f4248; font-size:12px;\">";}
      //echo $yfjshi;
      $yfjshi++;
    }
    ?>
    </tr>
  </table>
          </div>
        </div>
        <div>
            <span class="label">是否接收AE回访：</span><input <?php if($Record[23]=='1'){echo "checked=\"true\"";}?> id="shfjshhf" name="shfjshhf" type="radio" value="1" /><label for="shfjshhf">是</label> <input <?php if($Record[23]=='0'){echo "checked=\"true\"";}?> id="shfjshhf" name="shfjshhf" type="radio" value="0" /><label for="shfjshhf">否</label></div>
<div class="insinsins" style="width:100%;"><label>状态：</label><label for="shfzt">启用</label><span><input <?php if($Record[21]=='1'){echo "checked";}?>  id="shfzt" name="shfzt" type="radio" value="1" /></span> <label for="shfzt">停用</label><span><input <?php if($Record[21]=='0'){echo "checked";}?> name="shfzt" value="0"  type="radio" /></span></div>
            
        <div class="btnPos">
            <input type="submit" value="保存" class="uusub" /></div>
<?php
  }
?>
        </form>
    </div>
<script language="javascript">  

function validate(){
	if($.trim($("#yymch").val()).length == 0){
		alert('请填写医院名称!');
		return false;
	}
	if($("#s_county").val() == "市、县级市"){
		alert('请选择医院所在城市!');
		return false;
	}

	if($.trim($("#s_county").val()).length == 0){
		alert('请选择医院所在地区!');
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



    $(document).ready(function(){

        $("#s_city").change(function(){ 
            //alert('aaaaa');
            var shimch = $("#s_city").val();
            $.get('zhdyyyfac.php',{'shimch':shimch},function(data){
              $("#zhdyyyfac").html(data);//alert(data);
            });
          });
    
        
    chooseDateNow('yshpxrq', true);
            //绑定提交验证
            $("input:submit").unbind("click");
            $("#submitBtn").bind("click", function () {
            //if("#shouji")
                if (confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("form").submit();
                    return false;
                }
                return false;
            });
            $("input:submit").attr("disabled", false);
    });
    <?php 
    if($zhdyyyfs!=""){
    
    }
    ?>
    
function tjyzh(v){
if(v>'0'){
$('#upfile_type').val(v);
document.getElementById('tjyzh').style.display='block';
document.getElementById("submitBtn").disabled=true;
}else{
document.getElementById('tjyzh').style.display='none';
document.getElementById("submitBtn").disabled=false;
}
}
</script> 

	
<style>
.mindess {
	width:666px;
	font-size:12px;
	height:auto;
	position:fixed;
	z-index:100;
	left:25%;
	/*margin:0 auto 0 -343px; /* margin-left需要是宽度的一半 */
	top:40%;
	padding:1px;
	background:#25679c;
	border:1px #25679c solid;
}</style>

  <div class="mindess" id="tjyzh" style="display:none; border:3px solid #FFFFFF; clear:both;">
	<div style="position:absolute; right:15px;"><a style="color:#FFFFFF; cursor:pointer;" onclick="tjyzh(0)">关闭</a></div>
		<fieldset style="background:#ffffff;">
            <legend style="background:#ffffff;">上传图片</legend>

<form enctype="multipart/form-data" method="post" name="upform" >  
  上传文件:  
  <input name="upfile" type="file">  
  <input name="upfile_type" id="upfile_type" type="hidden">  
  <input type="submit" value="上传"><br>  
  允许上传的文件类型为:<?php echo implode(', ',$uptypes);?>  
</form>

        </fieldset>
	</div>   
    </div>
        </div>
    </div>
        </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')   
{  
$imgi=$_POST['upfile_type'];
    //echo $imgi;
    //print_r($_FILES["upfile"]);
    if (!is_uploaded_file($_FILES["upfile"][tmp_name]))  
    //是否存在文件  
    {  
         echo "<script>alert('图片不存在!');</script>";  
         exit;  
    }  
  
    $file = $_FILES["upfile"];  
    if($max_file_size < $file["size"])  
    //检查文件大小  
    {  
        echo "<script>alert('文件太大!');</script>";  
        exit;  
    }  
  
    if(!in_array($file["type"], $uptypes))  
    //检查文件类型  
    {  
        echo "<script>alert('文件类型不符!".$file["type"]."');</script>";  
        exit;  
    }  
  
    if(!file_exists($destination_folder))  
    {  
        mkdir($destination_folder);  
    }  
  
    $filename=$file["tmp_name"];  
    $image_size = getimagesize($filename);  
    $pinfo=pathinfo($file["name"]);  
    $ftype=$pinfo['extension'];  //文件后缀名，系统设计jpg所以不用获得了
    $destination = $destination_folder.sprintf("%03d", $yshyzhid)."-".$imgi.".jpg";  
    /*if (file_exists($destination) && $overwrite != true)  
    {  
        echo "同名文件已经存在了";  
        exit;  
    }  */
  
    if(!move_uploaded_file ($filename, $destination))  
    {  
        echo "<script>alert('移动文件出错');</script>";  
        exit;  
    }  
  
    $pinfo=pathinfo($destination);  
    $fname=$pinfo[basename]; 
    $_SERVER['REQUEST_METHOD']='GET';
    echo "<script>alert('成功');</script>";   
}
?>