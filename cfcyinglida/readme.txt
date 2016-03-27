1、新增的数据库表字段：
  1) 医院医生地区 -------- yyyshdq 表中新增以下字段
     指定医生联系方式2   ------- zhdyshdh2
     指定医生电子邮箱    ------- zhdyshemail
     授权医生电子邮箱    ------- shqyshemail
     运行的SQL语句：
     ALTER TABLE `yyyshdq`  ADD COLUMN `zhdyshdh2` varchar(255) NULL DEFAULT '' AFTER `zhlbzh`;
     ALTER TABLE `yyyshdq`  ADD COLUMN `zhdyshemail` varchar(255) NULL DEFAULT '' AFTER `zhdyshdh2`;
     ALTER TABLE `yyyshdq`  ADD COLUMN `shqyshemail` varchar(255) NULL DEFAULT '' AFTER `zhdyshemail`;
  2)药房表  --------yf  新增字段
     指定医生年龄：    ------ zhdyshnl
     授权医生年龄：    ------ yfshqyshnl
     授权医生性别：    ------ yfshqyshxb
     授权医生手机：    ------ yfshqyshshj
     授权医生email：    ------ yfshqyshemail
     授权医生备案日期：    ------ yfshqyshbarq
     运行的SQL语句：
     ALTER TABLE `yf`  ADD COLUMN `zhdyshnl` varchar(255) NULL DEFAULT '' AFTER `xwsj`;
     ALTER TABLE `yf`  ADD COLUMN `yfshqyshnl` varchar(255) NULL DEFAULT '' AFTER `zhdyshnl`;
     ALTER TABLE `yf`  ADD COLUMN `yfshqyshxb` varchar(255) NULL DEFAULT '' AFTER `yfshqyshnl`;
     ALTER TABLE `yf`  ADD COLUMN `yfshqyshshj` varchar(255) NULL DEFAULT '' AFTER `yfshqyshxb`;
     ALTER TABLE `yf`  ADD COLUMN `yfshqyshemail` varchar(255) NULL DEFAULT '' AFTER `yfshqyshshj`;
     ALTER TABLE `yf`  ADD COLUMN `yfshqyshbarq` varchar(255) NULL DEFAULT '' AFTER `yfshqyshemail`;
