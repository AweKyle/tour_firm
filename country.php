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

			<div class="box-orange col-two">
				<h2 class="section"><b>Добавить новую страну/город</b></h2>
				<div class="content">
					<p><b>Страна:</b></p>
					<form method = "POST" action = "base.php" id = "country/city">
						<p><input type = "text" name = "countries" /></p>
						<p><b>Город:</b></p>
						<p>
						<?php
							selectCountry();
						?></p>
						<p><input type = "text" name = "cities" /></p>
						<input type = "image" src="images/buttonadd.png" value = "ok" />
					</form>
					<br />	
					<a href = "hotel.php">Добавить отель</a>
					<br />
					<a href = "tour.php">Создать новый тур</a>
				</div>
			</div>

</body>
</html>