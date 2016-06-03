<?php
//药品破损新增
session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

//药房名称
$id = $_POST['id'];

$query="update `psyp` set state=3 where id=".$id;
$result=mysql_query($query);
if(!$result){
	echo json_encode(array('success'=>false, 'msg'=>mysql_error())) ;
}else{
	echo json_encode(array('success'=>true, 'msg'=>"成功！")) ;
}