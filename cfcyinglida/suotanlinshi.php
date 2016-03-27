<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
   // Mysql_select_db("suotan");
   
     Mysql_select_db("suotantmp");
 $query="select * from pinggu_2 where U !='' ";
  //echo $query;
  $result=mysql_query($query);
 //$rows = mysql_fetch_assoc($result);
  //var_dump($rows);
 /* FOR ($i = 1; $i <= $rows['E']; $i++)
{
//$sql="insert into  zyff (lyshl, fyshl,jhkpshl,fyr,yfmch) VALUES ('3','3','3','".$rows['C']."','".$rows['B']."')";
 $re=mysql_query($sql);
// var_dump($sql);
 if($re){
      echo"yes".$i;
 }else{
    echo"no";
 }

}   */ 
  
  
  
  
  $i=1;
 while($rows = mysql_fetch_assoc($result)){ 
      // zhjhm   strlen()
      
       //substr($str,9,4);
       
    /*   $nian=substr($rows['zhjhm'],6,4);
       $yue=substr($rows['zhjhm'],10,2);
       $ri=substr($rows['zhjhm'],12,2);
       $riqi=$nian."-".$yue."-".$ri;  
      if(strlen($rows['zhjhm'])==15){
        $xi=substr($rows['zhjhm'],15,1); 
      
      }else{
      $xi=substr($rows['zhjhm'],17,1);
      }
       
       if($xi==0){
       echo $rows['id']."<br>";
       }
       */
     
       //$xing=substr($rows['zhjhm'],17,1);
       // $rows['T']= date('Y-m-d',strtotime($rows['T']));
 // $rows['C']= substr($rows['C'] ,-5);
// if( strlen($rows['D']) > 5){ 
 //  $rows['E']= substr($rows['D'] ,-5);
 //  }
  //$rows['yfshi']=trim(str_replace("市","",$rows['yfshi']));
 //$time=strtotime($rows['E']); 
/*  $rows['B']=trim(str_replace("00:00:00","",$rows['B']));
  $rows['C']=trim(str_replace("00:00:00","",$rows['C']));
  $rows['D']=trim(str_replace("院内","",$rows['D']));
  $rows['E']=trim(str_replace(".0","",$rows['E'])); */
 
 //  $time=strtotime($rows['B']);
  // var_dump($time);die;
  /* $rows['D']=trim(str_replace(".0","",$rows['D']));
   $rows['E']=trim(str_replace(".0","",$rows['E']));
   $rows['F']=trim(str_replace(".0","",$rows['F']));
   $rows['G']=trim(str_replace(".0","",$rows['G']));
   $rows['H']=trim(str_replace(".0","",$rows['H']));
   $rows['I']=trim(str_replace(".0","",$rows['I']));
   $rows['J']=trim(str_replace(".0","",$rows['J'])); */
   //$rows['Y']=trim(str_replace(".0","",$rows['Y']));
   // $rows['N']=trim(str_replace("00:00:00","",$rows['N']));
  
 /*   if($rows['Y']==1){
    $rows['Y']='死亡';
    }
    
     if($rows['Y']==2){
    $rows['Y']='严重副作用';
    }
     if($rows['Y']==3){
    $rows['Y']='疾病进展——患者对于治疗没有效果';
    }
     if($rows['Y']==4){
    $rows['Y']='失去联系';
    }
     if($rows['Y']==5){
    $rows['Y']='患者主动退出';
    }
     if($rows['Y']==6){
    $rows['Y']='不依从拒绝治疗';
    }
     if($rows['Y']==7){
    $rows['Y']='其他不适合服用索坦的病症';
    }
     if($rows['Y']==8){
    $rows['Y']='更换治疗方案';
    }
     if($rows['Y']==9){
    $rows['Y']='其他';
    }  */
    //本次RECIST评估（CR1/PR2/SD3/PD4）
    if($rows['J']==1){
    $pinggu='CR';
    }
     if($rows['J']==2){
    $pinggu='PR';
    }
    
     if($rows['J']==3){
    $pinggu='SD';
    }
    
    
     if($rows['J']==4){
    $pinggu='PD';
    }
    
    
    
    
    
    $qita=$rows['L'].','.$rows['M'].','.$rows['N']; 
   //echo str_replace("world","John","Hello world!");
 //substr($str_bh,-4);
  //UPDATE Person SET Address = 'Zhongshan 23', City = 'Nanjing'  WHERE LastName = 'Wilson'
 // $sql="insert into  yfshqzy (yshxm,gg1,shqshl1,shqzht,shqrq,fyrq,shdrq,ph1,shhr,fyr,pfrq,pfshl1,phshl1,yfmch) VALUES ('".$rows['N']."', '12.5mg*28粒/瓶','".$rows['E']."','3','".$rows['A']."','".$rows['B']."','".$rows['C']."','S001A','1','3','".$rows['A']."','".$rows['E']."','".$rows['E']."','".$rows['O']."')";
  //insert into  hzhrz2 (id, hzhid) VALUES ('".$rows['hzhid']."', '".$rows['id']."')
  // $i++;
     Mysql_select_db("cfcyinglida");
   $sql="insert into  yxpgbg_bei  (hzhid,bglx,lchzhd,zhdrq,shffshyzhfzy,zhzhxmshfcz,shfjyjxfyst,shffystbzh) VALUES ('".$rows['U']."','2', '".$pinggu."','".$rows['I']."','".$rows['K']."','".$qita."','".$rows['O']."','".$rows['P']."')";
   
    //var_dump($sql); die;
   //  $sql="  ";
      $result2=mysql_query($sql); 
    
       if($result2){
       
       echo "$i "."yes".$rows['id']."<br>";
       
       }else{
          echo "shibai";
      }   
    
  }  
  ?>