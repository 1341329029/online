<?php
session_start();
include_once 'includes/global.func.php';
include_once 'conn/conn.php';
$sd=$_SESSION['gesu'];
  $aa=$_POST['submit0'];
    for ($i=0; $i <$sd ; $i++) { 
		if ($_POST['submit'.$i]) {
		$rrr=$_POST['submit'.$i];
	}
	}
	$_SESSION['$rrr']=$rrr;	
	if (!$rrr) {
			_alert_eo(操作错误);
		}	
$sql = "SELECT * FROM topic info where kt_lx='单选题'and ks_lx='$rrr'";
$sql_1 ="SELECT * FROM topic info where kt_lx='多选题'and ks_lx='$rrr'";
$sql_2 ="SELECT * FROM topic info where kt_lx='判断题'and ks_lx='$rrr'";
$sql_3 ="SELECT * FROM topic info where kt_lx='简答题'and ks_lx='$rrr'";
$result = mysqli_query($conn,$sql);
$result_1 = mysqli_query($conn,$sql_1);
$result_2 = mysqli_query($conn,$sql_2);
$result_3 = mysqli_query($conn,$sql_3);
$row = mysqli_fetch_array($result);
$row_1 = mysqli_fetch_array($result_1);
$row_2 = mysqli_fetch_array($result_2);
$row_3 = mysqli_fetch_array($result_3);
$temp=array();
do{
  $temp_1[]=$row;
}while($row = mysqli_fetch_array($result));
do{
  $temp_2[]=$row_1;
}while($row_1 = mysqli_fetch_array($result_1));
do{
  $temp_3[]=$row_2;
}while($row_2 = mysqli_fetch_array($result_2));
do{
  $temp_4[]=$row_3;
}while($row_3 = mysqli_fetch_array($result_3));

$temp = array_merge($temp_1,$temp_2,$temp_3,$temp_4);
// var_dump($temp);

$ww=count($temp_1);
$sb=range(0,$ww);
$sj=array_rand($sb,6);

$ww_1=count($temp_1)+count($temp_2);
$sb_1=range($ww+1,$ww_1);
$w=array_rand($sb_1,4);

$ww_2=count($temp_1)+count($temp_2)+count($temp_3);
$sb_2=range($ww_1,$ww_2);
$e=array_rand($sb_2,6);

$ww_3=count($temp);
$sb_3=range($ww_2,$ww_3);
$r=array_rand($sb_3,2);
$hello = array(
 explode('*',$temp[$sj[0]]['kq_da']),
 explode('*',$temp[$sj[1]]['kq_da']),
 explode('*',$temp[$sj[2]]['kq_da']),
 explode('*',$temp[$sj[3]]['kq_da']),
 explode('*',$temp[$sj[4]]['kq_da']),
 explode('*',$temp[$sb_1[$w[0]]]['kq_da']),
 explode('*',$temp[$sb_1[$w[1]]]['kq_da']),
 explode('*',$temp[$sb_1[$w[2]]]['kq_da']),
 explode('*',$temp[$sb_2[$e[0]]]['kq_da']),
 explode('*',$temp[$sb_2[$e[1]]]['kq_da']),
 explode('*',$temp[$sb_2[$e[2]]]['kq_da']),
 explode('*',$temp[$sb_2[$e[3]]]['kq_da']),
 explode('*',$temp[$sb_2[$e[4]]]['kq_da']),


);
// var_dump($hello);
$sdf = array(
 $temp[$sj[0]]['id'],
 $temp[$sj[1]]['id'],
 $temp[$sj[2]]['id'] ,
 $temp[$sj[3]]['id'] ,
 $temp[$sj[4]]['id'],
 $temp[$sb_1[$w[0]]]['id'] ,
 $temp[$sb_1[$w[1]]]['id'] ,
 $temp[$sb_1[$w[2]]]['id'] ,
 $temp[$sb_2[$e[0]]]['id'] ,
 $temp[$sb_2[$e[1]]]['id'] ,
 $temp[$sb_2[$e[2]]]['id'] ,
 $temp[$sb_2[$e[3]]]['id'] ,
 $temp[$sb_2[$e[4]]]['id'] ,
 $temp[$sb_3[$r[0]]]['id']
 );
 // var_dump( $temp[$sb_3[$r[0]]]['id']);
$_SESSION['dxt']=$sdf;
// echo "<pre>";
// print_r($_SESSION['dxt']);
// echo "</pre>";
// <?php
  
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $rrr;?>考试中</title>
	<link rel="stylesheet" type="text/css" href="css/answer.css">
	<script type="text/javascript">
		var initial_fontsize    = 15;
		function setFontsize(type,objname){
		    var oDiv = document.getElementById('wholepage_two');
		    if (oDiv!=null) {
		        if (type==1){
		            if(initial_fontsize<20){
		                oDiv.style.fontSize=(++initial_fontsize)+'px';
		            };
		        }
		        else {
		            if(initial_fontsize>12){
		                oDiv.style.fontSize=(--initial_fontsize)+'px';
		            }
		        }
		    }
		}

		function Change(HourSurplus,MinuteSurplus,SecondSurplus)
		{

		 SecondSurplus = SecondSurplus - 1;
		 if (SecondSurplus<0)
		 {
		 SecondSurplus=60+SecondSurplus;
		 MinuteSurplus=MinuteSurplus-1;
		 }
		 if (MinuteSurplus<0)
		 {
		 MinuteSurplus=60+MinuteSurplus;
		 HourSurplus=HourSurplus-1;
		 }
		 document.getElementById("time_con").innerHTML=""+ HourSurplus +":"+ MinuteSurplus +":"+ SecondSurplus +"";
		 setTimeout(function() {
		 Change(HourSurplus,MinuteSurplus,SecondSurplus);
		 },1000);
		  if(SecondSurplus>=0&&MinuteSurplus>=0&&HourSurplus<0){
		 	alert("时间到,请点击提交");
		 }
		}
	</script>
</head>
<body>
    <form action="includes/check_online.php" method="post">
		<div class="wholepage">
			<div class="logo">
				<div class="font-art">
					<span class="art">JWroom</span><span class="art_two">考试系统</span>
				</div>
				<!-- 头像名字 -->
				<?php
					include ('conn.php');
					$username = $_SESSION['username'];
					mysqli_select_db($conn,"topic");
					if(isset($_SESSION['username'])){
					$sql = "SELECT * from users where username = '{$_SESSION['username']}'";

					$result = mysqli_query($conn,$sql) or die('连接失败');
					if($html = mysqli_fetch_array($result)){
				//echo $html['face'];
		}
	}
		else{
			echo "<script>alert('请登录');history.go(-1);</script>";
		}
				?>
				<div class="head_pic ">
					
					<img class="pic_logo" src="<?php echo $html['face']?>" >
					<div class="pic_font"><?php echo $html['username']?> </div>
				<?php
					if (isset($_SESSION['username'])) {
						echo "<li class='exit'><a href='startteam.php'>退出&nbsp&nbsp</a></li>";
					} else {
						echo "<li class='exit'>{$_SESSION['username']}</li>";
					}
		
						?>
				</div>

			</div>
			<!-- 答题试卷 -->
			<div id="wholepage_two">
				<div class="backg"></div>
				<div class="time">
					<div class="team_name">
						<ul>
							<li><span><?php echo $rrr;?></span></li>
							<li><div id="time_con"></div></li>
						</ul>
					</div>
					<div class="submit_one">
						<ul>
							<li>
								<div id="size">
									<div id="jia"><input type="button" value="+" onclick="setFontsize(1,'Content')"></div>
									<span style="float:left;font-weight: lighter;font-size:110%;">A</span>
									<div id="jian"><input onclick="setFontsize(0,'Content')"  type="button" value="-"></div>
								</div>
							</li>
							<li><div id="enter"><a href="result.php" style="text-decoration:none;"><input type="submit" name="submit" value="提交"></a></div></li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div class="dx_choice">
						<div class="dx_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:10px;font-weight: lighter;">单选题（共5题，每题5分，共25分）</span></div>
            <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">1.<?php echo $temp[$sj[0]]['ks_nr']; ?></div>
            <?php for($i=0;$i<count($hello[0]);$i++){?>
            <div id="space"><label>  <input  name="dxt1" type="radio"id="one" value="<?php echo $hello[0][$i];?>"/><?php echo $hello[0][$i];?></label></div>
            <?php   } ?>



            <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">2.<?php echo $temp[$sj[1]]['ks_nr']; ?></div>
            <?php for($i=0;$i<count($hello[1]);$i++){?>
            <div id="space"><label>  <input  name="dxt2" type="radio"id="one" value="<?php echo $hello[1][$i];?>"/><?php echo $hello[1][$i];?></label></div>
            <?php   } ?>


            <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">3.<?php echo $temp[$sj[2]]['ks_nr']; ?></div>
            <?php for($i=0;$i<count($hello[2]);$i++){?>
            <div id="space"><label>  <input  name="dxt3" type="radio"id="one" value="<?php echo $hello[2][$i];?>"/><?php echo $hello[2][$i];?></label></div>
            <?php   } ?>


            <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">4.<?php echo $temp[$sj[3]]['ks_nr']; ?></div>
            <?php for($i=0;$i<count($hello[3]);$i++){?>
            <div id="space"><label>  <input  name="dxt4" type="radio"id="one" value="<?php echo $hello[3][$i];?>"/><?php echo $hello[3][$i];?></label></div>
            <?php   } ?>


            <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">5.<?php echo $temp[$sj[4]]['ks_nr']; ?></div>
            <?php for($i=0;$i<count($hello[4]);$i++){?>
            <div id="space"><label>  <input  name="dxt5" type="radio"id="one" value="<?php echo $hello[4][$i];?>"/><?php echo $hello[4][$i];?></label></div>
            <?php   } ?>
          </div>
					<div class="duox_choice">
						<div class="duox_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:5px;font-weight: lighter;">多选题（共3题，每题10分，共30分）</span></div>
						<div class="duox_problem">
              <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">6.<?php echo $temp[$sb_1[$w[0]]]['ks_nr']; ?></div>
              <?php for($i=0;$i<count($hello[5]);$i++){?>
              <div id="space"><label>  <input  name="dxt6[]" type="checkbox"id="one" value="<?php echo $hello[5][$i];?>"/><?php echo $hello[5][$i];?></label></div>
              <?php   } ?>


              <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">7.<?php echo $temp[$sb_1[$w[1]]]['ks_nr']; ?></div>
              <?php for($i=0;$i<count($hello[6]);$i++){?>
              <div id="space"><label>  <input  name="dxt7[]" type="checkbox"id="one" value="<?php echo $hello[6][$i];?>"/><?php echo $hello[6][$i];?></label></div>
              <?php   } ?>



              <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">8.<?php echo $temp[$sb_1[$w[2]]]['ks_nr']; ?></div>
              <?php for($i=0;$i<count($hello[7]);$i++){?>
              <div id="space"><label>  <input  name="dxt8[]" type="checkbox"id="one" value="<?php echo $hello[7][$i];?>"/><?php echo $hello[7][$i];?></label></div>
              <?php   } ?>
						</div>
					</div>
					<div class="pd_choice">
						<div class="pd_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:10px;font-weight: lighter;">判断题（共5题，每题5分，共25分）</span></div>
						<div class="pd_problem">

                <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">9.<?php echo $temp[$sb_2[$e[0]]]['ks_nr']; ?></div>
                <?php for($i=0;$i<count($hello[8]);$i++){?>
                <div id="space"><label>  <input  name="dxt9" type="radio"id="one" value="<?php echo $hello[8][$i];?>"/><?php echo $hello[8][$i];?></label></div>
                <?php   } ?>


                <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">10.<?php echo $temp[$sb_2[$e[1]]]['ks_nr']; ?></div>
                <?php for($i=0;$i<count($hello[9]);$i++){?>
                <div id="space"><label>  <input  name="dxt10" type="radio"id="one" value="<?php echo $hello[9][$i];?>"/><?php echo $hello[9][$i];?></label></div>
                <?php   } ?>


                <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">11.<?php echo $temp[$sb_2[$e[2]]]['ks_nr']; ?></div>
                <?php for($i=0;$i<count($hello[10]);$i++){?>
                <div id="space"><label>  <input  name="dxt11" type="radio"id="one" value="<?php echo $hello[10][$i];?>"/><?php echo $hello[10][$i];?></label></div>
                <?php   } ?>


                <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">12.<?php echo $temp[$sb_2[$e[3]]]['ks_nr']; ?></div>
                <?php for($i=0;$i<count($hello[11]);$i++){?>
                <div id="space"><label>  <input  name="dxt12" type="radio"id="one" value="<?php echo $hello[11][$i];?>"/><?php echo $hello[11][$i];?></label></div>
                <?php   } ?>


                <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px">13.<?php echo $temp[$sb_2[$e[4]]]['ks_nr']; ?></div>
                <?php for($i=0;$i<count($hello[12]);$i++){?>
                <div id="space"><label>  <input  name="dxt13" type="radio"id="one" value="<?php echo $hello[12][$i];?>"/><?php echo $hello[12][$i];?></label></div>
                <?php   } ?>
						</div>
					</div>
					<div class="jd_choice">
						<div class="jd_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:10px;font-weight: lighter;">简答题（共1题，每题20分，共20分）</span></div>
						<div class="jd_problem">
							  <div class="problem"><span style="margin-left:10px;font-size:17px;position: relative;top:12px;border-bottom:none;">14.<?php echo $temp[$sb_3[$r[0]]]['ks_nr']; ?></div>
							<textarea class="text_box" contenteditable="true" name="dxt14"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script language="javascript">
			Change(00,20,00);
		</script>
	</form>
</body>
</html>
