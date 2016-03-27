<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yfid = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改指定药房</title>
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
        - 修改指定药房</div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>修改指定药房</strong><span></span>
				</div>
          <form action="zhdyfxgac.php" method="post" enctype="multipart/form-data">
<?php        
  $sql = "select * from `yf` where `id`='".$yfid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <input type="hidden" name="id" value="<?php echo $yfid;?>" />
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
<div class="insinsins" style="width:100%;"><label>药房名称：</label><span><input class="grd-white" id="yfmch" name="yfmch" style="width: 660px;" type="text" value="<?php echo $Record[1];?>" /></span></div>

<div class="insinsins" style="width:100%;"><label>药房所在城市：</label><span><input class="grd-white" id="yfsheng" name="yfsheng" style="width: 60px;" type="text" value="<?php echo $Record[10];?>" /><input class="grd-white" id="yfshi" name="yfshi" style="width: 60px;" type="text" value="<?php echo $Record[14];?>" /><input class="grd-white" id="yfqu" name="yfqu" style="width: 60px;" type="text" value="<?php echo $Record[16];?>" /></span></div>
        
<div class="insinsins" style="width:100%;"><label>药房地址：</label><span><input class="grd-white" id="yfdzh" name="yfdzh" style="width: 660px;" type="text" value="<?php echo $Record[2];?>" /></span></div>

<div class="insinsins" style="width:100%;"><label>联系方式(座机)：</label><span><input class="grd-white" id="yfdh" name="yfdh" type="text" value="<?php echo $Record[3];?>" /></span></div>
<div class="insinsins" style="width:100%;"><label>联系方式(移动)：</label><span><input class="grd-white" id="yfshj" name="yfshj" type="text" value="<?php echo $Record[4];?>" /></span></div>
<div class="insinsins" style="width:100%;"><label>联系方式(传真)：</label><span><input class="grd-white" id="yfchzh" name="yfchzh" type="text" value="<?php echo $Record[5];?>" /></span></div>
<div class="insinsins" style="width:100%;"><label>联系方式(email)：</label><span><input class="grd-white" id="yfemail" name="yfemail" type="text" value="<?php echo $Record[6];?>" /></span></div>
<!-- <div class="insinsins" style="width:100%;"><label>库容：</label><span><input class="grd-white" id="yfkcrl" name="yfkcrl" type="text" value="<?php echo $Record[9];?>" />瓶</span></div> -->

<div class="insinsins" style="width:100%;"><label>指定药师：</label><span><input class="grd-white" id="yfzhdysh" name="yfzhdysh" type="text" value="<?php echo $Record[11];?>" /></span></div>
<div class="insinsins" style="width:100%;"><label>指定药师用户名：</label><span><input class="grd-white" id="yfyshname" name="yfyshname" type="text" value="<?php echo $Record[13];?>" readonly /></span></div>
<div class="insinsins" style="width:100%;"><label>指定药师性别：</label><span><select name="yfzhdyshxb" style="width: 116px;"  class="grd-white2">
    <?php if($Record[21]=="男"){$yfzhdyshxb=1;}else{$yfzhdyshxb=0;}?>
    <option value="男" <?php if($yfzhdyshxb==1){echo "selected=\"true\"";}?>>男</option><option value="女" <?php if($yfzhdyshxb==0){echo "selected=\"true\"";}?>>女</option>
    </select></span></div>
<div class="insinsins" style="width:100%;"><label>指定药师样张：</label><span><input class="grd-white" id="yfzhdyshyzh" name="yfzhdyshyzh" type="file"/>
        <img src="/qzyzh/<?php echo $Record[18];?>" width="100px" height="100px"/> </span></div>

<div class="insinsins" style="width:100%;"><label>授权药师：</label><span><input class="grd-white" id="yfshqysh" name="yfshqysh" type="text" value="<?php echo $Record[19];?>" /></span></div>
<div class="insinsins" style="width:100%;"><label>授权药师样张：</label><span><input class="grd-white" id="yfshq
yshyzh" name="yfshqyshyzh" type="file" />
        <img src="/qzyzh/<?php echo $Record[20];?>" width="100px" height="100px"/> </span></div>
<div class="insinsins" style="width:100%;"><label>授权药师电话：</label><span><input class="grd-white" id="yfshq
yshdh" name="yfshqyshyzh" type="text" value="<?php echo $Record[22];?>" /></span></div>
<!-- <div class="insinsins" style="width:100%;"><label>培训班：</label><span><input class="grd-white" id="pxb" name="pxb" type="text" value="<?php //echo $Record[23];?>" /></span></div> -->
<div class="insinsins" style="width:100%;"><label>新增日期：</label><span><input class="grd-white" id="pxrq" name="newtime" type="text" value="<?php echo $Record[25];?>" /></span></div>
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
<div class="insinsins" style="width:100%;"><label>状态：</label><label for="shfzt">启用</label><span><input <?php if($Record[7]=='1'){echo "checked";}?>  id="shfzt" name="shfzt" type="radio" value="1" /></span> <label for="shfzt">停用</label><span><input <?php if($Record[7]=='0'){echo "checked";}?> name="shfzt" value="0"  type="radio" /></span></div>




					  </td>
                    </tr>
                  </table>

				</div>
        <div class="incontact w955 flt">
          <input type="submit" class="uusub" value="提交保存" /> <input type="button" class="uusub2" onclick="javascript:{history.go(-1);}"  value="取消" />
				</div>	
<?php
  }
?>
			</form>
			</div>
		</div>
	</div>
</div>
</body>
<script language="javascript">  
$(document).ready(function(){
chooseDateNow('pxrq', true);
}); 
</script> 
</html>