<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
    error_reporting(E_ALL || ~E_NOTICE);
    //引用数据库加载页面
    include("conn/conn.php");
    // $conn = mysqli_connect("localhost","root","123456") or die("链接失败");
    //     mysqli_select_db($conn,"online_test");
    //     mysqli_query($conn,"set names utf8");

    if(isset($_SESSION['username'])){
       
        $sql = "SELECT * from users where username = '{$_SESSION['username']}'";
        // echo $sql;
        //var_dump($sql);
        $result = mysqli_query($conn,$sql) or die("false");
        
        if($html = mysqli_fetch_array($result)){        
        }  
    }else{
        echo "<script>alert('请登录');history.go(-1);</script>";
    }
      $sql22 = "SELECT ks_lx from topic ";
      $result100 = mysqli_query($conn,$sql22);
      while ($row100 = mysqli_fetch_array($result100)) {
          $array[]=$row100;
      }
       // var_dump($array);
     // for ($i=0; $i < count($array); $i++) { 
     //    for ($j=0; $j <count($array)-$i ; $j++) { 

     //        if ($array[$j]['0']==$array[$j+1]['0']) {
               
     //        }
     //        else{
     //            $www[]=$array[$j]['0'];

     //        }
     //    }
       
     // }
 //去列操作将考试类型全部提取出来
    $www=array_column($array,'ks_lx');
   //去重操作将考试类型重复去除
   $www=array_unique($www); 
   //重置索引
   $ww = array_values($www);
    // var_dump($www);
    $_SESSION['gesu']=3;
    // var_dump( $_SESSION['gesu']);
    //禁区
    // $ww[]=array($www['0'],$www['1'],$www['4']);
   

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>考试试卷</title>
    <link rel="stylesheet" type="text/css" href="css/startteam.css">
    <script src="js/personal_information.js" ></script>
</head>
<body>
    <div class="wholepage">
        <div class="menu" id="menu">
            <div class="jianjie">
                <div class="compile">
                    <span style="cursor:pointer;float:left;color:white;margin-left:30px;font-size: 18px;position: relative;top:10px">个人信息</span>
                    <span style="cursor:pointer;float:right;color:white;margin-right:30px;font-size: 18px;position: relative;top:10px"><a href="member_modify.php"  style="color:white">编辑</a></span>
</span>
                </div>
                <div class="jj_left">
                    <ul>
                        <li>昵称：<?php echo $html['username']?></li>
                        <li>真实姓名：<?php echo $html['zsname']?></li>
                        <li>性别：<?php echo $html['sex']?></li>
                        <li>邮箱：<?php echo $html['email']?></li>
                      
                    </ul>
                </div>
                <div class="jj_right">
                    <ul>
                          <li>学校：<?php echo $html['school']?></li>
                        <li>职位：学生</li>
                        <li>城市：吉林</li>
                        <li>个性签名：<?php echo $html['qianming']?></li>

                    </ul>
                </div>
            </div>
            <div class="menu_top" id="menu_top">
                <ul id="menu_left">
                    <a href=""><li>首页</li></a>
                    <a href=""><li style="background: rgba(255,255,255,0.6);">考试试卷</li></a>
                    <a href="history.php"><li>历史记录</li></a>
                </ul>
                <div class="picture_head" id="picture_head">
                    <img src="<?php echo $html['face']?>" style="width:120px;height:120px;border:1px solid white;border-radius:50%;">
                </div> 
                <ul id="menu_right">
                    <a href="shoucang.php"><li>收藏夹</li></a>
                    <a href="mistake.php"><li>错题本</li></a>                    
                    <a href="includes/logout.php"><li>退出登录</li></a>
                </ul>
            </div>
        </div>
        <div class="content">
            <div id="team" >
              <form action="answer.php" method="post">
                <ul class="list_top">
                    <?php 
                    $r=0;
                    while ($ww[$r]) {  

                    ?>
                    <li><input   type="submit" name=<?php echo"submit".$r;?> value=<?php echo $ww[$r];?>  class="team_o">                                           
                    </span></li>
                    <?php
                    $r++;
                    }?>
                </ul>
                <ul class="list_bottom">
                    
                </ul>
              </form>
            </div>
    </div>
</body>     
</html>

