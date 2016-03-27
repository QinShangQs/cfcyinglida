<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增系统公告";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="xtggxxxz.php"><?php echo $html_title;?></a> </div> 
			<div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
    <div class="top">
        <form action="xtggxxxzac.php" method="post">
        <div class="top">
            <span class="label">发布公告/盘点：</span><input checked="checked" id="tshgn" name="tshgn" type="radio" value="0" onclick="fbgg(0)"/><label for="tshgn">公告</label> <input name="tshgn" value="1"  type="radio"  onclick="fbgg(1)"/><label for="tshgn">盘点</lab  el></div>
        <div class="top">
            <span class="label">公告标题：</span><input class="grd-white" id="ggbt" name="ggbt" type="text" value="" />
</div>
        <div id='fbggnr' class="top">
            <span class="label">公告内容：</span><textarea  class="grd-white" id="fbggnr" name="ggnr" type="textarea"></textarea></div>
        <div id='fbpdnr' style="display:none;" class="top">
            <span class="label">盘点内容：</span><input id="fbpdnr1" name="ggnr" type="radio" value="0"/><label for="tshgn">上月</label> <input id="fbpdnr2" name="ggnr" value="1"  type="radio"/><label for="tshgn">本月</label></div>
        <div class="top">
            <span class="label">公告日期：</span><input class="grd-white" id="ggrq" name="ggrq" type="text" value="<?php echo date('Y-m-d');?>" /></div>
        <div class="top">
            <span class="label">公告是否生效：</span><input checked="checked" id="ggzht" name="ggzht" type="radio" value="1" /><label for="ggzht">启用</label> <input name="ggzht" value="0"  type="radio" /><label for="ggzht">停用</label></div>

        <div class="top">
            <span class="label">针对权限：</span><input id="yfysh" name="yfysh" type="checkbox" value="3" readonly />药房药师<input id="ysh" name="ysh" type="checkbox" value="4" readonly />医生<input id="mxyh" name="xgy" type="checkbox" value="5" readonly />协管员</div>
        <div class="top">
            <span class="label">发起人：</span><input class="grd-white" id="fqr" name="fqr" type="text" value="<?php echo $_SESSION[yhname];?>" readonly /></div>
        <div class="top">
            <input type="submit" value="保存" class="uusub" /></div>
        </form>
    </div>

            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
<script type="text/javascript">
chooseDateOld('ggrq', true);
function fbgg(v){
if(v=='0'){
document.getElementById('fbggnr').style.display='block';
document.getElementById('fbpdnr').style.display='none';
document.getElementById('fbggnr').disabled = false;
document.getElementById('fbpdnr1').disabled = true;
document.getElementById('fbpdnr2').disabled = true;

}else{
document.getElementById('fbpdnr').style.display='block';
document.getElementById('fbggnr').style.display='none';
document.getElementById('fbggnr').disabled = true;
document.getElementById('fbpdnr1').disabled = false;
document.getElementById('fbpdnr2').disabled = false;
}
}
</script>

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
