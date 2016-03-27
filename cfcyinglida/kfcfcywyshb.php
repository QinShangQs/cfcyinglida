<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $shqid=$_GET['id'];
$html_title="药物运输申请表详细";
include('spap_head.php');
?>    
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="kfchukgl.php"><?php echo $html_title;?></a></div><a href="cfcywyshbpdf.php?id=<?php echo $shqid;?>">下载</a>
      
<?php       

  $sql = "select * from `yfshqzy` where `id`='".$shqid."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
      <div class="inwrsssa">
<div style="width:990px; float:left; text-align:center; height:45px; vertical-align:middle; line-height:45px;"><strong style="font-size:18px; font-weight:bold;">中国癌症基金会英立达患者援助项目</strong></div>
		  <div style="width:790px; float:left; text-align:left; padding-left:100px;">
		    <ul><li style="text-align:center"><strong>药物运输表</strong></li>
		  <li>
		    <input name="Input2462" style="width:200px; border:none; border-bottom:1px #000 solid; font-size:16px; font-weight:bold; text-align:center;" value="中国医药对外贸易公司"/>
		    ：</li>
		 <li style="padding-left:40px;">请将药物按照以下详细地址送交接收医院的负责药师。 <br />
		    非常感谢！</li>
			</ul>
		  </div>
		  <table class="lxbda" width="990" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<?php
  $yfsql = "select * from `yf` where  `yfmch`='".$Record[25]."' and `yfzhdysh`='".$Record[1]."'";
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
?>
              <tr>
                <td colspan="4"><strong>1. 接受药物医院和地址</strong></td>
              </tr>
	  <tr>
                <td width="21%" align="center">医院（或者其他机构）名称</td>
                <td colspan="3" align="center"><?php echo $yfRecord[1];?></td>
        </tr>
              <tr>
                <td align="center">负责药师</td>
                <td colspan="3" align="center"><?php echo $yfRecord[11];?></td>
            </tr>
              <tr>
                <td align="center">地址 </td>
                <td colspan="3" align="center"><?php
        if($yfRecord[10]=="省份"){$yfsheng="";}else{$yfsheng="$yfRecord[10]";}
    if($yfRecord[14]=="地级市"){$yfshi="";}else{$yfshi="$yfRecord[14]";}
    if($yfRecord[16]=="市、县级市"){$yfqu="";}else{$yfqu="$yfRecord[16]";}
     echo $yfsheng.$yfshi.$yfqu.$yfRecord[2];?></td>
              </tr>
              <tr>
                <td align="center">直线电话</td>
                <td width="27%" align="center"><?php echo $yfRecord[3];?></td>
                <td width="14%" align="center">手机</td>
                <td width="38%" align="center"><?php echo $yfRecord[4];?></td>
              </tr>
			  <tr>
                <td align="center">传真</td>
                <td align="center"><?php echo $yfRecord[5];?></td>
                <td align="center">Email</td>
                <td align="center"><?php echo $yfRecord[6];?></td>
              </tr>
<?php
}
?>
              <tr>
                <td colspan="4" align="left">2. <strong>药物数量</strong></td>
              </tr>
<?php if($Record[20]!=""){

?>
              <tr>
                <td align="center"><strong><em>规格(1)</em></strong></td>
                <td align="center"><?php echo $Record[2];?></td>
                <td align="center">数量</td>
                <td align="center"><?php if($Record[20]!=""){echo $Record[20];}else {echo "0";}?>瓶</td>
              </tr>
<?php
}
?>
<?php if($Record[21]!=""){
?>
              <tr>
                <td align="center"><strong><em>规格(2)</em></strong></td>
                <td align="center">250mg*60粒/瓶</td>
                <td align="center">数量</td>
                <td align="center"><?php if($Record[21]!=""){echo $Record[21];}else {echo "0";}?>瓶</td>
              </tr>
<?php
}
?>
              <tr>
                <td colspan="4" align="left" style="padding-top:25px;"><p><strong>项目办公室签字盖章：</strong><br /> 
                  <br />
                  <br />
                <div style="width:400px; padding-left:50px; float:left; padding-top:50px; padding-bottom:20px;">签字：<?php   $shhrsql = "select yhyl1 from `manager` where `id`='".$Record[16]."'";
  $shhrQuery_ID = mysql_query($shhrsql);
  while($shhrRecord = mysql_fetch_array($shhrQuery_ID)){echo $shhrRecord[0];}?></div>
	<div style="width:400px; float:right; padding-top:50px; padding-bottom:20px;">日期：<?php echo date('Y年m月d日',strtotime($Record[18]));?></div>                   
              </td>
              </tr>

              <tr>
                <td colspan="4" align="left"><strong>3. 药物运输记录（以下由负责发货的公司填写）</strong></td>
              </tr>
              <tr>
                <td align="center"><strong><em>运输日期</em></strong></td>
                <td colspan="3" align="center"><?php if($Record[8]>=2){echo date('Y年m月d日',strtotime($Record[13]));}?></td>
              </tr>
              <tr>
                <td align="center"><strong><em>运输数量</em></strong></td>
                <td colspan="3" align="center"><?php if($Record[8]>=2){echo ($Record[20]+$Record[21])."瓶";}?></td>
              </tr>
              <tr>
                <td align="center"><strong><em>运单编码</em></strong></td>
                <td align="center"><?php
if($Record[8]>=2){echo $Record[12];} ?></td>
                <td align="center"><strong><em>运输公司电话</em></strong></td>
                <td align="center"><?php
if($Record[8]>=2){echo "400-920-1336";}
?></td>
              </tr>
			  <tr>
                <td align="center"><strong><em>运输经办人</em></strong></td>
                <td colspan="3" align="center"><?php
if($Record[8]>=2){echo "国药外贸发货组";}
?></td>
              </tr>
			  <tr>
			    <td align="center"><h2 align="left">备注： </h2></td>
			    <td colspan="3" align="center"></td>
		    </tr>
        </table>
    <div style="width:990px; float:left;">
      <p><div style="width:950px; padding:20px; line-height:24px; vertical-align:middle; float:left;">
		  	<ul>
				<li><strong>填表说明：</strong></li>
				<li>　　1.	本表由项目办公室向负责发货的公司发出通知，请相应公司及时做出安排。</li>
				<li>　　2.	请运输后将该文件签字后及时传真给项目办公室。

</li>
			</ul>
		  </div>
      </p>
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
      </div>
    </div>
<?php
}
?>
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
