<?php
    session_start();
    header("Content-Type:text/html;charset=utf-8");
    error_reporting(E_ALL || ~E_NOTICE);
    $conn = mysqli_connect("localhost","root","123456") or die("链接失败");
    mysqli_select_db($conn,"online_test");
    mysqli_query($conn,"set names utf8");

    if($_GET['action'] == 'modify'){

                $sql = "SELECT * from users where username = '{$_SESSION['username']}'";
                $result = mysqli_query($conn,$sql) or die("失败");
                $num = mysqli_num_rows($result);
    
        
        if($num){
             $_clean = array();
             $_clean['truename'] = trim($_POST["truename"]);
             $_clean['birth'] = $_POST["year"];
             $_clean['birth1'] =$_POST["month"];
             $_clean['birth2'] = $_POST["day"];
             $_clean['face'] = $_POST['face'];
             $_clean['sex'] = $_POST["sex"];
             $_clean['school'] = $_POST['school'];
             $_clean['email'] = $_POST["email"];
             $_clean['qianming'] = $_POST['qianming'];
         
        $sql = "UPDATE `users` SET zsname='{$_clean['truename']}',sex='{$_clean['sex']}',face='{$_clean['face']}',year='{$_clean['birth']}',month='{$_clean['birth1']}',day='{$_clean['birth2']}',school='{$_clean['school']}',email='{$_clean['email']}',qianming='{$_clean['qianming']}' WHERE username='{$_SESSION['username']}'";
        //var_dump($sql);
            $result = mysqli_query($conn, $sql) or die("失败"); 
        
        if(mysqli_affected_rows($conn)){
            echo "<script>alert('修改成功');history.go(-2);</script>";
        }else{
            echo "<script>alert('修改失败');history.go(-2);</script>";
            exit();
        }

    }
}
       
       if(isset($_SESSION['username'])){
        
        $sql = "SELECT * from users where username = '{$_SESSION['username']}'";
        // echo $sql;
        $result = mysqli_query($conn,$sql) or die("失败");
        
        if($html = mysqli_fetch_array($result)){
            //性别选择
            if($html['sex']=='男'){
                $html['sex_html'] = '<input class="sex" type="radio" name="sex" value="男" checked="checked"> <span class="xing">男</span> <input type="radio" name="sex" value="女" class="sex"> <span class="xing">女</span> ';

            }else if($html['sex']=='女'){
                $html['sex_html'] = '<input class="sex" type="radio" name="sex" value="男"> <span class="xing">男</span> <input type="radio" name="sex" value="女" class="sex" checked="checked"> <span class="xing">女</span> ';
        }else{
            echo "<script>alert('用户不存在33');history.go(-1);</script>";
        }
    }
        
        
    }else{
        echo "<script>alert('用户不存在11');history.go(-1);</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>JWroom考试系统</title>
	<link rel="stylesheet" type="text/css" href="css/change.css">
    <script type="text/javascript" src="js/face.js"></script>
</head>
<script type="text/javascript">
	function DateSelector(selYear, selMonth, selDay) {
    this.selYear = selYear;
    this.selMonth = selMonth;
    this.selDay = selDay;
    this.selYear.Group = this;
    this.selMonth.Group = this;
    // 给年份、月份下拉菜单添加处理onchange事件的函数
    if (window.document.all != null) // IE
    {
        this.selYear.attachEvent("onchange", DateSelector.Onchange);
        this.selMonth.attachEvent("onchange", DateSelector.Onchange);
    }
    else // Firefox
    {
        this.selYear.addEventListener("change", DateSelector.Onchange, false);
        this.selMonth.addEventListener("change", DateSelector.Onchange, false);
    }

    if (arguments.length == 4) // 如果传入参数个数为4，最后一个参数必须为Date对象
        this.InitSelector(arguments[3].getFullYear(), arguments[3].getMonth() + 1, arguments[3].getDate());
    else if (arguments.length == 6) // 如果传入参数个数为6，最后三个参数必须为初始的年月日数值
        this.InitSelector(arguments[3], arguments[4], arguments[5]);
    else // 默认使用当前日期
    {
        var dt = new Date();
        this.InitSelector(dt.getFullYear(), dt.getMonth() + 1, dt.getDate());
    }
}

// 增加一个最大年份的属性
DateSelector.prototype.MinYear = 1960;

// 增加一个最大年份的属性
DateSelector.prototype.MaxYear = (new Date()).getFullYear();

// 初始化年份
DateSelector.prototype.InitYearSelect = function () {
    // 循环添加OPION元素到年份select对象中
    for (var i = this.MaxYear; i >= this.MinYear; i--) {
        // 新建一个OPTION对象
        var op = window.document.createElement("OPTION");

        // 设置OPTION对象的值
        op.value = i;

        // 设置OPTION对象的内容
        op.innerHTML = i;

        // 添加到年份select对象
        this.selYear.appendChild(op);
    }
}

// 初始化月份
DateSelector.prototype.InitMonthSelect = function () {
    // 循环添加OPION元素到月份select对象中
    for (var i = 1; i < 13; i++) {
        // 新建一个OPTION对象
        var op = window.document.createElement("OPTION");

        // 设置OPTION对象的值
        op.value = i;

        // 设置OPTION对象的内容
        op.innerHTML = i;

        // 添加到月份select对象
        this.selMonth.appendChild(op);
    }
}

// 根据年份与月份获取当月的天数
DateSelector.DaysInMonth = function (year, month) {
    var date = new Date(year, month, 0);
    return date.getDate();
}

// 初始化天数
DateSelector.prototype.InitDaySelect = function () {
    // 使用parseInt函数获取当前的年份和月份
    var year = parseInt(this.selYear.value);
    var month = parseInt(this.selMonth.value);

    // 获取当月的天数
    var daysInMonth = DateSelector.DaysInMonth(year, month);

    // 清空原有的选项
    this.selDay.options.length = 0;
    // 循环添加OPION元素到天数select对象中
    for (var i = 1; i <= daysInMonth; i++) {
        // 新建一个OPTION对象
        var op = window.document.createElement("OPTION");

        // 设置OPTION对象的值
        op.value = i;

        // 设置OPTION对象的内容
        op.innerHTML = i;

        // 添加到天数select对象
        this.selDay.appendChild(op);
    }
}

// 处理年份和月份onchange事件的方法，它获取事件来源对象（即selYear或selMonth）
// 并调用它的Group对象（即DateSelector实例，请见构造函数）提供的InitDaySelect方法重新初始化天数
// 参数e为event对象
DateSelector.Onchange = function (e) {
    var selector = window.document.all != null ? e.srcElement : e.target;
    selector.Group.InitDaySelect();
}

// 根据参数初始化下拉菜单选项
DateSelector.prototype.InitSelector = function (year, month, day) {
    // 由于外部是可以调用这个方法，因此我们在这里也要将selYear和selMonth的选项清空掉
    // 另外因为InitDaySelect方法已经有清空天数下拉菜单，因此这里就不用重复工作了
    this.selYear.options.length = 0;
    this.selMonth.options.length = 0;

    // 初始化年、月
    this.InitYearSelect();
    this.InitMonthSelect();

    // 设置年、月初始值
    this.selYear.selectedIndex = this.MaxYear - year;
    this.selMonth.selectedIndex = month - 1;

    // 初始化天数
    this.InitDaySelect();

    // 设置天数初始值
    this.selDay.selectedIndex = day - 1;
}
</script>
<body>
	<form method="post" action="?action=modify">
		<div id="mainbody">
		<div class="mainbox">
			<div class="top">
				<div class="image"></div>
				<div class="total"><p style="color:#0ef2fa; ">修改资料</p></div>
			</div>

           
			<input type="text" name="user" placeholder="用户名" class="change_one" value="<?php echo $html['username']?>">

			<input type="text" width="100px" name="truename" placeholder="姓名" class="change_one" value="<?php echo $html['zsname']?>">
			<div class="sex">
				<div class="font_sex"><?php echo $html['sex_html']?></div>

				<!-- <input type="radio" name="one" checked="checked" id="men"><span style="position: relative;top:-25px;left:-25px;color:rgb(138,118,118);">男</span>
 				<input type="radio" name="one" id="women"><span style="position: relative;top:-25px;left:-45px;color:rgb(138,118,118);">女</span> -->
			</div>
           
			<div class="portrait">

				<span style="display: block;float:left;margin-top:10%;color:rgb(138,118,118);margin-left:10px">头像：　　</span>
				<input type="hidden"  name="face" id="imgip" value="face/2.jpg">
                    <img style="cursor:pointer;" src="face/2.jpg"  id="faceimg" action="face.php" name="face" class="face">
                  <!--   <input type="hidden" name="face" id="imgip" value="../dlzc/register/face/2.jpg">
                <img style="cursor:pointer;"  src="../dlzc/register/face/2.jpg"  id="faceimg"  class="face" name="face" action="face.php">  -->
 
			</div>
            
			<div class="timer">
				<div class="birth"><p>出生日期：</p></div>
				<div class="select_time">
					<!-- <select onchange="setDays()">
					</select>
					<span>年</span>
					<select onchange="setDays()">
					</select>
					<span>月</span>
					<select>
					</select>
					<span>日</span>
 -->
            	<select name="year" id="selYear" style="width:60px"></select>
				<select name="month" id="selMonth" style="width:40px"></select>
				<select name="day" id="selDay" style="width:45px"></select>
				<script 	type="text/javascript">
   					var selYear = window.document.getElementById("selYear");
  					var selMonth = window.document.getElementById("selMonth");
   					var selDay = window.document.getElementById("selDay");

					    // 新建一个DateSelector类的实例，将三个select对象传进去
					    new DateSelector(selYear, selMonth, selDay, 1999, 1, 11);
					    // 也可以试试下边的代码
					    // var dt = new Date(2004, 1, 29);
					    // new DateSelector(selYear, selMonth ,selDay, dt);
				</script>
				</div>
			</div>
            <input type="text" name="school" placeholder="学校" class="change_one" value="<?php echo $html['school']?>">
			<input type="text" name="email" placeholder="电子邮箱" class="change_one" value="<?php echo $html['email']?>">
            <input type="text" name="qianming" placeholder="个性签名" class="change_one" value="<?php echo $html['qianming']?>">
			<input type="submit" name="submit" value="立即修改" class="change_one" id="instantly">
		</div>
	</div>
	</form>
</body>
</html>