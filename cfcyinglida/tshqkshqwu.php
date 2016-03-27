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
        <form action="tshqkshqwuac.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <input type="hidden" name="qk" value="<?php echo $qk;?>" />
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
</body>
</html>
