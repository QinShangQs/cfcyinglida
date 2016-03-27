<?php
   session_start(); 
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
		<link rel="stylesheet" href="css/index.css"/>
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
                                <td width="120"><a>首页</a></td>
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
                <div class="oper">
                <?php
                    if(empty($_SESSION['yhid'])) {
                        echo "<a class=\"one\" href='i_patient_login.php'>预约领药</a>";
                    } else {
                        echo "<a class=\"one\" href='i_addpatinfo.php'>预约领药</a>";
                    }
                ?>
                    <a class="two">资料下载</a>
                    <a class="thr">医生查询</a>
                    <a class="fou">医生培训</a>
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
