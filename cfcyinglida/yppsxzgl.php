<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw = $_SESSION[gldw];
$yhln = $_SESSION[yhln];
$html_title="药品破损信息新增";
include('spap_head.php');

$yftmsql = "select `yfzhdysh` from `yf` where `yfmch`='".$yhgldw."'";
$yftmQuery_ID = mysql_query($yftmsql);
while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfzhdysh=$yftmRecord[0];}

?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置：<a href="yppsxzgl.php"><?php echo $html_title;?></a> </div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong><a href="yppsxzgl.php"><?php echo $html_title;?></a></strong><span></span>
            </div>
            <div class="incontact w955 flt">
                <div class="top">
                    <form action="yypsxzac.php" method="post">
                        <div class="top">
                            <span class="label">药房名称：</span>
                            <input class="grd-white" name="yfmch" style="width: 460px;" type="text" readonly="readonly" value="<?php echo $yhgldw; ?>">
                        </div>
                        <div class="top">
                            <span class="label">药师名称：</span>
                            <input class="grd-white" name="yfzhdysh" style="width: 460px;" type="text" readonly="readonly" value="<?php echo $yfzhdysh; ?>">
                        </div>
                        <div class="top">
                            <span class="label">规格：</span>
                            <select id="ypggid" name="ypgg" class="grd-white">
                                <option value ="1mg">1mg</option>
                                <option value ="5mg">5mg</option>
                            </select>
                        </div>
                        <div class="top">                        	
                        	 <span class="label">批号:</span>
                        	 <select id="ph1" class="grd-white2" name="pihao" style="width:260px;"></select>
                        </div>
                        <div class="top">
                            <span class="label">破损盒数：</span>
                            <input class="grd-white" name="pshsh" style="width: 460px;" type="text" value="" /></div>
                        <div class="top">
                            <input type="submit" class="uusub" value="保存" />
                            <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div id="d5mg" style="display:none">
    	 <option value="未知批号">未知批号</option>
    		 <?php
                            $ph1sql = "select id,ph from `kfrk` where `gg` like'5mg%'";

                            $ph1Query_ID = mysql_query($ph1sql);
                            while ($ph1Record = mysql_fetch_array($ph1Query_ID)) {
                                ?>
                                <option value="<?php echo $ph1Record['0']; ?>"><?php echo $ph1Record['1']; ?></option>
                            <?php
                            }
                            ?>
    </div>
    <div id="d1mg"  style="display:none">
    <option value="未知批号">未知批号</option>
    		 <?php
                            $ph1sql = "select id,ph from `kfrk` where `gg` like'1mg%'";

                            $ph1Query_ID = mysql_query($ph1sql);
                            while ($ph1Record = mysql_fetch_array($ph1Query_ID)) {
                                ?>
                                <option value="<?php echo $ph1Record['0']; ?>"><?php echo $ph1Record['1']; ?></option>
                            <?php
                            }
                            ?></select>
    </div>
    <script type="text/javascript">
		
		$(document).ready(function(){
			$("#ph1").empty().append($("#d1mg").html());
			$("#ypggid").change(function(){
				if($(this).val() == '1mg'){
					$("#ph1").empty().append($("#d1mg").html());
				}else{
					$("#ph1").empty().append($("#d5mg").html());
				}
			});
		});
	</script>
    </body>
    </html>