<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增指定地区捐赠数量";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href=""><?php echo $html_title;?></a> </div> 
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <div class="form">
        <form action="bfdqshlxzac.php" method="post">

        <div>
            <span class="label">参保地区：</span><select id="s_province" name="sheng" class="grd-white2"></select>&nbsp;&nbsp;
    <select class="grd-white2" id="s_city" name="shi" ></select>*
    <script class="grd-white2" src="js/area.js" type="text/javascript"></script>
    
    <script type="text/javascript" class="grd-white2">_init_area();</script>
<script type="text/javascript">
var Gid  = document.getElementById ;
var showArea = function(){
	Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + 	
	Gid('s_city').value + " - 县/区" + 
	Gid('s_county').value + "</h3>"
							}
Gid('s_county').setAttribute('onchange','showArea()');
</script>
</div>
        <div>
            <span class="label">户籍类型：</span><select name="hj" id="hj" style="width: 660px;" class="grd-white2">
						  <option value="非农业户口">非农业户口</option>
						  <option value="农业户口">农业户口</option>
						</select>*</div>
        <div>
            <span class="label">医保类型：</span><select name="lx" id="lx" style="width: 660px;" class="grd-white2">
						  <option value="无">无</option>
      <option value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
      <option value="城镇居民医疗保险">城镇居民医疗保险</option>
      <option value="新农合医疗保险">新农合医疗保险</option>
      <option value="公费医疗">公费医疗</option>
      <option value="现役军人医疗体系">现役军人医疗体系</option>
      <option value="贫困救助">贫困救助</option>
      <option value="商业医疗保险">商业医疗保险</option>
      <option value="全自费">全自费</option>
      <option value="其他社会保险">其他社会保险</option>
      <option value="其他">其他</option>
						</select>*</div>
        <div>
            <span class="label">是否生效：</span><input checked="checked" id="shfshx" name="shfshx" type="radio" value="1" /><label for="shfshx">启用</label> <input name="shfshx" value="0"  type="radio" /><label for="shfshx">停用</label></div>
        <div>
            <span class="label">文件接收日期：</span><input class="grd-white" id="wjjshrq" name="wjjshrq" type="text" value="" readonly /></div>
        <div>
            <span class="label">生效日期：</span><input class="grd-white" id="shxrq" name="shxrq" type="text" value=""  readonly /></div>
        <div>
            <span class="label">停用日期：</span><input class="grd-white" id="tyrq" name="tyrq" type="text" value=""  readonly /></div>
        <div>
            <span class="label">备注：</span><input class="grd-white" id="bzh" name="bzh" type="text" value="" /></div>
        <div class="btnPos">
            <input type="submit" value="保存" class="uusub" /></div>
        </form>
    </div>

            <div class="clearFoot noPrint">
            </div>
        </div>
    </div>
    <script type="text/javascript">
    chooseDate('wjjshrq', true);
    chooseDate('shxrq', true);
    chooseDate('tyrq', true);
    </script >
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
