<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET["id"];
$html_title="新增辉瑞编码";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
            
    <div class="position">
        当前位置：<a href="blshjgl.php">不良事件报告管理</a>
        > <?php echo $html_title;?></div>
        <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <div class="top">
        <form action="blshjxzhrac.php" method="post">
        <input id="id" name="id" type="hidden" value="<?php echo $id;?>" />
        <div>
            <span class="label" style="width:180px;">辉瑞编码：</span><input class="grd-white" id="hrbm" name="hrbm" type="text" value=""/>
        </div>

        <div class="top">
            <input id="btnSave" type="submit" value="保存" class="uusub" />
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
        </form>
    </div>
            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
</body>
</html>
