<?php
header("Content-Type:text/html;charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);
session_start();

	//注册处理页面
	
	 if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden"){

		$user = trim($_POST["name"]); //使用trim移除空格
		$truename = trim($_POST["truename"]);
		$year = $_POST["year"];
		$month =$_POST["month"];
		$day = $_POST["day"];
		$sex = $_POST["sex"];
		$face = $_POST['face'];
		$email = $_POST["email"];
		$school = $_POST['school'];
		$pws = md5(trim($_POST["pwd"]));
		$pws_confirm = md5(trim($_POST['confirm']));
		$code = $_POST["code"];
		// if($user==""|| $pws==""||$pws_confirm==""||$sex==""||$birth==""||$truename=""||$email==""){
		// 	echo "<script>alert('确认信息完整性');history.go(-1);</script>";
			
		// }
		if(strlen($_POST['name'])>10){
			echo "<script>alert('学号不符合规定');history.go(-1);</script>";
			 	exit();
		}
		if(strlen($_POST["pwd"]) < 6 ){
			echo "<script>alert('密码长度不符合规定');history.go(-1);</script>";
			 	exit();
		}
		if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$email)){
			echo "<script>alert('邮箱不符合规定');history.go(-1);</script>";
			 	exit();
		}
			
		 else if(strtoupper($_SESSION['code'])!= strtoupper($_POST['code']) ){
		 	echo "<script>alert('验证码不正确');history.go(-1);</script>";
		 }
		else {
			if($pws == $pws_confirm){
				$conn = mysqli_connect("localhost","root","123456","online_test","3306") or die("连接失败");
				if(mysqli_error($conn)){
					echo mysqli_error();
					exit();
				}

				mysqli_query($conn,"set names utf8");
				$sql = "select username from users where username = '$user'";
				$result = mysqli_query($conn,$sql);
				$num = mysqli_num_rows($result);//统计执行结果影响函数
				
				//判断用户是否注册过
				if($num){ 
					//若果已经存在该用户
					mysqli_close($conn);
					echo "<script>alert('用户名已存在');history.go(-1);</script>";

				}else{
					

					  $sql_insert = "INSERT into users(username,userpwd,userpwd1,zsname,sex,face,year,month,day,school,email) values('$user','$pws','$pws_confirm','$truename','$sex','$face','$year','$month','$day','$school','$email')";

	
					//echo $sql_insert;
					 $res_insert = mysqli_query($conn,$sql_insert) or die ("失败");
					
					 if($res_insert){
					 	mysqli_close($conn);
					 		echo "<script>alert('注册成功');location.href='../index.php';</script>";
					 }
					 else{
					 	mysqli_close($conn);
					 		echo "<script>alert('注册失败');history.go(-1);</script>";
					 }
				}
			}
			 else{
			 	echo "<script>alert('密码不一致');history.go(-1);</script>";
			 }
		}
	}
	else{
		echo "<script>alert('未提交成功');history.go(-1);</script>";
	}
?> 