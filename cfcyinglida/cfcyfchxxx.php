<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yfmch = $_GET['yfmch'];
$html_title="药房药师详细";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="cfcyfchx.php">药房药师查询</a>
        ><?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">姓名</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">用户名</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">手机</td>
              <td width="20%" align="center" bgcolor="#FFFFFF">所属药房</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">是否启用</td>
            </tr>
<?php        
  $sql = "select id,yfzhdysh,yfyshname,yfshj,shfzt from `yf` where `yfmch`='".$yfmch."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><a href="cfcyfchxyshxx.php?id=<?php echo $Record[0];?>"><?php echo $Record[1];?></a></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[2];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[3];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $yfmch;?></td>
            <td align="center" bgcolor="#FFFFFF"><?php if($Record[4]=='1'){ echo "启用";}else{echo "停用";}?></td>
        </tr>
<?php
  }
?>
          </table>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>