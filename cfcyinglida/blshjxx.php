<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET["id"];
$html_title="不良事件报告详细";
include('spap_head.php');
?>    
		  <?php 
          $blshsql = "select * from `blshj` where id='$id'";
          $blshQuery_ID = mysql_query($blshsql);
          while($blshRecord = mysql_fetch_array($blshQuery_ID)){

      ?>
    <div id="con"><div class="position">
        <a href="blshjgl.php">不良事件报告管理</a>
        > <?php echo $html_title;?> <a href="blshjbgpdf.php?id=<?php echo $id;?>" target=_blank>下载</a></div></div>
    <div id="content" style="font-size:16px;">  

      <div class="inwrsssa">
<div style="width:990px; float:left; text-align:center; height:45px; vertical-align:middle; line-height:45px;">
		    <p>中国癌症基金会（CFC）赛可瑞患者援助项目（XPAP） CEP ID：4895		    </p>
		  </div>
		  <div style="width:990px; float:left; text-align:center;">
		    <p><strong>不良事件报告表 </strong></p>
			<p style="font-size:11px;">必须于获知不良事件后24h内报告　　　           编号：<?php echo $id;?></p>
		  </div>

		    <table class="lxbda" width="990" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
              <tr>
                <td colspan="2" bgcolor="#999999"><strong>患者资料</strong></td>
              </tr>
       <?php 
         $sql = "select * from `hzh` where id='$blshRecord[1]' ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
if($Record[2]!=''){$hzhwybm="X-".$Record[2];}else{$hzhwybm=sprintf("%05d", $Record[0]);}
       ?>
              <tr>
                <td width="52%" align="left"><p><?php if($Record[2]!=''){echo "患者唯一编码：";}else{echo "患者申请号：";}?><?php echo $hzhwybm;?></p>
                <p>患者性别：<?php echo $Record[37];?></p>
                <p>适应症：肺癌</p></td>
                <td width="48%" colspan="-1" align="left"><p>患者姓名：<?php echo $Record[4];?></p>
                <p>患者出生日期：<?php echo $Record[38];?></p>
                <p>入组时间：<?php if($Record[34]!=''){$hzhrzshj=$Record[34];}else{$hzhrzshj="未入组";} echo $hzhrzshj;?></p></td>
              </tr>
              <?php
          $rzyysql = "select zhdysh,yymch,yyksh from `yyyshdq` where ";
          if($blshRecord[11]!=''){
          $rzyysql .= " id='".$blshRecord[11]."'";
          }else if($Record[12]!=''){
          $rzyysql .= " id='".$Record[12]."'";
          }else if($Record[11]!=''){
          $rzyysql .= " id='".$Record[11]."'";
          }else if($Record[9]!=''){
          $rzyysql .= " id='".$Record[9]."'";
          }
          /*echo $rzyysql;*/
          $rzyyQuery_ID = mysql_query($rzyysql);
          while($rzyyRecord = mysql_fetch_array($rzyyQuery_ID)){
          $zhdysh=$rzyyRecord[0];
          $zhdyymch=$rzyyRecord[1]." ".$rzyyRecord[2];
          }
               } ?>
              <tr>
                <td colspan="2" align="left" bgcolor="#999999"><strong>该事件信息来源</strong></td>
              </tr>
              <tr>
                <td colspan="2" align="left">
                <?php
                if($blshRecord[2]=="0"){
                $shjxxlz="医生";
                }else  if($blshRecord[2]=="1"){
                $shjxxlz="患者";
                }else  if($blshRecord[2]=="2"){
                $shjxxlz="患者家属";
                }
                ?>
                <p>该事件信息来自<?php echo $shjxxlz;?></p>
                <?php 
                if($blshRecord[2]=="0"){
                echo "<p>医生是否愿意接受随访:";
                  if($blshRecord[3]=="0"){
                    echo "否";
                  }else{
                    echo "是";
                    echo "<p>医生姓名：".$zhdysh." 医院名称（科室）：".$zhdyymch."</p>";
                  }
                echo " </p>";
                }else{
                echo "<p>医生是否愿意接受随访:";
                  if($blshRecord[3]=="0"){
                    echo "无法提供医生联系方式";
                  }else{
                    echo "是";
                    echo "<p>医生姓名：".$zhdysh." 医院名称（科室）：".$zhdyymch."</p>";
                  }
                echo " </p>";
                }
                ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="left" bgcolor="#999999">赛可瑞用量及用法</td>
              </tr>
              <tr>
                <td colspan="2" align="left"><?php echo $blshRecord[4];?></td>
              </tr>
              <tr>
                <td colspan="2" align="left" bgcolor="#999999"><strong>事件描述（</strong>包括既往病史、合并用药、相关实验室检查结果及不良事件转归等，如需更多地方填写，可另附一张表格<strong>）:</strong></td>
              </tr>
              <tr>
                <td colspan="2" align="left"><?php echo $blshRecord[5];?></td>
              </tr>
              <tr>
                <td colspan="2" align="left" bgcolor="#999999">CFC获知不良事件的日期</td>
              </tr>
              <tr>
                <td colspan="2" align="left"><p><?php echo date('Y年m月d日',strtotime($blshRecord[6]));?></p>
                赛可瑞治疗是否仍持续： <?php if($blshRecord[7]=="1"){echo "是";}else if($blshRecord[7]=="0"){echo "否";}else if($blshRecord[7]=="2"){echo "不详";}?></td>
              </tr>
              <tr>
                <td colspan="2" align="left" bgcolor="#999999">报告至辉瑞中国药物安全部门的日期 </td>
              </tr>
              <tr>
                <td colspan="2" align="left"><?php echo date('Y年m月d日',strtotime($blshRecord[8]));?></td>
              </tr>
              <tr>
                <td colspan="2" align="left" bgcolor="#999999"><strong>CFC 填表人信息</strong></td>
              </tr>
              <tr>
                <td colspan="2" align="left">CFC填表人签名：<?php echo $blshRecord[9];?></td>
              </tr>
            </table>
            <p style="text-align:right;">版本生效日：2013年11月27日</p>
      </div>

    </div>

      <?php
          }
      ?>
      
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
