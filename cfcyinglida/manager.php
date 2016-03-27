<?php session_start();
@header('Content-type: text/html;charset=utf-8');
$xpapqx = 5;//设置协管员可以查看的页面
include('newdb.php');
$html_manager = 1;
$html_title = "系统首页";
include('spap_head.php');
?>
<div class="main">
<div class="insmain">
<div class="thislink">当前位置：<a href="/manager.php">管理首页</a></div>
<div class="inwrap flt top">


<?php
if ($_SESSION[yhshf] == '10') {
    ?>
    <!--div class="position">
        系统管理员首页</div>
        <a href=""><div>辉瑞统计</div></a>
        <a href=""><div>审核批准记录表</div></a-->

    <div class="title w977 flt top">
        <strong>系统基础信息维护</strong><span></span>
    </div>
    <div class="incontact w955 flt">
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="zhdyygl.php" title="医院医生管理">医院医生..</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="zhdyfgl.php" title="药房药师管理">药房药师..</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="bfdqzyshlgl.php" title="部分地区赠药数量管理">部分地区..</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yhgl.php" title="用户管理">用户管理</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xtggxx.php" title="系统公告">系统公告</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="qhyfshf.php" title="切换药房身份">切换药房...</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yxyplist.php" title="一线药品">一线药品</a></div>
        </div>
    </div>
<?php
}
if ($_SESSION[yhshf] == '5' || $_SESSION[yhshf] == '10') {
    ?>
    <div class="title w977 flt top">
        <strong>协管员操作</strong><span></span>
    </div>
    <div class="incontact w955 flt">
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyshqgl.php" title="患者申请">患者申请</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyhzhyshdcpdf.php" title="按医生患者申请">按医生患者申请</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyzhdyyysh.php" title="医生信息查询及申请资料夹">医生信息查询及申请资料夹</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgydfqdgl.php" title="待发清单">待发清单</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyfygl.php" title="药品发放明细">药品发放明细</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyzyshdgl.php" title="赠药收到管理">赠药收到管理</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgychrkgl.php" title="出入库统计">出入库统计</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgykcpdgl.php" title="库存盘点">库存盘点</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyyfdbgl.php" title="药房调拨">药房调拨</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgykpjhgl.php" title="空药盒回收">空药盒回收</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="xgyyyjhgl.php" title="剩余药物交回明细">剩余药物交回明细</a></div>
        </div>
    </div>
<?php
}
if ($_SESSION[yhshf] == '10' || $_SESSION[yhshf] == '2') {
    ?>
    <div class="title w977 flt top">
        <strong>CFC管理员操作</strong><span></span>
    </div>
    <div class="incontact w955 flt">
    <?php
    if (in_array('blshjbggl_ck', $_SESSION[yhqxxf]) || in_array('sfjlgl_ck', $_SESSION[yhqxxf]) || in_array('wshyygl_ck', $_SESSION[yhqxxf]) || in_array('zhdyfgl_ck', $_SESSION[yhqxxf]) || in_array('zhdyygl_ck', $_SESSION[yhqxxf]) || in_array('zhzhgl_ck', $_SESSION[yhqxxf]) || in_array('shqgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll' || $_SESSION[yhshf] == '5') {
        ?>
        <?php
        if (in_array('shqgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="shqgl.php" title="申请管理">申请管理</a></div>
            </div>
        <?php
        }

        if (in_array('zhzhgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="zhzhshqgl.php" title="转诊管理">转诊管理</a></div>
            </div>
        <?php
        }

        if (in_array('zhdyygl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcyyyshchx.php" title="指定医院医生管理">指定医院..</a></div>
            </div>
        <?php
        }

        if (in_array('zhdyfgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcyfchx.php" title="指定药房药师管理">指定药房..</a></div>
            </div>
        <?php
        }

        if (in_array('wshyygl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="wshshqgl.php" title="网上预约管理">网上预约..</a></div>
            </div>
        <?php
        }

        if (in_array('sfjlgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcsfjlgl.php" title="随访记录管理">随访记录..</a></div>
            </div>
        <?php
        }

        if (in_array('blshjbggl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="blshjgl.php" title="不良事件报告管理">不良事件..</a></div>
            </div>
        <?php
        }

        if ($_SESSION['yhln'] == "admin" || $_SESSION['yhln'] == "cfcadmin") {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcyhgl.php" title="CFC用户权限管理">CFC用户..</a></div>
            </div>
        <?php
        }
        ?>



    <?php
    }

    if (in_array('shyywxhgl_xh', $_SESSION[yhqxxf]) || in_array('kypxhgl_xh', $_SESSION[yhqxxf]) || in_array('shyywjhmx_ck', $_SESSION[yhqxxf]) || in_array('kypjhgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
        ?>


        <?php
        if (in_array('kypjhgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfckpjhgl.php" title="空药盒回收">空药盒交..</a></div>
            </div>
        <?php
        }

        if (in_array('shyywjhmx_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <!--div class="infowraps">
                        <div class="topico"><img src="./images/icon01.gif" /></div>
                        <div class="istext"><a href="cfcyyjhgl.php" title="剩余药物交回明细">剩余药物..</a></div>
                      </div-->
        <?php
        }

        if (in_array('kypxhgl_xh', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <!--div class="infowraps">
                        <div class="topico"><img src="./images/icon01.gif" /></div>
                        <div class="istext"><a href="cfckpjhxhgl.php" title="空药瓶销毁管理">空药瓶销..</a></div>
                      </div-->
        <?php
        }

        if (in_array('shyywxhgl_xh', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <!--div class="infowraps">
                        <div class="topico"><img src="./images/icon01.gif" /></div>
                        <div class="istext"><a href="cfcyyjhxhgl.php" title="剩余药物销毁管理">剩余药物..</a></div>
                      </div-->
        <?php
        }
        ?>

    <?php
    }

    if (in_array('dfqdgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
        ?>


        <?php
        if (in_array('dfqdgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcdfqdgl.php" title="待发清单管理">待发清单..</a></div>
            </div>
        <?php
        }

        if (in_array('ypffgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcfygl.php" title="药品发放记录管理">药品发放..</a></div>
            </div>
        <?php
        }

        if (in_array('ypyc_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcyshypyc.php" title="药品预测">药品预测</a></div>
            </div>
        <?php
        }
        ?>




    <?php
    }

    if (in_array('ztyfgl_ck', $_SESSION[yhqxxf]) || in_array('yfdbgl_ck', $_SESSION[yhqxxf]) || in_array('chrktj_ck', $_SESSION[yhqxxf]) || in_array('yfzyshdgl_ck', $_SESSION[yhqxxf]) || in_array('yfzyshqgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
        ?>


        <?php
        if (in_array('yfzyshqgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfczyshqgl.php" title="药品申请管理">药品申请..</a></div>
            </div>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcywyshshqgl.php" title="药房运输申请管理">药房运输..</a></div>
            </div>
        <?php
        }

        if (in_array('yfzyshdgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfczyshdgl.php" title="药房赠药收到管理">药房赠药..</a></div>
            </div>
        <?php
        }

        if (in_array('chrktj_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcchrkgl.php" title="出入库统计">出入库统..</a></div>
            </div>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfckcpdgl.php" title="库存盘点">库存盘点</a></div>
            </div>
        <?php
        }

        if (in_array('yfdbgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="yfdbgl.php" title="药房调拨">药房调拨</a></div>
            </div>
        <?php
        }

        if (in_array('ztyfgl_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcztfyyfgl.php" title="暂停药房管理">暂停药房..</a></div>
            </div>
        <?php
        }
        ?>


    <?php
    }
    ?>
    <?php
    if (in_array('jjhybypfpmx_ck', $_SESSION[yhqxxf]) || in_array('jdbgtj_ck', $_SESSION[yhqxxf]) || in_array('ydbgtj_ck', $_SESSION[yhqxxf]) || in_array('xmshshxxtj_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
        ?>

        <?php
        if (in_array('xmshshxxtj_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcxmshshxxtj.php" title="项目实时信息统计">项目实时..</a></div>
            </div>
        <?php
        }
        if (in_array('xpapxmxxdch_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcxpap.php" title="SPAP项目信息导出">SPAP项目..</a></div>
            </div>
        <?php
        }
        if (in_array('ydbgtj_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcydgzbg.php" title="月度报告统计">月度报告..</a></div>
            </div>
        <?php
        }

        if (in_array('jdbgtj_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcjdbgshj.php" title="季度报告统计">季度报告..</a></div>
            </div>
        <?php
        }

        if (in_array('jjhybypfpmx_ck', $_SESSION[yhqxxf]) || $_SESSION[yhshf] == '10' || $_SESSION[yhqxxf][0] == 'admin_AllowAll') {
            ?>
            <div class="infowraps">
                <div class="topico"><img src="./images/icon01.gif"/></div>
                <div class="istext"><a href="cfcyuefp.php" title="基金会月报药品分配明细">基金会月..</a></div>
            </div><?php
        }

        ?>


    <?php
    }
    ?>
    <div class="infowraps">
        <div class="topico"><img src="./images/icon01.gif"/></div>
        <div class="istext"><a href="hrfpgl.php" title="辉瑞发票管理">辉瑞发票..</a></div>
    </div>
    <div class="infowraps">
        <div class="topico"><img src="./images/icon01.gif"/></div>
        <div class="istext"><a href="cfcyppsgl.php" title="药品破损管理">药品破损..</a></div>
    </div>
    <div class="infowraps">
        <div class="topico"><img src="./images/icon01.gif"/></div>
        <div class="istext"><a href="kfkcpdhfgl.php" title="暂停库存盘点恢复">暂停库存..</a></div>
    </div>

    <!--数据导入开始-->
    <?php
    if ($_SESSION[yhln] == 'guobaocun') {
        ?>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="shjdr.php" title="数据导入">数据导入</a></div>
        </div>
    <?php
    }
    ?>
    <!--数据导入结束-->
    </div>
<?php
}
if ($_SESSION[yhshf] == '3') {
    ?>
    <div class="title w977 flt top">
        <strong>赠药发放</strong><span></span>
    </div>
    <div class="incontact w955 flt">
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yshdfqdgl.php" title="药品发放">药品发放</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yshfygl.php" title="药品发放流向">药品发放流向</a></div>
        </div>
    </div>
    <div class="title w977 flt top">
        <strong>赠药申请</strong><span></span>
    </div>
    <div class="incontact w955 flt">
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yshzyshdgl.php" title="药品申请">药品申请</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yfdbgl.php" title="药房调拨">药房调拨</a></div>
        </div><?php /*管理列表*/ ?>
    </div>
    <div class="title w977 flt top">
        <strong>空药瓶、剩余药物回收</strong><span></span>
    </div>
    <div class="incontact w955 flt">
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="kpyyhshgl.php" title="新增空药瓶、余药记录">新增空药瓶、余药记录</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="kpjhgl.php" title="空药盒回收">空药盒回收</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yyjhgl.php" title="药品归还">药品归还</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yshkcpdgl.php" title="库存盘点">库存盘点</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yshchrkgl.php" title="出入库统计">出入库统计</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="yppsgl.php" title="药品破损">药品破损</a></div>
        </div>

    </div>
<?php
}
if ($_SESSION[yhshf] == '10' || $_SESSION[yhshf] == '1') {
    ?>

    <div class="title w977 flt top">
        <strong>库管操作</strong><span></span>
    </div>
    <div class="incontact w955 flt">
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="kfrkgl.php" title="入库管理">入库管理</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="kfchkgl.php" title="出库管理">出库管理</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="kfchrkgl.php" title="出入库统计">出入库统..</a></div>
        </div>
        <div class="infowraps">
            <div class="topico"><img src="./images/icon01.gif"/></div>
            <div class="istext"><a href="kfkcpdgl.php" title="库存盘点">库存盘点</a></div>
        </div>
    </div>
<?php
}
?>
<style>
    .mindess {
        width: 666px;
        font-size: 12px;
        height: auto;
        /*scrolling:auto;
        overflow:auto;
        overflow-x:hidden;*/
        position: fixed;
        z-index: 100;
        left: 50%;
        margin: 0 auto 0 -343px; /* margin-left需要是宽度的一半 */
        top: 30%;
        padding: 1px;
        background: #25679c;
        border: 1px #25679c solid;
    }</style>

<!--
  <div class="mindess" id="gonggao" style="display:<?php if ($_SESSION[logintrue] == '1') {
    echo "none";
} else {
    echo "inline";
} ?>;">
	<div style="position:absolute; right:15px;"><a style="color:#FFFFFF; cursor:pointer;" onclick="gbgonggao()">关闭</a></div><div style="background:#ffffff; height:300px; scrolling:auto; overflow:auto; overflow-x:hidden; margin-top:30px; padding:10px; font-size:14px;"><p style="padding-bottom:5px; border-bottom:1px #efefef solid; margin-bottom:5px;">欢迎您登陆！<?php
$xtggxxsql = "select id from `xtggxx` where `ggzht`='1' and `tshgn`='1'";
$xtggxxQuery_ID = mysql_query($xtggxxsql);
while ($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)) {
    $xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
}
if ($_SESSION[yhshf] == '3' || $_SESSION[yhshf] == '1') {
    $ri = date('d');
    $yuri = date('d', strtotime(date('Y-m') . "+1 month -1 day"));
    if (($ri >= 1 && $ri <= 5) || $ri == $yuri) {
        $shfchfsql = "select * from `kfkcpd` where `dzhny`='$dzhny' and `dwmch`='$dwmch'";
        $shfchfq = mysql_query($shfchfsql);
        $shfchf = mysql_num_rows($shfchfq);
        if ($shfchf == 0) {
            ?><b style="color:red;">该盘点了!</b><?php
        }
    }
}
if ($xtggxx == '1') {
    ?><b style="color:red;">管理员开放盘点权限!</b><?php
}
?></p>
<?php
$xtggxxnrsql = "select * from `xtggxx` where `ggzht`='1' and `tshgn`='0' order by ggrq DESC";
$xtggxxnrQuery_ID = mysql_query($xtggxxnrsql);
while ($xtggxxnrRecord = mysql_fetch_array($xtggxxnrQuery_ID)) {
    $pdhh = array("\r\n", "\n", "\r");
    $xtggnr = str_replace($pdhh, "</br>", $xtggxxnrRecord[2]);
    $zdqxstring = $xtggxxnrRecord[3];
    $zdqxarr = explode(',', $zdqxstring);
    if ($_SESSION[yhshf] == '10' || $_SESSION[yhshf] == '1' || $_SESSION[yhshf] == '2' || in_array($_SESSION[yhshf], $zdqxarr)) {
        ?>
<p style="color:red;">系统公告:</p><p style="border-bottom:1px #efefef solid; padding-bottom:5px; margin-bottom:5px;"><?php echo $xtggxxnrRecord[4] . " <b>" . $xtggxxnrRecord[1] . "</b></br>" . $xtggnr . "</br>";/*.$xtggxxnrRecord[7]*/ ?></p>

<?php }
}
$_SESSION[logintrue] = '1'; ?>
</div>
</div>
-->

<script type="text/javascript">
    function gbgonggao() {
        document.getElementById('gonggao').style.display = 'none';
    }
</script>
</div>
</div>
</body>
</html>
