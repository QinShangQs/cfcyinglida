<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
$yhqxxf=str_ireplace(",","','","'".implode(",",$_SESSION[yhqxxf])."'");
$xgyyfsql = "select `yfmch` from `yf` where `yfshi` in (".$yhqxxf.")  group by  yfmch order by id DESC ";
//echo $sql;
$xgyyfQuery_ID = mysql_query($xgyyfsql);
$xgyyf="";
while($xgyyfRecord = mysql_fetch_array($xgyyfQuery_ID)){
  if($xgyyf!=""){
    $xgyyf.=",";
  }
  $xgyyf.="'".$xgyyfRecord[0]."'";
}
$id=$_GET['id'];
$html_title="项目资料申请";
include('spap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="manager.php">系统首页</a>
        > <?php echo $html_title;?></div>
    <div class="form">
    <?php 
      $sql="select * from `yyyshdq` where `id`='".$id."' and `yyzhdyf` in (".$xgyyf.")  group by  yymch order by id DESC ";
      //echo $sql;
      $Query_ID = mysql_query($sql);
      while($Record = mysql_fetch_array($Query_ID)){
    ?>
        <form action="xgyyshclshqac.php" method="post">
        <input id="yshid" name="yshid" type="hidden" value="<?php echo $Record[0];?>" />
        <div>
            <span style="width: 160px;"  class="label">医院名称：</span><?php echo $Record[3];?></div>
        <div>
            <span style="width: 160px;"  class="label">医生姓名：</span><?php echo $Record[6];?></div>
        <div>
            <span style="width: 160px;"  class="label">医生名下患者人数：</span><?php
      $hzhrshsql="select count(*) from `hzh` where (`shqyy`='".$Record[0]."' or `rzyy`='".$Record[0]."' or `zhzhyy`='".$Record[0]."') ";
      //echo $sql;
      $hzhrshQuery_ID = mysql_query($hzhrshsql);
      while($hzhrshRecord = mysql_fetch_array($hzhrshQuery_ID)){
          echo $hzhrshRecord[0]."人";
      }
            ?></div>
        <div>
            <span style="width: 160px;"  class="label">总申请资料数量：</span><?php
      $zshqsql="select SUM(hzhzlj),SUM(shqb) from `xgyyshxmclshq` where `yshid`='".$Record[0]."' ";
      //echo $sql;
      $zshqQuery_ID = mysql_query($zshqsql);
      while($zshqRecord = mysql_fetch_array($zshqQuery_ID)){
          if($zshqRecord[0]==""){$zshqRecord[0]=0;}
          if($zshqRecord[1]==""){$zshqRecord[1]=0;}
          echo "(".$zshqRecord[0]."/".$zshqRecord[1].")";
      }
            ?></div>
        <div>
            <span style="width: 160px;"  class="label">患者资料夹：</span><input class="input addInput" name="zlj" style="width: 460px;" type="text"  value="0"   onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" /></div>
        <div>
            <span style="width: 160px;"  class="label">患者资料夹(通用)：</span><input class="input addInput" name="zlj" style="width: 460px;" type="text"  value="0"   onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" /></div>
        <div>
            <span style="width: 160px;"  class="label">患者资料夹(医保)：</span><input class="input addInput" name="zlj" style="width: 460px;" type="text"  value="0"   onkeyup="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" onafterpaste="this.value=this.value.replace(/^([^0-9]*)(?:0(?=[1-9]))?([1-9][0-9]*|0|)(([^0-9]*)([0-9]*))*$/,'$2')" /></div>
            
        <div class="btnPos">
            <input type="submit" value="保存" class="lgSub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="lgSub" /></div>

        </form>
    <?php
      }
    ?>
    </div>
            <div class="clearFoot noPrint">
            </div>
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