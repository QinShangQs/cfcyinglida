<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$rkid = $_GET['id'];
$html_title="入库详细";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div>
<?php        
  $sql = "select * from `kfrk` where `id`='".$rkid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
          <br />
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="8%" align="center" bgcolor="#FFFFFF">
                <span class="label">批号:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
                <?php echo $Record[1];?>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
               <span class="label">中文名称:</span>
             </td>
             <td colspan="3" width="8%" align="center" bgcolor="#FFFFFF">
               <?php echo $Record[3];?>
             </td>
           </tr>
          <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td width="8%" align="center" bgcolor="#FFFFFF">
               <span class="label">有效期至:</span>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
                <?php echo $Record[2];?>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
               <span class="label">英文名称:</span>
             </td>
             
             <td colspan="3" width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[4];?>
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td width="8%" align="center" bgcolor="#FFFFFF">
              <span class="label">检品编号:</span>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
               <?php echo $Record[7];?>
             </td>
             
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">生产单位/产地:</span>
             </td>
             <td colspan="3" width="8%" align="center" bgcolor="#FFFFFF">
              <?php echo $Record[8];?>
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">入库日期:</span>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
              <?php echo $Record[9];?>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">报检单位:</span>
             </td>
             <td colspan="3" width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[5];?>
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">注册证号:</span>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[10];?>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">检验目的:</span>
             </td>
             <td colspan="3" width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[11];?>
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">入库数量:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
              <?php echo $Record[12];?>瓶
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">规格:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[13];?>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">剂型/型号:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[14];?>
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">批件号:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[15];?>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">合同号:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[16];?>
             </td>
              <td width="8%" align="center" bgcolor="#FFFFFF">
             <span class="label">包装规格:</span>
             </td>
             <td width="8%" align="center" bgcolor="#FFFFFF">
             <?php echo $Record[17];?>
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td width="8%" align="center" bgcolor="#FFFFFF">
             
             <span class="label">状态:</span></td>
             <td width="8%" align="center" bgcolor="#FFFFFF" colspan="5"><?php if($Record[6]=="1"){echo "生效";}else{echo "作废";}?>
            </td>
           </tr>
          </table>
<?php
}
?>
        <div class="btnPos">
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub" /></div>
        </div>
    </div>
</body>
</html>
