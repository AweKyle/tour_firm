<?php
include 'includes/dbconnect.php';

mysql_select_db($dbName);

function selectCity()
{
	$citySel = mysql_query("SELECT * FROM `tour`.`cities`, `tour`.`countries` WHERE `cities`.`country_id` = `countries`.`country_id`");
	print "
			<option selected value = \"all\">Не выбрано</option>";
	while($resCitySel = mysql_fetch_assoc($citySel))
	{
		$cS0 = $resCitySel['country_name'];
		$cS1 = $resCitySel['city_name'];
		$cS2 = $resCitySel['city_id'];
        $cS3 = $resCitySel['country_id'];
		print "<optgroup label = '" . $cS0 . "'><option value = " . $cS2 . ">" . $cS1 . "</option></optgroup>";
	}
	//print "</select><br />";
}

/*
<select size = \"20\" multiple name = \"city_sel[]\" > */
$cId = $_POST['countries'];
$size = sizeof($cId);
for ($i = 0; $i < $size; $i++)
{
	print $cId[$i] . "<br />";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MULTI SELECT</title>
</head>
<body>
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
        <tr>
        	<td colspan="3" align="center">
            	<button type="submit">ОТПРАВИТЬ</button>
            </td>
        </tr>
	</table>    
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