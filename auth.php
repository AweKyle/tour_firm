<?php
if (isset($_POST['authLog']) AND (isset($_POST['authPass'])))
{
    $usLog = $_POST['authLog'];
    $passHash = md5($_POST['authPass']);
    include 'includes/dbConnect.php';
    mysql_select_db($dbName);
    $auth = mysql_query("SELECT `login` FROM `tour`.`users` 
                         WHERE `login` = '$usLog' AND `pass` = '$passHash'");
    if (mysql_num_rows($auth) > 0)
    {
       session_start();
       $_SESSION['user'] = $usLog;
       /* print "<script language = \"JavaScript\"> 
                    window.location.href = \"index.php\"
               </script>";*/
       // session_start();
        //$_SESSION['user'] = $login;
       /* print "<script language = \"JavaScript\"> 
                    window.location.href = \"index.php\"
               </script>";*/
        print "<script>document.location.href = 'index.php';</script>";
        //header ("location: index.php");
    }
    else
    {
        print "Такого пользователя не существует" . mysql_error();
    }
}
?>