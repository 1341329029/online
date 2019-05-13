<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>注册</title>
	<link href="css/register.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/face.js"></script>
	<script type="text/javascript">
		function checkinput(){

				if(myform.id.value==""){
					alert("学号不能为空");
					// myform(表单名).username(表单里的东西).focus()（接受焦点） 
					myform.name.focus();
					return false;
                    exit();
				}
				if(myform.pwd.value==""){
					alert("密码不能为空");
					myform.pwd.focus();
					return false;
                    exit();
				}
				if(myform.confirm.value==""){
					alert("两次密码不同");
					myform.pwd.focus();
					return false;
                    exit();
				}
				if(myform.truename.value==""){
					alert("真实姓名不能为空");
					myform.truename.focus();
					return false;
                    exit();
				}
				if(myform.sex.value==""){
					alert("性别不能为空");
					myform.sex.focus();
					return false;
				}
				if(myform.email.value==""){
					alert("邮箱不能为空");
					myform.email.focus();
					return false;
                    exit();
				}
				if(myform.code.value==""){
					alert("验证码不能为空");
					myform.code.focus();
					return false;
                    exit();
				}
			}

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
DateSelector.prototype.MinYear = 1900;

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


</head>
<body>
	<form   name="myform"  method="post" action="includes/regcheck.php"  onsubmit="return checkinput()">
	<div id="mainbody">
		<div class="mainbox">
			<div class="top">
				<div class="image"></div>
				<div class="total"><p style="color :#0efaf2">考试注册</p></div>
			</div>
			<input type="text" placeholder="学号" name="name">
			<input type="password" placeholder="请输入密码" name="pwd">
			<input type="password" placeholder="请确认密码" name="confirm">
			<input type="text" placeholder="真实姓名" name="truename">
			<input type="radio" name="sex" id="sex" value="男">男
            <input type="radio" name="sex" id="sex" value="女">女
            <div class="head">
                <span  id="register" class="face">头像</span>
                <dd class="face" id="register">
                    
                <input type="hidden" name="face" id="imgip" value="face/1.jpg">
                <img style="cursor:pointer;"  src="face/1.jpg"  id="faceimg"  class="face" name="face"> 
                </dd>
            </div>
            <div class="time">
            <span>出生日期</span>
            	<select name="year" id="selYear" ></select>
				<select name="month" id="selMonth" ></select>
				<select name="day" id="selDay" ></select>
				<script type="text/javascript">
   					var selYear = window.document.getElementById("selYear");
  					var selMonth = window.document.getElementById("selMonth");
   					var selDay = window.document.getElementById("selDay");

					    // 新建一个DateSelector类的实例，将三个select对象传进去
					    new DateSelector(selYear, selMonth, selDay, 2004, 2, 29);
					    // 也可以试试下边的代码
					    // var dt = new Date(2004, 1, 29);
					    // new DateSelector(selYear, selMonth ,selDay, dt);
				</script>

            </div>
            <input type="text" placeholder="学校" name="school">
            <input type="text" placeholder="电子邮件" name="email">
            <input type="text" placeholder="验证码" name="code" id="validate">
			<!-- <img  style="cursor: pointer;" class="image2" name="code" src="includes/code.php" onclick="this.src='includes/code.php?'+Math.random()" > -->
            <img  style="cursor: pointer;" class="image2" name="code" src="includes/code.php" onclick="this.src='includes/code.php?'+Math.random()"></img>
			<!-- <input type="button" value="立即注册" id="begin" > -->
			<input type="submit" name="submit" class="begin" value="立即注册">
			<span><input type="hidden" name="hidden" value="hidden"></span>
        </div>
	</div>
	</form>
</body>
</html>