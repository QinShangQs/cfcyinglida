<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>中国癌症基金会</title>
		<meta name="description" content="">
		<meta name="author" content="dell">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		
		<link rel="stylesheet" href="/style/cfc.css" />
		
		<style>
			div.header, div.bodyer, div.conter, div.footer {
    			overflow:hidden;
    			max-width:100%;
    			min-width:1024px;
			}
			
			div.header {
    			height:46px;
    			background:#000000;
			}
			
			div.bodyer {
				position:relative;
				height:420px;
				background:#cec5b4;
				margin:0 0 30px 0;
			}
			
			div.header > div.body, div.bodyer > div.body {
				width:1024px;
				height:100%;
				margin:auto;
				position:relative;
			}
			
			div.header > div.body > div.logoName {
				color:#ffffff;	
				padding:15px 0 0 0;
				float:left;
			}
			
			div.header > div.body > div.oper {
				height:100%;
				padding:15px 0 0 0;
				float:right;
			}
			
			div.header > div.body > div.oper > a {
				color:#ffa200;	
				padding:0 10px;
				font-size:16px;
				cursor:pointer;
			}
			
			div.bodyer > div.body > div.bgImg {
				position:absolute;
				z-index:10;
				width:100%;
				height:100%;
				background:url(/images/bj.png) no-repeat;
			}
			
			div.bodyer > div.body > div.notice {
				position:absolute;
				z-index:100;
				left:580px;
				top:60px;
				width:400px;
				color:#ffffff;
			}
			
			div.bodyer > div.body > div.notice > span.title {
				display:block;
				font-size:44px;
				text-indent:-5px;
				margin:0 0 20px 0;
			}
			
			div.bodyer > div.body > div.notice > span.cont {
				display:block;
				line-height:22px;
				font-size:16px;
				margin:10px 0;
			}
			
			div.bodyer > div.body > a.apply {
				position:absolute;	
				left:580px;
				top:300px;
				z-index:100;
				display:block;
				width:250px;
				height:60px;
				line-height:60px;
				text-align:center;
				font-size:24px;
				color:#ffffff;
				border-radius:5px;
				background:#428bca;
				cursor:pointer;
				text-decoration:none;
			}
			
			div.conter {
				width:1024px;
				margin:auto;
			}
			
			div.conter > div.economy, div.conter > div.medical {
				width:100%;
				height:26px;
				line-height:20px;
				margin:auto;
				border-bottom:1px solid #9AB5C6; 
				text-indent:10px;
				font-size:20px;
				font-weight:bold;
				padding:30px 0 0px 0;
			}
			
			div.conter > span.cont {
				font-size:16px;	
				line-height:24px;
				padding:0 10px 0 10px;
				margin:15px 0;
				display:block;
			}
			
			div.conter > span.cont.memo {
				color:red;
			}
			
			table.tableStyle {

			}
			
			table.tableStyle tr, table.tableStyle td {
				border:1px solid #9AB5C6;	
				width:50px;
				text-align:center;
			}
			
			div.footer {
				margin:30px 0 0 0;
				height:66px;
				background:#484848;
			}
		</style>
	</head>

	<body>
		<div class="header">
			<div class="body">
				<div class="logoName">中国癌症基金会</div>
				<div class="oper">
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
		</div>
		
		<div class="bodyer">
			<div class="body">
				<div class="bgImg"></div>
				<div class="notice">
					<span class="title">预约申请须知</span>
					<span class="cont">1、所有材料务必按照要求邮寄到项目办</span>
					<span class="cont">2、请仔细阅读申请材料邮寄清单及填表要求，按规定提供资料</span>
					<span class="cont">3、因患者具体情况不同可能会补充其他证明材料，以项目办通知为准</span>
				</div>
				<?php if(isset($_SESSION['yhid'])): ?>
				    <a class="apply" href="/i_addpatinfo.php">预约申请</a>
				<?php else: ?>
				    <a class="apply">预约申请</a>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="conter">
			<div class="economy">需要邮寄的经济材料</div>
			<span class="cont">1、《英立达患者援助项目患者申请表》全套（1份）。</span>
			<span class="cont">2、患者本人有效期内的二代身份证正反面复印件（1份）。</span>
			<span class="cont">3、患者及其直系亲属的户口本复印件（1套）。</span>
			<span class="cont">4、患者1寸近照（2张）。</span>
			<span class="cont">5、患者及配偶名下所有的《房屋所有权证》复印件（1份）。农村的患者可提供土地使用证或宅基地证明复印件，无房产的患者需房产局或相关部门开具详细的居住证明（包括住房所有人、面积、居住人口、地址）</span>
			<span class="cont">6、购买英立达凭证(根据前期录入基础信息不同呈现不同的盒数)。</br>
			情况一：因细胞因子或其他酪氨酸激酶抑制剂（除索坦外）治疗失败，需提供10盒购药发票原件和购药清单原件（或处方签原件）。<br/>
			情况二：既往接受索坦治疗失败且曾完全进入索坦患者援助项目，需提供5盒购药发票原件和购药清单原件（或处方签原件）。<br/>
			情况三：未进入索坦项目的患者：需另提供X瓶索坦发票原件和购药清单原件（或处方签原件），需提供Y盒购药发票原件和购药清单原件（或处方签原件）。<br/><br/>
			X瓶：根据前期患者填写基础信息中的索坦瓶数显示。<br/>
			Y瓶：根据前期填写的索坦瓶数根据如下表格呈现对应瓶数。<br/>
			</span>
			<span class="cont">
				<table class="tableStyle">
					<tbody>
						<tr>
							<td>X</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
							<td>10</td>
							<td>11</td>
							<td>12</td>
						</tr>
						<tr>
							<td>Y</td>
							<td>10</td>
							<td>9</td>
							<td>8</td>
							<td>8</td>
							<td>7</td>
							<td>6</td>
							<td>6</td>
							<td>5</td>
							<td>4</td>
							<td>4</td>
							<td>3</td>
							<td>2</td>
						</tr>
					</tbody>
				</table>
			</span>
			<span class="cont memo">注：住院发票请提供住院发票复印件、住院清单及医保部门开具的英立达不报销证明。</span>
			
			<div class="medical">需要邮寄的医学材料</div>
			<span class="cont">1、首次确诊的肾细胞癌病理报告复印件。</span>
			<span class="cont">2、首次确诊的住院病历首页和出院小结复印件。</span>
			<span class="cont">3、服药一个疗程后可测量病灶的影像学检查报告单原件/复印件（影像学报告包括CT/PET-CT/ECT/MRI/血管造影等）</span>
			<span class="cont">4、既往服用过细胞因子或酪氨酸激酶抑制剂治疗不能耐受的患者需提供：指定医生开具的不能耐受的诊断证明。</span>
			<span class="cont">5、既往服用过细胞因子或酪氨酸激酶抑制剂的证明文件（药品发票复印件、购药清单复印件、治疗相关病例复印件、处方医生开具证明盖医院章，任选其一）</span>
		</div>
		
		<div class="footer">
			
		</div>
	</body>
</html>
