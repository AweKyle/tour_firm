<?php
include 'includes/dbconnect.php';
error_reporting(E_ALL  & ~E_NOTICE);
mysql_select_db($dbName);

function selectTour()
{
	
	$sCntr = mysql_query("SELECT `country_name`,`city_name`,`tour_name`, `tour_id` FROM
						`tour`.`countries`,`tour`.`cities`,`tour`.`tours` WHERE 
						`tours`.`country_id` = `countries`.`country_id` AND `tours`.`city_id` = `cities`.`city_id` ORDER BY `country_name`");
	while ($resSelC = mysql_fetch_assoc($sCntr))
	{
		$_POST['co_name'] = $resSelC['country_name'];
		$_POST['ci_name'] = $resSelC['city_name'];
		$_POST['t_name'] = $resSelC['tour_name'];
		$tId = $resSelC['tour_id'];
		print "<optgroup label = '" . $_POST['co_name'] . "'><option value = " . $tId . " ondblclick = 'this.form.submit()'>";
		print $_POST['ci_name'] . " :: ";
		print $_POST['t_name'] . "</option></optgroup>";
	}
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style.css"> 
	<title></title>
</head>
<style>
#sel
{
	width: 200px;
	border: none;
}
</style>
<body>
<form method = "POST" action = "reservation.php">
<select size = "20" id = "sel" name = "s_tour" title = "Дважды кликните по туру, чтобы перейти на страницу с информацией о нем">
	<?php
		selectTour();
	?>
</select>
</form>
</body>
</html>