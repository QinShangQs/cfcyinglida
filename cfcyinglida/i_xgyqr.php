<?php
/**
 * 协管员确认页面
 * */
@header('Content-type: text/html;charset=utf-8');
include('spap_head.php');
include('wdb.php');
$db = new DB();
$hzhid = $_GET['id'];
if(empty($_POST)):
$sql = "select * from hzh where id = $hzhid";
$data = $db->getRow($sql);
?>
<h3>审核方式</h3><br/>
<table>
    <form action="" method="post">
    <tr>
        <td>核实方式</td>
        <td>
            <select name="heshifangshi">
                <option value="">-请选择-</option>
                <option value="面对面" <?php if($data['shfs'] == '面对面') echo 'selected';?>>面对面</option>
                <option value="信息(电话、短信、微信)等" <?php if($data['shfs'] == '信息(电话、短信、微信)等') echo 'selected';?>>信息(电话、短信、微信)等</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>医生未答复或延迟答复的原因</td>
        <td>
            <textarea rows="3" cols="20" name="bikaos"><?php if(!empty($data['bikaos'])) {echo $data['bikaos'];}?></textarea><br/>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" value="提交"/>
            <input type="button" value="返回" onclick="history.go(-1)"/>
        </td>
    </tr>
    </form>
</table>
<?php 
    else:
        $shfs = $_POST['heshifangshi'];
        $bikaos = $_POST['bikaos'];
        empty($shfs) && $db->returnError('核实方式为必填项', '返回', '/i_xgyqr.php?id='.$hzhid);
        $arr['shfs'] = $shfs;
        $arr['bikaos'] = $bikaos;
        $arr['shenhetime'] = date('Y-m-d', time());
        $true = $db->update('hzh', $arr, 'id='.$hzhid);
        //审核记录材料齐全
        $sql = "select * from clshh where hzhid = $hzhid";
        $arr = $db->getRow($sql);
        //社会调查是否为空
        $sql = "select * from shhdch where hzhid = $hzhid";
        $arr2 = $db->getRow($sql);
        if($arr2['shhyj'] == 1 && !empty($arr2)) {
            $db->update('hzh', ['shqzht' => '代办入组'], 'id='.$hzhid);
        }
        empty($true) && $db->returnError('提交失败', '返回', '/i_xgyqr.php?id='.$hzhid);
        $db->returnError('提交成功', '返回列表', '/xgyshqgl.php');
    endif;
?>