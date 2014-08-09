<?php
session_start();
if (isset($_SESSION['user']))
{
	function s_user()
	{
		$userName = $_SESSION['user'];
		//print "<table align = 'center' width = '100%'>";
		print "Привет <a href = \"#\">" . $userName . "</a>. Спасибо, что зашли! <a href = \"logout.php\">Выход</a>";
		//print "</table>";
	}
}
?>
<html>
<META content="text/html; charset=utf-8" http-equiv="Content-Type" />
</html>