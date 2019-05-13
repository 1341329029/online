<?php
	session_start();
	include("conn/conn.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>考试结果</title>
	<link rel="stylesheet" type="text/css" href="css/result.css">
</head>
<body>
	<div id="mainbody">
		<div class="logo">
			<div class="font-art">
				<span class="art">JWroom</span><span class="art_two">考试系统</span>
			</div>
					<?php
					include ('conn.php');
					$username = $_SESSION['username'];
					mysqli_select_db($conn,"topic");
					if(isset($_SESSION['username'])){
					$sql = "SELECT * from users where username = '{$username}'";

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
						echo "<li class='exit' style='list-style: none;'><a href='startteam.php' style='color:white;text-decoration:none;'>退出&nbsp&nbsp</a></li>";
					} else {
						echo "<li class='exit'>{$_SESSION['username']}</li>";
					}
		
						?>
						
				</div>
		</div>
		<div class="mainbox">
			<div class="top">
				<p>考试结果</p>
			</div>
			<div class="circle1">
				<span class="right">正确率:</span>
				<span class="percent">
				<?php
					$sql100="select * from tom";
					$query100=mysqli_query($conn,$sql100);
					$array100=mysqli_fetch_array($query100);

					$query = mysqli_query($conn,"select * from transfer where kt_cs=$array100[sz]");
					while($array2 = mysqli_fetch_array($query)){
					if($array2[kt_pd]=='yes'){
						$x += 1;
					}elseif ($array2[kt_pd]=='no') {
						$x += 0;
					}else{
						$x += ($array2[kt_pd]/20);
					}
					}
					
					echo round($x/14*100,1);
				?>
				%</span>
			</div>
			<div class="circle2">
				<span>
				<?php
					session_start();
					//var_dump($_SESSION['dxt']);
					$dxt=$_SESSION['dxt'];
					//unset($_SESSION['dxt']);
					//echo count($dxt);

					// $sql100="select * from tom";
					// $query100=mysqli_query($my_sqli,$sql100);
					// $array100=mysqli_fetch_array($query100);

					$fen0=0;
					$i=0;
					while($i<count($dxt)){
					$sql = "select * from transfer where kt_pd='yes' and kt_id=$dxt[$i] and kt_cs=$array100[sz]";
					$query = mysqli_query($conn,$sql);
					$array = mysqli_fetch_array($query);
					
					$query1 = mysqli_query($conn,"select * from topic where id='$array[kt_id]'");

					$array1 = mysqli_fetch_array($query1);
						
						if($array1[kt_lx]=="单选题" ){
							$fen0 += 5;
						}elseif ( $array1[kt_lx]=="判断题") {
							$fen0 += 5;
						}elseif ($array1[kt_lx]=="多选题") {
							$fen0 += 10;
						}
					// 	else{
					// 		$query2 = mysqli_query($my_sqli,"select * from transfer and kt_cs=$array100[sz]");
					// 		$array2 = mysqli_fetch_array($query2);
					// 			if($array2[kt_pd]!='yes' && $array2[kt_pd]!='no' &&$array2[kt_pd]!=""){
					// 			$fen1=round($array2[kt_pd],1);
						
					// }
					// 	}
						
					$i++;
					}
					$query2 = mysqli_query($conn,"select * from transfer where kt_cs=$array100[sz]");
					while($array4 = mysqli_fetch_array($query2)){
						$query3 = mysqli_query($conn,"select * from topic where id=$array4[kt_id]");
						$array3 = mysqli_fetch_array($query3);
						if($array3[kt_lx]=="简答题"){
							$fen1=round($array4[kt_pd],1);
							
						}
					}
					
				$zf=$fen0+$fen1;
				echo $zf;
				?>
				分</span>
			</div>
			<!-- <div class="circle3">
				<span class="right">排名:</span>
				<span class="percent">NO.1</span>
			</div> -->
			<input type="password" placeholder="请输入您的查询码" name="search">
			<input type="button" value="查询" id="search" name="searchbutton">
            <a href="analysis.php" style="text-decoration:none;"><input type="button" value="查看解析" id="analysis" name="analysis"></a>
            <input type="button" value="退出此页" id="move" name="move">
		</div>
	</div>
</body>
</html>
<?php
$sql88 = "SELECT * from users where username = '{$username}'";
$aaa=mysqli_query($conn,$sql88);
$aad = mysqli_fetch_array($aaa);
$zsname=$aad['zsname'];
$sql888 = "SELECT * from tom where id = '1'";
$aaaa=mysqli_query($conn,$sql888);
$aadd = mysqli_fetch_array($aaaa);
$sz=$aadd['sz'];
$sql99="insert into report (reallyname,report,cs)values('$zsname','$zf','$sz')";
$var=mysqli_query($conn,$sql99);
  var_dump($sql99);


?>