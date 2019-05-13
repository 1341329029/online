<?php
function _alert_back($info) {
	echo "<script type='text/javascript'>alert('".$info."');history.back();</script>";
	exit();
};
function _alert_to($info) {
	echo "<script type='text/javascript'>alert('".$info."');location.href='login.php'; </script>";
	exit();
};
function _alert_go($info) {
	echo "<script type='text/javascript'>alert('".$info."');location.href='index.php'; </script>";
	exit();
};
?>
