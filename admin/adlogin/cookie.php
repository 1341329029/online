<?php
session_start();
error_reporting(E_ALL || ~E_NOTICE);
$_SESSION['username']=$user;
?>