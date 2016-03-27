<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$html_title="特殊情况修改入组医院";
include('xpap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <?php echo $html_title;?></div>
    <div class="form">
        <form action="tshqkxgrzyyac.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <div>
            <span class="label">当前入组医院：</span><select id="jzhzhdysh" name="jzhzhdysh" style="width: 500px;">
                
<?php    
    $hzhsql = "select * from `hzh` where `id` = '".$id."'";

    $hzhQuery_ID = mysql_query($hzhsql);
    while($hzhRecord = mysql_fetch_array($hzhQuery_ID)){
if($hzhRecord[11]!=""){$jzhyyid=$hzhRecord[11];}else{$jzhyyid=$hzhRecord[9];}
}
    $yysql = "select id,shengjx,sheng,yymch,zhdysh from `yyyshdq` where `id`='".$jzhyyid."'";

    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      echo "<option value=\"".$yyRecord[0]."\"> ".$yyRecord[1]." ".$yyRecord[2]." ".$yyRecord[3]." ".$yyRecord[4]."</option>";
    }
//echo $yysql ;
?> 
</select>
        </div>
        <div>
            <span class="label">变更入组医院：</span><select id="JiezhenYishengId" name="JiezhenYishengId" style="width: 500px;" onchange="lyyfnr()">
    <option value=""></option>
<?php        
    $yy2sql = "select id,shengjx,sheng,yymch,zhdysh from `yyyshdq` order by shengjx ASC";

    $yy2Query_ID = mysql_query($yy2sql);
    while($yy2Record = mysql_fetch_array($yy2Query_ID)){
    if($yy2Record[0]==$jzhyyid){}
      else{
        echo "<option value=\"".$yy2Record[0]."\"> ".$yy2Record[1]." ".$yy2Record[2]." ".$yy2Record[3]." ".$yy2Record[4]."</option>";
      }
    }
?> 
    
</select>
        </div>        
        <div class="btnPos">
            <input type="submit" value="保存" class="lgSub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="lgSub" /></div>
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
