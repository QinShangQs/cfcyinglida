<?php session_start(); 
include('newdb.php');
//验证权限
if(((in_array('ydbgtj_fb',$_SESSION[yhqxxf])&&$_GET['fblx']==1)||(in_array('jjhybypfpmx_fb',$_SESSION[yhqxxf])&&$_GET['fblx']==3)||$_SESSION[yhshf]=='10'||$_SESSION[yhqxxf][0]=='admin_AllowAll')&&$_GET['ym']!=''&&$_GET['fblx']!=''){
$ym=$_GET['ym'];
$fblx=$_GET['fblx'];
$fbrq=date('Y-m',strtotime("-".$ym." months".date('Y-m')));
$czrq=date('Y-m-d');
$czr=$_SESSION[yhname];
    $query="insert into `cfcbbfb`(`fblx`,`fbrq`,`czr`,`czrq`)values('$fblx','$fbrq','$czr','$czrq')";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
      $url = $_SERVER['HTTP_REFERER'];
      function ObHeader($url,$time=0,$msg=""){
        $url = str_replace(array("\n", "\r"), '', $url);
        if (!headers_sent()) {
          if(0===$time) {
            header("Location: ".$url);
          }else {
            header("refresh:{$time};url={$url}");
            echo($msg);
          }
          exit();
        }else {
          exit("{$msg}<meta http-equiv='Refresh' content='{$time};URL={$url}'>");
        }
      }
      ObHeader($url,2,"成功！");
      exit();
    //echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=cfcydgzbg.php\">";
    }
}else{
echo "错误";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=/\">";
      exit();
}
?>