<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$pagesize = 10;//每页显示的条数：
$url = $_SERVER["REQUEST_URI"];//获取本页地址-网址
$url = parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=(\d+)&/", "", $url[query]);
$url[query] = preg_replace("/&page=(\d+)/", "", $url[query]);
$url[query] = preg_replace("/page=(\d+)/", "", $url[query]);

if ($url[query] != "undefined" && $url[query] != "") {
    $url = $url[path] . "?" . $url[query] . "&";
} else {
    $url = $url[path] . "?";//得到解析网址的 具体信息
}


if ($_GET[page]) {
    $pageval = $_GET[page];
    $page = ($pageval - 1) * $pagesize;
    $page .= ',';
}
if ($_GET[guanjianci] != "") {
    $guanjianci = $_GET[guanjianci];
//     if (substr($guanjianci, 0, 1) == 's' || substr($guanjianci, 0, 1) == 'S') {
//         $guanjianci = str_ireplace('s-', '', $guanjianci, $i);
    if (substr($guanjianci, 0, 1) == 'i' || substr($guanjianci, 0, 1) == 'I') {
    	$guanjianci = str_ireplace('i-', '', $guanjianci, $i);
        $hzhrzid = $guanjianci;
    } else {
        $guanjianci = preg_replace('/^0*/', '', $guanjianci);
        $hzhshqid = $guanjianci;
    }
    $hzhidsql = "select `id` from `hzh` where `hzhxm` LIKE '%" . $guanjianci . "%' or `id` = '" . $hzhshqid . "' or `ypgg` LIKE '%" . $guanjianci . "%' ";
    if ($hzhrzid) {
        $hzhidsql .= "or `hzhid` = '" . $hzhrzid . "'";
    }
    $jli = 0;
    $guanjiancisql = "(";
    $hzhidQuery_ID = mysql_query($hzhidsql);
    while ($hzhidRecord = mysql_fetch_array($hzhidQuery_ID)) {
        if ($jli == 0) {
            $jli = 1;
            $guanjiancisql .= " `hzhid`='" . $hzhidRecord[0] . "'";
        } else {
            $guanjiancisql .= " or `hzhid`='" . $hzhidRecord[0] . "'";
        }
    }
    $guanjiancisql .= ") ";
//echo $guanjiancisql.$hzhidsql;
    $numq = mysql_query("SELECT * FROM `zyff` where `fyshl`>'0' or  `jhkpshl`>'0' and " . $guanjiancisql);
}
if ($_GET[kshrq] != "" && $_GET[jshrq] != "") {
    $kshrq = $_GET[kshrq];
    $jshrq = $_GET[jshrq];

    if ($guanjiancisql == "") {
        $guanjiancisql = "( `fyrq` >= '" . $kshrq . "' and `fyrq` <= '" . $jshrq . "' )";
    } else {
        $guanjiancisql .= " and ( `fyrq` >= '" . $kshrq . "' and `fyrq` <= '" . $jshrq . "' )";
    }
}
if ($_GET[yf] != "") {//按药房
    if ($guanjiancisql == "") {
        $guanjiancisql = "`yfmch`='" . $_GET[yf] . "'";
    } else {
        $guanjiancisql .= " and `yfmch`='" . $_GET[yf] . "'";
    }
}

if ($guanjiancisql == "") {
    $numq = mysql_query("SELECT * FROM `zyff` where `fyshl`>'0' or  `jhkpshl`>'0'");
} else {
    $numq = mysql_query("SELECT * FROM `zyff` where " . $guanjiancisql . " and(`fyshl`>'0' or  `jhkpshl`>'0')");
}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num / $pagesize);
$html_title = "空药盒回收";
include('spap_head.php');
?>
<div class="main"><?php /*div[main]开始*/ ?>
    <div class="insmain">
        <div class="thislink">当前位置：<?php echo $html_title; ?></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong><?php echo $html_title; ?></strong><span></span>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td>
                            <div class="insinsins" style="width:100%;">
                                <span>
                                    <input type="text" id="Guanjianci" name="Guanjianci"
                                           value="<?php echo $_GET[guanjianci]; ?>" placeholder="患者姓名、编码、药品规格"
                                           class="grd-white"/>
                                    <input type="text" id="KaishiRiqi" name="KaishiRiqi"
                                           readonly="readonly" placeholder="请输入开始日期" size="12" value=""
                                           class="grd-white" style="width:120px"/>-
                                    <input type="text" id="JiezhiRiqi" name="JiezhiRiqi"
                                           readonly="readonly" placeholder="请输入结束日期" size="12" value=""
                                           class="grd-white"
                                           style="width:120px"/>
                                </span>
                            </div>
                            <div class="insinsins">
                                <span>
                                    <select id="YaoFangId" name="YaoFangId"
                                            style="width:400px;" class="grd-white2">
                                        <?php
                                        if ($_GET[yf] == "") {
                                            ?>
                                            <option selected="selected" value="">全部药房</option>
                                        <?php
                                        } else {
                                            ?>
                                            <option selected="selected"
                                                    value="<?php echo $_GET[yf]; ?>"><?php echo $_GET[yf]; ?></option>
                                            <option value="">全部药房</option>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        $yfsql = "select id,yfshijx,yfmch from `yf` where `shfzt`='1' order by yfshijx ASC";
                                        $yfQuery_ID = mysql_query($yfsql);
                                        while ($yfRecord = mysql_fetch_array($yfQuery_ID)) {
                                            echo "<option value=\"" . $yfRecord[2] . "\">" . $yfRecord[1] . " " . $yfRecord[2] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="button" value="查找" onclick="chazhao();" class="uusub2"/>
                                </span>
                            </div>
                            <div class="insinsins">
                                <?php
                                $dayyd=date("d",strtotime("+1 day"));
                                if($dayyd==1){
                                    $ny=date('Y-m');
                                }else {
                                    $ny=date('Y-m',strtotime("-1 month"));
                                }
                                ?><span>
                                <a href="cfckpjhpdf.php?ny=<?php echo $ny;?>" target=_blank>下载《空药盒回收记录》</a>&nbsp;&nbsp; </div>
                            </span>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                        <td width="9%" align="center" bgcolor="#FFFFFF">状态</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">患者姓名</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">唯一编码</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">收到日期</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">回收数量</td>
                        <td width="12%" align="center" bgcolor="#FFFFFF">自购药盒数(5mg)</td>
                        <td width="16%" align="center" bgcolor="#FFFFFF">援助药盒数(1mg 5mg)</td>
                        <td width="9%" align="center" bgcolor="#FFFFFF">经办人</td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM `zyff` where  ";
                    if ($guanjiancisql != "") {
                        $sql .= $guanjiancisql." and (`fyshl`>'0' or `jhkpshl`>'0')";
                    }else{
                        $sql .= "(`fyshl`>'0' or `jhkpshl`>'0')";
                    }
                    $sql .= " order by id DESC limit $page $pagesize ";
                    $_SESSION['cfckpjhsql'];
                    $Query_ID = mysql_query($sql);
                    while ($Record = mysql_fetch_array($Query_ID)) {
                        //<td><a href=\"yshfyxq.php?id=".$Record[0]."\">详细</a></td>
                        $hzhsql = "select `hzhid`,`hzhxm`,`shqbzh`,`hzhshj`,`jzhlx` from `hzh` where `id`='" . $Record[1] . "'";
                        $hzhQuery_ID = mysql_query($hzhsql);
                        while ($hzhRecord = mysql_fetch_array($hzhQuery_ID)) {
                            $hzhshj = $hzhRecord[2];
                            echo "<tr style=\"color:#1f4248; font-size:12px;\">";

                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                            if ($Record[23] != "") {
                                echo "瓶:";
                                if ($Record[23] == "1") {
                                    echo "在药房";
                                } else if ($Record[23] == "2") {
                                    echo "在CFC";
                                } else if ($Record[23] == "3") {
                                    echo "在国药外贸发货组";
                                } else if ($Record[23] == "4") {
                                    echo "已销毁";
                                }
                            } else {
                                echo "无";
                            }
                            if ($Record[25] == "1") {
                                echo "(非发药交回)";
                            }
                            echo "</td>";

                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $hzhRecord[1] . "</td>";
                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">I-" . $hzhRecord[0] . "</td>";
                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[20] . "</td>";
                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                            if ($Record[7] != "") {
                                echo $Record[7] . "个";
                            } else {
                                echo "0个";
                            }
                            /*$jbrsql = "select `yhyl1` from `manager` where `id`='".$Record[18]."'";
                            $jbrQuery_ID = mysql_query($jbrsql);
                            while($jbrRecord = mysql_fetch_array($jbrQuery_ID)){
                              echo "<td>".$jbrRecord[0]."</td>";
                            }*/
                            $lynumq = mysql_query("SELECT * FROM `zyff` where `hzhid`='" . $hzhRecord[0] . "'  and `tshqk`<>'1'");
                            $lynum = mysql_num_rows($lynumq);
                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\"> ";
                            if ($hzhRecord[2] == "RCC" && $lynum < 3 && $hzhRecord[4] == '1+1+1') {
                                $zgypsh = 4;
                                echo $zgypsh . "瓶";
                            } else if ($hzhRecord[2] == "GIST" && $lynum == 0 && $hzhRecord[4] == '部分') {
                                $zgypsh = 8;
                                echo $zgypsh . "瓶";
                            } else if ($hzhRecord[2] == "pNET" && $lynum == 0 && $hzhjzhlx == '原部分') {
                                $zgypsh = 8;
                                echo $zgypsh . "瓶";
                            } else if ($hzhRecord[2] == "RCC" && $lynum == 0 && $hzhRecord[4] == '原部分') {
                                $zgypsh = 12;
                                echo $zgypsh . "瓶";
                            }
                            echo "</td>";
                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                            //echo $Record[4]-$zgypsh."瓶";
                            if ($Record[4] - $zgypsh > 0) {
                                echo $Record[4] - $zgypsh . "瓶";
                            };
                            echo "</td>";
                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[18] . "</td>";
                            echo "</tr>";;
                        }

                    }
                    ?>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
                    <tr>
                        <td>
                            <?php
                            include('pagefy.php');
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div><?php /*div[main]结束*/ ?>
</div><?php /*主框大div[wrap]结束*/ ?>
<script type="text/javascript">
    function chazhao() {
        var url = 'cfckpjhgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val()) +
            '&kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) +
            '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val()) + '&yf=' + encodeURIComponent($('#YaoFangId').val());
        location.href = url;
    }
    ;
    $(function () {
        chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
        <?php
        if($_GET[kshrq]!=""){
        ?>
        $("#KaishiRiqi").val('<?php echo $_GET[kshrq];?>');
        <?php
        }
        if($_GET[jshrq]!=""){
        ?>
        $("#JiezhiRiqi").val('<?php echo $_GET[jshrq];?>');
        <?php
        }
        ?>
    });
</script>
</body>
</html>