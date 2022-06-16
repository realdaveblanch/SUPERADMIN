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
		
		$clon = $_POST['renombrar'];

		$interno = file_get_contents($clon);
		
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$nuevoname = $_POST['nombrenuevo'];	
		
//Se cambia el nombre de la ruta que contenga $clon ($interno) a _old
rename($interno, "../../../$nuevoname" );
//Se elimina el .ini de activos
unlink($clon);
//Se crea uno nuevo con el nuevo nombre y ruta correspondiente
file_put_contents('cfg/clones/activos/' . $nuevoname . ".ini" , "../../../" . $nuevoname);
file_put_contents('cfg/clones/panel/' . $nuevoname . ".ini" , "../../../" . $nuevoname);
}

	
//Hay que buscar line en select y eliminar
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";
}
								//CODE BY
					//https://github.com/realdaveblanch
?>