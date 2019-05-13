<?php
$conn= mysqli_connect("localhost","root","123456","online_test","3306") or die("连接失败");//连接数据库
error_reporting(E_ALL || ~E_NOTICE);
mysqli_query($conn,"set names utf8");
header("Content-Type: text/html; charset=utf-8");
 ?>
