<?php
include_once 'global.func.php';
include_once '../conn/conn.php';
session_start();
$_POST['dxt6'] = implode("",$_POST['dxt6'] );
$_POST['dxt7'] = implode("",$_POST['dxt7'] );
$_POST['dxt8'] = implode("",$_POST['dxt8'] );
$dxtdaan = array(
 $_POST['dxt1'],
 $_POST['dxt2'],
 $_POST['dxt3'],
 $_POST['dxt4'],
 $_POST['dxt5'],
 $_POST['dxt6'],
 $_POST['dxt7'],
 $_POST['dxt8'],
 $_POST['dxt9'],
 $_POST['dxt10'],
 $_POST['dxt11'],
 $_POST['dxt12'],
 $_POST['dxt13']
);

$dxt=$_SESSION['dxt'];
//var_dump($_SESSION['dxt']);

if(isset($_POST['submit'])){

  $yii="SELECT * FROM tom info where id='1'";
  $result100 = mysqli_query($conn,$yii);
  $row100 = mysqli_fetch_array($result100);
  // var_dump($row100[1]);
  $wc=$row100[1]+1;
  // var_dump($wc);
   $yii2= "UPDATE `tom` SET sz='{$wc}'WHERE id = '1'";
    mysqli_query($conn,$yii2);


$name=$_SESSION['username'];
  //unset($_SESSION['dxt']);
for ($i=0; $i <13; $i++) {
  $sql = "SELECT * FROM topic info where id='$dxt[$i]'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
  // var_dump($dxt[$i]);
  // var_dump($row['zq_da']);
  // var_dump($dxtdaan[$i]);
$str= mb_ereg_replace('^(　| )+', '', $row['zq_da']);
$str = mb_ereg_replace('(　| )+$', '', $str);
$arr= mb_ereg_replace('^(　| )+', '', $dxtdaan[$i]);
$dxtdaan[$i] = mb_ereg_replace('(　| )+$', '', $arr);
  if($str == $dxtdaan[$i]){
   $sql="insert into transfer (kt_user,kt_id,kt_pd,ks_da,kt_cs)values('{$name}','$dxt[$i]','yes','$dxtdaan[$i]',$wc)";
   if (!mysqli_query($conn,$sql)) {
      die ('Error: ' .mysqli_error());
    }

  }else {
    $sql="insert into transfer (kt_user,kt_id,kt_pd,ks_da,kt_cs)values('{$name}','$dxt[$i]','no','$dxtdaan[$i]',$wc)";
   if (!mysqli_query($conn,$sql)) {
      die ('Error: ' .mysqli_error());
    }
}
}
$sql_8 = "SELECT * FROM topic info where id='$dxt[13]'";
$result_8 = mysqli_query($conn,$sql_8);
$row_8 = mysqli_fetch_array($result_8);
 $she=explode('*',$row_8['zq_da']);
// var_dump($she);
// var_dump($row_8);
// var_dump($dxt[13]);
// var_dump($row_8['zq_da']);
for ($t=0; $t<count($she) ; $t++) {
$sr= mb_ereg_replace('^(　| )+', '', $_POST['dxt14']);
$_POST['dxt14'] = mb_ereg_replace('(　| )+$', '', $sr);
$ar= mb_ereg_replace('^(　| )+', '', $she[$t]);
$she[$t]= mb_ereg_replace('(　| )+$', '', $ar);
  if(strstr($_POST['dxt14'],"$she[$t]"))
  {
      $u=20/count($she);
      // var_dump($u);
      $b=$b+$u;
  }
}
$eee=$_POST['dxt14'];
//var_dump($b);
//var_dump($eee);
//var_dump($dxt[13]);

$sql="insert into transfer (kt_user,kt_id,kt_pd,ks_da,kt_cs)values('{$name}','$dxt[13]','$b','$eee',$wc)";
if (!mysqli_query($conn,$sql)) {
  die ('Error: ' .mysqli_error());
}
_alert_go("提交成功");
}
 ?>
