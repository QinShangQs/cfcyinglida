<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
if(in_array('jjhybypfpmx_ck',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
$html_title="基金会月报";
include('spap_head.php');
?>
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
        <fieldset style="font-size: large; margin: 20px;">
            <legend>日期：<?php echo date('Y-m-d');?></legend>
            <div class="homePanelmini">
<?php
for($i=1;$i<=4;$i++){
$bbny=date('Y年m月',strtotime("-".$i." month".date('Y-m')));
$bbnyshj=date('Y-m',strtotime("-".$i." month".date('Y-m')));
  if(strtotime($bbnyshj)>=strtotime('2014-04')){
    $sql = "select * from `cfcbbfb` where `fbrq`='".$bbnyshj."' and `fblx`='3'";
    $Query_ID = mysql_query($sql);
    $num = mysql_num_rows($Query_ID);//获取总条数
    if($num>0){
      ?>
      <div><?php echo $bbny;?>:<a href="cfcyuefpexcel.php?ym=<?php echo $i;?>&gg=1">200mg</a> <a href="cfcyuefpexcel.php?ym=<?php echo $i;?>&gg=2">250mg</a></div>
      <?php
    }else{
      if(in_array('jjhybypfpmx_fb',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
      ?>
        <div><a href="cfcbgfbac.php?ym=<?php echo $i;?>&fblx=3">发布<?php echo $bbny;?> </a>预览:<a href="cfcyuefpexcel.php?ym=<?php echo $i;?>&gg=1">200mg</a> <a href="cfcyuefpexcel.php?ym=<?php echo $i;?>&gg=2">250mg</a></div>
      <?php
      }else{
      ?>
        <a><div>尚未发布 <?php echo $bbny;?></div></a>
      <?php
      }
    }
  }
}
?>
            </div>

    </fieldset>
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
<?php
}else{
echo "该账户无权查看请联系项目办！";
}
?>