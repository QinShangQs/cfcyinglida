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
<?php 
/*      <form action="http://115.28.90.3:8080/zz/send.htm" method="post" >
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
*/
/*
郭宝存 13810750441
杨耀鑫 15510429726
徐勤杰 18513352807
柴紫木 18500067341
张程远 13439420791
*/
$phones= array("13810750441","15510429726","18513352807","18500067341","13439420791");  
$pnames= array("郭宝存","杨耀鑫","徐勤杰","柴紫木","张程远"); 
for($i=0;$i<count($phones);$i++){
$post_data = array();  
$post_data['phone'] = $phones[$i];  
$post_data['content'] = $pnames[$i].":这是来自群发测试的短消息，您的手机号码为".$phones[$i];  
$post_data['submit'] = "submit";  
$url='http://115.28.90.3:8080/zz/send.htm';  
$o="";  
foreach ($post_data as $k=>$v)  
{  
    $o.= "$k=".urlencode($v)."&";  
}  
$post_data=substr($o,0,-1);  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_POST, 1);  
curl_setopt($ch, CURLOPT_HEADER, 0);  
curl_setopt($ch, CURLOPT_URL,$url);  
//为了支持cookie  
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');  
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  
$result = curl_exec($ch); 
echo $pnames[$i]." ".$result." ".$phones[$i];
}
?>
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
