<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="替换指定药房";
include('xpap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <?php echo $html_title;?>
        </div>
    <div class="form">
        <form action="thzhdyfac.php" method="post">
     
        
        <fieldset>
            <legend>需替换药房</legend>
            <div>
                <span class="label">替换前指定药房：</span><select id="thqyfid" name="thqyfid" style="width: 500px;">
<?php
    $thqyfsql = "select id,yfsheng,yfmch from `yf` group by yfmch order by yfsheng ASC";
    $thqyfQuery_ID = mysql_query($thqyfsql);
    while($thqyfRecord = mysql_fetch_array($thqyfQuery_ID)){
      echo "<option value=\"".$thqyfRecord[2]."\">".$thqyfRecord[1]." ".$thqyfRecord[2]."</option>";
    }
?>            
</select>
            </div>
        </fieldset>
        <fieldset>
            <legend>替换后药房</legend>
            <div>
                <span class="label">替换后指定药房：</span><select id="thhyfid" name="thhyfid" style="width: 500px;">
<?php
    $thhyfsql = "select id,yfsheng,yfmch from `yf` where `shfzt`='1' group by yfmch order by yfsheng ASC";
    $thhyfQuery_ID = mysql_query($thhyfsql);
    while($thhyfRecord = mysql_fetch_array($thhyfQuery_ID)){
      echo "<option value=\"".$thhyfRecord[2]."\">".$thhyfRecord[1]." ".$thhyfRecord[2]."</option>";
    }
?>   
</select>
</div>
        </fieldset>
        <fieldset>
            <legend>替换药房办理信息</legend>
            <div>
                <span class="label">经办人：</span><?php echo $_SESSION[yhname];?><input id="jbr" name="jbr" type="hidden" value="<?php echo $_SESSION[yhid];?>" />
            </div>
            <div>
                <span class="label">经办日期：</span><input class="input addInput" id="thrq" name="thrq" type="text" value="<?php echo date('Y-m-d');?>" />
            </div>
            <div>
                <span class="label top">替换药房理由：</span><textarea class="textarea" cols="20" id="thly" name="thly" rows="2">
</textarea>
            </div>
        </fieldset>
        <fieldset>
            <legend>替换药房选项</legend>
            <div>
                <span class="label">新入组替换：</span>
                <select id="xrzth" name="xrzth">
                <option value="是">是</option>
                <option value="否">否</option>
                </select>
            </div>
            <div>
                <span class="label">老患者替换：</span>
                <select id="lhzhth" name="lhzhth">
                <option value="是">是</option>
                <option value="否">否</option>
                </select>
            </div>
        </fieldset>
        <div class="btnPos">
            <input type="submit" id="submitBtn" value="保存" class="lgSub" /></div>
        </form>
    </div>
    <script type="text/javascript">
        function SubmitCheck() {
            var thqyfid = $("#thqyfid").val();
            var thhyfid = $("#thhyfid").val();
            if (thqyfid != "" && thhyfid != "" &&thqyfid != thhyfid) { 
                return true;  
            }else{
            if (!confirm("替换前药房和替换后药房选择错误！")) {
                    return false;
                }
            }
            return false;
        }
        $(function () {
            chooseDate('thrq', false);
            //绑定提交验证
            $("input:submit").unbind("click");
            $("#submitBtn").bind("click", function () {

                if (SubmitCheck() && confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("form").submit();
                    return false;
                }
                return false;
            });
            $("input:submit").attr("disabled", false);
        });
    </script>

            <div class="clearFoot noPrint">
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
