<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title = "新增药房调拨";
include('spap_head.php');
?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置： <?php echo $html_title; ?> </div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong>新增药房调拨</strong>
            </div>
            <div class="incontact w955 flt">
                <form action="cfcyfdbglac.php" method="post">
                    转出药房：<select id="fchyf" name="fchyfname" class="grd-white2">
                        <option value="">-请选择-</option>
                    </select><br>

                    <div class="top">
                        转入药房：<select id="frhyf" name="fryfname" class="grd-white2">
                            <option value="">-请选择-</option>
                        </select><br>
                    </div>
                    <div class="top">
                        调拨规格：<input type="text" name="dbypgg" id="dbypggid" value="12.5mg*28粒" class="grd-white">
                    </div>
                    <div class="top">
                        调拨数量：<input type="text" name="zhrshl" id="zhrshlid" value="" class="grd-white">
                    </div>
                    <div class="top">
                        <input type="submit" name="submitdb" id="submitdbid" value="提交保存" class="uusub">
                    </div>
                </form>
                <script type="text/javascript">
                    $("#fchyf").change(function () {
                        var yfmch = $("#fchyf").val();
                        //alert(yfmch);
                        if (yfmch != "") {
                            chshlb('frhyf', yfmch);
                        }
                    });
                    sv = "<?php
                            $yfmcsql="select * from `yf`";
                            $yfmchquery=mysql_query($yfmcsql);
                            while($yfmchRecord=mysql_fetch_array($yfmchquery)){
                            echo $yfmchRecord[1].",";
                           }
                           ?>";
                    var strs = new Array(); //定义一数组
                    strs = sv.split(","); //字符分割
                    function chshlb(s, v) {
                        if (v != "" && v != undefined) {
                            $("#" + s).empty();
                            $('<option value="">-请选择-</option>').appendTo("#" + s);
                            for (i = 0; i < strs.length; i++) {
                                if (strs[i] != "" && strs[i] != v) {
                                    $("<option value=\"" + strs[i] + "\">" + strs[i] + "</option>").appendTo("#" + s);
                                }
                            }
                        } else {
                            $("#" + s).empty();
                            $('<option value="">-请选择-</option>').appendTo("#" + s);
                            for (i = 0; i < strs.length; i++) {
                                if (strs[i] != "") {
                                    $("<option value=\"" + strs[i] + "\">" + strs[i] + "</option>").appendTo("#" + s);
                                }
                            }
                        }
                    }
                    $(function () {
                        chshlb('fchyf');
                    });
                </script>
            </div>
        </div>
    </div>
</div>

</body>
</html>
