<?php 
	

	header("Content-Type:text/html;charset=utf-8");

	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	//登录处理界面
	
	//判断是否按提交按钮
	if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden"){

		$user = trim($_POST["username"]); //使用trim移除空格

		$pws = md5(trim($_POST["userpwd"]));
		$code = $_POST["code"];
		if($user==""||$pws==""){
			echo "<script>alert('输入用户名或者密码');history.go(-1);</script>";
			exit;
		} 
		 else if(strtoupper($_SESSION['code'])!= strtoupper($_POST['code']) ){
		 	echo "<script>alert('验证码不正确');history.go(-1);</script>";
		 	exit;
		 }
		 else{
		 	//确认用户密码不为空则链接数据库
		 	$conn = mysqli_connect("localhost","root","123456") or die("失败");
		 	if(mysqli_error($conn)){
					echo mysqli_error();
					exit;

		 }
		mysqli_select_db($conn,"online_test");//选择数据库
		mysqli_set_charset($conn,"utf8");//设置字符集
		$sql = "select username,userpwd from users where username = '$user' and userpwd = '$pws'";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);//统计执行结果影响函数
		echo $num;
		 if($num){ 
				//_set($user);
				mysqli_close($conn);
				echo "<script>alert('成功登录'); window.location.href='../index.php';</script>"; 
 					} else{ 
 						mysqli_close($conn);
 					echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
 					exit; 
 					} 
 				} 
 			}else { 
 				   echo "<script>alert('提交未成功！');</script>"; 
 				}

?>