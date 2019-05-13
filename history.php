<?php
    header("Content-Type: text/html; charset=utf-8");
    session_start();
    error_reporting(E_ALL || ~E_NOTICE);
    $conn = mysqli_connect("localhost","root","123456") or die("链接失败");
        mysqli_select_db($conn,"online_test");
        mysqli_query($conn,"set names utf8");
    if(isset($_SESSION['username'])){
       
        $sql = "SELECT * from users where username = '{$_SESSION['username']}'";
        // echo $sql;
        //var_dump($sql);
        $result = mysqli_query($conn,$sql) or die("false");
        
        if($html = mysqli_fetch_array($result)){
                
        }
        
        
    }else{
        echo "<script>alert('用户不存在');history.go(-1);</script>";
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>历史纪录</title>
    <link rel="stylesheet" type="text/css" href="css/history.css">
    <script src="js/personal_information.js" ></script>
</head>
<body>
    <div class="wholepage">
        <div class="menu" id="menu">
            <div class="jianjie">
                <div class="compile">
                    <span style="cursor:pointer;float:left;color:white;margin-left:30px;font-size: 18px;position: relative;top:10px">个人信息</span>
                    <span style="cursor:pointer;float:right;color:white;margin-right:30px;font-size: 18px;position: relative;top:10px"><a href="member_modify.php" style="color:white">编辑</a></span>
                </div>
                <div class="jj_left">
                    <ul>
                        <li>昵称：<?php echo $html['username']?></li>
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
                    <a href="startteam.php"><li>考试试卷</li></a>
                    <a href=""><li style="background: rgba(255,255,255,0.6);">历史记录</li></a>
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
            <div id="history" class="hide a">
                
                <ul>
                <?php
                    include ("includes/page.class.php");
                    $cookie=$html['username'];
                    $query200 = mysqli_query($conn,"select * from transfer where kt_user='$cookie'");
                    
                    $total = mysqli_num_rows($query200);

                    //echo $total;
                    //echo "+++++";
                    $i=1;
                    //创建分页对象    
                    $num=5;
                    $page=new Page($total,$num);

                    $query = mysqli_query($conn,"select * from transfer where kt_user='$cookie' order by id asc {$page->limit}");
                    //$array = mysqli_fetch_array($query);
                    //echo "select * from transfer {$page->limit}";
                     
                    $x=0;
                    while ($array = mysqli_fetch_array($query)) {

                    $query1 = mysqli_query($conn,"select * from topic where id=$array[kt_id]");
                    //echo $array[kt_id];
                    //echo $array[ks_da];
                    $array1 = mysqli_fetch_array($query1);
                    if($array1["ks_nr"]!=""){
                     
                ?>
                
                    <li>
                        <span style="display:block;width:100%;height:40px;position: relative;top:0px;background:rgb(120,170,240);"><?php echo $i.".".$array1["ks_nr"]; ?></span>
                    <div style="background:white;padding:10px 0px;opacity:0.8;">
                    <?php
                        $array2=explode("*",$array1["kq_da"]);
                        for($a=0;$a<count($array2);$a++){
                            if($array2[$a]!=""){
                                if(trim($array2[$a])==$array1[zq_da]){

                    ?> 
                   
                        <span style="display:block;background:rgba(120,170,240,0.6);width:96.3%;border-radius:5px;padding:0px 20px;"><?php echo $array2[$a]; echo "(正确答案)";?></span>
                        
                    <?php
                                }else{
                    ?>
                        <span style="margin-left:20px;"><?php echo $array2[$a]; ?></span><br/>
                    <?php       
                            }
                            }
                        }
                    ?>
                    </div>
                    <div style="width:100%;background:rgba(120,170,240,0.5);">
                        <span  style="margin-left:20px">考生答案：</span><span ><?php echo $array["ks_da"]; ?></span><br/>
                        <span  style="margin-left:20px;">答案解析：<?php echo $array1["kt_jx"]; ?></span>
                    </div>
                    </li>
                
                <?php
                    }
                    $i++;
                    $x++;
                    }
                ?>
                </ul>
                <div class="fenye">
                <?php
                echo '<form action="history.php?action=del&page='.$page->page.'">';
                echo '<table border="0" width="900">';
                echo '<tr><td colspan="9" align="left" >'.$page->fpage().'</td></tr>';
                echo '</table>';
                echo '</form>';
                ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>