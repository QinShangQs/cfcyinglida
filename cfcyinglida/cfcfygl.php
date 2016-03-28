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
    $hzhidsql = "select `id` from `hzh` where `hzhxm` LIKE '%" . $guanjianci . "%'  or `id` = '" . $hzhshqid . "' or `hzhid` = '" . $hzhrzid . "'";
    $jli = 0;
    if ($guanjiancisql == "") {
        $guanjiancisql = "(";
    } else {
        $guanjiancisql .= " and (";
    }

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
    $numq = mysql_query("SELECT * FROM `zyff` where `tshqk`='0'");
} else {
    $numq = mysql_query("SELECT * FROM `zyff` where `tshqk`='0' and " . $guanjiancisql);
}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num / $pagesize);
$zshsql = "SELECT SUM(fyshl),SUM(jhkpshl) FROM `zyff` where `tshqk`='0'";
if ($guanjiancisql != "") {
    $zshsql .= "and " . $guanjiancisql;
}

$zsh = mysql_query($zshsql);
//echo $zshsql;
while ($zshRecord = mysql_fetch_array($zsh)) {
    $zshjs = $zshRecord[0];
    $jhkpshl = $zshRecord[1];
}
$html_title = "药品发放记录管理";
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
                            <div class="insinsins">
                  <span>
<input type="text" id="Guanjianci" name="Guanjianci" class="grd-white" value="<?php echo $_GET[guanjianci]; ?>"
       placeholder="患者姓名,编码i" style="width:280px"/>
<input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期" size="12" value=""
       class="grd-white" style="width:120px"/>
-
<input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期" size="12" value=""
       class="grd-white" style="width:120px"/><br/></div>
                            <div class="insinsins" style="width:100%;">
                                <select id="YaoFangId" name="YaoFangId" style="width:400px;" class="grd-white2">
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
                                <input type="button" value="按条件过滤" onclick="guolv();" class="uusub2"/>
                                </span>
                            </div>
            </div>
            <br/>
            </td>
            </tr>
            </table>
            <div class="insinsins"> <span>
          已发药总数: <?php echo $zshjs; ?>盒&nbsp;空药瓶总数:<?php echo $jhkpshl; ?>盒
          </span></div>
            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                <tr style="color:#1f4248; font-weight:bold; height:30px;">
                    <td width="8%" align="center" bgcolor="#FFFFFF">发药日期</td>
                    <td width="8%" align="center" bgcolor="#FFFFFF">患者姓名</td>
                    <td width="8%" align="center" bgcolor="#FFFFFF">唯一编码</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">规格</td>
                    <td width="8%" align="center" bgcolor="#FFFFFF">发药盒数</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">回收空药盒数</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">药盒批号</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">发药前库存量</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">发药后库存量</td>
                    <td width="8%" align="center" bgcolor="#FFFFFF">发药人</td>
                    <td width="6%" align="center" bgcolor="#FFFFFF">领药人</td>
                    <td width="6%" align="center" bgcolor="#FFFFFF">操作</td>
                </tr>
                <?php
                $sql = "select * from `zyff` where `tshqk`='0'";
                if ($guanjiancisql != "") {
                    $sql .= "and " . $guanjiancisql;
                }
                $sql .= " order by id DESC limit $page $pagesize ";
                $Query_ID = mysql_query($sql);
                while ($Record = mysql_fetch_array($Query_ID)) {
                    echo "<tr style=\"color:#1f4248; font-size:12px;\">";
                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[20] . "</td>";

                    $hzhsql = "select `hzhid`,`hzhxm`,`hzhshj`,`ypgg`,`jzhlx` from `hzh` where `id`='" . $Record[1] . "'";
                    $hzhQuery_ID = mysql_query($hzhsql);
                    while ($hzhRecord = mysql_fetch_array($hzhQuery_ID)) {
                        $hzhshj = $hzhRecord[2];
                        $lynumq = mysql_query("SELECT * FROM `zyff` where `hzhid`='" . $hzhRecord[0] . "' and `tshqk`<>'1'");
                        $lynum = mysql_num_rows($lynumq);//获取总条数
                        // echo $lynum;
                        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $hzhRecord[1] . "</td>";
                        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">I-" . $hzhRecord[0] . "</td>";

                        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $hzhRecord[3] . "</td>";
                    }

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[4] . "</td>";
                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                    if ($Record[7] != "") {
                        echo $Record[7];
                    } else {
                        echo "0";
                    }
//                    if ($Record[8] != "") {
//                        echo $Record[8];
//                    } else {
//                        echo "0";
//                    }


                    echo "</td>";

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[21] . "</td>";
                    if($Record[6]<0 || empty($Record[6])){
                        $fyqshyl=0;
                    }else{
                        $fyqshyl=$Record[6];
                    }
                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $fyqshyl . "</td>";
                    if($Record[6]-$Record[4]< 0){
                        $fyhshyl = 0;
                    }else{
                        $fyhshyl = $Record[6]-$Record[4];
                    }
                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $fyhshyl . "</td>";

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                    /*$yshsql = "select `yhyl1` from `manager` where `id`='".$Record[18]."'";
                    $yshQuery_ID = mysql_query($yshsql);
                    while($yshRecord = mysql_fetch_array($yshQuery_ID)){
                      echo $yshRecord[0];
                    }*/
                    echo $Record[18];
                    echo "</td>";
                    if ($Record[9] != '0') {
                        $zhxqshsql = "select `xm`,`lxfsh` from `zhxqsh` where `id`='" . $Record[9] . "'";
                        //echo $zhxqshsql;
                        $zhxqshQuery_ID = mysql_query($zhxqshsql);
                        while ($zhxqshRecord = mysql_fetch_array($zhxqshQuery_ID)) {
                            $zhxqshxm = $zhxqshRecord[0];
                            $zhxqshlxfsh = $zhxqshRecord[1];

                            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">" . $zhxqshxm . "</td>";
                        }
                    } else {
                        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">本人</td>";
                    }
                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcyshfyxq.php?id=" . $Record[0] . "\">详细</a></td>";
                    echo "</tr>";
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

    function guolv() {
        var url = 'cfcfygl.php?kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val()) + '&guanjianci=' + encodeURIComponent($('#Guanjianci').val()) + '&yf=' + encodeURIComponent($('#YaoFangId').val());
        location.href = url;
    }
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