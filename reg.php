<?php
$login = (trim($_POST['log']));
$pass = (trim($_POST['pass']));
$confPass = (trim($_POST['confPass']));
/*
$usMail = (trim($_POST['mail']));
$usName = (trim($_POST['usName']));
$usSurname = (trim($_POST['usSurname']));
$usFrom = (trim($_POST['from']));
*/
//проверка на правильность введенных данных
if (($login == "") OR (!preg_match("/^\w{3,}$/", $login)))
{
	die("В поле логин могут быть использованы только буквы, цифры и знак подчеркивания!<br />");
}
if ($pass == "" OR $confPass == "")
{
    die("Вы не ввели пароль<br />");
}
elseif(!preg_match("/^\w{3,}$/", $pass) OR !preg_match("/^\w{3,}$/", $confPass))
{
    die("В поле пароль могут быть использованы только буквы, цифры и знак подчеркивания!<br />");
}
if ($pass != $confPass)
{
    die("Пароли не совпадают<br />");
}
/*if ($usMail == "")
{
    die("Проверьте правильность ввода E-Mail<br />");
}*/
$mdPass = md5($pass);

$code = "who is best?";
$mdCode = md5($code);
$match = md5($_POST['code']);
if ($mdCode == $match)
{
	include 'includes/dbConnect.php';

	mysql_select_db($dbName);
	$addUs = mysql_query("INSERT INTO `$dbName`.`users` (`login`, `pass`)
	                      VALUES ('$login', '$mdPass')");
	if ($addUs == TRUE)
	{
	    print "Спасибо за регистрацию <br /><a href = \"index.php\">Back</a>";
	}
	else
	{
	    die("Такой пользователь уже существует" . mysql_error());
	}
}
else
{
	print "Кодовая фраза введена неправильно";
}
?>