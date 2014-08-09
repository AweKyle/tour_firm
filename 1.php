<!DOCTYPE html>
<html>
    <head>
        <title>My Form</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <form method = "GET" action = "">
            <div>Name 
                <input name="name" size="15" type="text" />
            </div>
            <select multiple="yes" name="colors[]">
                <option> 1 </option>
                <option> 2 </option>
                <option> 3 </option>
                <option> 4 </option>
                <option> 5 </option>
            </select>
			<input type = "submit" />
        </form>
        <?php
           //$aaa = array(0);
		   $aaa = $_GET['colors'];
		   $s = sizeof($aaa);
		   for ($i = 0; $i < $s; $i++)
		   {
			print $aaa[$i] . "::";
		   }
		   $bbb = array("1", "2", "3", "5");
		   $c = array_rand($bbb);
		   print $c;
		   
        ?>
    </body>
</html>
