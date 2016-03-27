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

$numsql="SELECT * FROM `xgyyshxmclshq`";
if($_GET[page]){  
  $pageval=$_GET[page];
  $page=($pageval-1)*$pagesize;
  $page.=',';
}

$numq=mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num/$pagesize);
$html_title="协管员申请材料管理";
include('spap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <?php echo $html_title;?></div>
    <div class="forB">
<?php
$zshsql="SELECT SUM(hzhzlj),SUM(shqb) FROM `xgyyshxmclshq`";
$zsh=mysql_query($zshsql);

while($zshRecord = mysql_fetch_array($zsh)){$zshjs=$zshRecord[0];$zshjs1=$zshRecord[1];}
?>        &nbsp;已收到总数：<?php echo $zshjs."/".$zshjs1;?>（测试阶段为全部包含申请）</div>
     <div class="forB">
        <div class="forBr">
            &nbsp;&nbsp;
<?php
include('pagefy.php');
?>
        </div>
    </div>
    <table class="table">
        <tr>
            <th style="width:40px;">
                操作
            </th>
            <th style="width:70px;">
                申请日期
            </th>   
            <th style="width:70px;">
                寄出日期
            </th>  
            <th style="width:70px;">
                运单号
            </th>
            <th style="width:40px;">
                资料夹
            </th>            
            <th style="width:40px;">
                申请表
            </th>            
            <th style="width:240px;">
                医院医生
            </th>            
            <th style="width:40px;">
                协管员
            </th>           
            <th style="width:40px;">
                操作人
            </th>           
            <th style="width:80px;">
                备注
            </th>

        </tr>
<?php        

  $sql = "select * from `xgyyshxmclshq` ";
  if($guanjiancisql!=""){
  $sql .=$guanjiancisql;
  }
  $sql .= " order by id DESC limit $page $pagesize ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr>";
    if($Record[6]==""){
      echo "<td><a href=\"xgyxmzlfy.php?id=".$Record[0]."\">发运</a></td>";
    }else{
      echo "<td>已寄出</td>";
    }
    echo "<td>".$Record[4]."</td><td>".$Record[6]."</td><td>".$Record[7]."</td>";
    if($Record[6]==""){$zljshl=$Record[2];$shqshl=$Record[3];}else{$zljshl=$Record[12];$shqshl=$Record[13];}
    echo "<td>".$zljshl."</td><td>".$shqshl."</td>";
    $yysql = "select * from `yyyshdq` where `id`='".$Record[1]."'";
    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
    echo "<td>".$yyRecord[3]." ".$yyRecord[6]."</td>";
    }    
    echo "<td>".$Record[5]."</td><td>".$Record[8]."</td><td>".$Record[9]."</td>";
    echo "</tr>";
  } 
?>
        
    </table>
    <div class="forBr">
<?php
include('pagefy.php');
?>
        </div>
     <script type="text/javascript">
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
