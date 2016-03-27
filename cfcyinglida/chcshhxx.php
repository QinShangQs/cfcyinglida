<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $id = $_GET['id'];
  $hzhid = $_GET['id2'];
$html_title="审核记录详情";
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
<div class=form>
<div>

 
<!--FIELDSET class=hid><LEGEND>网审</LEGEND>
<TABLE width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <TBODY>
  <TR style="color:#1f4248; font-weight:bold; height:30px;">
    <Td align="center" bgcolor="#FFFFFF">网审日期 </Td>
    <Td align="center" bgcolor="#FFFFFF">网审人 </Td>
    <Td align="center" bgcolor="#FFFFFF">是否通过 </Td>
    <Td align="center" bgcolor="#FFFFFF">未通过原因 </Td></TR></TBODY></TABLE></FIELDSET--> 
<FIELDSET><LEGEND>材料符合情况</LEGEND>

<TABLE id=ChuciShenqingtb_cailiaofuhes width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <TBODY>
  <TR style="color:#1f4248; font-weight:bold; height:30px;">
    <Td style="WIDTH: 51%" align="center" bgcolor="#FFFFFF">材料类别 </TH>
    <Td style="WIDTH: 30px" align="center" bgcolor="#FFFFFF">收到 </TH>
    <Td style="WIDTH: 72px" align="center" bgcolor="#FFFFFF">收到日期 </TH>
    <Td style="WIDTH: 30px" align="center" bgcolor="#FFFFFF">有效 </TH>
    <Td style="WIDTH: 72px" align="center" bgcolor="#FFFFFF">审核日期 </TH>
    <Td style="WIDTH: 68px" align="center" bgcolor="#FFFFFF">审核人 </TH>
    <Td align="center" bgcolor="#FFFFFF">无效说明 </TH></TR>
<?php 
  $hzhsql = "select shqbzh,jzhlx from `hzh` where `id`='".$hzhid."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
    $hzhshqbzh=$hzhRecord[0];
    $hzhjzhlx=$hzhRecord[1];
  } 

  $sql = "select * from `clshh` where `id`='".$id."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $mchid = $Record[1];
  $shfshd = $Record[2];
  $shdrq = $Record[3];
  $shfyx = $Record[4];
  $shhrq = $Record[5];
  $shqbzh = $Record[6];
  $shhr =$Record[7];
  $shhyj = $Record[8];
  $wtgyy = $Record[9];
  $bzhshm = $Record[10];
  $shscl = $Record[13];
  } 
  $mchid1 = explode(",",$mchid);
  $shfshd1 = explode(",",$shfshd);
  $shdrq1 = explode(",",$shdrq);
  $shfyx1 = explode(",",$shfyx);
  $shhrq1 = explode(",",$shhrq);
  $shqbzh1 = explode(",",$shqbzh);
  $shhr1 = explode(",",$shhr);

  $clmchsql = "select id,nr from `clshhmch` order by id ASC";

  $clmchQuery_ID = mysql_query($clmchsql);
  while($clmchRecord = mysql_fetch_array($clmchQuery_ID)){
  
?>
     <tr  style="color:#1f4248; font-size:12px;">
      <td  align="center" bgcolor="#FFFFFF"><SPaN id="mchid"><?php echo $clmchRecord[1];?></SPaN></td>
      <td align="center" bgcolor="#FFFFFF"><?php if($shfshd1[$clmchRecord[0]-1]=='1'){echo "是";}else{echo "否";}?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $shdrq1[$clmchRecord[0]-1];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php if($shfyx1[$clmchRecord[0]-1]=='1'){echo "是";}else{echo "否";}?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $shhrq1[$clmchRecord[0]-1];?></td>
      <td align="center" bgcolor="#FFFFFF"><a title=点击查看审核人 href="javascript:void();"><?php echo $shhr1[$clmchRecord[0]-1];?></a> </td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $shqbzh1[$clmchRecord[0]-1];?>
      </td>
    </tr>
<?php
    
  }
?>    
  
      
</TBODY></TABLE>

 </FIELDSET> 
</div>
<?php if($shscl!=""){ ?>
<div >
  <div style="width:980px;float:left">
    <div class="label top" style="float:left; width:85px; padding-left:36px;">申诉新材料:</div>
    <div style="width:700px; float:left;">
      <ul>
<?php echo $shscl;?>
      </ul>
    </div>
  </div>
</div>
<?php } ?>
<div class=top>
<SPAN class=label>审核意见：</SPAN>
<?php if($shhyj==1){ ?>
<LABEL for="shhyj">材料齐全</LABEL>
</div>
<?php }else{ ?>
<LABEL for="shhyj">补寄材料</LABEL>
</div>
<div id="wtgdiv" class=top>
  <div style="width:980px;float:left">
    <div class="label top" style="float:left; width:700px;">未通过原因:<?php echo $wtgyy;?></div>
    <!--div style="width:700px; float:left;">
      
<?php echo $wtgyy;?>
      
    </div-->
  </div>
</div>
<?php } ?>
<div class=top>
<SPAN class="top">备注：</SPAN>
<?php echo $bzhshm;?>
</div>
<div class=top><input class=uusub2 onclick="history.go(-1)" value="返回" type="button" > </div></div>
<div class="clearFoot noPrint"></div></div></div>
<div id=footerCon>
<div id=foot>
<div id=footNav>
<div>
<div></div></div></div></div></div></BODY></HTML>