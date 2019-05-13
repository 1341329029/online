<?php
	session_start();
	include("conn/conn.php");
	include_once 'includes/global.func.php';
	$rrr=$_SESSION['$rrr'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>解析页</title>
	<link rel="stylesheet" type="text/css" href="css/analysis.css">
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
		
	</script>
</head>
<body>
	<form method="POST" action="includes/check_shouchang.php">
		<div class="wholepage">
			<div class="logo">
			<div class="font-art">
				<span class="art">JWroom</span><span class="art_two">考试系统</span>
			</div>
					<?php
					include ('conn/conn.php');
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
				<div class="head_pic">
					
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
			</div>
			<!-- 答题试卷 -->
			<div id="wholepage_two">
				<div class="backg"></div>
				<div class="time">
					<div class="team_name">
						<ul>
							<li style="position: relative;top:20px;"><span><?php echo $rrr;?></span></li>
						</ul>
					</div>
					<div class="submit_one">
						<ul>
							<li  style="position: relative;top:20px;"><span>
								<div id="size">
									<div id="jia"><input type="button" value="+" onclick="setFontsize(1,'Content')"></div>
									<span style="float:left;font-weight: lighter;font-size:110%;">A</span>
									<div id="jian"><input onclick="setFontsize(0,'Content')"  type="button" value="-"></div>
								</div>
							</li>
						</ul>
					</div>
					<input type="submit" value="收藏" name="submit" class="shoucang">

				</div>
				
				<div class="content">
					<div class="dx_choice">
						<div class="dx_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:10px;font-weight: lighter;">单选题（共5题，每题5分，共25分）</span></div>

						<div class="dx_problem">
							<?php

								session_start();
								$dxt=$_SESSION['dxt'];
								if (!$dxt) {
									_alert_eo(操作错误);
								}
								unset($_SESSION['dxt']);
								$query100 = mysqli_query($conn,"select * from tom");
								$array100 = mysqli_fetch_array($query100);
								// echo $array100[sz];

								$i=0;
								$x=1;
								while ($x<6) {
									$query = mysqli_query($conn,"select * from topic where kt_lx='单选题' and id=$dxt[$i]");
									$array = mysqli_fetch_array($query);
							?>
							<div class="problem">
								<span style="margin-left:10px;font-size:17px;position: relative;top:12px">
									<?php echo $x.".".$array["ks_nr"]; ?>
								</span>
								
								<!-- <span class="star" id="star_one"></span> -->
								<div class="checkboxFour">
									<?php
									 echo "<input type=\"checkbox\" value=\"".$dxt[$i]."\"  id=\"checkboxFourInput\"  name=\"".$x."\" class=\"hah\" />";
									 // $ss=array('' => , );
									 
									 ?>
	       							 <label for="checkboxFourInput"></label>
	       							 <!-- <input type="hidden" value="$dxt[$i]" name="$dxt[$i]"> -->
								</div>
								
							</div>
							<?php
								$array1=explode("*",$array["kq_da"]);
								for($a=0;$a<count($array1);$a++){
									if($array1[$a]!=""){
							?>
							<div id="space">
								<input type="radio" name="<?php echo $array[id]; ?>" id="one" value="<?php echo $array1[$a]; ?>"><span><?php echo $array1[$a]; ?></span><br/>
							</div>
							<?php
								}
							}
						
							$query1 = mysqli_query($conn,"select * from transfer where kt_id='$array[id]' and kt_cs=$array100[sz]");

							$array2 = mysqli_fetch_array($query1);
							if($array2[kt_pd]=="yes"){
								$fs=5;
							}else{
								$fs=0;
							}
							?>
							
							<div class="analysis">
								<span style="font-size:14px;position:relative;top:10px;margin-left:10px">正确答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array[zq_da] ?></span><span style="font-size:14px;position:relative;top:10px;margin-left:10px">考生答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array2[ks_da]; ?></span><span style="font-size:14px;position:relative;top:10px;margin-left:20px">得分情况：</span><span style="font-size:14px;position:relative;top:10px;margin-left:5px"><?php echo $fs; ?>分</span><br/>
								<span style="font-size:14px;position:relative;top:10px;margin-left:10px">答案解析：</span><br/><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array["kt_jx"] ?></span>
							</div>
							<?php
								
								$i++;
								$x++;
								}
							?>
					<div class="duox_choice">
						
						<div class="duox_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:5px;font-weight: lighter;">多选题（共3题，每题10分，共30分）</span></div>
						<div class="duox_problem">
							<?php
							$i=5;
							$y=6;
							while ($y<9) {
								$query2=mysqli_query($conn,"select * from topic where kt_lx='多选题' and id=$dxt[$i]");
								$array3 = mysqli_fetch_array($query2);
								

						?>
							<div class="problem">
								<span style="margin-left:10px;font-size:17px;position: relative;top:12px"><?php echo $y.".".$array3["ks_nr"]; ?></span>
								<div class="checkboxFour">
									 <?php
									 echo "<input type=\"checkbox\" value=\"".$dxt[$i]."\"  id=\"checkboxFourInput\"  name=\"".$y."\" class=\"hah\" />";
									 // $ss=array('' => , );
									 
									 ?>
	       							 <label for="checkboxFourInput"></label>
	       							 <!-- <input type="hidden" value="$dxt[$i]" name="$dxt[$i]"> -->
								</div>
								
								
							</div>
							<?php
								$array4=explode("*",$array3["kq_da"]);
								for($a=0;$a<count($array4);$a++){
									if($array4[$a]!=""){
							?>
							<div id="space">
								<input type="checkbox" name="<?php echo $array3[id]; ?>" id="one" value="<?php echo $array4[$a]; ?>"><span><?php echo $array4[$a]; ?></span><br/>
							</div>
							<?php
									}
								}
								$query3 = mysqli_query($conn,"select * from transfer where kt_id='$array3[id]' and kt_cs=$array100[sz]");

							$array5 = mysqli_fetch_array($query3);

							if($array5[kt_pd]=="yes"){
								$fs=10;
							}else{
								$fs=0;
							}
							?>
							<div class="analysis">
								<span style="font-size:14px;position:relative;top:10px;margin-left:10px">正确答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array3[zq_da]; ?></span><span style="font-size:14px;position:relative;top:10px;margin-left:10px">考生答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array5[ks_da]; ?></span><span style="font-size:14px;position:relative;top:10px;margin-left:20px">得分情况：</span><span style="font-size:14px;position:relative;top:10px;margin-left:5px"><?php echo $fs; ?></span><br/>
								<span style="font-size:14px;position:relative;top:10px;margin-left:10px">答案解析：</span><br/><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array3[kt_jx]; ?></span>
								
							</div>	
							<?php
							   
								$i++;
								$y++;
								}
							?>
							
					<div class="pd_choice">
						<div class="pd_heading"><span style="font-size: 120%;display:block;position: relative;top:15px;left:10px;font-weight: lighter;">判断题（共5题，每题5分，共25分）</span></div>
						<div class="pd_problem">
							<?php
							
							$z=9;
							$i=8;
							while ($z<14) {
								$query4=mysqli_query($conn,"select * from topic where kt_lx='判断题' and id=$dxt[$i]");
								$array6 = mysqli_fetch_array($query4)
						?>
							<div class="problem">
								<span style="margin-left:10px;font-size:17px;position: relative;top:12px"><?php echo $z.".".$array6["ks_nr"]; ?></span>
								<div class="checkboxFour">
									 <?php
									 echo "<input type=\"checkbox\" value=\"".$dxt[$i]."\"  id=\"checkboxFourInput\"  name=\"".$z."\" class=\"hah\" />";
									 // $ss=array('' => , );
									 
									 ?>
	       							 <label for="checkboxFourInput"></label>
	       							 <!-- <input type="hidden" value="$dxt[$i]" name="$dxt[$i]"> -->
								</div>
								
								
							</div>
							<?php
								$array7=explode("*",$array6["kq_da"]);
								for($a=0;$a<count($array7);$a++){
									if($array7[$a]!=""){
							?>
							<div id="space">
								<input type="radio" name="<?php echo $array6[id]; ?>" id="one" value="<?php echo $array7[$a]; ?>"><span><?php echo $array7[$a]; ?></span><br/>
							</div>
							<?php
									}
								}
								$query6 = mysqli_query($conn,"select * from transfer where kt_id='$array6[id]' and kt_cs=$array100[sz]");

							$array8 = mysqli_fetch_array($query6);
							if($array8[kt_pd]=="yes"){
								$fs=5;
							}else{
								$fs=0;
							}
							?>
							<div class="analysis">
								<span style="font-size:14px;position:relative;top:10px;margin-left:10px">正确答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array6[zq_da]; ?></span><span style="font-size:14px;position:relative;top:10px;margin-left:10px">考生答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array8[ks_da]; ?></span><span style="font-size:14px;position:relative;top:10px;margin-left:20px">得分情况：</span><span style="font-size:14px;position:relative;top:10px;margin-left:5px"><?php echo $fs; ?>分</span><br/>
								<span style="font-size:14px;position:relative;top:10px;margin-left:10px">答案解析：</span><br/><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array6[kt_jx]; ?></span>
							</div>	
							<?php
							   
								$i++;
								$z++;
								}
							?>
					</div>
					<div class="jd_choice">
						<div class="jd_heading">
							<span style="font-size: 120%;display:block;position: relative;top:15px;left:10px;font-weight: lighter;">简答题（共1题，每题20分，共20分）</span>
						</div>
						<div class="jd_problem">
							<?php
							
							$s=14;
							$i=13;
							while ($s<15) {
								$query6=mysqli_query($conn,"select * from topic where kt_lx='简答题' and id=$dxt[$i]");
								$array9 = mysqli_fetch_array($query6);
						?>
							<div class="problem" style="border-bottom: none;"><span style="margin-left:10px;font-size:17px;position: relative;top:12px"> <?php echo $s.".".$array9["ks_nr"]; ?></span>
								<div class="checkboxFour">
									 <?php
									 echo "<input type=\"checkbox\" value=\"".$dxt[$i]."\"  id=\"checkboxFourInput\"  name=\"".$s."\" class=\"hah\" />";
									 // $ss=array('' => , );
									 
									 ?>
	       							 <label for="checkboxFourInput"></label>
	       							 <!-- <input type="hidden" value="$dxt[$i]" name="$dxt[$i]"> -->
								</div>
								
								
							</div>
						
							<div class="text_box" contenteditable="true"></div>
							<?php
								$query8 = mysqli_query($conn,"select * from transfer where kt_id='$array9[id]' and kt_cs=$array100[sz]");

								$array10 = mysqli_fetch_array($query8);
								if($array10[kt_pd]!=""){
									$fs=round($array10[kt_pd],1);
								}
							?>
							<div class="analysis">
							<span style="font-size:14px;position:relative;top:10px;margin-left:10px">正确答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array9[zq_da]; ?></span><br><span style="font-size:14px;position:relative;top:10px;margin-left:10px">考生答案：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array10[ks_da]; ?></span><br><span style="font-size:14px;position:relative;top:10px;margin-left:10px">得分情况：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $fs; ?>分</span><br/>
							<span style="font-size:14px;position:relative;top:10px;margin-left:10px">答案解析：</span><span style="font-size:14px;position:relative;top:10px;margin-left:10px"><?php echo $array9[kt_jx]; ?></span>
						</div>	
						<?php

						$i++;
						$s++;
						
						}
						?>
						</div>

					</div>
				</div>
			</div>
		</div>
		<script src="js/analysis.js"></script>
		</form>
</body>
</html>