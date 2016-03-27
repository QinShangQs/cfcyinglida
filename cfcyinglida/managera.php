<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="药品发放详细信息";
include('spap_head.php');
?>
	<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="/manager.php">管理首页</a> </div>
			<div class="inwrap flt top">


				<div class="title w977 flt top">
				<strong>系统管理员工作站</strong><span></span>
				</div>
				<div class="incontact w955 flt">
<?php 
if($_SESSION[yhshf]=='10') {
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="zhdyygl.php" title="医院医生管理">医院医生..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="zhdyfgl.php" title="药房药师管理">药房药师..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="bfdqzyshlgl.php" title="部分地区赠药数量管理">部分地区..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yhgl.php" title="用户管理">用户管理</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="xtggxx.php" title="系统公告">系统公告</a></div>
					</div>
<?php
    }
?>

				</div>

				<div class="title w977 flt top">
				<strong>CFC管理员操作</strong><span></span>
				</div>
				<div class="incontact w955 flt">
<?php
if($_SESSION[yhshf]=='10'||$_SESSION[yhshf]=='2') {

if(in_array('blshjbggl_ck',$_SESSION[yhqxxf])||in_array('sfjlgl_ck',$_SESSION[yhqxxf])||in_array('wshyygl_ck',$_SESSION[yhqxxf])||in_array('zhdyfgl_ck',$_SESSION[yhqxxf])||in_array('zhdyygl_ck',$_SESSION[yhqxxf])||in_array('zhzhgl_ck',$_SESSION[yhqxxf])||in_array('shqgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){

if(in_array('shqgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="shqgl.php" title="申请管理">申请管理</a></div>
					</div>
<?php
}

if(in_array('zhzhgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="zhzhshqgl.php" title="转诊管理">转诊管理</a></div>
					</div>
<?php
}

if(in_array('zhdyygl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="cfcyyyshchx.php" title="指定医院医生管理">指定医院..</a></div>
					</div>
<?php
}

if(in_array('zhdyfgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="cfcyfchx.php" title="指定药房药师管理">指定药房..</a></div>
					</div>
<?php
}

if(in_array('wshyygl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="wshshqgl.php" title="网上预约管理">网上预约..</a></div>
					</div>
<?php
}

if(in_array('sfjlgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="cfcsfjlgl.php" title="随访记录管理">随访记录..</a></div>
					</div>
<?php
}

if(in_array('blshjbggl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="blshjgl.php" title="不良事件报告管理">不良事件..</a></div>
					</div>
<?php
}

if($_SESSION['yhln']=="admin"||$_SESSION['yhln']=="cfcadmin"){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcyhgl.php" title="CFC用户权限管理">CFC用户..</a></div>
          </div> 
<?php
}
}

if(in_array('shyywxhgl_xh',$_SESSION[yhqxxf])||in_array('kypxhgl_xh',$_SESSION[yhqxxf])||in_array('shyywjhmx_ck',$_SESSION[yhqxxf])||in_array('kypjhgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){

if(in_array('kypjhgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfckpjhgl.php" title="空药瓶交回明细">空药瓶交..</a></div>
          </div> 
<?php
}

if(in_array('shyywjhmx_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcyyjhgl.php" title="剩余药物交回明细">剩余药物..</a></div>
          </div> 
<?php
}

if(in_array('kypxhgl_xh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfckpjhxhgl.php" title="空药瓶销毁管理">空药瓶销..</a></div>
          </div> 
<?php
}

if(in_array('shyywxhgl_xh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcyyjhxhgl.php" title="剩余药物销毁管理">剩余药物..</a></div>
          </div> 
<?php
}
}

if(in_array('dfqdgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){

if(in_array('dfqdgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcdfqdgl.php" title="待发清单管理">待发清单..</a></div>
          </div> 
<?php
}

if(in_array('ypffgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcfygl.php" title="药品发放管理">药品发放..</a></div>
          </div> 
<?php
}

if(in_array('ypyc_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcyshypyc.php" title="药品预测">药品预测</a></div>
          </div> 
<?php
}
}

if(in_array('ztyfgl_ck',$_SESSION[yhqxxf])||in_array('yfdbgl_ck',$_SESSION[yhqxxf])||in_array('chrktj_ck',$_SESSION[yhqxxf])||in_array('yfzyshdgl_ck',$_SESSION[yhqxxf])||in_array('yfzyshqgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){

if(in_array('yfzyshqgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfczyshqgl.php" title="药房赠药申请管理">药房赠药..</a></div>
          </div>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcywyshshqgl.php" title="药房运输申请管理">药房运输..</a></div>
          </div>
<?php
}

if(in_array('yfzyshdgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfczyshdgl.php" title="药房赠药收到管理">药房赠药..</a></div>
          </div>
<?php
}

if(in_array('chrktj_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcchrkgl.php" title="出入库统计">出入库统..</a></div>
          </div>
<?php
}

if(in_array('yfdbgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcgyfzhhdgl.php" title="药房调拨管理">药房调拨..</a></div>
          </div>
<?php
}

if(in_array('ztyfgl_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcztfyyfgl.php" title="暂停药房管理">暂停药房..</a></div>
          </div>
<?php
}

}
?>
<?php
if(in_array('jjhybypfpmx_ck',$_SESSION[yhqxxf])||in_array('jdbgtj_ck',$_SESSION[yhqxxf])||in_array('ydbgtj_ck',$_SESSION[yhqxxf])||in_array('xmshshxxtj_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){


if(in_array('xmshshxxtj_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcxmshshxxtj.php" title="项目实时信息统计">项目实时..</a></div>
          </div>
<?php
}

if(in_array('ydbgtj_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcydgzbg.php" title="月度报告统计">月度报告..</a></div>
          </div>
<?php
}

if(in_array('jdbgtj_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcjdbgshj.php" title="季度报告统计">季度报告..</a></div>
          </div>
<?php
}

if(in_array('jjhybypfpmx_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf]=='admin_AllowAll'){
?>  
          <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif" /></div>
            <div class="istext"><a href="cfcyuefp.php" title="基金会月报药品分配明细">基金会月..</a></div>
          </div>
<?php
}

}
    }
?>
				</div>				

				<div class="title w977 flt top">
				<strong>系统管理员工作站</strong><span></span>
				</div>
				<div class="incontact w955 flt">
<?php
if($_SESSION[yhshf]=='10'||$_SESSION[yhshf]=='3') {
?>

					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshdfqdgl.php" title="待发清单">待发清单</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshfygl.php" title="药品发放明细">药品发放..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="kpyyhshgl.php" title="新增空药瓶、余药记录">新增空药..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="kpjhgl.php" title="空药瓶交回明细">空药瓶交..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yyjhgl.php" title="剩余药物交回明细">剩余药物..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshzyshqgl.php" title="赠药申请管理">赠药申请..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshzyshdgl.php" title="赠药收到管理">赠药收到..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshdbdgl.php" title="药房调拨管理">药房调拨..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshkcpdgl.php" title="库存盘点">库存盘点</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="yshchrkgl.php" title="出入库统计">出入库统..</a></div>
					</div>
<?php
    }
?>
				</div>				

				<div class="title w977 flt top">
				<strong>系统管理员工作站</strong><span></span>
				</div>
				<div class="incontact w955 flt">

<?php
if($_SESSION[yhshf]=='10'||$_SESSION[yhshf]=='1') {
?>
    
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="kfrkgl.php" title="入库管理">入库管理</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="kfchkgl.php" title="出库管理">出库管理</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="kfchrkgl.php" title="出入库统计">出入库统..</a></div>
					</div>
					<div class="infowraps">
						<div class="topico"><img src="./images/icon01.gif" /></div>
						<div class="istext"><a href="kfkcpdgl.php" title="库存盘点">库存盘点</a></div>
					</div>
<?php
    }
?>
				</div>				
				

			</div>
		</div>
	</div>
</div>
</body>
</html>