<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
$yhqxxf=str_ireplace(",","','","'".implode(",",$_SESSION[yhqxxf])."'");
$xgyyfsql = "select `yfmch` from `yf` where `yfshi` in (".$yhqxxf.")  group by  yfmch order by id DESC ";
//echo $sql;
$xgyyfQuery_ID = mysql_query($xgyyfsql);
$xgyyf="";
while($xgyyfRecord = mysql_fetch_array($xgyyfQuery_ID)){
  if($xgyyf!=""){
    $xgyyf.=",";
  }
  $xgyyf.="'".$xgyyfRecord[0]."'";
}
$yhgldw=$xgyyf;
$html_title="药房调拨";
include('spap_head.php');

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

if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

$sql="select * from `yfdb` where `fcyfid` in (".$yhgldw.") or `fryfid` in (".$yhgldw.")";

$numq=mysql_query($sql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置： <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong><?php echo $html_title;?> </strong>
    </div>
    <div class="incontact w955 flt">
    
    
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
       <tr style="color:#1f4248; font-weight:bold; height:30px;">
            <th style="width: 50px" align="center" bgcolor="#FFFFFF">
                状态
            </th>  
            <th style="width: 40px" align="center" bgcolor="#FFFFFF">
                调拨类型
            </th>  
            <th style="width: 150px" align="center" bgcolor="#FFFFFF">
                发出药房
            </th>  
            <th style="width: 50px" align="center" bgcolor="#FFFFFF">
                发出药房药师
            </th>
            <th style="width: 150px" align="center" bgcolor="#FFFFFF">
                发入药房
            </th>
            <th style="width: 50px" align="center" bgcolor="#FFFFFF">
                发入药房药师
            </th>  
            <th style="width: 80px" align="center" bgcolor="#FFFFFF">
                发运日期
            </th>  
            <th style="width: 80px" align="center" bgcolor="#FFFFFF">
                收到日期
            </th>  
            <th style="width: 80px" align="center" bgcolor="#FFFFFF">
                运单号
            </th>
            <th style="width: 50px" align="center" bgcolor="#FFFFFF">
                批号
            </th>
            <th style="width: 50px" align="center" bgcolor="#FFFFFF">
                数量
            </th>
            <th style="width: 50px" align="center" bgcolor="#FFFFFF">
                实际发运数量
            </th>
       </tr>
       <?php 
        $query=mysql_query($sql);
        while($Record=mysql_fetch_array($query)){
       ?>
       <tr>
            <td align="center">
            <?php if($Record[3]=='0'||$Record[3]=='-1'){
              echo "待发运";
            }else if($Record[3]=='1'){echo "在途中";}
            else if($Record[3]=='2'){echo "已收到";}?>
            </td>
            <td align="center"><?php if($Record[13]==1){echo "同城";}else{echo "异地";}?></td>
            <td align="center"><?php echo $Record[1];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[10];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[2];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[11];?></td>
            
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[6];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[7];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[8];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php 
    $phnsql = "select `ph` from `kfrk` where `id` in (".$Record[12].")";
    $phnQuery_ID = mysql_query($phnsql);
    while($phnRecord = mysql_fetch_array($phnQuery_ID)){
      echo $phnRecord[0]." ";
    }
            //echo $Record[12];
            ?></td>
            <td align="center" bgcolor="#FFFFFF">
            <?php
            if($Record[5]!=''){
             echo $Record[5].'瓶';}
             ?>
            </td>
            <td align="center" bgcolor="#FFFFFF">
            <?php
            if($Record[3]>0){
              echo $Record[5].'瓶';
            }
             ?></td>
       </tr>
       <?php 
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
    </div>
    
</body>
</html>
