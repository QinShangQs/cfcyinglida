<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid=$_GET['id'];
$html_title="修改申请状态";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> ><?php echo $html_title;?></div>
			<div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
    <h1>
        直接修改申请状态可能会导致数据一致性问题,请尽量少执行本操作。</h1>
    <form action="xgshqzhtac.php" method="post">
<input type="hidden" name="id" value="<?php echo $hzhid;?>" />
    <div class="top">
        申请状态 :
        <select id="ZhuangtaiMingcheng" name="ZhuangtaiMingcheng" class="grd-white2">
<option selected="selected" value="审核">审核</option>
<option value="审核通过">审核通过</option>
<option value="代办入组">代办入组</option>
<option value="入组">入组</option>
<option value="出组">出组</option>
<option value="锁定">锁定</option>
<option value="锁定">解锁</option>
<option value="停止申请">停止申请</option>
<option value="拒绝">拒绝</option>
</select>
    </div>
    <div class="top">
            <input type="submit" value="保存" class="uusub" />
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
    </form>
            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
</body>
</html>
