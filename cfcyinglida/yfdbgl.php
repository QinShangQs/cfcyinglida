<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title = "药房调拨";
include('spap_head.php');
$yhgldw = $_SESSION[gldw];
$pagesize = 10;//每页显示的条数：

?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置： <?php echo $html_title; ?> </div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong>药房调拨</strong><?php if ($_SESSION[yhshf] == '2' || $_SESSION[yhshf] == '10') { ?><span><a
                        href="cfcxzdbgl.php">新增调拨</a></span><?php } ?>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                        <td width="7%" align="center" bgcolor="#FFFFFF">
                            状态
                        </td>
                        <td width="14%" align="center" bgcolor="#FFFFFF">
                            转出药房
                        </td>
                        <td width="14%" align="center" bgcolor="#FFFFFF">
                            转入药房
                        </td>
                        <td width="8%" align="center" bgcolor="#FFFFFF">
                            转出日期
                        </td>
                        <td width="8%" align="center" bgcolor="#FFFFFF">
                            签收日期
                        </td>
                        <td width="6%" align="center" bgcolor="#FFFFFF">
                            运单号
                        </td>
                        <td width="6%" align="center" bgcolor="#FFFFFF">
                            规格
                        </td>
                        <td width="8%" align="center" bgcolor="#FFFFFF">
                            数量
                        </td>
                        <td width="5%" align="center" bgcolor="#FFFFFF">
                            操作人
                        </td>
                        <td width="8%" align="center" bgcolor="#FFFFFF">
                            操作
                        </td>
                    </tr>
                    <?php
                    $sql = "select * from `yfdb`";
                    //echo $_SESSION[yhname];
                    if ($_SESSION[yhshf] == '2' || $_SESSION[yhshf] == '10') {
                        $yhshfyzh = 1;
                    } else if ($_SESSION[yhshf] == '3') {
                        $sql .= "where `fcyfid`='" . $yhgldw . "' or `fryfid`='" . $yhgldw . "'";
                        $yhshfyzh = 2;
                    }
//                    echo $sql;
                    $query = mysql_query($sql);
                    while ($Record = mysql_fetch_array($query)) {
                        ?>
                        <tr style="color:#1f4248; font-size:12px;">
                            <td align="center" bgcolor="#FFFFFF">
                                <?php if ($Record[3] == '0') {
                                    echo "调拨中";
                                } else if ($Record[3] == '1') {
                                    echo "调拨中";
                                } else if ($Record[3] == '2') {
                                    echo "已签收";
                                }?>
                            </td>
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[1]; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[2]; ?></td>

                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[6]; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[7]; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[8]; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[4]; ?></td>
                            <td align="center" bgcolor="#FFFFFF">
                                <?php
                                if ($Record[9] != '') {
                                    echo $Record[9] . '瓶';
                                }
                                ?>
                            </td>
                            <td align="center" bgcolor="#FFFFFF">
                                <?php
                                    echo $Record[10];
                                ?>
                            </td>
                            <td align="center" bgcolor="#FFFFFF">
                                <a href="yfdbglxq.php?id=<?php echo $Record[0]; ?>">详情</a>
                                <?php
                                if ($Record[1] == $yhgldw && $Record[3] == '0') {
                                    ?><a href="yfdbfygl.php?id=<?php echo $Record[0]; ?>">发运</a>
                                <?php
                                }
                                ?>
                                <?php
                                if ($Record[2] == $yhgldw && $Record[3] != '2') {
                                    ?><a href="yfdbshdgl.php?id=<?php echo $Record[0]; ?>">收到</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    $numq = mysql_query($sql);
                    $num = mysql_num_rows($numq);//获取总条数
                    $pagenum = ceil($num / $pagesize);

                    if ($_GET[page]) {
                        $pageval = $_GET[page];
                        $page = ($pageval - 1) * $pagesize;
                        $page .= ',';
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
</div>

</body>
</html>
