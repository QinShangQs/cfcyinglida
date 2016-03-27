<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
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
  for($i;$i<=$start;$i++)
  {
  $strr.=chineseFirst($list[$i]); 
  }
  return $strr;
}
$yfid=$_POST['id'];
$yfyshname=$_POST['yfyshname'];
//药房名称：
$yfmch=$_POST['yfmch'];
if($yfmch!=""){$query="UPDATE `yf` SET `yfmch`='$yfmch'";}else{echo "错误，请关闭！";exit();}
//药房所在城市
$yfsheng=$_POST['yfsheng'];
//if($yfsheng!=""){$query .=",`yfsheng`='$yfsheng'";}
$query .=",`yfsheng`='$yfsheng'";
$yfshengjx = chinesechfen($yfsheng);
//if($yfshengjx!=""){$query .=",`yfshengjx`='$yfshengjx'";}
$query .=",`yfshengjx`='$yfshengjx'";
$yfshi=$_POST['yfshi'];
//if($yfshi!=""){$query .=",`yfshi`='$yfshi'";}
$query .=",`yfshi`='$yfshi'";
$yfshijx = chinesechfen($yfshi);
//if($yfshijx!=""){$query .=",`yfshijx`='$yfshijx'";}
$query .=",`yfshijx`='$yfshijx'";
$yfqu=$_POST['yfqu'];
//if($yfqu!=""){$query .=",`yfqu`='$yfqu'";}
$query .=",`yfqu`='$yfqu'";
$yfqujx = chinesechfen($yfqu);
//if($yfqujx!=""){$query .=",`yfqujx`='$yfqujx'";}
$query .=",`yfqujx`='$yfqujx'";
//药房地址
$yfdzh=$_POST['yfdzh'];
//if($yfdzh!=""){$query .=",`yfdzh`='$yfdzh'";}
$query .=",`yfdzh`='$yfdzh'";
//联系方式(座机)
$yfdh=$_POST['yfdh'];
//if($yfdh!=""){$query .=",`yfdh`='$yfdh'";}
$query .=",`yfdh`='$yfdh'";
//联系方式(移动)
$yfshj=$_POST['yfshj'];
//if($yfshj!=""){$query .=",`yfshj`='$yfshj'";}
$query .=",`yfshj`='$yfshj'";
//联系方式(传真)
$yfchzh=$_POST['yfchzh'];
//if($yfchzh!=""){$query .=",`yfchzh`='$yfchzh'";}
$query .=",`yfchzh`='$yfchzh'";
//联系方式(email)
$yfemail=$_POST['yfemail'];
if($yfemail!=""){$query .=",`yfemail`='$yfemail'";}
//库容
$yfkcrl=$_POST['yfkcrl'];
//if($yfkcrl!=""){$query .=",`yfkcrl`='$yfkcrl'";}
$query .=",`yfkcrl`='$yfkcrl'";
//指定药师
$yfzhdysh=$_POST['yfzhdysh'];
//if($yfzhdysh!=""){$query .=",`yfzhdysh`='$yfzhdysh'";}
$query .=",`yfzhdysh`='$yfzhdysh'";
//是否启用
$shfzt=$_POST['shfzt'];
//if($shfzt!=""){$query .=",`shfzt`='$shfzt'";}
$query .=",`shfzt`='$shfzt'";
//新增时间
$newtime = $_POST['newtime'];
$query .=",`newtime`='$newtime'";


//新增日期
$newtime = $_POST['newtime'];
//上班日期
$bjsj = '';
if(isset($_POST['bgsj']) && !empty($_POST['bgsj'])) {
    $bjsj = implode(',', $_POST['bgsj']);
}
$query .=",`bgsj`='$bjsj'";
$start1 = $_POST['start1'];
$start2 = $_POST['start2'];
$end1 = $_POST['end1'];
$end2 = $_POST['end2'];
$start = $end = '';
if(!empty($start1) && !empty($start2) && !empty($end1) && !empty($end2)) {
    $start = $start1.'-'.$start2;
    $end = $end1.'-'.$end2;
}
$query .=",`swsj`='$start'";
$query .=",`xwsj`='$end'";


//指定药师性别：
$yfzhdyshxb=$_POST['yfzhdyshxb'];
//if($yfzhdyshxb!=""){$query .=",`yfzhdyshxb`='$yfzhdyshxb'";}
$query .=",`yfzhdyshxb`='$yfzhdyshxb'";
$yfzhdyshyzh = '';
$yfshqyshyzh = '';
if(!empty($_FILES)) {
    if(isset($_FILES['yfzhdyshyzh']) && !empty($_FILES['yfzhdyshyzh']['tmp_name'])) {
        $yfzhdyshyzh = uploadFile('yfzhdyshyzh');
    }
    if(isset($_FILES['yfshqyshyzh']) && !empty($_FILES['yfshqyshyzh']['tmp_name'])) {
        $yfshqyshyzh = uploadFile('yfshqyshyzh');
    }
}
//指定药师样张：
//if($yfzhdyshyzh!=""){$query .=",`yfzhdyshyzh`='$yfzhdyshyzh'";}
if(isset($yfzhdyshyzh) && !empty($yfzhdyshyzh)) {
    $query .=",`yfzhdyshyzh`='$yfzhdyshyzh'";
}
//授权药师：
$yfshqysh=$_POST['yfshqysh'];
//if($yfshqysh!=""){$query .=",`yfshqysh`='$yfshqysh'";}
$query .=",`yfshqysh`='$yfshqysh'";
//授权药师样张：

//if($yfshqyshyzh!=""){$query .=",`yfshqyshyzh`='$yfshqyshyzh'";}
if(isset($yfshqyshyzh) && !empty($yfshqyshyzh)) {
    $query .=",`yfshqyshyzh`='$yfshqyshyzh'";
}
//授权药师电话：
$yfshqyshdh=$_POST['yfshqyshdh'];
//if($yfshqyshdh!=""){$query .=",`yfshqyshdh`='$yfshqyshdh'";}
$query .=",`yfshqyshdh`='$yfshqyshdh'";
//培训班：
$pxb=$_POST['pxb'];
//if($pxb!=""){$query .=",`pxb`='$pxb'";}
$query .=",`pxb`='$pxb'";
//培训日期：
$pxrq=$_POST['pxrq'];
//if($pxrq!=""){$query .=",`pxrq`='$pxrq'";}
$query .=",`pxrq`='$pxrq'";

//echo $shfzt;
    $query .=" WHERE `id` ='$yfid'";
    if($yfsheng=="省份"){$yfsheng="";}
    if($yfshi=="地级市"){$yfshi="";}
    if($yfqu=="市、县级市"){$yfqu="";}
    //echo $query;
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
    $shfztquery="UPDATE `manager` SET ";
    
    if($yfzhdysh!=""){$shfztquery .="`yhyl1`='$yfzhdysh'";}
    if($shfzt=="0"){$shfztquery .=",`yhzht` = '0'";}else{$shfztquery .=",`yhzht` = '1'";}
    
  $shfztquery.=" WHERE `names` = '$yfyshname'";
  $shfztresult=mysql_query($shfztquery);
  if(!$shfztresult)
  {
    echo mysql_error();
    echo "失败 <a href=\"manager.php\">点击返回重试</a>";
  }
  else{
  }
  //echo $query;
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyfgl.php\">";
    }
/**
 * 上传文件
 * @param string $filekey 图片名
 */
function uploadFile($filekey) {
    $destination_folder = dirname(__FILE__).'/qzyzh/';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!is_uploaded_file($_FILES[$filekey]['tmp_name'])) {
        //是否存在文件  
             echo "<script>alert('图片不存在!');</script>";
             exit;  
        }
        $file = $_FILES[$filekey];
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
        $filenames = time().'_'.rand(10, 99).".jpg";
        $destination = $destination_folder.$filenames;
//        if (file_exists($destination) && $overwrite != true)  
//        {  
//            echo "同名文件已经存在了";  
//            exit;  
//        }
        if(!move_uploaded_file ($filename, $destination)) {
            echo "<script>alert('移动文件出错');</script>";  
            exit;
        }
        return $filenames;
    }
}
function dump($str) {
    echo "<pre>";
    var_dump($str);
    exit;
}
?>