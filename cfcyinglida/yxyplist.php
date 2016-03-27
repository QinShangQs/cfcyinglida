<?php
session_start();
@header('Content-type: text/html;charset=utf-8');
include('wdb.php');
$db = new DB();
$sql = "select * from ypname";
$html_title="一线药品";
include('spap_head.php');
if(empty($_GET['delid'])):
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一线药品</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script  src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
</head>

<body>
<div class="wrap">
	
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="/yxyplist.php">一线药品</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>一线药品</strong><span><a href="i_addyxyp.php">新增一线药品</a></span>
				</div>
				<div class="incontact w955 flt">
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                      <td width="10%" align="center" bgcolor="#FFFFFF">药品名</td>
                      <td width="7%" align="center" bgcolor="#FFFFFF">添加时间</td>
                      <td width="7%" align="center" bgcolor="#FFFFFF">操作</td>
                    </tr>
                    <?php
                    $yplist = $db->getAll($sql);
                    if(!empty($yplist)):
                        foreach($yplist as $key=>$val):
                    ?>
                   <tr style="color:#1f4248; font-weight:bold; height:30px;">
                        <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $val['ypname'];?></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo date('Y-m-d', $val['create_time']);?></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><a href="/yxyplist.php?delid=<?php echo $val['id'];?>">删除</a></td>
                   </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                  </table>
				</div>

			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php else: ?>
<?php 
    $id = $_GET['delid'];
    $true = $db->delete('ypname', 'id='.$id);
    if($true) {
        $db->returnError('删除成功', '点击返回', '/yxyplist.php');
    } else {
        $db->returnError('删除失败', '点击返回', '/yxyplist.php');
    }
?>
<?php endif; ?>