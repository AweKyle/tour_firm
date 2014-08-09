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
		<li class="active"><a href="index.php"><b>Главная страница</b></a></li>
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
				<h2 class="section"><b>Пляжи</b></h2>
				<div class="content">
					<img src="images/imgbeach.jpg" alt="" width="210" height="160" class="right" />
					<p><b>Болгария</b> — мягкий черноморский климат, развитая туристическая инфраструктура, 
					отличные возможности для семейного отдыха.</p>
					<p><b>Египет</b> - интересная и познавательная экскурсионная программа, 
					комфортный и приятный пляжный отдых.</p>
					<p><b>Мальдивы</b> - элитный пляжный отдых на своих многочисленных атоллах, 
					дайвинг и прочие водные виды спорта.</p>
				</div>
			</div>
			<div class="box-orange col-two">
				<h2 class="section"><b>Горнолыжные курорты</b></h2>
				<div class="content">
					<img src="images/imgsn.jpg" alt="" width="210" height="160" class="right" />
					<p><b>Швеция</b> — Трассы любого уровня сложности, специальные программы для детей, 
					скандинавские сказки и нетронутая природа провинции Даларна.</p>
					<p><b>Финляндия</b> -  чистая природа, огромные снежные пространства. 
					Самый большой горнолыжный курорт Финляндии Levi работает круглый год.</p>
					<p><b>Швейцария</b> - Круглогодичный курорт Церматт предлагает для катания пять 
					трасс, на леднике работают практически все подъемники, а также Gravity-Park.</p>
				</div>
			</div>
		</div>
</div>
	
	<div id="sidebar" class="two-cols">
		<div class="box-orange col-one">
			<h2 class="section"><b>Экскурсионные туры</b></h2>
			<div class="content"> 
				<img src="images/imgex.jpg" alt="" width="210" height="160" class="right" />
					<p>Это экскурсии в историю Старого и Нового Света, постижение тайн российских земель,
					познание особенностей культуры многих стран. Можно увидеть балкон в Вероне, 
					на котором стояла Джульетта, Париж, где героев Дюма поджидали приключения, 
					знаменитую Бейкер-стрит в Лондоне, где Шерлок Холмс с доктором Ватсоном раскрывали 
					самые запутанные преступления.</p>
			</div>
		
		<div class="box-orange col-one">
			<h2 class="section"><b>Свадебные туры</b></h2>
			<div class="content"> 
				<img src="images/imgwed.jpg" alt="" width="210" height="160" class="right" />
					<p>Это организация свадебных церемоний в различных уголках мира. Белоснежные 
					экзотические пляжи или города-мегаполисы, горы или реки с озерами - Вам выбирать, 
					в какой атмосфере должно пройти ваше путешествие или свадьба. </p>
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
		}
		?>
		<div style="clear: both;">&nbsp;</div>
	</div>
</div>
</body>
</html>