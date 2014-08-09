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
		<li><a href="about.php"><b>О нас</b></a></li>
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
			<div class="box-orange col-two">
				<h2 class="section"><b>Создать новый тур</b></h2>
				<div class="content">				
				<form method = "POST" action = "base.php" id = "addTour">
				<p><b>Тур:</b></p>
				Название тура:
				<p><input type = "text" name = "tour" /></p>
				Отель:
				<p><?php
					selectHotel();
				?></p>
				Цена(в рублях):
				<p><input type = "text" name = "cost" /></p>
				Дата вылета:
				<p><?php
					dateLeave();
				?></p>
				Количество ночей:
				<p><input type = "text" name = "nights" /></p>
				Количество людей:
				<p><select name = "room">
				<option value = "1">1</option>
				<option value = "2">2</option>
				<option value = "3">3</option>
				</select></p>
				Перелет:
				<input type = "checkbox" /><br><br>
				<input type = "image" src="images/buttonadd.png" value = "ok" />
				<input type = "reset" value = "Очистить" />
			</form>
			<br>
			<a href = "country.php">Добавить страну и город</a>
			<br />
			<a href = "hotel.php">Добавить отель</a>

</body>
</html>