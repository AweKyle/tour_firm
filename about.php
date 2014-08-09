<?php
include 'includes/session.php';
?>
<html>
<META content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>
    MY_TOUR
</title>
<link href="default.css" rel="stylesheet" type="text/css" />
<body>
<div id="header">
	<img src="images/imgico.png" class="left"/>
	<div id="logo">
		<h1><a href="index.php">TourFirm</a></h1>
	</div>
</div>
<div id="menu">
	<ul>
		<li><a href="index.php"><b>Главная страница</b></a></li>
		<li><a href="find.php"><b>Поиск тура</b></a></li>
		<li><a href="agency.php"><b>Агенствам</b></a></li>
		<li class="active"><a href="about.php"><b>О нас</b></a></li>
	</ul>
</div>
<div align="right">
<?php
if (isset($_SESSION['user']))
{
s_user();
}
?>
</div>
<div id="page">
	<div id="content">
		<div id="feature" class="two-cols">
			<div class="box-blue col-one" width="200px">
				<h2 class="section"><b>Страны/Туры</b></h2>
				<div class="content_a">
				<?php
				include 'tour_list.php';
				?>
				</div>
			</div>
			<div class="box-orange col-two">
		</div>
			<div class="box-orange col-two">
				<h2 class="section"><b>About us</b></h2>
				<div class="content">
					<p><b>Выполнено:</b></p>
					<p>ФКН 3 курс, группа 1.1:</p>
					<p>Воронин Николай,<br>
					Сафронова Юлия</p>
					<p><b>Преподаватель:</b></p>
					Михайлов Е.М.
				</div>
			</div>
		</div>	
</div>
<?php
if (!isset($_SESSION['user'])) 
{
?>
<div class="col-two">
			<div class="box-blue">
				<h2 class="section"><b>Вход/Регистрация</b></h2>
				<div class="content_b"> 
					<form method = "POST" action = "auth.php" id="authoriz"> 
					<p><input type = "text" name = "authLog" value = "login" /> </p>
					<p><input type = "password" name = "authPass" value = "Password" /> </p>
					<p><input type = "image" src="images/button.png" id="authoriz" /></p>
					<p><a href="reg.html"><tt>Зарегистрироваться</tt></a></p>
					</form>
				</div>
			</div>
		</div>
<?php
}?>
		<div style="clear: both;">&nbsp;</div>
	</div>
</div>
</body>


<body>
	
</body>
</html>