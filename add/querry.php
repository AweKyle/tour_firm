<?php
include 'dbConnect.php';
/*function getCountry()
{
mysql_select_db($dbName);
mysql_query("set names utf8");
	$country = mysql_query("SELECT `country` FROM `tour`.`countries`");
	print "<select>";
	if ($country == TRUE)
	{
	while ($resCountry = mysql_fetch_assoc($country))
	{
		$qqq = $resCountry['country'];
		print "<option>" . $qqq . "</option>";
	}
	}
	else {die(mysql_error());}
	print "</select>";
}
getCountry();*/

/*   
определяем последнюю добавленую страну: "Select `country_id` from `tour`.`countries` desc limit 1"
Точно так же для городов.
После этого добавляем в последний город id последней страны и наоборот
*/
if (isset($_POST['cityes']))
{
$strana = $_POST['countryes'];
$gorod = $_POST['cityes'];
mysql_select_db($dbName);
$dobavlenie1 = mysql_query("INSERT INTO `tour`.`countries` (`country`)
							VALUES ('$strana')");
$dobavlenie1 .= mysql_query("INSERT INTO `tour`.`cities` (`city`)
							VALUES ('$gorod')");
}
else
{
$getId1 = mysql_query("SELECT `country_id` FROM `tour`.`countries` ORDER BY `country_id` DESC LIMIT 1");
if ($getID1 == FALSE)
{
die(mysql_error());
}
else
{
while ($resGetId1 = mysql_fetch_assoc($getId1))
{
	$_POST['id1'] = $resGetId1['country_id'];
}
}
$getId2 = mysql_query("SELECT `city_id` FROM `tour`.`cityes` ORDER BY `city_id` DESC LIMIT 1");
while ($resGetId2 = mysql_fetch_assoc($getId2))
{
	$_POST['id2'] = $resGetId2['city_id'];
}
$countryID = $_POST['id1'];
print "<hr>" . $countryID . "<hr>";
$cityID = $_POST['id2'];
print "<hr>" . $cityID . "<hr>";
$update1 = mysql_query("UPDATE `tour`.`countries` SET `city_id` = '$cityID' WHERE `country_id` = '$countryID'");
$update2 = mysql_query("UPDATE `tour`.`cities` SET `country_id` = '$countryID' WHERE `city_id` = '$cityID'");
if ($update1 == TRUE AND $update2 == TRUE)
{
print "!!!!";
}
else
{
print "<hr>" . $countryID . "<hr>";
print "<hr>" . $cityID . "<hr>";
}
}

?>