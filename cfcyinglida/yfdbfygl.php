<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw=$_SESSION[gldw];
$fyid=$_GET['id'];
$html_title="药房调拨发运管理";
include('spap_head.php');
?>
    <div class="main">
		<div class="insmain">
    <div class="thislink">当前位置： <?php echo $html_title;?> </div>
    <div class="inwrap flt top">
				<div class="title w977 flt">
				    <strong><?php echo $html_title;?> </strong>
    </div>
    <div class="incontact w955 flt">
       <form action="yfdbfyglac.php" method="post">
       <input type="hidden" name="hidden" value="<?php echo $fyid;?>">
       <?php
       $pihaosql="select * from `yfshqzy` where `yfmch`='".$yhgldw."' and `shqzht`='3'";
       $pihaoquery=mysql_query($pihaosql);
       $pihaostr='';
       $phstr='';
       ?>
       批号：<select name="pihao" class="grd-white2" id="pihaoid" style="width:300px;">
       <option value="">-请选择-</option>
       <?php
       while($pihaoRecord=mysql_fetch_array($pihaoquery)){
         $pihaostr.=$pihaoRecord[15].',';
       }
       $pihaoarr=explode(',',$pihaostr);
       $uniquepihao=array_unique($pihaoarr);
       ?>
       <?php
       for($i=0;$i<count($uniquepihao);$i++){
        if($uniquepihao[$i]!=''&&$uniquepihao[$i]!=0&&$uniquepihao[$i]!=null){
        $phsql="select * from `kfrk` where `id`=".$uniquepihao[$i];
        $phquery=mysql_query($phsql);
        while($phRecord=mysql_fetch_array($phquery)){
          $phstr.=$phRecord[1].',';
          }
        }
       }
       $pharr=explode(',',$phstr);
       $uniqueRecord=array_unique($pharr);
       for($j=0;$j<count($uniqueRecord);$j++){
        if($uniqueRecord[$j]!=''){
         ?>
         <option value="<?php echo $uniqueRecord[$j];?>"><?php echo $uniqueRecord[$j];?></option>
       <?php
          }
        }
       ?>
       </select><br>
       <div class="top">
       运单号：<input type="text" name="yundanhao" id="ydhid" value="" class="grd-white">
       </div>
       <div class="top">
       日期：<input type="text" name="fyrq" value="<?php echo date("Y-m-d");?>" class="grd-white" id="fyrqid">
       </div>
       <div class="top">
       <?php
       $shlsql="select `dbyppsh`,`dbypgg` from `yfdb` where `id`=".$fyid;
       $shlquery=mysql_query($shlsql);
       while($shlRecord=mysql_fetch_array($shlquery)){
       ?>
       数量：<input type="text" name="fyshl" id="fyshlid" value="<?php echo $shlRecord[0];?>" class="grd-white">
            <div class="top">
       规格：<input type="text" name="fygg" value="<?php echo $shlRecord[1];?>" class="grd-white" readonly>

       </div>
       <?php
       }
       ?>
       </div>
  
       <div class="top">
       <input type="submit" name="submit" id="submit" value="提交" class="uusub">
       </div>
       </form>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
    chooseDate('fyrqid',true);
      $("#submit").click(function(){
        var ph=document.getElementById('pihaoid').value; 
        var ydh=document.getElementById('ydhid').value; 
        var shl=document.getElementById('fyshlid').value; 
        if(ph==''){
          alert('批号为空，请检查');
          return false;
          //document.getElementById('submit').disabled=true;
        }
        if(ydh==''){
          alert('运单号为空，请检查');
          //document.getElementById('submit').disabled=true;
          return false;
        }
        if(shl==''){
          alert('发运数量为空，请检查');
          //document.getElementById('submit').disabled=true;
          return false;
        }

      });
     $("#pihaoid").change(function(){
        var yfmch=$("#pihaoid").val();
        //alert(yfmch);
       });
    </script>
</body>
</html>