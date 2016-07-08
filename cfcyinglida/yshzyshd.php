<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $yhgldw = $_SESSION[gldw];
$html_title="赠药收到操作";
include('spap_head.php');
?>
    <div id="content">
        <div id="con">
            
    <div class="position">
        <a href="manager.php">药房药师管理</a>
        > <?php echo $html_title;?></div>
    <div class="form">
        <form action="yshzyshdac.php" onsubmit="return checkform()" method="post">
<?php       
  $shqid=$_GET['id'];
  $sql = "select * from `yfshqzy` where `id`='".$shqid."'";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
?>
<input type="hidden" name="id" value="<?php echo $shqid;?>" />
<?php
//已改过
if($Record[20]>"0"){
?>
        <div>
            <span class="label">规格（1）:</span> <?php if($Record['gg1'] == "1mg"){
            	echo "1mg*14片/盒";
            }else{
            	echo "5mg*28片/盒";
            }?></div>
        <div>
            <span class="label">收到数量:</span> <?php echo $Record[20];?>盒</div>
        <div>
            <span class="label"></span> <?php 
        if($Record[15]=="未知批号"){
        ?>共有<select id="phshl1" name="phshl1" style="width:60px;" onchange="phshl(1)">
<?php
    $ph1sql = "select * from `kfrk`";
    $ph1Query = mysql_query($ph1sql);
    $ph1num = mysql_num_rows($ph1Query);
    for($i=1;$i<=$ph1num;$i++)
    {
?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php
    }
?>
</select>个批号</br><input type="hidden" name="ph1_1_t" value="1" />
<?php
    for($i=1;$i<=$ph1num;$i++)
    {
?>
<div id="ph1_<?php echo $i;?>" <?php
if($i>1){echo "style=\"display:none;\"";}
?>>
<span class="label">批号:</span> <select id="ph1_<?php echo $i;?>_p" name="ph1_<?php echo $i;?>_p" style="width:110px;">
<?php
    $ph1sql = "select id,ph from `kfrk`";
    $ph1Query = mysql_query($ph1sql);
while($ph1Record = mysql_fetch_array($ph1Query)){

?>
<option value="<?php echo $ph1Record[0];?>"><?php echo $ph1Record[1];?></option>
<?php
}
?>
</select> <input class="input addInput" id="ph1_<?php echo $i;?>_s" name="ph1_<?php echo $i;?>_s" style="width: 46px;" type="text" value="" />盒
</div>
        <?php
    }
        }else{
  $ph1sql = "select ph from `kfrk` where `id`='".$Record[15]."'";
  $ph1Query_ID = mysql_query($ph1sql);
  while($ph1Record = mysql_fetch_array($ph1Query_ID)){
    echo "批号".$ph1Record['0']." <input type=\"hidden\" id=\"phshl1\" name=\"phshl1\" value=\"1\" /><input type=\"hidden\" id=\"ph1_1_p\" name=\"ph1_1_p\" value=\"".$Record[15]."\" /><input type=\"hidden\" id=\"ph1_1_s\" name=\"ph1_1_s\" value=\"".$Record[20]."\" />";
  }}

        ?>
        </div>    
<?php
}

?>
<script type="text/javascript">
var shdshl=<?php
$shdshl=0;
if($Record[15]=="未知批号"){$shdshl=$shdshl+$Record[20];}
 echo $shdshl;?>;
var phshlzsh1=<?php if($ph1num>0){echo $ph1num;}else{echo "0";}?>;
</script>
        <div>
        <span class="label">收到日期:</span> <input name="shdrq" type="txt" value="<?php echo date('Y-m-d');?>"></input></div>
        <div>
        <span class="label">运单号:</span> <input id="ydh" name="ydh" type="txt" <?php 
        if($Record[12]!=""){
         echo "value=\"".$Record[12]."\" readonly ";
         }else { echo "value=\"\" ";}
        ?>></input></div>
            
        <div class="btnPos">
            <input id="submitBtn" type="submit" value="保存" class="lgSub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="lgSub" /></div>
<?php
}
?>
        </form>
    </div>
<script type="text/javascript">
chooseDate('shdrq', true); 
function SubmitCheck(){//submit
  var phzsh=0;
  var yzh=1;
  var shdshl_t=0;
  if(phshlzsh1>0){phzsh=1;i=1;}
  if(phshlzsh2>0){if(phzsh>0){phzsh=phzsh+1;i=1;}else{phzsh=2;i=2;}}
  //alert(phzsh+"第"+i+"次");
  for(i;i<=phzsh;i++){//alert("2第"+i+"次");
  //alert(phzsh+"第"+i+"次a");
    phshl1=$("#phshl"+i).val();
    if(phshl1>1){
      for(j=1;j<=phshl1;j++){//alert("4第"+i+"次");
        if($("#ph"+i+"_"+j+"_p").val()!=$("#ph"+i+"_"+(Number(j)+1)+"_p").val()){
          if($("#ph"+i+"_"+j+"_s").val()==""){
            alert("批号"+i+"数量"+j+"未填写!");
            yzh=0;
          }else if($("#ph"+i+"_"+j+"_s").val()<0||parseInt($("#ph"+i+"_"+j+"_s").val())!=$("#ph"+i+"_"+j+"_s").val()){
            alert("批号"+i+"数量"+j+"填写错误!");
            yzh=0;
          }
          else {
            if(Number(shdshl_t)<'0'||Number($("#ph"+i+"_"+j+"_s").val())<'0'){
            shdshl_t=0;
            }else{shdshl_t=Number(shdshl_t)+Number($("#ph"+i+"_"+j+"_s").val());}
          }
        }else{
          alert("批号不能重复!");
          yzh=0;
        }
      }
    }
    else{
      if($("#ph"+i+"_1_s").val()==""){
        alert("批号"+i+"数量1未填写!");
        yzh=0;
      }else if($("#ph"+i+"_1_s").val()<0||parseInt($("#ph"+i+"_1_s").val())!=$("#ph"+i+"_1_s").val()){
        alert("批号"+i+"数量1填写错误!");
        yzh=0;
      }else{
        if(Number(shdshl_t)<'0'||Number($("#ph"+i+"_1_s").val())<'0'){
        shdshl_t=0;
        }else{shdshl_t=Number(shdshl_t)+Number($("#ph"+i+"_1_s").val());}
      }
    }
    //alert("数量"+i+":"+phshl1);
  }
  if(yzh==1){
    if(shdshl_t==0){alert("输入数量：不符合！");return false;}
    else if(shdshl_t!=shdshl){
      alert("输入数量："+shdshl_t+" 与应收到数量："+shdshl+" 不符合！");return false;
    }
    else{
      if($("#ydh").val()==""){
        alert("请填写运单号！");return false;
      }else{
        return true;
      }
    }
  }
  else{return false;}
}


        //页面加载后
        $(function () {

            //绑定提交验证
            $("input:submit").unbind("click");
            $("#submitBtn").bind("click", function () {
                if (SubmitCheck() && confirm("是否提交保存？")) {
                    $("input:submit").attr("disabled", true);
                    $("form").submit();
                    return false;
                }
                return false;
            });
            $("input:submit").attr("disabled", false);

        });


function phshl(v){
var phshl=document.getElementById('phshl'+v).value;
var phshlzsh;
if(v==1){phshlzsh=phshlzsh1;}
if(v==2){phshlzsh=phshlzsh2;}

for(i=1;i<=phshlzsh;i++)
{
if(i<=phshl){
document.getElementById('ph'+v+'_'+i).style.display='block';}
else{
document.getElementById('ph'+v+'_'+i).style.display='none';
}
}

}
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