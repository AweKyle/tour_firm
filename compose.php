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

<?php
include 'includes/dbconnect.php';

mysql_select_db($dbName);

function selectCity()
{
	$citySel = mysql_query("SELECT * FROM `tour`.`cities`, `tour`.`countries`, `tour`.`hotels`
							WHERE`cities`.`city_id` = `hotels`.`city_id` AND `cities`.`country_id` = `countries`.`country_id`");
	while($resCitySel = mysql_fetch_assoc($citySel))
	{
		$cS0 = $resCitySel['country_name'];
		$cS1 = $resCitySel['city_name'];
		$cS2 = $resCitySel['city_id'];
        $cS3 = $resCitySel['country_id'];
		print "<optgroup label = '" . $cS0 . "'><option value = " . $cS2 . ">" . $cS1 . "</option></optgroup>";
	}
}

function selectHotel()
{
	$cId = $_POST['countries'];
	$size = sizeof($cId);
	$i = 0;
	while ($i < $size)
	{
		$hotelSel = mysql_query("SELECT `hotel_id` FROM `tour`.`hotels` WHERE `city_id` = '$cId[$i]'");
		while ($resHSel = mysql_fetch_assoc($hotelSel))
		{
			$_POST['h_id'] = $resHSel['hotel_id'];
			//print "Отель: " . $_POST['h_id'] . "<br />";
		}
		$i++;
	}
}
selectHotel();

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

function preWrite()
{
	$hId = $_POST['h_id'];
	foreach ($hId as $kk)
	{
		print $kk . "**";
	}
	print $hId;
	$cId = $_POST['countries'];
	foreach ($cId as $val) 
	{
		print $val . ":::";
	}
}
preWrite();
?>

<form name="ctrs" action="" method="post">
	<table>
        <tr>
            <td>
                <select id="src_countries" style="width:270px" multiple="multiple" size="10">
                <?php
				selectCity();
				?>          
                 </select>        
            </td>
            <td>
				<p><button type="button" id="take" >&gt;&gt;</button></p>
				<p><button type="button" id="drop" >&lt;&lt;</button></p>        
            </td>
            <td>
               <select name="countries[]" id="dst_countries" style="width:270px" multiple="multiple" size="10">
               
                </select>        
            </td>
        </tr>
        </table>
        	<?php
        	dateLeave();
        	?>
        	<br />
        	Ночей:
        	<input type = "text" value = "" name = "nights" />
           	<p align="center">
        	  	<button type="submit">ОТПРАВИТЬ</button>
            </p>   
</form>
<form method = "POST" action = "reservation.php" id = "res">
<?php
	//resPreview();
?>
<input type = "submit" id = "res" />
</form>
<script type="text/javascript">
var MultiSelect = (function (GLOB) {
	// Добавить элементы в поле назначения:
	function moveItems(btn, srcSelect, dstSelect) {
		btn.onclick	= function () {
            var i;
			for (i = srcSelect.options.length - 1; i >= 0; i -= 1) {
				if (srcSelect.options[i].selected) {
					dstSelect.add(new Option(srcSelect.options[i].text, srcSelect.options[i].value));
					srcSelect.remove(i);
				}
			}
		};
	}
	// Подготовка данных к отправке:
	function formSubmit(element) {
		// Ф-ция делает все элеметы спика select выбраными:		
		function makeSelect(element) {
            var i;
			for (i = 0; i < element.options.length; i += 1) {
				element.options[i].selected = true;
			}
		}
		// Ниже мы всего лишь кроссбрауз. устанавливаем слушатель
		// события отправки формы:
		if (GLOB.document.addEventListener) {
			element.form.addEventListener("submit", function () {
				makeSelect(element);
			}, true);
		} else if (GLOB.document.attachEvent) {
			element.form.attachEvent("onsubmit", function () {
				makeSelect(element);
			});
		} else {
			element.form.onsubmit = function () {
				makeSelect(element);
			};
		}
	}
	return function (srcSelect, dstSelect, takeBtn, dropBtn) {
		return {
			init : function (srcSelect, dstSelect, takeBtn, dropBtn) {
				moveItems(takeBtn, srcSelect, dstSelect);
				moveItems(dropBtn, dstSelect, srcSelect);
				formSubmit(dstSelect);
			}
		}.init(srcSelect, dstSelect, takeBtn, dropBtn);
	};
}(this));

MultiSelect(document.getElementById("src_countries"),
			document.getElementById("dst_countries"),
			document.getElementById("take"),
			document.getElementById("drop"));
</script>
</body>
</html>

