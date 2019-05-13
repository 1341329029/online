<?php
session_start();
include_once 'global.func.php';
include_once '../conn/conn.php';
					$query100 = mysqli_query($conn,"select * from tom");
								$array100 = mysqli_fetch_array($query100);
								// echo $array100[sz];
					echo $_SESSION['username'];
					if (isset($_POST['submit'])) {
						for($i=1;$i<15;$i++){
							if ($_POST[$i]) {
							   $iid=$_POST[$i];
							$query1000 = mysqli_query($conn,"insert into shoucang(kt_user,kt_id,kt_cs,save) values('{$_SESSION['username']}','$iid','$array100[sz]','1')");
							
				 			// var_dump($array100[sz]);
							}
						
				
				 		

						}
				 		
				 		_alert_wo(收藏成功);
				 	}
				?>