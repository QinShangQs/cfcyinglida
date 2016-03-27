<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb_yy.php');
$html_title="网上申请详细信息";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `hzh` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="wshshqgl.php">网上申请管理</a>
        > <?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>

        <div>您可以：
        <?php 
        if($Record[29]==1){
          if($Record[32]!=1){
        ?>
        <input type="button" value="导入系统" class="lgSub" onclick="javascript:{location.href='wshshqdr.php?wshshqyym=<?php echo $yhid;?>'}" />
        </div>
        <?php
          }else{echo "已导入系统";}
        }else{
        echo "预约未完成";
        }
        ?>
        <fieldset>
            <legend>申请基础信息</legend>
            <div>
                <span class="label">患者姓名：</span><?php echo $Record[2];?>
                <span class="label">申请号：</span><?php echo sprintf("%05d", $Record[0]);?>
                <span class="label"><?php echo $Record[3];?>：</span><?php echo $Record[4];?>

            </div>
            <div>
                <span class="label">申请病种：</span><?php echo $Record[22];?>
                <span class="label">出生日期：</span><?php echo $Record[6];?>
                <span class="label">性别：</span><?php echo $Record[5];?>
                <span class="label">年龄：</span><?php 
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
echo birthday($Record[6]);
//echo birthday("2012-2-29");
                
                ?>
            </div>
        <?php
          $yysql = "select shi,yymch,zhdysh,sheng from `yyyshdq` where id='".$Record[23]."'";
          $yyQuery_ID = mysql_query($yysql);
          while($yyRecord = mysql_fetch_array($yyQuery_ID)){
          $dqjzhyy=$yyRecord[0].$yyRecord[1];
        ?>
            <div>
                <span class="label">申请城市：</span><?php if($yyRecord[0]!=""){echo $yyRecord[0];}else{echo $yyRecord[3];}?>
                <span class="label">申请医院：</span><?php echo $yyRecord[1];?>
                <span class="label">申请指定医生：</span><?php echo $yyRecord[2];?>
            </div>
        <?php  
          }
        ?>
            <div>
                <span class="label">患者通讯住址：</span><label><?php echo $Record[7].$Record[8].$Record[9].$Record[10];?></label>
            </div>
            <div>
                <span class="label">患者手机：</span><?php echo $Record[11];?><span class="label">第一联系人电话：</span><?php echo $Record[12];?>
                <span class="label">第二联系人电话：</span><?php echo $Record[13];?></div>
            <div>
                <span class="label">患者户籍：</span><?php echo $Record[14];?>
                <span class="label">患者家庭人口：</span><?php echo $Record[15];?>人
                <span class="label">家庭年收入：</span><?php echo $Record[16];?>元
                <span class="label">人均收入：</span><?php echo round($Record[16]/$Record[15], 2);?>元/人
            </div>
            <div>
                <span class="label">参保类型：</span><?php echo $Record[18];?>
                <span class="label">参保地区：</span><?php if($Record[19]!=""){echo $Record[19];}if($Record[20]!=""&&$Record[19]!=$Record[20]){echo $Record[20];}if($Record[21]!=""){echo $Record[21];}?>
            </div>
    <div>
        &nbsp;&nbsp;用药剂量：<?php echo $Record[27];?> &nbsp;&nbsp;用法：<?php echo $Record[26];?>
       <?php 
       if($Record[25]!=""){
       ?> 
       &nbsp;&nbsp;首次用药日期：
       <?php 
       echo $Record[25];
       }
       if($Record[30]!=""){
       ?> 
       &nbsp;&nbsp;首次预约日期：
       <?php 
       echo $Record[30];
       }
              if($Record[31]!=""){
       ?> 
       &nbsp;&nbsp;预约成功日期：
       <?php 
       echo $Record[31];
       }
       ?>
       
    </div>
    </fieldset>
    <fieldset>
        <legend>直系亲属列表</legend>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="10%" align="center" bgcolor="#FFFFFF">姓名</td>
                <td width="15%" align="center" bgcolor="#FFFFFF">证件号码</td>
                <td width="10%" align="center" bgcolor="#FFFFFF">与患者关系</td>
                <td width="10%" align="center" bgcolor="#FFFFFF">联系电话</td>
            </tr>
        <?php
          $qshsql = "select * from `zhxqsh` where hzhid='$yhid'";
          $qshQuery_ID = mysql_query($qshsql);
          while($qshRecord = mysql_fetch_array($qshQuery_ID)){
          echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">".$qshRecord[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
          if($qshRecord[3]!=""){echo "身份证:".$qshRecord[3];}else if($qshRecord[7]!=""){echo "军官证:".$qshRecord[7];}
          echo"</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$qshRecord[4]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$qshRecord[6]."</td></tr>";
          }
        ?>

            
        </table>
    </fieldset>

              </td>
            </tr>
          </table>                  

        </div>
      </div>
    </div>
<?php
    $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=shqgl.php\">";}
?>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>