<?php
	session_start();
	header('Content-Type:text/xml');

	$dates=$_SESSION[dates];
	$date1=$dates+20*60;

	$dates2=mktime();
	$dates3=$date1-$dates2;
	echo date("i:s",$dates3);
?>