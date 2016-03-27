<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET["id"];
$html_title="新增医学评估报告";
include('spap_head.php');

//获得患者的疾病类型，做医学评估项的条件

$ub=mysql_query("select shqbzh from hzh where id =$id ");
$ubb = mysql_fetch_assoc($ub);
$shqlx=$ubb['shqbzh'];
?>
<div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
        <div class="thislink">当前位置：<a href="shqgl.php">申请管理</a> > <?php echo $html_title;?></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong><?php echo $html_title;?></strong><span></span>
            </div>
            <form action="yxpgbgxzac.php" method="post">
                <input id="id" name="hzhid" type="hidden" value="<?php echo $id;?>" />
                <div class="incontact w955 flt">
                    <table width="110%" border="0" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td>该患者诊断为：</td>
                                <td>
                                    <label>既往</label>
                                    <select name="bying">
                                        <option value="">--请选择--</option>
                                        <option value="细胞因子">细胞因子</option>
                                        <option value="酪氨酸激酶抑制剂">酪氨酸激酶抑制剂</option>
                                     </select>
                                    <select name="xbzlsb" onchange="jbfz()" id="jbfzs">
                                        <option value="疾病进展" >疾病进展</option>
                                        <option value="不能耐受" >不能耐受</option>
                                    </select>
                                    <label>原因：</label><input type="text" name="xbzlsbkaos" >
                                    <label>所用药物名称：</label><input type="text" name="yaoname" >
                                    <label>治疗时间：</label><input type="text" name="zhiliaotime" id="zl1" readonly ><br>
                                </td>
                            </tr>
                            <tr>
                                <td>英立达开始治疗时间：</td>
                                <td>
                                    <input id="zhdrq" name="starttime" type="text" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>英立达治疗RECIST评估：</td>
                                <td>
                                    <select name="yldpg" id="pd">
                                        <option value="CR" >CR</option>
                                        <option value="PR" >PR</option>
                                        <option value="SD" >SD</option>
                                        <option value="PD" >PD</option>
                                    </select>
                                </td>
                            </tr>
<!--                             <tr> -->
<!--                                 <td>是否愿意接受辉瑞公司随访：</td> -->
<!--                                 <td> -->
<!--                                     <input type="radio" name="yldsf" value="1" >是 <input type="radio" name="yldsf" value="2" >否 -->
<!--                                     <label>评估时间：</label><input id="pgtime2" name="pgtime" type="text" readonly> -->
<!--                                 </td> -->
<!--                             </tr> -->
                            <tr>
                                <td>是否继续服用英立达：</td>
                                <td>
                                    <input type="radio" name="sfyld" value="1" >是
                                    <input type="radio" name="sfyld" value="2" >否
                                </td>
                            </tr>
                            <tr>
                                <td>该患者的诊断为：</td>
                                <td>
                                    <input type="checkbox" name="docmes" value="1" >既往接受过一种酪氨酸激酶抑制剂或细胞因子治疗失败的进展期肾细胞癌（RCC）的成人患者
                                </td>
                            </tr>
                            <tr>
                                <td>该患者是否符合入组医学标准：</td>
                                <td>
                                    <input type="radio" name="fuhe" value="符合" >符合
                                    <input type="radio" name="fuhe" value="不符合" >不符合
                                </td>
                            </tr>
<!--                             <tr> -->
<!--                                 <td>指定医生/授权医生签字：</td> -->
<!--                                 <td> -->
<!--                                     <input type="text" name="docname" > -->
<!--                                 </td> -->
<!--                             </tr> -->
                            <tr>
                                <td>本次就诊和填表日期：</td>
                                <td>
                                    <input id="quetime" name="start_time" readonly type="text" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btnPos">
                        <input id="btnSave" type="submit" value="保存" class="lgSub" />
                        <input id="btnReturn" type="button" value="返回" class="lgSub" />
                    </div>
                    
                </div>
            </form>
        </div>
    </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>

<script type="text/javascript">
chooseDate('zl1', true);
chooseDate('zl2', true);
chooseDate('zhdrq', true);
chooseDate('pgtime2', true);
chooseDate('quetime', true);
//返回按钮
$("#btnReturn").bind("click", function () {
    var returnUrl = '';
    if (returnUrl == "") {
        history.go(-1);
    }
});
</script>