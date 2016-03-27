<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET["id"];
$html_title="修改不良事件报告";
include('spap_head.php');
?>
		  <?php 
          $blshsql = "select * from `blshj` where id='$id'";
          $blshQuery_ID = mysql_query($blshsql);
          while($blshRecord = mysql_fetch_array($blshQuery_ID)){

      ?>
    <div class="main">
		<div class="insmain">
            
    <div class="thislink">当前位置：
        <a href="blshjgl.php">不良事件报告管理</a>
        > <?php echo $html_title;?></div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
        <form action="blshjxgac.php" method="post">
        <input id="id" name="id" type="hidden" value="<?php echo $id;?>" />
        <div class="top">
            <span class="label" style="width:180px;">该事件信息来源：</span><input <?php if($blshRecord[2]=='0'){echo "checked=\"checked\"";}?> id="shjly" name="shjly" type="radio" value="0" onclick="ly(0)"/><label for="shjly">医生</label> <input <?php if($blshRecord[2]=='1'){echo "checked=\"checked\"";}?> name="shjly" value="1"  type="radio"  onclick="ly(1)"/><label for="shjly">患者</label> <input <?php if($blshRecord[2]=='2'){echo "checked=\"checked\"";}?> name="shjly" value="2"  type="radio"  onclick="ly(2)"/><label for="shjly">患者家属</label></div>
        <div class="top">
            <span class="label" style="width:180px;"><div id='lyysh'></div>医生是否接受随访：<div id='lyhzh' style="display:none;">是否可提供医生联系方式：</div></span><input <?php if($blshRecord[3]=='1'){echo "checked=\"checked\"";}?> name="shfjshhf" type="radio" value="1"/><label for="shfjshhf">是</label> <input <?php if($blshRecord[3]=='0'){echo "checked=\"checked\"";}?> name="shfjshhf" value="0"  type="radio"/><label for="shfjshhf">否</label></div>

        <div class="top">
            <span class="label" style="width:180px;">是否修改医生：</span><input checked="checked" id="xgysh" name="xgysh" type="radio" value="0" onclick="xgyshpd(0)"/><label for="xgysh">否</label> <input name="xgysh" value="1"  type="radio"  onclick="xgyshpd(1)"/><label for="xgysh">是</label> </div>
        <div id='xgyshxz' style="display:none;" class="top">
            <span class="label" style="width:180px;">请选择医生：</span><select id="xgyshid" name="xgyshid" style="width: 250px;">
<?php
          $hzhyshsql = "select * from `hzh` where id='".$blshRecord[1]."'";
          $hzhyshQuery_ID = mysql_query($hzhyshsql);
          while($hzhyshRecord = mysql_fetch_array($hzhyshQuery_ID)){
          $zhdyshid=$hzhyshRecord[9];//echo $zhdyshid;
          }
          $zhdyymchsql = "select * from `yyyshdq` where id='$zhdyshid'";
          $zhdyymchQuery_ID = mysql_query($zhdyymchsql);
          while($zhdyymchRecord = mysql_fetch_array($zhdyymchQuery_ID)){
          $zhdyymch=$zhdyymchRecord[3];//echo $zhdyymch;
          echo "<option value='".$zhdyymchRecord[0]."'>患者指定医生：".$zhdyymchRecord[6]." ".$zhdyymchRecord[7]."</option>";
          }
          $xgzhdyysql = "select * from `yyyshdq` where `id`<>'$zhdyshid' and `yymch`='$zhdyymch'";
          $xgzhdyyQuery_ID = mysql_query($xgzhdyysql);
          while($xgzhdyyRecord = mysql_fetch_array($xgzhdyyQuery_ID)){
          echo "<option value='".$xgzhdyyRecord[0]."'>同医院科室：".$xgzhdyyRecord[6]." ".$xgzhdyyRecord[7]."</option>";//echo $xgzhdyysql;
          }
            ?>
    
</select>
</div>
<script type="text/javascript">
function ly(v){
if(v=='0'){
document.getElementById('lyysh').style.display='block';
document.getElementById('lyhzh').style.display='none';
}else{
document.getElementById('lyhzh').style.display='block';
document.getElementById('lyysh').style.display='none';
}
}
function xgyshpd(v){
if(v=='0'){
document.getElementById('xgyshxz').style.display='none';
}else{
document.getElementById('xgyshxz').style.display='block';
}
}
</script>           
            
        <div class="top">
            <span class="label" style="width:180px;">赛可瑞用量及用法：</span><input class="grd-white" id="skrylyf" name="skrylyf" type="text" value="<?php echo $blshRecord[4];?>" readonly />
</div>
        <div id='fbggnr' class="top">
            <span class="label" style="width:180px;">事件描述：</span><textarea  class="grd-white" id="shjmsh" name="shjmsh" type="textarea"><?php echo $blshRecord[5];?></textarea></div>

        <div class="top">
            <span class="label" style="width:180px;">获知日期：</span><input class="grd-white" id="hzhrq" name="hzhrq" type="text" value="<?php echo $blshRecord[6];?>" readonly /></div>
        <div class="top">
            <span class="label" style="width:180px;">是否继续用药：</span><input <?php if($blshRecord[7]=='1'){echo "checked=\"checked\"";}?> id="shfjxyy" name="shfjxyy" type="radio" value="1" /><label for="shfjxyy">是</label> <input <?php if($blshRecord[7]=='0'){echo "checked=\"checked\"";}?> name="shfjxyy" value="0"  type="radio" /><label for="shfjxyy">否</label> <input <?php if($blshRecord[7]=='2'){echo "checked=\"checked\"";}?> name="shfjxyy" value="2"  type="radio" /><label for="shfjxyy">不详</label></div>
        <div class="top">
            <span class="label" style="width:180px;">报送辉瑞日期：</span><input class="grd-white" id="bghrrq" name="bghrrq" type="text" value="<?php echo $blshRecord[8];?>" readonly /></div>
        <div class="top">
            <span class="label" style="width:180px;">CFC填表人：</span><input class="grd-white" id="cfctbr" name="cfctbr" type="text" value="<?php echo $blshRecord[9];?>" readonly /></div>
      <?php
          }
      ?>
        <div class="top">
            <input id="btnSave" type="submit" value="保存" class="uusub" />
            <input id="btnReturn" type="button" value="返回" class="uusub2" /></div>
        </form>
    </div>
    <script type="text/javascript" src="js/Buliangshijianbaogao.js"></script>
    <script type="text/javascript">
        $(function () {
            chooseDate('hzhrq', true);
            chooseDate('bghrrq', true);

            //返回按钮
            $("#btnReturn").bind("click", function () {
                var returnUrl = '';
                if (returnUrl == "") {
                    history.go(-1);
                }
                else {
                    location.href = returnUrl;
                }
            });

        });
    </script>

            
        </div>
    </div>
   
</body>
</html>
