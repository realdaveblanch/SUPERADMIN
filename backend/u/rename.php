<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs 
		$clon = $_POST['clones'];
echo $clon;		
rename($clon, $clon . "_old");
}

?>