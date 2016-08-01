<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw = $_SESSION[gldw];

$ri = date('d');
//$yuri = date('d',strtotime(date('Y-m')."+1 month -1 day"));
$xtggxxsql = "select ggnr from `xtggxx` where `ggzht`='1' and `tshgn`='1'";
$xtggxxQuery_ID = mysql_query($xtggxxsql);
while ($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)) {
    $xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
    $xtggxxggnr = $xtggxxRecord[0];//读取数据库，盘点当月 1 或者 上月 0
}

$dayyd = date("d", strtotime("+1 day")); 
if (($ri >= 1 && $ri <= 5) || $xtggxx == 1 || $dayyd == 1 || $yzhyfshfpdzht == 1) {
    if($ri >= 1 && $ri <= 5){      
    	$dzhny = date('Y-m', strtotime("-1 month", strtotime(date('Y-m'))));
    } else {
    	$dzhny = date('Y-m');
    }

    $html_title = "库房库存盘点新增";
    include('spap_head.php');
    ?>
    <div class="main">
        <div class="insmain">

            <div class="thislink">当前位置：库存盘点 > <?php echo $html_title; ?></a> </div>
            <div class="inwrap flt top">
                <div class="title w977 flt">
                    <strong><?php echo $html_title; ?></strong><span></span>
                </div>
                <div class="incontact w955 flt">
                    <?php
                    echo "<b>开始盘点" . $dzhny . "</b>";
                    $pdrq = date('Y-m-d');
                    $pdr = $_SESSION['yhid'];
                    ?>
                    <form action="yshkcpdxzac.php" method="post">
                        <input name="xtggxx" type="hidden" value="<?php echo $xtggxx; ?>"/>
                        <input name="xtggxxggnr" type="hidden" value="<?php echo $xtggxxggnr; ?>"/>
                        <input name="dzhny" type="hidden" value="<?php echo $dzhny; ?>"/>
                        <input name="pdrq" type="hidden" value="<?php echo $pdrq; ?>"/>
                        <input name="pdr" type="hidden" value="<?php echo $pdr; ?>"/>
                        <input name="dwmch" type="hidden" value="<?php echo $yhgldw; ?>"/>
                        <fieldset class="top">
                            <legend>新增库存盘点</legend>
                            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                                <tr style="color:#1f4248; font-weight:bold; height:30px;">
                                    <td align="center" bgcolor="#FFFFFF" width="20%">
                                        批号
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" width="20%">
                                        月初库存量
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" width="20%">
                                        本月入库
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" width="20%">
                                        本月出库
                                    </td>

                                    <td align="center" bgcolor="#FFFFFF" width="20%">
                                        实际库存
                                    </td>
                                </tr>
                                <?php


                                $ph1ids = array();
                                $ph2ids = array();

                                $phidsql = "select `ph1`,`ph2` from `yfshqzy` where `shqzht`='3' and `yfmch`='" . $yhgldw . "' and `shdrq`<='" . date('Y-m-t', strtotime($dzhny)) . "'";
                                $phidQuery_ID = mysql_query($phidsql);
                                while ($phidRecord = mysql_fetch_array($phidQuery_ID)) {
                                    if ($phidRecord[0] != "" && $phidRecord[0] != "0") {
                                        $ph1ids[] = $phidRecord[0];
                                    }
                                    if ($phidRecord[1] != "" && $phidRecord[1] != "0") {
                                        $ph2ids[] = $phidRecord[1];
                                    }
                                }
                                //echo $phidsql;
//                                print_r($ph1ids);
//                                print_r(array_merge($ph1ids,$ph2ids));
                                $phidtmp = array_values(array_unique(array_merge($ph1ids, $ph2ids)));

//                                print_r($phidtmp);
                                $phid = Array();
                                for ($i = 0; $i < count($phidtmp); $i++) {
                                    $phid = array_values(array_unique(array_merge($phid, explode(",", $phidtmp[$i]))));
//print_r(array_merge($phid,explode(",",$phidtmp[$i])));
                                }
//                                print_r($phid);
                                $phnsql = "select `ph` from `kfrk` order by id ASC";
                                $phnQuery_ID = mysql_query($phnsql);
                                $phnshzi = 1;
                                while ($phnRecord = mysql_fetch_array($phnQuery_ID)) {
                                    $phn[$phnshzi] = $phnRecord[0];
                                    $phnshzi++;
                                }
                                for ($i = 0; $i < count($phid); $i++) {
                                    ?>
                                    <tr style="color:#1f4248; font-size:12px;">
                                        <td align="center" bgcolor="#FFFFFF">
                                            <input id="ypph" name="ypph<?php echo $i + 1; ?>" class="grd-white"
                                                   type="hidden" value="<?php echo $phn[$phid[$i]]; ?>"/>
                                            <?php echo $phn[$phid[$i]]; ?>
                                        </td>
                                        <td align="center" bgcolor="#FFFFFF">******
                                            <input type="hidden" class="grd-white" name="qchkc<?php echo $i + 1; ?>"
                                                   value="0"/>
                                        </td>
                                        <td align="center" bgcolor="#FFFFFF">******
                                            <input type="hidden" class="grd-white" name="byrk<?php echo $i + 1; ?>"
                                                   value="0"/>
                                        </td>
                                        <td align="center" bgcolor="#FFFFFF">******
                                            <input type="hidden" class="grd-white" name="bychk<?php echo $i + 1; ?>"
                                                   value="0"/>
                                        </td>

                                        <td align="center" bgcolor="#FFFFFF">
                                            <input type="text" class="grd-white" name="shjkc<?php echo $i + 1; ?>"
                                                   value="0"/>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>


                            </table>
                            <br/>
                            <input name="phshl" type="hidden" value="<?php echo $i; ?>"/>
                            <input type="submit" value="保存" class="uusub"/>
                            <input id="IsChaxun" name="IsChaxun" type="hidden" value="0"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
} else {
    echo "未到盘点日期";
}
?>