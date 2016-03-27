<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增发票";
include('spap_head.php');
$id = $_GET['id'];    //获取要修改的id
$sql="select * from `hrfpdj` where `id` = '$id'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query); 
?>
<div class="main">
		<div class="insmain">
    <div class="thislink">当前位置：<a href="manager.php">管理首页</a> > <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong><?php echo $html_title;?></strong>
    </div>
    <div class="incontact w955 flt">
     <form action="hrxgfpac.php" method="post" name="">
      <div class="top">
      发票号码：<input type="text" class="grd-white" name="haoma" value="<?php echo $result['1'];?>"><br />
      </div>
      <div class="top">
      药房名称：<input type="text" class="grd-white" name="yfmch" value="<?php echo $result['2'];?>"><br />
      </div>
      <div class="top">
      用户信息：<input type="text" class="grd-white" name="yhxinxi" value="<?php echo $result['3'];?>"><br />
      </div>
      <div class="top">
      发票日期：<input type="text" class="grd-white" id="fpriqi" name="fpriqi" value="<?php echo $result['4'];?>"><br />
      </div>
      <input type="hidden" name="hidden" value="<?php echo $id;?>">
      <div class="top">
      状&nbsp;&nbsp;&nbsp;&nbsp;态：<input type="radio" name="zhuangtai" <?php if($result['5']=='1') echo 'checked=checked';?> value="1">有效<input type="radio" name="zhuangtai" <?php if($result['5']=='2') echo 'checked=checked';?> value="2">无效<br />
      </div>
      <div class="top">
      <input type="submit" class="uusub" name="submit" value="保存"><br />
      </div>
     </form>
    </div>
    </div>
    </div>
</div>
</body>
    <script type="text/javascript">
        $(function () {
            chooseDateNow('fpriqi', 'fpriqi', true, true);
          });
    </script>
</html>