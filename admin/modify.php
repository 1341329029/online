<?php 
	header ( "Content-type: text/html; charset=utf-8" );  	
session_start();
	include ("conn.php");
	if(isset($_SESSION['name'])){
		if(isset($_SESSION['name']) && $_POST['submit2']){
				
				mysqli_select_db($conn,"topic");

				if(isset($_POST['submit2'])){
			

				$sql = "UPDATE `topic` SET ks_nr='".$_POST['ks_nr']."',kq_da='".$_POST['kq_da']."',zq_da='".$_POST['zq_da']."',kt_jx='".$_POST['kt_jx']."' WHERE id='".$_POST['id']."'";
				}
			$result = mysqli_query($conn,$sql) or die("gg");
			if($result){
			echo "<script>alert('修改成功');location.href='ktlb.php';</script>";
		}else{
			echo "<script>alert('修改');history.go(-1);</script>";
			exit();
			}
		}
		if(isset($_POST['submit3'])){
			mysqli_select_db($conn,"topic");
			$sql = "DELETE from topic WHERE id='".$_POST['id']."'";
			$result = mysqli_query($conn,$sql) or die("連接失敗");
			if(mysqli_affected_rows($conn)){
				echo "<script>alert('刪除成功');history.go(-1);</script>";
			}else{
				echo "<script>alert('刪除失敗');history.go(-1);</script>";
			}
		}	
	}else
		{
			echo "<script>alert('请登录');history.go(-1);</script>";
		}
?>