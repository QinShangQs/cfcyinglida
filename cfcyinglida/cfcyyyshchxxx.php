<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yyid = $_GET['id'];
$html_title="医院医生详细";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="cfcyyyshchx.php">医院医生查询</a>
        > <?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
              
<?php        
  $sql = "select * from `yyyshdq` where `id`='".$yyid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
<div class="insinsins" style="width: 100%">
<label>医院名称：</label><span><?php echo $Record[3];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医院所在城市：</label><span><?php echo $Record[1].$Record[24];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医院地址：</label><span><?php echo $Record[20];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医院科室：</label><span><?php echo $Record[5];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定医生：</label><span><?php echo $Record[6];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医生联系方式：</label><span><?php echo $Record[7];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定医生样张：</label><span><img src="qzyzh/<?php echo sprintf("%03d", $Record[8]);?>-1.jpg" width="105" height="45"/> <img src="qzyzh/<?php echo sprintf("%03d", $Record[8]);?>-2.jpg" width="105" height="45"/></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权一医生：</label><span><?php echo $Record[9];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权一医生样张：</label><span><?php 
if($Record[9]!=""){
?>
<img src="qzyzh/<?php echo sprintf("%03d", $Record[8]);?>-3.jpg" width="105" height="45"/>
<?php
}
?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权一联系方式：</label><span><?php echo $Record[11];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权二医生：</label><span><?php echo $Record[12];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权二医生样张：</label><span><?php 
if($Record[12]!=""){ 
?>
<img src="qzyzh/<?php echo sprintf("%03d", $Record[8]);?>-4.jpg" width="105" height="45"/>
<?php
}
?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权二联系方式：</label><span><?php echo $Record[14];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权三医生：</label><span><?php echo $Record[15];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权三医生样张：</label><span><?php 
if($Record[14]!=""){ 
?>
<img src="qzyzh/<?php echo sprintf("%03d", $Record[8]);?>-5.jpg" width="105" height="45"/>
<?php
}
?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权三联系方式：</label><span><?php echo $Record[17];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医生培训期数：</label><span><?php echo $Record[18];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医生培训日期：</label><span><?php echo $Record[19];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医生是否生效：</label><span><?php if($Record[21]=='1'){echo "是";}else {echo "否";}?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>医院指定药房：</label><span><?php echo $Record[22];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>是否接收AE回访：</label><span><?php if($Record[23]=='1'){echo "是";}else {echo "否";}?></span>
</div>

                <div class="insinsins" style="width:100%;">
<span><input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></span>
                </div>
              </td>
            </tr>
          </table>                  
<?php
  }
?>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>