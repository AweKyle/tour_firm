<?php
/*********************************************
* Поиск тура. работа с таблицей tours        *
*											 *	
*											 *		
*											 *
**********************************************/

print "<form method = \"GET\" action = \"\" id = \"qqqq\">";
include 'dbconnect.php';
mysql_select_db($dbName);
mysql_query("SET CHARACTER SET utf-8");
$query1 = mysql_query("SELECT `country_id`, `country` FROM `tour`.`countries`");
print "<select name = \"strna\">
		<option selected value = \"all\">Любая</option>";
while($resQ1 = mysql_fetch_assoc($query1))
{
	$qQ1 = $resQ1['country'];
	$qqQ1 = $resQ1['country_id'];
	print "<option value = " . $qqQ1 .">" . $qQ1 . "</option>";
}
print "</select><br />
<input type = \"submit\" value = \"ok\" id = \"qqqq\" />


		<br />";
$la = $_GET['strna'];
if ($la != "all")
{
	$query2 = mysql_query("SELECT `city` FROM `tour`.`cities` WHERE `country_id` = '$la'");
}
else
{
	$query2 = mysql_query("SELECT `city` FROM `tour`.`cities`");
}
print "<select name = \"grd\">";
while($resQ2 = mysql_fetch_assoc($query2))
{
	$qQ2 = $resQ2['city'];
	//$qqQ1 = $resQ1['country_id'];
	print "<option>" . $qQ2 . "</option>";
}
print "</select><br /></form>";
?>