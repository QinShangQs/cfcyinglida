<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw=$_SESSION[gldw];
  $yhln = $_SESSION[yhln];
  $yhsql = "select id,yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yshid=$yhRecord[0];$yfmch=$yhRecord[1];}
  $yftmsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfid[]=$yftmRecord[0];}

$pagesize=10;//每页显示的条数：
$url=$_SERVER["REQUEST_URI"];//获取本页地址-网址
$url=parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=(\d+)&/", "", $url[query]);
$url[query] = preg_replace("/&page=(\d+)/", "", $url[query]);
$url[query] = preg_replace("/page=(\d+)/", "", $url[query]);

if($url[query]!="undefined"&&$url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

if($_GET[guanjianci]!=""){
$guanjiancinr=$_GET[guanjianci];
if(substr( $guanjiancinr, 0, 1 )=='x'||substr( $guanjiancinr, 0, 1 )=='X'){
$guanjiancinr=str_ireplace('x','',$guanjiancinr,$i);
$hzhrzid=$guanjiancinr;
}else{
$guanjiancinr=preg_replace('/^0*/', '', $guanjiancinr);
$hzhshqid=$guanjiancinr;
}
$guanjianci="(`hzhid`='".$hzhrzid."' or `hzhxm` LIKE '%".$guanjiancinr."%')";
}
$html_title="新增空瓶余药记录";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<?php echo $html_title;?></div>
			<div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <div class="top">
        <input type="text" id="Guanjianci" name="Guanjianci" class="grd-white2"  value="<?php echo $_GET[guanjianci];?>" placeholder="患者姓名、编码" />
        <input type="button" value="查找" onclick="chazhao();" class="uusub"/>

        </div>
<?php

/*$numsql="SELECT * FROM `hzh` where (`shqzht`='入组' or `shqzht`='出组') and (`lyyf`='$yshid'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $numsql .= " or `lyyf`='".$yfid[$i]."' ";
  }
}
$numsql .=")";*/
$numsql="SELECT * FROM `hzh` where (`shqzht`='入组' or `shqzht`='出组') and `lyyf`='$yhgldw'";
if($guanjianci!=""){
$numsql .=" and ".$guanjianci;
}
//echo $numsql;
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
?>
   <div class="top">
           <?php
include('pagefy.php');
          ?>
          </div>
      <div class="top">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr style="color:#1f4248; font-weight:bold; height:30px;">
            
            <td width="11%" align="center" bgcolor="#FFFFFF">
                操作
            </td>

            <td width="11%" align="center" bgcolor="#FFFFFF">
                患者编码
            </td>
            <td width="12%" align="center" bgcolor="#FFFFFF">
                患者姓名
            </td>
            <td width="11%" align="center" bgcolor="#FFFFFF">
                联系电话
            </td>
            <td width="9%" align="center" bgcolor="#FFFFFF">
                已领赠药
                <br />
                次数/瓶数
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                入组医院
            </td>
            <td width="15%" align="center" bgcolor="#FFFFFF">
                正式入组日期
            </td>
            <td width="10%" align="center" bgcolor="#FFFFFF">
                状态
            </td>
            <td width="11%" align="center" bgcolor="#FFFFFF">
                病种
            </td>
        </tr>
<?php        


  /*$sql = "select * from `hzh` where (`shqzht`='入组' or `shqzht`='出组') and (`lyyf`='$yshid'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $sql .= " or `lyyf`='".$yfid[$i]."' ";
  }
}
  $sql .= ")";*/
  $sql = "select * from `hzh` where (`shqzht`='入组' or `shqzht`='出组') and `lyyf`='$yhgldw'";
if($guanjianci!=""){
$sql .=" and ".$guanjianci;
}
  $sql .= " order by id DESC limit $page $pagesize ";
  //echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  $hzhshcyyshj=$Record[30];
  $hzhygshcyyshj=$Record[35];
  $hzhjzhlx=$Record[25];
  $hzhjzhshl=$Record[26];
  
            //读取次数
$lynumq=mysql_query("SELECT * FROM `zyff` where `hzhid`='".$Record[0]."' and `tshqk`='0'");
$lynum = mysql_num_rows($lynumq);//获取总条数
if($lynum==""){$lynum="0";}
?>
        <tr style="color:#1f4248; font-size:12px;">
            <td width="11%" align="center" bgcolor="#FFFFFF"><?php
  $hzhsql = "select * from `zyff` where `hzhid`='".$Record[0]."' and `tshqk`='1'";
  $hzhQuery_ID = mysql_query($hzhsql);
  $hzhnum = mysql_num_rows($hzhQuery_ID);
  if($hzhnum=="0"){
             ?><a href="kpyyhshxz.php?id=<?php echo $Record[0];?>">新增</a><?php }else{ echo "新增";}
             ?></td>
            <td width="11%" align="center" bgcolor="#FFFFFF">I-<?php echo $Record[2];?></td>
            <td width="12%" align="center" bgcolor="#FFFFFF"><a href="yshfyzhxqsh.php?id=<?php echo $Record[0];?>"><?php echo $Record[4];?></a></td>
            <td width="11%" align="center" bgcolor="#FFFFFF"><?php echo $Record[15];?></td>
            <td width="9%" align="center" bgcolor="#FFFFFF"><a href="yshfyxx.php?id=<?php echo $Record[0];?>"><?php
            echo $lynum;?>次/<?php
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){if($lyshlnum[0]!=""){echo $lyshlnum[0];}else{echo "0";}}
            ?>瓶</a></td>

            <td width="10%" align="center" bgcolor="#FFFFFF"><?php 
            //读取医院
      $yysql = "select sheng,shi,qu,yymch,zhdysh from `yyyshdq` where id='".$Record[9]."'";
      $yyQuery_ID = mysql_query($yysql);
      while($yyRecord = mysql_fetch_array($yyQuery_ID)){
        echo $yyRecord[3]." ".$yyRecord[4];
      }
            ?></td>
            <td width="15%" align="center" bgcolor="#FFFFFF"><?php echo $Record[34];?></td>
            <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $Record[shqzht];?></td>
            <td width="11%" align="center" bgcolor="#FFFFFF"><?php echo $Record[7];?></td>
        </tr>

<?php
  } 
?>        

        
    </table>
    </div>
     <script type="text/javascript">
        function chazhao() {
            var url = 'kpyyhshgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        };
        </script>
   <div class="top">
           <?php
include('pagefy.php');
          ?>
              </div>
    </div>
        </div>
    </div>
</body>
</html>
