<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
if(!Mysql_connect("localhost","root","root"))
// if(!Mysql_connect("localhost","root","cfc.201511"))
  echo "连接数据库失败";
  Elseif(!Mysql_select_db("cfcwshshq"))
  echo "打开数据库失败";
date_default_timezone_set('prc');
mysql_query("set names utf8");
?>

