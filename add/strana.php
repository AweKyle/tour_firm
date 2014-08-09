<?php
//error_reporting(E_ALL);

include 'dbConnect.php';

$country = trim($_POST['countries']);
if ($country != "")
{
	mysql_select_db($dbName);
	$insCountry  = mysql_query("INSERT INTO `tour`.`countries` (`country_name`)
						VALUES ('$country')");
	$selCountry = mysql_query("SELECT `country_id` FROM `tour`.`countries` WHERE `country_name` = '$country'");
	while ($resSelect = mysql_fetch_assoc($selCountry))
	{
		$_POST['id'] = $resSel['country_id'];
	}
}
function selectCountry()
{
	$countrySel = mysql_query("SELECT `country_id`, `country_name` FROM `tour`.`countries`");
	print "<select name = \"strna\" >
			<option selected value = \"all\">Не выбрано</option>";
	while($resSel = mysql_fetch_assoc($countrySel))
	{
		$resName = $resSel['country_name'];
		$resId = $resSel['country_id'];
		print "<option value = " . $resId .">" . $resName . "</option>";
	}
	print "</select><br />";
}

function selectCity()
{
	$citySel = mysql_query("SELECT `city_id`, `city_name`, `country_id` FROM `tour`.`cities`");
	print "<select name = \"city_sel\" >
			<option selected value = \"all\">Не выбрано</option>";
	while($resCitySel = mysql_fetch_assoc($citySel))
	{
		$cS1 = $resCitySel['city_name'];
		$cS2 = $resCitySel['city_id'];
		print "<option value = " . $cS2 .">" . $cS1 . "</option>";
	}
	print "</select><br />";
}
/* Не смог придумать, зачем оно надо
function selectTour()
{
	$tourSel = mysql_query("SELECT `tour_id`, `tour_name`, `country_id`, `city_id`, `hotel_id` FROM `tour`.`tours`");
	print "<select name = \"tour_select\" >
			<option selected value = \"all\">Не выбрано</option>";
	while($resTourSel = mysql_fetch_assoc($tourSel))
	{
		$tIdSel = $resTourSel['tour_id'];
		$tNSel = $resTourSel['tour_name'];
		print "<option value = " . $tIdSel .">" . $tNSel . "</option>";
	}
	print "</select><br />";
}
*/
?>

<html>
<body>
<table border = "1" id = "country_tbl">
<th align = "left" colspan = "2">Страна</th>
<!-- <th>Добавьте новые значения</th><th>Выберите из имеющихся</th> -->
<form method = "POST" action = "">
<tr>
<td align = "right">
		<input type = "text" name = "countries" />
</td>
<td align = "center">
	<?php
	selectCountry();
	?>
</td>
</tr>
</table>
<hr />
<table border = "1" id = "city_tbl">
<th align = "left" colspan = "2">Город</th>
<tr>
<td align = "right">
	<input type = "text" name = "cities" />
</td>
<td align = "center">
	<?php
	  selectCity();
	?>
</td>
</tr>
</table>
<hr />
<table border = "1" id = "tour_tbl">
<th align = "left" colspan = "6">Тур</th>
<tr>
<td align = "right">
	<input type = "text" name = "tour" />
</td>
<!--
<td align = "center">
	<?php
	//selectTour();
	?>
</td>
-->
<td>
    Цена
    <input type = "text" name = "cost" />
</td>
<td>
    Вылет от:
    <?php
    print "<select name = \"LeaveDD\"><option>День</option>";
    for ($i = 0; $i ++< 31;)
    {
        print "<option value = \"$i\" >$i</option>";
    }
    print "</select> \\ ";
    print "<select name = \"LeaveMM\"><option>Месяц</option>";
    for ($j = 0; $j ++< 12;)
    {
        print "<option value = \"$j\" >$j</option>";
    }
    print "</select> \\ ";
    print "<select name = \"LeaveYY\"><option>Год</option>";
    foreach (range(2013, 2015) as $y)
    {
        print "<option value = \"$y\">$y</option>";
    }
    print "</select>";
    ?>
</td>
<td>
    До:
    <?php
    print "<select name = \"ReturnDD\"><option>День</option>";
    for ($i = 0; $i ++< 31;)
    {
        print "<option value = \"$i\" >$i</option>";
    }
    print "</select> \\ ";
    print "<select name = \"ReturnMM\"><option>Месяц</option>";
    for ($j = 0; $j ++< 12;)
    {
        print "<option value = \"$j\" >$j</option>";
    }
    print "</select> \\ ";
    print "<select name = \"ReturnYY\"><option>Год</option>";
    foreach (range(2013, 2015) as $y)
    {
        print "<option value = \"$y\">$y</option>";
    }
    print "</select>";
    ?>
</td>
</tr>
</table>
<hr />
<table border = "1">
<tr>

<td align = "right">
		Hotel
		<input type = "text" name = "hotl" />
</td>
<td align = "center">
	<?php
//	selectTour();
	?>
</td>
</tr>
</table>
<input type = "submit" value = "click" />
</form>
</body>
</html>
<?php
function newCity()
{
    if ($_POST['strna'] AND $_POST['strna'] != "all")
    {
    	$getCountry = $_POST['strna'];
    }
    else
    {
    	$getCountry = $_POST['id'];
    }
    $gorod = $_POST['cites'];
    if ($gorod != "")
    {
    	$query2 = mysql_query("INSERT INTO `tour`.`cities` (`city_name`, `country_id`)
    							VALUES ('$gorod', '$getCountry')");
    	$citeID = mysql_query("SELECT `city_id`, `country_id` FROM `tour`.`cities` WHERE `city_name` = '$gorod'");
    	while ($resCitId = mysql_fetch_assoc($citeID))
    	{
    		$_POST['citID'] = $resCitId['city_id'];
    		$_POST['conID'] = $resCitId['country_id'];
    	}
    }
    else
    {
    	$ci = $_POST['city_sel'];
    	$citesID = mysql_query("SELECT `country_id` FROM `tour`.`cities` WHERE `city_id` = '$ci'");
    	while ($resCitId = mysql_fetch_assoc($citesID))
    	{
    	   $_POST['conID'] = $resCitId['country_id'];
    	}
    }
}
newCity();

function newTour()
{
    $tourCost = $_POST['cost'];
    if (isset($tourCost) AND !is_numeric($tourCost))
    {
        die('Цена введена неверно');
    }
    $lDD = $_POST['LeaveDD'];
    $lMM = $_POST['LeaveMM'];
    $lYY = $_POST['LeaveYY'];
    $rDD = $_POST['ReturnDD'];
    $rMM = $_POST['ReturnMM'];
    $rYY = $_POST['ReturnYY'];
    if ($lDD == "День" OR $lMM == "Месяц"  OR $lYY == "Год")
    {
        die('');
    }
    else
    {
        
        if ($rDD  == "День" OR $rMM == "Месяц" OR $rYY == "Год")
        {
            $rDD = $lDD + 1;
            $rMM = $lMM;
            $rYY = $lYY;
        }
        if ($lYY > $rYY OR ($lMM > $rMM AND $lYY = $rYY) OR ($lDD > $rDD AND $lMM = $rMM)) 
        {
            die('');
        }
    }
    $dateLeave = $lYY . "." . $lMM . "." . $lDD;
    $dateReturn = $rYY . "." . $rMM . "." . $rDD;
    if (isset($_POST['tour']))
    {
        $tourName = $_POST['tour'];
    
   /* Не нужно пока
    else
    {
        if($_POST['tour_select'] != "all")
        {
        	$tourName = $_POST['tour_select'];
        }
    } */
    	if ($_POST['city_sel'] != "all")
    	{
    		$ctId = $_POST['city_sel'];
            $getCntrId = mysql_query("SELECT `country_id` FROM `tour`.`cities` WHERE `city_id` = '$ctId'");
            while ($resGet = mysql_fetch_assoc($getCntrId))
            {
                $cntrId = $resGet['country_id'];
            }
    	}
    	elseif ($_POST['cities'] != "")
    	{
    		$ctId = $_POST['citID'];
            $cntrId = $_POST['conID'];
    	}
        else
        {
            die('Не выбран город');
        }
        $nMatch = mysql_query("SELECT `tour_id` FROM `tour`.`tours` WHERE `tour_name` = '$tourName'");
        if (mysql_num_rows($nMatch) > 0)
        {
            die('Такой тур уже существует');
        }
        else
        {
        	$insTour = mysql_query("INSERT INTO `tour`.`tours` (`tour_name`,`city_id`, `country_id`, `cost`, `date_leave`, `date_return`)
        						VALUES ('$tourName', '$ctId', '$cntrId', '$tourCost', '$dateLeave', '$dateReturn')");
            if ($insTour = TRUE)
            {
                print "Successfully";
            }
            else
            {
                mysql_error("Добавление не удалось, так как: ");
            }
        }
     }
}
newTour();

function newHotel()
{
    if ($_POST['hotl'] != "")
    {
        $hotelName = $_POST['hotl'];
        
    }
}
?>