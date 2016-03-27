<?php session_start(); 
include('newdb.php');
$ym=$_GET['ym'];
$bgrqksh=date('Y-m-01',strtotime("-".$ym." months".date('Y-m')));
$bgrq=date('Y年m月',strtotime("-".$ym." months".date('Y-m')));
$bgrqjsh=date('Y-m-d',strtotime("$bgrqksh +1 month -1 day"));
$shqshq=mysql_query("SELECT * FROM `hzh` where `djrq`>='$bgrqksh' and `djrq`<='$bgrqjsh' ");
$shqsh = mysql_num_rows($shqshq);//获取申请条数
$zshqshq=mysql_query("SELECT * FROM `hzh` where  `djrq`<='$bgrqjsh' and `djrq`<>'' ");
$zshqsh = mysql_num_rows($zshqshq);//获取总申请条数

$pzhrzq=mysql_query("SELECT * FROM `hzh` where `zhshrzshj`>='$bgrqksh' and `zhshrzshj`<='$bgrqjsh' ");
$pzhrz = mysql_num_rows($pzhrzq);//获取批准入组条数
$zpzhrzq=mysql_query("SELECT * FROM `hzh` where `zhshrzshj`<='$bgrqjsh' and `zhshrzshj`<>'' ");
$zpzhrz = mysql_num_rows($zpzhrzq);//获取总批准入组条数

$hzhchzq=mysql_query("SELECT * FROM `hzh` where `hzhchzrq`>='$bgrqksh' and `hzhchzrq`<='$bgrqjsh' ");
$hzhchz = mysql_num_rows($hzhchzq);//获取出组条数
$zhzhchzq=mysql_query("SELECT * FROM `hzh` where `hzhchzrq`<='$bgrqjsh' and `hzhchzrq`<>'' ");
$zhzhchz = mysql_num_rows($zhzhchzq);//获取总出组条数

$jjq=mysql_query("SELECT * FROM `hzh` where `shqzht`='拒绝' and `jjrq`>='$bgrqksh' and `jjrq`<='$bgrqjsh' ");
$jj = mysql_num_rows($jjq);//获取拒绝条数
$zjjq=mysql_query("SELECT * FROM `hzh` where `shqzht`='拒绝' and `jjrq`<='$bgrqjsh' and `jjrq`<>''");
$zjj = mysql_num_rows($zjjq);//获取总拒绝条数

$ztzhq=mysql_query("SELECT * FROM `hzh` where `shqzht`='停止申请' and `tzhrq`<='$bgrqjsh' and `tzhrq`<>'' ");
$ztzh = mysql_num_rows($ztzhq);//获取总停止申请条数


$blshjbgq=mysql_query("SELECT * FROM `blshj` where  `bghrrq`>='$bgrqksh' and `bghrrq`<='$bgrqjsh' ");
$blshjbg = mysql_num_rows($blshjbgq);//获取不良事件条数
$zblshjbgq=mysql_query("SELECT * FROM `blshj` where `bghrrq`<='$bgrqjsh' and `bghrrq`<>'' ");
$zblshjbg = mysql_num_rows($zblshjbgq);//获取总不良事件条数

$kfrksql = "select SUM(bjshl) from `kfrk` where `shyrq`>='$bgrqksh' and `shyrq`<='$bgrqjsh'";
$kfrkQuery_ID = mysql_query($kfrksql);
while($kfrkRecord = mysql_fetch_array($kfrkQuery_ID)){
if($kfrkRecord[0]>0){$rkzsh=$kfrkRecord[0];}else{$rkzsh=0;}
}//获取入库条数

$zkfrksql = "select SUM(bjshl) from `kfrk` where `shyrq`<='$bgrqjsh'";
$zkfrkQuery_ID = mysql_query($zkfrksql);
while($zkfrkRecord = mysql_fetch_array($zkfrkQuery_ID)){
if($zkfrkRecord[0]>0){$zrkzsh=$zkfrkRecord[0];}else{$zrkzsh=0;}
}//获取总入库条数

$kfrk1sql = "select SUM(bjshl) from `kfrk` where `shyrq`>='$bgrqksh' and `shyrq`<='$bgrqjsh' and `gg`='200mg*60粒/瓶'";
$kfrk1Query_ID = mysql_query($kfrk1sql);
while($kfrk1Record = mysql_fetch_array($kfrk1Query_ID)){
if($kfrk1Record[0]>0){$rkzsh1=$kfrk1Record[0];}else{$rkzsh1=0;}
}//获取200mg入库条数

$zkfrk1sql = "select SUM(bjshl) from `kfrk` where `shyrq`<='$bgrqjsh' and `gg`='200mg*60粒/瓶'";
$zkfrk1Query_ID = mysql_query($zkfrk1sql);
while($zkfrk1Record = mysql_fetch_array($zkfrk1Query_ID)){
if($zkfrk1Record[0]>0){$zrkzsh1=$zkfrk1Record[0];}else{$zrkzsh1=0;}
}//获取总200mg入库条数

$kfrk2sql = "select SUM(bjshl) from `kfrk` where `shyrq`>='$bgrqksh' and `shyrq`<='$bgrqjsh' and `gg`='250mg*60粒/瓶'";
$kfrk2Query_ID = mysql_query($kfrk2sql);
while($kfrk2Record = mysql_fetch_array($kfrk2Query_ID)){
if($kfrk2Record[0]>0){$rkzsh2=$kfrk2Record[0];}else{$rkzsh2=0;}
}//获取250mg入库条数

$zkfrk2sql = "select SUM(bjshl) from `kfrk` where `shyrq`<='$bgrqjsh' and `gg`='250mg*60粒/瓶'";
$zkfrk2Query_ID = mysql_query($zkfrk2sql);
while($zkfrk2Record = mysql_fetch_array($zkfrk2Query_ID)){
if($zkfrk2Record[0]>0){$zrkzsh2=$zkfrk2Record[0];}else{$zrkzsh2=0;}
}//获取总250mg入库条数

$sh1sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='1' and `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh'";
$sh1=mysql_query($sh1sql);
while($sh1Record = mysql_fetch_array($sh1)){
if($sh1Record[0]>0){$shjs1=$sh1Record[0];}else{$shjs1=0;}
}//获取200mg发药条数

$zsh1sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='1' and `fyrq`<='$bgrqjsh'";
$zsh1=mysql_query($zsh1sql);
while($zsh1Record = mysql_fetch_array($zsh1)){
if($zsh1Record[0]>0){$zshjs1=$zsh1Record[0];}else{$zshjs1=0;}
}//获取总200mg发药条数

$sh2sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='2' and `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh'";
$sh2=mysql_query($sh2sql);
while($sh2Record = mysql_fetch_array($sh2)){
if($sh2Record[0]>0){$shjs2=$sh2Record[0];}else{$shjs2=0;}
}//获取250mg发药条数

$zsh2sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='2' and `fyrq`<='$bgrqjsh'";
$zsh2=mysql_query($zsh2sql);
while($zsh2Record = mysql_fetch_array($zsh2)){
if($zsh2Record[0]>0){$zshjs2=$zsh2Record[0];}else{$zshjs2=0;}
}//获取总250mg发药条数



$bjyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='北京市'";
$bjyfmchq=mysql_query($bjyfmchsql);
while($bjyfmchRecord = mysql_fetch_array($bjyfmchq)){
$bjyfmch[]=$bjyfmchRecord[0];
}//获取全部北京药房名称
if($bjyfmch!=""){
$bjzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($bjyfmch);$i++){
$bjzyshsql .= " or `yfmch`='".$bjyfmch[$i]."'";
}
$bjzyshsql .= " )";
$bjzyshq=mysql_query($bjzyshsql);
while($bjzyshRecord = mysql_fetch_array($bjzyshq)){
if($bjzyshRecord[0]>0){$bjzysh=$bjzyshRecord[0];}else{$bjzysh=0;}
}//获取本月北京发药条数
$zbjzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($bjyfmch);$i++){
$zbjzyshsql .= " or `yfmch`='".$bjyfmch[$i]."'";
}
$zbjzyshsql .= " )";
$zbjzyshq=mysql_query($zbjzyshsql);
while($zbjzyshRecord = mysql_fetch_array($zbjzyshq)){
if($zbjzyshRecord[0]>0){$zbjzysh=$zbjzyshRecord[0];}else{$zbjzysh=0;}
}//获取总北京发药条数
}//获取北京发药条数

$qdyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='青岛市'";
$qdyfmchq=mysql_query($qdyfmchsql);
while($qdyfmchRecord = mysql_fetch_array($qdyfmchq)){
$qdyfmch[]=$qdyfmchRecord[0];
}//获取全部青岛药房名称
if($qdyfmch!=""){
$qdzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($qdyfmch);$i++){
$qdzyshsql .= " or `yfmch`='".$qdyfmch[$i]."'";
}
$qdzyshsql .= " )";
$qdzyshq=mysql_query($qdzyshsql);
while($qdzyshRecord = mysql_fetch_array($qdzyshq)){
if($qdzyshRecord[0]>0){$qdzysh=$qdzyshRecord[0];}else{$qdzysh=0;}
}//获取本月青岛发药条数
$zqdzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($qdyfmch);$i++){
$zqdzyshsql .= " or `yfmch`='".$qdyfmch[$i]."'";
}
$zqdzyshsql .= " )";
$zqdzyshq=mysql_query($zqdzyshsql);
while($zqdzyshRecord = mysql_fetch_array($zqdzyshq)){
if($zqdzyshRecord[0]>0){$zqdzysh=$zqdzyshRecord[0];}else{$zqdzysh=0;}
}//获取总青岛发药条数
}//获取青岛发药条数

$chdyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='成都市'";
$chdyfmchq=mysql_query($chdyfmchsql);
while($chdyfmchRecord = mysql_fetch_array($chdyfmchq)){
$chdyfmch[]=$chdyfmchRecord[0];
}//获取全部成都药房名称
if($chdyfmch!=""){
$chdzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($chdyfmch);$i++){
$chdzyshsql .= " or `yfmch`='".$chdyfmch[$i]."'";
}
$chdzyshsql .= " )";
$chdzyshq=mysql_query($chdzyshsql);
while($chdzyshRecord = mysql_fetch_array($chdzyshq)){
if($chdzyshRecord[0]>0){$chdzysh=$chdzyshRecord[0];}else{$chdzysh=0;}
}//获取本月成都发药条数
$zchdzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($chdyfmch);$i++){
$zchdzyshsql .= " or `yfmch`='".$chdyfmch[$i]."'";
}
$zchdzyshsql .= " )";
$zchdzyshq=mysql_query($zchdzyshsql);
while($zchdzyshRecord = mysql_fetch_array($zchdzyshq)){
if($zchdzyshRecord[0]>0){$zchdzysh=$zchdzyshRecord[0];}else{$zchdzysh=0;}
}//获取总成都发药条数
}//获取成都发药条数

$shhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='上海市'";
$shhyfmchq=mysql_query($shhyfmchsql);
while($shhyfmchRecord = mysql_fetch_array($shhyfmchq)){
$shhyfmch[]=$shhyfmchRecord[0];
}//获取全部上海药房名称
if($shhyfmch!=""){
$shhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($shhyfmch);$i++){
$shhzyshsql .= " or `yfmch`='".$shhyfmch[$i]."'";
}
$shhzyshsql .= " )";
$shhzyshq=mysql_query($shhzyshsql);
while($shhzyshRecord = mysql_fetch_array($shhzyshq)){
if($shhzyshRecord[0]>0){$shhzysh=$shhzyshRecord[0];}else{$shhzysh=0;}
}//获取本月上海发药条数
$zshhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($shhyfmch);$i++){
$zshhzyshsql .= " or `yfmch`='".$shhyfmch[$i]."'";
}
$zshhzyshsql .= " )";
$zshhzyshq=mysql_query($zshhzyshsql);
while($zshhzyshRecord = mysql_fetch_array($zshhzyshq)){
if($zshhzyshRecord[0]>0){$zshhzysh=$zshhzyshRecord[0];}else{$zshhzysh=0;}
}//获取总上海发药条数
}//获取上海发药条数

$dlyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='大连市'";
$dlyfmchq=mysql_query($dlyfmchsql);
while($dlyfmchRecord = mysql_fetch_array($dlyfmchq)){
$dlyfmch[]=$dlyfmchRecord[0];
}//获取全部大连药房名称
if($dlyfmch!=""){
$dlzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($dlyfmch);$i++){
$dlzyshsql .= " or `yfmch`='".$dlyfmch[$i]."'";
}
$dlzyshsql .= " )";
$dlzyshq=mysql_query($dlzyshsql);
while($dlzyshRecord = mysql_fetch_array($dlzyshq)){
if($dlzyshRecord[0]>0){$dlzysh=$dlzyshRecord[0];}else{$dlzysh=0;}
}//获取本月大连发药条数
$zdlzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($dlyfmch);$i++){
$zdlzyshsql .= " or `yfmch`='".$dlyfmch[$i]."'";
}
$zdlzyshsql .= " )";
$zdlzyshq=mysql_query($zdlzyshsql);
while($zdlzyshRecord = mysql_fetch_array($zdlzyshq)){
if($zdlzyshRecord[0]>0){$zdlzysh=$zdlzyshRecord[0];}else{$zdlzysh=0;}
}//获取总大连发药条数
}//获取大连发药条数

$shyyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='沈阳市'";
$shyyfmchq=mysql_query($shyyfmchsql);
while($shyyfmchRecord = mysql_fetch_array($shyyfmchq)){
$shyyfmch[]=$shyyfmchRecord[0];
}//获取全部沈阳药房名称
if($shyyfmch!=""){
$shyzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($shyyfmch);$i++){
$shyzyshsql .= " or `yfmch`='".$shyyfmch[$i]."'";
}
$shyzyshsql .= " )";
$shyzyshq=mysql_query($shyzyshsql);
while($shyzyshRecord = mysql_fetch_array($shyzyshq)){
if($shyzyshRecord[0]>0){$shyzysh=$shyzyshRecord[0];}else{$shyzysh=0;}
}//获取本月沈阳发药条数
$zshyzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($shyyfmch);$i++){
$zshyzyshsql .= " or `yfmch`='".$shyyfmch[$i]."'";
}
$zshyzyshsql .= " )";
$zshyzyshq=mysql_query($zshyzyshsql);
while($zshyzyshRecord = mysql_fetch_array($zshyzyshq)){
if($zshyzyshRecord[0]>0){$zshyzysh=$zshyzyshRecord[0];}else{$zshyzysh=0;}
}//获取总沈阳发药条数
}//获取沈阳发药条数

$fzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='福州市'";
$fzhyfmchq=mysql_query($fzhyfmchsql);
while($fzhyfmchRecord = mysql_fetch_array($fzhyfmchq)){
$fzhyfmch[]=$fzhyfmchRecord[0];
}//获取全部福州药房名称
if($fzhyfmch!=""){
$fzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($fzhyfmch);$i++){
$fzhzyshsql .= " or `yfmch`='".$fzhyfmch[$i]."'";
}
$fzhzyshsql .= " )";
$fzhzyshq=mysql_query($fzhzyshsql);
while($fzhzyshRecord = mysql_fetch_array($fzhzyshq)){
if($fzhzyshRecord[0]>0){$fzhzysh=$fzhzyshRecord[0];}else{$fzhzysh=0;}
}//获取本月福州发药条数
$zfzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($fzhyfmch);$i++){
$zfzhzyshsql .= " or `yfmch`='".$fzhyfmch[$i]."'";
}
$zfzhzyshsql .= " )";
$zfzhzyshq=mysql_query($zfzhzyshsql);
while($zfzhzyshRecord = mysql_fetch_array($zfzhzyshq)){
if($zfzhzyshRecord[0]>0){$zfzhzysh=$zfzhzyshRecord[0];}else{$zfzhzysh=0;}
}//获取总福州发药条数
}//获取福州发药条数

$tyyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='太原市'";
$tyyfmchq=mysql_query($tyyfmchsql);
while($tyyfmchRecord = mysql_fetch_array($tyyfmchq)){
$tyyfmch[]=$tyyfmchRecord[0];
}//获取全部太原药房名称
if($tyyfmch!=""){
$tyzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($tyyfmch);$i++){
$tyzyshsql .= " or `yfmch`='".$tyyfmch[$i]."'";
}
$tyzyshsql .= " )";
$tyzyshq=mysql_query($tyzyshsql);
while($tyzyshRecord = mysql_fetch_array($tyzyshq)){
if($tyzyshRecord[0]>0){$tyzysh=$tyzyshRecord[0];}else{$tyzysh=0;}
}//获取本月太原发药条数
$ztyzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($tyyfmch);$i++){
$ztyzyshsql .= " or `yfmch`='".$tyyfmch[$i]."'";
}
$ztyzyshsql .= " )";
$ztyzyshq=mysql_query($ztyzyshsql);
while($ztyzyshRecord = mysql_fetch_array($ztyzyshq)){
if($ztyzyshRecord[0]>0){$ztyzysh=$ztyzyshRecord[0];}else{$ztyzysh=0;}
}//获取总太原发药条数
}//获取太原发药条数

$gzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='广州市'";
$gzhyfmchq=mysql_query($gzhyfmchsql);
while($gzhyfmchRecord = mysql_fetch_array($gzhyfmchq)){
$gzhyfmch[]=$gzhyfmchRecord[0];
}//获取全部广州药房名称
if($gzhyfmch!=""){
$gzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($gzhyfmch);$i++){
$gzhzyshsql .= " or `yfmch`='".$gzhyfmch[$i]."'";
}
$gzhzyshsql .= " )";
$gzhzyshq=mysql_query($gzhzyshsql);
while($gzhzyshRecord = mysql_fetch_array($gzhzyshq)){
if($gzhzyshRecord[0]>0){$gzhzysh=$gzhzyshRecord[0];}else{$gzhzysh=0;}
}//获取本月广州发药条数
$zgzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($gzhyfmch);$i++){
$zgzhzyshsql .= " or `yfmch`='".$gzhyfmch[$i]."'";
}
$zgzhzyshsql .= " )";
$zgzhzyshq=mysql_query($zgzhzyshsql);
while($zgzhzyshRecord = mysql_fetch_array($zgzhzyshq)){
if($zgzhzyshRecord[0]>0){$zgzhzysh=$zgzhzyshRecord[0];}else{$zgzhzysh=0;}
}//获取总广州发药条数
}//获取广州发药条数

$tjyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='天津市'";
$tjyfmchq=mysql_query($tjyfmchsql);
while($tjyfmchRecord = mysql_fetch_array($tjyfmchq)){
$tjyfmch[]=$tjyfmchRecord[0];
}//获取全部天津药房名称
if($tjyfmch!=""){
$tjzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($tjyfmch);$i++){
$tjzyshsql .= " or `yfmch`='".$tjyfmch[$i]."'";
}
$tjzyshsql .= " )";
$tjzyshq=mysql_query($tjzyshsql);
while($tjzyshRecord = mysql_fetch_array($tjzyshq)){
if($tjzyshRecord[0]>0){$tjzysh=$tjzyshRecord[0];}else{$tjzysh=0;}
}//获取本月天津发药条数
$ztjzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($tjyfmch);$i++){
$ztjzyshsql .= " or `yfmch`='".$tjyfmch[$i]."'";
}
$ztjzyshsql .= " )";
$ztjzyshq=mysql_query($ztjzyshsql);
while($ztjzyshRecord = mysql_fetch_array($ztjzyshq)){
if($ztjzyshRecord[0]>0){$ztjzysh=$ztjzyshRecord[0];}else{$ztjzysh=0;}
}//获取总天津发药条数
}//获取天津发药条数

$herbyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='哈尔滨市'";
$herbyfmchq=mysql_query($herbyfmchsql);
while($herbyfmchRecord = mysql_fetch_array($herbyfmchq)){
$herbyfmch[]=$herbyfmchRecord[0];
}//获取全部哈尔滨药房名称
if($herbyfmch!=""){
$herbzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($herbyfmch);$i++){
$herbzyshsql .= " or `yfmch`='".$herbyfmch[$i]."'";
}
$herbzyshsql .= " )";
$herbzyshq=mysql_query($herbzyshsql);
while($herbzyshRecord = mysql_fetch_array($herbzyshq)){
if($herbzyshRecord[0]>0){$herbzysh=$herbzyshRecord[0];}else{$herbzysh=0;}
}//获取本月哈尔滨发药条数
$zherbzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($herbyfmch);$i++){
$zherbzyshsql .= " or `yfmch`='".$herbyfmch[$i]."'";
}
$zherbzyshsql .= " )";
$zherbzyshq=mysql_query($zherbzyshsql);
while($zherbzyshRecord = mysql_fetch_array($zherbzyshq)){
if($zherbzyshRecord[0]>0){$zherbzysh=$zherbzyshRecord[0];}else{$zherbzysh=0;}
}//获取总哈尔滨发药条数
}//获取哈尔滨发药条数

$wlmqyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='乌鲁木齐市'";
$wlmqyfmchq=mysql_query($wlmqyfmchsql);
while($wlmqyfmchRecord = mysql_fetch_array($wlmqyfmchq)){
$wlmqyfmch[]=$wlmqyfmchRecord[0];
}//获取全部乌鲁木齐药房名称
if($wlmqyfmch!=""){
$wlmqzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($wlmqyfmch);$i++){
$wlmqzyshsql .= " or `yfmch`='".$wlmqyfmch[$i]."'";
}
$wlmqzyshsql .= " )";
$wlmqzyshq=mysql_query($wlmqzyshsql);
while($wlmqzyshRecord = mysql_fetch_array($wlmqzyshq)){
if($wlmqzyshRecord[0]>0){$wlmqzysh=$wlmqzyshRecord[0];}else{$wlmqzysh=0;}
}//获取本月乌鲁木齐发药条数
$zwlmqzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($wlmqyfmch);$i++){
$zwlmqzyshsql .= " or `yfmch`='".$wlmqyfmch[$i]."'";
}
$zwlmqzyshsql .= " )";
$zwlmqzyshq=mysql_query($zwlmqzyshsql);
while($zwlmqzyshRecord = mysql_fetch_array($zwlmqzyshq)){
if($zwlmqzyshRecord[0]>0){$zwlmqzysh=$zwlmqzyshRecord[0];}else{$zwlmqzysh=0;}
}//获取总乌鲁木齐发药条数
}//获取乌鲁木齐发药条数

$hzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='杭州市'";
$hzhyfmchq=mysql_query($hzhyfmchsql);
while($hzhyfmchRecord = mysql_fetch_array($hzhyfmchq)){
$hzhyfmch[]=$hzhyfmchRecord[0];
}//获取全部杭州药房名称
if($hzhyfmch!=""){
$hzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($hzhyfmch);$i++){
$hzhzyshsql .= " or `yfmch`='".$hzhyfmch[$i]."'";
}
$hzhzyshsql .= " )";
$hzhzyshq=mysql_query($hzhzyshsql);
while($hzhzyshRecord = mysql_fetch_array($hzhzyshq)){
if($hzhzyshRecord[0]>0){$hzhzysh=$hzhzyshRecord[0];}else{$hzhzysh=0;}
}//获取本月杭州发药条数
$zhzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($hzhyfmch);$i++){
$zhzhzyshsql .= " or `yfmch`='".$hzhyfmch[$i]."'";
}
$zhzhzyshsql .= " )";
$zhzhzyshq=mysql_query($zhzhzyshsql);
while($zhzhzyshRecord = mysql_fetch_array($zhzhzyshq)){
if($zhzhzyshRecord[0]>0){$zhzhzysh=$zhzhzyshRecord[0];}else{$zhzhzysh=0;}
}//获取总杭州发药条数
}//获取杭州发药条数

$whyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='武汉市'";
$whyfmchq=mysql_query($whyfmchsql);
while($whyfmchRecord = mysql_fetch_array($whyfmchq)){
$whyfmch[]=$whyfmchRecord[0];
}//获取全部武汉药房名称
if($whyfmch!=""){
$whzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($whyfmch);$i++){
$whzyshsql .= " or `yfmch`='".$whyfmch[$i]."'";
}
$whzyshsql .= " )";
$whzyshq=mysql_query($whzyshsql);
while($whzyshRecord = mysql_fetch_array($whzyshq)){
if($whzyshRecord[0]>0){$whzysh=$whzyshRecord[0];}else{$whzysh=0;}
}//获取本月武汉发药条数
$zwhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($whyfmch);$i++){
$zwhzyshsql .= " or `yfmch`='".$whyfmch[$i]."'";
}
$zwhzyshsql .= " )";
$zwhzyshq=mysql_query($zwhzyshsql);
while($zwhzyshRecord = mysql_fetch_array($zwhzyshq)){
if($zwhzyshRecord[0]>0){$zwhzysh=$zwhzyshRecord[0];}else{$zwhzysh=0;}
}//获取总武汉发药条数
}//获取武汉发药条数

$jnyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='济南市'";
$jnyfmchq=mysql_query($jnyfmchsql);
while($jnyfmchRecord = mysql_fetch_array($jnyfmchq)){
$jnyfmch[]=$jnyfmchRecord[0];
}//获取全部济南药房名称
if($jnyfmch!=""){
$jnzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($jnyfmch);$i++){
$jnzyshsql .= " or `yfmch`='".$jnyfmch[$i]."'";
}
$jnzyshsql .= " )";
$jnzyshq=mysql_query($jnzyshsql);
while($jnzyshRecord = mysql_fetch_array($jnzyshq)){
if($jnzyshRecord[0]>0){$jnzysh=$jnzyshRecord[0];}else{$jnzysh=0;}
}//获取本月济南发药条数
$zjnzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($jnyfmch);$i++){
$zjnzyshsql .= " or `yfmch`='".$jnyfmch[$i]."'";
}
$zjnzyshsql .= " )";
$zjnzyshq=mysql_query($zjnzyshsql);
while($zjnzyshRecord = mysql_fetch_array($zjnzyshq)){
if($zjnzyshRecord[0]>0){$zjnzysh=$zjnzyshRecord[0];}else{$zjnzysh=0;}
}//获取总济南发药条数
}//获取济南发药条数

$xanyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='西安市'";
$xanyfmchq=mysql_query($xanyfmchsql);
while($xanyfmchRecord = mysql_fetch_array($xanyfmchq)){
$xanyfmch[]=$xanyfmchRecord[0];
}//获取全部西安药房名称
if($xanyfmch!=""){
$xanzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($xanyfmch);$i++){
$xanzyshsql .= " or `yfmch`='".$xanyfmch[$i]."'";
}
$xanzyshsql .= " )";
$xanzyshq=mysql_query($xanzyshsql);
while($xanzyshRecord = mysql_fetch_array($xanzyshq)){
if($xanzyshRecord[0]>0){$xanzysh=$xanzyshRecord[0];}else{$xanzysh=0;}
}//获取本月西安发药条数
$zxanzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($xanyfmch);$i++){
$zxanzyshsql .= " or `yfmch`='".$xanyfmch[$i]."'";
}
$zxanzyshsql .= " )";
$zxanzyshq=mysql_query($zxanzyshsql);
while($zxanzyshRecord = mysql_fetch_array($zxanzyshq)){
if($zxanzyshRecord[0]>0){$zxanzysh=$zxanzyshRecord[0];}else{$zxanzysh=0;}
}//获取总西安发药条数
}//获取西安发药条数

$lzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='兰州市'";
$lzhyfmchq=mysql_query($lzhyfmchsql);
while($lzhyfmchRecord = mysql_fetch_array($lzhyfmchq)){
$lzhyfmch[]=$lzhyfmchRecord[0];
}//获取全部兰州药房名称
if($lzhyfmch!=""){
$lzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($lzhyfmch);$i++){
$lzhzyshsql .= " or `yfmch`='".$lzhyfmch[$i]."'";
}
$lzhzyshsql .= " )";
$lzhzyshq=mysql_query($lzhzyshsql);
while($lzhzyshRecord = mysql_fetch_array($lzhzyshq)){
if($lzhzyshRecord[0]>0){$lzhzysh=$lzhzyshRecord[0];}else{$lzhzysh=0;}
}//获取本月兰州发药条数
$zlzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($lzhyfmch);$i++){
$zlzhzyshsql .= " or `yfmch`='".$lzhyfmch[$i]."'";
}
$zlzhzyshsql .= " )";
$zlzhzyshq=mysql_query($zlzhzyshsql);
while($zlzhzyshRecord = mysql_fetch_array($zlzhzyshq)){
if($zlzhzyshRecord[0]>0){$zlzhzysh=$zlzhzyshRecord[0];}else{$zlzhzysh=0;}
}//获取总兰州发药条数
}//获取兰州发药条数

$chchyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='长春市'";
$chchyfmchq=mysql_query($chchyfmchsql);
while($chchyfmchRecord = mysql_fetch_array($chchyfmchq)){
$chchyfmch[]=$chchyfmchRecord[0];
}//获取全部长春药房名称
if($chchyfmch!=""){
$chchzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($chchyfmch);$i++){
$chchzyshsql .= " or `yfmch`='".$chchyfmch[$i]."'";
}
$chchzyshsql .= " )";
$chchzyshq=mysql_query($chchzyshsql);
while($chchzyshRecord = mysql_fetch_array($chchzyshq)){
if($chchzyshRecord[0]>0){$chchzysh=$chchzyshRecord[0];}else{$chchzysh=0;}
}//获取本月长春发药条数
$zchchzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($chchyfmch);$i++){
$zchchzyshsql .= " or `yfmch`='".$chchyfmch[$i]."'";
}
$zchchzyshsql .= " )";
$zchchzyshq=mysql_query($zchchzyshsql);
while($zchchzyshRecord = mysql_fetch_array($zchchzyshq)){
if($zchchzyshRecord[0]>0){$zchchzysh=$zchchzyshRecord[0];}else{$zchchzysh=0;}
}//获取总长春发药条数
}//获取长春发药条数

$nchyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='南昌市'";
$nchyfmchq=mysql_query($nchyfmchsql);
while($nchyfmchRecord = mysql_fetch_array($nchyfmchq)){
$nchyfmch[]=$nchyfmchRecord[0];
}//获取全部南昌药房名称
if($nchyfmch!=""){
$nchzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($nchyfmch);$i++){
$nchzyshsql .= " or `yfmch`='".$nchyfmch[$i]."'";
}
$nchzyshsql .= " )";
$nchzyshq=mysql_query($nchzyshsql);
while($nchzyshRecord = mysql_fetch_array($nchzyshq)){
if($nchzyshRecord[0]>0){$nchzysh=$nchzyshRecord[0];}else{$nchzysh=0;}
}//获取本月南昌发药条数
$znchzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($nchyfmch);$i++){
$znchzyshsql .= " or `yfmch`='".$nchyfmch[$i]."'";
}
$znchzyshsql .= " )";
$znchzyshq=mysql_query($znchzyshsql);
while($znchzyshRecord = mysql_fetch_array($znchzyshq)){
if($znchzyshRecord[0]>0){$znchzysh=$znchzyshRecord[0];}else{$znchzysh=0;}
}//获取总南昌发药条数
}//获取南昌发药条数

$chshyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='长沙市'";
$chshyfmchq=mysql_query($chshyfmchsql);
while($chshyfmchRecord = mysql_fetch_array($chshyfmchq)){
$chshyfmch[]=$chshyfmchRecord[0];
}//获取全部长沙药房名称
if($chshyfmch!=""){
$chshzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($chshyfmch);$i++){
$chshzyshsql .= " or `yfmch`='".$chshyfmch[$i]."'";
}
$chshzyshsql .= " )";
$chshzyshq=mysql_query($chshzyshsql);
while($chshzyshRecord = mysql_fetch_array($chshzyshq)){
if($chshzyshRecord[0]>0){$chshzysh=$chshzyshRecord[0];}else{$chshzysh=0;}
}//获取本月长沙发药条数
$zchshzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($chshyfmch);$i++){
$zchshzyshsql .= " or `yfmch`='".$chshyfmch[$i]."'";
}
$zchshzyshsql .= " )";
$zchshzyshq=mysql_query($zchshzyshsql);
while($zchshzyshRecord = mysql_fetch_array($zchshzyshq)){
if($zchshzyshRecord[0]>0){$zchshzysh=$zchshzyshRecord[0];}else{$zchshzysh=0;}
}//获取总长沙发药条数
}//获取长沙发药条数

$njyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='南京市'";
$njyfmchq=mysql_query($njyfmchsql);
while($njyfmchRecord = mysql_fetch_array($njyfmchq)){
$njyfmch[]=$njyfmchRecord[0];
}//获取全部南京药房名称
if($njyfmch!=""){
$njzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($njyfmch);$i++){
$njzyshsql .= " or `yfmch`='".$njyfmch[$i]."'";
}
$njzyshsql .= " )";
$njzyshq=mysql_query($njzyshsql);
while($njzyshRecord = mysql_fetch_array($njzyshq)){
if($njzyshRecord[0]>0){$njzysh=$njzyshRecord[0];}else{$njzysh=0;}
}//获取本月南京发药条数
$znjzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($njyfmch);$i++){
$znjzyshsql .= " or `yfmch`='".$njyfmch[$i]."'";
}
$znjzyshsql .= " )";
$znjzyshq=mysql_query($znjzyshsql);
while($znjzyshRecord = mysql_fetch_array($znjzyshq)){
if($znjzyshRecord[0]>0){$znjzysh=$znjzyshRecord[0];}else{$znjzysh=0;}
}//获取总南京发药条数
}//获取南京发药条数

$zhzhyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='郑州市'";
$zhzhyfmchq=mysql_query($zhzhyfmchsql);
while($zhzhyfmchRecord = mysql_fetch_array($zhzhyfmchq)){
$zhzhyfmch[]=$zhzhyfmchRecord[0];
}//获取全部郑州药房名称
if($zhzhyfmch!=""){
$zhzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($zhzhyfmch);$i++){
$zhzhzyshsql .= " or `yfmch`='".$zhzhyfmch[$i]."'";
}
$zhzhzyshsql .= " )";
$zhzhzyshq=mysql_query($zhzhzyshsql);
while($zhzhzyshRecord = mysql_fetch_array($zhzhzyshq)){
if($zhzhzyshRecord[0]>0){$zhengzhzysh=$zhzhzyshRecord[0];}else{$zhengzhzysh=0;}
}//获取本月郑州发药条数
$zzhzhzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($zhzhyfmch);$i++){
$zzhzhzyshsql .= " or `yfmch`='".$zhzhyfmch[$i]."'";
}
$zzhzhzyshsql .= " )";
$zzhzhzyshq=mysql_query($zzhzhzyshsql);
while($zzhzhzyshRecord = mysql_fetch_array($zzhzhzyshq)){
if($zzhzhzyshRecord[0]>0){$zzhzhzysh=$zzhzhzyshRecord[0];}else{$zzhzhzysh=0;}
}//获取总郑州发药条数
}//获取郑州发药条数

$nnyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='南宁市'";
$nnyfmchq=mysql_query($nnyfmchsql);
while($nnyfmchRecord = mysql_fetch_array($nnyfmchq)){
$nnyfmch[]=$nnyfmchRecord[0];
}//获取全部南宁药房名称
if($nnyfmch!=""){
$nnzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($nnyfmch);$i++){
$nnzyshsql .= " or `yfmch`='".$nnyfmch[$i]."'";
}
$nnzyshsql .= " )";
$nnzyshq=mysql_query($nnzyshsql);
while($nnzyshRecord = mysql_fetch_array($nnzyshq)){
if($nnzyshRecord[0]>0){$nnzysh=$nnzyshRecord[0];}else{$nnzysh=0;}
}//获取本月南宁发药条数
$znnzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($nnyfmch);$i++){
$znnzyshsql .= " or `yfmch`='".$nnyfmch[$i]."'";
}
$znnzyshsql .= " )";
$znnzyshq=mysql_query($znnzyshsql);
while($znnzyshRecord = mysql_fetch_array($znnzyshq)){
if($znnzyshRecord[0]>0){$znnzysh=$znnzyshRecord[0];}else{$znnzysh=0;}
}//获取总南宁发药条数
}//获取南宁发药条数


$chqyfmchsql="SELECT `yfmch` FROM `yf` where `yfshi`='重庆市'";
$chqyfmchq=mysql_query($chqyfmchsql);
while($chqyfmchRecord = mysql_fetch_array($chqyfmchq)){
$chqyfmch[]=$chqyfmchRecord[0];
}//获取全部重庆药房名称
if($chqyfmch!=""){
$chqzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`>='$bgrqksh' and `fyrq`<='$bgrqjsh' and ('1'='2' ";

for($i=0;$i<count($chqyfmch);$i++){
$chqzyshsql .= " or `yfmch`='".$chqyfmch[$i]."'";
}
$chqzyshsql .= " )";
$chqzyshq=mysql_query($chqzyshsql);
while($chqzyshRecord = mysql_fetch_array($chqzyshq)){
if($chqzyshRecord[0]>0){$chqzysh=$chqzyshRecord[0];}else{$chqzysh=0;}
}//获取本月重庆发药条数
$zchqzyshsql="SELECT SUM(fyshl) FROM `zyff` where `fyrq`<='$bgrqjsh' and ('1'='2' ";
for($i=0;$i<count($chqyfmch);$i++){
$zchqzyshsql .= " or `yfmch`='".$chqyfmch[$i]."'";
}
$zchqzyshsql .= " )";
$zchqzyshq=mysql_query($zchqzyshsql);
while($zchqzyshRecord = mysql_fetch_array($zchqzyshq)){
if($zchqzyshRecord[0]>0){$zchqzysh=$zchqzyshRecord[0];}else{$zchqzysh=0;}
}//获取总重庆发药条数
}//获取重庆发药条数


//header('Content-type: text/html;charset=utf-8');
header('content-type:application/pdf');
header("Content-Disposition: attachment; filename=XPAP月度工作报告-".$bgrq.".pdf");
ini_set('display_errors', '0');
ini_set('max_execution_time', '60');


require ('./pdf/fpdf.php');
require ('./pdf/chinese.php');



$pdf = new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB', 'B', 20);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "XPAP月度工作报告"), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('GB', 'B', 20);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", $bgrq), 0, 0, 'C');

//以上是表头
$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "一、本月申请项目患者情况统计："), 0, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->setxy($x,$y);
$pdf->MultiCell(190,8, iconv("UTF-8", "gbk", "　　".$bgrq."，共收到患者申请".$shqsh."例、批准入组".$pzhrz."例、出组患者".$hzhchz."例、拒绝".$jj."例；项目累计共收到患者申请".$zshqsh."例、停止申请".$ztzh."例、批准入组".$zpzhrz."例、出组患者".$zhzhchz."例、拒绝".$zjj."例。" ), 0,  'L');

$pdf->SetFont('GB', 'B', 16);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "二、本月不良事件上报情况统计："), 0, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->setxy($x,$y);
$pdf->MultiCell(190,8, iconv("UTF-8", "gbk", "　　".$bgrq."，上报不良事件".$blshjbg."人次，项目累计上报".$zblshjbg."人次。" ), 0,  'L');

$pdf->SetFont('GB', 'B', 16);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "三、本月发药情况统计："), 0, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->setxy($x,$y);
$pdf->MultiCell(190,8, iconv("UTF-8", "gbk", "　　截至本月末，项目累计收到捐赠赛可瑞".$zrkzsh."瓶（其中250mg*60粒".$zrkzsh2."瓶；200mg*60粒".$zrkzsh1."瓶），累计发放".($zshjs1+$zshjs2)."瓶（其中250mg*60粒".$zshjs2."瓶；200mg*60粒".$zshjs1."瓶），库存".($zrkzsh-$zshjs1-$zshjs2)."瓶（其中250mg*60粒".($zrkzsh2-$zshjs2)."瓶；200mg*60粒".($zrkzsh1-$zshjs1)."瓶）。" ), 0,  'L');

$pdf->MultiCell(190,8, iconv("UTF-8", "gbk", "　　本月收到捐赠赛可瑞".$zrkzsh."瓶（其中250mg*60粒".$rkzsh2."瓶；200mg*60粒".$rkzsh1."瓶），发放".($shjs1+$shjs2)."瓶（其中250mg*60粒".$shjs2."瓶；200mg*60粒".$shjs1."瓶）。" ), 0,  'L');


$pdf->SetFont('GB', 'B', 12);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "各药房本月发放数量及累计发放数量如下："), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('GB', 'B', 10);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "No"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "城市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", "本月"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", "累计"), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "No"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "城市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", "本月"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", "累计"), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "1"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "北京市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $bjzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zbjzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "13"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "青岛市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $qdzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zqdzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "2"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "成都市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $chdzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zchdzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "14"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "上海市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $shhzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zshhzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "3"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "大连市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $dlzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zdlzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "15"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "沈阳市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $shyzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zshyzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "4"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "福州市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $fzhzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zfzhzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "16"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "太原市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $tyzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $ztyzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "5"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "广州市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $gzhzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zgzhzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "17"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "天津市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $tjzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $ztjzysh), 1, 0, 'C');


$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "6"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "哈尔滨市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $herbzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zherbzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "18"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "乌鲁木齐市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $wlmqzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zwlmqzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "7"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "杭州市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $hzhzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zhzhzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "19"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "武汉市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $whzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zwhzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "8"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "济南市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $jnzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zjnzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "20"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "西安市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $xanzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zxanzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "9"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "兰州市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $lzhzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zlzhzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "21"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "长春市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $chchzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zchchzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "10"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "南昌市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $nchzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $znchzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "22"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "长沙市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $chshzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zchshzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "11"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "南京市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $njzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $znjzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "23"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "郑州市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zhengzhzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zzhzhzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "12"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "南宁市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $nnzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $znnzysh), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", "24"), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "重庆市"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $chqzysh), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $zchqzysh), 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", "总计"), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", ($zshjs1+$zshjs2)), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(10, 8, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(35, 8, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", ""), 1, 0, 'C');
$pdf->Cell(25, 8, iconv("UTF-8", "gbk", ""), 1, 0, 'C');

$pdf->Ln();
/*$pdf->Ln();
$pdf->SetFont('GB', 'B', 16);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "四、详细描述："), 0, 0, 'L');

$pdf->Ln();
$pdf->SetFont('GB', '', 12);
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->setxy($x,$y);
$pdf->MultiCell(190,8, iconv("UTF-8", "gbk", "　　此处记录当月的特殊事件及其他重要内容。" ), 0,  'L');*/

$pdf->SetFont('GB', '', 10);
$pdf->SetLeftMargin(10.0);
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "中国癌症基金会"), 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", "赛可瑞患者援助项目办公室"), 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(190, 8, iconv("UTF-8", "gbk", $bgrq), 0, 0, 'R');

$pdf->Output("XPAP月度工作报告-".$bgrq.".pdf",I);
/*$pdf->Output('aa.pdf');
echo "<a href=\"aa.pdf\">右键目标另存为</a>";*/

?>