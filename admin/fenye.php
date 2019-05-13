<?php
	include ("conn.php");
	include ("page.class.php");
	error_reporting(E_ALL || ~E_NOTICE);
     mysqli_select_db($conn,"topic");

	$sql = "SELECT count(*) as total from topic where ks_lx='".$_POST['ks_lx']."'";
	$res = mysqli_query($conn,$sql) or die("aa");
	$data = mysqli_fetch_assoc($res);

	//echo $_POST['ks_lx'];

	// $sql = "SELECT * FROM topic where ks_lx='".$_POST['ks_lx']."' ";
	
	echo $sql;
	$num = 5;
				$total = mysqli_fetch_assoc($data['total'],$num);
				
				//创建分页对象	
				
	
	
?>