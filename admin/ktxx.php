<?php
session_start();
  include ("conn.php");
  include('cookie.php');
  include('session2.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>考题信息管理</title>
 <link rel="stylesheet" type="text/css" href="css/add.css">
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
  </head>
  <body>
  

      <div class="top">
      </div>
      <div class="nexttop">
          <div class="leftnexttop">
                <p>在线考试后台管理系统</p>
          </div>
           
          <ul>
      
            <?php
            error_reporting(E_ALL || ~E_NOTICE);

            if($_SESSION['name']==""){
              echo "<script>alert('請登錄');history.go(-1);</script>"; 
           }
            
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
      


    <div class="main">
     
          <form name="form1" action="ktxx.php" method="post">


<?php
          include('../conn/conn.php');


            
     $sql = "SELECT * from report";
     //echo $sql;
      $result =  mysqli_query($conn,$sql) or die("false1");
    

  echo '<table border="1" width="300" align="center" class="table">';
  echo '<br>';
  echo '<caption class="h1"><h1>考试成绩</h1></caption>';
  echo '<br>';
  echo '<tr>';
  echo '<th>真实姓名</th>';
  echo '<th>成绩</th>';
  echo '<th>次数</th>';
 
  echo '</tr>';

    while($array=mysqli_fetch_array($result)){
    // $temp[] = $array['name'];
    // var_dump($temp);
    echo '<tr>';
    echo "<td align='center'>{$array['reallyname']}</td>";
    echo "<td align='center'>{$array['report']}</td>";
    echo "<td align='center'>{$array['cs']}</td>";
   
   
    echo '</tr>';      
    }   
  ?>
        </form>
        
        
          <form name="form1" action="modify.php" method="post" >
          
            
            </form>
           
            </div>
             
            <div class="fenye">
              
             
            </div>
            
  </body>
</html>
