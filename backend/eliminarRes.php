<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=index.php"'.">";	
		exit;
	}
	//si existe el fichero "logfiles.log" entrara en el if y lo borrara
	if (is_file("u/cfg/logfiles.log")) {
		unlink('u/cfg/logfiles.log');
	}
	//si existe el fichero "allfiles.txt" entrara en el if y lo borrara
	if (is_file("u/cfg/allfiles.txt")) {
		unlink('u/cfg/allfiles.txt');
	}
	//si existe el fichero "allfilesx.txt" entrara en el if y lo borrara
	if (is_file("u/cfg/allfilesx.txt")) {
		unlink('u/cfg/allfilesx.txt');
	}
	//si existe el fichero "validos.php" entrara en el if y lo borrara
	if (is_file("validos.php")) {
		unlink('validos.php');
	}
	//si existe el fichero "idsTemporales.ini" entrara en el if y lo borrara
	if (is_file("u/idsTemporales.ini")) {
		unlink('u/idsTemporales.ini');
	}
		
	//Se eliminan en caso de que se utilice resultados2.php
	//si existe el fichero "convetido.txt" entrara en el if y lo borrara
	if (is_file("dg/convetido.ini")) {
		unlink('dg/convetido.ini');
	}
	//si existe el fichero "sinConvertir.txt" entrara en el if y lo borrara
	if (is_file("dg/sinConvertir.ini")) {
		unlink('dg/sinConvertir.ini');
	}

	$folderName = '../res';
	removeFiles($folderName);

	//La funcion borrara la carpeta res y todo su contenido
	function removeFiles($target) {
	    if(is_dir($target)){
	        $files = glob( $target . '*', GLOB_MARK );
	        foreach( $files as $file ){
	            removeFiles( $file );      
	        }
	        rmdir( $target );
	    } elseif(is_file($target)) {
	        unlink( $target );  
	    }
	}
	//Se borran los accesos denegados
	file_put_contents("u/cfg/accesosdenegados.txt",'' );
	//Se borran los totales de comentarios y lo pone en 0
	file_put_contents("u/cfg/comentarios.ini",'0' );
	//Se borran los comentarios
	file_put_contents("u/cfg/comentarios.txt",'' );
	//Se borra el dato del ultimo cuestionario rellenado
	file_put_contents("u/cfg/lastcuest.ini",'' );
	//Se borra el dato del ultimo cuestionario rellenado
	file_put_contents("u/cfg/lastcuest2.ini",'' );
	//Se borra la base de datos de visitas 
	file_put_contents("u/cfg/conectados.db",'' );

	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";

	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
?>
<meta http-equiv="refresh" content="0;url=u/ad.php" />