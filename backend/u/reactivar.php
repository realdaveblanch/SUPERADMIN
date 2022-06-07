<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs

}
$clon = $_POST['reactivar'];	


$word = "_old";
$mystring = $clon;
 
// Test if string contains the word 
if(strpos($mystring, $word) !== false){
	$a = substr($clon, 0, -4);
	echo $a;
	rename($clon, $a );
} else{
    echo "No está inactivo!";
}


?>