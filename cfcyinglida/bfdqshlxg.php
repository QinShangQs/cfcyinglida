<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$dqid=$_GET['id'];

$html_title="修改指定地区捐赠数量";
include('xpap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="bfdqzyshlgl.php">部分地区赠药数量管理</a>
        > <?php echo $html_title;?></div>
    <div class="form">
        <form action="bfdqshlxgac.php" method="post">
<?php        
  $sql = "select * from `cblxdq` where `id`='".$dqid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
        <input type="hidden" name="id" value="<?php echo $dqid;?>" />
        <div>
            <span class="label">药房所在城市：</span><input class="input addInput" id="sheng" name="sheng" style="width: 80px;" type="text" value="<?php echo $Record[1];?>" /> <input class="input addInput" id="shi" name="shi" style="width: 80px;" type="text" value="<?php echo $Record[2];?>" /> <input class="input addInput" id="qu" name="qu" style="width: 80px;" type="text" value="<?php if($Record[3]=="市、县级市"){echo "";}else{echo $Record[3];}?>" />
</div>
        <div>
            <span class="label">户籍类型：</span><select name="hj" id="hj" style="width: 660px;">
						  <option value="<?php echo $Record[5];?>"><?php echo $Record[5]."【当前】";?></option>
						  <option value="非农业户口">非农业户口</option>
						  <option value="农业户口">农业户口</option>
						</select>*</div>
        <div>
            <span class="label">医保类型：</span><select name="lx" id="lx" style="width: 660px;">
						  <option value="<?php echo $Record[4];?>"><?php echo $Record[4]."【当前】";?></option>
						  <option value="无">无</option>
						  <option value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
						  <option value="城镇居民医疗保险">城镇居民医疗保险</option>
						  <option value="新农合医疗保险">新农合医疗保险</option>
						  <option value="公费医疗">公费医疗</option>
						  <option value="现役军人医疗体系">现役军人医疗体系</option>
						</select>*</div>
        <div>
            <span class="label">捐赠数量：</span><input class="input addInput" id="shl" name="shl" type="text" value="<?php echo $Record[6];?>" /></div>
        <div>
            <span class="label">是否生效：</span><input <?php if($Record[8]=="1"){echo "checked=\"checked\"";}?> id="shfshx" name="shfshx" type="radio" value="1" /><label for="shfshx">启用</label> <input name="shfshx" <?php if($Record[8]=="0"){echo "checked=\"checked\"";}?> value="0"  type="radio" /><label for="shfshx">停用</label></div>
        <div>
            <span class="label">文件接收日期：</span><input class="input addInput" id="wjjshrq" name="wjjshrq" type="text" value="<?php echo $Record[9];?>" readonly /></div>
        <div>
            <span class="label">生效日期：</span><input class="input addInput" id="shxrq" name="shxrq" type="text" value="<?php echo $Record[10];?>"  readonly /></div>
        <div>
            <span class="label">停用日期：</span><input class="input addInput" id="tyrq" name="tyrq" type="text" value="<?php echo $Record[11];?>"  readonly /></div>
        <div>
            <span class="label">备注：</span><input class="input addInput" id="bzh" name="bzh" type="text" value="<?php echo $Record[7];?>" /></div>
<?php        
  }
?>
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
