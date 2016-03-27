<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yfid = $_GET['id'];
$html_title="药房药师详细";
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
<?php        
  $sql = "select * from `yf` where `id`='".$yfid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
<div class="insinsins" style="width: 100%">
<label>药房名称：</label><span><?php echo $Record[1];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>药房所在城市：</label><span><?php echo $Record[10];?><?php echo $Record[14];?><?php echo $Record[16];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>药房地址：</label><span><?php echo $Record[2];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>联系方式(座机)：</label><span><?php echo $Record[3];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>联系方式(移动)：</label><span><?php echo $Record[4];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>联系方式(传真)：</label><span><?php echo $Record[5];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>联系方式(email)：</label><span><?php echo $Record[6];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>库容：</label><span><?php echo $Record[9];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定药师：</label><span><?php echo $Record[11];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定药师用户名：</label><span><?php echo $Record[13];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定药师性别：</label><span><?php echo $Record[21];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>指定药师样张：</label><span><?php echo $Record[18];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权药师：</label><span><?php echo $Record[19];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权药师样张：</label><span><?php echo $Record[20];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>授权药师电话：</label><span><?php echo $Record[22];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>培训班：</label><span><?php echo $Record[23];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>培训日期：</label><span><?php echo $Record[24];?></span>
</div>
<div class="insinsins" style="width: 100%">
<label>状态：</label><span><?php if($Record[7]=='1'){echo "启用";}?><?php if($Record[7]=='0'){echo "停用";}?></span>
</div>

                <div class="insinsins" style="width:100%;">
<span><input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></span>
                </div>                 
<?php
  }
?>
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