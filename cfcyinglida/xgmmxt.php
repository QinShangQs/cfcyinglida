<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="修改密码";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div> 
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <form action="xgmmxtac.php" method="post">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF">
                用户名
            </td>
            <td align="center" bgcolor="#FFFFFF">
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `manager` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    
      echo "<span>".$Record[1]."</span><input id=\"yhid\" name=\"yhid\" type=\"hidden\" value=\"".$yhid."\" />";
      $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！";}
//<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=manager.php\">
?>
            </td>
        </tr>
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF">
                新密码
            </td>
            <td align="center" bgcolor="#FFFFFF">
                <input class="grd-white" id="Password" name="Password" type="password" /><span style="color: red">*</span>
            </td>
        </tr>
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF">
                确认新密码
            </td>
            <td align="center" bgcolor="#FFFFFF">
                <input class="grd-white" id="ConfirmPassword" name="ConfirmPassword" type="password" /><span
                    style="color: red">*</span>
            </td>
        </tr>

    </table>
    <p>
        <input type="submit" value="保存" class="uusub" /></p>
    </form>
            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
    <div id="footerCon">
        <div id="foot">
            <div id="footNav">
                <div>
                    <div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
