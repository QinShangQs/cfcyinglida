<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="暂停药房管理";
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
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
            <tr style="color:#1f4248; font-weight:bold; height:30px;">
              <td width="9%" align="center" bgcolor="#FFFFFF">操作</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">药房名称</td>
              <td width="7%" align="center" bgcolor="#FFFFFF">姓名</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">联系方式</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">用户名</td>
              <td width="9%" align="center" bgcolor="#FFFFFF">是否暂停发药</td>
            </tr>
<?php        

  $sql = "select * from `manager` where  `yhyl2`='3' and `yhzht`='0' ";
  $sql .= " order by id DESC ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    echo "<tr style=\"color:#1f4248; font-size:12px;\"><td align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"cfcxgyfyh.php?id=".$Record[0]."\">启用</a></td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[6]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[9]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[3]."</td>";
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[1]."</td>";
    if($Record[14]=="1")
    {
    echo "<td align=\"center\" bgcolor=\"#FFFFFF\">启用</td>";
    }else {echo "<td align=\"center\" bgcolor=\"#FFFFFF\">未启用</td>";}
    echo "</tr>";
  } 
?>
          </table>
        </div>
      </div>
    </div>
  </div><?php /*div[main]结束*/?>
</div><?php /*主框大div[wrap]结束*/?>
</body>
</html>