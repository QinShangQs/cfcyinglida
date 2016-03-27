<?php 
@header('Content-type: text/html;charset=utf-8');
session_start();
include('wdb.php');
$db = new DB();
if(empty($_POST)):
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>index</title>
		<meta name="description" content="">
		<meta name="author" content="dell">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/general.css"/>
		<link rel="stylesheet" href="css/login.css"/>
	</head>

	<body>
        <div class="wapper">
            <div class="header">
                <div class="logo"></div>
                <div class="menu">
                    <table>
                        <tbody>
                            <tr>
                                <td width="30"></td>
                                <td width="120"><a href="index.php">首页</a></td>
                                <td width="120"><a>项目简介</a></td>
                                <td width="120"><a>项目动态</a></td>
                                <td width="120"><a>政策规定</a></td>
                                <td width="120"><a>项目指南</a></td>
                                <td width="120"><a>联系我们</a></td>
                                <td width="30"></td>
                            </tr>
                        </tbody>	
                    </table>
                </div>
                
                <div class="login">
                    <?php if(empty($_SESSION['yhid'])):?>
					<a href="/i_patient_login.php">登录</a>
    				<?php 
    				    else:
    				    echo "<a href='#'>$_SESSION[yhname]</a>";
    				    endif;
    				?>
    				<?php if(!isset($_SESSION['yhid'])): ?>	
    					<a href="/i_pat_reg.php">注册</a>
    					<a href="/i_wjpwd.php">找回密码</a>
    				<?php else: ?>
    				    <a href="/i_editpwd.php">修改密码</a>
    				    <a href="/i_patlogout.php" >注销</a>
    				<?php endif; ?>
                </div>
            </div>
            
            <div class="bodyer">
                <div class="login">
                    <form action="/i_patient_login.php"  method="post" id="formId">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="80" class="one">用户名：</td>
                                    <td width="220" class="two"><input class="inps" name="username" /></td>
                                </tr>
                                <tr>
                                    <td class="one">密<span>空</span>码：</td>
                                    <td class="two"><input class="inps" name="password" type="password" /></td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="submit">登陆</a>
                    </form>
                </div>
            </div>
            
            <div class="footer">
                <div class="info">
                    <a>公司简介</a>
                    <a>关于我们</a>
                    <a>公司服务</a>
                    <a>产品说明</a>
                </div>
                <!-- <div class="copy">北京市朝阳区</div> -->
            </div>
        </div>
	</body>
</html>

<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>
<script type="text/javascript">
$(function(){
    $(".submit").click(function(){
        document.getElementById("formId").submit();
    });
});

</script>
<?php
 else:
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    (empty($username) || empty($password)) && $db->returnError('账号或密码不能为空', '点击返回', '/i_patient_login.php'); //写成
    $arr = $db->getRow("select * from patient_account where name = '$username' and password ='".md5($password)."'");
    empty($arr) && $db->returnError('账户密码错误！忘记密码了吗？', '点击返回', '/i_patient_login.php', '/i_wjpwd.php');
    $_SESSION['yhid'] = $arr['pat_uid'];
    $_SESSION['yhname'] = $arr['name'];
    $_SESSION['role'] = 'pat';
    header("location: /i_addpatinfo.php");
//     header("location: /i_patient.php"); //跳转到患者填写资料的页面 
  endif;
?>