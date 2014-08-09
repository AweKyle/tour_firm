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
?>
</div>
<br>
<p align="center"><b>Тур:</b>
<?php
include 'includes/dbconnect.php';

error_reporting(E_ALL  & ~E_NOTICE);
$tId = $_POST['s_tour'];
mysql_select_db($dbName);
function getTour()
{
	$tId = $_POST['s_tour'];
	//$getTour = mysql_query("SELECT `tour_name`, `cost`, `date_leave`, `date_return` FROM `tour`.`tours` WHERE `tour_id` = '$tId'");
	$getTour = mysql_query("SELECT `country_name`,`city_name`,`tour_name`, `hotel_name`, `cost`, `date_leave`, `date_return` FROM
						`tour`.`countries`,`tour`.`cities`,`tour`.`tours`, `tour`.`hotels` WHERE
						`tours`.`tour_id` = '$tId' AND `tours`.`country_id` = `countries`.`country_id`
						 AND `tours`.`city_id` = `cities`.`city_id` AND `tours`.`hotel_id` = `hotels`.`hotel_id`");
	while ($resGetT = mysql_fetch_assoc($getTour)) 
	{
		$tCntr = $resGetT['country_name'];
		$tCity = $resGetT['city_name'];
		$tName = $resGetT['tour_name'];
		$tHotel = $resGetT['hotel_name'];
		$tCost = $resGetT['cost'];
		$tDL = $resGetT['date_leave'];
		$tDR = $resGetT['date_return'];
		print "Страна: " . $tCntr . "; Город: " . $tCity . "; Тур: " . $tName . "; Стоимость: " . $tCost . "; Отель: " . $tHotel . "; Даты: " . $tDL . "//" . $tDR;
	}
}
if (isset($_POST['surname']))
{
	$cSur = $_POST['surname'];
	$cName = $_POST['name'];
	$cPat = $_POST['patronymic'];
	$cPass = $_POST['series'] . " " . $_POST['number'];
	$cCity = $_POST['city'];
	$cStr = $_POST['street'];
	$cHouse = $_POST['house'];
	$cDoor = $_POST['door'];
	$cPhne = $_POST['phone'];
	$tourId = $_POST['id'];
	$insClient = mysql_query("INSERT INTO `tour`.`clients` 
							(`client_surname`, `client_name`, `client_patronymic`, `client_passport`, `client_city`, `client_street`, `client_house`, `client_door`, `client_phone`, `tour_id`)
							VALUES ('$cSur', '$cName', '$cPat', '$cPass', '$cCity', '$cStr', '$cHouse', '$cDoor', '$cPhne', '$tourId')");
	if ($insClient == TRUE)
	{
		$selCId = mysql_query("SELECT `client_id` FROM `tour`.`clients` WHERE `client_passport` = '$cPass'");
		while ($resSelId = mysql_fetch_assoc($selCId))
		{
			$_POST['c_id'] = $resSelId['client_id'];
		}
		$cId = $_POST['c_id'];
		$insReservd = mysql_query("INSERT INTO `tour`.`reserved` (`client_id`, `tour_id`) VALUES ('$cId', '$tourId')");
	}
}

print "<br />";
getTour();
print "</p>";
if (isset($_SESSION['user']))
{
?>
<div id="page">
<div id="content">
	<p><b>Бронирование тура:</b></p>
	<form method = "POST" action = "">
		<?php
		print "<input type = \"hidden\" name = \"id\" value = " . $_POST['s_tour'] . " />";
		?>
		Фамилия:
		<input type = "text" name = "surname" />
		<br>
		<br>
		Имя:
		<input type = "text" name = "name" />
		<br>
		<br>
		Отчество:
		<input type = "text" name = "patronymic" />
		<br />
		<br />
		<b>Паспорт:</b>
		<br>
		<br>
		Серия:
		<input type = "text" name = "series" />
		Номер:
		<input type = "text" name = "number" />
		<br>
		<br>
		<b>Адрес:</b>
		<br>
		<br>
		Город:
		<input type = "text" name = "city" />
		<br>
		<br>
		Улица:
		<input type = "text" name = "street" />
		<br>
		<br>
		Дом:
		<input type = "text" name = "house" />
		Квартира:
		<input type = "text" name = "door" />
		<br>
		<br>
		Телефон:
		<input type = "text" name = "phone" />
		<br>
		<br>
		<br>
		<input type = "image" src="images/buttonres.png" onclick = "this.form.submit();" />
		<input type = "reset" value = "Очистить" />
	</form>
	<br><br><br><br>
</body>
</html>
<?php
}
?>