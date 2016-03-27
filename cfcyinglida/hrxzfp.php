<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增发票";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
    <div class="thislink">当前位置：<a href="manager.php">管理首页</a> > <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong><?php echo $html_title;?></strong>
    </div>
    <div class="incontact w955 flt">
     <form action="hrxzfpac.php" method="post" name="">
      <div class="top">
      发票号码：<input type="text" class="grd-white" name="haoma" value=""><br />
      </div>
      <div class="top">
      药房名称：<input type="text" class="grd-white" name="yfmch" value=""><br />
      </div>
      <div class="top">
      用户信息：<input type="text" class="grd-white" name="yhxinxi" value=""><br />
      </div>
      <div class="top">
      发票日期：<input type="text" class="grd-white" id="fpriqi" name="fpriqi" value=""><br />
      </div>
      <div class="top">
      状&nbsp;&nbsp;&nbsp;&nbsp;态：<input type="radio" name="zhuangtai" value="1">有效<input type="radio" name="zhuangtai" value="2">无效<br />
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