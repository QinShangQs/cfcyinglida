<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增社会调查";
$survey_hisory = "社会调查历史";
include('spap_head.php');
$yhid = $_GET['id'];
?>
     <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <a href="shqxq.php?id=<?php echo $yhid; ?>">申请详细信息</a> ><?php echo $html_title;?> </div>
			<div class="inwrap flt top">

            <div class="title w977 flt">
                <strong><?php echo $survey_hisory;?></strong><span></span>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                        <th width="10%" align="center" bgcolor="#FFFFFF">
                            操作
                        </th>
                        <th width="10%" align="center" bgcolor="#FFFFFF">
                            调查部门
                        </th>
                        <th width="10%" align="center" bgcolor="#FFFFFF">
                            联系电话
                        </th>
                        <th width="10%" align="center" bgcolor="#FFFFFF">
                            是否属实
                        </th>
                        <th width="10%" align="center" bgcolor="#FFFFFF">
                            调查日期
                        </th>
                        <th width="10%" align="center" bgcolor="#FFFFFF">
                            调查人
                        </th>
                        <TH width="10%" align="center" bgcolor="#FFFFFF">说明原因 </TH>
                    </tr>
                    <?php
                    $shdsql = "select * from `shhdch` where hzhid='$yhid' order by id DESC";
                    $shdQuery_ID = mysql_query($shdsql);
                    while($shdRecord = mysql_fetch_array($shdQuery_ID)){
                        echo "<tr style=\"color:#1f4248; font-size:12px;\"><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\"><a href='shhdchxx.php?id=".$shdRecord[0]."&id2=".$yhid."'>详情</a></td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
                        if($shdRecord[8]!=""){echo $shdRecord[8];}
                        else{echo $shdRecord[2];}
                        echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$shdRecord[3]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
                        switch ($shdRecord[4]){
                            case "0":echo "不属实";break;
                            case "1":$shfshsh='1';echo "属实";break;
                            case "2":echo "不确定";break;
                        }
                        echo "</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$shdRecord[5]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">".$shdRecord[6]."</td><td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\"><A href=\"javascript:shdyy('shdyy','".$shdRecord[0]."');\">详细说明原因</A></td></tr>";
                        echo "<TR id=shdyy".$shdRecord[0]." style=\"display:none;\"><TD style=\"PADDING-LEFT: 60px\" colSpan=7 bgcolor=\"#FFFFFF\"><PRE>";
                        if($shdRecord[4]=='0'){echo $shdRecord[9];}else{echo $shdRecord[7];}
                        echo "</PRE></TD></TR>";

                    }
                    ?>
                </table>
            </div>
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
        <form action="xzshhdchac.php" method="post">
<?php
  $sql = "select * from `hzh` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
       <input id="Id" name="Id" type="hidden" value="<?php echo $yhid;?>" />
        <div class="top">
            <span class="label">患者姓名：</span><?php echo $Record[4];?></div>
        <div class="top">
            <span class="label">调查日期：</span><input class="grd-white" id="DiaochaRiqi" name="DiaochaRiqi" type="text" value="<?php echo date('Y-m-d');?>" />
        </div>
        <div class="top">
            <span class="label">调查部门：</span><select id="DiaochaBumen" class="grd-white2" name="DiaochaBumen">
<option value="工作单位">工作单位</option>
<option value="民政部门">民政部门</option>
<option value="街道办事处">街道办事处</option>
<option value="居委会">居委会</option>
<option value="村委会">村委会</option>
<option value="其他(详细说明)">其他(详细说明)</option>
</select>
            <input class="grd-white" id="QitaBumen" name="QitaBumen" style="display:none" type="text" value="" />
        </div>
        <div class="top">
            <span class="label">联系电话：</span><input class="grd-white" id="LianxiDianhua" name="LianxiDianhua" type="text" value="" />
        </div>
        <div id="div_shushiqingkuang" class="top">
            <span class="label">是否属实：</span><input checked="true" id="ShushiQingkuang_0" name="ShushiQingkuang" type="radio" value="2"></input><label for="ShushiQingkuang_0">不确定</label> <input id="ShushiQingkuang_1" name="ShushiQingkuang" type="radio" value="1"></input><label for="ShushiQingkuang_1">属实</label> <input id="ShushiQingkuang_2" name="ShushiQingkuang" type="radio" value="0"></input><label for="ShushiQingkuang_2">不属实</label> 
        </div>
        <div id="div_bushushimiaoshi" class="top">
            <span class="label top">不属实描述：</span><textarea class="textarea" cols="20" id="BuShushiMiaoshu" name="BuShushiMiaoshu" rows="2">
</textarea>
        </div>
        <div class="top">
            <span class="label top">备注：</span><textarea class="textarea" cols="20" id="Beizhu" name="Beizhu" rows="2">
</textarea>
        </div>
        <div class="top">
            <input type="submit" id="submitBtn" value="保存" class="uusub" />
            <input type="button"  onclick="javascript:{location.href='shqxq.php?id=<?php echo $yhid;?>'}" value="返回" class="uusub2" /></div>
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
        function shdyy(preFix, id) {
            $("#" + preFix + id).toggle();
            $("[id^='" + preFix + "']").not($("#" + preFix + id)).hide();
        }
    </script>
        </div>
    </div>
         </div>
</body>
</html>
