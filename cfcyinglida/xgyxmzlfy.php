<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$html_title="项目资料发运";
include('spap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="manager.php">系统首页</a>
        > <?php echo $html_title;?></div>
    <div class="form">
    <?php 
      $sql="select * from `xgyyshxmclshq` where `id`='".$id."' order by id DESC ";
      //echo $sql;
      $Query_ID = mysql_query($sql);
      while($Record = mysql_fetch_array($Query_ID)){
    ?>
        <form action="xgyxmzlfyac.php" method="post">
        <input id="id" name="id" type="hidden" value="<?php echo $Record[0];?>" />
        <?php 
      $yysql="select * from `yyyshdq` where `id`='".$Record[1]."' order by id DESC ";
      //echo $sql;
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      ?>
        <div>
            <span style="width: 160px;"  class="label">医院名称：</span><?php echo $yyRecord[3];?></div>
        <div>
            <span style="width: 160px;"  class="label">医生姓名：</span><?php echo $yyRecord[6];?></div>
        <div>
            <span style="width: 160px;"  class="label">医院地址：</span><?php echo $yyRecord[1]." ".$yyRecord[24]." ".$yyRecord[26]." ".$yyRecord[20];?></div>
        <div>
            <span style="width: 160px;"  class="label">联系方式：</span><?php echo $yyRecord[7];?></div>
      <?php
      }
      ?>
        <div>
            <span style="width: 160px;"  class="label">医生名下患者人数：</span><?php
      $hzhrshsql="select count(*) from `hzh` where (`shqyy`='".$Record[1]."' or `rzyy`='".$Record[1]."' or `zhzhyy`='".$Record[1]."') ";
      //echo $sql;
      $hzhrshQuery_ID = mysql_query($hzhrshsql);
      while($hzhrshRecord = mysql_fetch_array($hzhrshQuery_ID)){
          echo $hzhrshRecord[0]."人";
      }
            ?></div>
        <div>
            <span style="width: 160px;"  class="label">总申请资料数量：</span><?php
      $zshqsql="select SUM(hzhzlj),SUM(shqb) from `xgyyshxmclshq` where `yshid`='".$Record[1]."' ";
      //echo $sql;
      $zshqQuery_ID = mysql_query($zshqsql);
      while($zshqRecord = mysql_fetch_array($zshqQuery_ID)){
          if($zshqRecord[0]==""){$zshqRecord[0]=0;}
          if($zshqRecord[1]==""){$zshqRecord[1]=0;}
          echo "(".$zshqRecord[0]."/".$zshqRecord[1].")";
      }
            ?></div>
        <div>
            <span style="width: 160px;"  class="label">患者资料夹：</span><?php echo $Record[2];?></div>
        <div>
            <span style="width: 160px;"  class="label">批准患者资料夹：</span><select id="zljbb" name="zljbb" style="width:130px">
  <option  value="">无</option>
<?php
      $zljbbsql="select `clbb` from `cfchzhcl` where `cllx`='1' group by  cllx,clbb";
      //echo $sql;
      $zljbbQuery_ID = mysql_query($zljbbsql);
      while($zljbbRecord = mysql_fetch_array($zljbbQuery_ID)){
          echo "<option  value=\"".$zljbbRecord[0]."\">".$zljbbRecord[0]."</option>";
      }
?>
	</select><input id="pzhhzhzlj" name="pzhhzhzlj" type="txt" value="0"></input></div>
        <div>
            <span style="width: 160px;"  class="label">申请表：</span><?php echo $Record[3];?></div>
        <div>
            <span style="width: 160px;"  class="label">批准申请表：</span><select id="shqbbb" name="shqbbb" style="width:130px">
  <option  value="">无</option>
<?php
      $shqbbbsql="select `clbb` from `cfchzhcl` where `cllx`='2' group by  cllx,clbb";
      //echo $sql;
      $shqbbbQuery_ID = mysql_query($shqbbbsql);
      while($shqbbbRecord = mysql_fetch_array($shqbbbQuery_ID)){
          echo "<option  value=\"".$shqbbbRecord[0]."\">".$shqbbbRecord[0]."</option>";
      }
?>
	</select><input id="pzhshqb" name="pzhshqb" type="txt" value="0"></input></div>
        <div>
            <span style="width: 160px;"  class="label">运单号：</span><input id="ydh" name="ydh" type="txt" value=""></input></div>
        <div>
            <span style="width: 160px;"  class="label">备注：</span><TEXTaREa style="WIDth: 400px" rows="2" cols="20" name="bzh"></TEXTaREa></div>
            
        <div class="btnPos">
            <input type="submit" value="保存" class="lgSub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="lgSub" /></div>

        </form>
    <?php
      }
    ?>
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