<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增空瓶交回";
include('spap_head.php');
?>
   <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
        <form action="kpyyhshxzac.php" method="post" onsubmit="return check();">

        <fieldset class="top">
            <legend>患者</legend>

<?php
  $yhid = $_GET['id'];
  $sql = "select * from `hzh` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $hzhzhjlxhm=$Record[5].":".$Record[6];
?>
        <input id="id" name="id" type="hidden" value="<?php echo $yhid;?>" />
            <div>
                <span class="label">患者姓名：</span><?php echo $Record[4];?>
                <span class="label">性别：</span><?php echo $Record[37];?>
                <span class="label">年龄：</span><?php 
                //计算年龄
function birthday($mydate){
    $birth=$mydate;
    list($by,$bm,$bd)=explode('-',$birth);
    $cm=date('n');
    $cd=date('j');
    $age=date('Y')-$by-1;
    if ($cm>$bm || $cm==$bm && $cd>$bd) $age++;
    if($age<='0'){$age="0";}
    return $age."岁";
//echo "生日:$birth\n年龄:$age\n";
}
echo birthday($Record[38]);
//echo birthday("2012-2-29");
                
                ?>
                <span class="label">病种：</span><?php echo $Record[7];?>
            </div>
            <div class="top">
                <span class="label">通讯住址：</span><label id="zhuzhiView">
</label>
<script type="text/javascript">
    DiquXuanzeqi.View("zhuzhiView", '', '', '', '<?php echo $Record[14];?>');
</script>

            </div>
<?php
}
?>
        </fieldset>
        <fieldset class="top">
            <legend>交回空药瓶、剩余药物</legend>
            <div class="top">
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
                <td width="17%"  align="center" bgcolor="#FFFFFF">
                    交回空药瓶数量</td>
                <td width="16%" align="center" bgcolor="#FFFFFF">
                    交回剩余药量</td>
                <td width="9%" align="center" bgcolor="#FFFFFF">
                    交回人</td>
                <td width="8%" align="center" bgcolor="#FFFFFF">
                    关系</td>
                <td width="20%" align="center" bgcolor="#FFFFFF">
                    证件号</td>
            </tr>
            <tr style="color:#1f4248; font-size:12px;">
<td width="17%"  align="center" bgcolor="#FFFFFF">
  <input name="kpshl" class="grd-white" style="width:30px;" id='kpshl1'  value="0" />&nbsp;瓶
</td>
<td width="16%" align="center" bgcolor="#FFFFFF">
  <input name="yyshl" class="grd-white" style="width:30px;" id='yyshl1' value="0"  />&nbsp;粒
</td>
<td width="9%" align="center" bgcolor="#FFFFFF">
<label>
<select id="selectzhxqsh" class="grd-white2" name="selectzhxqsh" style="width:60px;">
<option value="0">本人</option>
<?php
  $zhxqshsql = "select * from `zhxqsh` where `hzhid`='$hzhid'";

  $zhxqshQuery_ID = mysql_query($zhxqshsql);
  while($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)){
?>
<option value="<?php echo $zhxqshRecord['0'];?>"><?php echo $zhxqshRecord['2'];?></option>
<?php
}
?>
</select>
</label>
</td>
<td width="8%" align="center" bgcolor="#FFFFFF" id="zhxqshgx" name="zhxqshgx">本人</td>
<td width="20%" align="center" bgcolor="#FFFFFF" id="zhxqshzhj" name="zhxqshzhj"><?php echo $hzhzhjlxhm;?></td>
</tr>
</table >
            </div>
<div class="top"><span class="label">交回日期：</span><input class="grd-white" id="yyjhrq" name="yyjhrq" type="text" value="<?php echo date('Y-m-d');?>" /></div>
        </fieldset>

        <div class="top">
            <input type="submit" value="保存" class="uusub" /></div>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            chooseDate('yyjhrq', false);
                  //post()方式  
          $('#selectzhxqsh').click(function (){ 
          if($(this).val()!="0"){
                $.post(  
                    'yshfyzhxqshac.php',  
                    {
                        id:$(this).val(),
                        hzhid:$('input[name="id"]').val(),
                        cq:'1'
                    },  
                    function (data) { //回调函数  
                        $('#zhxqshgx').html(data);
                    }  
                ); 
                 $.post(  
                    'yshfyzhxqshac.php',  
                    {
                        id:$(this).val(),
                        hzhid:$('input[name="id"]').val(),
                        cq:'2'
                    },  
                    function (data) { //回调函数  
                        $('#zhxqshzhj').html(data);
                    }  
                );
          }
          else{
            $('#zhxqshgx').html("本人");
            $('#zhxqshzhj').html("<?php echo $hzhzhjlxhm;?>");
          }
          });
        });

        function check(){
			var kpshl1 = $.trim($("#kpshl1").val());
			
			if(isNaN(kpshl1)){
				alert('请正确填写空药瓶数量！');
				return false;
			}
try	{

	kpshl1 = parseInt(kpshl1);
	if(kpshl1 <= 0){
		alert('空药瓶数量至少为1！');
		return false;
	}
}catch(e){
	console.log(e);
}
			return true;
        }
    </script>

            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</html>
