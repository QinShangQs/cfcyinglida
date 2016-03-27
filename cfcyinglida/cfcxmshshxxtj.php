<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="项目实时信息统计";
include('spap_head.php');
?>
  <div class="main"><?php /*div[main]开始*/?>
    <div class="insmain">
      <div class="thislink">当前位置：<?php echo $html_title;?></div>
      <div class="inwrap flt top">
        <div class="title w977 flt">
          <strong><?php echo $html_title;?></strong><span></span>
        </div>
        <div class="incontact w955 flt">
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>
       
        <fieldset>
            <legend>日期：<?php echo date('Y-m-d');?></legend>
<?php
  $tjzshsql = "select COUNT(DISTINCT yymch),COUNT(DISTINCT zhdyshdh),COUNT(DISTINCT shqyshdh1),COUNT(DISTINCT shqyshdh2),COUNT(DISTINCT shqyshdh3) from `yyyshdq` where `yhszht`='1'";
  $tjzshQuery_ID = mysql_query($tjzshsql);
  while($tjzshRecord = mysql_fetch_array($tjzshQuery_ID)){
  $yymchshz=$tjzshRecord[0];
  $zhdyshshz=$tjzshRecord[1];
  $shqyshshz=$tjzshRecord[2]+$tjzshRecord[3]+$tjzshRecord[4]-3;
  }
  if($shqyshshz<0){$shqyshshz=0;}
  
  $tjhzhsql = "select * from `hzh` where `wshshq`='0'";
  $tjhzhQuery_ID = mysql_query($tjhzhsql);
  $tjhzhnum = mysql_num_rows($tjhzhQuery_ID);
  
  $tjhzhwshsql = "select * from `hzh` where `wshshq`='1'";
  $tjhzhwshQuery_ID = mysql_query($tjhzhwshsql);
  $tjhzhwshnum = mysql_num_rows($tjhzhwshQuery_ID);
  
  $tjtzhhzhsql = "select * from `hzh` where `shqzht`='停止申请'";
  $tjtzhhzhQuery_ID = mysql_query($tjtzhhzhsql);
  $tjtzhhzhnum = mysql_num_rows($tjtzhhzhQuery_ID);
  
  $tjjjhzhsql = "select * from `hzh` where `shqzht`='拒绝'";
  $tjjjhzhQuery_ID = mysql_query($tjjjhzhsql);
  $tjjjhzhnum = mysql_num_rows($tjjjhzhQuery_ID);
  
  $tjshhhzhsql = "select * from `hzh` where `shqzht`='审核'";
  $tjshhhzhQuery_ID = mysql_query($tjshhhzhsql);
  $tjshhhzhnum = mysql_num_rows($tjshhhzhQuery_ID);
  
  $tjdbhzhsql = "select * from `hzh` where `shqzht`='待办入组'";
  $tjdbhzhQuery_ID = mysql_query($tjdbhzhsql);
  $tjdbhzhnum = mysql_num_rows($tjdbhzhQuery_ID);
  
  $tjrzqbhzhsql = "select * from `hzh` where `shqzht`='入组' and `jzhlx`='全部'";
  $tjrzqbhzhQuery_ID = mysql_query($tjrzqbhzhsql);
  $tjrzqbhzhnum = mysql_num_rows($tjrzqbhzhQuery_ID);
  
  $tjrzbfhzhsql = "select * from `hzh` where `shqzht`='入组' and `jzhlx`='部分'";
  $tjrzbfhzhQuery_ID = mysql_query($tjrzbfhzhsql);
  $tjrzbfhzhnum = mysql_num_rows($tjrzbfhzhQuery_ID);
  
  $tjchzqbhzhsql = "select * from `hzh` where `shqzht`='出组' and `jzhlx`='全部'";
  $tjchzqbhzhQuery_ID = mysql_query($tjchzqbhzhsql);
  $tjchzqbhzhnum = mysql_num_rows($tjchzqbhzhQuery_ID);
    
  $tjchzbfhzhsql = "select * from `hzh` where `shqzht`='出组' and `jzhlx`='部分'";
  $tjchzbfhzhQuery_ID = mysql_query($tjchzbfhzhsql);
  $tjchzbfhzhnum = mysql_num_rows($tjchzbfhzhQuery_ID);
    
  $tjblshjsql = "select * from `blshj`";
  $tjblshjQuery_ID = mysql_query($tjblshjsql);
  $tjblshjnum = mysql_num_rows($tjblshjQuery_ID);

$kfrk1sql = "select SUM(bjshl) from `kfrk` where `gg`='200mg*60粒/瓶'";
$kfrk1Query_ID = mysql_query($kfrk1sql);
while($kfrk1Record = mysql_fetch_array($kfrk1Query_ID)){
if($kfrk1Record[0]>0){$rkzsh1=$kfrk1Record[0];}else{$rkzsh1=0;}
}
$kfrk2sql = "select SUM(bjshl) from `kfrk` where `gg`='250mg*60粒/瓶'";
$kfrk2Query_ID = mysql_query($kfrk2sql);
while($kfrk2Record = mysql_fetch_array($kfrk2Query_ID)){
if($kfrk2Record[0]>0){$rkzsh2=$kfrk2Record[0];}else{$rkzsh2=0;}
}

$zsh1sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='1'";
$zsh1=mysql_query($zsh1sql);
while($zsh1Record = mysql_fetch_array($zsh1)){
if($zsh1Record[0]>0){$zshjs1=$zsh1Record[0];}else{$zshjs1=0;}
}
$zsh2sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='2'";
$zsh2=mysql_query($zsh2sql);
while($zsh2Record = mysql_fetch_array($zsh2)){
if($zsh2Record[0]>0){$zshjs2=$zsh2Record[0];}else{$zshjs2=0;}
}
  Mysql_select_db("cfcwshshq");
  //网上申请总数
$wshshqzshsql="SELECT count(*) FROM `hzh`";
$wshshqzshq=mysql_query($wshshqzshsql);
while($wshshqzshRecord = mysql_fetch_array($wshshqzshq)){
if($wshshqzshRecord[0]>0){$wshshqzsh=$wshshqzshRecord[0];}else{$wshshqzsh=0;}
}
  //网上申请成功
$wshshqchgsql="SELECT count(*) FROM `hzh` where `wshyychgshj`<>''";
$wshshqchgq=mysql_query($wshshqchgsql);
while($wshshqchgRecord = mysql_fetch_array($wshshqchgq)){
if($wshshqchgRecord[0]>0){$wshshqchg=$wshshqchgRecord[0];}else{$wshshqchg=0;}
}
  //网上申请导入
$wshshqdrsql="SELECT count(*) FROM `hzh` where `drxt`='1'";
$wshshqdrq=mysql_query($wshshqdrsql);
while($wshshqdrRecord = mysql_fetch_array($wshshqdrq)){
if($wshshqdrRecord[0]>0){$wshshqdr=$wshshqdrRecord[0];}else{$wshshqdr=0;}
}
  Mysql_select_db("CFCSYSTEM");
?>
            <div>
                <span class="label">指定医院：</span> <?php echo $yymchshz;?> 所
            </div>
            <div>
                <span class="label">指定医生：</span> <?php echo $zhdyshshz;?> 名
            </div>
            <div>
                <span class="label">授权医生：</span> <?php echo $shqyshshz;?> 名
            </div>
            <div>
                <span class="label">收到患者申请：</span> <?php echo $tjhzhnum+$tjhzhwshnum;?> 例 
                <span class="label">网上预约：</span> <?php echo $tjhzhwshnum;?> 例
                <span class="label">直接申请：</span> <?php echo $tjhzhnum;?> 例
            </div>
            <div>
                <span class="label">网上预约申请：</span> <?php echo $wshshqzsh;?> 例 
                <span class="label">未完成：</span> <?php echo $wshshqzsh-$wshshqchg;?> 例
                <span class="label">已完成：</span> <?php echo $wshshqchg;?> 例
                <span class="label">已导入：</span> <?php echo $wshshqdr;?> 例
            </div>
            <div>
                <span class="label">停止申请：</span> <?php echo $tjtzhhzhnum;?> 例
            </div>
            <div>
                <span class="label">拒绝：</span> <?php echo $tjjjhzhnum;?> 例
            </div>
            <div>
                <span class="label">审核中：</span> <?php echo $tjshhhzhnum;?> 例
            </div>
            <div>
                <span class="label">待办入组：</span> <?php echo $tjdbhzhnum;?> 例
            </div>
            <div>
                <span class="label">入组：</span> <?php echo $tjrzqbhzhnum+$tjrzbfhzhnum;?> 例
                <span class="label">入组全部捐赠：</span> <?php echo $tjrzqbhzhnum;?> 例
                <span class="label">入组部分捐赠：</span> <?php echo $tjrzbfhzhnum;?> 例
            </div>
            <div>
                <span class="label">出组：</span> <?php echo $tjchzqbhzhnum+$tjchzbfhzhnum;?> 例
                <span class="label">出组部分捐赠：</span> <?php echo $tjchzqbhzhnum;?> 例
                <span class="label">出组部分捐赠：</span> <?php echo $tjchzbfhzhnum;?> 例
            </div>
            <div>
                <span class="label">不良事件：</span> <?php echo $tjblshjnum;?> 例
            </div>
            <div>
                <span class="label">库存数量200mg：</span> <?php echo $rkzsh1-$zshjs1;?> 瓶（国大库房+各药房药品数量）
            </div>
            <div>
                <span class="label">库存数量250mg：</span> <?php echo $rkzsh2-$zshjs2;?> 瓶（国大库房+各药房药品数量）
            </div>
            <div>
                <span style="width:170px" class="label">药房发放赠药数量200mg：</span> <?php echo $zshjs1;?> 瓶
            </div>
            <div>
                <span style="width:170px" class="label">药房发放赠药数量250mg：</span> <?php echo $zshjs2;?> 瓶
            </div>

    </fieldset>
<div class="insinsins" style="width:100%;">
<span><input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></span>
                </div>
              </td>
            </tr>
          </table> 
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>