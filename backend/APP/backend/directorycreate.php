<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=index.php"'.">";	
		exit;
	}
?>
<?php
/**/
/*$directory = '..'.DIRECTORY_SEPARATOR.'respuestas'.DIRECTORY_SEPARATOR;
$array = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z', '1','2', '3', '4', '5', '6', '7', '8', '9', '0');

foreach($array as $character) {
    foreach($array as $characterB) {
        echo $directory.$character.$characterB;
        mkdir($directory.$character.$characterB);
    }
}*/

/**/
/*function eliminarDir($carpeta)
{
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {
        echo $archivos_carpeta;
 
        if (is_dir($archivos_carpeta))
        {
            eliminarDir($archivos_carpeta);
        }
        else
        {
            unlink($archivos_carpeta);
        }
    }
 
    rmdir($carpeta);
}*/
	//Cargamos los datos del archivo valido.php con permisos de lectura
	if (is_file("validos.php")) {
		$idsValidos = fopen("validos.php", "r");
			//Miestras el puntero del archivo valido.php no este al final entra en el while
			while(!feof($idsValidos)) {
				//Guardo la primera linea del archivo valido.php y la guardo en la variable $id
				$id = fgets($idsValidos);
				
				//Se crea la carpeta "res" y dentro de ella se creara otra con 13 carecteres de $id
				@mkdir("..".DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR.substr($id,0,13),0700,true);	
			}
		fclose($idsValidos);

		echo "Activando cuestionarios...";	
	}

	//Crear el contenido de la carpeta respaldo
	//Se crea la carpeta "comentarios"
	//mkdir("respaldo/comentarios", 0700);
	//Se crea la carpeta "comentarios"
	//mkdir("respaldo/resultados", 0700);

	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
?>
<meta http-equiv="refresh" content="0;URL='u/ad.php'" />