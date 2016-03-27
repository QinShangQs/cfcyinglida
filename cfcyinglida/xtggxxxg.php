<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$html_title="修改系统公告";
include('spap_head.php');
?>
   <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div> 
			<div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
    <div class="top">
        <form action="xtggxxxgac.php" method="post">
<?php        
  $sql = "select * from `xtggxx` where `id`='".$id."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <div class="top">
            <span class="label">发布公告/盘点：</span><input <?php if($Record[6]==0){?>checked="checked"<?php }?> id="tshgn" name="tshgn" type="radio" value="0" onclick="fbgg(0)"/><label for="tshgn">公告</label> <input <?php if($Record[6]==1){?>checked="checked"<?php }?> name="tshgn" value="1"  type="radio"  onclick="fbgg(1)"/><label for="tshgn">盘点</label></div>
        <div class="top">
            <span class="label">公告标题：</span><input class="grd-white" id="ggbt" name="ggbt" type="text" value="<?php echo $Record[1];?>" />
</div><?php
if($Record[6]==0){
?>
        <div id='fbggnr' class="top">
            <span class="label">公告内容：</span><textarea  class="grd-white" id="fbggnr" name="ggnr" type="textarea"  ><?php echo $Record[2];?></textarea></div>
<?php }if($Record[6]==1){?>
        <div id='fbpdnr' style="display:none;" class="top">
            <span class="label">盘点内容：</span><input <?php if($Record[2]==0){?>checked="checked"<?php }?> id="fbpdnr1" name="ggnr" type="radio" value="0"/><label for="tshgn">上月</label> <input <?php if($Record[2]==1){?>checked="checked"<?php }?> id="fbpdnr2" name="ggnr" value="1"  type="radio"/><label for="tshgn">本月</label></div>
<?php }?>
        <div class="top">
            <span class="label">公告日期：</span><input class="grd-white" id="ggrq" name="ggrq" type="text" value="<?php echo $Record[4];?>" /></div>
        <div class="top">
            <span class="label">公告是否生效：</span><input <?php if($Record[5]==1){?>checked="checked"<?php }?> id="ggzht" name="ggzht" type="radio" value="1" /><label for="ggzht">启用</label> <input <?php if($Record[5]==0){?>checked="checked"<?php }?> name="ggzht" value="0"  type="radio" /><label for="ggzht">停用</label></div>
<div class="top">
            <span class="label">针对权限：</span><input id="yfysh" name="yfysh" type="checkbox" value="3" readonly <?php if(in_array(3,explode(',',$Record[3]))){echo "checked=true";}?>/>药房药师<input id="ysh" name="ysh" type="checkbox" value="4" readonly <?php if(in_array(4,explode(',',$Record[3]))){echo "checked=true";}?>/>医生<input id="mxyh" name="xgy" type="checkbox" value="5" readonly <?php if(in_array(5,explode(',',$Record[3]))){echo "checked=true";}?>/>协管员</div>
        <div class="top">
            <span class="label">发起人：</span><input class="grd-white" id="fqr" name="fqr" type="text" value="<?php echo $_SESSION[yhname];?>" readonly /></div>
<?php        
  }
?>
        <div class="top">
            <input type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
        </form>
    </div>

            
        </div>
    </div>
</body>
</html>
