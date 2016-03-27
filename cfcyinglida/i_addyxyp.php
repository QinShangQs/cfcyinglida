<?php 
include('spap_head.php');
include('wdb.php');
$db = new DB();
if(empty($_POST)):
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增一线药品</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script  src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
</head>

<body>
<div class="wrap">
	
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="/i_addyxyp.php">新增一线药品</a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>新增一线药品</strong>
				</div>
				<div class="incontact w955 flt">
				<form action="i_addyxyp.php" method="post">
    				  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                        <tr style="color:#1f4248; font-weight:bold; height:30px;">
                          <td width="10%" align="center" bgcolor="#FFFFFF">药品名</td>
                          <td width="10%" align="center" bgcolor="#FFFFFF"><input name="ypname" type="text"/></td>
                        </tr>
                        <tr>
                            <td width="10%" align="center" bgcolor="#FFFFFF"><input type="submit" value="保存" class="uusub"/></td>
                        </tr>
                      </table>
                  </form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php else: ?>
<?php
    $ypname = $_POST['ypname'];
    if(!empty($ypname)) {
        $true = $db->insert('ypname', array('ypname' => $ypname, 'create_time' => time()));
        $db->returnError('添加成功', '返回药品列表', '/yxyplist.php');
    } else {
        $db->returnError('添加失败', '返回药品列表', '/yxyplist.php');
    }
?>
<?php endif; ?>