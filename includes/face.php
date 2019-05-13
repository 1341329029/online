<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="../js/opener.js"></script>
	<title>头像选择</title>
</head>
<body>
	<div class="face">
		<h3>选择头像</h3>
		<dl>
			<?php
				for($i=1;$i<16;$i++){
					?>
			<dd><img src="../face/<?php echo $i ?>.jpg" alt="face/<?php echo $i ?>.jpg" title="头像<?php echo $i?>" style="cursor: pointer;"></dd>
			<?php
			}
			?>
		</dl>
	</div>
</body>
</html>