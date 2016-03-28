<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
$html_title="申请详细信息";
include('spap_head.php');
?>
    <link href="css/prehuanhang.css" rel="stylesheet" type="text/css" media="screen" />
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="/manager.php">首页</a>-><?php echo $html_title;?> </div>
    <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `hzh` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $shhxcl=$Record[46];
  if($Record[25]=="全部"){$jzhlxnum='1';}else{$jzhlxnum='0';}
  if($Record[23]!="无"){$cblxnum='1';}else{$cblxnum='0';}
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
?>
        
        <fieldset>
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
             <td align="center" bgcolor="#FFFFFF">I-<?php echo $Record[2];?>
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

<FIELDSET><LEGEND>审核记录</LEGEND>
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
//pNET RCC全部11项材料
  if(($hzhshqbzh=='pNET'||$hzhshqbzh=='RCC')&&$hzhjzhlx=='全部'){ $gxyclshl=11;}
//pNET RCC部分12项材料
  else if(($hzhshqbzh=='pNET'||$hzhshqbzh=='RCC')&&$hzhjzhlx!='全部'){ $gxyclshl=12;}
  
  //GIST+全部13项材料
  else if($hzhshqbzh=='GIST'&&$hzhjzhlx=='全部'){ $gxyclshl=13;}
  //GIST+部分14项材料
  else if($hzhshqbzh=='GIST'&&$hzhjzhlx=='部分'){ $gxyclshl=14;}
  else{$gxyclshl=11;}
  
  }else{
  //重新入组
//pNET RCC GIST 正常需要6份材料  RCC 1+1+1(3次以上)
  if(($hzhshqbzh=='GIST'||$hzhshqbzh=='pNET'||$hzhshqbzh=='RCC')&&($hzhjzhlx=='全部'||$hzhjzhlx=='部分'||$hzhjzhlx=='原部分')){ $gxyclshl=6;}
//RCC 1+1+1(3次以下) 需要7份材料
  else if($hzhshqbzh=='RCC'&&$hzhjzhlx=='1+1+1'){ $gxyclshl=7;}
  else{$gxyclshl=6;}
  }
          echo "申请材料 共需要".$gxyclshl."份,已收到".$shfshdi."份,其中".$shfyxi."份有效";
        //}//echo $shhyj.$shqzht;
        ?>
            
        </div>
<TABLE width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <TBODY>
  <TR style="color:#1f4248; font-weight:bold; height:30px;">
    <Td align="center" bgcolor="#FFFFFF">审批状态 </Td>
    <Td align="center" bgcolor="#FFFFFF">审批日期 </Td>
    <Td align="center" bgcolor="#FFFFFF">说明原因 </Td></TR>
<?php
$shpsql = "select `id`,`shhyj`,`shhrrq`,`dqshhr`,`wtgyy`,`bzhshm` from `clshh` where hzhid='$yhid' order by id DESC";
$shpQuery_ID = mysql_query($shpsql);
while($shpRecord = mysql_fetch_array($shpQuery_ID)){
echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">";
if($shpRecord[1]==1){echo "材料齐全";$shqclqq='1';}else{echo "补寄材料";}
echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\" >".$shpRecord[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\" ><A href=\"javascript:chkyy('chkyy','".$shpRecord[0]."');\">详细说明原因</A></td></tr>";
  echo "<TR id=chkyy".$shpRecord[0]." style=\"display:none;\"><TD style=\"PADDING-LEFT: 60px\" align=\"center\" bgcolor=\"#FFFFFF\" colSpan=5><PRE>";
  if($shpRecord[1]==1){echo $shpRecord[5];}else{echo $shpRecord[4]."</br>备注：".$shpRecord[5];}
  echo "</PRE></TD></TR>";

}
?>
  </TBODY></TABLE></FIELDSET>

    <fieldset>
        <legend>不良事件报告</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                
                
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
                    获知的日期
                </td>

            </tr>
        <?php
          $blshsql = "select * from `blshj` where hzhid='$yhid'  order by id ASC";
          $blshQuery_ID = mysql_query($blshsql);
          while($blshRecord = mysql_fetch_array($blshQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">";
          if($blshRecord[2]=='0'){echo "医生";}else if($blshRecord[2]=='1'){echo "患者";}else if($blshRecord[2]=='2'){echo "患者家属";}
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[5]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$blshRecord[6]."</td></tr>";
          
          }
        ?>
        </table>
    </fieldset>
    <fieldset class="top">
        <legend>医学评估报告 </legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                
                <th align="center" bgcolor="#FFFFFF">
                    评估类型
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    录入日期
                </th>
                <!--th>
                    录入人
                </th-->

            </tr>
        <?php
          $yxpgsql = "select * from `yxpgbg` where hzhid='$yhid'";
          $yxpgQuery_ID = mysql_query($yxpgsql);
          while($yxpgRecord = mysql_fetch_array($yxpgQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">";
          if($yxpgRecord[4]!=""){echo $yxpgRecord[4];}else if($yxpgRecord[18]!=""){echo $yxpgRecord[18];}
          //echo "</td><td>".$yxpgRecord[2]."</td><td>".$yxpgRecord[3]."</td></tr>";
          echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$yxpgRecord[2]."</td></tr>";
          
          }
        ?>
        </table>
    </fieldset>
    <fieldset>
        <legend>随访手册寄出记录</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th align="center" bgcolor="#FFFFFF">
                    寄出日期
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    运单号
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    领药药房名称
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    领药地址
                </th>
                <th align="center" bgcolor="#FFFFFF">
                    药房联系方式
                </th>

            </tr>
        <?php
          $sfshcsql = "select `jchrq`,`ydh`,`lyyf` from `sfshc` where `hzhid`='$yhid'";
          $sfshcQuery_ID = mysql_query($sfshcsql);
          while($sfshcRecord = mysql_fetch_array($sfshcQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">".$sfshcRecord[0]."</td><td>".$sfshcRecord[1]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$sfshcRecord[2]."</td>";
            $sfshcyfsql = "select `yfdzh`,`yfdh`,`yfmch`,`shfzt`,`yfsheng`,`yfshi`,`yfqu` from `yf` where `yfmch`='".$sfshcRecord[2]."' limit 0,1";
            $sfshcyfQuery_ID = mysql_query($sfshcyfsql);
            while($sfshcyfRecord = mysql_fetch_array($sfshcyfQuery_ID)){
            if($sfshcyfRecord[4]==$sfshcyfRecord[5]){$sfscyfshengshi=$sfshcyfRecord[4];}
            else{$sfscyfshengshi=$sfshcyfRecord[4].$sfshcyfRecord[5];}
            if($sfshcyfRecord[6]!=""&&$sfshcyfRecord[6]!="市、县级市"){
            $sfscyfshengshi .=$sfshcyfRecord[6];
            }
            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$sfscyfshengshi.$sfshcyfRecord[0]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$sfshcyfRecord[1]."</td></tr>";

            }
          echo "</tr>";
          
          }
        ?>
        </table>
    </fieldset>
    <fieldset>
        <legend>随访记录</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th align="center" bgcolor="#FFFFFF">随访时间</th>
                <th align="center" bgcolor="#FFFFFF">随访方式</th>
                <th align="center" bgcolor="#FFFFFF">被随访人</th>
                <th align="center" bgcolor="#FFFFFF">与患者的关系</th>
                <!--th>随访人</th-->
            </tr>
        <?php
          $xjsfjlsql = "select * from `xjsfjl` where `hzhid`='$yhid'  order by id DESC";
          $xjsfjlQuery_ID = mysql_query($xjsfjlsql);
          while($xjsfjlRecord = mysql_fetch_array($xjsfjlQuery_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\">";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[2]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[3]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[4]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$xjsfjlRecord[5]."</td>";
    //echo "<td>".$xjsfjlRecord[8]."</td></tr>";
    echo "</tr>";
          }
        ?>
        </table>
    </fieldset>

    <fieldset>
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
          $blshsql = "select * from `zyff` where `hzhid`='$yhid' and `tshqk`='0' and `zyffzht` IS NULL order by id ASC";
          $blshQuery_ID = mysql_query($blshsql);
          while($blshRecord = mysql_fetch_array($blshQuery_ID)){
        ?>
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td align="center" bgcolor="#FFFFFF">
                    <?php
                    $lynumq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$yhid."' and `tshqk`='0' and `zyffzht` IS NULL and `id`<='$blshRecord[0]'");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}
            echo $lynum;?>次/<?php
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `hzhid`='".$yhid."' and `zyffzht` IS NULL and `id`='$blshRecord[0]'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){if($lyshlnum[0]!=""){echo $lyshlnum[0];}else{echo "0";}}
            ?>瓶
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[35];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[8];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php echo $blshRecord[7];?>
                </td>
                <td align="center" bgcolor="#FFFFFF">
                    <?php if($blshRecord[9]=="0"){echo "本人";}else{
                    
                    
                    $zhxqshsql = "select * from `tshzhtzyfywu` where `id`='".$blshRecord[9]."'";
$zhxqshQuery_ID = mysql_query($zhxqshsql);
while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
    echo $zhxqshRecord[7].":".$zhxqshRecord[8];
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
<?php 
    include('wdb.php');
    $db = new DB();
    $arr = $db->getRow("select * from hzh where id =".$yhid);
    if(!empty($arr)):
?>
    <fieldset>
        <legend>核实结果</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <th align="center" bgcolor="#FFFFFF">核实方式</th>
                <th align="center" bgcolor="#FFFFFF">医生未答复或延迟答复的原因</th>
            </tr>
            <tr>
                <th align="center" bgcolor="#FFFFFF"><?php echo $arr['shfs'];?></th>
                <th bgcolor="#FFFFFF"><?php echo $arr['bikaos'];?></th>
            </tr>
    </fieldset>
<?php endif;?>
    
<?php
    $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=xgyshqgl.php\">";}

?>
        

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
