<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="修改用户记录";
include('spap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="yhgl.php">用户管理</a>
        > <?php echo $html_title;?></div>
    <form action="xgyhac.php" method="post">
    
<?php
  $yhid = $_GET['id'];
  $sql = "select * from `manager` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    
      echo "<table class=\"addTable\">";
      if($Record[10]=='4'){      
      $xgyqy=explode(',',$Record[11]);
      ?>
      
        <tr>
            <td>选择区域：
            </td>
            <td>
         <div style="width:700px;">     
     <?php
  $xgyqysql = "select * from `yf` group by  yfshi order by yfsheng ASC";
  $xgyqyQuery_ID = mysql_query($xgyqysql);
  $xgyqyxgyi=1;
  while($xgyqyRecord = mysql_fetch_array($xgyqyQuery_ID)){
    echo " <input name='xgyqy[]' type='checkbox' class='np' id='xgyqy".$xgyqyxgyi."' value='".$xgyqyRecord[14]."' ";
    if(in_array($xgyqyRecord[14],$xgyqy)){echo "checked";}
    echo " >".$xgyqyxgyi.".".$xgyqyRecord[14]." ";
    $xgyqyxgyi++;
  }
    ?>
        </div>
            </td>
        </tr>
      <?php
      }
      echo "<tr><td>用户名</td><td><span>".$Record[1]."</span><input id=\"yhid\" name=\"yhid\" type=\"hidden\" value=\"".$yhid."\" /></td></tr>";
      echo "<tr><td>名称</td><td><input class=\"input addInput\" id=\"Xingming\" name=\"Xingming\" type=\"text\" value=\"".$Record[9]."\" /><span style=\"color: red\">*</span></td></tr>";
      echo "<tr><td>手机</td><td><input class=\"input addInput\" id=\"Shouji\" name=\"Shouji\" type=\"text\" value=\"".$Record[3]."\" /></td></tr>";
      echo "<tr><td></td><td><input id=\"IsApproved\" name=\"IsApproved\" type=\"radio\" value=\"1\" ";
      if($Record[14]=="1"){echo "checked=\"checked\"";}
      echo "/><label for=\"IsApproved\">启用</label><input id=\"IsApproved\" name=\"IsApproved\" type=\"radio\" value=\"0\" ";
      if($Record[14]!="1"){echo "checked=\"checked\"";}
      echo "/><label for=\"IsApproved\">禁用</label></td></tr></table><p><input type=\"submit\" value=\"保存\" class=\"lgSub\" /></p>";
      $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yhgl.php\">";}

?>   
    </form>
    <hr />
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
