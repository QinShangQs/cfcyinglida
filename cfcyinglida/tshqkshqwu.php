<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$qk=$_GET['qk'];
$html_title="特殊情况授权发药（无证明）";
include('spap_head.php');
?>
     <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div>
    <div class="form">
        <form action="tshqkshqwuac.php" method="post" onsubmit="return validate()">
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <input type="hidden" name="qk" value="<?php echo $qk;?>" />
        <div>
        <br/>
        <span class="label">授权发药原因：</span>
        	<select id="syfyyy" name="syfyyy" onchange="changeyy()">
        		<option value="0">请选择...</option>
        		<option value="提前领药">提前领药</option>
        		<option value="长期未领药">长期未领药</option>
        		<option value="其他">其他</option>
        	</select>
        	<input id="syfyyy_qt" name="syfyyy_qt" type="text" style="display: none" />
        </div>
        <div>
            <span class="label">是否生效：</span><input checked="checked" id="shqzht" name="shqzht" type="radio" value="1" /><label for="shqzht">是</label> <input name="shqzht" value="0"  type="radio" /><label for="shqzht">否</label></div>
        <div class="btnPos">
            <input type="submit" value="保存" class="lgSub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="lgSub" /></div>
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
    
    <script type="text/javascript">
		function changeyy(){
			var syfyyy = $("#syfyyy").val();
			if(syfyyy == "其他"){
				$('#syfyyy_qt').show();
			}else{
				$('#syfyyy_qt').val('');
				$('#syfyyy_qt').hide();
			}
		}
    
		function validate(){
			var syfyyy = $("#syfyyy").val();
			var syfyyy_qt = $.trim($('#syfyyy_qt').val());
			if(syfyyy == "0"){
				alert('请选择授权发药原因!');
				return false;
			}
			if(syfyyy == "其他" && syfyyy_qt.length == 0){
				alert('请填写授权发药原因!');
				$('#syfyyy_qt').focus();
				return false;
			}
			return true;
		}
	</script>
</body>
</html>
