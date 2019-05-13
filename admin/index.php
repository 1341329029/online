<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/index.css">
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
            error_reporting(E_ALL || ~E_NOTICE);
            include('adlogin/cookie.php');
            //$username = $_SESSION['username'] 
            //var_dump($_SESSION['name']);      
             if(isset($_SESSION['name'])){
                echo "<li>管理员</li>";
              }else{
              echo '<li><a href="adlogin/login.php">管理员登录</li>';
              }
           
              if(isset($_SESSION['name'])){
                echo "<li><a href='adlogin/logout.php'>退出</a></li>";
              }
              ?>
          </ul>
      </div>
      <div class="left">
          <dt class="#">管理中心</dt>
              <dd><a href="member.php">考生信息管理</a></dd>
              <dd><a href="ktlb.php">考試類別管理</a></dd>
              <dd><a href="add.php">考題信息添加</a></dd>
              <dd><a href="ktxx.php">考題信息管理</a></dd>
      </div>
  </div>
</body>
</html>