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
$yhgldw=$xgyyf;
$yyid = $_GET['id'];
$html_title="指定医院详细";
include('spap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="xgyzhdyyysh.php">指定医院管理</a>
        > <?php echo $html_title;?></div>
    <div class="form">
<?php        
  $sql = "select * from `yyyshdq` where `id`='".$yyid."' and `yyzhdyf` in ($yhgldw)";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <div>
            <span class="label">医院名称：</span><?php echo $Record[3];?></div>
        <div>
            <span class="label">医院所在城市：</span><?php echo $Record[1].$Record[24];?></div>
        <div>
            <span class="label">医院地址：</span><?php echo $Record[20];?></div>
        <div>
            <span class="label">医院科室：</span><?php echo $Record[5];?></div>
        <div>
            <span class="label">指定医生：</span><?php echo $Record[6];?></div>
        <div>
            <span class="label">医生联系方式：</span><?php echo $Record[7];?></div>
        <div>
            <span class="label">指定医生样张：</span><?php
            //echo $Record[8];
            echo "<img src=\"/qzyzh/".sprintf("%03d", $Record[8])."-1.jpg\"/><img src=\"/qzyzh/".sprintf("%03d", $Record[8])."-2.jpg\"/>"; 
            ?></div>
        <div>
            <span class="label">授权一医生：</span><?php echo $Record[9];?></div>
        <div>
            <span class="label">授权一医生样张：</span><?php
            //echo $Record[10];
            echo "<img src=\"/qzyzh/".sprintf("%03d", $Record[8])."-3.jpg\"/>"; 
            ?></div>
        <div>
            <span class="label">授权一联系方式：</span><?php echo $Record[11];?></div>
        <div>
            <span class="label">授权二医生：</span><?php echo $Record[12];?></div>
        <div>
            <span class="label">授权二医生样张：</span><?php
            //echo $Record[10];
            echo "<img src=\"/qzyzh/".sprintf("%03d", $Record[8])."-4.jpg\"/>"; 
            ?></div>
        <div>
            <span class="label">授权二联系方式：</span><?php echo $Record[14];?></div>
        <div>
            <span class="label">授权三医生：</span><?php echo $Record[15];?></div>
        <div>
            <span class="label">授权三医生样张：</span><?php
            //echo $Record[10];
            echo "<img src=\"/qzyzh/".sprintf("%03d", $Record[8])."-5.jpg\"/>"; 
            ?></div>
        <div>
            <span class="label">授权三联系方式：</span><?php echo $Record[17];?></div>
        <div>
            <span class="label">医生培训期数：</span><?php echo $Record[18];?></div>
        <div>
            <span class="label">医生培训日期：</span><?php echo $Record[19];?></div>
        <div>
            <span class="label">医生是否生效：</span><?php if($Record[21]=='1'){echo "是";}else {echo "否";}?></div>
        <div>
            <span class="label">医院指定药房：</span><?php 

/*$yfsql = "select yfmch,yfzhdysh,yfdh from `yf` where `id`='".$Record[22]."'";

$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){
echo $yfRecord[0]." ".$yfRecord[1]." ".$yfRecord[2];
}*/
  echo $Record[22];

            
            
            ?></div>
        <div>
            <span class="label">是否接收AE回访：</span><?php if($Record[23]=='1'){echo "是";}else {echo "否";}?></div>
            
        <div class="btnPos">
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="lgSub" /></div>
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
