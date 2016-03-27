<?php session_start(); 
/*spap全部css，js
$html_title="修改指定地区捐赠数量";
include('xpap_head.php');
<?php echo $html_title;?>

*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $html_title;?></title>
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <link href="style/jquery.autocomplete.css" rel="Stylesheet" type="text/css" />
  <link href="style/jquery.ui.all.css" rel="Stylesheet" type="text/css" />
  <link href="style/jquery.ui.tabs.css" rel="Stylesheet" type="text/css" />
  <link href="style/jquery.ui.dialog.css" rel="Stylesheet" type="text/css" />
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  <script type="text/javascript" src="js/SelectDate.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
  <script type="text/javascript" src="js/jquery.ui.core.js"></script>
</head>

<body>
<div class="wrap"><?php /*主框大div[wrap]开始*/?>
	<div class="head"><?php /*div[head]开始*/?>
		<div class="head_info">
			<div class="head_left"><a href="manager.php"><img src="./images/tp_left.gif" /></a></div>
			<div class="head_right">
				<div class="head_right_top"><img src="./images/head_right_top.gif" /></div>
				<div class="head_right_middle">欢迎您，<?php echo $_SESSION[yhname];?> <a href="/">注销</a> <?php 
              if($_SESSION[yhln]=='admin'&&$_SESSION[yhshf]=='3'){
            ?>
              <a href="qhyfshfjr.php?shfhy=1">还原身份</a>(<?php echo $_SESSION[gldw]; ?>)
            <?php
              }
            ?> 
            <?php if($_SESSION['role'] == 'doc'): ?>
                <a href="xgmm.php">修改密码</a>
            <?php elseif($_SESSION['role'] == 'pat'): ?>
                <a href="i_editpwd.php">修改密码</a>
            <?php endif; ?>
            
             <?php if($_SESSION['role'] == 'doc'): ?>
                    <a href="/manager.php">首页</a>
             <?php endif; ?>
                </div>
				<div class="head_right_nav">
					<ul>
<!--						<li><strong><a href="#">刷新当前页</a></strong></li>
						<li><strong><a href="#">数据备份</a></strong></li>
						<li><strong><a href="#">不良事件</a></strong></li>
						<li><strong><a href="#">统计</a></strong></li>
						<li><strong><a href="#">转诊</a></strong></li>
						<li><strong><a href="#">随访</a></strong></li>
						<li><strong><a href="#">出组</a></strong></li>-->
					</ul>
				</div>
			</div>
		</div>
	</div><?php /*div[head]结束*/?>
