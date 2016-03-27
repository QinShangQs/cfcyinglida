<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$zhzhid=$_GET['id'];
$html_title="转诊申请详细";
include('spap_head.php');
?>
   <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="zhzhshqxq.php"><?php echo $html_title;?></a> </div>
    <div class="form">
<?php        
    $zhzhsql = "select * from `zhzh` where id='$zhzhid'";

    $zhzhQuery_ID = mysql_query($zhzhsql);
    while($zhzhRecord = mysql_fetch_array($zhzhQuery_ID)){
?>
        <fieldset>
            <legend>患者</legend>
        <?php
          $hzhsql = "select * from `hzh` where id='".$zhzhRecord[1]."'";
          $hzhQuery_ID = mysql_query($hzhsql);
          while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
        ?>
            <div>
                <span class="label">患者姓名：</span><?php  echo $hzhxm=$hzhRecord[4];?>
                <span class="label">性别：</span><?php echo $hzhRecord[37];?>
                <span class="label">年龄：</span><?php //计算年龄
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
echo birthday($hzhRecord[38]);
//echo birthday("2012-2-29");?>
            </div>
            <div>
             <span class="label">通讯住址：</span><?php echo $hzhRecord[14];?>
            </div>
        <?php          
          }
        ?>

            <div>
                <span class="label top">申请理由：</span><?php echo $zhzhRecord[3];?>
            </div>
            <div>
                <span class="label"></span><span class="label"></span><span class="label">签字：</span><?php echo $hzhxm;?><span
                    class="label">申请日期：</span><?php echo $zhzhRecord[2];?>
            </div>
        </fieldset>
        <fieldset>
            <legend>就诊</legend>
            <div>
<?php        
    $yysql = "select sheng,yymch,zhdysh from `yyyshdq` where `id`='".$zhzhRecord[5]."'";

    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      echo "<span class=\"label\">就诊医院：</span>".$yyRecord[0].$yyRecord[1]." <span class=\"label\">指定医生：</span>".$zhzhysh=$yyRecord[2];
    }
?>
            </div>
            <div>
                <span class="label top">转诊意见：</span><?php echo $zhzhRecord[17];?>
            </div>
            <div>
                <span class="label"></span><span class="label"></span><span class="label">签字：</span><?php echo $zhzhysh;?><span
                    class="label">日期：</span><?php echo $zhzhRecord[7];?>
            </div>
        </fieldset>
        <fieldset>
            <legend>接诊</legend>
            <div>
<?php        
    $yy2sql = "select sheng,yymch,zhdysh from `yyyshdq` where `id`='".$zhzhRecord[8]."'";

    $yy2Query_ID = mysql_query($yy2sql);
    while($yy2Record = mysql_fetch_array($yy2Query_ID)){
      echo "<span class=\"label\">就诊医院：</span>".$yy2Record[0].$yy2Record[1]." <span class=\"label\">指定医生：</span>".$jzhysh=$yy2Record[2];
    }
?>
            </div>
            <div>
                <span class="label top">接诊意见：</span><?php echo $zhzhRecord[18];?>
            </div>
            <div>
                <span class="label"></span><span class="label"></span><span class="label">签字：</span><?php echo $jzhysh;?>
                <span class="label">日期：</span><?php echo $zhzhRecord[10];?>
            </div>
        </fieldset>
        <fieldset>
            <legend>项目办公室审批</legend>
            <div>
                <span class="label top">项目办公室意见：</span><?php echo $zhzhRecord[14];?>
            </div>
            <div>
                <span class="label">经办人：</span><?php $shhrsql = "select yhyl1 from `manager` where `id`='".$zhzhRecord[15]."'";
  $shhrQuery_ID = mysql_query($shhrsql);
  while($shhrRecord = mysql_fetch_array($shhrQuery_ID)){echo $shhrRecord[0];}?>
                    <span class="label">日期：</span><?php echo $zhzhRecord[13];?>
            </div>
            <div>
                <span class="label">办公室主任日期：</span><?php echo $zhzhRecord[19];?>
            </div>
        </fieldset>
        <fieldset>
            <legend>药房</legend>
            <div>
                <span class="label">转出药房：</span>
    <?php 
    /*$zhzhyf1sql = "select yfmch from `yf` where `id`='".$zhzhRecord[11]."'";
    $zhzhyf1Query_ID = mysql_query($zhzhyf1sql);
    while($zhzhyf1Record = mysql_fetch_array($zhzhyf1Query_ID)){
      echo $zhzhyf1Record[0];
    }*/
    echo $zhzhRecord[11];
    ?>
            </div>
            <div>
                <span class="label">转入药房：</span>
    <?php 
    /*$zhzh1yf1sql = "select yfmch from `yf` where `id`='".$zhzhRecord[12]."'";
    $zhzh1yf1Query_ID = mysql_query($zhzh1yf1sql);
    while($zhzh1yf1Record = mysql_fetch_array($zhzh1yf1Query_ID)){
      echo $zhzh1yf1Record[0];
    }*/
        echo $zhzhRecord[12];
    ?>
            </div>
        </fieldset>
<?php
    }
?>
        <div class="btnPos">
            <input type="button" value="返回" class="uusub2" onclick="javascript:history.go(-1);" /></div>
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
