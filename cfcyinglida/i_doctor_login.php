<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
unset($_SESSION);
session_destroy();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中国癌症基金会英立达患者援助项目在线管理系统</title>
<link rel="stylesheet" type="text/css" href="style/login.css">
</head>

<body>
<table class="index_wrap" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
	<div class="index_logo">
	<img src="./images/logo.png" />	</div>
	<div class="index_inputs">
	<table width="997" height="144" align="center">
		<div class="index_ins">
			<div class="left"><img src="./images/tp_left.gif" /></div>
			<div class="right">
				<div class="top">
				<img src="./images/login_text.gif" />
				</div>
                                <form action="indexac.php"  method="post">
                                    <div class="bottom">
                                            <ul>
                                                    <li>用户名：</li>
                                                    <li><input class="inps" name="UserName" /></li>
                                                    <li>密　码：</li>
                                                    <li><input class="inps" name="Password" type="password" /></li>
                                                    <li><input type="image" src="./images/index_botton.gif" width="134" height="34" /></li>
                                            </ul>
                                    </div>
				</form>
			</div>
		</div>
	</table>
	</div>
	</td>
  </tr>
</table>
</body>
</html>


