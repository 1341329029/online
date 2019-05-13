<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript">
      function del(){

      var msg=confirm("你确定删除此记录吗？");

      if(msg==true){

       return true;

      }else{

       return false;

 }

}
  </script>
  <title>在線考試系統後台管理</title>
</head>
<body>

  <div class="homepage">
      <div class="top">
      </div>
      <div class="nexttop">
          <div class="leftnexttop">
                <p>在线考试后台管理系统</p>
          </div>
           
          <ul>
			
            <?php
            session_start();
            error_reporting(E_ALL || ~E_NOTICE);
              if(isset($_SESSION['name'])){
                echo "<li>管理员</li>";
              }else{
              echo '<li><a href="adlogin/login.php">管理员登录</li>';
              }
              ?>    
              <?php
             error_reporting(E_ALL || ~E_NOTICE);
              if(isset($_SESSION['name'])){
                echo "<li><a href='adlogin/logout.php'>退出</a></li>";
              }
              ?>

          </ul>
      </div>
      <div class="left">
          <dt>管理中心</dt>
              <dd><a href="member.php">考生信息管理</a></dd>
              <dd><a href="ktlb.php">考試類別管理</a></dd>
              <dd><a href="add.php">考題信息添加</a></dd>
              <dd><a href="ktxx.php">考題信息管理</a></dd>
      </div>
      
      <div class="right">
      			<?php
          session_start();
      		if($_SESSION['name']==""){
           		echo "<script>alert('请登录');history.go(-1);</script>"; 
           }
	include ("conn.php");
	error_reporting(E_ALL || ~E_NOTICE);
	mysqli_query($conn,"set names utf8");
	mysqli_select_db($conn,"users");
	$sql = "SELECT * from users order by id";
	$result = mysqli_query($conn,$sql) or die("false");

	if($_GET['id']){
		$sql = "DELETE  from users where id='{$_GET['id']}'";
		 echo $sql;
	   		mysqli_query($conn,$sql) or die("false1");
		
		echo "<script>alert('删除成功')</script>";
		echo "<script>window.location.href='member.php'</script>";

	}

	echo '<table border="1" width="900" align="center" class="table">';
	echo '<br>';
	echo '<caption class="h1"><h1>考生信息</h1></caption>';
	echo '<br>';
	echo '<tr>';
	echo '<th>學號</th>';
	echo '<th>姓名</th>';
	echo '<th>性別</th>';
	echo '<th>郵件</th>';
	echo '<th>學校</th>';
	echo '<th>操作</th>';
	echo '</tr>';
	
	while($array=mysqli_fetch_array($result)){
		// $temp[] = $array['name'];
		// var_dump($temp);
		echo '<tr>';
		echo "<td align='center'>{$array['id']}</td>";
		echo "<td align='center'>{$array['zsname']}</td>";
		echo "<td align='center'>{$array['sex']}</td>";
		echo "<td align='center'>{$array['email']}</td>";
		echo "<td align='center'>{$array['school']}</td>";
		echo "<td align='center'><a href='member.php?&id={$array['id']}' onclick='return del()'>删除</a></td>";
		echo '</tr>';						
	}

?>

      </div>
</body>
</html>