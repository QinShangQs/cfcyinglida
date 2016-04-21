<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
include('wdb.php');
function chineseFirst($str)
{

    $str= iconv("UTF-8","gb2312", $str);    //如果程序是gbk的，此行就要注释掉

    //判断字符串是否全都是中文
    if (preg_match("/^[\x7f-\xff]/", $str))
    {
        $fchar=ord($str{0});   
        if($fchar>=ord("A") and $fchar<=ord("z") )return strtoupper($str{0});
        $a = $str; 
        $val=ord($a{0})*256+ord($a{1})-65536;
        if($val>=-20319 and $val<=-20284)return "A";   
        if($val>=-20283 and $val<=-19776)return "B";   
        if($val>=-19775 and $val<=-19219)return "C";   
        if($val>=-19218 and $val<=-18711)return "D";   
        if($val>=-18710 and $val<=-18527)return "E";   
        if($val>=-18526 and $val<=-18240)return "F";   
        if($val>=-18239 and $val<=-17923)return "G";   
        if($val>=-17922 and $val<=-17418)return "H";
        if($val>=-17417 and $val<=-16475)return "J";                 
        if($val>=-16474 and $val<=-16213)return "K";                 
        if($val>=-16212 and $val<=-15641)return "L";                 
        if($val>=-15640 and $val<=-15166)return "M";                 
        if($val>=-15165 and $val<=-14923)return "N";                 
        if($val>=-14922 and $val<=-14915)return "O";                 
        if($val>=-14914 and $val<=-14631)return "P";                 
        if($val>=-14630 and $val<=-14150)return "Q";                 
        if($val>=-14149 and $val<=-14091)return "R";                 
        if($val>=-14090 and $val<=-13319)return "S";                 
        if($val>=-13318 and $val<=-12839)return "T";                 
        if($val>=-12838 and $val<=-12557)return "W";                 
        if($val>=-12556 and $val<=-11848)return "X";                 
        if($val>=-11847 and $val<=-11056)return "Y";                 
        if($val>=-11055 and $val<=-10247)return "Z";
    } else
    {
        return false;
    }

}

//获取ajax传递的数据后，新增一条医院数据
$db = new DB();
$ajax = $db->getPost('ajax');
if(!empty($ajax)){
    $yymch_name = $db->getPost('yymch');
    if(!empty($yymch_name)) {
        $sql = "insert into `yyyshdq` (yymch) VALUE ('$yymch_name')";
        $result = mysql_query($sql);
        $hid = mysql_insert_id();
        exit(json_encode(array('yyid'=>$hid)));
    }
}

$ajaxremove = $db->getPost('ajaxremove');
if(!empty($ajaxremove)){
    $yyid = $db->getPost('yyid');
    if(!empty($yyid)) {
        $db->delete('yyyshdq', 'id='.$yyid);
        exit(json_encode(array('state'=>'success')));
    }
}



//医院id
$yymch_id = $_POST['yymch_id'];

//医院名称：
$yymch = $_POST['yymch'];
$yymchjx = chinesechfen($yymch);
//医院所在城市
$sheng = $_POST['sheng'];
$shengjx = chinesechfen($sheng);
$shi = $_POST['shi'];
$shijx = chinesechfen($shi);
$qu = $_POST['qu'];
$qujx = chinesechfen($qu);
    if($sheng=="省份"){$sheng="";}
    if($shi=="地级市"){$shi="";}
    if($qu=="市、县级市"){$qu="";}

//医院地址
$yydhz = $_POST['yydhz'];
//医院科室
$yyksh = $_POST['yyksh'];
//指定医生
$zhdysh = $_POST['zhdysh'];
//医生联系方式
$zhdyshdh = $_POST['zhdyshdh'];
//指定医生样张
$zhdyshyzh = $_POST['zhdyshyzh'];
//授权一医生
$shqysh1 = $_POST['shqysh1'];
//授权一医生样张
$shqyshyzh1 = $_POST['shqyshyzh1'];
//授权一联系方式
$shqyshdh1 = $_POST['shqyshdh1'];
//授权二医生
$shqysh2 = $_POST['shqysh2'];
//授权二医生样张
$shqyshyzh2 = $_POST['shqyshyzh2'];
//授权二联系方式
$shqyshdh2 = $_POST['shqyshdh2'];
//授权三医生
$shqysh3 = $_POST['shqysh3'];
//授权三医生样张
$shqyshyzh3 = $_POST['shqyshyzh3'];
//授权三联系方式
$shqyshdh3 = $_POST['shqyshdh3'];
//医生培训期数
$yshpxqsh = $_POST['yshpxqsh'];
//医生培训日期
$yshpxrq = $_POST['yshpxrq'];
//医生是否生效
$yhszht = $_POST['yhszht'];
//擅长病种 取消擅长病种
//$shchbzhs=$_POST['shchbzhs'];
//$shchbzh = implode(",",$shchbzhs);
//医院指定药房
$yyzhdyfs=$_POST['yyzhdyfs'];
if(is_array($yyzhdyfs)){
	$yyzhdyf = implode(",",$yyzhdyfs);
}else{
	$yyzhdyf = '';
} 
	
//是否接收AE回访
$shfjshhf = $_POST['shfjshhf'];
//医生联系方式2
$zhdyshdh2 = $_POST['zhdyshdh2'];
//指定医生电子邮箱
$zhdyshemail = $_POST['zhdyshemail'];
//授权医生电子邮箱
$shqyshemail = $_POST['shqyshemail'];


function chinesechfen($str)
{

  $list = array();
  $start = 0;
  $lengh = mb_strlen($str,'utf8');//这里可以是指定的长度
  while (count($list)<$lengh) {
      $list[] =  mb_substr($str, $start,1,'utf8');//也可以用$list .=
      $start++;
  }
  $i=0;
    $strr = '';
  for($i;$i<=$start;$i++)
  {
  $strr.=chineseFirst($list[$i]); 
  }
  return $strr;
}
//echo $yymch."<br>".$yymchjx."<br>".$dq."<br>".$dqjx;

//修改图片上传功能，在新增医院之后，传递过来的数据做修改处理,如果没有获取到新增医院的id则做添加处理

if($yymch_id !="") {
    if($yyzhdyf !=""){
        $query = "UPDATE `yyyshdq` SET `sheng` = '$sheng' ,`shengjx` = '$shengjx' ,`yymch` = '$yymch'  ,`yymchjx` = '$yymchjx'  ,`yyksh` = '$yyksh'  ,`zhdysh` = '$zhdysh'  ,`zhdyshdh` = '$zhdyshdh'  ,`zhdyshyzh` = '$zhdyshyzh'  ,`shqysh1` = '$shqysh1'  ,`shqyshyzh1` = '$shqyshyzh1'  ,`shqyshdh1` = '$shqyshdh1'  ,`shqysh2` = '$shqysh2'  ,`shqyshyzh2` = '$shqyshyzh2'  ,`shqyshdh2` = '$shqyshdh2'  ,`shqysh3` = '$shqysh3'  ,`shqyshyzh3` = '$shqyshyzh3'  ,`shqyshdh3` = '$shqyshdh3'  ,`yshpxqsh` = '$yshpxqsh'  ,`yshpxrq` = '$yshpxrq'  ,`yydhz` = '$yydhz'  ,`yhszht` = '$yhszht'  ,`yyzhdyf` = '$yyzhdyf'  ,`shfjshhf` = '$shfjshhf'  ,`shi` = '$shi'  ,`shijx` = '$shijx'  ,`qu` = '$qu'  ,`qujx` = '$qujx' ,`zhlbzh` = '$shchbzh' "
        ." ,`zhdyshdh2` = '$zhdyshdh2'"
        ." ,`zhdyshemail` = '$zhdyshemail'"
        ." ,`shqyshemail` = '$shqyshemail'"
        	." WHERE `id` ='$yymch_id'";

        $result = mysql_query($query);
        if(!$result) {
            echo mysql_error();
            echo "失败<a href=\'zhdyyxz.php\'>点击返回重试</a>";
        }else {
            echo "成功！<br/>";
            echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyygl.php\">";
        }
    }else{
        echo "失败,请选择指定药房！ <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
} else{

    if($yyzhdyf!=""){
      $query="insert into `yyyshdq`(sheng,shengjx,yymch,yymchjx,yyksh,zhdysh,zhdyshdh,zhdyshyzh,shqysh1,shqyshyzh1,shqyshdh1,shqysh2,shqyshyzh2,shqyshdh2,shqysh3,shqyshyzh3,shqyshdh3,yshpxqsh,yshpxrq,yydhz,yhszht,yyzhdyf,shfjshhf,shi,shijx,qu,qujx,zhlbzh,zhdyshdh2,zhdyshemail,shqyshemail)values('$sheng','$shengjx','$yymch','$yymchjx','$yyksh','$zhdysh','$zhdyshdh','$zhdyshyzh','$shqysh1','$shqyshyzh1','$shqyshdh1','$shqysh2','$shqyshyzh2','$shqyshdh2','$shqysh3','$shqyshyzh3','$shqyshdh3','$yshpxqsh','$yshpxrq','$yydhz','$yhszht','$yyzhdyf','$shfjshhf','$shi','$shijx','$qu','$qujx','$shchbzh','$zhdyshdh2','$zhdyshemail','$shqyshemail')";
      $result=mysql_query($query);
      if(!$result)
      {
        echo mysql_error();
        echo "失败 <a href=\"zhdyyxz.php\">点击返回重试</a>";
      } else {
          // shqyshyzh1
          $hid = mysql_insert_id();
          if(!empty($_FILES)) {
            foreach($_FILES as $key => $val) {
                $i = substr($key, -1);
                uploadFile($hid, $i);
            }
          }

      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyygl.php\">";
      }

    }else{
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }

}
/**
 * 上传文件
 * @param string $yyid 医院id
 * @param string $i 第几个图片
 */
function uploadFile($yyid, $i) {
    $destination_folder = dirname(__FILE__).'/qzyzh/';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $yshyzhid = $yyid;
        $imgi = $i;
//        if (!is_uploaded_file($_FILES["shqyshyzh".$i][tmp_name])) {
        //是否存在文件
//             echo "<script>alert('图片不存在!');</script>";
//             exit;
//        }
        $file = $_FILES["shqyshyzh".$i];
//        if($max_file_size < $file["size"]) {
//        //检查文件大小  
//            echo "<script>alert('文件太大!');</script>";  
//            exit;  
//        }
//        if(!in_array($file["type"], $uptypes)) {
//        //检查文件类型  
//            echo "<script>alert('文件类型不符!".$file["type"]."');</script>";  
//            exit;  
//        }  

        if(!file_exists($destination_folder)) {
            mkdir($destination_folder);  
        }  
        $filename=$file["tmp_name"];
        $image_size = getimagesize($filename);
        $pinfo=pathinfo($file["name"]);
        $ftype=$pinfo['extension'];  //文件后缀名，系统设计jpg所以不用获得了
        $destination = $destination_folder.sprintf("%03d", $yshyzhid)."-".$imgi.".jpg";  
//        if (file_exists($destination) && $overwrite != true)  
//        {  
//            echo "同名文件已经存在了";  
//            exit;  
//        }
        if(!move_uploaded_file ($filename, $destination)) {
            echo "<script>alert('移动文件出错');</script>";  
            exit;
        }
    }
    return true;
}

function dump($str) {
    echo "<pre>"; var_dump($str); exit;
}
?>