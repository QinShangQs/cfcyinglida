<?php

session_start ();
@header ( 'Content-type: text/html;charset=utf-8' );
include ('newdb.php');
$yhgldw = $_SESSION [gldw];
$html_title = "药房药物申请新增";
include ('spap_head.php');
?>
<div class="main">
	<div class="insmain">
		<div class="thislink">
			当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a>
		</div>
		<div class="inwrap flt top">
			<div class="title w977 flt">
				<strong><a href="yshzyshq.php"><?php echo $html_title;?></a></strong><span></span>
			</div>
			<div class="incontact w955 flt">
				<div class="top">
					<form action="yshzyshqac.php" method="post"
						onsubmit="return check()">
						<div>
							<span class="label">规格：</span> <select name="gg1">
								<option value="1mg">1mg</option>
								<option value="5mg">5mg</option>
							</select>
						</div>
						<div class="top">
							<span class="label">当前库存数（盒）：</span><?php
							$yhln = $_SESSION [yhln];
							$yhsql = "select id,yfmch from `yf` where `yfyshname`='" . $yhln . "'";
							
							$yhQuery_ID = mysql_query ( $yhsql );
							while ( $yhRecord = mysql_fetch_array ( $yhQuery_ID ) ) {
								$yshid = $yhRecord [0];
								$yfmch = $yhRecord [1];
							}
							$yftmsql = "select id from `yf` where `yfmch`='" . $yfmch . "'";
							$yftmQuery_ID = mysql_query ( $yftmsql );
							while ( $yftmRecord = mysql_fetch_array ( $yftmQuery_ID ) ) {
								$yfid [] = $yftmRecord [0];
							}
							$yshtmsql = "select id from `manager` where `gldw`='" . $yfmch . "'";
							$yshtmQuery_ID = mysql_query ( $yshtmsql );
							while ( $yshtmRecord = mysql_fetch_array ( $yshtmQuery_ID ) ) {
								$yfyshid [] = $yshtmRecord [0];
							}
							
							$pfshl1sql = "SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='3' and `yfmch`='" . $yhgldw . "'";
							$pfshl1q = mysql_query ( $pfshl1sql );
							while ( $pfshl1Record = mysql_fetch_array ( $pfshl1q ) ) {
								$pfshl1 = $pfshl1Record [0];
							}
							
							$pfshl1ztsql = "SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='2' and `yfmch`='" . $yhgldw . "'";
							$pfshl1ztq = mysql_query ( $pfshl1ztsql );
							while ( $pfshl1ztRecord = mysql_fetch_array ( $pfshl1ztq ) ) {
								$pfshl1zt = $pfshl1ztRecord [0];
							}
							//赠药发放数
							$zyffshl1sql = "SELECT SUM(fyshl) FROM `zyff` where `yfmch`='" . $yhgldw . "'";
							$zyffshl1q = mysql_query ( $zyffshl1sql );
							while ( $zyffshl1Record = mysql_fetch_array ( $zyffshl1q ) ) {
								$zyffshl1 = $zyffshl1Record [0];
							}
							echo ($pfshl1 - $zyffshl1);
							if ($pfshl1zt > 0) {
								echo "（另有" . $pfshl1zt . "在途中）";
							}
							// echo $pfshl1."-".$zyffshl1;
							?><input name="kcshl1" type="hidden"
								value="<?php echo ($pfshl1-$zyffshl1);?>" />
						</div>
						<div class="top">
							<span class="label">申请药品数（盒）：</span><input class="grd-white"
								id="shqshouceshl" name="shqshl1" style="width: 460px;"
								type="text" value="" />
						</div>
						<div class="top"></div>
						<div class="top">
							<!-- 申请手册数量：<input type="text" name="shouceshl" class="grd-white" value="" id="shqshouceshl" onblur="shqshcshl();"> -->
						</div>

						<div class="top">
							<input type="submit" class="uusub" value="保存" /> <input
								type="button" onclick="javascript:{history.go(-1);}" value="返回"
								class="uusub2" />
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
    function check(){
      var shcshl = $.trim($('#shqshouceshl').val());
      shcshl = parseInt(shcshl);

  	  if(isNaN(shcshl)){
  		alert('请正确填写数量！');
		return false;
  	  }
      
      if(shcshl>100){
        alert('申请药品数不能大于100');
        document.getElementById('shqshouceshl').focus();
        return false;
      }
      if(shcshl<=0){
        alert('申请药品数不能小于1');
        return false;
      }
      return true;
    }
    </script>
	</body>
	</html>