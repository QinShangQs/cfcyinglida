<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$id=$_GET["id"];
include("wdb.php");
$db = new DB();
$html_title="医学评估报告详细";
include('spap_head.php');
$arr = $db->getRow('select * from yxtjpg_new where id='.$id);
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yxpgbgxx.php"><?php echo $html_title;?></a> </div>
			    <fieldset class="top">
			        <legend>医学条件评估</legend>
			        <table>
                    <tr>
                        <td>该患者诊断为:</td>
                        <td>既往<?php echo $arr['bying']; ?>(
                            <?php 
                                echo $arr['xbyzzlsb']; 
                                if(!empty($arr['yuanyin'])) {
                                    echo '&nbsp;原因：'.$arr['yuanyin'].'&nbsp;';
                                } 
                                echo "所用药物：".$arr['ypname'].'&nbsp;';
                                echo "治疗时间：".$arr['zltime'].'&nbsp;';
                                ?>)<br>
                        </td>
                    </tr>
                    <tr>
                        <td>英立达开始治疗时间：</td>
                        <td><?php echo $arr['yldstarttime']; ?></td>
                    </tr>
                    <tr>
                        <td>英立达治疗RECIST评估：</td>
                        <td>
                            <?php 
                                echo $arr['yldrpg'];
                                if($arr['pdjssf'] == 1) {
                                    echo '&nbsp; 愿意接受辉瑞公司随访 &nbsp;';
                                } else if($arr['pdjssf'] == 2) {
                                    echo '不愿意接受辉瑞公司随访 &nbsp;';
                                } else {
                                    echo '不愿意接受辉瑞公司随访 &nbsp;';
                                }
                                echo "评估时间：";
                                if(empty($arr['pgtime'])) {
                                    echo date('Y-m-d');
                                } else {
                                    echo $arr['pgtime'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>是否继续服用英立达：</td>
                        <td>
                            <?php
                                if($arr['isfjxyxd'] == 1) {
                                    echo '是';
                                } else if($arr['isfjxyxd'] == 2) {
                                    echo '否';
                                } else {
                                    echo '否';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>该患者的诊断为：</td>
                        <td>
                            <?php
                                if($arr['patzdrcc'] == 1) {
                                    echo '既往接受过一种酪氨酸激酶抑制剂或细胞因子治疗失败的进展期肾细胞癌（RCC）的成人患者';
                                } else {
                                    echo '空';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>该患者是否符合入组医学标准：</td>
                        <td>
                            <?php
                                if(!empty($arr['isrz'])) {
                                    echo $arr['isrz'];
                                } else {
                                    echo '不符合';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>指定医生/授权医生签字：</td>
                        <td>
                            <?php echo $arr['docname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>本次就诊和填表日期：</td>
                        <td><?php echo $arr['bctime']; ?></td>
                    </tr>
                </table>
                </fieldset>
            <div class="top">
                <input type="button" onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
            </div>
        </div>
    </div>
</body>
</html>
