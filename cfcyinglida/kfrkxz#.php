<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="新增入库";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div>
			
        <form action="kfrkxzac.php" method="post">
          <br />
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td  align="center" bgcolor="#FFFFFF">
                <span class="label">批号:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
                <input class="grd-white"  id="ZengyaoPihao" name="ZengyaoPihao" type="text" value="" />
             </td>
           
           
              <td align="center" bgcolor="#FFFFFF">
               <span class="label">中文名称:</span>
             </td>
             <td colspan="3" align="center" bgcolor="#FFFFFF">
               <input class="grd-white" id="ZhongwenMingcheng" name="ZhongwenMingcheng" type="text" value="索坦(苹果酸舒尼替尼胶囊)" />
             </td>
           </tr>
          <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td  align="center" bgcolor="#FFFFFF">
               <span class="label">有效期至:</span>
             </td>
              <td  align="center" bgcolor="#FFFFFF">
                <input class="grd-white" id="YouxiaoqiZhi" name="YouxiaoqiZhi" readonly="readonly" type="text" value="" />
             </td>
             <td  align="center" bgcolor="#FFFFFF">
               <span class="label">英文名称:</span>
             </td>
             
             <td colspan="3"  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="YingwenMingcheng" name="YingwenMingcheng" type="text" value="Sutent" />
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td align="center" bgcolor="#FFFFFF">
              <span class="label">检品编号:</span>
             </td>
              <td align="center" bgcolor="#FFFFFF">
               <input class="grd-white" id="JianpinBianhao" name="JianpinBianhao" type="text" value="" />
             </td>
             
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">生产单位/产地:</span>
             </td>
             <td colspan="3"  align="center" bgcolor="#FFFFFF">
              <input class="grd-white" id="ShengchanDanweiChandi" name="ShengchanDanweiChandi" type="text" value="Pfizer Italia S.r.l. 意大利" />
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">入库日期:</span>
             </td>
              <td  align="center" bgcolor="#FFFFFF">
              <input class="grd-white" id="ShouyangRiqi" name="ShouyangRiqi" readonly="readonly" type="text" value="<?php echo date('Y-m-d');?>" />
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">报检单位:</span>
             </td>
             <td colspan="3"  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="Baojiandanwei" name="Baojiandanwei" type="text" value="" />
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">注册证号:</span>
             </td>
              <td  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="ZhuceZhenghao" name="ZhuceZhenghao" type="text" value="" />
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">检验目的:</span>
             </td>
             <td colspan="3"  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="jianyanMudi" name="jianyanMudi" type="text" value="" />
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">入库数量:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
              <input class="grd-white" id="BaojianShuliang" name="BaojianShuliang" type="text" value="0" />瓶
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">规格:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="Guige" name="Guige" type="text" value="12.5mg*28粒/瓶" />
             </td>
              <td  align="center" bgcolor="#FFFFFF">
             <span class="label">剂型/型号:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="JixingXinghao" name="JixingXinghao" type="text" value="" />
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">批件号:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="PijianHao" name="PijianHao" type="text" value="" />
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <span class="label">合同号:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="HetongHao" name="HetongHao" type="text" value="" />
             </td>
              <td  align="center" bgcolor="#FFFFFF">
             <span class="label">包装规格:</span>
             </td>
             <td  align="center" bgcolor="#FFFFFF">
             <input class="grd-white" id="BaozhuangGuige" name="BaozhuangGuige" type="text" value="" />
             </td>
           </tr>
           <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td  align="center" bgcolor="#FFFFFF">
             
             <span class="label">状态:</span></td>
             <td colspan="5"  align="center" bgcolor="#FFFFFF"><input checked="true" name="Zuofei" type="radio" value="1"></input><label for="Zuofei">生效</label> <input id="Zuofei" name="Zuofei" type="radio" value="0"></input><label for="Zuofei">作废</label>
            </td>
           </tr>
          </table>
          
        <div>
            <input type="submit" value="保存" class="uusub" style="text-align: center"/></div>
        </form>
    
    <script type="text/javascript">
        $(function () {
            chooseDate('ShouyangRiqi');
            chooseDate('YouxiaoqiZhi');
        });
    </script>

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
