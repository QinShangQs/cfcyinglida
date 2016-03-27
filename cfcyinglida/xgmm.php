<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$html_title="修改密码";
include('xpap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <?php echo $html_title;?></div>
    <form action="xgmmac.php" method="post">
    <table class="addTable">
        <tr>
            <td>
                用户名
            </td>
            <td>
<?php
  $yhid = $_SESSION[yhid];
  $sql = "select * from `manager` where id='$yhid' ";
  $jshi = '0';
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    
      echo "<span>".$Record[1]."</span><input id=\"yhid\" name=\"yhid\" type=\"hidden\" value=\"".$yhid."\" />";
      $jshi = '1';
  }
    if($jshi=='0')
    {echo "错误!用户不存在或其他问题！<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=manager.php\">";}

?>
            </td>
        </tr>
        <tr>
            <td>
                新密码
            </td>
            <td>
                <input class="input addInput" id="Password" name="Password" type="password" /><span style="color: red">*</span>
            </td>
        </tr>
        <tr>
            <td>
                确认新密码
            </td>
            <td>
                <input class="input addInput" id="ConfirmPassword" name="ConfirmPassword" type="password" /><span
                    style="color: red">*</span>
            </td>
        </tr>

    </table>
    <p>
        <input type="submit" value="保存" class="lgSub" /></p>
    </form>
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
