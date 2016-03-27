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

if($url[query]!="undefined"&&$url[query]!=""){$url=$url[path]."?".$url[query]."&";}
else {
$url=$url[path]."?";//得到解析网址的 具体信息
}
  if($_GET[page]){  
    $pageval=$_GET[page];
    $page=($pageval-1)*$pagesize;
    $page.=',';
  }
  
if($_GET[kshrq]!=""&&$_GET[jshrq]!=""){
$kshrq=$_GET[kshrq];
$jshrq=$_GET[jshrq];

  if($guanjiancisql==""){
    //$guanjiancisql = "( `fyrq` >= '".$kshrq."' and `fyrq` <= '".$jshrq."' )";
  }else{
    //$guanjiancisql .= " and ( `fyrq` >= '".$kshrq."' and `fyrq` <= '".$jshrq."' )";
  }
}
if($_GET[yf]!=""){//按药房
  if($guanjiancisql==""){
    //$guanjiancisql ="`yfmch`='".$_GET[yf]."'";  
  }else{
    //$guanjiancisql .=" and `yfmch`='".$_GET[yf]."'";  
  }
}
$numsql="SELECT * FROM `gdkphsh`";
$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);

$html_title="空药瓶销毁管理";
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
                <div class="insinsins" style="width:100%;">
                  <span>
<input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly" placeholder="请输入开始日期"  size="12" value="" class="grd-white" style="width:120px" />-<input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly" placeholder="请输入结束日期" size="12" value="" class="grd-white" style="width:120px" />
<select id="YaoFangId" name="YaoFangId" style="width:400px;" class="grd-white2">
<?php 
if($_GET[yf]==""){
?>
<option selected="selected" value="">全部药房</option>
<?php
}else{
?>
<option selected="selected" value="<?php echo $_GET[yf];?>"><?php echo $_GET[yf];?></option>
<option value="">全部药房</option>
<?php
}
?>
<?php
$yfsql = "select id,yfshijx,yfmch from `yf` where `shfzt`='1' order by yfshijx ASC";
$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){
echo "<option value=\"".$yfRecord[2]."\">".$yfRecord[1]." ".$yfRecord[2]."</option>";
}
?> 
</select>
<input type="button" value="按条件过滤" onclick="guolv();" class="uusub2" />
                  </span>
                </div>
              </td>
            </tr>
          </table>                  
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">发送日期</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">交回数量</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">药房名称</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">销毁日期</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">操作人</td>
            </tr>
<?php        
  $sql = "SELECT * FROM `gdkphsh` order by id DESC limit $page $pagesize ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\">";
    if($Record[6]>0){
    echo "<a href='/cfckpjhxhglac.php?id=".$Record[0]."'>销毁</a>";
    }else{ echo "已销毁";}
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[5]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";

    /*$yfsql = "select `yfmch` from `yf` where `id`='".$Record[1]."'";
    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){
      echo $yfRecord[0];
    }*/
    echo $Record[7];
    echo "</td><td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[3]."</td><td align=\"center\" bgcolor=\"#FFFFFF\">";
    $czrsql = "SELECT `yhyl1` FROM `manager` where `id`='".$Record[4]."' ";
    $czrQuery_ID = mysql_query($czrsql);
    while($czrRecord = mysql_fetch_array($czrQuery_ID)){
    echo $czrRecord[0];
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
        function guolv() {
            var url = 'cfckpjhxhgl.php?kshrq=' + encodeURIComponent($('#KaishiRiqi').val()) + '&jshrq=' + encodeURIComponent($('#JiezhiRiqi').val()) + '&yf=' + encodeURIComponent($('#YaoFangId').val());
            location.href = url;
        }
        $(function () {
            chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
            <?php
            if($_GET[kshrq]!=""){
            ?>
            $("#KaishiRiqi").val('<?php echo $_GET[kshrq];?>');
            <?php
            }
            if($_GET[jshrq]!=""){
            ?>
            $("#JiezhiRiqi").val('<?php echo $_GET[jshrq];?>');
            <?php            
            }
            ?>
        });
    </script>
</body>
</html>