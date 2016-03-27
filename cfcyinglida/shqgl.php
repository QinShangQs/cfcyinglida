<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=(\d+)&/", "", $url[query]);
$url[query] = preg_replace("/&page=(\d+)/", "", $url[query]);
$url[query] = preg_replace("/page=(\d+)/", "", $url[query]);

if($url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}

$numq=mysql_query("SELECT * FROM `hzh`");
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}
if($_GET[guanjianci]!=""){
$guanjianci=$_GET[guanjianci];

if(substr( $guanjianci, 0, 1 )=='s'||substr( $guanjianci, 0, 1 )=='S'){
$guanjianci=str_ireplace('s','',$guanjianci,$i);
$guanjiancisql="(`hzhid`='".$guanjianci."')";

}//yang  change start ,添加疾病类型搜索
else if( $guanjianci=='g'){$guanjiancisql="(`shqbzh`='GIST')";}
else if($guanjianci=='r'){$guanjiancisql="(`shqbzh`='RCC')";}
else if($guanjianci=='p'){$guanjiancisql="(`shqbzh`='pNET')";}
else{
$guanjianci=preg_replace('/^0*/', '', $guanjianci);
$guanjiancisql="(`id`='".$guanjianci."' or `hzhxm` LIKE '%".$guanjianci."%' or `zhjhm`='".$guanjianci."')";
}
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
}
if($_GET[wlykshrq]!=""&&$_GET[wlyjshrq]!=""){
$wlykshrq=$_GET[wlykshrq];
$wlyjshrq=$_GET[wlyjshrq];
$xclyrqsql="SELECT * FROM `xclyrq` WHERE `xclyrq`>='".date('Y-m-d',strtotime('-90 day',strtotime($wlykshrq)))."' and `xclyrq`<='".date('Y-m-d',strtotime('-90 day',strtotime($wlyjshrq)))."'";
$guanjiancisql="(";
$jli=0;
  $xclyrqQuery_ID = mysql_query($xclyrqsql);
  while($xclyrqRecord = mysql_fetch_array($xclyrqQuery_ID)){
  if($jli==0){$guanjiancisql.=" `id`='".$xclyrqRecord[0]."'";}else{
      $guanjiancisql.=" or `id`='".$xclyrqRecord[0]."'";}
  } 
$guanjiancisql.=")";
//echo $guanjiancisql;
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
}
if($_GET[ygrzrqksh]!=""){
$ygrzrqksh=$_GET[ygrzrqksh];
//$ygrzrqjsh=$_GET[ygrzrqjsh];

$guanjiancisql="(`ygshcyyrq`='".$ygrzrqksh."' and `shqzht`='审核')";

$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
}
if(($_GET[ShengfenMingcheng]!="省份"&&$_GET[ShengfenMingcheng]!="")||($_GET[ChengshiMingcheng]!="地级市"&&$_GET[ChengshiMingcheng]!="")||$_GET[YiyuanId]!=""||$_GET[YishengId]!=""||$_GET[ShijianLeixing]!=""||$_GET[ShenqingZhuangtai]!=""||$_GET[ZhuanzhenZhuangtai]!=""||$_GET[juanzhuleixing]!=""||$_GET[canbaoleixing]!=""||$_GET[ZuizaoJiehunRiqi]!=""||$_GET[ZuiwanJiehunRiqi]!=""||$_GET[shqly]!=""||$_GET[shqbzh]!=""){
$sheng=$_GET[ShengfenMingcheng];//省
$shi=$_GET[ChengshiMingcheng];//市
$yymch=$_GET[YiyuanId];//医院名称
$yshid=$_GET[YishengId];//医生id

$shqzht=$_GET[ShenqingZhuangtai];//申请状态
$zhzhzht=$_GET[ZhuanzhenZhuangtai];//转诊状态
$jzhlx=$_GET[juanzhuleixing];//捐助类型
$cblx=$_GET[canbaoleixing];//参保类型
$kshrq=$_GET[ZuizaoJiehunRiqi];//开始日期
$jshrq=$_GET[ZuiwanJiehunRiqi];//结束日期
$shjlx=$_GET[ShijianLeixing];//时间类型
$yylx=$_GET[yylx];//医院类型
$shqly=$_GET[shqly];//申请来源
$shqbzh=$_GET[shqbzh];//申请病种
$guanjiancisql="('1'='1' ";

if($yshid==''){

  if($yymch!=''){//申请状态
    $guanjiancisql.=" and ( ";
    $yymchidsql = "select `id` from `yyyshdq` where `yymch`='".$yymch."'";
$jli=0;
      $yymchidQuery_ID = mysql_query($yymchidsql);
      while($yymchidRecord = mysql_fetch_array($yymchidQuery_ID)){
      if($jli==0){
        if($shqzht==""||$shqzht=="拒绝"||$shqzht=="入组"){ 
          if($yylx==0){$guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."' or `shqyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
          if($yylx==1){$guanjiancisql.=" `shqyy`='".$yymchidRecord[0]."'";}
          if($yylx==2){$guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."'";}
          if($yylx==3){$guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
        
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.=" `shqyy`='".$yymchidRecord[0]."'";
        }
      }else{
        if($shqzht==""||$shqzht=="拒绝"||$shqzht=="入组"){ 
          if($yylx==0){$guanjiancisql.="or `rzyy`='".$yymchidRecord[0]."' or `shqyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
          if($yylx==1){$guanjiancisql.="or `shqyy`='".$yymchidRecord[0]."'";}
          if($yylx==2){$guanjiancisql.="or `rzyy`='".$yymchidRecord[0]."'";}
          if($yylx==3){$guanjiancisql.="or `rzyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.=" or `shqyy`='".$yymchidRecord[0]."'";
        }
      }
        //echo $yymchidRecord[0];
        $jli++;
      }
        $guanjiancisql.=" ) ";
  }else if($sheng!='省份'&&$sheng!='')
  {
    if($shi!='地级市'&&$shi!='')
    {
        $shshwhere="`shi`='".$shi."' and `sheng`='".$sheng."'";
    
    }else{
        $shshwhere=" `sheng`='".$sheng."'";
    }
      $yymchidsql = "select `id` from `yyyshdq` where ".$shshwhere;    
        
      $guanjiancisql.=" and (";
      $jli=0;
      $yymchidQuery_ID = mysql_query($yymchidsql);
      while($yymchidRecord = mysql_fetch_array($yymchidQuery_ID)){
      if($jli==0){
        if($shqzht==""||$shqzht=="拒绝"||$shqzht=="入组"){ 
          if($yylx==0){$guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."' or `shqyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
          if($yylx==1){$guanjiancisql.=" `shqyy`='".$yymchidRecord[0]."'";}
          if($yylx==2){$guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."'";}
          if($yylx==3){$guanjiancisql.=" `rzyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
        
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.=" `shqyy`='".$yymchidRecord[0]."'";
        }
      }else{
        if($shqzht==""||$shqzht=="拒绝"||$shqzht=="入组"){ 
          if($yylx==0){$guanjiancisql.="or `rzyy`='".$yymchidRecord[0]."' or `shqyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
          if($yylx==1){$guanjiancisql.="or `shqyy`='".$yymchidRecord[0]."'";}
          if($yylx==2){$guanjiancisql.="or `rzyy`='".$yymchidRecord[0]."'";}
          if($yylx==3){$guanjiancisql.="or `rzyy`='".$yymchidRecord[0]."' or `zhzhyy`='".$yymchidRecord[0]."'";}
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.=" or `shqyy`='".$yymchidRecord[0]."'";
        }
      }
        //echo $yymchidRecord[0];
        $jli++;
      }
      $guanjiancisql.=" )";
  }
  if($shqzht!=''){//申请状态
    $guanjiancisql.=" and `shqzht`='".$shqzht."'";
  }
  if($zhzhzht=='1'){//转诊状态
        $guanjiancisql.=" and `zhzhyy`<>''";
  }
  if($jzhlx!=''){//捐助类型
    $guanjiancisql.=" and `jzhlx`='".$jzhlx."'";
  }  
  if($cblx!=''){//参保类型
    $guanjiancisql.=" and `cblx`='".$cblx."'";
  }   
  if($shqly!=''){//申请来源
    $guanjiancisql.=" and `wshshq`='".$shqly."'";
  }  
  if($shqbzh!=''){//申请病种
    $guanjiancisql.=" and `shqbzh`='".$shqbzh."'";
  } 
  
}else{

       if($shqzht==""||$shqzht=="拒绝"||$shqzht=="入组"){ 
          if($yylx==0){$guanjiancisql.="and ( `rzyy`='".$yshid."' or `shqyy`='".$yshid."' or `zhzhyy`='".$yshid."')";}
          if($yylx==1){$guanjiancisql.="and ( `shqyy`='".$yshid."')";}
          if($yylx==2){$guanjiancisql.="and ( `rzyy`='".$yshid."')";}
          if($yylx==3){$guanjiancisql.="and ( `rzyy`='".$yshid."' or `zhzhyy`='".$yymchidRecord[0]."')";}
        
        }else if($shqzht=="审核"||$shqzht=="待办入组"||$shqzht=="停止申请"){
     $guanjiancisql.="and (  `shqyy`='".$yshid."')";
        }
  
  if($shqzht!=''){//申请状态
    $guanjiancisql.=" and `shqzht` LIKE '%".$shqzht."%'";
  }
  if($zhzhzht!=''){//转诊状态
    $guanjiancisql.=" and `zhzhyy`<>''";
  }
  if($jzhlx!=''){//捐助类型
    $guanjiancisql.=" and `jzhlx`='".$jzhlx."'";
  }  
  if($cblx!=''){//参保类型
    $guanjiancisql.=" and `cblx`='".$cblx."'";
  }  
  if($shqly!=''){//申请来源
    $guanjiancisql.=" and `wshshq`='".$shqly."'";
  } 
  if($shqbzh!=''){//申请病种
    echo $guanjiancisql.=" and `shqbzh`='".$shqshqbzh."'";
  } 
}
if($kshrq!=''||$jshrq!=''){
  //$shjlx 时间类型
  if($shjlx=='1'){    
    if($jshrq!=""){
      $guanjiancisql.=" and `djrq`>='".$kshrq."' and `djrq`<='".$jshrq."'";
    }else{
      $guanjiancisql.=" and `djrq`='".$kshrq."'";
    }
  }
  else if($shjlx=='2'){
    if($jshrq!=""){
      $guanjiancisql.=" and `chcshhrq`>='".$kshrq."' and `chcshhrq`<='".$jshrq."'";
    }else{
      $guanjiancisql.=" and `chcshhrq`='".$kshrq."'";
    }
  }
  else if($shjlx=='3'){    
    if($jshrq!=""){
      $guanjiancisql.=" and `zhshrzshj`>='".$kshrq."' and `zhshrzshj`<='".$jshrq."'";
    }else{
      $guanjiancisql.=" and `zhshrzshj`='".$kshrq."'";
    }
  }
  else if($shjlx=='4'){    
    if($jshrq!=""){
      $guanjiancisql.=" and `hzhchzrq`>='".$kshrq."' and `hzhchzrq`<='".$jshrq."'";
    }else{
      $guanjiancisql.=" and `hzhchzrq`='".$kshrq."'";
    }
  }else{
    if($jshrq!=""){
      $guanjiancisql.=" and ((`hzhchzrq`>='".$kshrq."' and `hzhchzrq`<='".$jshrq."') or (`zhshrzshj`>='".$kshrq."' and `zhshrzshj`<='".$jshrq."') or (`chcshhrq`>='".$kshrq."' and `chcshhrq`<='".$jshrq."') or (`djrq`>='".$kshrq."' and `djrq`<='".$jshrq."'))";
    }else{
      $guanjiancisql.=" and (`hzhchzrq`='".$kshrq."' or `zhshrzshj`='".$kshrq."' or `chcshhrq`='".$kshrq."' or `djrq`='".$kshrq."' )";
    } 
  }
}
$guanjiancisql.=")";
$numq=mysql_query("SELECT * FROM `hzh` where ".$guanjiancisql);
//echo $guanjiancisql;
}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="申请管理";
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
                <div class="insinsins">
                  <span>
<input type="text" id="Guanjianci" name="Guanjianci" value="<?php echo $_GET[guanjianci];?>" placeholder="患者姓名、申请号、患者身份号码或患者编码" class="grd-white" style="width: 320px" />
<input type="button" value="查找" onclick="chazhao();" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins">
                  <span>
<select id="s_province" name="ShengfenMingcheng" class="grd-white2"></select>
<select id="s_city" name="ChengshiMingcheng" class="grd-white2"></select>
<script class="resources library" src="js/area.js" type="text/javascript"></script>
<script type="text/javascript">_init_area();</script>
<select id="YiyuanId" name="YiyuanId" style="width: 240px;" class="grd-white2">
  <option value="">--请选择医院--</option>
</select>
<select id="YishengId" name="YishengId" style="width: 116px;" class="grd-white2">
  <option value="">--请选择医生--</option>
</select>
<select id="yylx" name="yylx" style="width: 116px;" class="grd-white2">
  <option <?php if($_GET[yylx]==0){echo "selected=\"selected\"";}?> value="0">不限制</option>
  <option <?php if($_GET[yylx]==1){echo "selected=\"selected\"";}?> value="1">申请</option>
  <option <?php if($_GET[yylx]==2){echo "selected=\"selected\"";}?> value="2">入组</option>
  <option <?php if($_GET[yylx]==3){echo "selected=\"selected\"";}?> value="3">当前</option>
</select>
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <span>
<select id="ShenqingZhuangtai" name="ShenqingZhuangtai" style="width:110px" class="grd-white2">
  <option <?php if($_GET[ShenqingZhuangtai]==''){echo "selected=\"selected\"";}?> value="">不限申请状态</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='审核'){echo "selected=\"selected\"";}?> value="审核">审核</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='待办入组'){echo "selected=\"selected\"";}?> value="待办入组">待办入组</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='入组'){echo "selected=\"selected\"";}?> value="入组">入组</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='出组'){echo "selected=\"selected\"";}?> value="出组">出组</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='拒绝'){echo "selected=\"selected\"";}?> value="拒绝">拒绝</option>
  <option <?php if($_GET[ShenqingZhuangtai]=='停止申请'){echo "selected=\"selected\"";}?> value="停止申请">停止申请</option>
</select>                
<select id="ZhuanzhenZhuangtai" name="ZhuanzhenZhuangtai" style="width:110px" class="grd-white2">
  <option <?php if($_GET[ZhuanzhenZhuangtai]==''){echo "selected=\"selected\"";}?> value="">不限是否转诊</option>
  <option <?php if($_GET[ZhuanzhenZhuangtai]=='0'){echo "selected=\"selected\"";}?> value="0">没有转诊</option>
  <option <?php if($_GET[ZhuanzhenZhuangtai]=='1'){echo "selected=\"selected\"";}?> value="1">曾经转诊</option>
</select> 
<select id="juanzhuleixing" name="juanzhuleixing" style="width:110px" class="grd-white2">
  <option <?php if($_GET[juanzhuleixing]==''){echo "selected=\"selected\"";}?> value="">不限捐赠类型</option>
  <option <?php if($_GET[juanzhuleixing]=='全部'){echo "selected=\"selected\"";}?> value="全部">全部</option>
  <option <?php if($_GET[juanzhuleixing]=='部分'){echo "selected=\"selected\"";}?> value="部分">部分</option>
</select>
<select id="canbaoleixing" name="canbaoleixing" style="width:110px" class="grd-white2">
  <option <?php if($_GET[canbaoleixing]==''){echo "selected=\"selected\"";}?> value="">不限参保类型</option>
  <option <?php if($_GET[canbaoleixing]=='无'){echo "selected=\"selected\"";}?> value="无">无</option>
  <option <?php if($_GET[canbaoleixing]=='城镇职工（含离退休人员）医疗保险'){echo "selected=\"selected\"";}?> value="城镇职工（含离退休人员）医疗保险">城镇职工（含离退休人员）医疗保险</option>
  <option <?php if($_GET[canbaoleixing]=='城镇居民医疗保险'){echo "selected=\"selected\"";}?> value="城镇居民医疗保险">城镇居民医疗保险</option>
  <option <?php if($_GET[canbaoleixing]=='新农合医疗保险'){echo "selected=\"selected\"";}?> value="新农合医疗保险">新农合医疗保险</option>
  <option <?php if($_GET[canbaoleixing]=='公费医疗'){echo "selected=\"selected\"";}?> value="公费医疗">公费医疗</option>
  <option <?php if($_GET[canbaoleixing]=='现役军人医疗体系'){echo "selected=\"selected\"";}?> value="现役军人医疗体系">现役军人医疗体系</option>
</select>   
<select id="shqly" name="shqly" style="width:110px" class="grd-white2">
  <option <?php if($_GET[shqly]==''){echo "selected=\"selected\"";}?> value="">不限来源</option>
  <option <?php if($_GET[shqly]=='1'){echo "selected=\"selected\"";}?> value="1">网上申请</option>
  <option <?php if($_GET[shqly]=='0'){echo "selected=\"selected\"";}?> value="0">直接申请</option>
</select> 
<!--
<select id="shqbzh" name="shqbzh" style="width:110px" class="grd-white2">
  <option <?php //if($_GET[shqbzh]==''){echo "selected=\"selected\"";}?> value="">不限病种</option>
  <option <?php //if($_GET[shqbzh]=='RCC'){echo "selected=\"selected\"";}?> value="Rcc">RCC</option>
  <option <?php //if($_GET[shqbzh]=='pNET'){echo "selected=\"selected\"";}?> value="pNET">pNET</option>
  <option <?php //if($_GET[shqbzh]=='GIST'){echo "selected=\"selected\"";}?> value="GIST">GIST</option>
</select>
-->
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <span>
<input type="text" id="ZuizaoJiehunRiqi" name="ZuizaoJiehunRiqi" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="ZuiwanJiehunRiqi" name="ZuiwanJiehunRiqi" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" />
<select id="ShijianLeixing" name="ShijianLeixing" style="width:130px" class="grd-white2">
  <option <?php if($_GET[ShijianLeixing]==''){echo "selected=\"selected\"";}?> value="">不限</option>
  <option <?php if($_GET[ShijianLeixing]=='1'){echo "selected=\"selected\"";}?> value="1">首次登记日期</option>
  <option <?php if($_GET[ShijianLeixing]=='2'){echo "selected=\"selected\"";}?> value="2">审核日期</option>
  <option <?php if($_GET[ShijianLeixing]=='3'){echo "selected=\"selected\"";}?> value="3">入组日期</option>
  <option <?php if($_GET[ShijianLeixing]=='4'){echo "selected=\"selected\"";}?> value="4">出组日期</option>
</select>
<input id="btnGuolv" type="button" value="高级过滤" onclick="guolv();" class="uusub2"/>
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <label>网上申请预约码：</label>
                  <span>
<input type="text" id="wshshqyym" name="wshshqyym" value="" placeholder="患者预约码" class="grd-white" style="width: 65px" /> 
<input type="button" value="信息导入" onclick="wshshqyym()" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <label>办理入组日期：</label>
                  <span>
<input type="text" id="ygrzrqksh" name="ygrzrqksh" readonly="readonly" style="width: 106px" placeholder="输入日期" size="12" value="<?php echo date("Y-m-d");?>" class="grd-white" /><!--input type="text" id="ygrzrqjsh" name="ygrzrqjsh" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value="" class="grd-white" /-->
<input type="button" value="查找" onclick="ygchaxun();" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <label>未领药查询：</label>
                  <span>
<input type="text" id="wlykshrq" name="wlykshrq" readonly="readonly" style="width: 106px" placeholder="输入开始日期" size="12" value="" class="grd-white" />-<input type="text" id="wlyjshrq" name="wlyjshrq" style="width: 106px" readonly="readonly" placeholder="输入结束日期" size="12" value=""class="grd-white" />
<input id="btnGuolv" type="button" value="查询" onclick="guolvwly();" class="uusub2" />
                  </span>
                </div>
                <div class="insinsins" style="width:100%;">
                  <span style="width:100%;text-align:center;">
    <?php
    if(in_array('shqgl_xz',$_SESSION[yhqxxf])||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll'){
    ?>
        <input type="button" value="新增申请" class="uusub" onclick="javascript:{location.href='shqglxzshq.php?lx=RCC';}" />
        <!--
        <input type="button" value="GIST" class="uusub" onclick="javascript:{location.href='shqglxzshq.php?lx=GIST';}" />
        <input type="button" value="pNET" class="uusub" onclick="javascript:{location.href='shqglxzshq.php?lx=pNET';}" />
        -->
    <?php
    }
    ?>
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">          
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="6%" align="center" bgcolor="#FFFFFF">操作</td>
<!--               <td width="9%" align="center" bgcolor="#FFFFFF">申请病种</td> -->
              <td width="20%" align="left" bgcolor="#FFFFFF">患者姓名 申请号 编码</br>患者身份号码</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">患者状态</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">首次申请日期<br/>批准入组日期</td>
              <td width="20%" align="left" bgcolor="#FFFFFF">指定医院 - 指定医生<br/>指定药房</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">审核人</td>
            </tr>

<?php        

  $sql = "select * from `hzh`";
  if($guanjiancisql!=""){
  $sql .="where ".$guanjiancisql;
  }
  $sql .= "order by id DESC limit $page $pagesize ";
//echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
//       echo "<pre>";
//       var_dump($Record);exit;
  if($ygrzrqksh!=''){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"shhjlerci.php?id=".$Record[0]."\">办理入组</a></td>";
  }else{
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"shqxq.php?id=".$Record[0]."\">查看</a></td>";
    }
    //echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><span  class=RuxianaiColor>".$Record[7]."</span></td>";
    echo "<td align=\"left\" bgcolor=\"#FFFFFF\">".$Record[4]."  ";
     echo sprintf("%05d", $Record[0]);
     if($Record[45]==1){echo "网";}
     if($Record[50]==2){echo "<font color='red'>重</font>";}
     echo "  ";
     if($Record[2]!=""){
     echo "S-".$Record[2];}
     echo "<br />".$Record[5].$Record[6]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
if($Record[3]=="申诉审核"||$Record[3]=="申诉待审核"){echo "审核";}else{echo $Record[3];}
 echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    //根据要求，无日期显示空白
    if($Record[43]!=""){echo $Record[43];}else{echo " ";} echo "<br />";
    if($Record[35]!=""){echo $Record[35];}else{echo " ";} echo "</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[12]!="")
    {
      $yyid=$Record[12];
    }else if($Record[11]!="")
    {
      $yyid=$Record[11];
    }else{
      $yyid=$Record[9];
    }
      $yysql = "select `sheng`,`shi`,`qu`,`yymch`,`zhdysh`,`yyzhdyf` from `yyyshdq` where id='".$yyid."'";
      //echo $yysql;
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
      $yyzhdyf=$yyRecord[5];
      //$yyRecord[0].$yyRecord[1].$yyRecord[2]." ".
        echo $yyRecord[3]." ".$yyRecord[4];
      }
     echo "<br />";
      /*$yfsql = "select `yfmch` from `yf` where `yfmch`='".$yyzhdyf."'";
      //echo $yfsql;
      $yfQuery_ID = mysql_query($yfsql);
      while($yfRecord = mysql_fetch_array($yfQuery_ID)){
        echo $yfRecord[0];
      }*/ 
     echo $yyzhdyf;
     echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
     
     //echo "入组用户";
    $shhejlsql = "select * from `shhejl` where `hzhid`='".$Record[0]."' and id in (select max(id) from `shhejl` where `hzhid`='".$Record[0]."')";
    $shhejlQuery_ID = mysql_query($shhejlsql);
    while($shhejlRecord = mysql_fetch_array($shhejlQuery_ID)){
    $wrzshhr=$shhejlRecord[2];
    }
    if($wrzshhr!=""){echo $wrzshhr;$wrzshhr="";}
    else{
    echo $Record[44];
    }         
     echo "</td></tr>";
    
  } 
?>
  
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
            <tr>
              <td>
          <?php
include('pagefy.php');
          ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
    <script type="text/javascript">
        var url = "";
        function chazhao() {
            var urlguanjianci = 'shqgl.php?guanjianci='+encodeURIComponent($('#Guanjianci').val()) + '&showtab=' + showtab;
            if($('#Guanjianci').val()!=''){
              location.href = urlguanjianci;
            }
        };
        function ygchaxun() {
            //var urlygrq = 'shqgl.php?ygrzrqksh='+encodeURIComponent($('#ygrzrqksh').val())+'&ygrzrqjsh='+encodeURIComponent($('#ygrzrqjsh').val()) + '&showtab=' + showtab;
            var urlygrq = 'shqgl.php?ygrzrqksh='+encodeURIComponent($('#ygrzrqksh').val()) + '&showtab=' + showtab;
            if($('#ygrzrqksh').val()!=''){
              location.href = urlygrq;
            }
        };
        function wshshqyym() {
            var urlwshshqyym = 'wshshqdr.php?wshshqyym='+encodeURIComponent($('#wshshqyym').val()) + '&showtab=' + showtab;
            if($('#wshshqyym').val()!=''&&$('#wshshqyym').val()>0){
              location.href = urlwshshqyym;
            }
        };
function guolv() {

  var urlguolv = 'shqgl.php?showtab=' + showtab;//alert(urlguolv);
  if(encodeURIComponent($('#s_province').val())!=''&&$('#s_province').val()!='省份'){
    urlguolv = urlguolv +'&ShengfenMingcheng=' + encodeURIComponent($('#s_province').val());
    if(encodeURIComponent($('#s_city').val())!=''&&$('#s_city').val()!='地级市'){
      urlguolv = urlguolv + '&ChengshiMingcheng=' + encodeURIComponent($('#s_city').val());
    }
    if(encodeURIComponent($('#YiyuanId').val())!=''){
      urlguolv = urlguolv + '&YiyuanId=' + encodeURIComponent($('#YiyuanId').val());
    }
    if(encodeURIComponent($('#YishengId').val())!=''){
      urlguolv = urlguolv + '&YishengId=' + encodeURIComponent($('#YishengId').val());
    }
    urlguolv = urlguolv + '&yylx=' + encodeURIComponent($('#yylx').val());
  }
  if(encodeURIComponent($('#ShijianLeixing').val())!=''){
    urlguolv = urlguolv + '&ShijianLeixing=' + encodeURIComponent($('#ShijianLeixing').val());
  }
  if(encodeURIComponent($('#ShenqingZhuangtai').val())!=''){
    urlguolv = urlguolv + '&ShenqingZhuangtai=' + encodeURIComponent($('#ShenqingZhuangtai').val());
  }
  if(encodeURIComponent($('#ZhuanzhenZhuangtai').val())!=''){
    urlguolv = urlguolv + '&ZhuanzhenZhuangtai=' + encodeURIComponent($('#ZhuanzhenZhuangtai').val());
  }
  if(encodeURIComponent($('#juanzhuleixing').val())!=''){
    urlguolv = urlguolv + '&juanzhuleixing=' + encodeURIComponent($('#juanzhuleixing').val());
  }
  if(encodeURIComponent($('#canbaoleixing').val())!=''){
    urlguolv = urlguolv + '&canbaoleixing=' + encodeURIComponent($('#canbaoleixing').val());
  }
  if(encodeURIComponent($('#ZuizaoJiehunRiqi').val())!=''){
    urlguolv = urlguolv + '&ZuizaoJiehunRiqi=' + encodeURIComponent($('#ZuizaoJiehunRiqi').val());
  }
  if(encodeURIComponent($('#ZuiwanJiehunRiqi').val())!=''){
    urlguolv = urlguolv + '&ZuiwanJiehunRiqi=' + encodeURIComponent($('#ZuiwanJiehunRiqi').val());
  }
  if(encodeURIComponent($('#shqly').val())!=''){
    urlguolv = urlguolv + '&shqly=' + encodeURIComponent($('#shqly').val());
  }
  if(encodeURIComponent($('#shqbzh').val())!=''){
    urlguolv = urlguolv + '&shqbzh=' + encodeURIComponent($('#shqbzh').val());
  }
  location.href = urlguolv;
}
        function guolvwly() {
            var urlguolv = 'shqgl.php?wlykshrq=' + encodeURIComponent($('#wlykshrq').val()) 
+ '&wlyjshrq=' + encodeURIComponent($('#wlyjshrq').val()) + '&showtab=' + showtab;
            if($('#wlykshrq').val()!=''||$('#wlyjshrq').val()!=''){
              location.href = urlguolv;
            }
        }

        $(function () {
        <?php
          if($_GET[showtab]!=''){
            echo "showtab=".$_GET[showtab].";";
          }else{
            echo "showtab=1;";
          }
            if($_GET[ShengfenMingcheng]!=""){
        ?>
      $("#s_province option[value='省份']").text("<?php echo $_GET[ShengfenMingcheng];?>");
      $("#s_province option[value='省份']").val("<?php echo $_GET[ShengfenMingcheng];?>");
        <?php
            }
            if($_GET[ChengshiMingcheng]!=""){
        ?>
      $("#s_city option[value='地级市']").text("<?php echo $_GET[ChengshiMingcheng];?>");
      $("#s_city option[value='地级市']").val("<?php echo $_GET[ChengshiMingcheng];?>"); 
        <?php
            }
            if($_GET[YiyuanId]!=""){
        ?>
      $("#YiyuanId option[value='']").text("<?php echo $_GET[YiyuanId];?>");
      $("#YiyuanId option[value='']").val("<?php echo $_GET[YiyuanId];?>");
        <?php
            }
            if($_GET[YishengId]!=""){
      $yyidmchsql = "select `zhdysh` from `yyyshdq` where `id`='".$_GET[YishengId]."'";
$jli=0;
      $yyidmchQuery_ID = mysql_query($yyidmchsql);
      while($yyidmchRecord = mysql_fetch_array($yyidmchQuery_ID)){
        ?>
      $("#YishengId option[value='']").text("<?php echo $yyidmchRecord[0];?>");
      $("#YishengId option[value='']").val("<?php echo $_GET[YishengId];?>"); 
        <?php
      }
            }
            if($_GET[ZuizaoJiehunRiqi]!=""){
        ?>
            $('#ZuizaoJiehunRiqi').val('<?php echo $_GET[ZuizaoJiehunRiqi]; ?>');
        <?php
            }
            if($_GET[ZuiwanJiehunRiqi]!=""){
        ?>
            $('#ZuiwanJiehunRiqi').val('<?php echo $_GET[ZuiwanJiehunRiqi]; ?>');
        <?php
            }
            if($_GET[ygrzrqksh]!=""){
        ?>
            $('#ygrzrqksh').val('<?php echo $_GET[ygrzrqksh]; ?>');
        <?php
            }
            
            if($_GET[wlykshrq]!=""){
        ?>
            $('#wlykshrq').val('<?php echo $_GET[wlykshrq]; ?>');
        <?php
            }
            if($_GET[wlyjshrq]!=""){
        ?>
            $('#wlyjshrq').val('<?php echo $_GET[wlyjshrq]; ?>');
        <?php
            }
        ?>
        
            chooseDateNow('ZuizaoJiehunRiqi', 'ZuiwanJiehunRiqi', true, true);
            chooseDateNow('KaishiShijian', 'JieshuShijian', true, true);
            chooseDateRange('ygrzrqksh', 'ygrzrqjsh', true, true);
            chooseDateRange('wlykshrq', 'wlyjshrq', true, true);
$("#s_province").click( function () {
        $("#YiyuanId").empty();
        $("#YiyuanId").html("");
        $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>");
        $("#YishengId").empty();        
        $("#YishengId").html(""); 
        $("#YishengId").append("<option value=\"\">--请选择医生--</option>");
});
$("#s_city").click( function () {
        $("#YiyuanId").empty();
        $("#YiyuanId").html("");
        $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>");
        $("#YishengId").empty();        
        $("#YishengId").html(""); 
        $("#YishengId").append("<option value=\"\">--请选择医生--</option>");
});
//省市医院医生 联动 开始
$("#s_city").change( function () {
  var chsh = $("#s_city").val();
  if(chsh!='' && chsh!='地级市'){
    //alert("手机号错误!");
    //$("#YiyuanId").append( "<option value=\"1\">Select</option>" );
    $.post(  
      'shqglchxyyac.php',  
      {
        shf:$('#s_province').val(),
        chsh:$('#s_city').val()
      },  
      function (data) { //回调click函数  
        $("#YiyuanId").empty();
        $("#YiyuanId").html(""); 
        $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>"+data);
        //alert(data);
      } 
    );
  }
});
$("#s_city").click( function () {
  var chsh = $("#s_city").val();
  if(chsh!='' && chsh!='地级市'){
    //alert("手机号错误!");
    //$("#YiyuanId").append( "<option value=\"1\">Select</option>" );
    $.post(  
      'shqglchxyyac.php',  
      {
        shf:$('#s_province').val(),
        chsh:$('#s_city').val()
      },  
      function (data) { //回调click函数  
        $("#YiyuanId").empty();
        $("#YiyuanId").html(""); 
        $("#YiyuanId").append("<option value=\"\">--请选择医院--</option>"+data);
        //alert(data);
      } 
    );
  }
});
          
$("#YiyuanId").change( function () {
  var yymch = $("#YiyuanId").val();
  if(yymch!=''){
    $.post(  
      'shqglchxyyyshac.php',  
      {
        yymch:$('#YiyuanId').val()
      },  
      function (data) { //回调click函数  
        $("#YishengId").empty();        
        $("#YishengId").html(""); 
        $("#YishengId").append("<option value=\"\">--请选择医生--</option>"+data);
        //alert(data);
      } 
    );
  }
}); 
$("#YiyuanId").click( function () {
  var yymch = $("#YiyuanId").val();
  if(yymch!=''){
    $.post(  
      'shqglchxyyyshac.php',  
      {
        yymch:$('#YiyuanId').val()
      },  
      function (data) { //回调click函数  
        $("#YishengId").empty();        
        $("#YishengId").html(""); 
        $("#YishengId").append("<option value=\"\">--请选择医生--</option>"+data);
        //alert(data);
      } 
    );
  }
});      
//省市医院医生 联动 结束

        });
    </script>

</body>
</html>