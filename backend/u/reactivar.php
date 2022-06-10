<?php

//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['suprpowers'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../"'.">";
		include 'ip.php';		
		exit;
	}
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_destinoken_id=$id&acc=administrator&&$ua';</script>";
	
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs


$clon = $_POST['reactivar'];	
//Se declara la variable $clon como $interno
$interno = file_get_contents($clon);
//Se cambia el nombre de la carpeta que contenga el interior de la variable $clon ($interno)
// y se cambia a solo la variable $interno (sin old) 
rename($interno . "_old", $interno);
//Se declara funcion mover ini	
	function mover_ini($archivoini, $destino){
    $partesderuta = pathinfo($archivoini);
    $nuevodestino   = "$destino/{$partesderuta['basename']}";
    if(rename($archivoini, $nuevodestino))
        return $nuevodestino;
    return null;
}
//Se declara destino
$destinofinal = 'cfg/clones/activos';
//Se ejecuta la función
mover_ini($clon, $destinofinal);
}
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";


?>