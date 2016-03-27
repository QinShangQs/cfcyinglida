<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="XPAP项目信息导出";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
            
    <div class="thislink">当前位置：
        <?php echo $html_title;?></div>
<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong>XPAP项目信息导出</strong>
				</div>
				<div class="incontact w955 flt">
       
        <fieldset style="font-size: large; margin: 20px;">
            <legend>日期：<?php echo date('Y-m-d');?></legend>
            <div class="homePanelmini">
<a href="xpaphzhexcel.php"><div>XPAP患者信息导出</div></a>
<a href="cfcchshexcel.php"><div>按城市统计</div></a>
<a href="cfcyyexcel.php"><div>按医院统计</div></a>
<a href="cfcyshexcel.php"><div>按医生统计</div></a>
            </div>

    </fieldset>




            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
    <div id="footerCon">
        <div id="foot">
            <div id="footNav">
                <div>
                    <div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
