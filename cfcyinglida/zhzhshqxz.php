<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增转诊申请";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></div>
			<div class="inwrap flt top">
            <style>
                .mindess {
                    width:966px;
                    font-size:12px;
                    height:auto;
                    position:fixed;
                    z-index:100;
                    left:50%;
                    margin:0 auto 0 -494px; /* margin-left需要是宽度的一半 */
                    top:35%;
                    padding:0px;
                    background:#25679c;
                    border:1px #25679c solid;
                }
            </style>
            <div class="mindess" id="qzyzh" style="width:325px;  padding-top:5px; margin:0 auto 0 -181px; display:none;">
                <div style="position:absolute; right:15px;	background:#25679c;"><a style="color:#ffffff; cursor:pointer;" onclick="lyyfnr(0)">关闭</a></div>
                <table style="margin-top:30px;" width="100%" border="1" cellpadding="10" cellspacing="1">
                    <tr>
                        <td width="30%" bgcolor="#FFFFFF" align="center">指定医生<br/><span id='zhdyshxsh'></span></td>
                        <td width="70%" bgcolor="#FFFFFF" align="center">
                            <img id="zhdyshyzh" width="100"/>
                            <img id="zhdyshqzh" width="100"/></td>
                    </tr>

                    <tr id="qzyzhshq" style="display:none;">
                        <td width="30%"  bgcolor="#FFFFFF" align="center">授权医生<br/><span id='shqyshxsh'></span></td>
                        <td width="70%"  bgcolor="#FFFFFF" align="center"><div id="qzyzhshqysh"></div></td>
                    </tr>
                </table>
            </div>

            <div class="title w977 flt">
				<strong><?php echo $html_title;?></strong></span>
				</div>
				<div class="incontact w955 flt">
    <div class="form">
        <form action="zhzhshqxzac.php" method="post">
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `hzh` where id='$yhid' ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>        
        <input id="id" name="id" type="hidden" value="<?php echo $yhid;?>" />
        <fieldset class="top">
            <legend>患者</legend>
            <div>
                <span class="label">患者姓名：</span><?php echo $Record[4];?>
                <span class="label">性别：</span><?php echo $Record[37];?>
                <span class="label">出生日期：</span><?php echo $Record[38];?>
            </div>
            <div>
                <span class="label">通讯地址：</span><?php echo $Record[14];?>
            </div>
            <div>
                <span class="label top">申请理由：</span><textarea class="textarea" cols="20" id="Liyou" name="Liyou" rows="2">
</textarea>
            </div>
            <div>
                <span class="label">申请日期：</span><input  class="grd-white" id="ShenqingRiqi" name="ShenqingRiqi" type="text" value="<?php /*echo date('Y-m-d');*/?>" />
            </div>
        </fieldset>
        <fieldset class="top">
            <legend>就诊</legend>
            <div>
                <span class="label">就诊指定医生：</span><select class="grd-white2" id="jzhzhdysh" name="jzhzhdysh" style="width: 500px;">
                
<?php    
if($Record[12]!=""){
  $jzhyyid=$Record[12];
}else if($Record[11]!=""){
  $jzhyyid=$Record[11];
}else if($Record[9]!=""){
  $jzhyyid=$Record[9];
}
    $yysql = "select id,shengjx,sheng,yymch,zhdysh from `yyyshdq` where `id`='".$jzhyyid."'";

    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      echo "<option value=\"".$yyRecord[0]."\"> ".$yyRecord[1]." ".$yyRecord[2]." ".$yyRecord[3]." ".$yyRecord[4]."</option>";
    }
?> 
</select>
            </div>
            <div>
                <span class="label top">转诊意见：</span><textarea class="textarea" cols="20" id="ZhuanzhenYijian" name="ZhuanzhenYijian" rows="2">
</textarea>
            </div>
            <div>
                <span class="label">转诊日期：</span><input class="grd-white" id="ZhuanzhenYishengQianziRiqi" name="ZhuanzhenYishengQianziRiqi" type="text" value="" />
            </div>
        </fieldset>
        <fieldset class="top">
            <legend>接诊</legend>
            <div>
                <span class="label">接诊指定医生：</span>
                <select class="grd-white2" id="JiezhenYishengId" name="JiezhenYishengId" style="width: 500px;" onchange="lyyfnr()">
    <option value=""></option>
<?php
    $yyqzyzh=array();
    $yy2sql = "select id,shengjx,sheng,yymch,zhdysh,zhdyshyzh from `yyyshdq` order by shengjx ASC";

    $yy2Query_ID = mysql_query($yy2sql);
    while($yy2Record = mysql_fetch_array($yy2Query_ID)){
    if($yy2Record[0]==$jzhyyid){}
      else{
          $yyqzyzh[$yy2Record[0]] = $yy2Record[5];
        echo "<option value=\"".$yy2Record[0]."\"> ".$yy2Record[1]." ".$yy2Record[2]." ".$yy2Record[3]." ".$yy2Record[4]."</option>";
      }
    }
?> 
    
</select>

</div>
            <div>
                <span class="label top">接诊意见：</span><textarea class="textarea" cols="20" id="JiezhenYijian" name="JiezhenYijian" rows="2">
</textarea>
            </div>
            <div>
                <span class="label">接诊日期：</span><input class="grd-white" id="JiezhenYishengQianziRiqi" name="JiezhenYishengQianziRiqi" type="text" value="" />
            </div>
        </fieldset>
        <fieldset class="top">
            <legend>项目办公室审批</legend>
            <div>
                <span class="label top">项目办公室意见：</span><textarea class="textarea" cols="20" id="XiangmuBangongshiYijian" name="XiangmuBangongshiYijian" rows="2">
</textarea>
            </div>
            <div>
                <span class="label">经办人：</span><?php echo $_SESSION[yhname];?><input id="JingbanrenId" name="JingbanrenId" type="hidden" value="<?php echo $_SESSION[yhid];?>" />
            </div>
            <div>
                <span class="label">经办日期：</span><input class="grd-white" id="JingbanrenQianziRiqi" name="JingbanrenQianziRiqi" type="text" value="<?php echo date('Y-m-d');?>" readonly />
            </div>
            <div>
                <span class="label">主任签字日期：</span><input class="grd-white" id="ZhurenQianziRiqi" name="ZhurenQianziRiqi" type="text" value="" />
            </div>
            <div>
                <span class="label">转诊申请状态：</span><select class="grd-white2" id="ZhuangtaiMingcheng" name="ZhuangtaiMingcheng"><option value="申请已通过">申请已通过</option>
<option value="申请已拒绝">申请已拒绝</option>
<option value="申请已取消">申请已取消</option>
</select>
            </div>
        </fieldset>
        <fieldset class="top">
            <legend>药房</legend>
            <div>
                <span class="label">转出药房：</span><?php      
    /*$dqlyyfsql = "select id,yfsheng,yfmch,yfzhdysh,yfdh from `yf` where `id`='".$Record[36]."'";
    $dqlyyfQuery_ID = mysql_query($dqlyyfsql);
    while($dqlyyfRecord = mysql_fetch_array($dqlyyfQuery_ID)){
      echo "<input  name=\"zhchyfid\" type=\"hidden\" value=\"".$dqlyyfRecord[0]."\" />".$dqlyyfRecord[1].$dqlyyfRecord[2]." ".$dqlyyfRecord[3]." ".$dqlyyfRecord[4];
    }*/
    echo "<input  name=\"zhchyfid\" type=\"hidden\" value=\"".$Record[36]."\" />".$Record[36];
?>
            </div>
            <div>
                <span class="label">转入药房：</span><input id="lyyfid" name="lyyfid" class="grd-white" style="width:260px;" type="text" readonly value="" />
            </div>
        </fieldset>
        <div class="top">
            <input type="button" id="submitBtn" value="保存" class="uusub" /><input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
<?php
  }
?>
        </form>
    </div>

    <script type="text/javascript">
        function SubmitCheck() {
            if($("#JiezhenYishengId").val()==""){
               if (!confirm("接诊指定医生未选择。是否继续保存？")) {
                    return false;
                }
            }
            return true;
        }
        $(function () {
            if ($("#ZhuanzhenYishengId").val() != "") {
                $("#span_ZhuanzhenYishengId").hide();
            }
            if ($("#ZhuanchuYaofangId").val() != "") {
                $("#span_ZhuanchuYaofangId").hide();
            }

            chooseDate('ShenqingRiqi', false);
            chooseDate('ZhuanzhenYishengQianziRiqi', true);
            chooseDate('JiezhenYishengQianziRiqi', true);
            //chooseDate('JingbanrenQianziRiqi', true);
            chooseDate('ZhurenQianziRiqi', true);

            //状态控制
            $("#ZhuangtaiMingcheng").bind("change", ZhuanzhenZhuangtaiKongzhi);
            ZhuanzhenZhuangtaiKongzhi();
            
            //绑定提交验证
            $("#submitBtn").bind("click", function () {

                if (SubmitCheck()&&confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("form").submit();
                    return false;
                }
            });
        });
        var yyqzyzh = eval(<?php echo json_encode($yyqzyzh)?>);
        function padLeft(str, lenght) {
            //医生编号的遍历
            if (str.length >= lenght){
                //alert(str.length+'b'+lenght);
                return str;
            }
            else{
                //alert(str.length+'a'+lenght);
                if(str.length==undefined){
                    return padLeft("" + str, lenght);
                }else{
                    return padLeft("0" + str, lenght);
                }
            }
        }
      function lyyfnr(v) {
          $.get( 
              'zhzhshqxzaclyyf.php',  
              {  
                  yyid:$("#JiezhenYishengId").val()
              },  
              function (data) { //回调函数  
                  $("#lyyfid").val(data);
              }  
          );
          if(v == 0) {
              document.getElementById('qzyzh').style.display='none';
          } else {
              console.log(yyqzyzh);
              v = yyqzyzh[$('#JiezhenYishengId').val()];
              console.log($('#JiezhenYishengId').val());
              imgsrc=padLeft(v, 3);
              document.getElementById('zhdyshyzh').src='./qzyzh/'+imgsrc+'-1.jpg';
              document.getElementById('zhdyshqzh').src='./qzyzh/'+imgsrc+'-2.jpg';
              document.getElementById('qzyzh').style.display='block';
          }
      }
        var jujue = '申请已拒绝';
        var quxiao = '申请已取消';
        function ZhuanzhenZhuangtaiKongzhi() {
            if ($("#ZhuangtaiMingcheng").val() == jujue || $("#ZhuangtaiMingcheng").val() == quxiao) {
                $("#JiezhenYishengId").val("");
                $("#JiezhenYishengId").attr("disabled",true);
                $("#ZhuanruYaoFangId").val("");
                $("#ZhuanruYaoFangId").attr("disabled", true);
            }
            else {
                $("#JiezhenYishengId").attr("disabled", false);
                $("#ZhuanruYaoFangId").attr("disabled", false);
            }
        }
    </script>

            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
            </div></div>
    <div id="footerCon">
        <div id="foot">
            <div id="footNav">
                <div>
                    <div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
