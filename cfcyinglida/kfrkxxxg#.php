<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$rkid = $_GET['id'];
$html_title="修改入库信息";
include('spap_head.php');
?>
    <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<a href="cfcdfqdgl.php"><?php echo $html_title;?></a></div>
    
        <form action="kfrkxxxgac.php" method="post">
<?php        
  $sql = "select * from `kfrk` where `id`='".$rkid."'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
      <input id="rkid" name="rkid" type="hidden" value="<?php echo $rkid;?>" />

          <br />
          <table class="addTable">
           <tr>
              <td>
                <span class="label">批号:</span>
             </td>
             <td>
                <input class="input addInput" id="ZengyaoPihao" name="ZengyaoPihao" type="text" value="<?php echo $Record[1];?>" />
             </td>
           
           
              <td>
               <span class="label">中文名称:</span>
             </td>
             <td colspan="3">
               <input class="input addInputL" id="ZhongwenMingcheng" name="ZhongwenMingcheng" type="text" value="<?php echo $Record[3];?>" />
             </td>
           </tr>
          <tr>
             <td>
               <span class="label">有效期至:</span>
             </td>
              <td>
                <input class="input addInput" id="YouxiaoqiZhi" name="YouxiaoqiZhi" readonly="readonly" type="text" value="<?php echo $Record[2];?>" />
             </td>
             <td>
               <span class="label">英文名称:</span>
             </td>
             
             <td colspan="3">
             <input class="input addInputL" id="YingwenMingcheng" name="YingwenMingcheng" type="text" value="<?php echo $Record[4];?>" />
             </td>
           </tr>
           <tr>
             <td>
              <span class="label">检品编号:</span>
             </td>
              <td>
               <input class="input addInput" id="JianpinBianhao" name="JianpinBianhao" type="text" value="<?php echo $Record[7];?>" />
             </td>
             
             <td>
             <span class="label">生产单位/产地:</span>
             </td>
             <td colspan="3">
              <input class="input addInputL" id="ShengchanDanweiChandi" name="ShengchanDanweiChandi" type="text" value="<?php echo $Record[8];?>" />
             </td>
           </tr>
           <tr>
             <td>
             <span class="label">入库日期:</span>
             </td>
              <td>
              <input class="input addInput" id="ShouyangRiqi" name="ShouyangRiqi" readonly="readonly" type="text" value="<?php echo $Record[9];?>" />
             </td>
             <td>
             <span class="label">报检单位:</span>
             </td>
             <td colspan="3">
             <input class="input addInputL" id="Baojiandanwei" name="Baojiandanwei" type="text" value="<?php echo $Record[5];?>" />
             </td>
           </tr>
           <tr>
             <td>
             <span class="label">注册证号:</span>
             </td>
              <td>
             <input class="input addInput" id="ZhuceZhenghao" name="ZhuceZhenghao" type="text" value="<?php echo $Record[10];?>" />
             </td>
             <td>
             <span class="label">检验目的:</span>
             </td>
             <td colspan="3">
             <input class="input addInputL" id="jianyanMudi" name="jianyanMudi" type="text" value="<?php echo $Record[11];?>" />
             </td>
           </tr>
           <tr>
             <td>
             <span class="label">入库数量:</span>
             </td>
             <td>
              <input class="input addInput" id="BaojianShuliang" name="BaojianShuliang" type="text" value="<?php echo $Record[12];?>" />瓶
             </td>
             <td>
             <span class="label">规格:</span>
             </td>
             <td>
             <input class="input addInput" id="Guige" name="Guige" type="text" value="<?php echo $Record[13];?>" />
             </td>
              <td>
             <span class="label">剂型/型号:</span>
             </td>
             <td>
             <input class="input addInput" id="JixingXinghao" name="JixingXinghao" type="text" value="<?php echo $Record[14];?>" />
             </td>
           </tr>
           <tr>
             <td>
             <span class="label">批件号:</span>
             </td>
             <td>
             <input class="input addInput" id="PijianHao" name="PijianHao" type="text" value="<?php echo $Record[15];?>" />
             </td>
             <td>
             <span class="label">合同号:</span>
             </td>
             <td>
             <input class="input addInput" id="HetongHao" name="HetongHao" type="text" value="<?php echo $Record[16];?>" />
             </td>
              <td>
             <span class="label">包装规格:</span>
             </td>
             <td>
             <input class="input addInput" id="BaozhuangGuige" name="BaozhuangGuige" type="text" value="<?php echo $Record[17];?>" />
             </td>
           </tr>
           <tr>
            <td>
             
             <span class="label">状态:</span></td>
             <td><input <?php if($Record[6]=="1"){echo "checked=\"true\"";}?> name="Zuofei" type="radio" value="1"></input><label for="Zuofei">生效</label> <input <?php if($Record[6]=="0"){echo "checked=\"true\"";}?> id="Zuofei" name="Zuofei" type="radio" value="0"></input><label for="Zuofei">作废</label>
            </td>
           </tr>
          </table>
          
        <div>
            <input type="submit" value="保存" class="lgSub" style="text-align: center"/></div>
<?php
}
?>
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
