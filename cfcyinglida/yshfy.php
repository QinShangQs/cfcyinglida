<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="药品发放";
include('spap_head.php');
include('wdb.php');
$db = new DB();
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置：<a href="yshdfqdgl.php">待发清单</a> > <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong>发药内容</strong>
    </div>

    <div class="incontact w955 flt">

        <form action="yshfyac.php" method="post">
<?php
  $hzhid = $_GET['id'];
  $sql = "select * from `hzh` where `id`='$hzhid'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    $ygshcyyjshrqq=mysql_query("SELECT ygshcyyjshrq FROM `zyff` where `hzhid`='".$Record[0]."' order by `id` desc limit 0,1");
    while($ygshcyyjshrqs = mysql_fetch_array($ygshcyyjshrqq)){
    $ygshcyyjshrq=$ygshcyyjshrqs[0];}
    $hzhzjhm=$Record[5].$Record[6];
?>
        <div>
            患者病种:<?php echo $hzhshqbzh=$Record[7];?>&nbsp;捐助类型:<?php echo $hzhjzhlx=$Record[25];?>&nbsp;已领药<?php 
            $hzhzhjlxhm=$Record[5].":".$Record[6];
            $hzhzhjlx=$Record[5];               //患者证件类型
            $hzhzhjhm=$Record[6];              //患者证件号码
            $hzhjzhshl=$Record[26];          //捐助数量
            //$hzhjzhlx=$Record[25];            //捐助类型
            $hzhruyymch=$Record[11];      //入组医院名称
            $hzhjshdh=$Record[16];         //患者家属电话
            $hzhdh=$Record[15];
            $hzhxm=$Record[4];   //患者姓名
            $hzhbm=$Record[2];    //患者编码
            $hzhxb=$Record[37];    //患者性别
            $hzhnl=$Record[37];    //患者年龄
            $hzhchshrq=$Record[38];//患者出生日期
            $hzherqshq=$Record[50];//患者出生日期

$lynumq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$Record[0]."' and `tshqk`<>'1'");
$lynum = mysql_num_rows($lynumq);//获取总条数
            echo $lynum;?>次
            , 已领<?php 
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){
  if($lyshlnum[0]!=""){$ylypsh=$lyshlnum[0];}else{$ylypsh="0";}}
  echo $ylypsh;
            ?>瓶  </div>
        <script type="text/javascript" src="js/jquery.alerts.js"
            charset="gb2312"></script>
            <input type="hidden" name="zhshrzrq" value="<?php echo $Record[34];?>">
            <input type="hidden" name="bzh" value="<?php echo $Record[7];?>">
            <input type="hidden" name="rzyy" value="<?php echo $Record[11];?>">
            <input type="hidden" name="hzxm" id="hzxm" value="<?php echo $Record[4];?>">
            <input type="hidden" name="lynum" value="<?php echo $lynum; ?>" />
<?php
}

$fycode = mt_rand(0,1000000);
$_SESSION['fycode'] = $fycode;      //将此随机数暂存入到session
?>

<input name="id" type="hidden" value="<?php echo $hzhid;?>" />
<input name="fycode" type="hidden" value="<?php echo $fycode;?>" />

<div class="top">


<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <tr style="color:#1f4248; font-weight:bold; height:30px;">
    <td align="center" bgcolor="#FFFFFF" colspan="6">患者信息</td>
  </tr>
  <tr style="color:#1f4248; font-size:12px;">
      <td align="center" bgcolor="#FFFFFF" width="115px;">姓名</td>
      <td align="left" bgcolor="#FFFFFF" width="125px;" style="padding-left: 30px;"><?php echo $hzhxm;?></td>
      <td align="center" bgcolor="#FFFFFF">性别</td>
      <td align="center" bgcolor="#FFFFFF" width="125px;" ><?php echo $hzhxb;?></td>
      <td align="center" bgcolor="#FFFFFF" width="125px;">年龄</td>
      <td align="left" bgcolor="#FFFFFF" style="padding-left: 30px;"><?php
          //计算年龄
          function birthday($mydate){
              $birth=$mydate;
              list($by,$bm,$bd)=explode('-',$birth);
              $cm=date('n');
              $cd=date('j');
              $age=date('Y')-$by-1;
              if ($cm>$bm || $cm==$bm && $cd>$bd) $age++;
              if($age<='0'){$age="0";}
              return $age."岁";
//echo "生日:$birth\n年龄:$age\n";
          }
          echo birthday($hzhchshrq);
          //echo birthday("2012-2-29");
          //echo $hzhchshrq."4564";
          ?></td>

  </tr>
    <tr style="color:#1f4248; font-size:12px;">
        <td align="center" bgcolor="#FFFFFF">患者联系电话</td>
        <td align="left" bgcolor="#FFFFFF" colspan="2" style="padding-left: 30px;"><?php echo $hzhdh;?></td>
        <td align="center" bgcolor="#FFFFFF">家属联系电话</td>
        <td align="left" bgcolor="#FFFFFF" colspan="2" style="padding-left: 30px;"><?php echo $hzhjshdh;?></td>
    </tr>
  <tr style="color:#1f4248; font-size:12px;">
    <td align="center" bgcolor="#FFFFFF">身份证号</td>
    <td align="left" bgcolor="#FFFFFF" colspan="5" style="padding-left: 30px;"><?php echo $hzhzhjhm;?></td>
  </tr>
  <tr style="color:#1f4248; font-size:12px;">
      <td align="center" bgcolor="#FFFFFF">指定医院名称</td>
      <td align="left" bgcolor="#FFFFFF" colspan="3" style="padding-left: 30px;"><?php
          $sql_yymch="select `yymch`,`zhdysh` from `yyyshdq` where `id`='$hzhruyymch'";
          $query_yymch=mysql_query($sql_yymch);
          while($Record_yymch=mysql_fetch_array($query_yymch)){
              $yymch=$Record_yymch[0];
              $zhdysh=$Record_yymch[1];
          }
          echo $yymch;?></td>
      <td align="center" bgcolor="#FFFFFF">指定医生</td>
      <td align="left" bgcolor="#FFFFFF" style="padding-left: 30px;"><?php echo $zhdysh;?></td>
  </tr>

</table>


</div>

<!--
<div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF" colspan="4">患者所需携带资料</td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="patsfz" value="1"/></td>
            <td align="center" bgcolor="#FFFFFF">患者身份证</td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="patzgykyp" onchange="zgykypo()" id="zgykyok" value="1"/></td>
            <td align="center" bgcolor="#FFFFFF">
                <label>自购药空药瓶</label>
                <div id='zgykypoid' style="display: none;">
                    <label>应回收自购药_0_瓶，实回收自购药<input type="text" size="1" name="zgy"/>瓶</label>
                </div>
            </td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="patsfz" id="patsfzd" onchange="patsfzdc()" value="1"/></td>
            <td align="center" bgcolor="#FFFFFF">
                <label>与肿瘤相关的影像学检查报告单</label>(
                <input type="checkbox" name="zlbg1" value="CT"/>CT 
                <input type="checkbox" name="zlbg2" value="MRI"/>MR 
                <input type="checkbox" name="zlbg3" value="IPET-CT"/>IPET-CT
                <input type="checkbox" name="zlbg4" value="骨显像（骨扫描）"/>骨显像（骨扫描）)
                <div id="yxtime" style="display: none;">
                    <label>检查时间</label>
                    <input type="text" name="yxtime" id="yxtimes" size="7" readonly onchange="jcyxtime()"/>
                </div>
            </td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="yxtjsfb" value="1"/></td>
            <td align="center" bgcolor="#FFFFFF">
                <label>医学条件随访表</label>
            </td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="cfj" value="1"/></td>
            <td align="center" bgcolor="#FFFFFF">
                <label>处方笺</label>
            </td>
        </tr>
    </table>
</div>-->



<div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF" colspan="4">医学条件评估</td>
        </tr>

        <?php
           if($lynum%3 == 0){ //随访表
        ?>
               <tr style="color:#1f4248; font-size:12px;">
                   <td align="center" bgcolor="#FFFFFF" rowspan="2">实验室和影像学检查</td>
                   <td align="center" bgcolor="#FFFFFF">
                       <label>安全性评估：</label>
                       <label style="margin-left: 30px;">血常规检查</label><input type="checkbox" name="cgjc0" value="0" checked="checked" />
                       <label style="margin-left: 30px;">尿常规检查</label><input type="checkbox" name="cgjc1" value="1" checked="checked"/>
                       <label style="margin-left: 30px;">生化检查</label><input type="checkbox" name="cgjc2" value="2" checked="checked"/><br>

                       <label style="font-size: 12px; font-weight:bold;">*3项检查必做</label>
                       <label style="padding-left: 160px;">检查报告日期：<?php echo date('Y-m-d', time());?></label>
                       <input type="hidden" name="isfsyjc" value="1"/>
                   </td>
               </tr>
               <tr style="color:#1f4248; font-size:12px;">
<!--                   <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="havexiao" value="1"/></td>-->
                   <td align="center" bgcolor="#FFFFFF">
                       <label>有效性评估：</label>
                       <label style="margin-left: 30px;">CT</label><input type="radio" name="yxpg" value="CT" />
                       <label style="margin-left: 30px;">MRI</label><input type="radio" name="yxpg" value="MRI" />
                       <label style="margin-left: 30px;">PET-CT</label><input type="radio" name="yxpg" value="PET-CT" />
                       <label style="margin-left: 30px;">ECT</label><input type="radio" name="yxpg" value="ECT" /><br>

                       <label style="font-size: 12px; font-weight:bold;">*4项检查选其一</label>
                       <label style="padding-left: 150px;">检查报告日期：<?php echo date('Y-m-d', time());?></label>
                   </td>
               </tr>
               <tr style="color:#1f4248; font-size:12px;">
                   <td align="center" bgcolor="#FFFFFF">本次随访RECIST评估</td>
                   <td align="center" bgcolor="#FFFFFF">
                       CR<input type="radio" name="pgxx" value="CR"/>
                       PR<input type="radio" name="pgxx" value="PR"/>
                       SD<input type="radio" name="pgxx" value="SD"/>
                       PD<input type="radio" name="pgxx" value="PD"/><br>
                       <label style="padding-left: 20px;">评估日期：<?php echo date('Y-m-d', time());?></label><br>
                       <label>若勾选PD则是否愿意接受辉瑞公司随访：</label>
                       <input type="radio" name="jshrhsf" value="1">是
                       <input type="radio" name="jshrhsf" value="0">否
                   </td>
               </tr>
               <tr style="color:#1f4248; font-size:12px;">
                   <td align="center" bgcolor="#FFFFFF">是否建议继续服用英立达</td>
                   <td align="center" bgcolor="#FFFFFF">
                       <input type="radio" name="jxsyyld" value="1"/>是
                       <input type="radio" name="jxsyyld" value="2"/>否
                   </td>
               </tr>
        <?php }else{ //处方笺 ?>
               <tr style="color:#1f4248; font-size:12px;">
                   <td align="center" bgcolor="#FFFFFF">安全性评估</td>
                   <td align="center" bgcolor="#FFFFFF" style="padding-left: 30px;">
                       <input type="checkbox" name="cgjc0" value="0" checked="checked" style="margin-left: 30px;"/><label>血常规检查</label>
                       <input type="checkbox" name="cgjc1" value="1" checked="checked" style="margin-left: 30px;"/><label>尿常规检查</label>
                       <input type="checkbox" name="cgjc2" value="2" checked="checked" style="margin-left: 30px;"/><label>生化检查</label><br>
                       <label style="font-size: 12px; font-weight:bold;">*3项检查必做</label>
                       <label style="padding-left: 30px;">检查报告日期：<?php echo date('Y-m-d', time());?></label>
                       <input type="hidden" name="isfsyjc" value="1"/>
                   </td>
               </tr>
       <?php }?>
    </table>
</div>




<?php
    //查询批号
    $sql = "select kfrk.ph, kfrk.id, yfshqzy.kcshl1 from yfshqzy left join kfrk on yfshqzy.ph1=kfrk.id where yfshqzy.shqzht='3' and yfshqzy.yfmch='".$_SESSION['gldw']."' group by kfrk.ph order by yfshqzy.id desc";
    $phinfo = $db->getAll($sql);
?>

<div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF" colspan="4">处方</td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="left" bgcolor="#FFFFFF" colspan="4">
                (1)<input type="radio" name="yfyl" value="1"/> &nbsp;&nbsp;英利达<label style="font-weight: bold;">2</label>盒(5mg*28片/盒)共计<label style="font-weight: bold;">56</label>片 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;【5mg  Bid  p.o  连续服用】<br>
                (2)<input type="radio" name="yfyl" value="2"/> &nbsp;&nbsp;英利达<label style="font-weight: bold;">12</label>盒(1mg*14片/盒)共计<label style="font-weight: bold;">168</label>片 &nbsp;&nbsp;【3mg  Bid  p.o  连续服用】<br>
                (3)<input type="radio" name="yfyl" value="3"/> &nbsp;&nbsp;英利达<label style="font-weight: bold;">8</label>盒(1mg*14片/盒)共计<label style="font-weight: bold;">112</label>片 &nbsp;&nbsp;&nbsp;&nbsp;【2mg  Bid  p.o  连续服用】<br>
                <label style="font-weight: bold; padding-left: 215px;">*减量服用时，请填写选项(2)、(3)</label><br>
                <label style="font-weight: bold; padding-left: 215px;">*一个疗程28天</label>
            </td>
<!--            <td align="center" bgcolor="#FFFFFF">-->
<!--                <select name="yfyl" onchange="yofayl()" id="yongfayl">-->
<!--                    <option value="">-请选择-</option>-->
<!--                    <option value="5">5</option>-->
<!--                    <option value="4">4</option>-->
<!--                    <option value="3">3</option>-->
<!--                    <option value="2">2</option>-->
<!--                    <option value="1">1</option>-->
<!--                </select>mg &nbsp;-->
<!--                <span id="yongliang"></span>-->
<!--            </td>-->
        </tr>
        <tr style="color: #1f4248; font-size: 12px;">
            <td align="center" bgcolor="#FFFFFF" width="200px">指定医生/授权医生签字</td>
            <td align="center" bgcolor="#FFFFFF" width="200px;">
                <?php echo "<img width=\"105\" height=\"45\" src=\"/qzyzh/".$hzhruyymch."-2.jpg\"/>"; ?>
            </td>
            <td align="center" bgcolor="#FFFFFF" width="200px;">盖章(指定医生专用章)</td>
            <td align="center" bgcolor="#FFFFFF">
                <?php echo "<img width=\"105\" height=\"45\" src=\"/qzyzh/".$hzhruyymch."-1.jpg\"/>"; ?>
            </td>

        </tr>
        <tr style="color: #1f4248; font-size: 12px;">
            <td align="center" bgcolor="#FFFFFF">本次随访和填表时间</td>
            <td align="center" bgcolor="#FFFFFF" colspan="3"><?php echo date('Y-m-d', time());?></td>
        </tr>
<!--        <tr style="color:#1f4248; font-size:12px;">-->
<!--            <td align="center" bgcolor="#FFFFFF"></td>-->
<!--            <td align="center" bgcolor="#FFFFFF">-->
<!--                <label></label>-->
<!--                <select name="pihao">-->
<!--                    <option value="">-请选择-</option>-->
<!--                    --><?php
//                        if(!empty($phinfo)):
//                            foreach($phinfo as $key=>$val):
//                    ?>
<!--                    <option value="--><?php //echo $val['ph'];//id 批号id ?><!--">批号--><?php //echo $val['ph']; ?><!-- 库存数量--><?php //echo $val['kcshl1']; ?><!--</option>-->
<!--                    --><?php //
//                            endforeach;
//                        endif;
//                    ?>
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
    </table>
</div>


<div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <td align="center" bgcolor="#FFFFFF" colspan="4">领药信息</td>
        </tr>
        <tr style="color:#1f4248; font-size:12px;">
            <td align="center" bgcolor="#FFFFFF">
                患者于<input type="text" id="lysj" name="lysj" value="" align="center" style="border:none; border-bottom:1px solid; width: 68px;"/>领取英立达<input type="text" id="lysl" name="lysl" value="" style="border:none; border-bottom:1px solid; width: 60px;">盒<br>
                (<input type="radio" name="lylx" value="1">5mg*28片/盒； <input type="radio" name="lylx" value="2">1mg*14片/盒)<br>
                预估下次灵药时间：<input type="text" id="xclysj" name="xclysj" value="" style="border:none; border-bottom:1px solid; width: 68px;">
            </td>
        </tr>

    </table>
</div>



    </div>
    <div class="top">
        <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" />
    </div>

    </div>
    </form>
    </div></div>
</body>
</html>


<script type="text/javascript">
    chooseDate('yxtimes', true); //检查时间
    chooseDate('pinggrq', true); //首次登记日期
    chooseDate('lysj', true); //领药时间
    chooseDate('xclysj', true); //下次领药时间
    //显示自购药X瓶
    function zgykypo() {
        if(document.getElementById('zgykyok').checked) {
        	document.getElementById('zgykypoid').style.display='block';
        } else {
        	document.getElementById('zgykypoid').style.display='none';
        }
    }
    //显示影像时间
    function patsfzdc() {
    	if(document.getElementById('patsfzd').checked) {
        	document.getElementById('yxtime').style.display='block';
        } else {
        	document.getElementById('yxtime').style.display='none';
        }
    }
    //检查时间验证
    function jcyxtime() {
        //选中的时间戳
        var timestr = document.getElementById('yxtimes').value;
        var time = Date.parse(new Date(timestr));
        //当前时间戳
        var timestamp = Date.parse(new Date());
        var xctime = timestamp - time;
        if(xctime < 0) {
            alert('检查报告超时');return;
        }
        var day = Math.ceil(xctime/1000/3600/24);
        if(day >= 30) {
            alert("检查报告超时");return;
        }
    }
    //
    function yofayl() {
    	var val = document.getElementById('yongfayl').value;
    	switch(val) {
	        case '1':
	        	var html = "4盒　1mg*14片/盒　56片";
		        break;
	        case '2':
	        	var html = "8盒　1mg*14片/盒　112片";
		        break;
	        case '3':
	        	var html = "12盒　1mg*14片/盒　168片";
		        break;
	        case '4':
	        	var html = "16盒　1mg*14片/盒　224片";
		        break;
	        case '5':
	        	var html = "2盒　5mg*28片/盒　56片";
		        break;
    	}
    	document.getElementById('yongliang').innerHTML=html;
    }
</script>