<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="开启暂停药房";
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
    <form action="cfcxgyfyhac.php" method="post">
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `manager` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    
      echo "<table class=\"addTable\"><tr><td>用户名</td><td><span>".$Record[1]."</span><input id=\"yhid\" name=\"yhid\" type=\"hidden\" value=\"".$yhid."\" /></td></tr>";
      echo "<tr><td>药房名称</td><td>".$Record[6]."</td></tr>";
      echo "<tr><td>姓名</td><td>".$Record[9]."</td></tr>";
      echo "<tr><td>联系方式</td><td>".$Record[3]."</td></tr>";
      echo "<tr><td></td><td><input id=\"IsApproved\" name=\"IsApproved\" type=\"radio\" value=\"1\" ";
      if($Record[14]=="1"){echo "checked=\"checked\"";}
      echo "/><label for=\"IsApproved\">启用</label><input id=\"IsApproved\" name=\"IsApproved\" type=\"radio\" value=\"0\" ";
      if($Record[14]!="1"){echo "checked=\"checked\"";}
      echo "/><label for=\"IsApproved\">禁用</label></td></tr></table><p><input type=\"submit\" value=\"保存\" class=\"lgSub\" /><input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" /></p>";
      $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yhgl.php\">";}

?>   
    </form>                

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