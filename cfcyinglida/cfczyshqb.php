<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqid=$_GET['id'];
$html_title="药物申请表详细";
include('spap_head.php');
?>
    <div id="content">
      <div id="con">
        <div class="position">
          <a href="cfczyshqgl.php">药房赠药申请管理</a>
          > <?php echo $html_title;?>  <!--a href="cfczyshqbpdf.php?id=<?php echo $shqid;?>">下载</a-->
        </div>
      </div>
    </div>
    
    <div id="content" style="font-size:16px;">  
<?php       
  $shqid=$_GET['id'];
  $sql = "select * from `yfshqzy` where `id`='".$shqid."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
      <div class="inwrsssa">
		  <div style="width:990px; float:left; text-align:center; height:45px; vertical-align:middle; line-height:45px;"><strong style="font-size:18px; font-weight:bold;">中国癌症基金会英立达患者援助项目</strong></div>
		  <div style="width:990px; float:left; text-align:center;"><strong style="font-size:20px;">药物申请表</strong></div>
		    <table class="lxbda" width="990" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
              <tr>
                <td colspan="4" align="left"><strong>1.申请捐赠药物发放中心的信息和申请数量</strong></td>
              </tr>
<?php
  $yfsql = "select * from `yf` where `yfzhdysh`='".$Record[1]."' and `yfmch`='".$Record[25]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
  $yfyshname=$yfRecord[11];
?>
              <tr>
                <td width="13%" align="left">药房名称</td>
                <td width="36%" align="left"><?php echo $yfRecord[1];?></td>
                <td width="16%" align="left">负责药师</td>
				<td width="35%" align="left"><?php echo $yfRecord[11];?></td>
              </tr>
              <tr>
                <td align="left">地址</td>
                <td colspan="3" align="left"><?php if($yfRecord[10]==$yfRecord[14]){$yfshengshi=$yfRecord[10].$yfRecord[16];}
else{$yfshengshi=$yfRecord[10].$yfRecord[14].$yfRecord[16];}echo $yfshengshi.$yfRecord[2];?></td>
              </tr>
              <tr>
                <td align="left">直线电话</td>
                <td align="left"><?php echo $yfRecord[3];?></td>
                <td align="left">手机</td>
                <td align="left"><?php echo $yfRecord[4];?></td>
              </tr>
              <tr>
                <td align="left">传真</td>
                <td align="left"><?php echo $yfRecord[5];?></td>
                <td align="left">Email</td>
                <td align="left"><?php echo $yfRecord[6];?></td>
              </tr>
<?php
}
if($Record[4]!=""){
?>
  <tr>
    <td align="left">规格（1）</td>
    <td colspan="3" align="left"><?php echo $Record['gg1'];?></td>
    </tr>
  <tr>
    <td align="left">库存数量（盒）</td>
    <td align="left"><?php if($Record[3]!=""){echo $Record[3];}else {echo "0";}?></td>
    <td align="left">申请数量（盒）</td>
    <td align="left"><?php if($Record[4]!=""){echo $Record[4];}else {echo "0";}?></td>
  </tr>
<?php
}
?>
              <tr>
                <td align="left">申请经办人签字</td>
                <td align="left"><?php echo $yfyshname;/*$Record[16]*/?></td>
                <td align="left">申请日期</td>
                <td align="left"><?php echo date('Y年m月d日',strtotime($Record[9]));?></td>
              </tr>
<?php 
if($Record[8]>=1)
{
?>
  <tr>
    <td colspan="4" align="left"><strong>2.项目办公室意见</strong></td>
  </tr>
  <tr>
    <td colspan="4" align="left">
	<div style="width:878px; padding-top:20px; float:left; padding-left:50px; padding-right:50px; line-height:24px; vertical-align:middle;">
	已审阅以上申请。<br />
	<?php //print_r($Record);die();?>
	请给以上地址运输英立达®<?php echo $Record['gg1'];?> 。</br><?php if($Record[10]!=""){?>备注：<?php echo $Record[10];}?></div>
	<div style="width:400px; padding-left:50px; float:left; padding-top:50px; padding-bottom:20px;">签字、盖章：<?php   $shhrsql = "select yhyl1 from `manager` where `id`='".$Record[16]."'";
  $shhrQuery_ID = mysql_query($shhrsql);
  while($shhrRecord = mysql_fetch_array($shhrQuery_ID)){echo $shhrRecord[0];}?></div>
	<div style="width:400px; float:right; padding-top:50px; padding-bottom:20px;">日期：<?php echo date('Y年m月d日',strtotime($Record[18]));?></div>
	</td>
  </tr>
<?php
}
?>
            </table>
    <div style="width:950px; float:left; text-align:center;">
    <input type="button" value="返回" onclick="javascript:{history.go(-1);}" class="lgSub" />
    </div>
		    <div style="width:950px; padding:20px; line-height:24px; vertical-align:middle; float:left;">
		  	<ul>
				<li>填表说明：</li>
				<li>　　1.本表供各药物发放处使用；</li>
				<li>　　2.当药物发放处需要药物时，可随时填报本表并传真至项目办公室；</li>
				<li>　　3.请将原件于次月5日随月报邮寄至项目办。</li>
				<li>　　4.项目办公室审阅并通知运输。进行相关记录。</li>
			</ul>
		  </div>
		  <div style="width:60%; margin-left:20%; float:left; margin-bottom:20px; border:1px #000000 solid; padding:5px; text-align:center;">
				<ul>
					<li>意见或者建议，请联系</li>
					<li>中国癌症基金会</li>
					<li>英利达™患者援助项目办公室</li>
					<li>电话：010-67123993    传真：010-67770237</li>
					<li>电子邮件：ipapfc@163.com 网站：www.cfchina.org.cn</li>
				</ul>
		</div>
<?php
}
?>
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

