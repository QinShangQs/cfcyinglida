<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yfid = $_GET['id'];
$html_title="修改指定药房";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div> 
    <div class="form">
        <form action="xgzhdyfac.php" method="post" enctype="multipart/form-data">
<?php        
  $sql = "select * from `yf` where `id`='".$yfid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <input type="hidden" name="id" value="<?php echo $yfid;?>" />
        
        <div>
            <span class="label">药房名称：</span><input class="grd-white2" id="yfmch" name="yfmch" style="width: 660px;" type="text" value="<?php echo $Record[1];?>" /></div>
        <div>
            <span class="label">药房所在城市：</span><input class="grd-white2" id="yfsheng" name="yfsheng" style="width: 80px;" type="text" value="<?php echo $Record[10];?>" /> <input class="grd-white2" id="yfshi" name="yfshi" style="width: 80px;" type="text" value="<?php echo $Record[14];?>" /> <input class="grd-white2" id="yfqu" name="yfqu" style="width: 80px;" type="text" value="<?php echo $Record[16];?>" /> 
</div>
        <div>
            <span class="label">药房地址：</span><input class="grd-white2" id="yfdzh" name="yfdzh" style="width: 660px;" type="text" value="<?php echo $Record[2];?>" /></div>
        <div>
            <span class="label">联系方式(座机)：</span><input class="grd-white2" id="yfdh" name="yfdh" type="text" value="<?php echo $Record[3];?>" /></div>
        <div>
            <span class="label">联系方式(移动)：</span><input class="grd-white2" id="yfshj" name="yfshj" type="text" value="<?php echo $Record[4];?>" /></div>
        <div>
            <span class="label">联系方式(传真)：</span><input class="grd-white2" id="yfchzh" name="yfchzh" type="text" value="<?php echo $Record[5];?>" /></div>
        <div>
            <span class="label">联系方式(email)：</span><input class="grd-white2" id="yfemail" name="yfemail" type="text" value="<?php echo $Record[6];?>" /></div>
        <div>
            <span class="label">库容：</span><input class="grd-white2" id="yfkcrl" name="yfkcrl" type="text" value="<?php echo $Record[9];?>" />瓶</div>
        <div>
            <span class="label">指定药师：</span><input class="grd-white2" id="yfzhdysh" name="yfzhdysh" type="text" value="<?php echo $Record[11];?>" /></div>
        <div>
            <span class="label">指定药师用户名：</span><input class="grd-white2" id="yfyshname" name="yfyshname" type="text" value="<?php echo $Record[13];?>" readonly /></div>
        <div>
            <span class="label">指定药师性别：</span><select name="yfzhdyshxb" style="width: 116px;" class="grd-white2">
       <?php if($Record[21]=="男"){$yfzhdyshxb=1;}else{$yfzhdyshxb=0;}?>
    <option value="男" <?php if($yfzhdyshxb==1){echo "selected=\"true\"";}?>>男</option><option value="女" <?php if($yfzhdyshxb==0){echo "selected=\"true\"";}?>>女</option></select></div>
        <div>
            <span class="label">指定药师样张：</span>
            <input type="file" name="yfzhdyshyzh"/>
            <img src="/qzyzh/<?php echo $Record[18];?>" width="100px" height="100px"/></div>
        <div>
            <span class="label">授权药师：</span><input class="grd-white2" id="yfshqysh" name="yfshqysh" type="text" value="<?php echo $Record[19];?>" /></div>
        <div>
            <span class="label">授权药师样张：</span>
            <input type="file" name="yfshqyshyzh"/>
            <img src="/qzyzh/<?php echo $Record[20];?>" width="100px" height="100px"/></div>
        <div>
            <span class="label">授权药师电话：</span><input class="grd-white2" id="yfshqyshdh" name="yfshqyshdh" type="text" value="<?php echo $Record[22];?>" /></div>
        <div>
            <!-- <span class="label">培训班：</span><input class="grd-white2" id="pxb" name="pxb" type="text" value="<?php //echo $Record[23];?>" /></div> -->
        <div>
            <span class="label">新增日期：</span><input class="grd-white2" id="pxrq" name="newtime" type="text" value="<?php echo $Record[25];?>" /></div>
        <div class="insinsins" style="width:100%;"><label>办公时间：</label><span>
<?php 
    if(!empty($Record[26])){
        $zhouji = explode(',', $Record[26]);
        $zhouji = array_flip($zhouji);
    }
    if(!empty($Record[27])) {
        $start = explode('-', $Record[27]);
        if(isset($start[0]) && !empty($start[0])) {
            $start1 = explode(':', $start[0]);
        }
        if(isset($start[1]) && !empty($start[1])) {
            $start2 = explode(':', $start[1]);
        }
    }
    if(!empty($Record[27])) {
        $end = explode('-', $Record[27]);
        if(isset($end[0]) && !empty($end[0])) {
            $end1 = explode(':', $end[0]);
        }
        if(isset($end[1]) && !empty($end[1])) {
            $end2 = explode(':', $end[1]);
        }
    }
    
?>
<span>
    <input type="checkbox" name="bgsj[]" value="1" <?php echo empty($zhouji[1]) ? '' : 'checked'; ?>/>星期一
    <input type="checkbox" name="bgsj[]" value="2" <?php echo empty($zhouji[2]) ? '' : 'checked'; ?>/>星期二
    <input type="checkbox" name="bgsj[]" value="3" <?php echo empty($zhouji[3]) ? '' : 'checked'; ?>/>星期三
    <input type="checkbox" name="bgsj[]" value="4" <?php echo empty($zhouji[4]) ? '' : 'checked'; ?>/>星期四
    <input type="checkbox" name="bgsj[]" value="5" <?php echo empty($zhouji[5]) ? '' : 'checked'; ?>/>星期五
    <input type="checkbox" name="bgsj[]" value="6" <?php echo empty($zhouji[6]) ? '' : 'checked'; ?>/>星期六
    <input type="checkbox" name="bgsj[]" value="7" <?php echo empty($zhouji[7]) ? '' : 'checked'; ?>/>星期日
</span>
&nbsp;上午：
<select name="start1">
    <option value="">--请选择--</option>
    <?php for($i=1; $i<25; $i++):?>
    <option value="<?php echo $i;?>:00" <?php echo !empty($start1[0]) && $start1[0] == $i ? 'selected' : ''; ?>><?php echo $i;?>:00</option>
    <?php endfor; ?>
</select> -
<select name="start2">
    <option value="">--请选择--</option>
    <?php for($i=1; $i<25; $i++):?>
    <option value="<?php echo $i;?>:00" <?php echo !empty($start2[0]) && $start2[0] == $i ? 'selected' : ''; ?>><?php echo $i;?>:00</option>
    <?php endfor; ?>
</select>
下午：
<select name="end1">
    <option value="">--请选择--</option>
    <?php for($i=1; $i<25; $i++):?>
    <option value="<?php echo $i;?>:00" <?php echo !empty($end1[0]) && $end1[0] == $i ? 'selected' : ''; ?>><?php echo $i;?>:00</option>
    <?php endfor; ?>
</select> -
<select name="end2">
    <option value="">--请选择--</option>
    <?php for($i=1; $i<25; $i++):?>
    <option value="<?php echo $i;?>:00" <?php echo !empty($end2[0]) && $end2[0] == $i ? 'selected' : ''; ?>><?php echo $i;?>:00</option>
    <?php endfor; ?>
</select>
</span></div>
        <div>
            <span class="label"></span>
            <input <?php if($Record[7]=='1'){echo "checked";}?> id="shfzt" name="shfzt" type="radio" value="1" /><label for="shfzt">启用</label> <input  <?php if($Record[7]=='0'){echo "checked";}?> name="shfzt" value="0"  type="radio" /><label for="shfzt">停用</label></div>
        <div class="btnPos">
            <input type="submit" value="保存" class="uusub" />  <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
<?php
  }
?>

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

