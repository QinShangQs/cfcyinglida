<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $shqid=$_GET['id'];
$html_title="赠药收到详细";
include('spap_head.php');
?>    
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href=""><?php echo $html_title;?></a> </div>
<?php       

  $sql = "select * from `yfshqzy` where `id`='".$shqid."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
		  <div style="width:990px; float:left; text-align:center; height:45px; vertical-align:middle; line-height:45px;"><strong style="font-size:18px; font-weight:bold;">中国癌症基金会索坦&#8482;患者援助项目</strong></div>
		  <div style="width:990px; float:left; text-align:center;"><strong style="font-size:20px;">收到捐赠药物说明</strong></div>
		    <table class="lxbda" width="990" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
              <tr>
                <td colspan="6" align="left"><strong>1.申请捐赠药物发放中心的信息</strong></td>
              </tr>
<?php
  $yfsql = "select * from `yf` where `yfzhdysh`='".$Record[1]."' and `yfmch`='".$Record[25]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
?>
              <tr>
                <td align="left">药房名称</td>
                <td colspan="2" align="left"><?php echo $yfRecord[1];?></td>
                <td align="left">负责药师</td>
				<td colspan="2" align="left"><?php echo $yfRecord[11];?></td>
              </tr>
              <tr>
                <td align="left">地址</td>
                <td colspan="5" align="left"><?php if($yfRecord[10]==$yfRecord[14]){$yfshengshi=$yfRecord[10].$yfRecord[16];}
else{$yfshengshi=$yfRecord[10].$yfRecord[14].$yfRecord[16];}echo $yfshengshi.$yfRecord[2];?></td>
              </tr>
              <tr>
                <td align="left">直线电话</td>
                <td colspan="2" align="left"><?php echo $yfRecord[3];?></td>
                <td align="left">手机</td>
                <td colspan="2" align="left"><?php echo $yfRecord[4];?></td>
              </tr>
              <tr>
                <td align="left">传真</td>
                <td colspan="2" align="left"><?php echo $yfRecord[5];?></td>
                <td align="left">Email</td>
                <td colspan="2" align="left"><?php echo $yfRecord[6];?></td>
              </tr>
<?php
}
?>
              <tr>
                <td colspan="6" align="left"><strong>2. 收到捐赠药物记录</strong></td>
              </tr>
            </table>
		    <table class="lxbda" width="990" border="0" cellspacing="0" cellpadding="0" style="margin-top:-10px; border-top:none;">
              <tr>
                <td width="10%" rowspan="2">收到日期</td>
                <td width="25%" rowspan="2"><?php echo date('Y年m月d日',strtotime($Record[14]));?></td>
                <td width="10%" rowspan="2">收到数量</td>
                <td width="20%" colspan="2" rowspan="2"><?php
                if($Record[20]>0){ echo $Record[20]." 瓶（12.5mg*28粒/瓶）<br />";}
                if($Record[21]>0){ echo $Record[21]." 瓶（12.5mg*28粒/瓶）";}
                ?></td>
                <td width="6%" rowspan="2">批号</td>
                <?php if($Record[15]!=""&&$Record[22]!=""){?>
                <td width="25%"><?php 
                $ph1 = explode(",",$Record[15]);
                $phs1 = explode(",",$Record[22]);
for($i=0;$i<=count($ph1);$i++)
{
  $ph1sql = "select ph from `kfrk` where `id`='".$ph1[$i]."'";
  $ph1Query_ID = mysql_query($ph1sql);
  while($ph1Record = mysql_fetch_array($ph1Query_ID)){
  if($phs1[$i]!=""){
  echo $ph1Record['0']."(".$phs1[$i]."瓶) ";}
  }
}
                ?></td>
                <?php }?>
              </tr>
              <tr>
              <?php if($Record[19]!=""&&$Record[23]!=""){?>
                <td><?php 
                $ph2 = explode(",",$Record[19]);
                $phs2 = explode(",",$Record[23]);
for($i=0;$i<=count($ph2);$i++)
{
  $ph2sql = "select ph from `kfrk` where `id`='".$ph2[$i]."'";
  $ph2Query_ID = mysql_query($ph2sql);
  while($ph2Record = mysql_fetch_array($ph2Query_ID)){
  if($phs2[$i]!=""){
  echo $ph2Record['0']."(".$phs2[$i]."瓶) ";}
  }
}
                ?></td>
                <?php }?>
              </tr>
              <tr>
                <td>运单编码</td>
                <td colspan="2"><?php echo $Record[12];?></td>
                <td width="8%">签字盖章</td>
                <td colspan="3"></td>
              </tr>
            </table>
		    <div style="width:950px; padding:20px; line-height:24px; vertical-align:middle; float:left;">
		  	<ul>
				<li>填表说明：</li>
				<li>　　1.本表供各药物发放处使用；</li>
				<li>　　2.请在每次收到捐赠药物后完整记录并加盖公章传真到项目办公室，请将原件于次月5日随月报邮寄至项目办公室。</li>
				</ul>
	    </div>
		  <div style="width:60%; margin-left:20%; float:left; margin-bottom:20px; border:1px #000000 solid; padding:5px; text-align:center;">
				<ul>
					<li>意见或者建议，请联系</li>
					<li>中国癌症基金会</li>
					<li>索坦患者援助项目办公室</li>
					<li>电话：010-67770237    传真：010-67770236</li>
					<li>电子邮件：spapcfc@163.com 网站：www.cfchina.org.cn</li>
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
