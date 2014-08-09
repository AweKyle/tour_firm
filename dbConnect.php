<?php
$dbLocation = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "tour";
$db_connect = mysql_connect($dbLocation, $dbUser, $dbPass);
if (!$db_connect)
    {
        die("Не удалось подключиться к базе данных" . mysql_error());
        exit();
    }
?>