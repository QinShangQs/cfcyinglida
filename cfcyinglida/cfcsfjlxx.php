<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="随访记录详情";
include('spap_head.php');
$id = $_GET['id'];      //患者id
?>
  <div class="main"><?php /*div[main]开始*/?>
		<div class="insmain">
			<div class="thislink">当前位置：<a href="cfcsfjlgl.php">随访记录管理</a> > <a href="cfcsfjlxx.php?id=<?php echo $id?>"><?php echo $html_title;?></a> </div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="15%" align="center" bgcolor="#FFFFFF">患者姓名</td>
              <td width="15%" align="center" bgcolor="#FFFFFF">随访时间</td>
              <td width="15%" align="center" bgcolor="#FFFFFF">随访方式</td>
              <td width="20%" align="center" bgcolor="#FFFFFF">与患者的关系</td>
              <td width="20%" align="center" bgcolor="#FFFFFF">随访事件详情</td>
              <td width="15%" align="center" bgcolor="#FFFFFF">随访人</td>
            </tr>
            <?php
  $sql = "select * from `xjsfjl` where hzhid='$id' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
            <tr style="color:#1f4248; font-size:12px;">
            <td width="15%" align="center" bgcolor="#FFFFFF"><?php
             $hzhsql = "select * from `hzh` where id='$id' ";
             $hzhQuery_ID = mysql_query($hzhsql);
             while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
              echo $hzhRecord[4];}?></td>
              <td width="15%" align="center" bgcolor="#FFFFFF"><?php echo $Record[2];?></td>
              <td width="15%" align="center" bgcolor="#FFFFFF"><?php echo $Record[3];?></td>
              <td width="20%" align="center" bgcolor="#FFFFFF"><?php echo $Record[5];?></td>
              <td width="20%" align="center" bgcolor="#FFFFFF"><?php echo $Record[6];?></td>
              <td width="15%" align="center" bgcolor="#FFFFFF"><?php echo $Record[8];?></td>
            </tr>
          
        
<?php
      $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!信息不存在或其他问题！<input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";}

?>
</table>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>