<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title = "赠药发运详细信息";
include('spap_head.php');
?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置：<a href="kfcfcfy.php"><?php echo $html_title; ?></a></div>
        <form method=post action="kfcfcfyac.php">
            <?php
            $shqid = $_GET['id'];
            $sql = "select * from `yfshqzy` where `id` = '$shqid'";
            $Query_ID = mysql_query($sql);
            while ($Record = mysql_fetch_array($Query_ID)) {
                ?>
                <input type="hidden" class="grd-white" name="id" value="<?php echo $shqid; ?>"/>
                <div>
                    发货日期:<input id="fyrq" class="grd-white" name="fyrq" type="txt"
                                value="<?php echo date('Y-m-d'); ?>"></input></div>
                <div>
                    发运总数:<?php echo($Record[20] + $Record[21]); ?>瓶
                    <br/></br>
                    <?php if ($Record[20] != "") { ?>
                        规格:<?php echo $Record[2]; ?><input type="hidden" name="gg"
                                                           value="<?php echo $Record[2]; ?>" /></br>

                        批号:<select id="ph1" class="grd-white2" name="ph1" style="width:260px;">
                            <option value="未知批号">未知批号</option>
                            <?php
                            $ph1sql = "select id,ph from `kfrk` where `gg`='" . $Record[2] . "'";

                            $ph1Query_ID = mysql_query($ph1sql);
                            while ($ph1Record = mysql_fetch_array($ph1Query_ID)) {
                                ?>
                                <option value="<?php echo $ph1Record['0']; ?>"><?php echo $ph1Record['1']; ?></option>
                            <?php
                            }
                            ?></select></br>
                        数量:<?php echo $Record[20]; ?><input type="hidden" name="pfshl1"
                                                            value="<?php echo $Record[20]; ?>" />瓶
                        <br/></br>
                    <?php }
                    if ($Record[21] != "") { ?>
                        规格:<?php echo $Record[5]; ?><input type="hidden" name="gg"
                                                           value="<?php echo $Record[5]; ?>" /></br>
                        批号:<select id="ph2" class="grd-white2" name="ph2" style="width:260px;">
                            <option value="未知批号">未知批号</option>
                            <?php
                            $ph2sql = "select id,ph from `kfrk` where `gg`='" . $Record[5] . "'";

                            $ph2Query_ID = mysql_query($ph2sql);
                            while ($ph2Record = mysql_fetch_array($ph2Query_ID)) {
                                ?>
                                <option value="<?php echo $ph2Record['0']; ?>"><?php echo $ph2Record['1']; ?></option>
                            <?php
                            }
                            ?></select></br>
                        数量:<?php echo $Record[21]; ?><input type="hidden" name="pfshl2"
                                                            value="<?php echo $Record[21]; ?>" />瓶
                        <br/></br>
                    <?php } ?>
                </div>
                <div>
                    运单号:<input id="ydh" class="grd-white" name="ydh" type="txt" value=""></input></div>
                <div>
                    接收药房:<?php   $yfsql = "select yfmch from `yf` where  `yfmch`='" . $Record[25] . "' and `yfzhdysh`='" . $Record[1] . "'";
                    $yfQuery_ID = mysql_query($yfsql);
                    while ($yfRecord = mysql_fetch_array($yfQuery_ID)) {
                        echo $yfRecord[0];
                    }?></div>
                <div>
                    承运人:<?php echo $_SESSION[yhname]; ?></div>

                <div class="btnPos">
                    <input type="submit" value="发货" class="uusub"/></div>

            <?php
            }
            ?>
        </form>
        <script type="text/javascript">
            chooseDate('fyrq', true);
        </script>
    </div>
</div>
</body>
</html>
