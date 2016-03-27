<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$html_title="特殊情况修改赠药数量";
include('spap_head.php');
?>
     <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div>
    <div class="form">
        <form action="tshqkxgzyshlac.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <div>
            <span class="label">当前赠药数量：</span>
<?php    
    $hzhsql = "select `jzhshl` from `hzh` where `id` = '".$id."'";

    $hzhQuery_ID = mysql_query($hzhsql);
    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){echo $hzhRecord[0];}
?> 
瓶
        </div>
        <div>
            <span class="label">变更赠药数量：</span><input class="input addInput" id="zyshl" name="zyshl" type="text" value="" />瓶
        </div>        
        <div class="btnPos">
            <input type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
        </form>
    </div>

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
