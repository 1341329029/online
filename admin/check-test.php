<?php
header("Content-Type: text/html; charset=utf-8");
include_once 'includes/global.func.php';
include_once 'conn.php';
$kslx=$_POST['kslx'];
$ktlx=$_POST['ktlx'];
$fs=$_POST['fs'];
$kqnr=$_POST['kqnr'];
$kqda=$_POST['kqda'];
$zqda=$_POST['zqda'];
$kt_jx=$_POST['kt_jx'];
$str= mb_ereg_replace('^(　| )+', '', $zqda);
$zqda = mb_ereg_replace('(　| )+$', '', $str);
$arr= mb_ereg_replace('^(　| )+', '', $kqda);
$kqda = mb_ereg_replace('(　| )+$', '', $arr);
if(isset($_POST['submit'])){
    $sql =  "insert into topic (ks_lx,kt_lx,fs,ks_nr,kq_da,zq_da,kt_jx) values('$kslx','$ktlx','$fs','$kqnr','$kqda','$zqda','$kt_jx')";
    if (!mysqli_query($conn,$sql)) {
       die ('Error: ' .mysqli_error());
       }
       _alert_back('提交试题成功');
   mysqli_close($conn);
}
?>
