<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yfmch = $_GET['yfmch'];
$html_title="药房指定药师管理";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="#"><?php echo $html_title;?></a> </div> 
    <div class="top">
        <input type="text" id="Guanjianci" name="Guanjianci" value=""
            placeholder="请输入药房名称或药师名字"  class="grd-white" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub2" />
    </div>
<div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF">
                操作
            </td>
            <td align="center" bgcolor="#FFFFFF">
                姓名
            </td>
            <td align="center" bgcolor="#FFFFFF">
                用户名
            </td>
            <td align="center" bgcolor="#FFFFFF">
                手机
            </td>
            <td align="center" bgcolor="#FFFFFF">
                所属药房
            </td>
            <td align="center" bgcolor="#FFFFFF">
                是否启用
            </td>
        </tr>

<?php        
  $sql = "select id,yfzhdysh,yfyshname,yfshj,shfzt from `yf` where `yfmch`='".$yfmch."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
    

        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><a href="xgzhdyf.php?id=<?php echo $Record[0];?>">修改</a></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[1];?></td>
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
</body>
</html>
