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
		<li><a href="about.html"><b>О нас</b></a></li>
	</ul>
</div>
<div align="right">
<?php
if (isset($_SESSION['user']))
{
	s_user();
}			
require 'base.php';
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

			</script>
			<script type="text/javascript">
				function doClear(theText) { if (theText.value == theText.defaultValue) { theText.value = "" } }
				function doDefault(theText) { if (theText.value == "") { theText.value = theText.defaultValue } }
			</script>
			<div class="box-orange col-two">
				<h2 class="section"><b>Добавить новый отель</b></h2>
				<div class="content">
				<form method = "POST" action = "base.php">
				<b>Отель:</b>
				<br>
				<br>
				Город:
				<p><?php
					selectCity(); 
				?></p>
				Название отеля:
				<p><input type = "text" name = 'htl_nm' /></p>
				Категория Отеля:
				<p><select name = "category">
					<option value = "1">1*</option>
					<option value = "2">2*</option>
					<option value = "3">3*</option>
					<option value = "4">4*</option>
					<option value = "5">5*</option>
				</select></p>
				Стоимость:
				<input type = "text" value = "Одноместный номер" name = "one" onfocus = "doClear(this)" onblur = "doDefault(this)" />
				<input type = "text" value = "Двухместный номер" name = "two" onfocus = "doClear(this)" onblur = "doDefault(this)" />
				<input type = "text" value = "Трехместный номер" name = "three" onfocus = "doClear(this)" onblur = "doDefault(this)" />
				<p><input type = "text" value = "Номер люкс" name = "four" onfocus = "doClear(this)" onblur = "doDefault(this)" /></p>
				<input type = "image" src="images/buttonadd.png" value = "ok" />
				<input type = "reset" value = "Очистить" />
			</form>
			<br>
			<a href = "country.php">Добавить страну и город</a>
			<br />
			<a href = "tour.php">Создать новый тур</a>
			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>