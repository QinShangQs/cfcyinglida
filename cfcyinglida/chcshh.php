<?php

session_start ();
@header ( 'Content-type: text/html;charset=utf-8' );
include ('newdb.php');
$hzhid = $_GET ['id'];
$html_title = "新增审核记录";
include ('spap_head.php');
?>
<div class="main">
	<div class="insmain">
		<div class="thislink">
			当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?> </div>
		<!--A href="shqxq.php?id=<?php echo $hzhid;?>">申请详细信息</A-->
		<div class="inwrap flt top">
			<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong></span>
			</div>
			<div class="incontact w955 flt">

				<form method=post action="chcshhac.php" id="tjbd">
					<input id="id" value="<?php echo $hzhid;?>" type="hidden" name="id">
					<input id="bcclshdrq" value="" type="hidden" name="bcclshdrq">
					<div>


						<FIELDSET class="top">
							<LEGEND>材料符合情况</LEGEND>

							<TABLE id=ChuciShenqingtb_cailiaofuhes width="100%" border="0"
								cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
								<TBODY>
									<TR style="color: #1f4248; font-weight: bold; height: 30px;">
										<Td style="WIDTH: 450px" align="center" bgcolor="#FFFFFF">材料类别</Td>
										<Td style="WIDTH: 30px" align="center" bgcolor="#FFFFFF">收到</Td>
										<Td style="WIDTH: 65px" align="center" bgcolor="#FFFFFF">收到日期</Td>
										<Td style="WIDTH: 30px" align="center" bgcolor="#FFFFFF">有效</Td>
										<Td style="WIDTH: 65px" align="center" bgcolor="#FFFFFF">审核日期</Td>
										<Td style="WIDTH: 80px" align="center" bgcolor="#FFFFFF">审核人</Td>
										<Td align="center" bgcolor="#FFFFFF">无效说明</Td>
									</TR>
<?php 
/*
					       * $jzhlxsql = "select jzhlx from `hzh` where `id`=".$hzhid;
					       *
					       * $jzhlxQuery_ID = mysql_query($jzhlxsql);
					       * while($jzhlxRecord = mysql_fetch_array($jzhlxQuery_ID)){
					       * $jzhlx= $jzhlxRecord[0];
					       * }
					       *
					       *
					       * $clmchsql = "select id,nr from `clshhmch` order by id ASC";
					       *
					       * $clmchQuery_ID = mysql_query($clmchsql);
					       * while($clmchRecord = mysql_fetch_array($clmchQuery_ID)){
					       * if($clmchRecord[0]=="11"&&$jzhlx=="全部"){}
					       * else{
					       * if($clmchRecord[0]=="13"&&$jzhlx=="部分"){}
					       * else{
					       * ?>
					       * <tr>
					       * <td class="top"><SPaN id="mchid"><?php echo $clmchRecord[1];;?><input type="hidden" name="mch<?php echo $clmchRecord[0];?>" id="mch<?php echo $clmchRecord[0];?>" value="<?php echo $clmchRecord[0];?>"></SPaN></td>
					       * <td class="top center"><input type="checkbox" onchange="rqxz(<?php echo $clmchRecord[0];?>)" name="shd<?php echo $clmchRecord[0];?>" value="1" ></td>
					       * <td class="top"><input style="WIDth: 62px" value="<?php echo date('Y-m-d');?>" type="text" id="shdrq<?php echo $clmchRecord[0];?>" name="shdrq<?php echo $clmchRecord[0];?>"></td>
					       * <td class="top center"><input type="checkbox" onchange="rqxzz(<?php echo $clmchRecord[0];?>)" name="shfyx<?php echo $clmchRecord[0];?>" value="1" ></td>
					       * <td class="top"><input style="WIDth: 62px" value="<?php echo date('Y-m-d');?>" type="text" id="shhrq<?php echo $clmchRecord[0];?>" name="shhrq<?php echo $clmchRecord[0];?>"></td>
					       * <td class="top center"><a title=点击查看审核人 href="javascript:void();"><?php echo "当前用户";?></a> </td>
					       * <td class="top"><TEXTaREa style="WIDth: 100%" rows="2" cols="20" id="bzh<?php echo $clmchRecord[0];?>" name="bzh<?php echo $clmchRecord[0];?>"></TEXTaREa>
					       * </td>
					       * </tr>
					       * <?php
					       * }
					       * }
					       * }
					       */
?>
<?php
// 查询当前患者的领药数量

// $hzhly = "select * from `zyff` where `tshqk`='0' AND `hzhid`='".$hzhid."' order by id desc";
$hzhly = "select `hzhxm` , `yxyaoname`, `shqbzh`, `chiguonum` from `hzh` WHERE `id`='" . $hzhid . "'";
$hzhlyResult = mysql_query ( $hzhly );
$result = mysql_fetch_row ( $hzhlyResult );

// 查询当前患者的医学条件评估
$yxtjpg = "select * from yxtjpg_new WHERE `hzhid`='" . $hzhid . "' order by id desc";
$yxtjpgResult = mysql_query ( $yxtjpg );
$yxtjpgData = mysql_fetch_row ( $yxtjpgResult );

$hzhsql = "select shqbzh,jzhlx,hzhxm,erqshq from `hzh` where `id`='" . $hzhid . "'";
$hzhQuery_ID = mysql_query ( $hzhsql );
while ( $hzhRecord = mysql_fetch_array ( $hzhQuery_ID ) ) {
	$hzhshqbzh = $hzhRecord [0];
	$hzhjzhlx = $hzhRecord [1];
	$hzhxm = $hzhRecord [2];
	$hzherqshq = $hzhRecord [3];
}

$sql = "select * from `clshh` where `hzhid`='" . $hzhid . "'";
$Query_ID = mysql_query ( $sql );
while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
	$mchid = $Record [1];
	$shfshd = $Record [2];
	$shdrq = $Record [3];
	$shfyx = $Record [4];
	$shhrq = $Record [5];
	$shqbzh = $Record [6];
	$shhr = $Record [7];
	$shhyj = $Record [8];
	$wtgyy = $Record [9];
	$bzhshm = $Record [10];
}
$mchid1 = explode ( ",", $mchid );
$shfshd1 = explode ( ",", $shfshd );
$shdrq1 = explode ( ",", $shdrq );
$shfyx1 = explode ( ",", $shfyx );
$shhrq1 = explode ( ",", $shhrq );
$shqbzh1 = explode ( ",", $shqbzh );
$shhr1 = explode ( ",", $shhr );


$clmchsql = "select id,nr from `clshhmch` order by id ASC";

$clmchQuery_ID = mysql_query ( $clmchsql );
while ( $clmchRecord = mysql_fetch_array ( $clmchQuery_ID ) ) {
	if ($hzherqshq != "2") {
		
		// 进入索坦项目的患者、未进入索坦项目但吃过8瓶的患者
		if ($result [3] == 8) {
			if ($clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未吃过索坦的患者
		if ($result [3] == 0 || ! isset ( $result [3] )) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过2瓶的患者
		if ($result [3] == 2) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过3瓶或4瓶的患者
		if ($result [3] == 3 || $result [3] == 4) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过5瓶的患者
		if ($result [3] == 5) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过6瓶或7瓶的患者
		if ($result [3] == 6 || $result [3] == 7) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过9瓶或10瓶的患者
		if ($result [3] == 9 || $result [3] == 10) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 9 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过11瓶的患者
		if ($result [3] == 11) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 10) {
				continue;
			}
		}
		// 未进入索坦项目但吃过12瓶的患者
		if ($result [3] == 12) {
			if ($clmchRecord [0] == 2 || $clmchRecord [0] == 3 || $clmchRecord [0] == 4 || $clmchRecord [0] == 5 || $clmchRecord [0] == 6 || $clmchRecord [0] == 7 || $clmchRecord [0] == 8 || $clmchRecord [0] == 9) {
				continue;
			}
		}
		
		if ($yxtjpgData [4] != "不能耐受") {
			if ($clmchRecord [0] == 22) {
				continue;
			}
		}
		
		?>
       <tr>
										<td class="top" align="center" bgcolor="#FFFFFF"><SPaN
											id="mchid"><?php echo $clmchRecord[1];?>
                <input type="hidden"
												name="mch<?php echo $clmchRecord[0];?>"
												id="mch<?php echo $clmchRecord[0];?>"
												value="<?php echo $clmchRecord[0];?>"> <input type="hidden"
												name="mchnr<?php echo $clmchRecord[0];?>"
												id="mchnr<?php echo $clmchRecord[0];?>"
												value="<?php echo $clmchRecord[1];?>"> </SPaN>
            <?php
		
if ($clmchRecord [1] == '索坦发票原件（8瓶）' || $clmchRecord [1] == '索坦发票原件（4瓶）' || $clmchRecord [1] == '索坦发票原件（12瓶）') {
			echo "<span>输入发票号码：<input type=\"text\" name=\"fphm\" id=\"fapiaohaoma\" class=\"grd-white\" value=\"\" onblur=\"yzhfphm();\"></span><span id=\"yahjg\"></span>";
		}
		?>
            <input type="hidden" name="hzhxm" id="hzhxm"
											value="<?php echo $hzhxm;?>"></td>
										<td class="top center" bgcolor="#FFFFFF"><input
											type="checkbox"
											onchange="rqxz(<?php echo $clmchRecord[0];?>)"
											id="shd<?php echo $clmchRecord[0];?>"
											name="shd<?php echo $clmchRecord[0];?>" value="1"
											<?php if($shfshd1[$clmchRecord[0]-1]=='1'){echo "checked";}?>></td>
										<td class="top" style="font-size: 11px;" bgcolor="#FFFFFF"><input
											style="WIDth: 62px"
											value="<?php if($shdrq1[$clmchRecord[0]-1]!=""){echo $shdrq1[$clmchRecord[0]-1];}?>"
											type="text" onblur="rqxzshz(<?php echo $clmchRecord[0];?>)"
											id="shdrq<?php echo $clmchRecord[0];?>"
											name="shdrq<?php echo $clmchRecord[0];?>" readonly></td>
										<td class="top center" bgcolor="#FFFFFF"><input
											type="checkbox"
											onchange="rqxzz(<?php echo $clmchRecord[0];?>)"
											id="shfyx<?php echo $clmchRecord[0];?>"
											name="shfyx<?php echo $clmchRecord[0];?>" value="1"
											<?php if($shfyx1[$clmchRecord[0]-1]=='1'){echo "checked";}?>></td>
										<td class="top" style="font-size: 11px;" bgcolor="#FFFFFF"><input
											style="WIDth: 62px"
											value="<?php if($shhrq1[$clmchRecord[0]-1]!=""){echo $shhrq1[$clmchRecord[0]-1];}?>"
											type="text" id="shhrq<?php echo $clmchRecord[0];?>"
											name="shhrq<?php echo $clmchRecord[0];?>" readonly /></td>
										<td class="top center" bgcolor="#FFFFFF"><input
											style="WIDth: 62px"
											value="<?php if($shhr1[$clmchRecord[0]-1]!=""){echo $shhr1[$clmchRecord[0]-1];}?>"
											type="text" id="shhr<?php echo $clmchRecord[0];?>"
											name="shhr<?php echo $clmchRecord[0];?>" readonly /></td>
										<td class="top center" bgcolor="#FFFFFF"><TEXTaREa
												style="WIDth: 100%" rows="2" cols="20"
												id="bzh<?php echo $clmchRecord[0];?>"
												name="bzh<?php echo $clmchRecord[0];?>"><?php echo $shqbzh1[$clmchRecord[0]-1];?></TEXTaREa>
										</td>
									</tr>
  <?php
	}
}
?>


</TBODY>
							</TABLE>

						</FIELDSET>

					</div>
<?php
if ($shhxcl == "1") {
	?>
<div>
						<SPAN class="label top">申诉新材料说明：</SPAN>
						<TEXTAREA style="WIDTH: 600px; HEIGHT: 82px" class="textarea"
							rows="2" cols="20" name="shscl"></TEXTAREA>
					</div>
<?php
}
?>

<div>
						<SPAN class=label>审核意见：</SPAN> <input value="0" type="radio"
							name="shhyj" id="shhyj1" onclick="showText(0)" /><LABEL
							for="shhyj1">补寄材料</LABEL> <input value="1" type="radio"
							name="shhyj" id="shhyj2" onclick="showText(1)" /><LABEL
							for="shhyj2">材料齐全</LABEL>
						<script type="text/javascript">
<?php
if ($hzherqshq != "2") {
	echo "var shqclzsh=  $('#ChuciShenqingtb_cailiaofuhes tr').length -1;";
} else {
	// 重新入组
	// pNET RCC GIST 正常需要6份材料 RCC 1+1+1(3次以上)
	if (($hzhshqbzh == 'GIST' || $hzhshqbzh == 'pNET' || $hzhshqbzh == 'RCC') && ($hzhjzhlx == '全部' || $hzhjzhlx == '部分' || $hzhjzhlx == '原部分')) {
		echo "var shqclzsh=6;";
	} 	// RCC 1+1+1(3次以下) 需要7份材料
	else if ($hzhshqbzh == 'RCC' && $hzhjzhlx == '1+1+1') {
		echo "var shqclzsh=7;";
	} else {
		echo "var shqclzsh=6;";
	}
}
?>

$("input[type=checkbox]").bind("click", function () {
var ict=0;
for(i = 1; i <= 24; i++)
{
try{
    if($("#shd"+i).attr("checked")){
      if($("#shfyx"+i).attr("checked")){
            ict++;
      }
    }
  } catch (e) {}
}

if(ict<shqclzsh){
    document.getElementById("shhyj2").checked = false;
}
            });


function showText(v){

var wshdnr="";
var wtgnr="";
var ic=0; //ic 是有效数量
for(i=1;i<=24;i++)
{
try{
    if(document.getElementById("shd"+i).checked){
      if(document.getElementById("shfyx"+i).checked){
            ic++;
      }
    }
  } catch (e) {}
}

if(v=='0'){
  if(ic<shqclzsh){
  document.getElementById('wtgdiv').style.display='block';
  for(i=1;i<=24;i++)
  {
  try{
      if(document.getElementById("shd"+i).checked){
        if(document.getElementById("shfyx"+i).checked){
        }else {
        wtgnr=wtgnr+$('#mchnr'+i).val()+"："+$('#bzh'+i).val()+"\r\n";
        }
      }else{
        wshdnr=wshdnr+"未收到："+$('#mchnr'+i).val()+"\r\n";

      }
    } catch (e) {}
  }
  $('#wtgyy').val(wshdnr+wtgnr);

  }else{alert("材料已齐全继续补寄材料？");}
}else if(v=='1'){
//ic有效数量 shqclzsh总共选项的数量
if(ic<shqclzsh){
        document.getElementById("shhyj2").checked = false;
        alert("材料不齐全或者存在无效。");
}else{
  $('#wtgyy').val('');
  document.getElementById('wtgdiv').style.display='none';
}
}
}
//验证发票是否有效
function yzhfphm(){
  var hzhxingming = document.getElementById('hzhxm').value;
  var fphm = document.getElementById('fapiaohaoma').value;
  if(fphm==''){
    alert('您未输入发票号码，请检查！！');
    return false;
  }
   $.get('yzhfp.php',{'fphm':fphm,'xm':hzhxingming},function(data){
            $("#yahjg").html(data);
          });
}
</script>
					</div>

					<div id="wtgdiv" style="display: none;">

						<div style="width: 980px; float: left">
							<div class="label top" style="float: left; width: 85px;">未通过原因:</div>
							<div style="width: 700px; float: left;">
								<ul>
									<li><textarea rows="10" cols="80" id="wtgyy" name="wtgyy"
											readonly></textarea></li>
								</ul>
							</div>
						</div>
					</div>
					<div>
						<SPAN class="label top">备注：</SPAN>
						<TEXTAREA style="WIDTH: 600px; HEIGHT: 82px" class="textarea"
							rows="2" cols="20" name="bzhshm"></TEXTAREA>
					</div>
					<div class="top">
						是否需要发送短信：<input type="radio" id="xyfsdx" name="fsdx" value="">是 <input
							type="radio" name="fsdx" id="bxyfsdx" value="">否 <span
							style="color: red">*(需要发送短信请点击是，不需要发送短信则不要点击)</span>
					</div>
					<div class="top">
						<input id="submitBtn" type="submit" value="保存" class="uusub" /> <input
							type="button"
							onclick="javascript:{location.href='shqxq.php?id=<?php echo $hzhid;?>'}"
							value="返回" class="uusub2" />
					</div>
				</form>
			</div>


			<style>
.mindess {
	width: 666px;
	font-size: 12px;
	height: auto;
	position: fixed;
	z-index: 100;
	left: 25%;
	/*margin:0 auto 0 -343px; /* margin-left需要是宽度的一半 */
	top: 30%;
	padding: 18px 1px 1px 1px;
	background: #25679c;
	border: 1px #25679c solid;
}
</style>
			<div class="clearFoot noPrint"></div>
		</div>
	</div>
	<div class="mindess" id="qrfsdx"
		style="display: none; border: 0px solid #FFFFFF; clear: both;">
		<div style="position: absolute; right: 15px; top: 5px;">
			<a style="color: #FFFFFF; cursor: pointer;" onclick="qrfsdx(0)">关闭</a>
		</div>
		<fieldset
			style="background: #ffffff; margin-bottom: 2px; border: 0; margin-top: -5px;">
			<legend style="background: #ffffff; border: 0; padding: 5px;">发送短信</legend>
			<form action="http://115.28.90.3:8080/zz/send.htm" method="post"
				name="">
				发送给：<select name="phone" id="xzdhhmid">
            <?php
												$lxfsbr_sql = "select `hzhshj` from `hzh` where `id`='$hzhid'";
												$lxfsbr_query = mysql_query ( $lxfsbr_sql );
												$lxfszxqsh_sql = "select * from `zhxqsh` where `id`='$hzhid'";
												$lxfszxqsh_query = mysql_query ( $lxfszxqsh_sql );
												
												while ( $lxfsbr_record = mysql_fetch_array ( $lxfsbr_query ) ) {
													while ( $lxfszxqsh_record = mysql_fetch_array ( $lxfszxqsh_query ) ) {
														?>
                      <option value="<?php echo $lxfsbr_record[0];?>">本人：<?php echo $lxfsbr_record[0];?></option>
					<option value="<?php echo $lxfszxqsh_record[6];?>"><?php echo $lxfszxqsh_record[4];?><?php echo $lxfszxqsh_record[2];?>：<?php echo $lxfszxqsh_record[6];?></option>
            <?php
													}
												}
												?>
                    </select><br> 内&nbsp;&nbsp;容：
				<textarea name="content" style="width: 90%; height: 65px;"
					id="fsdxid" value=""></textarea>
				<div class="top">
					<input type="submit" name="submitdxfs" value="发送短信" class="uusub">
				</div>
			</form>
		</fieldset>
	</div>


	<script language="javascript">
$("#xyfsdx").click(function(){
  var wtgyuanyin=$("#wtgyy").val();
  document.getElementById('qrfsdx').style.display='block';
  $('#fsdxid').val(wtgyuanyin);
  //var jiewei='索坦项目办';
  //$('#fsdxid').append(jiewei);
});
 function qrfsdx(v){
    if(v==0){
      document.getElementById('qrfsdx').style.display='none';
    }
  }
  $("#bxyfsdx").click(function(){
    document.getElementById('qrfsdx').style.display='none';
  });
</script>
	<script language="javascript">
var dycshzrq=0;
function changewtg(){
	$("#wtgdiv").val('').hide();
	$("input[name='shhyj']").attr('checked',false);
}
function rqxz(v){
	changewtg();
	
	
$("#shhr"+v).val('<?php echo $_SESSION[yhname];?>');
if(dycshzrq!=0){
if(document.getElementById('shdrq'+dycshzrq).value!=""){
document.getElementById('shdrq'+v).value=document.getElementById('shdrq'+dycshzrq).value;}
else {dycshzrq=0;}
}else{
if(document.getElementById('shdrq'+v).value==""){
//alert("请填写日期！");
document.getElementById('shdrq'+v).focus();
}
}
$("#shhrq"+v).val('<?php echo date('Y-m-d');?>');
document.getElementById("shfyx"+v).disabled = false;
        if(!document.getElementById("shd"+v).checked){
        document.getElementById("shfyx"+v).checked = false;
        document.getElementById("shfyx"+v).disabled = true;
        $("#bzh"+v).val('');
        document.getElementById("bzh"+v).disabled = true;
        }else{
        $("#bzh"+v).val('');
        document.getElementById("bzh"+v).disabled = false;
        }
}
function rqxzshz(v){
/*jltx=0;
if(document.getElementById("shd"+v).checked&&document.getElementById('shdrq'+v).value==""){
  if(jltx!=0){alert("请填写日期!");}
  alert(jltx)
document.getElementById('shdrq'+v).focus();

  jltx++;
  return false;
}else{return true;} */
if(dycshzrq==0){
dycshzrq=v;
//alert(dycshzrq);
}
}
function rqxzshzyx(v){
/*
if(document.getElementById("shd"+v).checked&&document.getElementById('shdrq'+v).value==""){
  alert("请填写日期!");
document.getElementById('shdrq'+v).focus();
  return false;
}else{return true;} */
$("#shhr"+v).val('<?php echo $_SESSION[yhname];?>');

if(dycshzrq==0){
dycshzrq=v;
//alert(dycshzrq);
}
$("#shhrq"+v).val('<?php echo date('Y-m-d');?>');
}
function rqxzz(v){
	changewtg();
$("#shhr"+v).val('<?php echo $_SESSION[yhname];?>');
//document.getElementById('shhrq'+v).value=document.getElementById('shhrq1').value;
$("#shhrq"+v).val('<?php echo date('Y-m-d');?>');
if(document.getElementById("shfyx"+v).checked){
$("#bzh"+v).val('');
document.getElementById("bzh"+v).disabled = true;
}else{
$("#bzh"+v).val('');
document.getElementById("bzh"+v).disabled = false;
}
}
    $(document).ready(function(){
      for(i=1;i<=50;i++){
        chooseDateNow('shdrq'+i, true);
      }
      for(i=1;i<=50;i++){

        try{
          if(!document.getElementById("shd"+i).checked){
          document.getElementById("shfyx"+i).disabled = true;
          $("#bzh"+i).val('');
          document.getElementById("bzh"+i).disabled = true;
          }
          if(document.getElementById("shfyx"+i).checked){
          $("#bzh"+i).val('');
          document.getElementById("bzh"+i).disabled = true;
          }
        } catch (e) {}

      }
    });
        function SubmitCheck() {

          if($("#shhyj1").attr("checked")||$("#shhyj2").attr("checked")){
            if(dycshzrq!=0){//alert("得到");
            var bcclshdrq=document.getElementById('shdrq'+dycshzrq).value;
              if(bcclshdrq!=""){
                $("#bcclshdrq").val(bcclshdrq);
                //alert("获取"+$("#bcclshdrq").val());
                //alert("得到"+bcclshdrq+"a");

                return true;
              }
              else {return true;}
            }else{ return true;}
          }else{
            alert("请选择审核意见！");
            return false;
          }

        }

        //页面加载后
        $(function () {
            //绑定提交验证
            $("input:submit").unbind("click");
            $("#submitBtn").bind("click", function () {
                if (SubmitCheck() && confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("#tjbd").submit();
                    return false;
                }
                return false;
            });
            $("input:submit").attr("disabled", false);
        });

</script>

	<div id=footerCon>
		<div id=foot>
			<div id=footNav>
				<div>
					<div></div>
				</div>
			</div>
		</div>
	</div>
</div>
</BODY>
</HTML>