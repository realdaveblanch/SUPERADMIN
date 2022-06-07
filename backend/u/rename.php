<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];	
rename($clon, $clon . "_old");
$fp4 = fopen('cfg/urlunactive.ini', 'a');
		file_put_contents('cfg/urlunactive.ini','', LOCK_EX);
	fwrite($fp4, $clon . "_old");
}

?>