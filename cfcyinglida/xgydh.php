<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$html_title="修改运单号";
include('spap_head.php');
?>
   <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="xgydh.php"><?php echo $html_title;?></a>      </div> 
			<div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
        <form action="xgydhac.php" method="post">
          <?php
            $sql="select * from `sfshc` where `id`=".$id;
            $query=mysql_query($sql);
            while($Record=mysql_fetch_array($query)){
          ?>
          运单号：<input type="text" name="hzhydh" value="<?php echo $Record[3];?>" class="grd-white"><br>
          <input type="hidden" name="hiddenhzhid" value="<?php echo $Record[1];?>">
          <?php
          }
          ?>
          <input type="hidden" name="hiddenid" value="<?php echo $id;?>">
          <div class="top">
          <input type="submit" name="submit" value="修改" class="uusub">
          </div>
        </form>
        </div>
      </div>
    </div>
   </div>
</body>
</html>
