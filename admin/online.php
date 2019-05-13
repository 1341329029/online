<?php
include_once 'includes/global.func.php';
include_once 'conn.php';
$sql = "SELECT * FROM topic info where kt_lx='单选题'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$temp=array();
do{
  $temp[]=$row;
}while($row = mysqli_fetch_array($result));
$ww=count($temp)-1;

// $sj=rand(0,$ww);
// $sb=rand(0,$ww);
$sj='0';
$sb='1';
while(1){
  if($sb==$sj){
   @$sb=rand(0,$ww);
  }
  else {
    break;
  }
}
$hello = explode('*',$temp[$sj]['kq_da']);
$hi = explode('*',$temp[$sb]['kq_da']);
session_start();
$sdf = array($temp[$sj]['id'],$temp[$sb]['id'] );
$_SESSION['dxt']=$sdf;
echo "<pre>";
print_r($_SESSION['dxt']);
echo "</pre>";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>在线答题</title>
  </head>
  <body>
    <form action="check_online" method="post">
    <select name="ktlx">
      <option value="单选题">单选题</option>
      <option value="多选题">多选题</option>
      <option value="判断题">判断题</option>
      <option value="简答题">简答题</option>
  </select>
<p><?php echo $temp[$sj]['ks_nr']; ?></p>
<?php for($i=0;$i<count($hello);$i++){?>
<label>  <input  name="dxt1" type="radio" value="<?php echo $hello[$i];?>"/><?php echo $hello[$i];?></label><br>
<?php   } ?>
<p><?php echo $temp[$sb]['ks_nr']; ?></p>
<?php for($j=0;$j<count($hi);$j++){?>
<label><input  name="dxt2" type="radio" value="<?php echo $hi[$j];?>"/><?php echo $hi[$j];?></label><br>
<?php   } ?>
<center><input type="submit" name="submit" value="交卷"></center>
</form>
  </body>
</html>
