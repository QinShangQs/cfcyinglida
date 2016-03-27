<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_GET['id'];
$html_title="CFC用户权限管理";
include('spap_head.php');
?>
<div class="main">
		<div class="insmain">
			<div class="thislink">当前位置：<a href="yshzyshqgl.php"><?php echo $html_title;?></a> </div> 
    <div class="inwrap flt top">
				<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong>
				</div>
				<div class="incontact w955 flt">
    <link href="css/prehuanhang.css" rel="stylesheet"
        type="text/css" media="screen" />
    <div class="form">
        <form action="cfcmanagerac.php" method="post">      
        <fieldset class="top">
            <legend>选择用户</legend>
            <div>
                <span class="label">用户名：</span> 
<?php        
    $sql = "select id,yhyl1,yhyl3 from `manager` where `id`='".$id."' ";

    $Query_ID = mysql_query($sql);
    while($Record = mysql_fetch_array($Query_ID)){
      echo $Record[1];
      $yhqxxf=explode(',',$Record[2]);
      //print_r($yhqxxf);
    }
?> 
<input id="id" name="id" type="hidden" value="<?php echo $id;?>" />
            </div>
            <div>
                <span class="label">特别权限：</span> <input name='purviews[]' type='checkbox' class='np' id='purviews0' value='admin_AllowAll' <?php if(in_array('admin_AllowAll',$yhqxxf)){echo "checked";}?> >可以进行任意操作
            </div>
                    <div class="top">
            <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
    <fieldset style="font-size: large; margin: 20px;">
        <legend>CFC操作</legend>
                <div class="homePanelmini"> 
                 <table width='860'>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>1、申请管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews1' value='shqgl_ck' <?php if(in_array('shqgl_ck',$yhqxxf)){echo "checked";}?> >查看
          	<input name='purviews[]' type='checkbox' class='np' id='purviews2' value='shqgl_xz' <?php if(in_array('shqgl_xz',$yhqxxf)){echo "checked";}?> >新增
          	<input name='purviews[]' type='checkbox' class='np' id='purviews3' value='shqgl_shh' <?php if(in_array('shqgl_shh',$yhqxxf)){echo "checked";}?> >审核
          	<input name='purviews[]' type='checkbox' class='np' id='purviews4' value='shqgl_zhzh' <?php if(in_array('shqgl_zhzh',$yhqxxf)){echo "checked";}?> >转诊
          	<input name='purviews[]' type='checkbox' class='np' id='purviews42' value='shqgl_chz' <?php if(in_array('shqgl_chz',$yhqxxf)){echo "checked";}?> >出组
        	 </td></tr>

        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>2、转诊管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews5' value='zhzhgl_ck' <?php if(in_array('zhzhgl_ck',$yhqxxf)){echo "checked";}?> >查看
        	 </td></tr>

        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>3、指定医院医生管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews6' value='zhdyygl_ck' <?php if(in_array('zhdyygl_ck',$yhqxxf)){echo "checked";}?> >查看
        	 </td></tr>

        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>4、指定药房药师管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews7' value='zhdyfgl_ck' <?php if(in_array('zhdyfgl_ck',$yhqxxf)){echo "checked";}?> >查看
        	 </td></tr>

        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>5、网上预约管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews8' value='wshyygl_ck' <?php if(in_array('wshyygl_ck',$yhqxxf)){echo "checked";}?> >查看
          	<input name='purviews[]' type='checkbox' class='np' id='purviews9' value='wshyygl_dr' <?php if(in_array('wshyygl_dr',$yhqxxf)){echo "checked";}?> >导入
        	 </td></tr>

        	 <tr>
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>6、随访记录管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews10' value='sfjlgl_ck' <?php if(in_array('sfjlgl_ck',$yhqxxf)){echo "checked";}?> >查看
          	<input name='purviews[]' type='checkbox' class='np' id='purviews11' value='sfjlgl_xz' <?php if(in_array('sfjlgl_xz',$yhqxxf)){echo "checked";}?> >新增
        	 </td></tr>

        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>7、不良事件报告管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews34' value='blshjbggl_ck' <?php if(in_array('blshjbggl_ck',$yhqxxf)){echo "checked";}?> >查看
          	<input name='purviews[]' type='checkbox' class='np' id='purviews35' value='blshjbggl_xz' <?php if(in_array('blshjbggl_xz',$yhqxxf)){echo "checked";}?> >新增
        	 </td></tr>
        	 
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>8、医学评估报告</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews36' value='yxpgbg_ck' <?php if(in_array('yxpgbg_ck',$yhqxxf)){echo "checked";}?> >查看
          	<input name='purviews[]' type='checkbox' class='np' id='purviews37' value='yxpgbg_xz' <?php if(in_array('yxpgbg_xz',$yhqxxf)){echo "checked";}?> >新增
        	 </td></tr>
        	 
        	  </table>
        	 </div>
    </fieldset>
    <fieldset style="font-size: large; margin: 20px;">
        <legend>空药瓶、剩余药物回收</legend>
                <div class="homePanelmini"> 
                 <table width='860'>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>1、空药瓶交回明细</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews12' value='kypjhgl_ck' <?php if(in_array('kypjhgl_ck',$yhqxxf)){echo "checked";}?> >查看
        	 </td></tr>

        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>2、剩余药物交回明细</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews13' value='shyywjhmx_ck' <?php if(in_array('shyywjhmx_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>
        <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style="text-align:left;">3、空药瓶销毁管理</td>
         </tr>
        <tr>
        <td height='25' colspan='2' style="text-align:left;">
                   	<input name='purviews[]' type='checkbox' class='np' id='purviews14' value='kypxhgl_ck' <?php if(in_array('kypxhgl_ck',$yhqxxf)){echo "checked";}?> >查看
          	<input name='purviews[]' type='checkbox' class='np' id='purviews15' value='kypxhgl_xh' <?php if(in_array('kypxhgl_xh',$yhqxxf)){echo "checked";}?> >销毁
  	
        </td>
        </tr>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>4、剩余药物销毁管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews16' value='shyywxhgl_ck' <?php if(in_array('shyywxhgl_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews17' value='shyywxhgl_xh' <?php if(in_array('shyywxhgl_xh',$yhqxxf)){echo "checked";}?> >销毁
        </td>
        </tr>
        	  </table>
        	 </div>
        
    </fieldset>
    <fieldset style="font-size: large; margin: 20px;">
        <legend>药品流向管理</legend>
                <div class="homePanelmini"> 
                 <table width='860'>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>1、待发清单管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews18' value='dfqdgl_ck' <?php if(in_array('dfqdgl_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>2、药品发放管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews19' value='ypffgl_ck' <?php if(in_array('ypffgl_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>        
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>3、药品预测</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews20' value='ypyc_ck' <?php if(in_array('ypyc_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>   
        	  </table>
        	 </div>
    </fieldset>
    <fieldset style="font-size: large; margin: 20px;">
        <legend>药房仓库管理</legend>
                <div class="homePanelmini"> 
                 <table width='860'>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>1、药房赠药申请管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews21' value='yfzyshqgl_ck' <?php if(in_array('yfzyshqgl_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews22' value='yfzyshqgl_pzh' <?php if(in_array('yfzyshqgl_pzh',$yhqxxf)){echo "checked";}?> >批准
        </td>
        </tr>           
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>2、药物运输申请管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews23' value='ywyshshqgl_ck' <?php if(in_array('ywyshshqgl_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>           
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>3、药房赠药收到管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews24' value='yfzyshdgl_ck' <?php if(in_array('yfzyshdgl_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>           
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>4、出入库统计</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews25' value='chrktj_ck' <?php if(in_array('chrktj_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>  
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>5、药房调拨管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews26' value='yfdbgl_ck' <?php if(in_array('yfdbgl_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews27' value='yfdbgl_chl' <?php if(in_array('yfdbgl_chl',$yhqxxf)){echo "checked";}?> >处理
        </td>
        </tr>  
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>6、暂停药房管理</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews28' value='ztyfgl_ck' <?php if(in_array('ztyfgl_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews29' value='ztyfgl_chl' <?php if(in_array('ztyfgl_chl',$yhqxxf)){echo "checked";}?> >处理
        </td>
        </tr> 
        	  </table>
        	 </div>
    </fieldset>
    <fieldset style="font-size: large; margin: 20px;">
        <legend>报表统计</legend>
                <div class="homePanelmini"> 
                 <table width='860'>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>1、项目实时信息统计</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews30' value='xmshshxxtj_ck' <?php if(in_array('xmshshxxtj_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>  
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>2、月度报告统计</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews31' value='ydbgtj_ck' <?php if(in_array('ydbgtj_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews39' value='ydbgtj_fb' <?php if(in_array('ydbgtj_fb',$yhqxxf)){echo "checked";}?> >发布
        </td>
        </tr>  
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>3、季度报告统计</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews32' value='jdbgtj_ck' <?php if(in_array('jdbgtj_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews40' value='jdbgtj_fb' <?php if(in_array('jdbgtj_fb',$yhqxxf)){echo "checked";}?> >发布
        </td>
        </tr>  
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>4、基金会月报药品分配明细</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews33' value='jjhybypfpmx_ck' <?php if(in_array('jjhybypfpmx_ck',$yhqxxf)){echo "checked";}?> >查看
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews41' value='jjhybypfpmx_fb' <?php if(in_array('jjhybypfpmx_fb',$yhqxxf)){echo "checked";}?> >发布
        </td>
        </tr>
        	 <tr> 
           <td height='25' colspan='2' bgcolor='#F9FAF3' style='text-align:left;'>5、索坦项目信息导出</td></tr>
           <tr><td height='25' colspan='2' style='text-align:left;'>
        		          	<input name='purviews[]' type='checkbox' class='np' id='purviews38' value='xpapxmxxdch_ck' <?php if(in_array('xpapxmxxdch_ck',$yhqxxf)){echo "checked";}?> >查看
        </td>
        </tr>
        	  </table>
        	 </div> 
    </fieldset>     
    </fieldset>

        <div class="top">
            <input id="submitBtn" type="submit" value="保存" class="uusub" /> <input type="button"  onclick="javascript:{history.go(-1);}" value="返回" class="uusub2" /></div>
        </form>

    </div>
<script language="javascript"> 
        function SubmitCheck() {
                  
          /*if($("#shhyj1").attr("checked")||$("#shhyj2").attr("checked")){
            if(dycshzrq!=0){//alert("得到");
            var bcclshdrq=document.getElementById('shdrq'+dycshzrq).value;
              if(bcclshdrq!=""){
                $("#bcclshdrq").val(bcclshdrq); 
                //alert("获取"+$("#bcclshdrq").val());
                //alert("得到"+bcclshdrq+"a");
                
                return true;
              }
              else {return true;}
            }else{ return true;}
          }else{
            alert("请选择审核意见！");
            return false;
          }*/ return true;

        }

        //页面加载后
        $(function () {
        if($("#purviews0").attr("checked")){
          for(i=1;i<=42;i++){
            try{
              document.getElementById("purviews"+i).checked = true;              //document.getElementById("purviews"+i).disabled = true;
            } catch (e) {}
          }        
        }
        $("#purviews0").click(function() { 
          if($("#purviews0").attr("checked")){
            for(i=1;i<=42;i++){
              try{
              document.getElementById("purviews"+i).checked = true;              //document.getElementById("purviews"+i).disabled = true;
              } catch (e) {}
            }
          }else{
            for(i=1;i<=42;i++){
              try{
                document.getElementById("purviews"+i).checked = false;              document.getElementById("purviews"+i).disabled = false;
              } catch (e) {}
            }
          }
        });
        var qxzsh=0;
          for(i=1;i<=42;i++){
            try{
              $("#purviews"+i).click(function() { 
                if($(this).attr("checked")){ 
                    try{
                      for(j=1;j<=42;j++){
                        if($("#purviews"+j).attr("checked")){
                          qxzsh++;
                        }
                      }
                      //alert(qxzsh);
                      if(qxzsh>=42){
                          document.getElementById("purviews0").checked = true;
                      }
                      qxzsh=0;
                    } catch (e) {}
                }else{
                    try{
                      document.getElementById("purviews0").checked = false;
                    } catch (e) {}
                }
              });
            } catch (e) {}
          }  

        
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
