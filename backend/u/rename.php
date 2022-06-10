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
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];

		$interno = file_get_contents($clon);
//Se cambia el nombre de la ruta que contenga $clon ($interno) a _old
rename($interno, $interno . "_old" );
//Se declara funcion mover ini	
	function mover_ini($archivoini, $destino){
    $partesderuta = pathinfo($archivoini);
    $nuevodestino   = "$destino/{$partesderuta['basename']}";
    if(rename($archivoini, $nuevodestino))
        return $nuevodestino;
    return null;
}
$destinofinal = 'cfg/clones/desactivados';
mover_ini($clon, $destinofinal);
	
//Hay que buscar line en select y eliminar
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";
}
?>