<?php
include_once 'includes/global.func.php';
include_once 'conn.php';
session_start();
$dxtdaan = array('0' => $_POST['dxt1'],'1' => $_POST['dxt2']);
$dxt=$_SESSION['dxt'];
var_dump($_SESSION['dxt']);
if(isset($_POST['submit'])){
  unset($_SESSION['dxt']);
for ($i=0; $i <2; $i++) {
  $sql = "SELECT * FROM topic info where id='$dxt[$i]'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
  var_dump($dxt[$i]);
  var_dump($row['zq_da']);
  var_dump($dxtdaan[$i]);
  if($row['zq_da'] == $dxtdaan[$i]){
   echo "正确";
  }else {
   echo "不正确";
}
}
}
 ?>
