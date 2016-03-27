<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="药品发放详细信息";
include('xpap_head.php');
?>

    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="yshfygl.php">发药管理</a>
        > <?php echo $html_title;?></div>
<?php
$fyid=$_GET['id'];
$sql = "select * from `zyff` where `id`='".$fyid."'";

$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
?>
    <div>
        发药日期:<?php echo $Record[20];?></div>
<?php
  $hzhsql = "select * from `hzh` where `id`='".$Record[1]."'";
  $hzhQuery_ID = mysql_query($hzhsql);
  while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){  
  $hzhxm=$hzhRecord[4];
  $hzhzhjhm=$hzhRecord[5].":".$hzhRecord[6];
?> 
    <div>
        患者姓名:<?php echo $hzhxm;?>&nbsp;&nbsp;患者身份号码:<?php echo $hzhzhjhm;?>&nbsp;&nbsp;患者编码：<?php echo "S-".$hzhRecord[2];?>&nbsp;&nbsp;病种：<?php echo $hzhRecord[7];?>
<?php
  }
?>
    </div>
    <div>
        本次药品规格:<?php if($Record[5]=="1"){echo "200mg*60粒/瓶";}else if($Record[5]=="2"){echo "250mg*60粒/瓶";}?></div>
    <div>
        本次领药数量:<?php echo $Record[4];?>瓶</div>
    <div>
        药品批号:<?php 
  $phsql = "select ph from `kfrk` where `id`='".$Record[21]."'";
  $phQuery_ID = mysql_query($phsql);
  while($phRecord = mysql_fetch_array($phQuery_ID)){ 
    echo $phRecord[0];
  }
      ?></div>
<?php if($Record[9]=="0"){//echo $hzhxm;
?>
    <div>
        领药人姓名:<?php echo $hzhxm;?></div>
    <div>
        领药人身份号码:<?php echo $hzhzhjhm;?></div>
    <div>
        领药人与患者关系:<?php echo "本人";?></div>
<?php
}
else{
  $lyrsql = "select * from `zhxqsh` where `id`='".$Record[9]."'";
  $lyrQuery_ID = mysql_query($lyrsql);
  while($lyrRecord = mysql_fetch_array($lyrQuery_ID)){ 
    //echo $lyrRecord[0];
?>
    <div>
        领药人姓名:<?php echo $lyrRecord[2];?></div>
    <div>
        领药人身份号码:<?php echo $lyrRecord[3];?></div>
    <div>
        领药人与患者关系:<?php echo $lyrRecord[4];?></div>
<?php
  }
}
?>

    <div>
        发药人员:<?php 
  /*$fyrnsql = "select `names` from `manager` where `id`='".$Record[18]."'";
  $fyrnQuery_ID = mysql_query($fyrnsql);
  while($fyrnRecord = mysql_fetch_array($fyrnQuery_ID)){ 
    $fyrname=$fyrnRecord[0];
  }
  $fyrsql = "select `yfzhdysh` from `yf` where `yfyshname`='".$fyrname."'";
  $fyrQuery_ID = mysql_query($fyrsql);
  while($fyrRecord = mysql_fetch_array($fyrQuery_ID)){ 
    echo $fyrRecord[0];
  }*/
  echo $Record[19]." ".$Record[18];
  ?></div>
    <div>
        交回空瓶数量:<?php echo $Record[7];?>瓶</div>
    <div>
        交回剩余药物量:<?php echo $Record[8];?>粒</div>
<?php
}
?>
    <input id="Id" name="Id" type="hidden" value="82530" />
    <div class="formConN">
        <div class="btnPos">
            <input type="button" value="返回" class="lgSub" onclick="javascript:window.history.go(-1);" /></div>
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
