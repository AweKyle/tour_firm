<?php
error_reporting(E_ALL  & ~E_NOTICE);

include 'includes/dbConnect.php';
$country = trim($_POST['countries']);
if ($country != "")
{
	mysql_select_db($dbName);
	$insCountry  = mysql_query("INSERT INTO `tour`.`countries` (`country_name`)
						VALUES ('$country')");
	$selCountry = mysql_query("SELECT `country_id` FROM `tour`.`countries` WHERE `country_name` = '$country'");
	while ($resSelect = mysql_fetch_assoc($selCountry))
	{
		$_POST['id'] = $resSelect['country_id'];
	}
}

function selectCountry()
{
	$countrySel = mysql_query("SELECT `country_id`, `country_name` FROM `tour`.`countries` ORDER BY `country_id`");
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
        $cS3 = $resCitySel['country_id'];
		print "<option value = " . $cS2 . "::" . $cS3 . ">" . $cS1 . "</option>";
	}
	print "</select><br />";
}

function selectHotel()
{
	$hotelSel = mysql_query("SELECT *
                             FROM `tour`.`hotels`, `tour`.`cities` 
                             WHERE `hotels`.`city_id` = `cities`.`city_id`");
	print "<select name = \"hotel_sel\" >
			<option selected value = \"all\">Не выбрано</option>";
	while($resHotelSel = mysql_fetch_assoc($hotelSel))
	{
		$hS1 = $resHotelSel['hotel_name'];
		$hS2 = $resHotelSel['hotel_id'];
        $hS3 = $resHotelSel['city_name'];
        $hS4 = $resHotelSel['city_id'];
        $hS5 = $resHotelSel['country_id'];
		print "<optgroup label = " . $hS3 . ">";
        print "<option value = " . $hS2 . "::" . $hS4 . "::" . $hS5 . ">" . $hS1 . "</option></optgroup>";
	}
	print "</select><br />";
}


function dateLeave()
{
	$arDay = array(range(0, 31));
    print "<select name = \"LeaveDD\"><option>День</option>";
    for ($i = 0; $i ++< 31;)
    {
        print "<option value = \"$i\" >$i</option>";
    }
    print "</select>\\";
    print "<select name = \"LeaveMM\"><option>Месяц</option>";
    $arrMM = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
					   7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
	foreach ($arrMM as $key => $value)
	{
		print "<option value = \"$key\" >$value</option>";
	}
    print "</select>\\";
    print "<select name = \"LeaveYY\"><option>Год</option>";
    foreach (range(2013, 2015) as $y)
    {
        print "<option value = \"$y\">$y</option>";
    }
    print "</select>";
}

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
    $gorod = $_POST['cities'];
    if ($gorod != "")
    {
    	$query2 = mysql_query("INSERT INTO `tour`.`cities` (`city_name`, `country_id`)
    							VALUES ('$gorod', '$getCountry')");
		if ($query2 == TRUE)
		{
			print "Ok <br /><a href = \"country.php\">Back</a>";
		}
		else 
		{
			print "False";
		}
    }
    	/*$citeID = mysql_query("SELECT `city_id`, `country_id` FROM `tour`.`cities` WHERE `city_name` = '$gorod'");
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
    }*/
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
    $nights = $_POST['nights'];
    if ($lDD == "День" OR $lMM == "Месяц"  OR $lYY == "Год")
    {
        die('Дата не выбрана');
    }
    else
    {
        if ($nights == "")
        {
            $rDD = $lDD + 4;
            $rMM = $lMM;
            $rYY = $lYY;
			$nights = 3;
        }
		else
		{
			$rDD = $lDD + $nights + 1;
            $rMM = $lMM;
            $rYY = $lYY;
		}
		if ($rDD > 31)
		{
			$rMM++;
			$rDD = $rDD - 31;
		}
    }
    $dateLeave = $lYY . "." . $lMM . "." . $lDD;
    $dateReturn = $rYY . "." . $rMM . "." . $rDD;
	if ($_POST['hotel_sel'] != "all")
	{
		$htlS = $_POST['hotel_sel'];
        $hID = explode("::", $htlS);
	}
    if (isset($_POST['tour']))
    {
        $tourName = $_POST['tour'];
        $nMatch = mysql_query("SELECT `tour_id` FROM `tour`.`tours` WHERE `tour_name` = '$tourName'");
        if (mysql_num_rows($nMatch) > 0)
        {
            die('Такой тур уже существует');
        }
        else
        {
        	$insTour = mysql_query("INSERT INTO `tour`.`tours` (`tour_name`, `country_id`, `city_id`, `cost`, `date_leave`, `date_return`, `nights`, `hotel_id`)
        						VALUES ('$tourName','$hID[2]', '$hID[1]', '$tourCost', '$dateLeave', '$dateReturn', '$nights', '$hID[0]')");
            if ($insTour = TRUE)
            {
                print "Successfully <br /><a href = \"tour.php\">Back</a>";
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
	$rate = $_POST['category'];
	$costSngl = $_POST['one'];
	$costDbl = $_POST['two'];
	$costTrpl = $_POST['three'];
	$costLx = $_POST['four'];
	if (!is_numeric($costSngl))
	{
		$costSngl = 0;
	}
	if (!is_numeric($costDbl))
	{
		$costDbl = 0;
	}
	if (!is_numeric($costTrpl))
	{
		$costTrpl = 0;
	}
	if (!is_numeric($costLx))
	{
		$costLx = 0;
	}
    if (isset($_POST['htl_nm']))
    {
        $hotelName = $_POST['htl_nm'];
        $cSel = $_POST['city_sel'];
        $cID = explode("::", $cSel);
		$insHotel = mysql_query("INSERT INTO `tour`.`hotels` (`hotel_name`,`city_id`, `country_id`, `rate`, `cost_one`, `cost_two`, `cost_three`, `cost_four`)
        						VALUES ('$hotelName', '$cID[0]', '$cID[1]', '$rate', '$costSngl', '$costDbl', '$costTrpl', '$costLx')");
		if ($insHotel = TRUE)
		{
			print "Successfully <br /><a href = \"hotel.php\">Back</a>";
		}
		else
		{
			mysql_error("Добавление не удалось, так как: ");
		}
    }
}
newHotel();
?>