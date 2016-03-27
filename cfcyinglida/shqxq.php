<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
include('wdb.php');
$db = new DB();
$html_title="申请详细信息";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></a> </div>
    <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
    <div class="form">
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `hzh` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $shhxcl=$Record[46];
  $hzhshqbzh=$Record['shqbzh'];
  $hzhjzhlx=$Record['jzhlx'];
  if($Record[3]=="拒绝"||$Record[3]=="申诉拒绝"){$shqzht='-1';$anzht='4';}
  else if($Record[3]=="申诉待审核"||$Record[3]=="申诉审核"){$shqzht='0';$anzht='5';}
  else if($Record[3]=="入组"){$shqzht='1';$anzht='2';}
  else if($Record[3]=="出组"){$shqzht='-1';$anzht='3';}
  else if($Record[3]=="审核"){$shqzht='0';$anzht='0';}
  else if($Record[3]=="待办入组"){$anzht='1';}
  else if($Record[3]=="停止申请"){$shqzht='-1';$anzht='6';}
  //按钮状态 $anzht (审核 0，待办入组 1，入组 2，出组3，拒绝4，申诉审核5，停止申请6)
  
  
      echo "<div>申请状态：";
      
      if($Record[3]!="出组"){echo $Record[3];}else{echo $Record[3]." 原因:".$Record[42]." 出组日期:".$Record[41];}
      echo "</div>";
      echo "<input id=\"yhid\" name=\"yhid\" type=\"hidden\" value=\"".$yhid."\" />";
?>
        <div class="top">您可以：<?php
        if($shqzht=="-1"){//可申诉状态
          if((($anzht=='4'||($anzht=='3'&&$Record[42]!='死亡'))&&(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'))||$_SESSION['yhln']=="admin"){//||$anzht=='6'
            if($anzht=='3'){
              if($_SESSION['yhln']=="admin"||$Record[42]!='死亡'){
        ?>
        <input type="button" value="重新入组" class="uusub2" onclick="javascript:{location.href='shqglxzshqer.php?id=<?php echo $yhid;?>'}" />
        <?php
              }else {
        ?>
        <input type="button" value="重新入组" disabled="disabled"  />
        <?php
              }
            }else if($anzht=='4'){
        ?>
        <input type="button" value="申诉" class="uusub2" onclick="javascript:{location.href='shhjlshs.php?id=<?php echo $yhid;?>'}" />
        <?php
        }else if($anzht=='6'){
        ?>
        <input type="button" value="申诉" class="uusub2" onclick="javascript:{location.href='shhjlshs.php?id=<?php echo $yhid;?>'}" />
        <?php
            }else {
        ?>
        <input type="button" value="申诉" disabled="disabled"  />
        <?php
            }
          }
          /*if($anzht=='3'&&(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll')){
        ?>
        <input type="button" value="重新入组（申诉）" class="uusub2" onclick="javascript:{location.href='shhjlshs.php?id=<?php echo $yhid;?>'}" />
        <?php
          }else{
        ?>
        <input type="button" value="重新入组（申诉）" disabled="disabled" />
        <?php
          }*/
        }else{//正常状态
        if($shqzht!="1"){//非入组状态
          if(($anzht=='0'||$anzht=='5'||$anzht=='1')&&(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll')){
        ?>
        <input type="button" value="审核" class="uusub2" onclick="javascript:{location.href='shhjl.php?id=<?php echo $yhid;?>'}" />
        <?php
           }else{
        ?>
        <input type="button" value="审核" class="uusub2" disabled="disabled" />
        <?php
          }
          /*if($anzht=='1'&&(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll')){
        ?>
        <input type="button" value="办理入组" class="uusub2" onclick="javascript:{location.href='shhjl.php?id=<?php echo $yhid;?>'}" />
        <?php
           }else{
        ?>
        <input type="button" value="办理入组"  disabled="disabled"  />
        <?php
          }*/
           if(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
        ?>
        <input type="button" value="社会调查" class="uusub2" onclick="javascript:{location.href='xzshhdch.php?id=<?php echo $yhid;?>'}" />
        <input type="button" value="停止申请" class="uusub2" onclick="javascript:{location.href='shhjltzh.php?id=<?php echo $yhid;?>'}" />
        <input type="button" value="拒绝" class="uusub2" onclick="javascript:{location.href='shhjljj.php?id=<?php echo $yhid;?>'}" />
        <?php 
          }else{
        ?>
        <input type="button" value="社会调查"  disabled="disabled"  />
        <input type="button" value="停止申请"  disabled="disabled" />
        <input type="button" value="拒绝"  disabled="disabled"  />
        <?php
          }
        }
        if(($shqzht!="1"||$_SESSION['yhln']=="admin")&&(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll')){
        ?>
 
        <input type="button" value="修改基本信息" class="uusub2" onclick="javascript:{location.href='xgjbxx.php?id=<?php echo $yhid;?>'}" />
        <?php 
        }
          if($shqzht=="1"){
            if(in_array('sfjlgl_xz',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
                ?> 
        <input type="button" value="新增随访记录" class="uusub2" onclick="javascript:{location.href='xzsfjl.php?id=<?php echo $yhid;?>'}" />
        <?php 
          }else{
        ?>
        <input type="button" value="新增随访记录"  disabled="disabled"  />
        <?php
          }
          if(in_array('shqgl_zhzh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
        ?>
        <input type="button" value="转诊" class="uusub2" onclick="javascript:{location.href='zhzhshqxz.php?id=<?php echo $yhid;?>';}" />
        <?php
          }else{
        ?>
        <input type="button" value="转诊"  disabled="disabled"  />
        <?php
          }
          if(in_array('shqgl_chz',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
        ?>
        <input type="button" value="办理出组" class="uusub2" onclick="javascript:{location.href='blchz.php?id=<?php echo $yhid;?>';}" />
        <?php 
          }else{
        ?>
        <input type="button" value="办理出组"  disabled="disabled" class="uusub2"  />
        <?php
          }
        }
          if($_SESSION['yhln']=="admin"){
        ?>
                <input type="button" value="修改状态" class="uusub2" onclick="javascript:{location.href='xgshqzht.php?id=<?php echo $yhid;?>';}" />

        <?php
            if($shqzht=="1"){
            ?><div class="top">特殊情况授权：
        <input type="button" value="特殊情况授权（无证明）" class="uusub2" onclick="javascript:{location.href='tshqkshqwu.php?id=<?php echo $yhid;?>';}" />
        <input type="button" value="特殊情况授权（月中换药）" class="uusub2"onclick="javascript:{location.href='tshqkshqwu.php?id=<?php echo $yhid;?>';}" />
        <input type="button" value="特殊情况授权（长期未领药）" class="uusub2"onclick="javascript:{location.href='tshqkshqwu.php?id=<?php echo $yhid;?>';}" />
        <input type="button" value="特殊情况授权（代领药）" class="uusub2"onclick="javascript:{location.href='tshqkshqwu.php?id=<?php echo $yhid;?>&qk=2';}" />
        <input type="button" value="特殊情况修改入组医院" class="uusub2" onclick="javascript:{location.href='tshqkxgrzyy.php?id=<?php echo $yhid;?>';}" />
        <input type="button" value="特殊情况修改赠药数量" class="uusub2" onclick="javascript:{location.href='tshqkxgzyshl.php?id=<?php echo $yhid;?>';}" />
        </div>
        <?php
            }
          }
        
        }
        ?>
        </div>
        
        <fieldset class="top">
            <legend>申请基础信息</legend>
            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-size:12px;">
             <td align="center" bgcolor="#FFFFFF">患者姓名：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[4];?></td>
             <td align="center" bgcolor="#FFFFFF">申请号：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo sprintf("%05d", $Record[0]);
                if($Record[45]==1){echo "网";}
                ?>
                </td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[5];?>：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[6];?></td>
              <?php if($Record[2]!=""){?>
             <td align="center" bgcolor="#FFFFFF">患者编码：</td>
             <td align="center" bgcolor="#FFFFFF">S-<?php echo $Record[2];?>
             </td><?php }else{echo "<td align=\"center\" bgcolor=\"#FFFFFF\" ></td><td align=\"center\" bgcolor=\"#FFFFFF\" ></td>";}?>
            </tr>
            <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF">申请病种：</td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[7];?></td>
            <td align="center" bgcolor="#FFFFFF">出生日期：</td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[38];?></td>
            <td align="center" bgcolor="#FFFFFF">性别：</td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[37];?></td>
            <td align="center" bgcolor="#FFFFFF">年龄：</td>
            <td align="center" bgcolor="#FFFFFF"><?php 
                //计算年龄
function birthday($mydate){
    $birth=$mydate;
    list($by,$bm,$bd)=explode('-',$birth);
    $cm=date('n');
    $cd=date('j');
    $age=date('Y')-$by-1;
    if ($cm>$bm || $cm==$bm && $cd>$bd) $age++;
    if($age<='0'){$age="0";}
    return $age."岁";
//echo "生日:$birth\n年龄:$age\n";
}
echo birthday($Record[38]);
//echo birthday("2012-2-29");
                
                ?></td>
                </tr>
            
        <?php
          $yysql = "select shi,yymch,zhdysh,sheng from `yyyshdq` where id='".$Record[9]."'";
          $yyQuery_ID = mysql_query($yysql);
          while($yyRecord = mysql_fetch_array($yyQuery_ID)){
          $dqjzhyy=$yyRecord[0].$yyRecord[1];
        ?>
            <tr style="color:#1f4248; font-size:12px;">
             <td align="center" bgcolor="#FFFFFF">申请城市：</td>
             <td align="center" bgcolor="#FFFFFF"><?php if($yyRecord[0]!=""){echo $yyRecord[0];}else{echo $yyRecord[3];}?></td>
             <td align="center" bgcolor="#FFFFFF">申请医院：</td>
             <td align="center" bgcolor="#FFFFFF" colspan="3"><?php echo $yyRecord[1];?></td>   
             <td align="center" bgcolor="#FFFFFF">申请指定医生：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $yyRecord[2];?></td>   
             </tr>
            
          <?php
          $rzyysql = "select shi,yymch,zhdysh,sheng from `yyyshdq` where id='".$Record[11]."'";
          $rzyyQuery_ID = mysql_query($rzyysql);
          while($rzyyRecord = mysql_fetch_array($rzyyQuery_ID)){
          ?>
            <tr style="color:#1f4248; font-size:12px;">
             <td align="center" bgcolor="#FFFFFF">入组城市：</td>
             <td align="center" bgcolor="#FFFFFF"><?php if($rzyyRecord[0]!=""){echo $rzyyRecord[0];}else{echo $rzyyRecord[3];}?></td>
             <td align="center" bgcolor="#FFFFFF">入组医院：</td>
             <td align="center" bgcolor="#FFFFFF" colspan="3"><?php echo $rzyyRecord[1];?></td>  
             <td align="center" bgcolor="#FFFFFF">入组指定医生：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $rzyyRecord[2];?></td>
            </tr>
          <?php
          }
          ?>
        <?php  
          }
         if($Record[12]!=""){
        ?>

            <div>
            <?php        
    $yysql = "select shi,yymch,zhdysh,sheng from `yyyshdq` where `id`='".$Record[12]."'";

    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
if($yyRecord[0]!=""){$yychsh=$yyRecord[0];}else{$yychsh=$yyRecord[3];}
      echo "<tr  style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">转诊城市：</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$yychsh."</td> <td align=\"center\" bgcolor=\"#FFFFFF\">转诊医院：</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$yyRecord[1]." </td> <td align=\"center\" bgcolor=\"#FFFFFF\">转诊医生：</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$yyRecord[2]."</td></tr>";
    }
        }
        ?>
           <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF" colspan="3">患者通讯住址：</td>
            <td align="center" bgcolor="#FFFFFF" colspan="6"><?php echo $Record[14];?></td></tr>
            <tr style="color:#1f4248; font-size:12px;">
             <td align="center" bgcolor="#FFFFFF">患者手机：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[15];?></td>
             <td align="center" bgcolor="#FFFFFF">第一联系人电话：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[16];?></td>
             <td align="center" bgcolor="#FFFFFF">第二联系人电话：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[17];?></td>
             <td align="center" bgcolor="#FFFFFF">第三联系人电话：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[51];?></td>
            </tr>
            <tr style="color:#1f4248; font-size:12px;">
             <td align="center" bgcolor="#FFFFFF">患者户籍：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[19];?></td>
             <td align="center" bgcolor="#FFFFFF">患者家庭人口：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[20];?>人</td>
             <td align="center" bgcolor="#FFFFFF">家庭年收入：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo $Record[21];?>元</td>
             <td align="center" bgcolor="#FFFFFF">人均收入：</td>
             <td align="center" bgcolor="#FFFFFF"><?php echo round($Record[21]/$Record[20], 2);?>元/人</td>   
                
            </tr>
            <tr style="color:#1f4248; font-size:12px;">
             <td align="center" bgcolor="#FFFFFF">参保类型：</td>
             <td align="center" bgcolor="#FFFFFF" colspan="3"><?php echo $Record[23];?></td>
             <td align="center" bgcolor="#FFFFFF">参保地区：</td>
             <td align="center" bgcolor="#FFFFFF" colspan="3"><?php if($Record[24]!=""){echo $Record[24];}if($Record[24]!=""&&$Record[39]!=$Record[24]){echo $Record[39];}if($Record[40]!=""){echo $Record[40];}?></td>
            </tr>
     <tr style="color:#1f4248; font-size:12px;">
      <td align="center" bgcolor="#FFFFFF">捐助类型：</td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $Record[25];?></td>
      
      <td align="center" bgcolor="#FFFFFF">用药剂量：</td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $Record[28];?> </td> 
      <td align="center" bgcolor="#FFFFFF">用法：</td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $Record[29];?>
       <?php /*if($Record[30]!=""){?> &nbsp;&nbsp;首次用药日期：<?php echo $Record[30];}<span class="label" style="width: 150px">项目申请信息表日期：</span><?php echo $Record[31];?>
        &nbsp;&nbsp;*/?></td>
      <td align="center" bgcolor="#FFFFFF"></td>
      <td align="center" bgcolor="#FFFFFF"></td>
    </tr>
    <tr style="color:#1f4248; font-size:12px;">
     <td align="center" bgcolor="#FFFFFF">首次材料登记日期：</td>
     <td align="center" bgcolor="#FFFFFF"><?php echo $Record[43];?></td>
     <td align="center" bgcolor="#FFFFFF" >初次审核日期：</td><td align="center" bgcolor="#FFFFFF" ><?php echo $Record[32];?></td>  
     <td align="center" bgcolor="#FFFFFF" ><?php if($Record[34]!=""){ echo "正式入组日期：";}?></td><td align="center" bgcolor="#FFFFFF" ><?php if($Record[34]!=""){ echo $Record[34];}?></td>
     <td align="center" bgcolor="#FFFFFF" ></td><td align="center" bgcolor="#FFFFFF" ></td>
    </tr>
   <tr style="color:#1f4248; font-size:12px;">
    <td align="center" bgcolor="#FFFFFF" colspan="2">领药药房：</td>
    <td align="center" bgcolor="#FFFFFF" colspan="6"><?php      
    /*$sql = "select id,yfsheng,yfmch,yfzhdysh,yfdh from `yf` where `yfmch`='".$Record[36]."'";
    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
      echo $Record[1].$Record[2]." ".$Record[3]." ".$Record[4];
    }*/
    echo $Record[36];
?></td></tr>
        
    </table>
    </fieldset>
    <fieldset class="top">
        <legend>直系亲属列表</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td align="center" bgcolor="#FFFFFF">
                    姓名
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    证件号码
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    与患者关系
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    联系电话
                </td>
            </tr>
        <?php
          $qshsql = "select * from `zhxqsh` where hzhid='$yhid' and gxzf='1'";
          $qshQuery_ID = mysql_query($qshsql);
          while($qshRecord = mysql_fetch_array($qshQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">".$qshRecord[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
          if($qshRecord[3]!=""){echo "身份证:".$qshRecord[3];}else if($qshRecord[7]!=""){echo "军官证:".$qshRecord[7];}
          echo"</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$qshRecord[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$qshRecord[6]."</td></tr>";
          }
        ?>

            
        </table>
    </fieldset>

<FIELDSET class="top"><LEGEND>审核记录</LEGEND>
        <div>
        <?php
          $clsql = "select `shfshd`,`shfyx`,`shhyj` from `clshh` where hzhid='$yhid' and id in (select max(id) from `clshh` where hzhid='$yhid')";
          $clQuery_ID = mysql_query($clsql);
          while($clRecord = mysql_fetch_array($clQuery_ID)){
          $shfshd=$clRecord[0];
          $shfyx=$clRecord[1];
          $shhyj=$clRecord[2];
          }
          str_replace('1','1',$shfshd,$shfshdi);
          str_replace('1','1',$shfyx,$shfyxi);
          if($Record[50]!='2'){
              $gxyclshl=11;
  
          } else {
              //重新入组
              //pNET RCC GIST 正常需要6份材料  RCC 1+1+1(3次以上)
              if(($hzhshqbzh=='GIST'||$hzhshqbzh=='pNET'||$hzhshqbzh=='RCC')&&($hzhjzhlx=='全部'||$hzhjzhlx=='部分'||$hzhjzhlx=='原部分')){ $gxyclshl=6;}
              //RCC 1+1+1(3次以下) 需要7份材料
              else if($hzhshqbzh=='RCC'&&$hzhjzhlx=='1+1+1') {
                  $gxyclshl=7;
              } else {
                  $gxyclshl=6;
              }
          }
          echo "申请材料 共需要".$gxyclshl."份,已收到".$shfshdi."份,其中".$shfyxi."份有效";
          //if($shhyj!='1'||$shqzht=='0'||$shhxcl==1){
          if($shqzht=='0'){

          //if(($shqzht!="-1"&&$shqzht!='1')||$shqzht=='0'){
            if(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
        ?>
            &nbsp;<a href="chcshh.php?id=<?php echo $yhid;?>" >新增</a>
        <?php
            }
          }
        //}//echo $shhyj.$shqzht;
        ?>
            
        </div>
<TABLE width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <TBODY>
  <TR style="color:#1f4248; font-weight:bold; height:30px;">
    <Td align="center" bgcolor="#FFFFFF">操作 </Td>
    <Td align="center" bgcolor="#FFFFFF">审批状态 </Td>
    <Td align="center" bgcolor="#FFFFFF">审批日期 </Td>
    <Td align="center" bgcolor="#FFFFFF">审批人 </Td>
    <Td align="center" bgcolor="#FFFFFF">说明原因 </Td></TR>
<?php
$shpsql = "select `id`,`shhyj`,`shhrrq`,`dqshhr`,`wtgyy`,`bzhshm` from `clshh` where hzhid='$yhid' order by id DESC";
$shpQuery_ID = mysql_query($shpsql);
while($shpRecord = mysql_fetch_array($shpQuery_ID)){
echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href='chcshhxx.php?id=".$shpRecord[0]."&id2=".$yhid."'>详情</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">";
if($shpRecord[1]==1){echo "材料齐全";$shqclqq='1';}else{echo "补寄材料";}
echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\" >".$shpRecord[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shpRecord[3]."</td><td align=\"center\" bgcolor=\"#FFFFFF\" ><A href=\"javascript:chkyy('chkyy','".$shpRecord[0]."');\">详细说明原因</A></td></tr>";
  echo "<TR id=chkyy".$shpRecord[0]." style=\"display:none;\"><TD style=\"PADDING-LEFT: 60px\" align=\"center\" bgcolor=\"#FFFFFF\" colSpan=5><PRE>";
  if($shpRecord[1]==1){echo $shpRecord[5];}else{echo $shpRecord[4]."</br>备注：".$shpRecord[5];}
  echo "</PRE></TD></TR>";

}
?>
  </TBODY></TABLE></FIELDSET>

    <fieldset class="top">
        <legend>社会调查记录<?php 
        if($shqzht!="-1"&&$shqzht!="1"){
          if(in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
        ?> <a href="xzshhdch.php?id=<?php echo $yhid;?>">新增</a><?php }}?></legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th width="10%" align="center" bgcolor="#FFFFFF">
                    操作
                </th>
                <th width="10%" align="center" bgcolor="#FFFFFF">
                    调查部门
                </th>
                <th width="10%" align="center" bgcolor="#FFFFFF">
                    联系电话
                </th>
                <th width="10%" align="center" bgcolor="#FFFFFF">
                    是否属实
                </th>
                <th width="10%" align="center" bgcolor="#FFFFFF">
                    调查日期
                </th>
                <th width="10%" align="center" bgcolor="#FFFFFF">
                    调查人
                </th>
                <TH width="10%" align="center" bgcolor="#FFFFFF">说明原因 </TH>
            </tr>
        <?php
          $shdsql = "select * from `shhdch` where hzhid='$yhid' order by id DESC";
          $shdQuery_ID = mysql_query($shdsql);
          while($shdRecord = mysql_fetch_array($shdQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\"><a href='shhdchxx.php?id=".$shdRecord[0]."&id2=".$yhid."'>详情</a></td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
          if($shdRecord[8]!=""){echo $shdRecord[8];}
          else{echo $shdRecord[2];}
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shdRecord[3]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
          switch ($shdRecord[4]){
          case "0":echo "不属实";break;
          case "1":$shfshsh='1';echo "属实";break;
          case "2":echo "不确定";break;
          }
          echo "</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$shdRecord[5]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$shdRecord[6]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\"><A href=\"javascript:shdyy('shdyy','".$shdRecord[0]."');\">详细说明原因</A></td></tr>";
          echo "<TR id=shdyy".$shdRecord[0]." style=\"display:none;\"><TD style=\"PADDING-LEFT: 60px\" colSpan=7 bgcolor=\"#FFFFFF\"><PRE>";
  if($shdRecord[4]=='0'){echo $shdRecord[9];}else{echo $shdRecord[7];}
  echo "</PRE></TD></TR>";
          
          }
        ?>
        </table>
        
    </fieldset>
    <?php
              if('1'=='1'){//if($shfshsh=='1'){//&&$shqzht!='1'
        ?>
    <fieldset class="top">
        <legend>审核结论</legend>
            <?php
            if($shqzht=='-1'){
            ?>
<div><a href="shhjlshs.php?id=<?php echo $yhid;?>">申诉</a></div>
            <?php
            }else if($shqzht!='1'&&$shqclqq=='1'&&$shfshsh=='1'){
            ?>
<div><a href="shhjl.php?id=<?php echo $yhid;?>">办理入组</a></div>
            <?php
            }
            ?>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th style="width:40px;" align="center" bgcolor="#FFFFFF">
                    操作
                </th>
                <th style="width:80px;" align="center" bgcolor="#FFFFFF">
                    审核人
                </th>
                <th style="width:110px;" align="center" bgcolor="#FFFFFF">
                    批准状态
                </th>
                <th style="width:90px;" align="center" bgcolor="#FFFFFF">
                    审核日期
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    备注、说明
                </th>
            </tr>
        <?php
          $shhejlsql = "select * from `shhejl` where `hzhid`='$yhid' and ( `shhyj` LIKE '%组%'  or `shhyj` LIKE '%拒%' or `shhyj` LIKE '%止%') order by id DESC";
          $shhejlQuery_ID = mysql_query($shhejlsql);
          while($shhejlRecord = mysql_fetch_array($shhejlQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href='shhjlpdf.php?id=".$yhid."'>下载</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shhejlRecord[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shhejlRecord[3]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shhejlRecord[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shhejlRecord[5]."</td></tr>";
          
          }
        ?>
        </table>

    </fieldset>
        <?php
        }
        ?>

    <fieldset class="top">
        <legend>不良事件报告 <?php if($shqzht!="-1"||(in_array('blshjbggl_xz',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll')){
        ?><a href="blshjxz.php?id=<?php echo $yhid;?>">新增<?php }?></a>
            </legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                
                <td align="center" bgcolor="#FFFFFF">
                    操作
                </td>
                
                <td align="center" bgcolor="#FFFFFF">
                    事件信息来源
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    索坦用量及用法
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    事件描述
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    CFC填表人
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    获知的日期
                </td>

            </tr>
        <?php
          $blshsql = "select * from `blshj` where hzhid='$yhid'  order by id ASC";
          $blshQuery_ID = mysql_query($blshsql);
          while($blshRecord = mysql_fetch_array($blshQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href='blshjxx.php?id=".$blshRecord[0]."'>详情</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">";
          if($blshRecord[2]=='0'){echo "医生";}else if($blshRecord[2]=='1'){echo "患者";}else if($blshRecord[2]=='2'){echo "患者家属";}
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[5]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[9]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[6]."</td></tr>";
          
          }
        ?>
        </table>
    </fieldset>
    <fieldset class="top">
        <legend>医学评估报告 <?php if($shqzht!="-1"){
//获取患者发药次数
$hzhfycshq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$yhid."' and `tshqk`='0'");
$hzhfycsh = mysql_num_rows($hzhfycshq);
if($hzhfycsh<0){$hzhfycsh=0;}

//获取患者医学随访表数量
$hzhyxsfbq=mysql_query("SELECT * FROM `yxpgbg` where `hzhid`='".$yhid."' and `bglx`='2'");
$hzhyxsfb = mysql_num_rows($hzhyxsfbq);
if($hzhyxsfb<0){$hzhyxsfb=0;}

//获取患者医学评估报告情况
// $hzhyxpgbq=mysql_query("SELECT * FROM `yxtjpg_new` where `hzhid`='".$yhid);
$hzhyxpgbq = $db->getAll("SELECT * FROM `yxtjpg_new` where `hzhid`=".$yhid);
$hzhyxpgb = array_sum($hzhyxpgbq);
if($hzhyxpgb<0){$hzhyxpgb=0;}
    
$hzhlysf=0;//初始患者领药医学随访表判断，0为无法新增
if($hzhfycsh>0){
  if($hzhyxsfb<$hzhfycsh){     
    $hzhlysf=1;//设置可以新增领药医学随访表
  }
}
if($hzhlysf==1||$hzhyxpgb==0){
  if(in_array('yxpgbg_xz',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){   
    ?><a href="yxpgbgxz.php?id=<?php echo $yhid; if($hzhyxpgb==0){ echo "&hzhyxpgbg=0";} ?>">新增</a><?php
  }else{
    ?><a >新增</a><?php
  }
}
        }
        ?>
            </legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                
                <th align="center" bgcolor="#FFFFFF">
                    操作
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    评估类型
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    录入日期
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    录入人
                </th>

            </tr>
        <?php
          if(!empty($hzhyxpgbq)) {
              foreach($hzhyxpgbq as $key => $val) {
                  echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">";
                  echo "<a href='yxpgbgxx.php?id=".$val['id']."'>详情</a> ";
                  echo "<a href='yxpgbgxg.php?id=".$val['id']."'>修改</a>";
                  echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
                  echo '医学条件评估';
                  echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$val['bctime']."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$val['lrr']."</td></tr>";
              }
          }
        ?>
        </table>
    </fieldset>
    <fieldset class="top">
        <legend>随访手册寄出记录 <?php
        $arr = $db->getRow("select * from hzh where id=$yhid");
        //完成3个条件即是 代办入组状态
        if($arr['shqzht'] == '待办入组') {
            ?><a href="shhjlerci.php?id=<?php echo $yhid;?>">新增</a><?php
        }
        
        
//         if($anzht>'0' && $anzht<'3'){
//           $sfshcsql = "select `jchrq`,`ydh`,`lyyf`,`id` from `sfshc` where `hzhid`='$yhid'";
//           $sfshcQuery_ID = mysql_query($sfshcsql);
//           $sfshczht=0;
//           while($sfshcRecord = mysql_fetch_array($sfshcQuery_ID)){
//             $sfshczht=1;
//           }
//           if($sfshczht==0){
//               in_array('shqgl_shh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'
//             if($arr['shqzht'] == '代办入组') {
              ?>
              <!--  <a href="shhjlerci.php?id=<?php //echo $yhid;?>">新增</a> -->
              <?php
//             }
//           }
//         }
        ?></legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td align="center" bgcolor="#FFFFFF">
                    操作
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    寄出日期
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    运单号
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    领药药房名称
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    领药地址
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    药房联系方式
                </td>

            </tr>
        <?php
          $sfshcsql = "select `jchrq`,`ydh`,`lyyf`,`id` from `sfshc` where `hzhid`='$yhid'";
          $sfshcQuery_ID = mysql_query($sfshcsql);
          while($sfshcRecord = mysql_fetch_array($sfshcQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href='sfshcpdf.php?id=".$yhid."'>下载</a> <a href='xgydh.php?id=".$sfshcRecord[3]."'>修改</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">".$sfshcRecord[0]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$sfshcRecord[1]."</td>";
            $sfshcyfsql = "select `yfdzh`,`yfdh`,`yfmch`,`shfzt`,`yfsheng`,`yfshi`,`yfqu` from `yf` where `yfmch`='".$sfshcRecord[2]."' limit 0,1";
            $sfshcyfQuery_ID = mysql_query($sfshcyfsql);
            while($sfshcyfRecord = mysql_fetch_array($sfshcyfQuery_ID)){
            if($sfshcyfRecord[4]==$sfshcyfRecord[5]){$sfscyfshengshi=$sfshcyfRecord[4];}
            else{$sfscyfshengshi=$sfshcyfRecord[4].$sfshcyfRecord[5];}
            if($sfshcyfRecord[6]!=""&&$sfshcyfRecord[6]!="市、县级市"){
            $sfscyfshengshi .=$sfshcyfRecord[6];
            }
            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$sfshcyfRecord[2]."</td><td align=\"center\"  bgcolor=\"#FFFFFF\">".$sfscyfshengshi.$sfshcyfRecord[0]."</td><td align=\"center\"  bgcolor=\"#FFFFFF\">".$sfshcyfRecord[1]."</td>";

            }
          echo "</tr>";
          
          }
        ?>
        </table>
    </fieldset>
    <fieldset class="top">
        <legend>随访记录</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th align="center" bgcolor="#FFFFFF">操作</th>            
                <th align="center" bgcolor="#FFFFFF">随访时间</th>
                <th align="center" bgcolor="#FFFFFF">随访方式</th>
                <!--th align="center" bgcolor="#FFFFFF">被随访人</th-->
                <th align="center" bgcolor="#FFFFFF">与患者的关系</th>
                <th align="center" bgcolor="#FFFFFF">随访人</th>
            </tr>
        <?php
          $xjsfjlsql = "select * from `xjsfjl` where `hzhid`='$yhid'  order by id DESC";
          $xjsfjlQuery_ID = mysql_query($xjsfjlsql);
          while($xjsfjlRecord = mysql_fetch_array($xjsfjlQuery_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcsfjlxx.php?id=".$xjsfjlRecord[0]."\">详细</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[2]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[3]."</td>";
    //echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[4]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[5]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[8]."</td></tr>";
          }
        ?>
        </table>
    </fieldset>

    <fieldset class="top">
        <legend>赠药发放记录</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th align="center" bgcolor="#FFFFFF">
                    领药次数/瓶数
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    药品规格
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    交回余药数量
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    交回空瓶数量
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    领药人
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    药师
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    药房名称
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    发药日期
                </th>                
            </tr>
        <?php
          $blshsql = "select * from `zyff` where `hzhid`='$yhid' and `tshqk`='0'  order by id ASC";
          $blshQuery_ID = mysql_query($blshsql);
          while($blshRecord = mysql_fetch_array($blshQuery_ID)){
        ?>
            <tr style="color:#1f4248; font-size:12px;">
                <td align="center" bgcolor="#FFFFFF">
                    <a href="cfcyshfyxq.php?id=<?php echo $blshRecord[0];?>" ><?php
                    $lynumq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$yhid."' and `tshqk`='0' and `id`<='$blshRecord[0]'");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}
            echo $lynum;?>次/<?php
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `hzhid`='".$yhid."' and `id`='$blshRecord[0]'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){if($lyshlnum[0]!=""){echo $lyshlnum[0];}else{echo "0";}}
            ?>瓶</a>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php if($blshRecord[5]=="1"){echo "12.5mg*28粒/瓶";}else{echo "12.5mg*28粒/瓶";}?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[8];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[7];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php if($blshRecord[9]=="0"){echo "本人";}else{
                    $zhxqshsql = "select `xm`,`yhzhgx` from `zhxqsh` where `id`='".$blshRecord[9]."'";
$zhxqshQuery_ID = mysql_query($zhxqshsql);
while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
    echo $zhxqshRecord[0].":".$zhxqshRecord[1];
}
                    }?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[18];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[19];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[20];?>
                </td>                
            </tr>  
        <?php
          
          }
        ?>
          
        </table>
        
    </fieldset>
    
    
    
    <fieldset class="top">
        <legend>转诊记录 <?php if($shqzht!="-1"){
        if(in_array('shqgl_zhzh',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
        ?><a href="zhzhshqxz.php?id=<?php echo $yhid;?>">新增</a><?php }}?></legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td  align="center" bgcolor="#FFFFFF">
                    操作
                </td>
                <td style="width:60px" align="center" bgcolor="#FFFFFF">
                    申请日期
                </td>
                <td  align="center" bgcolor="#FFFFFF">
                    理由
                </td>
                <td style="width:40px" align="center" bgcolor="#FFFFFF">
                    状态
                </td>
                <td style="width:120px" align="center" bgcolor="#FFFFFF">
                    转出医院
                </td>
                <td style="width:120px" align="center" bgcolor="#FFFFFF">
                    转入医院
                </td>
                <td style="width:120px" align="center" bgcolor="#FFFFFF">
                    转出药房
                </td>
                <td style="width:120px" align="center" bgcolor="#FFFFFF">
                    转入药房
                </td>
                <td style="width:60px" align="center" bgcolor="#FFFFFF">
                    经办日期
                </td>
            </tr>
        <?php
          $zhzhsql = "select * from `zhzh` where hzhid='$yhid'";
          $zhzhQuery_ID = mysql_query($zhzhsql);
          while($zhzhRecord = mysql_fetch_array($zhzhQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href='zhzhshqxq.php?id=".$zhzhRecord[0]."'>详情</a></td><td align=\"center\" bgcolor=\"#FFFFFF\">".$zhzhRecord[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$zhzhRecord[3]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$zhzhRecord[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    $zhzhyy1sql = "select yymch from `yyyshdq` where `id`='".$zhzhRecord[5]."'";
    $zhzhyy1Query_ID = mysql_query($zhzhyy1sql);
    while($zhzhyy1Record = mysql_fetch_array($zhzhyy1Query_ID)){
      echo $zhzhyy1Record[0];
    }
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    $jzhyy1sql = "select yymch from `yyyshdq` where `id`='".$zhzhRecord[8]."'";
    $jzhyy1Query_ID = mysql_query($jzhyy1sql);
    while($jzhyy1Record = mysql_fetch_array($jzhyy1Query_ID)){
      echo $jzhyy1Record[0];
    }
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    /*$zhzhyf1sql = "select yfmch from `yf` where `id`='".$zhzhRecord[11]."'";
    $zhzhyf1Query_ID = mysql_query($zhzhyf1sql);
    while($zhzhyf1Record = mysql_fetch_array($zhzhyf1Query_ID)){
      echo $zhzhyf1Record[0];
    }*/
          echo $zhzhRecord[11];
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    /*$jzhyf1sql = "select yfmch from `yf` where `id`='".$zhzhRecord[12]."'";
    $jzhyf1Query_ID = mysql_query($jzhyf1sql);
    while($jzhyf1Record = mysql_fetch_array($jzhyf1Query_ID)){
      echo $jzhyf1Record[0];
    }*/
          echo $zhzhRecord[12];
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$zhzhRecord[13]."</td></tr>";
          
          }
        ?>
        </table>
    </fieldset>
<?php
    $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=shqgl.php\">";}

?>
        


    <!--div id="topBox">
        <a class="maodian" href="#headerUser">返回顶部</a></div>
    </div-->
    <script type="text/javascript">
        function chkyy(preFix, id) {
            $("#" + preFix + id).toggle();
            $("[id^='" + preFix + "']").not($("#" + preFix + id)).hide();
        }
        function shdyy(preFix, id) {
            $("#" + preFix + id).toggle();
            $("[id^='" + preFix + "']").not($("#" + preFix + id)).hide();
        }
        $(function () {
            ResetTopBox();
            $(".maodian").anchorGoWhere({ target: 1 });
            $(window).resize(function () {
                ResetTopBox();
            });

            $(window).scroll(function () {
                ResetTopBox();
            });
        });
    </script>

           
        </div>
    </div>
</body>
</html>
