<?php
session_start();
session_unset($_SESSION['yhid']);
session_unset($_SESSION['yhname']);
echo "注销成功,马上跳转...";
header("refresh:2;url=index.php");