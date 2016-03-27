<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="药房调拨确认收到";
include('spap_head.php');
//$yhgldw=$_SESSION[gldw];
$id=$_GET['id'];
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置： <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong>药房调拨确认收到</strong></div>
    <div class="incontact w955 flt">
    <?php
    $sql="select * from `yfdb` where `id`=".$id;
    $query=mysql_query($sql);
    while($Record=mysql_fetch_array($query)){
      $fcyfmch=$Record[1];//药房名称
      $pshl=$Record[9];//数量
      $gg=$Record[4];//规格
      $ph=$Record[12];//批号
      $ydh=$Record[8];//运单号
    }
    ?>
       <h3>您将收到由<?php echo $fcyfmch;?>调拨来的规格为<?php echo $gg;?>的药品<?php echo $pshl;?>瓶，快递单号为：<?php echo $ydh;?>，批号：<?php echo $ph;?>。</h3>
       <form action="yfdbshdglac.php" method="post">
       <input type="hidden" name="hidden" value="<?php echo $id;?>">
       <input type="submit" name="submit" value="确认收到" class="uusub">
       </form>
    </div>
    </div>
    </div>
    </div>
    
</body>
</html>
