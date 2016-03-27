<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="药房调拨详情";
include('spap_head.php');
//$yhgldw=$_SESSION[gldw];
$id=$_GET['id'];
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置： <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong>药房调拨详情</strong></div>
    <div class="incontact w955 flt">
    <?php
    $sql="select * from `yfdb` where `id`=".$id;
    $query=mysql_query($sql);
    while($Record=mysql_fetch_array($query)){
      $fcyfmch=$Record[1];//药房名称
      $shryf=$Record[2];//发入药房
      $fcyfysmch=$Record[10];//发出药房药师
      $fryfysh=$Record[11];//发入药房药师
      $dbypfyrq=$Record[6];//发运日期
      $dbypshdrq=$Record[7];//收到日期
      $dbyppsh=$Record[5];//调拨药品瓶数
      $dbzht=$Record[3];//状态
      $ph=$Record[12];//批号
      $pshl=$Record[9];//数量
      $gg=$Record[4];//规格
      $ph=$Record[12];//批号
      $ydh=$Record[8];//运单号
    }
    ?>
       <h4>发出药房：<?php echo $fcyfmch;?></h4>
       <h4>发入药房：<?php echo $shryf;?></h4>
       <h4>CFC批准的数量：
       <?php 
       if($dbyppsh!=''){ echo $dbyppsh.'瓶';}?></h4>
       <h4>药房实际发药瓶数:
       <?php 
       if($pshl!='') {echo $pshl.'瓶';}?></h4>
       <h4>发出药房药师：<?php echo $fcyfysmch;?></h4>
       <h4>发入药房药师：<?php echo $fryfysh;?></h4>
       <h4>状态：<?php 
       if($dbzht=='0'){
       echo "待发运";}
       if($dbzht=='1'){
       echo "在途中";}
       if($dbzht=='2'){
       echo "已收到";}
       ?>
       </h4>
       <h4>发运日期：<?php echo $dbypfyrq;?></h4>
       <h4>收到日期：<?php echo $dbypshdrq;?></h4>
       <h4>规格：<?php echo $gg;?></h4>
       <h4>快递单号：<?php echo $ydh;?></h4>
       <h3>批号：<?php echo $ph;?></h4>
       <input type="button" name="fanhui"   onclick="javascript:{history.go(-1);}" value="返回" class="uusub2">
    </div>
    </div>
    </div>
    </div>
    
</body>
</html>
