<?php
    @header('Content-type: text/html;charset=utf-8');
    include('wdb.php');
    $db = new DB();
    if(empty($_POST)):
    $quesli = $db->getAll("select * from sce_question");
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
                
<!--                 <div class="login"> -->
<!--                     <a>登录</a> -->
<!-- 					<a>修改密码</a> -->
<!-- 					<a>注册</a> -->
<!-- 					<a>找回密码</a> -->
<!--                 </div> -->
            </div>
            <form method="post" action="/i_editpwd.php" id='formId'>
            <div class="bodyer">
                <div class="login">
                    <table>
                        <tbody>
                            <tr>
                                <td width="90" class="one"><font color="red">*</font>用户名：</td>
                                <td width="220" class="two"><input type="text" name="username"/></td>
                            </tr>
                            <tr>
                                <td width="90" class="one"><font color="red">*</font>原密码：</td>
                                <td width="220" class="two"><input type="password" name="password"/></td>
                            </tr>
                            <tr>
                                <td class="one"><font color="red">*</font>新密码：</td>
                                <td class="two"><input type="password" name="passwordn" id='passwordnew'/></td>
                            </tr>
                            <tr>
                                <td class="one"><font color="red">*</font>确认密码：</td>
                                <td class="two"><input type="password" id="passwordnewqe"/></td>
                            </tr>
                            <tr>
                                <td class="one"><font color="red">*</font>密保问题：</td>
                                <td class="two">
                                    <select name="question">
                                        <option value="">请选择您的密保问题！.</option>
                                        <?php 
                                            if(!empty($quesli) && is_array($quesli)):
                                                foreach($quesli as $key => $val): 
                                        ?>
                                        <option value="<?php echo $val['q_id'];?>"><?php echo $val['q_name']; ?></option>
                                        <?php
                                                endforeach; 
                                            endif;
                                        ?>
                                    </select>
                                    <div class="pop">请选择您注册时填写的密保问题</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="one"><font color="red">*</font>密保答案：</td>
                                <td class="two"><input type="text" name="quedan" /></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <a class="submit">提交</a>
                </div>
            </div>
            </form>
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
        var passwordnew = $('#passwordnew').val();
        var passwordnewqe = $('#passwordnewqe').val();
        if(passwordnew != passwordnewqe) {
            alert('两次密码输入不统一'); return ;
        }
        document.getElementById("formId").submit();
    });
});
</script>
<?php 
    else:
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordn = $_POST['passwordn'];
    $question = trim($_POST['question']);
    $quedan = trim($_POST['quedan']);
    (empty($username) || empty($password) || empty($passwordn)) && $db->returnError('以上三项不能为空', '点击返回', '/i_editpwd.php');
//     $sql = "select * from patient_account where name = '".$username."' and password = '".md5($password)."'";
    $sql = "select * from patient_account where name ='" . $username."' and password = '". md5($password) ."' and question_id =".$question. " and question_dan ='".$quedan."'";
    $arr = $db->getRow($sql);
    empty($arr) && $db->returnError('该账号不存在', '点击返回', '/i_editpwd.php');
    $true = $db->update('patient_account', ['password' => md5($passwordn)], 'pat_uid='.$arr['pat_uid']);
    echo "密码修改成功,2秒钟跳转登陆";
    header("refresh:2;url=i_patient_login.php");
    endif;
?>