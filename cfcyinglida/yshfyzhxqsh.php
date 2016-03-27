<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="患者直系亲属";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshfyxqsh.php"><?php echo $html_title;?></a></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span></span>
				</div>
				<div class="incontact w955 flt">
    <br />
<?php
  $hzhid = $_GET['id'];
$numq=mysql_query("SELECT * FROM `zhxqsh` where `hzhid`='".$hzhid."' and `gxzf`<>'0'");
$num = mysql_num_rows($numq);//获取总条数
?>
      <div class="insinsins"><span>
      直系亲属共有:<?php echo $num;?>人
     </span></div>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="10%" align="center" bgcolor="#FFFFFF">直系亲属姓名</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">关系</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">证件号码</td>
            <td width="10%" align="center" bgcolor="#FFFFFF">联系方式</td>
        </tr>
<?php        
  $sql = "select * from `zhxqsh` where `hzhid`='".$hzhid."' and `gxzf`<>'0' order by id DESC";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[4]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[3]!=""){echo "身份证:".$Record[3];}
    if($Record[7]!=""){echo "军官证:".$Record[7];}
    echo "</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$Record[6]."</td></tr>";
}
?>
    </table>
    <div class="forBr">
    </div>
    <script type="text/javascript">

    </script>

        </div>
    </div>
</body>
</html>
