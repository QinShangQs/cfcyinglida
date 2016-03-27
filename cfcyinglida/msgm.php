<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_manager=1;
$html_title="短消息";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
		<div class="thislink">当前位置：短消息 </div>
			<div class="inwrap flt top">


<?php 
if($_SESSION[yhshf]=='10') {
?>
    <!--div class="position">
        系统管理员首页</div>
        <a href=""><div>辉瑞统计</div></a>
        <a href=""><div>审核批准记录表</div></a-->
   
        <div class="title w977 flt top">
				<strong>短信息</strong><span></span>
				</div>
				<div class="incontact w955 flt">
      <form action="http://115.28.90.3:8080/zz/send.htm" method="post" >
      <div class="top">
      到达号码：<input type="text" class="grd-white" name="phone" value=""><br />
      </div>
      <div class="top">
      显示内容：<input type="text" class="grd-white" name="content" value=""><br />
      </div>
      <div class="top">
      <input type="submit" class="uusub" name="submit" value="发送"><br />
      </div>
     </form>
         <form action="http://115.28.90.3:8080/zz/msg/saveOneMsg.htm" method="post">
		 <div style="width: 870px; height: 490px;overflow:hidden; background: url('/zz/common/images/st/b3.png');" >
        	<div style="width: 865px; height: 45px; margin-left: 5px; margin-top: 5px;">
        		<img src="/zz/common/images/st/b5.png" width="865" height="45" />        	
        	</div>
        	<div style="width: 865px; height: 430px; margin-left: 10px; margin-top: 5px; ">
        	  <table width="860" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                <tr>
                  <td width="100" height="30">姓名：</td>
                  <td><input name="receiverName" type="text" maxlength="20" /></td>
                </tr>
                <tr>
                  <td height="30">区域：</td>
                  <td><input name="status" type="text" maxlength="20" /></td>
                </tr>
                <tr>
                  <td height="30">分类：</td>
                  <td>
				  <select name="receiverType">
						<option value="患者">患者</option>
						<option value="药师">药师</option>
						<option value="医生">医生</option>
						<option value="协管员">协管员</option>
					</select>
				  </td>
                </tr>
                <tr>
                  <td height="30">电话号码01：</td>
                  <td><input name="receiverPhone01" type="text" /></td>
                </tr>
                <tr>
                  <td height="30">电话号码02：</td>
                  <td><input name="receiverPhone02" type="text" maxlength="11" /></td>
                </tr>
				<tr>
                  <td height="30">短信模板：</td>
                  <td>
				    <select name="title" onchange="getContent()" id="msgDemo" >
						<option value="">请选择</option>
		            	 
		            		<option value="审核通过-南京">审核通过-南京</option>
		            	 
		            		<option value="审核通过-上海">审核通过-上海</option>
		            	 
		            		<option value="不通过">不通过</option>
		            	 
		            		<option value="没收到">没收到</option>
		            	 
		            		<option value="长期未领">长期未领</option>
		            	 
		            		<option value="联系不上">联系不上</option>
		            	 
					</select>
				  </td>
                </tr>
                <tr>
                  <td height="30">短信内容：</td>
                  <td>              <textarea name="content" rows="10" id="content" wrap=PHYSICAL cols="75" onKeyDown="gbcount(this.form.content,this.form.total,this.form.used,this.form.remain,this.form.page);" onKeyUp="gbcount(this.form.content,this.form.total,this.form.used,this.form.remain,this.form.page);"></textarea>
<p>最多字数：
<input disabled maxLength="4" name="total" size="3" value="291" class="inputtext">
已用字数：
<input disabled maxLength="4" name="used" size="3" value="0" class="inputtext">
剩余字数：
<input disabled maxLength="4" name="remain" size="3" value="291" class="inputtext">
条数：
<input disabled maxLength="4" name="page" size="3" value="1" class="inputtext">
</p><input type="submit" value="发送" /></td>
                </tr>
              </table>
        	</div>
</div>
      </form>

        </div>
<?php
    }

?>
<style>
.mindess {
	width:666px;
	font-size:12px;
	height:auto;
	/*scrolling:auto;
	overflow:auto;
	overflow-x:hidden;*/
	position:fixed;
	z-index:100;
	left:50%;
	margin:0 auto 0 -343px; /* margin-left需要是宽度的一半 */
	top:30%;
	padding:1px;
	background:#25679c;
	border:1px #25679c solid;
}</style>
  <div class="mindess" id="gonggao" style="display:<?php if($_SESSION[logintrue]=='1'){echo "none";}else{echo "inline";}?>;">
	<div style="position:absolute; right:15px;"><a style="color:#FFFFFF; cursor:pointer;" onclick="gbgonggao()">关闭</a></div><div style="background:#ffffff; height:300px; scrolling:auto; overflow:auto; overflow-x:hidden; margin-top:30px; padding:10px; font-size:14px;"><p style="padding-bottom:5px; border-bottom:1px #efefef solid; margin-bottom:5px;">欢迎您登陆！<?php 
	  $xtggxxsql = "select id from `xtggxx` where `ggzht`='1' and `tshgn`='1'";
  $xtggxxQuery_ID = mysql_query($xtggxxsql);
  while($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)){
$xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
}
	if($_SESSION[yhshf]=='3'||$_SESSION[yhshf]=='1'){
	$ri = date('d');
	$yuri = date('d',strtotime(date('Y-m')."+1 month -1 day"));
	if(($ri>=1&&$ri<=5)||$ri==$yuri){
	$shfchfsql = "select * from `kfkcpd` where `dzhny`='$dzhny' and `dwmch`='$dwmch'";
$shfchfq=mysql_query($shfchfsql);
$shfchf = mysql_num_rows($shfchfq);
if($shfchf==0){
	?><b style="color:red;">该盘点了!</b><?php
}
	}}if($xtggxx=='1'){?><b style="color:red;">管理员开放盘点权限!</b><?php }
	?></p>
<?php 
	$xtggxxnrsql = "select * from `xtggxx` where `ggzht`='1' and `tshgn`='0' order by ggrq DESC";
  $xtggxxnrQuery_ID = mysql_query($xtggxxnrsql);
  while($xtggxxnrRecord = mysql_fetch_array($xtggxxnrQuery_ID)){
  $pdhh = array("\r\n", "\n", "\r");
$xtggnr=str_replace($pdhh, "</br>", $xtggxxnrRecord[2]);
$zdqxstring = $xtggxxnrRecord[3];
$zdqxarr = explode(',',$zdqxstring);
if($_SESSION[yhshf]=='10'||$_SESSION[yhshf]=='1'||$_SESSION[yhshf]=='2'||in_array($_SESSION[yhshf],$zdqxarr)){
?>
<p style="color:red;">系统公告:</p><p style="border-bottom:1px #efefef solid; padding-bottom:5px; margin-bottom:5px;"><?php echo $xtggxxnrRecord[4]." <b>".$xtggxxnrRecord[1]."</b></br>".$xtggnr."</br>";/*.$xtggxxnrRecord[7]*/?></p>

<?php }}$_SESSION[logintrue]='1';?>
</div>
	</div>
<script type="text/javascript">
function gbgonggao(){
document.getElementById('gonggao').style.display='none';
}
    </script>
        </div>
    </div>
</body>
</html>
