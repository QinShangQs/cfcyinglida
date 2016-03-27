<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw = $_SESSION[gldw];
$yhln = $_SESSION[yhln];
$yhyshid = $_SESSION[id];
$yhsql = "select yfmch from `yf` where `yfyshname`='".$yhln."'";
$yhQuery_ID = mysql_query($yhsql);
while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yfmch=$yhRecord[0];}
$yftmsql = "select `yfyshname` from `yf` where `yfmch`='".$yfmch."'";
$yftmQuery_ID = mysql_query($yftmsql);
while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfyshname[]=$yftmRecord[0];}
$yfidmchsql = "select id from `yf` where `yfmch`='".$yfmch."'";
$yfidmchQuery_ID = mysql_query($yfidmchsql);
while($yfidmchRecord = mysql_fetch_array($yfidmchQuery_ID)){$yfidmch[]=$yfidmchRecord[0];}
$yshidsql = "select `id` from `manager` where (`names`='".$yhln."'";
for($i=0;$i<count($yfyshname);$i++)
{
    if($yfyshname[$i]!=null){
        $yshidsql .= " or `names`='".$yfyshname[$i]."' ";
    }
}
$yshidsql .=")";
$yshidQuery_ID = mysql_query($yshidsql);
while($yshidRecord = mysql_fetch_array($yshidQuery_ID)){$yshid[]=$yshidRecord[0];}
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

$html_title="药品破损";
include('spap_head.php');
?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置：<a href="yppsgl.php"><?php echo $html_title;?></a></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong><?php echo $html_title;?></strong>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td>
                            <div class="insinsins">
                                <?php

                                $numsql="SELECT * FROM `psyp` where  `yfmch`='$yhgldw'";
                                $numq=mysql_query($numsql);
                                $num = mysql_num_rows($numq);//获取总条数
                                $pagenum = ceil($num/$pagesize);

                                ?>
                                <div class="insinsins" style="width:100%;">
                  <span>
                  <input type="button" value="新增药品破损信息" onclick="javascript:{location.href='yppsxzgl.php';}" class="uusub" />
                  <input type="button" value="打包邮寄" onclick="fahui();" class="uusub" />
                      <?php
                      $dayyd=date("d",strtotime("+1 day"));
                      if($dayyd==1){
                          $ny=date('Y-m');
                      }else {
                          $ny=date('Y-m',strtotime("-1 month"));
                      }
                      echo "<a href=\"psjhglxzpdf.php?ny=".$ny."\">下载《记录表》</a>";
                      ?>
                  </span>
                                </div>
                            </div>
            </div>


            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                <tr style="color:#1f4248; font-weight:bold; height:30px;">
                    <td width="10%" align="center" bgcolor="#FFFFFF">指定药房名称</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">规格</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">破损盒数</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">药品批号</td>
                    <td width="9%" align="center" bgcolor="#FFFFFF">药品状态</td>
                </tr>
                <?php

                $sql = "SELECT * FROM `psyp` where `yfmch`='$yhgldw'";

                $sql .=" order by id DESC limit $page $pagesize ";
                $Query_ID = mysql_query($sql);
                while($Record = mysql_fetch_array($Query_ID)){
                    echo "<tr style=\"color:#1f4248;  font-size:12px;\">";
                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                    echo $Record[3];
                    echo "</td>";

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                    echo $Record[4];
                    echo "</td>";

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                    echo $Record[5];
                    echo "</td>";

                    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">";
                    if($Record[6]!=""){
                        if($Record[6]=="1"){
                            echo "在药房";
                        }else if($Record[6]=="2"){
                            echo "已邮寄";
                        }else if($Record[6]=="3"){ echo "已签收";}
                    }else{echo "无";}
                    echo "</td>";

                    echo "</tr>";
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
            <script type="text/javascript">
                function fahui() {
                    if (confirm("确认是否打包寄回？")) {
                        location.href='yppsjhglac.php';
                    }
                };
            </script>
        </div>
    </div>
</div>
    </body>
    </html>
