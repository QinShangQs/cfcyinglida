<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$id=$_GET["id"];
$html_title="修改医学评估报告";
include('spap_head.php');
include("wdb.php");
$db = new DB();
$arr = $db->getRow('select * from yxtjpg_new where id = '.$id);
?>
<div class="title w977 flt top">
    <strong>修改医学条件评估</strong><span></span>
</div>
<div class="incontact w955 flt">
<form action="yxpgbgsfxgac.php" method="post">
    <table width="135%" border="1" cellspacing="0" cellpadding="5">
        <tbody>
            <tr>
                <td>该患者诊断为：<input type="hidden" name="id" value="<?php echo $id; ?>"/><input type="hidden" name="hzhid" value="<?php echo $arr['hzhid']; ?>"/></td>
                <td>
                    <label>既往</label>
                    <select name="bying">
                        <option value="细胞因子" <?php if($arr['bying'] == '细胞因子') echo 'selected'; ?>>细胞因子</option>
                        <option value="酪氨酸激酶抑制剂" <?php if($arr['bying'] == '酪氨酸激酶抑制剂') echo 'selected'; ?>>酪氨酸激酶抑制剂</option>
                    </select>
                    <select name="xbzlsb" onchange="jbfz()" id="jbfzs">
<!--                        <option value="疾病进展" --><?php //if($arr['xbyzzlsb'] == '疾病进展') echo 'selected'; ?><!-->疾病进展</option>-->
                        <option value="不能耐受" <?php if($arr['xbyzzlsb'] == '不能耐受') echo 'selected'; ?>>不能耐受</option>
                    </select>
                    <label>原因：</label><input type="text" name="xbzlsbkaos" value="<?php if(!empty($arr['yuanyin'])) echo $arr['yuanyin']; ?>">
                    <label>所用药物名称：</label><input type="text" name="yaoname" value="<?php if(!empty($arr['ypname'])) echo $arr['ypname']; ?>">
                    <label>治疗时间：</label><input type="text" name="zhiliaotime" id="zl1" readonly value="<?php if(!empty($arr['zltime'])) echo $arr['zltime']; ?>"><br>
                </td>
            </tr>
            <tr>
                <td>英立达开始治疗时间：</td>
                <td>
                    <input id="zhdrq" name="starttime" type="text" value="<?php if(!empty($arr['yldstarttime'])) echo $arr['yldstarttime']; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>英立达治疗RECIST评估：</td>
                <td>
                    <select name="yldpg" id="pd">
                        <option value="CR" <?php if($arr['yldrpg'] == 'CR') echo 'selected'; ?>>CR</option>
                        <option value="PR" <?php if($arr['yldrpg'] == 'PR') echo 'selected'; ?>>PR</option>
                        <option value="SD" <?php if($arr['yldrpg'] == 'SD') echo 'selected'; ?>>SD</option>
                        <option value="PD" <?php if($arr['yldrpg'] == 'PD') echo 'selected'; ?>>PD</option>
                    </select>
                </td>
            </tr>
<!--             <tr> -->
<!--                 <td>是否愿意接受辉瑞公司随访：</td> -->
<!--                 <td> -->
<!--                    <input type="radio" name="yldsf" value="1" <?php if($arr['pdjssf'] == 1) echo 'checked'; ?>>是 <input type="radio" name="yldsf" value="2" <?php if($arr['pdjssf'] == 2) echo 'checked'; ?>>否 -->
<!--                    <label>评估时间：</label><input id="pgtime2" name="pgtime" type="text" value="<?php if(!empty($arr['pgtime'])) echo $arr['pgtime']; ?>" readonly> -->
<!--                 </td> -->
<!--             </tr> -->
            <tr>
                <td>是否继续服用英立达：</td>
                <td>
                    <input type="radio" name="sfyld" value="1" <?php if($arr['isfjxyxd'] == 1) echo 'checked'; ?>>是
                    <input type="radio" name="sfyld" value="2" <?php if($arr['isfjxyxd'] == 2) echo 'checked'; ?>>否
                </td>
            </tr>
            <tr>
                <td>该患者的诊断为：</td>
                <td>
                    <input type="checkbox" name="docmes" value="1" <?php if($arr['patzdrcc'] == 1) echo 'checked'; ?>>既往接受过一种酪氨酸激酶抑制剂或细胞因子治疗失败的进展期肾细胞癌（RCC）的成人患者
                </td>
            </tr>
            <tr>
                <td>该患者是否符合入组医学标准：</td>
                <td>
                    <input type="radio" name="fuhe" value="符合" <?php if($arr['isrz'] == '符合') echo 'checked'; ?>>符合
                    <input type="radio" name="fuhe" value="不符合" <?php if($arr['isrz'] == '不符合') echo 'checked'; ?>>不符合
                </td>
            </tr>
<!--             <tr> -->
<!--                 <td>指定医生/授权医生签字：</td> -->
<!--                 <td> -->
<!--                    <input type="text" name="docname" value="<?php if(!empty($arr['docname'])) echo $arr['docname']; ?>"> -->
<!--                 </td> -->
<!--             </tr> -->
            <tr>
                <td>本次就诊和填表日期：</td>
                <td>
                    <input id="quetime" name="start_time" readonly type="text" value="<?php if(!empty($arr['bctime'])) echo $arr['bctime']; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="incontact w955 flt">
        <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
    </div>
</form>
</div>
  
<?php /*主框大div[wrap]结束*/?>
</body>
</html>

<script type="text/javascript">
    chooseDate('zl1', true);
    chooseDate('zl2', true);
    chooseDate('zhdrq', true);
    chooseDate('pgtime2', true);
    chooseDate('quetime', true);
</script>
