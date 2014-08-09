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
		<li class="active"><a href="find.php"><b>Поиск тура</b></a></li>
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
				<h2 class="section"><b>Страны</b></h2>
				<div class="content">
				<?php
				include 'tour_list.php';
				?>
				</div>
		</div>
		<div class="box-orange col-two">
				<h2 class="section"><b>Поиск тура</b></h2>
				<div class="content">
		<b>Поиск тура:</b>
		<br />
		<br>
		<form method = "POST" action = "">
		Выберите направление:<br><br>	
		<?php
		selectCity();
		print "<br />";
		print "Дата вылета <br><br> С ";
		monthLeave();
		print " <br><br>по";
		monthReturn();
		?>
		<br>
		<br>
		<p>Стоимость:</p>
		<p>От:
		<input type = "text" name = "min_cost" /><br><br>
		До:
		<input type = "text" name = "max_cost" /></p>
		<input type = "image" src="images/search.png"/>
		</form>
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
		}
		?>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="page">
<b>Результаты поиска:</b>
<br><br>
<form method = "POST" action = "reservation.php" id = "my_form">
	<?php
	printRes();
	?>
</form>
<br><br><br><br>
</div>
</div>
</body>
</html>
<?php
include 'includes/dbConnect.php';

function selectCity()
{
	$citySel = mysql_query("SELECT * FROM `tour`.`cities`, `tour`.`countries`, `tour`.`hotels` 
							WHERE `cities`.`city_id` = `hotels`.`city_id` AND `cities`.`country_id` = `countries`.`country_id`");
	print "<select name = \"city_sel\" >
			<option selected value = \"all\">Не выбрано</option>";
	while($resCitySel = mysql_fetch_assoc($citySel))
	{
		$cS0 = $resCitySel['country_name'];
		$cS1 = $resCitySel['city_name'];
		$cS2 = $resCitySel['city_id'];
        $cS3 = $resCitySel['country_id'];
		print "<optgroup label = '" . $cS0 . "'><option value = " . $cS2 . "::" . $cS3 . ">" . $cS1 . "</option></optgroup>";
	}
	print "</select><br />";
}

function monthLeave()
{
	$arDay = array(range(0, 31));
    print "<select name = \"LeaveDD\"><option>День</option>";
    for ($i = 0; $i ++< 31;)
    {
        print "<option value = \"$i\" >$i</option>";
    }
    print "</select> - ";
	print "<select name = \"LeaveMM\"><option>Месяц</option>";
    $arrMM = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
					   7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
	foreach ($arrMM as $key => $value)
	{
		print "<option value = \"$key\" >$value</option>";
	}
    print "</select>";
}

function monthReturn()
{
	$arDay = array(range(0, 31));
    print "<select name = \"ReturnDD\"><option>День</option>";
    for ($i = 0; $i ++< 31;)
    {
        print "<option value = \"$i\" >$i</option>";
    }
    print "</select> - ";
	print "<select name = \"ReturnMM\"><option>Месяц</option>";
    $arrMM = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
					   7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
	foreach ($arrMM as $key => $value)
	{
		print "<option value = \"$key\" >$value</option>";
	}
    print "</select>";
}

function printRes()
{
	$cSel = $_POST['city_sel'];
	$sID = explode("::", $cSel);
	$currDate = date('m-d');
	$dLeave = "2013-" . $_POST['LeaveMM'] . "-" . $_POST['LeaveDD'];
	$dRet = "2013-" . $_POST['ReturnMM'] . "-" . $_POST['ReturnDD'];
	$mnCost = $_POST['min_cost'];
	$mxCost = $_POST['max_cost'];
	$cPeople = $_POST['people'];
	$fly = $_POST['fly'];

	if ($dLeave == "2013-Месяц-День" AND $dRet == "2013-Месяц-День")
	{
		$dLeave = "2013-" . $currDate;
		$dRet = "2020-12-31";		
	}
	if ($dRet == "Месяц-День-2013")
	{
		$dRet = $_POST['LeaveMM'] + 1;
		$dRet .= "2013-" . $dRet . "-" . $_POST['LeaveDD'];
		print $dRet;
	}
	if ($mnCost == "")
	{
		$mnCost = "0";
	}
	if ($mxCost == "")
	{
		$mxCost = "1000000";
	}
	if ($_POST['city_sel'] != "all")
	{
		mysql_select_db($dbName);
		$s_country = mysql_query("SELECT `tour_id`, `tour_name`, `cost`, `date_leave`, `date_return`, `hotel_name`, `rate`, `city_name` FROM `tour`.`tours`, `tour`.`hotels`, `tour`.`cities` 
								WHERE `tours`.`city_id` = '$sID[0]' 
								AND `hotels`.`city_id` = '$sID[0]'
								AND `cities`.`city_id` = '$sID[0]' 
								AND `tours`.`cost` >= '$mnCost' 
								AND `tours`.`cost` <= '$mxCost' 
								AND `tours`.`date_leave` >= '$dLeave' 
								AND `tours`.`date_leave` <= '$dRet'");
		if ($s_country == TRUE)
		{
			//print $sID[0] . "<br />" . $mnCost . " ::: " . $mxCost . "::" . $dLeave . ":::" . $dRet . "<br />";
			print "<select style = \"width: 100%\" size = \"10\" name = \"s_tour\" title = \"Дважды кликните по туру, чтобы перейти на страницу бронирования\">";
			while ($resSelect = mysql_fetch_assoc($s_country)) 
			{
				$tId = $resSelect['tour_id'];
				$tNm = $resSelect['tour_name'];
				$cst = $resSelect['cost'];
				$dL = $resSelect['date_leave'];
				$dR = $resSelect['date_return'];
				$hNm = $resSelect['hotel_name'];
				$rt = $resSelect['rate'];
				$cNm = $resSelect['city_name'];
				print "<optgroup label = " . $cNm . "><option value = " . $tId . " ondblclick = 'this.form.submit()'>";
				print $tNm . " " . $cst . " " . $dL . "//" . $dR . " Отель:";
				print $hNm . " " . $rt . "* </option>";
			}
			print "</select>";
		}
		else
		{
			print mysql_error();
		}
	}
	else
	{
		$s_country = mysql_query("SELECT `tour_id`, `tour_name`, `cost`, `date_leave`, `date_return`, `hotel_name`, `rate`, `city_name` FROM `tour`.`tours`, `tour`.`hotels`, `tour`.`cities` 
								WHERE `tours`.`city_id` = `cities`.`city_id` 
								AND `hotels`.`city_id` = `cities`.`city_id`
								AND `tours`.`cost` >= '$mnCost' 
								AND `tours`.`cost` <='$mxCost' 
								AND `tours`.`date_leave` >= '$dLeave' 
								AND `tours`.`date_leave` <= '$dRet'");
		if ($s_country == TRUE)
		{
			//print $sID[0] . "<br />" . $mnCost . " ::: " . $mxCost . "::" . $dLeave . ":::" . $dRet . "<br />";
			print "<select style = \"width: 100%\" size = \"10\" name = \"s_tour\" title = \"Дважды кликните по туру, чтобы перейти на страницу бронирования\">";
			while ($resSelect = mysql_fetch_assoc($s_country)) 
			{
				$tId = $resSelect['tour_id'];
				$tNm = $resSelect['tour_name'];
				$cst = $resSelect['cost'];
				$dL = $resSelect['date_leave'];
				$dR = $resSelect['date_return'];
				$hNm = $resSelect['hotel_name'];
				$rt = $resSelect['rate'];
				$cNm = $resSelect['city_name'];
				print "<optgroup label = " . $cNm . "><option value = " . $tId . " ondblclick = 'this.form.submit()'>";
				print $tNm . " " . $cst . " " . $dL . "//" . $dR . " Отель:";
				print $hNm . " " . $rt . "* </option>";
			}
			print "</select>";
		}
		else
		{
			print mysql_error();
		}
	}
}

?>
