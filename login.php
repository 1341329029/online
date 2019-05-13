<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>考试星</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script type="text/javascript">
			function foo(){
				if(myform.name.value==""){
					alert("请输入用户名");
					 
					myform.username.focus();
					exit();
					return false;
					
				}
				if(myform.userpwd.value==""){
					alert("请输入密码");
					myform.pwd.focus();
					exit();
					return false;
					
				}
				if(myform.code.value==""){
					alert("请输入验证码");
					myform.code.focus();
					exit();
					return false;
					
				}
			}
	</script>
</head>
<body>
	<form method="post" action="includes/logincheck.php" name="myform" onsubmit="return foo()"> 
	<div id="mainbody">
		 <div class="mainbox">
				<div class="top">
					<div class="image"></div>
					<div class="total"><p style="color:#0ef2fa">考试系统</p></div>
				</div>
				<input type="text" name="username" class="xuehao" placeholder="学号" style="margin-top:50px">
				<input type="password" name="userpwd" class="xuehao" placeholder="请输入密码">
				<input type="text" class="xuehao" name="code" placeholder="验证码" id="validate" style="margin-top:20px;margin-left:75px">
				<!-- <div class="image2" style="cursor: hand" src="code.php" onclick="this.src='code.php?'+Math.random()"></div> -->
				<img  class="yzm" style="cursor: hand" src="includes/code.php" onclick="this.src='includes/code.php?'+Math.random()" style="margin-top:40px" width="130px" height="60px" >
				
				<button  id="begin" style="margin-top:25px;width:250px;height:40px;border:1px solid rgb(62,118,177);background:rgb(62,118,177);border-radius: 5px;color:white;">登录</button>
				<span><input type="hidden" name="hidden" value="hidden"></span>
		</div>
	</div>
	</form>	
</body>
</html>