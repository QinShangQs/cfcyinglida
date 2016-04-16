<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="CFC批复赠药操作";
include('spap_head.php');
?>
        <div>
            <span class="label"></div>
        <div>
            <span class="label"></div>
        <div>
            <span class="label"></div>

            
        <div class="btnPos">
            </div>

  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
        <form action="cfczyshqpzhac.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<?php     
$shqid = $_GET['id'];   
    $sql = "select * from `yfshqzy` where `id` = '".$shqid."'";

    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
        
    $yfsql = "select * from `yf` where  `yfmch`='".$Record[25]."' and `yfzhdysh`='".$Record[1]."'";
    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){
   
?>

<div class="insinsins" style="width: 100%">
<label>药房名称：<input type="hidden" name="id" value="<?php echo $shqid;?>" /></label><span><?php echo $yfRecord[1];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定药师：</label><span><?php echo $yfRecord[11];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>库存容量：</label><span><?php echo $yfRecord[9];?></span>
</div>
<?php
    }
    if($Record[4]>"0"){
$pfshl1ztsql="SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='2' and `yfmch`='".$Record[25]."'" ;

$pfshl1ztq=mysql_query($pfshl1ztsql);
while($pfshl1ztRecord = mysql_fetch_array($pfshl1ztq)){$pfshl1zt=$pfshl1ztRecord[0];}
?>
<div class="insinsins" style="width: 100%">
<label>规格：</label><span><?php echo $Record['gg1'];?></span>
<input type="hidden" name="gg" value="<?php echo $Record['gg1']; ?>"/>
</div>
<div class="insinsins" style="width: 100%">
<label>当前库存数（盒）：</label><span><?php echo $Record[3];
if($pfshl1zt>0){
echo "（其中".($pfshl1zt)."在途中）";
}
?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>申请药品数（盒）：</label><span><?php echo $Record[4];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>批准申请药品数（盒）：</label><span><input class="input addInput" name="pfshl1" style="width: 460px;" type="text" value="<?php echo $Record[4];?>" /></span>
</div>
<?php
    }
?>
<div class="insinsins" style="width: 100%">
<label>批复说明：</label><span><input class="input addInput" name="pfnr" style="width: 460px;" type="text" value="" /></span>
</div>

                <div class="insinsins" style="width:100%;">
<span><input type="submit" value="保存" class="uusub" /><input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></span>
                </div>                 
<?php
  }
?>
</form>
              </td>
            </tr>
          </table> 
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>