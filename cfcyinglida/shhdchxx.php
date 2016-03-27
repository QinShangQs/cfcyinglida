<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $id = $_GET['id'];
  $hzhid = $_GET['id2'];
$html_title="审核记录详情";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div> 
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
<div class=form>
<div>


        <div class="top">
            <span class="label">患者姓名：</span>
<?php 
$hzhsql = "select hzhxm from `hzh` where `id`='".$hzhid."'";
$hzhQuery_ID = mysql_query($hzhsql);
while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){echo $hzhRecord[0];}
?>
</div>
<?php 

  $sql = "select * from `shhdch` where `id`='".$id."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <div class="top">
            <span class="label">调查日期：</span><?php echo $Record[5];?>
        </div>
        <div class="top">
            <span class="label">调查部门：</span><?php
                      if($Record[8]!=""){echo $Record[8];}
          else{echo $Record[2];}
          ?>
        </div>
        <div class="top">
            <span class="label">联系电话：</span><?php echo $Record[3];?>
        </div>
        <div id="div_shushiqingkuang" class="top">
            <span class="label">是否属实：</span><?php
        switch ($Record[4]){
          case "0":echo "不属实";break;
          case "1":echo "属实";break;
          case "2":echo "不确定";break;
          }?> 
        </div>
        <?php if($Record[9]!=""){?>
        <div id="div_bushushimiaoshi" class="top">
            <span class="label top">不属实描述：</span><?php echo $Record[9];?>
        </div>
        <?php } ?>
        <div class="top">
            <span class="label top">备注：</span><?php echo $Record[7];?>
</textarea>
        </div>

<?php
  } 
?>    
</div>


<div class="top"><input class="uusub2" onclick="history.go(-1)" value="返回" type="button" > </div></div>
<div class="clearFoot noPrint"></div></div></div>
<div id=footerCon>
<div id=foot>
<div id=footNav>
<div>
<div></div></div></div></div></div></BODY></HTML>