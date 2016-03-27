<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增随访记录";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<?php echo $html_title;?></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <div class="form">
        <form action="xzsfjlac.php" method="post">
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `hzh` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
       <input id="Id" name="Id" type="hidden" value="<?php echo $yhid;?>" />
        <div class="top">
            <span class="label">患者姓名：</span><?php echo $Record[4];?></div>
        <div class="top">
            <span class="label">随访时间：</span><input class="grd-white" id="sfrq" name="sfrq" type="text" value="<?php echo date('Y-m-d');?>" />
        </div>
        <div class="top">
            <span class="label">随访电话：</span>
            <select class="grd-white" id="sffsh" name="sffsh">
                <option value="<?php echo $Record[16];?>">第一联系人:<?php echo $Record[16]?></option>
                <option value="<?php echo $Record[17];?>">第二联系人:<?php echo $Record[17]?></option>
                <option value="<?php echo $Record[51];?>">第三联系人:<?php echo $Record[51]?></option>
                <option value="<?php echo $Record[15];?>">患者手机&nbsp;&nbsp;  :<?php echo $Record[15]?></option>
            </select>
<!--            <input class="grd-white" id="sffsh" name="sffsh" type="text" value="" />-->
        </div>
        
        <!--div>
            <span class="label">被随访人：</span><input class="grd-white" id="bsfr" name="bsfr" type="text" value="" />
        </div-->
        <div class="top">
            <span class="label">与患者的关系：</span><input class="grd-white" id="yhzhgx" name="yhzhgx" type="text" value="" />
        </div>
        <div class="top">
            <span class="label top">随访事件详情：</span><textarea class="textarea" cols="20" id="sfshjxx" name="sfshjxx" rows="2">
</textarea>
        </div>
        <div class="top">
            <span class="label top">随访人：</span><input  class="grd-white" id="bzh" name="bzh" value="<?php echo $_SESSION[yhname];?>" readonly>
        </div>
        <div class="top">
            <input type="submit" id="submitBtn" value="保存" class="uusub" />
            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
<?php
      $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=shqgl.php\">";}

?> 
 
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            chooseDateNow('DiaochaRiqi', false);
            $("[name='ShushiQingkuang']").bind("click", ShowOrHide);
            function ShowOrHide() {
                if ($("#div_shushiqingkuang :checked").val() == "0") {
                    $("#div_bushushimiaoshi").show();
                }
                else {
                    $("#div_bushushimiaoshi").hide();
                }
            }
            ShowOrHide();
            $("#DiaochaBumen").bind("change", ShowOrHideQitaBumen);
            function ShowOrHideQitaBumen() {
                if ($("#DiaochaBumen").val().indexOf("其他") >= 0) {
                    $("#QitaBumen").show();
                }
                else {
                    $("#QitaBumen").hide();
                }
            }
            ShowOrHideQitaBumen();
            //绑定提交验证
            $("input:submit").unbind("click");
            $("#submitBtn").bind("click", function () {
                if ($("#LianxiDianhua").val()!=""&&confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("form").submit();
                    return false;
                }else{alert("联系部门电话未填写。");return false;}
                return false;
            });
            $("input:submit").attr("disabled", false);

        });

    </script>

            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
        </div>
    </div>
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
