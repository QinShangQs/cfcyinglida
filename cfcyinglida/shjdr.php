<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="数据导入";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置： <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong> <?php echo $html_title;?></strong>
    </div>
    <div class="incontact w955 flt">
      <form enctype="multipart/form-data" action="shjdrac.php" method="post">
       <input name="myFile" type="file">
       <input type="submit" name="sub" value="导入数据" class="uusub2">
      </form>
    </div>
    </div>
    </div>
    </div>   
</body>
</html>
